<?php

namespace App\Http\Controllers;

use App\Http\Requests\AclNodesStoreRequest;
use App\Http\Requests\AclNodesUpdateRequest;
use App\Libraries\FreeSwitch;
use App\Models\AclList;
use App\Models\AclNodes;
use Illuminate\Http\Request;

class AclNodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $row = 10;
        if (request('row') != '')
        $row = request('row');
        $acllist = AclList::all();
        $aclnodes = AclNodes::orderBy('id', 'DESC');
        
        

        if (request('search') != '') {
            $aclnodes = $aclnodes->search(request('search'), null, true, true)->distinct();
        }

        $aclnodes = $this->getSearch($aclnodes);   

        $aclnodes = $aclnodes->paginate($row); //display 10 records
        
        $operationPermission = [
            'create' => hasPermission(['aclnodes_list', 'aclnodes_create']),
            'update' => hasPermission(['aclnodes_list', 'aclnodes_update']),
            'delete' => hasPermission(['aclnodes_list', 'aclnodes_delete'])
        ];
        
        return view('aclnodes.index',compact('aclnodes','operationPermission','acllist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $acllist = AclList::all();
        FreeSwitch::aclNodeCommand();
        return view('aclnodes.create',compact('acllist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AclNodesStoreRequest $request)
    {
        $input = $request->except(['_token','_method']);
        AclNodes::create($input);
        return redirect()->route('aclnodes.index')->with('success', 'ACL added successfully!');
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
        $acllist = AclList::all();
        $aclnodes = AclNodes::find($id);
        
        if (empty($aclnodes)) {           
            return redirect()->route('aclnodes.index')->with('danger', 'Somthing Wrong!');
        }        
        return view('aclnodes.edit', compact('aclnodes','acllist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AclNodesUpdateRequest $request, $id)
    {
        
        $input = $request->except(['_token','_method']);
        FreeSwitch::aclNodeCommand();
        $aclnodes = AclNodes::where('id',$id)->first();
        $aclnodes->update($input);

        return redirect()->route('aclnodes.index')->with('success','Acl updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AclNodes::find($id)->delete();
        FreeSwitch::aclNodeCommand();
        return redirect()->route('aclnodes.index')->with('success','Acl deleted successfully');
    }

    public function changeType($id)
    {
        $aclnodes = AclNodes::where('id', '=', $id)->first();
        $aclnodes->type = $aclnodes->type == "deny" ? "allow" : "deny";
        $aclnodes->save();
        return redirect()->route('aclnodes.index');
    }

    private function getSearch($query)
    {
        if ( request('id') != '' )
        $query = $query->where('id', 'like', '%'.request('id').'%');
        
        if ( request('cidr') != '' )
        $query = $query->where('cidr', 'like', '%'.request('cidr').'%');
        
        if ( request('type') != '' )
        $query = $query->where('type', 'like', '%'.request('type').'%');

        if ( request('list_id') != '' )
        $query = $query->where('list_id', 'like', '%'.request('list_id').'%');

       
        return $query; 
    }

}
