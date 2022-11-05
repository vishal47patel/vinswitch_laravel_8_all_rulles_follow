<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OriginationBillPlan; 
use App\Models\OriginationRatePlan;
use App\Http\Requests\OriginationBillStoreRequest;  
use App\Http\Requests\OriginationBillUpdateRequest;

class OriginationBillPlanController extends Controller
{
    public function index()
    {    
        $row = 10;
        if (request('row') != '')
        $row = request('row');

        $OriginationBillPlans = OriginationBillPlan::orderBy('id', 'DESC');
        
        if (request('search') != '') {
            $OriginationBillPlans = $OriginationBillPlans->search(request('search'), null, true, true)->distinct();
        }

        $OriginationBillPlans = $OriginationBillPlans->paginate($row); //display 10 records
        $operationPermission = [
            'create' => hasPermission(['origination_bill_list','origination_bill_create']),
            'update' => hasPermission(['origination_bill_list','origination_bill_update']),
            'delete' => hasPermission(['origination_bill_list','origination_bill_delete'])
        ]; 

        return view('originationBillPlan.index',compact('OriginationBillPlans', 'operationPermission'));
    }

    public function create()
    {
        $OriginationRatePlans = OriginationRatePlan::get();
        return view('originationBillPlan.create',compact('OriginationRatePlans'));
    }

    public function store(OriginationBillStoreRequest $request)
    {
        $input = $request->except(['_token','_method']);
        $OriginationBillPlan = OriginationBillPlan::create($input);
       
        return redirect()->route('originationBillPlan.index')->with('success','Origination Bill Plan has been created successfully!');
    }

    public function edit($id)
    {   
        $OriginationBillPlan = OriginationBillPlan::findorfail($id);
        $OriginationRatePlans = OriginationRatePlan::get();
        return view('originationBillPlan.edit',compact('OriginationBillPlan','OriginationRatePlans'));
        
    }

    public function update(OriginationBillUpdateRequest $request,$id)
    {
        $input = $request->except(['_token','_method']);
        $OriginationBillPlan = OriginationBillPlan::where('id',$id)->first();
        $OriginationBillPlan->update($input);

        return redirect()->route('originationBillPlan.index')->with('success','Origination Bill Plan has been updated successfully!');
       
    }

    public function destroy($id)
    {    
        $OriginationBillPlan = OriginationBillPlan::find($id)->delete();

        return redirect()->route('originationBillPlan.index')->with('success','Origination Bill Plan has been deleted successfully');
    }

    public function changeStatus($id)
    {    
        $OriginationBillPlan = OriginationBillPlan::where('id','=',$id)->first();
        $OriginationBillPlan->origination_enable = $OriginationBillPlan->origination_enable == "INACTIVE" ? "ACTIVE" : "INACTIVE";
        $OriginationBillPlan->save();
        return redirect()->route('originationBillPlan.index');
    }
}
