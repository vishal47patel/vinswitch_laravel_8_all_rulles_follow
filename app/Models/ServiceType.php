<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Voidgraphics\Searchable\SearchableTrait;

class ServiceType extends Model
{
    use HasFactory,SearchableTrait;
    
    public $table = 'service_type';
    public $timestamps = false;

    protected $fillable = [
        'rate_plan_id','service_type','did_price','setup_fee','e911_price','cnam_price','inbound_min_rate','inbound_channel_limit',
    ];

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'origination_rate_plan.rate_plan_id' => 1,  
        ],
    ];
    
    //relationship 
    public function servicetype()
    {
        return $this->belongsTo(OriginationRatePlan::class, 'rate_plan_id');

    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_type', 'id');
    }
   
}