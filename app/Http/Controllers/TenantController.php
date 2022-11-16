<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Session;
use App\Models\BillPlan;
use App\Models\AgentBillplan;
use App\Models\OriginationBillPlan;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TenantCustomerStoreRequest;
use App\Http\Requests\TenantAccountStoreRequest ;
use App\Http\Requests\TenantBillStoreRequest;
use App\Models\User;
use App\Models\TenantFinance;
use App\Models\ResetPasswordMail;
use App\Models\TenantLowBalanceNotification;
use App\Models\TenantMinuteLog;
use App\Models\TenantPortHistory;
use App\Models\Transection;
use App\Http\Requests\AgentResetPasswordRequest;
use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Mail\Mailable;
use Mail;
use App\Models\LoginCredentialMail;
use App\Models\Services;
use App\Libraries\General;
use App\Libraries\Service;

class TenantController extends Controller
{
    public function index()
    {
        $row = 10;
        if (request('row') != '')
        $row = request('row');

        $tenants = Tenant::orderBy('id', 'DESC');
        
        if (request('search') != '') {
            $tenants = $tenants->search(request('search'), null, true, true)->distinct();
        }

        $operationPermission = [
            'create' => hasPermission(['tenant_list','tenant_create']),
            'update' => hasPermission(['tenant_list','tenant_update']),
            'delete' => hasPermission(['tenant_list','tenant_delete'])
        ];
        $tenants = $this->getSearch($tenants);
        $tenants = $tenants->paginate($row); //display 10 records
        return view('tenant.index',compact('tenants','operationPermission'));    
    }

    public function create(Request $request)
    {
        $countries = Tenant::getcountry();
        $billplans = BillPlan::getactiveBillplan();
        $user = Session::get('accountinfo');
        $customer = Session::get('customerinfo');

        if ($request->view != '' && in_array($request->view, ['tenant.customer_create', 'tenant.account_create'])) {
            return view($request->view,compact('user','customer','countries'));
        }
        if (!empty(Session::get('accountinfo'))) {
            return view('tenant.billing_create',compact('billplans'));
        }
        if (isset($customer) && !empty($customer)) {
            return view('tenant.account_create',compact('customer'));
        }
        return view('tenant.customer_create',compact('countries'));
    }

    public function store(TenantCustomerStoreRequest $request)
    {
        Session::put('customerinfo', $request->all());
        return redirect()->route('tenant.create');
    }

    public function accountstore(TenantAccountStoreRequest $request)
    {
        Session::put('accountinfo', $request->all());
        return redirect()->route('tenant.create');
    }

