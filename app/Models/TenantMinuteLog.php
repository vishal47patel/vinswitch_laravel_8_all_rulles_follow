<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantMinuteLog extends Model
{
    use HasFactory;

    protected $table = 'tenant_minute_log';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'account_number',
        'datetime',
        'type',
        'monthly_minutes',
        'additional_minutes',
        'comment',
        'balance_monthly_min',
        'balance_additional_min',
    ];
}
