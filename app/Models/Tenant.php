<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $table = 'tenant';

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

    public function didnumber(){
        return $this->belongsTo(Tenant::class,'account_number','account_number');
    }
}
