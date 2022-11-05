<?php

namespace App\Http\Controllers;
use App\Models\BillPlan;
use App\Models\BillplanOutboundRate;
use App\Models\SofiaRateplan;
use Illuminate\Http\Request;
use App\Http\Requests\TerminationBillStoreRequest;
use App\Http\Requests\TerminationBillUpdateRequest;
use App\Libraries\General;
use App\Models\Tenant;
use App\Models\TenantService;

class BillPlanController extends Controller
{
    public function index()
    {
        $row = 10;
        if (request('row') != '')
        $row = request('row');

        $billplans = BillPlan::orderBy('id', 'DESC');
        
        if (request('search') != '') {
            $billplans = $billplans->search(request('search'), null, true, true)->distinct();
        }

        $billplans = $billplans->paginate($row); //display 10 records
        $operationPermission = [
            'create' => hasPermission(['termination_billplan_list','termination_billplan_create']),
            'update' => hasPermission(['termination_billplan_list','termination_billplan_update']),
            'delete' => hasPermission(['termination_billplan_list','termination_billplan_delete'])
        ];
        
        return view('billPlan.index',compact('billplans', 'operationPermission'));    
    }
    public function create()
    {
        $sofia_rate_plans = SofiaRateplan::where('status','=','ACTIVE')->get();
        return view('billPlan.create',compact('sofia_rate_plans'));
    }

    public function store(TerminationBillStoreRequest $request)
    {
        $input = $request->except(['_token','_method']);
        $input['monthly_mins'] = General::calculateMin2Sec($request->monthly_mins);
        $billplan = BillPlan::create($input);
        $billplan->billplans()->attach($request->rateplan_id);

        return redirect()->route('billPlan.index')->with('success','Termination bill plan has been created successfully!');
    }
    public function edit($id)
    {   
        $billplans = BillPlan::findorfail($id);
        $sofiarateplans = SofiaRateplan::get();

        $sofia_rate_plan_list = array_map( function ($sofiarate) { 
            return $sofiarate['id'];
        },$billplans->sofiarateplans->toArray());

        return view('billPlan.edit',compact('billplans','sofiarateplans','sofia_rate_plan_list'));
        
    }
    public function update(TerminationBillUpdateRequest $request,$id)
    {
        $input = $request->except(['_token','_method','apply_changes','rateplan_id']);
        $input['modified_at'] = date("Y-m-d H:i:s");
        $billplan = BillPlan::where('id',$id)->first();
        $billplan->update($input);
        $billplan->billplans()->sync($request->rateplan_id);

        if(isset($request->apply_changes) && $request->apply_changes == "YES")
        {
             $tenant = BillPlan::tenantService($id);
        }

       return redirect()->route('billPlan.index')->with('success','Termination bill plan has been updated successfully!');
       
    }
    public function destroy($id)
    {    
        $outbound = BillplanOutboundRate::where('billplan_id','=',$id)->get();
        if (!empty($outbound)) {
            $outbound = BillplanOutboundRate::where('billplan_id','=',$id)->delete();
        }
        $billplan = BillPlan::find($id)->delete();

        return redirect()->route('billPlan.index')->with('success','Termination bill plan has been deleted successfully');
    }
    public function changeStatus($id)
    {    
        $billplan = BillPlan::where('id','=',$id)->first();
        $billplan->status = $billplan->status == "INACTIVE" ? "ACTIVE" : "INACTIVE";
        $billplan->save();
        return redirect()->route('billPlan.index');
    }
}
