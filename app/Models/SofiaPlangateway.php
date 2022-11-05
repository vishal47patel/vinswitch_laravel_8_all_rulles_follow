<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SofiaPlangateway extends Model
{
    use HasFactory;

    protected $table = 'sofia_plangateway';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'plan_id',
        'gateway_id',
        'priority',
    ];
    
    public function sofia_rateplan(){
        return $this->belongsTo(SofiaRateplan::class ,'plan_id');
    }
    
    public function gateway(){
        
        return $this->belongsTo(Gateway::class ,'gateway_id');
    }
}
