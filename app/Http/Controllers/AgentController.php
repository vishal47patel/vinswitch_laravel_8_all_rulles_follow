<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\Tenant;
use App\Models\User;
use App\Models\BillPlan;
use App\Models\AgentBillplan;
use App\Http\Requests\AgentCustomerStoreRequest;
use App\Http\Requests\AgentAccountStoreRequest;
use App\Http\Requests\AgentBillStoreRequest;
use App\Http\Requests\AgentAccountUpdateRequest;
use App\Http\Requests\AgentResetPasswordRequest;
use Hash;
use Session;
use App\Libraries\General;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailable;
use Mail;
use App\Models\LoginCredentialMail;
use App\Models\ResetPasswordMail;

class AgentController extends Controller
{
    public function index()
    {
        $row = 10;
        if (request('row') != '')
        $row = request('row');

        $agents = Agent::orderBy('id', 'DESC');
        
        if (request('search') != '') {
            $agents = $agents->search(request('search'), null, true, true)->distinct();
        }

        $agents = $this->getSearch($agents);
        $agents = $agents->paginate($row); //display 10 records
        $operationPermission = [
            'create' => hasPermission(['agent_list','agent_create']),
            'update' => hasPermission(['agent_list','agent_update']),
        ];
        
        return view('agent.index',compact('agents', 'operationPermission'));    
    }

    public function create(Request $request)
    {
        $states = Tenant::getstate();
        $agent = Session::get('customerinfo');
        $billplans = BillPlan::getactiveBillplan();
        $agent_commission = Session::get('commission');
        $user = Session::get('accountcredential');
        $customer = Session::get('customerinfo');

        if ($request->view != '' && in_array($request->view, ['agent.customer_create', 'agent.account_create'])) {
            return view($request->view,compact('states','agent','user','customer'));
        }
        if (!empty(Session::get('accountcredential'))) {
            return view('agent.billing_create',compact('billplans','agent_commission'));
        }
        if (isset($agent) && !empty($agent)) {
            return view('agent.account_create',compact('agent'));
        }
        return view('agent.customer_create',compact('states'));
    }

    public function store(AgentCustomerStoreRequest $request)
    {
        Session::put('customerinfo', $request->all());
        return redirect()->route('agent.create');

    }

    public function accountstore(AgentAccountStoreRequest $request)
    {
        Session::put('accountcredential', $request->all());
        return redirect()->route('agent.create');
    }

    public function billstore(AgentBillStoreRequest $request)
    {
        $accountcredential = Session::get('accountcredential');
        $agent_billplan = Session::get('commission');

        if (isset($_POST) && !empty($_POST)) 
        {
            
            $request->billplan_id = (isset($_POST['billplan_id'])) ? $_POST['billplan_id'] : '' ;
            $request->commission  = (isset($_POST['commission'])) ? $_POST['commission'] : '' ; 
            
            if (isset($agent_billplan) && !empty($agent_billplan)) 
            {
                $request->billplan_id = (isset($agent_billplan[0]['billplan_id'])) ? $agent_billplan[0]['billplan_id'] : '' ;
                $request->commission  = (isset($agent_billplan[0]['commission'])) ? $agent_billplan[0]['commission'] : '' ;  
            }
            $customerinfo = Session::get('customerinfo');
            $customerinfo['account_code'] = General::generateAgentAccount_number();
            $customerinfo['join_date'] = date('Y-m-d');
            $agent = Agent::create($customerinfo);


            $accountcredential = Session::get('accountcredential');
            $password = $accountcredential['password'];
            $accountcredential['password'] = Hash::make($accountcredential['password']);
            $accountcredential['tenant_id'] = $agent->id;
            $accountcredential['role'] = 'AGENT';
            $users = User::create($accountcredential);

            //mail send start
            $fromMail = config('custom.from_mail');
            $fromMailPassword = config('custom.mail_password');
            $subjectContent = config('custom.login_content');
            $loginlink = route('login');
            if(!empty($users))
            {
                $data = ['email' => $users->email, 'subjectContent' => $subjectContent, 'fromMail' => $fromMail, 'fromMailPassword' => $fromMailPassword, 'firstname' => $users->firstname,'lastname' => $users->lastname,'username' => $users->username,'password' => $password,'login_link' => $loginlink];

                $mail = Mail::to($data['email'])->send(new LoginCredentialMail($data));
            }
            //mail send end
            if(isset($agent_billplan) && !empty($agent_billplan))
            {
                foreach ($agent_billplan as $k) {
                    if($k['billplan_id'] != 0){
                        $agentbillplan = new AgentBillplan;
                        $agentbillplan->billplan_id = $k['billplan_id'];
                        $agentbillplan->commission  = $k['commission'];
                        $agentbillplan->agent_id = $agent->id;    
                        $agentbillplan->save();
                    }
                }
            }
            
            Session::put('customerinfo', '');
            Session::put('accountcredential', '');
            Session::put('commission', '');
            Session::forget(['customerinfo', 'accountcredential','commission']);
        }
        return redirect()->route('agent.index')->with('success','Agent has been created successfully.');
    }

