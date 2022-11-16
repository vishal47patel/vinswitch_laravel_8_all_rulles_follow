<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Tenant extends Model
{
    use HasFactory;

    protected $table = 'tenant';   

    public $timestamps = false;

    protected $fillable = [
        'id',
        'account_number',
        'agent_id',
        'billpan_id',
        'origination_bill_plan_id',
        'join_date',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'balance',
        'unbilled_balance',
        'effective_balance',
        'monthly_mins',
        'additional_mins',
        'company_name',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'status',
        'suspend_date',
        'suspend_reason',
        'reactivate_date',
        'stripe_customer_id',
        'suspended',

    ];

    public function didnumber()
    {
        return $this->belongsTo(Tenant::class, 'account_number', 'account_number');
    }

    public function getstate()
    {
        $state_list = DB::table('tbl_states')->select("ID", DB::raw("CONCAT(Name, ' [', ID, ']') AS states"))
        ->get();
        $states = json_decode(json_encode($state_list), true);
        return $states;
    }

    public function billplan(){
        return $this->belongsTo(BillPlan::class,'billpan_id','id');
    }

    public function originationbillplan(){
        return $this->belongsTo(BillPlan::class,'origination_bill_plan_id','id');
    }

    public function getcountry() {
        
        $country_list = DB::table('tbl_countries')->select("ID", DB::raw("CONCAT(Name, ' [', ID, ']') AS country"))
        ->get();
        $countries = json_decode(json_encode($country_list), true);
        return $countries;
    }

    public function getActiveUser()
    {
        if (!Auth::user()->role == 'AGENT') {

            $list =  Tenant::select('account_number', 'company_name')->where('status', '=', "ACTIVE")->where('agent_id', '=', 'Auth::user()->tenant_id')->get();
        } else {
            $list = Tenant::select('account_number', 'company_name')->where('status', '=', "ACTIVE")->get();
        }

        return $list;
    }
    public function payment(){
        return $this->belongsTo(Payment::class);
    }
}
