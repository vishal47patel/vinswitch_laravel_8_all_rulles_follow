<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorStoreRequest;
use App\Http\Requests\VendorUpdateRequest;
use App\Models\Vendor;
use App\Models\VendorSetting;

class VendorController extends Controller
{
    // redirect to listing page
    public function index()
    {
        $row = 10;
        if (request('row') != '')
            $row = request('row');

        if (request('vendor_id') != '') {
            $vendor_id = request('vendor_id');
            
        }else{
            $vendors_id = Vendor::orderBy('id', 'DESC')->first();
            $vendor_id = $vendors_id->id;
        }

        $vendors = Vendor::orderBy('id', 'DESC');
        $vendor = Vendor::find($vendor_id);          
        
        $vendorsettings = VendorSetting::orderBy('id', 'DESC');        
        
        if (request('search') != '')
            $vendors = $vendors->search(request('search'), null, true, true)->distinct();        
        
        $vendors = $this->getSearch($vendors);

        if (request('search') != '' || request('vendor_name')){
            if($vendors->count() > 0 ){                
                $vendors_data = Vendor::orderBy('id', 'DESC');
                $vendors_data = $vendors_data->search((request('vendor_name') != '') ? request('vendor_name') : request('search'), null, true, true)->distinct();
                $vendor = $vendors_data->first();
                $vendor_id = $vendor->id;  
            }
        }

        $vendorsettings = $vendorsettings->where('vendor_id', $vendor_id);
        if(request('search2') != '')        
            $vendorsettings = $vendorsettings->search(request('search2'), null, true, true)->distinct();

        $vendors = $vendors->paginate($row);
        $vendorsettings = $vendorsettings->paginate($row);
        
        $record['vendor_name'] = $vendor->vendor_name;
        $record['vendor_id'] = $vendor->id;
        $record = (object)$record;

        $operationPermission = [
            'create' => hasPermission(['vendor_list', 'vendor_create']),
            'update' => hasPermission(['vendor_list', 'vendor_update']),
            'delete' => hasPermission(['vendor_list', 'vendor_delete']),
            'create_setting' => hasPermission(['vendor_setting_list', 'vendor_setting_create']),
            'update_setting' => hasPermission(['vendor_setting_list', 'vendor_setting_update']),
            'delete_setting' => hasPermission(['vendor_setting_list', 'vendor_setting_delete'])
        ];

        return view('vendors.index', compact('vendors', 'operationPermission', 'vendorsettings', 'record'));
    }

    // view create page
    public function create()
    {
        return view('vendors.create');
    }

    // insert record
    public function store(VendorStoreRequest $request)
    {
        unset($request['_token']);
        $input = $request->all();
        Vendor::create($input);
        return redirect()->route('vendors.index')->with('success', 'Vendor created successfully.');
    }

    // display edit page
    public function edit($id, Vendor $vendor)
    {
        $record = $vendor->find($id);        
        if (empty($record)) {           
            return redirect()->route('vendors.index')->with('danger', 'Somthing Wrong!');
        }
        return view('vendors.edit', compact('record'));
    }

    // update record
    public function update($id, VendorUpdateRequest $request, Vendor $vendor)
    {
        unset($request['_token']);
        $input = $request->all();
        $vendor->where('id', $id)->update($input);
        return redirect()->route('vendors.index')
            ->with('success', 'Vendor updated successfully');
    }

    // delete record
    public function destroy($id, Vendor $vendor, VendorSetting $vendorSetting)
    {
        $record = $vendor->find($id);        
        if (empty($record)) {           
            return redirect()->route('vendors.index')->with('danger', 'Somthing Wrong!');
        }
        $record->delete();
        return redirect()->route('vendors.index')
                        ->with('success','Vendor deleted successfully');
    }

    // listing page update status 
    public function actionUpdatestatus($id, $column, $value = '', Vendor $vendor)
    {
        $vendor_record = $vendor->find($id);
        if (empty($vendor_record)) {           
            return redirect()->route('vendors.index')->with('danger', 'Somthing Wrong!');
        }
        
        if ($vendor_record) {

            if ($column == 'status') {
                $vendor_record->status = ($value == "ENABLE") ? "DISABLE" : "ENABLE";
                $column = "Status";
            } else if ($column == 'priority') {
                $vendor_record->priority = $value  ? $value : 1;
                $column = "Priority";
            }

            if ($vendor_record->save()) {
                return redirect()->route('vendors.index')
                    ->with('success', $column . ' updated successfully');
            }else{
                return redirect()->route('vendors.index')
                    ->with('danger', 'Status not updated');
            }
        }
    }

    //search
    private function getSearch($query){

        if(request('vendor_name') != '')
        $query = $query->where('vendor_name', 'LIKE', '%'.request('vendor_name').'%');

        return $query;
    }
}
