<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Voidgraphics\Searchable\SearchableTrait;
use Illuminate\Support\Facades\Auth;
class BillPlan extends Model
{
    use HasFactory, SearchableTrait;

    protected $table = 'bill_plan';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'description',
        'type',
        'currency',
        'pulse_rate',
        'initial_increment',
        'bill_period',
        'monthly_payment',
        'monthly_mins',
        'sip_account_price',
        'end_point_price',
        'did_price',
        'inbound_min_rate',
        'inbound_sms_price',
        'outbound_sms_price',
        'cnam_price',
        'e911_price',
        'per_channel_price',
        'method',
        'method'
    ];
    
    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'bill_plan.name' => 1,
            'bill_plan.type' => 1,
            'bill_plan.status' => 1,
        ],
    ];

    public function deleteVisibility($id) {
        $tenant = Tenant::where('billpan_id','=',$id)->get();
        $agent = AgentBillplan::where('billplan_id','=',$id)->get();
        return ($tenant == '' && $agent == '') ? true : false ;
    }

    public static function tenantService($id) {

        $tenants = Tenant::where('billpan_id','=',$id)->get();

        foreach ($tenants as $tenant) {

            $tenant_services = TenantService::where('account_number','=',$tenant->account_number)->where('is_expire','=','NO')->get();

            foreach ($tenant_services as $tenant_service) {

                $rate = $tenant_service->rate;

                if ($tenant_service->name == 'SIP_ACCOUNT') {
                    $rate = $model->sip_account_price;
                } elseif ($tenant_service->name == 'DID_LOCAL') {
                    $rate = $model->did_price;
                } elseif ($tenant_service->name == 'END_POINT') {
                    $rate = $model->end_point_price;
                } elseif ($tenant_service->name == 'DID_FEATURE_E911') {
                    $rate = $model->e911_price;
                }elseif ($tenant_service->name == 'MONTHLY_CHARGES') {
                    $rate = $model->monthly_payment;
                }elseif ($tenant_service->name == 'PORT_CHARGES') {
                    $rate = $model->per_channel_price;
                }

                $tenant_service->rate = $rate;
                $tenant_service->save();
            }
        }
    }

    public function getactiveBillplan()
    {
        if (isset(Auth::user()->role) && Auth::user()->role == 'AGENT') {
            $user = User::where('id','=',Auth::user()->id)->first();
            $agent_billplan = AgentBillplan::where('agent_id','=',$user->tenant_id)->get();
            $ids = array_column($agent_billplan, 'billplan_id');
            $data = BillPlan::select('id','name')->where('id','=',$ids)->where('status','=','ACTIVE')->get();

        }else{
            $data = BillPlan::select('id','name')->where('status','=','ACTIVE')->get();  
        }
        
        return $data;
    }
    
    //relationships 
    public function sofiarateplans()
    {
         return $this->belongsToMany(SofiaRateplan::class, 'billplan_outboundRate','billplan_id','rateplan_id');

    } 
   
 
}
