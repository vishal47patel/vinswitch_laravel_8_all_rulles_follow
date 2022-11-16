<?php

namespace App\Http\Controllers;

use App\Libraries\EventSocket;
use App\Libraries\SocketConnection;
use App\Models\FreeswitchServer;
use Exception;
use Illuminate\Http\Request;

class SwitchcliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $freeswitchServers = FreeswitchServer::all();

        return view('switchcli.index', compact('freeswitchServers'));
    }

    public function getswitchcli(){
        $response = [];
        $cmd = request('freeswitch_command');
        $command ='api '.$cmd;
        //$fp = $this->_event_socket_create();
        
        $data = FreeswitchServer::find(request('host_id'));
        // dd($data);
        $host = $password = $port = "";
        if ($data == ''|| $data == null) {
            echo ''; exit;
        }else{
            $host =  $data->freeswitch_host;
            $password = $data->freeswitch_password;
            $port = $data->freeswitch_port;
        }
       
        try{
            $esl = new EventSocket;
        
            $esl->connect($host, $port,$password);
          
            $fp = $esl->reset_fp();
    
            $response = SocketConnection::_event_socket_request($fp, $command);
        }catch(Exception $e){
            $response['result'] = $e->getMessage();
        }

        $data = ['response' => $response,'cmd' => $cmd];
        
        return response()->json($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
