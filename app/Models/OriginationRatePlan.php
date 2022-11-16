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
        'name','description'
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
            'origination_rate_plan.description' => 10,
            'services.service_type' => 5,
        ],
        'joins' => [
            'service_type' => ['origination_rate_plan.id','service_type.rate_plan_id'],
            'services' => ['service_type.service_type','services.id'],
        ],
    ];
   
    public function service_types() {
        return $this->hasMany(ServiceType::class, 'rate_plan_id');
    }
   
    
}
