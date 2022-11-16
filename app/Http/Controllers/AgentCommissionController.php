<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgentCommission;
use App\Http\Requests\AgentCommissionStoreRequest;
use App\Models\Agent;
use App\Models\AgentCommissionPayment;
use Illuminate\Support\Facades\DB;

class AgentCommissionController extends Controller
{
    public function index($id)
    {
        // DB::enableQueryLog();
        $row = 10;
        if (request('row') != '')
        $row = request('row');

        $agentcommissions = AgentCommission::where('agent_id',$id)->orderBy('id', 'DESC');

        if (request('search') != '') {
            $agentcommissions = $agentcommissions->search(request('search'), null, true, true)->distinct();
        }

        $agentcommissions = $this->getSearch($agentcommissions);
        
        $agentcommissions = $agentcommissions->paginate($row); //display 10 records

        $agent = Agent::where('id',$id)->first();

        // dd(\DB::getQueryLog());
        
        return view('agentCommission.index',compact('agentcommissions','id','agent'));    
    }

    public function create($id)
    {
        $agent = Agent::where('id',$id)->first();
        $payments = ['CASH' => 'CASH','CHEQUE' => 'CHEQUE','WIRE' => 'WIRE','VISA' => 'VISA','MASTERCARD' => 'MASTERCARD'];
        return view('agentCommission.create',compact('id','payments','agent'));
    }

    public function store(AgentCommissionStoreRequest $request,$id)
    {
        $input = $request->except(['_token','_method']);
        $input['agent_id'] = $id;
        $agentcommissionpayment = AgentCommissionPayment::create($input);

        $commission = new AgentCommission();
        $commission->agent_id = $id;
        $commission->summary = 'Commission Payment';
        $commission->amount = $agentcommissionpayment->amount;
        $commission->debit = $agentcommissionpayment->amount;
        $commission->balance = $agentcommissionpayment->balance - $agentcommissionpayment->amount;
        $commission->payment_id = $agentcommissionpayment->id;
        $commission->save();

        $agent = Agent::where('id',$id)->first();
        $agent->balance = $agent->balance - $agentcommissionpayment->amount;
        $agent->save();

        return redirect()->route('agentCommission.index',$id)->with('success','Payment received successfully!');
    }

    private function getSearch($query)
    {
        if (request('start_date') != '' && request('end_date') != '')
        {
            $from = date("Y-m-d ")."00:00:00";
            $to = date("Y-m-d ")."23:59:59";
            $query = $query->whereBetween('created_date', [$from, $to]);
        }
        return $query; 
    }
}
