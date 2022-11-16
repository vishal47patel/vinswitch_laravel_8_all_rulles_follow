<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Voidgraphics\Searchable\SearchableTrait;


class SofiaRateplan extends Model
{
    use HasFactory, SearchableTrait;

    public $timestamps = false;

    protected $table = 'sofia_rateplan';

    protected $fillable = [
        'id',
        'plan_name',
        'cc',
        'max_call_length',
        'status',
        'created_at',
    ];

    protected $searchable = [
        'columns' => [
            'sofia_rateplan.plan_name' => 1,
            'sofia_rateplan.status' => 1,
        ],
    ];

    public function sofia_plangateways(){
        return $this->hasMany(SofiaPlangateway::class, 'plan_id', 'id');
    }
}
