<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\NpaNxxMaster;
use App\Http\Requests\npaNxxMasterStoreRequest;
use App\Http\Requests\npaNxxMasterUpdateRequest;

class NpaNxxMasterController extends Controller
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

        $npaNxxMaster = NpaNxxMaster::orderBy('id', 'DESC');
        
        if (request('search') != '') {
            $npaNxxMaster = $npaNxxMaster->search(request('search'), null, true, true)->distinct();
        }

        $operationPermission = [
            'create' => hasPermission(['npaNxxMaster_list','npaNxxMaster_create']),
            'update' => hasPermission(['npaNxxMaster_list','npaNxxMaster_update']),
            'detail' => hasPermission(['npaNxxMaster_list','npa_nxx_detail_list']),
            'delete' => hasPermission(['npaNxxMaster_list','npaNxxMaster_delete'])
        ];
        $npaNxxMaster = $npaNxxMaster->paginate($row); //display 10 records
        return view('npaNxxMaster.index',compact('npaNxxMaster', 'operationPermission'));    
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('npaNxxMaster.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(npaNxxMasterStoreRequest $request)
    {
        $input = $request->all();
        if(isset( $input['isdefault']) &&  $input['isdefault'] == "YES")
		{
            $npaNxxMaster = npaNxxMaster::where('isdefault', '=', "YES")->update(array('isdefault' => "NO"));
        }
        $npaNxxMaster= npaNxxMaster::create($input);
        return redirect()->route('npaNxxMaster.index')->with('success','npaNxxMaster created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $npaNxxMaster = npaNxxMaster::findorfail($id);
        return view('npaNxxMaster.edit',compact('npaNxxMaster'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(npaNxxMasterUpdateRequest $request, $id)
    {
        if(isset( $request['isdefault']) &&  $request['isdefault'] == "YES")
		{
            $npaNxxMaster =  npaNxxMaster::where('isdefault', '=', "YES")->update(array('isdefault' => "NO"));
        }
        $npaNxxMaster = npaNxxMaster::where('id', $id)->first();
        $npaNxxMaster->name = $request->name;
        $npaNxxMaster->isdefault = $request->isdefault;
        $npaNxxMaster->update();
        
        return redirect()->route('npaNxxMaster.index')
                        ->with('success','npaNxxMaster updated successfully');
    }
    public function show($id)
    {
        $npaNxxMaster = npaNxxMaster::findorfail($id);
        return redirect()->route('NpaNxxDetail.index',$id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $npaNxxMaster = npaNxxMaster::find($id)->delete();
        return redirect()->route('npaNxxMaster.index')
                        ->with('success','npaNxxMaster deleted successfully');
    }
}
