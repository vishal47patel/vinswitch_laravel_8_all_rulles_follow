<?php

namespace App\Http\Controllers;

use App\Libraries\Registrations;
use App\Models\SofiaConf;
use Exception;
use Illuminate\Http\Request;
use SimpleXMLElement;

class SofiaConfController extends Controller
{
    public function index(SofiaConf $sofiaConf)
    {
        $row = 10;
        if (request('row') != '')
            $row = request('row');

        $record = $sofiaConf->orderBy('id', 'DESC')->get();

        $record = $record->paginate($record);

        $operationPermission = [
            'reload' => hasPermission(['sip_status_list', 'sip_status_reload']),
            'start' => hasPermission(['sip_status_list', 'sip_status_start']),
            'stop' => hasPermission(['sip_status_list', 'sip_status_stop']),
            'restart' => hasPermission(['sip_status_list', 'sip_status_restart']),
            'rescan' => hasPermission(['sip_status_list', 'sip_status_rescan']),
            'flush' => hasPermission(['sip_status_list', 'sip_status_flush']),
        ];

        $data = $this->getSofiaStatus();
        return view('did_numbers.index', compact('record', 'operationPermission', 'data'));
    }

    public function getSofiaStatus()
    {
        // socket connection
        $obj = new Registrations;
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

    public function update(Request $request, SofiaConf $sofiaConf)
    {
        //
    }
}