    public function billstore(TenantBillStoreRequest $request)
    {
        $accountinfo = Session::get('accountinfo');
        $billplan = BillPlan::getactiveBillplan();
        $tenantfinance = new TenantFinance;

        if (isset($_POST) && !empty($_POST)) 
        {
            if($request->billplan_method == 'PREPAID'){
                $tenantfinance->invoice_generate_date = date('Y-m-d', strtotime('+1 months'));
                $tenantfinance->invoice_start_date = $tenantfinance->invoice_generate_date . ' 00:00:00';

                $nextMonthDate = date('Y-m-d', strtotime('+1 months', strtotime($tenantfinance->invoice_generate_date)));

                $tenantfinance->invoice_end_date = date('Y-m-d', strtotime('-1 day', strtotime($nextMonthDate))) . ' 23:59:59';
            }else{
                $tenantfinance->invoice_generate_date = date('Y-m-d', strtotime('+1 months'));
                $tenantfinance->invoice_start_date = date('Y-m-d') . ' 00:00:00';
                $tenantfinance->invoice_end_date = date('Y-m-d', strtotime('-1 day', strtotime($tenantfinance->invoice_generate_date))) . ' 23:59:59';
            } 

            $customerinfo = Session::get('customerinfo');
            if (Auth::user()->role == "AGENT") {
                $user = User::where('id',Auth::user()->id);
                $customerinfo['agent_id'] = $user->tenant_id;
            }
            
            $customerinfo['billpan_id'] = $_POST['bill_plan_id'];
            $customerinfo['origination_bill_plan_id'] = $_POST['origination_bill_plan_id'];
            $customerinfo['account_number'] = General::generateAccount_number();
            $customerinfo['join_date'] = date("Y-m-d");

            $tenant = Tenant::create($customerinfo);

            // echo "<pre>";
            // print_r($tenant);

            if(isset($tenant) && !empty($tenant))
            {
                $lowBalNoti = new TenantLowBalanceNotification;
                $lowBalNoti->notification_threshold = 10;
                $lowBalNoti->Isnotification = 'YES';
                $lowBalNoti->tenant_account_code = $customerinfo['account_number'];
                $lowBalNoti->save();

                $accountinfo = Session::get('accountinfo');
                $password = $accountinfo['password'];
                $accountinfo['firstname'] = $accountinfo['first_name'];
                $accountinfo['lastname'] = $accountinfo['last_name'];
                $accountinfo['phoneno'] = $accountinfo['phone_number'];
                $accountinfo['password'] = Hash::make($accountinfo['password']);
                $accountinfo['tenant_id'] = $tenant->id;
                $accountinfo['role'] = 'TENANT';
                $user = User::create($accountinfo);

                $billplan = BillPlan::where('id',$customerinfo['billpan_id'])->first();

                if (isset($user) && !empty($user)) 
                {
                   //mail send start
                    $fromMail = config('custom.from_mail');
                    $fromMailPassword = config('custom.mail_password');
                    $subjectContent = config('custom.login_content');
                    $loginlink = route('login');
                   
                    $data = ['email' => $user->email, 'subjectContent' => $subjectContent, 'fromMail' => $fromMail, 'fromMailPassword' => $fromMailPassword, 'firstname' => $user->firstname,'lastname' => $user->lastname,'username' => $user->username,'password' => $password,'login_link' => $loginlink];

                    $mail = Mail::to($data['email'])->send(new LoginCredentialMail($data));
                    //mail send end
                }

                $tenant = Tenant::where('id',$tenant->id)->first();
                $tenant->monthly_mins = $billplan->monthly_mins;

                if ($billplan->type == 'PREPAID') { 
                    $tenantfinance->credit_limit = 0;
                    $tenantfinance->late_fee = 0;                        
                    
                    $tenant_log = new Transection;
                    $tenant_log->account_number = $customerinfo['account_number'];
                    $tenant_log->summary = "Account Created - Montly Payment charges applied";
                    $tenant_log->debit = $billplan->monthly_payment;
                    $tenant_log->balance = -1 * $billplan->monthly_payment;
                    $tenant_log->created_date = date('Y-m-d');
                    $tenant_log->save();
                        
                    $tenant->balance = $tenant_log->balance;
                    $tenant->effective_balance = $tenant_log->balance;
                    if ($tenant->balance < 0) {
                        $tenant->suspended = 'YES';
                        $tenant->suspend_reason = 'ACTIVATION';
                    }

                    $port_price = bcmul($billplan->per_channel_price, $tenantfinance->port,5);

                    $tenant_log = new Transection;
                    $tenant_log->account_number = $customerinfo['account_number'];
                    $tenant_log->summary = "Port charges applied for number of ports : ".$tenantfinance->port;
                    $tenant_log->debit = $port_price;
                    $tenant_log->balance = bcsub($tenant->balance, $port_price,5);
                    $tenant_log->created_date = date('Y-m-d');
                    $tenant_log->save();

                    $tenant->balance = $tenant_log->balance;
                    $tenant->effective_balance = $tenant_log->balance;
                    if ($tenant->balance < 0) {
                        $tenant->suspended = 'YES';
                        $tenant->suspend_reason = 'ACTIVATION';
                    }

                }

                $tenant->save();
                   
                $minute_log = new TenantMinuteLog;
                $minute_log->account_number = $customerinfo['account_number'];
                $minute_log->type = 'ADD';
                $minute_log->monthly_minutes = $tenant->monthly_mins;
                $minute_log->additional_minutes = $tenant->additional_mins;
                $minute_log->comment = 'Plan Minutes';
                $minute_log->balance_monthly_min = $tenant->monthly_mins;
                $minute_log->balance_additional_min = $tenant->additional_mins;
                $minute_log->save();

                //Adding Service For Billing
                $desc = "Monthly Charges for billplan: ".$billplan->name;
                Service::service_add($customerinfo['account_number'], $billplan->id, 'MONTHLY_CHARGES', $desc, $billplan->monthly_payment, date('Y-m-d'),NULL);
                //End

                TenantPortHistory::add_data($customerinfo['account_number'],0,$tenantfinance->port,'PORT_CREATED');

                $port_price = bcmul($billplan->per_channel_price, $tenantfinance->port,5);
                $desc = "Port Charges for number of ports : ".$tenantfinance->port;
                Service::service_add($customerinfo['account_number'], 'PORT-'.$tenantfinance->port, 'PORT_CHARGES', $desc, $port_price, date('Y-m-d'),NULL);   
                    
                $tenantfinance->account_number = $customerinfo['account_number'];

                $tenantfinance->save();
                Session::put('customerinfo', '');
                Session::put('accountinfo', '');
                Session::forget(['customerinfo', 'accountinfo']);
                
            }
            return redirect()->route('tenant.index')->with('success','Customer has been created successfully.');

        }
    }


