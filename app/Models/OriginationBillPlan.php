<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Voidgraphics\Searchable\SearchableTrait;

class OriginationBillPlan extends Model
{
    use HasFactory , SearchableTrait;

    protected $table = 'origination_bill_plan';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'bill_plan_type',
        'bill_plan_name',
        'origination_rate_plan',
        'origination_enable',
        'description'
    ];

    protected $searchable = [
        'columns' => [
            'origination_bill_plan.bill_plan_type' => 1,
            'origination_bill_plan.bill_plan_name' => 1,
            'origination_bill_plan.origination_rate_plan' => 1,
            'origination_bill_plan.origination_enable' => 1,
        ],
    ];

    // relationship 
    public function originationBillPlan()
    {
        return $this->hasOne(OriginationRatePlan::class,"id",'id');
    }
}
