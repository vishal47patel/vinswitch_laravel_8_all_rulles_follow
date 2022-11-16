<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentCommissionPayment extends Model
{
    use HasFactory;

    protected $table = 'agent_commission_payment';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'agent_id',
        'type',
        'amount',
        'payment_method',
        'payment_date',
        'reference_number'
    ];
}
