<?php

namespace App\Http\Controllers;

use App\Http\Requests\GatewayStoreRequest;
use App\Http\Requests\GatewayUpdateRequest;
use App\Libraries\FreeSwitch;
use App\Models\Gateway;
use App\Models\SofiaGateway;
use App\Models\SofiaPlangateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GatewayController extends Controller
{
    //redirect to index page
    public function index(Request $request)
    {
        $row = 10;
        if (request('row') != '')
            $row = request('row');

        $gateways = Gateway::orderBy('id', 'DESC');

        if (request('search') != '') {
            $gateways = $gateways->search(request('search'), null, true, true)->distinct();
        }

        $gateways = $this->getSearch($gateways);        

        $gateways = $gateways->paginate($row); 
        $operationPermission = [
            'create' => hasPermission(['gateway_list', 'gateway_create']),
            'update' => hasPermission(['gateway_list', 'gateway_update']),
            'delete' => hasPermission(['gateway_list', 'gateway_delete'])
        ];

        return view('gateways.index', compact('gateways', 'operationPermission'));
    }

    //redirect to create page
    public function create()
    {
        return view('gateways.create');
    }

    //insert data
    public function store(GatewayStoreRequest $request)
    {
        $gateway_id = '';
        $input = $request->all();
        $gateways = Gateway::get();
        if ($gateways->count() == 0) {
            $input['outbound_default'] = 'YES';
        }

        $gateway = Gateway::create($input);


        if ($gateway) {
            $gateway_id = $gateway->id;
            if ($request->outbound_default == 'YES') {

                $sofia_update = SofiaGateway::where('gateway_param', 'outbound_default')->update(array('gateway_value' => 'NO'));
                $gateway_update = Gateway::where('outbound_default', 'YES')->update(array('outbound_default' => 'NO'));
            }

            if ($gateway_id != '') {
                $gateway_update = Gateway::where('id', $gateway_id)->first();
                $gateway_update->outbound_default = $request->outbound_default;
                $gateway_update->update();

                SofiaGateway::addSofiaGateway($input, $gateway_id);
                FreeSwitch::gatewayCommand($input['register'], $input['gateway_name']);
            }
        }

        return redirect()->route('gateways.index')->with('success', 'Gateway added successfully!');
    }

    // redirect to update page
    public function edit($id)
    {
        $gateway = Gateway::find($id);       
        if (empty($gateway)) {           
            return redirect()->route('gateways.index')->with('danger', 'Somthing Wrong!');
        }        
        return view('gateways.edit', compact('gateway'));
    }

    // update data
    public function update(GatewayUpdateRequest $request, $id)
    {
        $gateway_id = $id;
        $input = $request->all();
        unset($input['_token']);

        if ($request->outbound_default == 'YES') {

            $sofia_update = SofiaGateway::where('gateway_param', 'outbound_default')->update(array('gateway_value' => 'NO'));

            $gateway_update = Gateway::where('outbound_default', 'YES')->update(array('outbound_default' => 'NO'));
        }

        Gateway::where('id', $gateway_id)->update($input);
        SofiaGateway::addSofiaGateway($input, $gateway_id);
        FreeSwitch::EditgatewayCommand($input['register'], $input['gateway_name']);
        return redirect()->route('gateways.index')
            ->with('success', 'Gateway updated successfully');
    }

    //delete data
    public function destroy($id)
    {
        $checkgateway = SofiaPlangateway::where('gateway_id', $id);
        if ($checkgateway->count() == 0) {

            $gateway = Gateway::find($id);
            if (empty($gateway)) {           
                return redirect()->route('gateways.index')->with('danger', 'Somthing Wrong!');
            }
            SofiaGateway::where('gateway_id', $id)->delete();
            FreeSwitch::deletegatewayCommand($gateway['gateway_name']);
            $gateway->delete();
            return redirect()->route('gateways.index')
                ->with('success', 'Gateway deleted successfully');
        } else {

            $checkgateway = $checkgateway->first();
            $plan = '';
            if ($checkgateway) {
                $plan = $checkgateway->sofia_rateplan->plan_name;
            }

            return redirect()->route('gateways.index')
                ->with('danger', "Gateway is assign to $plan rate plan, so you can not deleted it.");
        }
    }

    // update register status
    public function changeType($id)
    {
        $gateway = Gateway::where('id', '=', $id)->first();
        $gateway->register = $gateway->register == "FALSE" ? "TRUE" : "FALSE";
        $gateway->save();

        if ($gateway->register == "FALSE") {
            FreeSwitch::deletegatewayCommand($gateway->gateway_name);
        } else {
            FreeSwitch::gatewayCommand($gateway->register, $gateway->gateway_name);
        }
        return redirect()->route('gateways.index');
    }

    // update outbound status
    public function changeDefault($id)
    {
        $gateway = Gateway::find($id);
        if ($gateway->outbound_default == "YES") {
            $existGateway =  Gateway::where('id', '!=', $id)->first();
            if (!empty($gateway)) {
                $gateway->outbound_default = "NO";
                $existGateway->outbound_default = 'YES';
                $existGateway->save();
            } else {
                $gateway->outbound_default = "YES";
            }
        } else {
            SofiaGateway::where('gateway_param', 'outbound_default')->update(['gateway_value' => 'NO']);
            Gateway::where('outbound_default', 'YES')->update(['outbound_default' => 'NO']);
            SofiaGateway::where('gateway_param', 'outbound_default')->where('gateway_id', $id)->update(['gateway_value' => 'YES']);
            $gateway->outbound_default = "YES";
        }
        $gateway->save();
        return redirect()->route('gateways.index');
    }

    private function getSearch($query)
    {
        if ( request('gateway_name') != '' )
        $query = $query->where('gateway_name', 'like', '%'.request('gateway_name').'%');
        
        if ( request('register') != '' )
        $query = $query->where('register', 'like', '%'.request('register').'%');
        
        if ( request('hostname') != '' )
        $query = $query->where('hostname', 'like', '%'.request('hostname').'%');

        return $query; 
    }
}
