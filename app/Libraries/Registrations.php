<?php

namespace App\Libraries;

use App\Models\SofiaConf;
use EventSocket;
use Exception;

class Registrations
{
    public function __destruct()
    {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    /**
     * get the registrations
     */
    public function get($profile, SofiaConf $sofia_conf)
    {

        //initialize the id used in the registrations array
        $id = 0;

        //create the event socket connection
        $fp = $this->_event_socket_create();

        if($profile != '' && $profile != 'all')
            $sofia_conf = $sofia_conf->where('profile_name', $profile);

        $records = $sofia_conf->get();

        foreach ($records as $field) {

            if ($field['profile_name'] == 'internal') { 
                //get sofia status profile information including registrations
                $cmd = "api sofia xmlstatus profile " . $field['profile_name'] . " reg";

                $xml_response1 = $this->_event_socket_request($fp, $cmd);


                if ($xml_response1 == "Invalid Profile!") {
                    $xml_response1 = "<error_msg>" . Yii::t('app', 'Invalid Profile!') . "</error_msg>";
                }
                $xml_response1 = str_replace("<profile-info>", "<profile_info>", $xml_response1);
                $xml_response1 = str_replace("</profile-info>", "</profile_info>", $xml_response1);

                try {
                    $xml = simplexml_load_string($xml_response1);
                } catch (Exception $e) {
                    echo $e->getMessage();
                    exit;
                }

                $array = json_decode(json_encode($xml), true);

                //normalize the array
                if (isset($array) && is_array($array) && !isset($array['registrations']['registration'][0])) {
                    $row = $array['registrations']['registration'];
                    unset($array['registrations']['registration']);
                    $array['registrations']['registration'][0] = $row;
                }

                //set the registrations array
                if (isset($array) && is_array($array)) {

                    if (isset($array['registrations']['registration'])) {

                        foreach ($array['registrations']['registration'] as  $row) {


                            //build the registrations array
                            //$registrations[0] = $row;
                            $user_array = explode('@', $row['user']);
                            $registrations[$id]['user'] = $row['user'] ?: '';
                            $registrations[$id]['call-id'] = $row['call-id'] ?: '';
                            $registrations[$id]['contact'] = $row['contact'] ?: '';
                            $registrations[$id]['sip-auth-user'] = $row['sip-auth-user'] ?: '';
                            $registrations[$id]['agent'] = $row['agent'] ?: '';
                            $registrations[$id]['host'] = $row['host'] ?: '';
                            $registrations[$id]['network-port'] = $row['network-port'] ?: '';
                            $registrations[$id]['sip-auth-realm'] = $row['sip-auth-realm'] ?: '';
                            $registrations[$id]['mwi-account'] = $row['mwi-account'] ?: '';
                            $registrations[$id]['status'] = $row['status'] ?: '';
                            $registrations[$id]['ping-time'] = $row['ping-time'] ?: '';
                            $registrations[$id]['sip_profile_name'] = $field['profile_name'];


                            //get network-ip to url or blank
                            if (isset($row['network-ip'])) {
                                $registrations[$id]['network-ip'] = $row['network-ip'];
                            } else {
                                $registrations[$id]['network-ip'] = '';
                            }

                            //get the LAN IP address if it exists replace the external ip
                            $call_id_array = explode('@', $row['call-id']);
                            if (isset($call_id_array[1])) {
                                $agent = $row['agent'];
                                $lan_ip = $call_id_array[1];
                                if (false !== stripos($agent, 'grandstream')) {
                                    $lan_ip = str_ireplace(
                                        array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'),
                                        array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'),
                                        $lan_ip
                                    );
                                } elseif (1 === preg_match('/\ACL750A/', $agent)) {
                                    //required for GIGASET Sculpture CL750A puts _ in it's lan ip account
                                    $lan_ip = preg_replace('/_/', '.', $lan_ip);
                                }
                                $registrations[$id]['lan-ip'] = $lan_ip;
                            } else {
                                $registrations[$id]['lan-ip'] = '';
                            }


                            //increment the array id
                            $id++;
                        }
                    }

                    unset($array);
                }
            }
        }

        //return the registrations array
        return (isset($registrations)) ? $registrations : array();
    }


    public function _event_socket_create()
    {
        $host = config('param.SocketConnection.host');
        $password = config('param.SocketConnection.password');
        $port = config('param.SocketConnection.port');

        $esl = new EventSocket();
        if ($esl->connect($host, $port, $password)) {
            return $esl->reset_fp();
        }
        return false;
    }

    public function _event_socket_request($fp, $cmd)
    {

        $esl = new EventSocket($fp);
        $result = $esl->request($cmd);
        $esl->reset_fp();
        return $result;
    }
}
