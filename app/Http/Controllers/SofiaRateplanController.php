<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SofiaPlangateway;
use App\Models\Gateway;
use App\Models\SofiaRate;
use App\Models\BillplanOutboundRate;
use App\Models\SofiaRateplan;   
use App\Http\Requests\TerminationRateStoreRequest;

class SofiaRateplanController extends Controller
{
    public function index()
    {
        $row = 10;
        if (request('row') != '')
        $row = request('row');

        $sofiarateplans = SofiaRateplan::orderBy('id', 'DESC');
        
        if (request('search') != '') {
            $sofiarateplans = $sofiarateplans->search(request('search'), null, true, true)->distinct();
        }

        $sofiarateplans = $sofiarateplans->paginate($row); //display 10 records
        $operationPermission = [
            'create' => hasPermission(['termination_rateplan_list','termination_rateplan_create']),
            'update' => hasPermission(['termination_rateplan_list','termination_rateplan_update']),
            'delete' => hasPermission(['termination_rateplan_list','termination_rateplan_delete'])
        ];
        
        return view('sofiaRateplan.index',compact('sofiarateplans', 'operationPermission'));    
    }
    public function create()
    {
        $sofiaplanways = SofiaPlangateway::get();
        $gateways = Gateway::get();
        return view('sofiaRateplan.create',compact('sofiaplanways','gateways'));
    }

    public function store(TerminationRateStoreRequest $request)
    {
        $input = $request->except(['_token','_method']);
        $sofiarateplans = SofiaRateplan::create($input);
        $i = 1;
        foreach ($request->gateway_id as $k) {

            $sofiaplanGateway = new SofiaPlangateway;
            $sofiaplanGateway->plan_id = $sofiarateplans->id;
            $sofiaplanGateway->gateway_id = $k;
            $sofiaplanGateway->priority = $i++;
            $sofiaplanGateway->save();
        }

        return redirect()->route('sofiaRateplan.index')->with('success','Termination rate plan has been created successfully!');
    }

    public function show($id)
    {
        $SofiaRateplan = SofiaRateplan::findorfail($id);
        $SofiaPlangateways = SofiaPlangateway::where('plan_id','=',$id)->get();
        return view('sofiaRateplan.show',compact('SofiaRateplan','SofiaPlangateways'));
    }

    public function edit($id)
    {   
        $sofiarateplan = SofiaRateplan::findorfail($id);
        $gateway_ids = $sofiarateplan->sofia_plangateways->pluck('gateway_id');

        $gateways = Gateway::whereNotIn('id', $gateway_ids)->get();
        return view('sofiaRateplan.edit',compact('sofiarateplan','gateways'));
        
    }

    public function update(TerminationRateStoreRequest $request,$id)
    {
        $input = $request->except(['_token','_method']);
        $sofiarateplans = SofiaRateplan::where('id',$id)->first();
        $sofiarateplans->update($input);

        $i = 1;

        if(isset($request->gateway_id) && !empty($request->gateway_id))
        {
            SofiaPlangateway::where('plan_id','=',$id)->delete();
            foreach ($request->gateway_id as $k) {
                $sofiaplanGateway = new SofiaPlangateway;
                $sofiaplanGateway->plan_id = $sofiarateplans->id;
                $sofiaplanGateway->gateway_id = $k;
                $sofiaplanGateway->priority = $i++;
                $sofiaplanGateway->save();
            }
        }
        

       return redirect()->route('sofiaRateplan.index')->with('success','Termination rate plan has been updated successfully!');
       
    }

    public function destroy($id)
    {    
        $SofiaRate = SofiaRate::where('plan_id','=',$id)->get();
        $BillplanOutboundRate = BillplanOutboundRate::where('rateplan_id','=',$id)->first();

        if (empty($BillplanOutboundRate)) {
            $SofiaPlangateway = SofiaPlangateway::where('plan_id','=',$id)->delete();
            $SofiaRate = SofiaRate::where('plan_id','=',$id)->delete();
        }
        elseif(!empty($BillplanOutboundRate))
        {
            $billplan = $BillplanOutboundRate->billplan->name;
            return redirect()->route('sofiaRateplan.index')->with('danger','This plan is assign to '.$billplan.' bill plan , so you can not deleted it.');
        }
        
        return redirect()->route('sofiaRateplan.index')->with('success','Termination bill plan has been deleted successfully');
    }

    public function changeStatus($id)
    {    
        $sofiarateplans = SofiaRateplan::where('id','=',$id)->first();
        $sofiarateplans->status = $sofiarateplans->status == "INACTIVE" ? "ACTIVE" : "INACTIVE";
        $sofiarateplans->save();
        return redirect()->route('sofiaRateplan.index');
    }

}
