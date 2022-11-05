<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillplanOutboundRate extends Model
{
    use HasFactory;

    protected $table = 'billplan_outboundRate';

    protected $fillable = [
        'billplan_id',
        'rateplan_id',
    ];

    // relationship 
    public function billplan()
    {
        return $this->hasOne(BillPlan::class,"id",'billplan_id');
    }

}
