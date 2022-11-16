<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantFinance extends Model
{
    use HasFactory;

    protected $table = 'tenant_finance';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'account_number',
        'billplan_method',
        'taxation',
        'credit_limit',
        'call_per_seconds',
        'concurrent_call',
        'port',
        'invoice_generate_at',
        'invoice_generate_date',
        'invoice_start_date',
        'invoice_end_date',
        'late_fee',
    ];
}