    public function changestatus($id)
    {    
        $agent = Agent::where('id','=',$id)->first();
        $agent->status = $agent->status == "INACTIVE" ? "ACTIVE" : "INACTIVE";
        $agent->save();
        return redirect()->route('agent.index');
    }

    public function changesuspended($id)
    {    
        $agent = Agent::where('id','=',$id)->first();
        $agent->suspended = $agent->suspended == "NO" ? "YES" : "NO";
        $agent->save();
        return redirect()->route('agent.index');
    }

    public function addcommission()
    {    
        if(isset($_POST))
        {
            $agent_commission = [];
            if (Session::get('commission')) {
                $agent_commission = Session::get('commission');
            }
            if (isset($_POST['billplan_id']) && !empty($_POST['billplan_id'])) {
                array_push($agent_commission, $_POST);
            }

            Session::put('commission', $agent_commission);

            $html = '<table class="table table-bordered">';
            $html.= '<tr><th style="width: 5px">#</th>
                  <th>Bill Plan</th>
                  <th>Commission</th>
                  <th style="width: 5px"></th></tr>';
                  foreach ($agent_commission as $key => $k) {
                    $billplan = BillPlan::where('id','=',$k['billplan_id'])->first();
                    $html .= '<tr>
                              <td>'.++$key.'</td>
                              <td>'.$billplan->name.'</td>
                              <td>'.$k['commission'].'</td>
                              <td><a href="#" onclick="delete_commission('.$k['billplan_id'].')"><i class="fa fa-minus-circle text-green" style="font-size: x-large;"></i></a></td>
                            </tr>';
            }
            $html .= '</table>';
            echo $html;
        }
    }

    public function deletecommission()
    {   
        $id = $_GET['id'];
        $agent_commission = [];
        $new_agent_commission = [];
        if (Session::get('commission')) {
            $agent_commission = Session::get('commission');
        }

        $html = '<table class="table table-bordered">';
        $html .= '<tr><th style="width: 10px">#</th>
              <th>Bill Plan</th>
              <th>Commission</th>
              <th style="width: 40px"></th></tr>';
        $select = '';  
        foreach ($agent_commission as $key => $k) {
            if ($k['billplan_id'] != $id) {
                array_push($new_agent_commission, $k);

                $billplan = BillPlan::where('id','=',$k['billplan_id'])->first();

                $html .= '<tr>
                          <td>'.++$key.'</td>
                          <td>'.$billplan->name.'</td>
                          <td>'.$k['commission'].'</td>
                          <td><a href="#" onclick="delete_commission('.$k['billplan_id'].')"><i class="fa fa-minus-circle text-green" style="font-size: x-large;"></i></a></td>
                        </tr>';
            }else{
                $billplan = BillPlan::where('id','=',$k['billplan_id'])->first();
                $select .= '<option value="'.$k['billplan_id'].'">'.$billplan->name.'</option>';
            }
        }
        $html .= '</table>';

        Session::put('commission',$new_agent_commission);
        echo json_encode(['html'=>$html,'select'=>$select]);

    }

    public function edit($id)
    {   
        $agent = Agent::findorfail($id);
        $states = Tenant::getstate();
        $user = User::where('tenant_id',$id)->where('role','AGENT')->first();
        $agent_billplan = AgentBillplan::where('agent_id',$id)->get();
        $billplans = BillPlan::getactiveBillplan();
        return view('agent.edit',compact('agent','states','user','agent_billplan','billplans'));
        
    }
    public function update(AgentCustomerStoreRequest $request,$id)
    {
        $input = $request->except(['_token','_method']);
        $agent = Agent::where('id',$id)->first();
        $agent->update($input);
        return redirect()->route('agent.index')->with('success','Personal information has been updated successfully!');
       
    }
    
    public function account_update(AgentAccountUpdateRequest $request,$id)
    {
        $input = $request->except(['_token','_method']);
        $user = User::where('tenant_id',$id)->where('role','AGENT')->first();
        $user->update($input);
        return redirect()->route('agent.index')->with('success','Account credential has been updated successfully!');
       
    }

    public function resetpassword($id)
    {
        $agent = Agent::findorfail($id);
        $user = User::where('tenant_id',$id)->where('role','AGENT')->first();
        return view('agent.reset_password',compact('user','agent'));
    }

