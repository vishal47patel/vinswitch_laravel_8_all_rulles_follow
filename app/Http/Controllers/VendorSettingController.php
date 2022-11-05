<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorSettingStoreRequest;
use App\Http\Requests\VendorSettingUpdateRequest;
use App\Models\VendorSetting;
use Illuminate\Http\Request;

class VendorSettingController extends Controller
{
    // view create page
    public function create($vendor_id)
    {
        return view('vendor_settings.create', compact('vendor_id'));
    }

    // insert record
    public function store(VendorSettingStoreRequest $request)
    {        
        $input = $request->only('setting_key','setting_value', 'vendor_id');       
        VendorSetting::create($input);
        return redirect()->route('vendor.settings.index', ['vendor_id' => $input['vendor_id']])->with('success', 'Vendor Setting created successfully.');
    }

    // display edit page
    public function edit($id, $vendor_id='', VendorSetting $vendor_setting)
    {
        $record = $vendor_setting->find($id);        
        if (empty($record)) {           
            return redirect()->route('vendor.settings.index')->with('danger', 'Somthing Wrong!');
        }
        return view('vendor_settings.edit', compact('record', 'vendor_id'));
    }

    // update record
    public function update($id, VendorSettingUpdateRequest $request, VendorSetting $vendor_setting)
    {
        $data['vendor_id'] = $request->vendor_id;
        $input = $request->only('setting_value');
        $vendor_setting->where('id', $id)->update($input);
        return redirect()->route('vendor.settings.index', $data)
            ->with('success', 'Vendor Setting updated successfully');
    }

    // delete record
    public function destroy($id, $vendor_id='', VendorSetting $vendor_setting)
    {
        $data['vendor_id'] = $vendor_id;
        $record = $vendor_setting->find($id);        
        if (empty($record)) {           
            return redirect()->route('vendor.settings.index')->with('danger', 'Somthing Wrong!');
        }
        $record->delete();
        return redirect()->route('vendor.settings.index', $data)
                        ->with('success','Vendor Setting deleted successfully');
    }
}