    public function fetchstate(Request $request)
    {
        $states = DB::table('tbl_states')->select("state_id", DB::raw("CONCAT(Name, ' [', ID, ']') AS states"))->where('Country',$request->country_id)->get();
        $state_list['states'] = json_decode(json_encode($states), true);
        return response()->json($state_list);
    }

    public function resetpassword($id)
    {
        $tenant = Tenant::findorfail($id);
        if ($tenant->status == 'INACTIVE') {
            return redirect()->route('agent.index')->with('danger','This customer has been terminated, So you can not move to this account!');
        }
        $user = User::where('tenant_id',$id)->where('role','TENANT')->first();
        return view('tenant.reset_password',compact('user','tenant'));
    }

    public function tenantresetpassword(AgentResetPasswordRequest $request,$id)
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
            
        return redirect()->route('tenant.index')->with('success','Password has been updated successfully!');
    }

    public function loadbillplan()
    {
        if (!empty(Auth::user() && Auth::user()->role == 'AGENT')) {
            $user = User::where('id','=',Auth::user()->id)->first();  
            $agent_billplan = AgentBillplan::where('agent_id', $user->tenant_id)->get();

            $ids = [];
            foreach ($agent_billplan as $k) {
                $ids[] = $k->billplan_id;
            }
            $billplan = BillPlan::select('id', 'name')->where(['type' => $_GET['type'],'id' => $ids])->get();
            $origination_billplan = OriginationBillPlan::select('id', 'bill_plan_name')->where(['bill_plan_type' => $_GET['type'],'id' => $ids])->get();
        }
        else {
            $billplan = BillPlan::select('id', 'name')->where('type','=', $_GET['type'])->get();
            $origination_billplan = OriginationBillPlan::select('id', 'bill_plan_name')->where('bill_plan_type','=', $_GET['type'])->get();
        }


        $data['billplan'] = json_decode(json_encode($billplan), true);
        $data['origination_billplan'] = json_decode(json_encode($origination_billplan), true);

        return response()->json($data);
      
    }

    public function edit($id)
    {   
        $tenant = Tenant::findorfail($id);
        if ($tenant->status == 'INACTIVE') {
            return redirect()->route('tenant.index')->with('danger','This customer has been terminated, So you can not update this account!');
        }

        $user = User::where('tenant_id',$id)->where('role','TENANT')->first();
        $billplan = BillPlan::where('id',$tenant->billpan_id)->first();
        //$servicetype = Services::where('rate_plan_id',$tenant->originationbillplan->origination_rate_plan)->get();
        $tenant_finance = TenantFinance::where('account_number',$tenant->account_number)->first();

        return view('tenant.edit',compact('tenant','user','billplan','tenant_finance'));
        
    }
    public function update(TenantCustomerStoreRequest $request,$id)
    {
        // $input = $request->except(['_token','_method']);
        // $agent = Agent::where('id',$id)->first();
        // $agent->update($input);
        return redirect()->route('tenant.index')->with('success','Personal information has been updated successfully!');
       
    }
    public function account_update(Request $request,$id)
    {
        // $input = $request->except(['_token','_method']);
        // $user = User::where('tenant_id',$id)->where('role','AGENT')->first();
        // $user->update($input);
        return redirect()->route('tenant.index')->with('success','Account credential has been updated successfully!');
       
    }

    private function getSearch($query)
    {
        if ( request('account_code') != '' )
        $query = $query->where('account_code', 'like', '%'.request('account_code').'%');
        
        if ( request('first_name') != '' )
        $query = $query->where('first_name', 'like', '%'.request('first_name').'%');

        if ( request('company_name') != '' )
        $query = $query->where('company_name', 'like', '%'.request('company_name').'%');
        
        if ( request('status') != '' )
        $query = $query->where('status', 'like', '%'.request('status').'%');

        if ( request('suspended') != '' )
        $query = $query->where('suspended', 'like', '%'.request('suspended').'%');
        
        return $query; 
    }

}
