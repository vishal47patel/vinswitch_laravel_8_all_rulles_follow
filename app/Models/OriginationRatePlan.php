<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Voidgraphics\Searchable\SearchableTrait;

class OriginationRatePlan extends Model
{
    use HasFactory,SearchableTrait;
    
    public $table = 'origination_rate_plan';
    public $timestamps = false;

    protected $fillable = [
        'name','service_type','did_price','setup_fee','e911_price','cnam_price','inbound_min_rate','inbound_channel_limit','description'
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
            'origination_rate_plan.name' => 1,
            'origination_rate_plan.service_type' => 1,
        ],
    ];

    public function servicetype()
    {
        return $this->belongTo(services::class,'service_type');
    }
}
