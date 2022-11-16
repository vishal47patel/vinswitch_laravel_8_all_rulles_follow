<?php

namespace App\Http\Controllers;

use App\Libraries\SocketConnection;
use App\Models\SofiaConf;
use Exception;
use Illuminate\Support\Facades\Cache;
use SimpleXMLElement;

class SofiaConfController extends Controller
{
    public function index(SofiaConf $sofiaConf)
    {
        $row = 10;
        if (request('row') != '')
            $row = request('row');

        $record = $sofiaConf->orderBy('id', 'DESC');

        $record = $record->paginate($row);
        $operationPermission = [
            'list' => hasPermission(['sip_status_list']),
        ];

        $data = $this->getSofiaStatus();
        return view('sip_status.index', compact('record', 'operationPermission', 'data'));
    }

    public function getSofiaStatus()
    {
        // socket connection
        $obj = new SocketConnection;
        $fp = $obj->_event_socket_create();
        $responce = [];
        $error = [];

        //sofia status
        if ($fp) {
            $cmd = "api sofia xmlstatus";
            $responce['xml_response'] = $obj->_event_socket_request($fp, $cmd);
            try {
                $responce['xml'] = new SimpleXMLElement($responce['xml_response']);
            } catch (Exception $e) {
                $error[] = $e->getMessage();
            }
            $cmd = "api sofia xmlstatus gateway";
            $responce['xml_response'] = $obj->_event_socket_request($fp, $cmd);
            try {
                $responce['xml_gateways'] = new SimpleXMLElement($responce['xml_response']);
            } catch (Exception $e) {
                $error[] = $e->getMessage();
            }
        }
        $responce['error'] = $error;
        return $responce;
    }

    // command run
    public function cmd($cmd)
    {
        $command = $cmd;
        $data_process = '';
        
        //create the event socket connection
        $fp = SocketConnection::_event_socket_create();
        if ($fp) {
            //if reloadxml then run reloadacl, reloadxml and rescan the external profile for new gateways
            if ($command == "api reloadxml") {
                //reloadxml
                if ($command == "api reloadxml") {
                    $response = SocketConnection::_event_socket_request($fp, $command);
                    unset($command);
                }

                //clear the apply settings reminder
                $_SESSION["reload_xml"] = false;

                //rescan the external profile to look for new or stopped gateways
                $command = 'api sofia profile external rescan';
                $response = SocketConnection::_event_socket_request($fp, $command);
                unset($command);
                $data_process = 'Reload XML';
            }

            //cache flush
            if ($command == "api cache flush") {
                $cache = new Cache;
                $cache->flush();
                $data_process = 'Flush';
            }

            //reloadacl
            if ($command == "api reloadacl") {
                $response = SocketConnection::_event_socket_request($fp, $command);
                unset($command);
                $data_process = 'Reload ACL';
            }

            //sofia profile
            $command = $cmd;
            if (substr($command, 0, 17) == "api sofia profile") {
                $response = SocketConnection::_event_socket_request($fp, $command);
            }

            //close the connection
            fclose($fp);
        }
        return redirect()->route('sip.status.index')
           ->with('success', $data_process.' successfully');
    }   
}
