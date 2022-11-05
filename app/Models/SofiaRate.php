<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Voidgraphics\Searchable\SearchableTrait;

class SofiaRate extends Model
{
    use HasFactory, SearchableTrait;

    protected $table = 'sofia_rate';

    public $timestamps = false;

    protected $fillable = [
        'plan_id',
        'rate_name',
        'code',
        'description',
        'buy_rate',
        'sale_rate',
        'sale_percentage',
    ];

    protected $searchable = [
        'columns' => [
            'sofia_rate.code' => 1,
            'sofia_rate.description' => 1,
        ],
    ];

    // relationship 
    public function rateplan()
    {
        return $this->hasOne(SofiaRateplan::class,"id",'plan_id');
    }

   
}
