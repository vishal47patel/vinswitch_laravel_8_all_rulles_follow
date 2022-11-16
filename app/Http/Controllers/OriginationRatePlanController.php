<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OriginationRatePlan;
use App\Models\Service;
use App\Models\ServiceType;
use App\Http\Requests\OriginationRatePlanStoreRequest;
use App\Http\Requests\OriginationRatePlanUpdateRequest;

class OriginationRatePlanController extends Controller
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

        $OriginationRatePlan = OriginationRatePlan::orderBy('id', 'DESC');

        if (request('search') != '') {
            $OriginationRatePlan = $OriginationRatePlan->search(request('search'), null, true, true)->distinct();
        }
        $OriginationRatePlan = $this->getSearch($OriginationRatePlan);  

        $operationPermission = [
            'create' => hasPermission(['origination_rate_plan_list', 'origination_rate_plan_create']),
            'update' => hasPermission(['origination_rate_plan_list', 'origination_rate_plan_update']),
            'view' => hasPermission(['origination_rate_plan_list', 'origination_rate_plan_view']),
            'delete' => hasPermission(['origination_rate_plan_list', 'origination_rate_plan_delete'])
        ];
        $OriginationRatePlan = $OriginationRatePlan->paginate($row); //display 10 records

        return view('origination_rateplan.index', compact('OriginationRatePlan', 'operationPermission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $service = Service::get();
        return view('origination_rateplan.create', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OriginationRatePlanStoreRequest $request)
    {
        $OriginationRatePlan = new  OriginationRatePlan;
        $ser = [];
        if (isset($request['moreFields']) || isset($request['moreFields'])) {
            $service = $request['moreFields'];
            foreach ($service as $k => $value) {

                if (in_array($value['service_type'], $ser)) {

                    return redirect()->route('origination_rateplan.create')->with('danger', 'Please select different service type. You cant  choose same Service type in same Origination Rate Plan.');
                }
                $ser[$k] = $value['service_type'];
            }
        }

        $OriginationRatePlan->name = $request->name;
        $OriginationRatePlan->description = $request->description;
        $OriginationRatePlan->save();
        $service = $request['moreFields'];

        if ($service != '') {
            foreach ($service as $k => $value) {
                $servicetype = new ServiceType;
                $servicetype->rate_plan_id =     $OriginationRatePlan->id;
                $servicetype->service_type =     $value['service_type'];
                $servicetype->did_price =     $value['did_price'];
                $servicetype->setup_fee =     $value['setup_fee'];
                $servicetype->inbound_sms_price =     $value['inbound_sms_price'];
                $servicetype->e911_price = $value['e911_price'];
                $servicetype->cnam_price = $value['cnam_price'];
                $servicetype->inbound_min_rate =     $value['inbound_min_rate'];
                $servicetype->inbound_channel_limit = $value['inbound_channel_limit'];
                $servicetype->save();
            }
        }
        return redirect()->route('origination_rateplan.index')->with('success', 'origination rateplan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $OriginationRatePlan = OriginationRatePlan::findorfail($id);

        $service = Service::get();
        $servicetype = ServiceType::with(['servicetype'])->where('rate_plan_id', $id)->get();


        return view('origination_rateplan.show', compact('OriginationRatePlan', 'service', 'servicetype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $OriginationRatePlan = OriginationRatePlan::findorfail($id);

        $service = Service::get();
        $servicetype = ServiceType::with(['servicetype'])->where('rate_plan_id', $id)->get();
        return view('origination_rateplan.edit', compact('OriginationRatePlan', 'service', 'servicetype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OriginationRatePlanUpdateRequest $request, $id)
    {
        $OriginationRatePlan = OriginationRatePlan::where('id', $id)->first();

        $ser = [];
        if (isset($request['moreFields']) || isset($request['moreFields'])) {
            $service = $request['moreFields'];

            foreach ($service as $k => $value) {

                if (in_array($value['service_type'], $ser)) {
                    return redirect()->route('origination_rateplan.edit', $id)->with('danger', 'Please select different service type. You cant  choose same Service type in same Origination Rate Plan.');
                }
                $ser[$k] = $value['service_type'];
            }
        }

        $OriginationRatePlan->name = $request->name;
        $OriginationRatePlan->description = $request->description;
        $OriginationRatePlan->update();

        $deletedRows = ServiceType::with(['servicetype'])->where('rate_plan_id', $id)->delete();
        $service = $request['moreFields'];
        if ($service != '') {

            foreach ($service as $k => $value) {

                $servicetype = new ServiceType;

                $servicetype->rate_plan_id =     $id;
                $servicetype->service_type =     $value['service_type'];
                $servicetype->did_price =     $value['did_price'];
                $servicetype->setup_fee =     $value['setup_fee'];
                $servicetype->inbound_sms_price =     $value['inbound_sms_price'];
                $servicetype->e911_price = $value['e911_price'];
                $servicetype->cnam_price = $value['cnam_price'];
                $servicetype->inbound_min_rate =     $value['inbound_min_rate'];
                $servicetype->inbound_channel_limit = $value['inbound_channel_limit'];
                $servicetype->save();
            }
        }
        return redirect()->route('origination_rateplan.index')
            ->with('success', 'Origination rate plan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $OriginationRatePlan = OriginationRatePlan::find($id)->delete();
        return redirect()->route('origination_rateplan.index')
            ->with('success', 'Origination rate plan deleted successfully');
    }

    private function getSearch($query)
    {
        if ( request('name') != '' )
        $query = $query->where('name', 'like', '%'.request('name').'%');
        
        if ( request('did_price') != '' )
        $query = $query->where('did_price', 'like', '%'.request('did_price').'%');

        if ( request('setup_fee') != '' )
        $query = $query->where('setup_fee', 'like', '%'.request('setup_fee').'%');

        if ( request('inbound_min_rate') != '' )
        $query = $query->where('inbound_min_rate', 'like', '%'.request('inbound_min_rate').'%');

        if ( request('inbound_channel_limit') != '' )
        $query = $query->where('inbound_channel_limit', 'like', '%'.request('inbound_channel_limit').'%');

        return $query; 
    }
}
