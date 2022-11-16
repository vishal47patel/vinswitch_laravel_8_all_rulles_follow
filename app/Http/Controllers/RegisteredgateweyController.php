<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FreeswitchServer;
use App\Libraries\EventSocket;
use App\Libraries\SocketConnection;

class RegisteredgateweyController extends Controller
{
    public function index()
    {
        $freeswitchServers = FreeswitchServer::all();
        return view('registeredgatewey.index', compact('freeswitchServers'));
    }

    public function getRegisteredgatewey(Request $request)
    {
        $id = $request->host_id;
        $command = "api sofia xmlstatus gateway";

        $data = FreeswitchServer::find($id);
        if ($data == '') {
            echo ''; exit;
        }

        $host =  $data->freeswitch_host;
        $password = $data->freeswitch_password;
        $port = $data->freeswitch_port;

        $esl = new EventSocket;
         
        $esl->connect($host, $port, $password);
           
        $fp = $esl->reset_fp();

        $response = SocketConnection::_event_socket_request($fp, $command);

        $xml = simplexml_load_string($response);
        $array = json_decode(json_encode($xml) , true);

        $row = $array['gateway'];
       
        $rows = $row;

        $onhover_pause_refresh = " onmouseover='refresh_stop();' onmouseout='refresh_start();'";
        $c = 0;
        $row_style["0"] = "row_style0";
        $row_style["1"] = "row_style1";
    
        //show content
        $table = "";

        if(count($rows) > 0){

            if(isset($rows[0])){

                foreach ($rows as &$row) {       

                    //set the php variables
                    foreach ($row as $key => $value) {
                        $key = str_replace("-","_",$key);
                        $$key = $value;
                    }

                    //send the html
                    $table .=  "<tr>\n";
                    $table .=  "<td valign='top' class='".$row_style[$c]."'>".$name."&nbsp;</td>\n";
                    $table .=  "<td valign='top' class='".$row_style[$c]."'>".$proxy."&nbsp;</td>\n";
                    $table .=  "<td valign='top' class='".$row_style[$c]."'>".$username."&nbsp;</td>\n";
                    $table .=  "<td valign='top' class='".$row_style[$c]."'>".$calls_in."&nbsp;</td>\n";
                    $table .=  "<td valign='top' class='".$row_style[$c]."'>".$calls_out."&nbsp;</td>\n";
                    $table .=  "<td valign='top' class='".$row_style[$c]."'>".$failed_calls_in."&nbsp;</td>\n";
                    $table .=  "<td valign='top' class='".$row_style[$c]."'>".$failed_calls_out."&nbsp;</td>\n";
                    $table .=  "<td valign='top' class='".$row_style[$c]."'>".$status."&nbsp;</td>\n";
                    $table .=  "<td valign='top' class='".$row_style[$c]."'>".$state."&nbsp;</td>\n";
                
                    // $table .=  "<td class='list_control_icons'> <button type='button' class='btn btn-primary btn-sm' onclick = \"unregister('".$unregister ."','". $user."','".$agent."','".$sip_profile_name."')\">".Yii::t('yii','Unregister')."</button><a href='javascript:void(0);'\"></a></td>\n";
                    $table .=  "</tr>\n";
                
                    //alternate the row style
                    $c = ($c) ? 0 : 1;
                }

            } else {

                foreach ($rows as $key => $value) {

                        $key = str_replace("-","_",$key);
                        $$key = $value;
                }

                //send the html
                $table .=  "<tr>\n";
                $table .=  "<td valign='top' class='".$row_style[$c]."'>".$name."&nbsp;</td>\n";
                $table .=  "<td valign='top' class='".$row_style[$c]."'>".$proxy."&nbsp;</td>\n";
                $table .=  "<td valign='top' class='".$row_style[$c]."'>".$username."&nbsp;</td>\n";
                $table .=  "<td valign='top' class='".$row_style[$c]."'>".$calls_in."&nbsp;</td>\n";
                $table .=  "<td valign='top' class='".$row_style[$c]."'>".$calls_out."&nbsp;</td>\n";
                $table .=  "<td valign='top' class='".$row_style[$c]."'>".$failed_calls_in."&nbsp;</td>\n";
                $table .=  "<td valign='top' class='".$row_style[$c]."'>".$failed_calls_out."&nbsp;</td>\n";
                $table .=  "<td valign='top' class='".$row_style[$c]."'>".$status."&nbsp;</td>\n";
                $table .=  "<td valign='top' class='".$row_style[$c]."'>".$state."&nbsp;</td>\n";
            
                // $table .=  "<td class='list_control_icons'> <button type='button' class='btn btn-primary btn-sm' onclick = \"unregister('".$unregister ."','". $user."','".$agent."','".$sip_profile_name."')\">".Yii::t('yii','Unregister')."</button><a href='javascript:void(0);'\"></a></td>\n";
                $table .=  "</tr>\n";
            
                //alternate the row style
                $c = ($c) ? 0 : 1;

            }
        
        }

        $data = ['table' => $table];
        echo json_encode($data);
    }
}
