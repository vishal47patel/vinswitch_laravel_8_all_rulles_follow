<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentCommission extends Model
{
    use HasFactory;

    protected $table = 'agent_commission';

    public $timestamps = false;
    public $start_date;
    public $end_date;

    protected $fillable = [
        'id',
        'agent_id',
        'tenant_account_number',
        'summary',
        'amount',
        'commission_percentage',
        'debit',
        'credit',
        'balance',
        'invoice_id',
        'payment_id',
        'created_date'
    ];

    protected $searchable = [
        'columns' => [
            'agent_commission.start_date' => 1,
            'agent_commission.end_date' => 1,
            'agent_commission.created_date' => 1,
        ],
    ];

    //relationship 
    public function tenantAccountNumber()
    {
        return $this->belongsTo(Tenant::class, 'account_number', 'tenant_account_number');

    }
}
