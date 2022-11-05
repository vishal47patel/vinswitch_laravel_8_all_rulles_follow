<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantService extends Model
{
    use HasFactory;

    protected $table = 'tenant_service';

    protected $fillable = [
        'id',
        'account_number',
        'referenceno',
        'order_no',
        'name',
        'description',
        'start_date',
        'end_date',
        'rate',
        'type',
        'is_expire',
        'created_at',
    ];
}
