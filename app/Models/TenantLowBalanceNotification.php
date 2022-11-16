<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantLowBalanceNotification extends Model
{
    use HasFactory;

    protected $table = 'tenant_low_balance_notification';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'tenant_account_code',
        'Isnotification',
        'notification_threshold',
        'created_at',
        'modified_at',
    ];
}
