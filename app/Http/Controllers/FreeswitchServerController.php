<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\FreeswitchServer;
use App\Http\Requests\FreeswitchServerStoreRequest;
use App\Http\Requests\FreeswitchServerUpdateRequest;

class FreeswitchServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $row = 10;
        if (request('row') != '')
        $row = request('row');

        $freeswitchserver = FreeswitchServer::orderBy('id', 'DESC');
        
        if (request('search') != '') {
            $freeswitchserver = $freeswitchserver->search(request('search'), null, true, true)->distinct();
        }
        $freeswitchserver = $this->getSearch($freeswitchserver);        

        $operationPermission = [
            'create' => hasPermission(['freeswitch_server_list','freeswitch_server_create']),
            'update' => hasPermission(['freeswitch_server_list','freeswitch_server_update']),
            'delete' => hasPermission(['freeswitch_server_list','freeswitch_server_delete'])
        ];
        $freeswitchserver = $freeswitchserver->paginate($row); //display 10 records
        return view('freeswitchServer.index',compact('freeswitchserver', 'operationPermission'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('freeswitchServer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FreeswitchServerStoreRequest $request)
    {
        $input = $request->all();
        $freeswitchserver = FreeswitchServer::create($input);
        return redirect()->route('freeswitchServer.index')->with('success','Freeswitch server created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $freeswitchserver = FreeswitchServer::findorfail($id);
        return view('freeswitchServer.edit',compact('freeswitchserver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FreeswitchServerUpdateRequest $request, $id)
    {
        $freeswitchserver = FreeswitchServer::where('id', $id)->first();
        $freeswitchserver->freeswitch_host = $request->freeswitch_host;
        $freeswitchserver->freeswitch_password = $request->freeswitch_password;
        $freeswitchserver->freeswitch_port = $request->freeswitch_port;
        $freeswitchserver->update();
        
        return redirect()->route('freeswitchServer.index')
                        ->with('success','Freeswitch Server updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $freeswitchserver = FreeswitchServer::find($id)->delete();
        return redirect()->route('freeswitchServer.index')
                        ->with('success','Freeswitch Server deleted successfully');
    }
    private function getSearch($query)
    {
        if ( request('id') != '' )
        $query = $query->where('id', 'like', '%'.request('id').'%');

        if ( request('freeswitch_host') != '' )
        $query = $query->where('freeswitch_host', 'like', '%'.request('freeswitch_host').'%');
        
        if ( request('freeswitch_port') != '' )
        $query = $query->where('freeswitch_port', 'like', '%'.request('freeswitch_port').'%');

        if ( request('status') != '' )
        $query = $query->where('status', 'like', '%'.request('status').'%');

        return $query; 
    }
}