    public function agentresetpassword(AgentResetPasswordRequest $request,$id)
    {
        $user = Auth::user();
        $input = $request->except(['password','confirm_password','_token','_method']);
        $input['password'] = Hash::make($request->password);
        User::where('tenant_id',$id)->update($input);
        $users = User::where('tenant_id',$id)->first();
        //mail send start
        $fromMail = config('custom.from_mail');
        $fromMailPassword = config('custom.mail_password');
        $subjectContent = config('custom.resetpassword_content');
        $loginlink = route('login');
        if(!empty($users))
        {
            $data = ['email' => $users->email, 'subjectContent' => $subjectContent, 'fromMail' => $fromMail, 'fromMailPassword' => $fromMailPassword, 'firstname' => $users->firstname,'lastname' => $users->lastname,'username' => $users->username,'password' => $request->password,'login_link' => $loginlink];

            $mail = Mail::to($data['email'])->send(new ResetPasswordMail($data));
        }
        //mail send end
            
        return redirect()->route('agent.index')->with('success','Password has been updated successfully!');
    }

    public function viewtenant($id)
    {
        $tenants = Tenant::where('agent_id',$id)->get();
        return view('agent.tenant',compact('tenants'));
    }

    public function tenantchangesuspended($id)
    {    
        $tenant = Tenant::where('agent_id','=',$id)->first();
        $tenant->suspended = $tenant->suspended == "NO" ? "YES" : "NO";
        $tenant->save();
        return redirect()->route('agent.index');
    }

    public function addbillplan(AgentBillStoreRequest $request,$id)
    {    
        
        $input = $request->all();
        $input['agent_id'] = $id;
        $agentbillplan = AgentBillplan::create($input);
        return redirect()->route('agent.edit',$id)->with('success','Agent billplan added successfully!!');
    }

    public function displaybillplan($id)
    {    
       
        $agent_billplan = AgentBillplan::where('agent_id',$id)->get();

        if(!empty($agent_billplan))
        {
            $html = '<table class="table table-bordered">';
            $html.='<tr><th style="width: 10px">#</th>
                    <th>Bill Plan</th>
                    <th>Bill Plan type</th>
                    <th>Commission(%)</th></tr>';

        foreach ($agent_billplan as $key => $k){

            $billplan = BillPlan::where('id','=',$k['billplan_id'])->first();
            $html.= '<tr>
                    <td>'. ++$key .'</td>
                    <td>'.$billplan->name .'</td>
                    <td>'. $billplan->type .'</td>
                    <input class="form-control" name="id'.$key.'" type="hidden" value='. $k["id"] .'>
                    <td>'. $k["commission"].' </td>
                    <td> <a href="#" class="pull-right" style="padding-right: 5px;" title="Edit Commission" onclick="editCommission('.$k['id'].','.$k['commission'].')"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="#" class="pull-right" title="Delete BillPlan" onclick="deleteBillplan('.$k['id'].')"><i class="fa-solid fa-trash-can"></i></a>                                
                    </td>
                    </tr>';
               }
                $html .= '</table>';

                echo $html;

            }else{
                echo "No billplan Assign";
            }
            
    }

    public function deletebillplan()
    {  
        $agent_billplan_id = $_GET['id'];
        $agent_commission = AgentBillplan::where('id',$agent_billplan_id)->first();
        $tenants = Tenant::where(['agent_id'=>$agent_commission->agent_id,'billpan_id'=>$agent_commission->billplan_id])->get();
        foreach ($tenants as $k) {
            $tenant = Tenant::where('id',$k->id)->first();
            $tenant->agent_id = NULL;
            $tenant->save();
        }

        $agent_commission->delete();
        return redirect()->route('agent.index')->with('success','Agent billplan deleted successfully!');
    }

    public function editcommission()
    {  
        if(isset($_POST) && !empty($_POST))
        {
            $data = $_POST;
            $agent_commission = AgentBillplan::where('id',$data['id'])->first();
            $agent_commission->commission = $data['commission'];
            $agent_commission->save(); 
            return redirect()->route('agent.index')->with('success','Agent commission updated successfully!');
        }
    }

    private function getSearch($query)
    {
        if ( request('account_number') != '' )
        $query = $query->where('account_number', 'like', '%'.request('account_number').'%');
        
        if ( request('firstname') != '' )
        $query = $query->where('firstname', 'like', '%'.request('firstname').'%');

        if ( request('company_name') != '' )
        $query = $query->where('company_name', 'like', '%'.request('company_name').'%');
        
        if ( request('status') != '' )
        $query = $query->where('status', 'like', '%'.request('status').'%');

        if ( request('suspended') != '' )
        $query = $query->where('suspended', 'like', '%'.request('suspended').'%');
        
        return $query; 
    }

}
