<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Service;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;

class ServiceController extends Controller
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

        $services = Service::orderBy('id', 'DESC');
        
        if (request('search') != '') {
            $services = $services->search(request('search'), null, true, true)->distinct();
        }

        $services = $this->getSearch($services);  

        $services = $services->paginate($row); //display 10 records
        $operationPermission = [
            'create' => hasPermission(['service_list','service_create']),
            'update' => hasPermission(['service_list','service_update']),
            'delete' => hasPermission(['service_list','service_delete'])
        ];
        
        return view('services.index',compact('services', 'operationPermission'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceStoreRequest $request)
    {
        $input = $request->all();
        $service = Service::create($input);
        return redirect()->route('services.index')->with('success','service created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findorfail($id);
        return view('services.edit',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceUpdateRequest $request, $id)
    {
        $service = Service::where('id', $id)->first();
        $service->service_type = $request->service_type;
        $service->service_description = $request->service_description;
        $service->update();
        
        return redirect()->route('services.index')
                        ->with('success','service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id)->delete();
        return redirect()->route('services.index')
                        ->with('success','service deleted successfully');
    }
    private function getSearch($query)
    {
        if ( request('service_type') != '' )
        $query = $query->where('service_type', 'like', '%'.request('service_type').'%');

        return $query; 
    }
}
