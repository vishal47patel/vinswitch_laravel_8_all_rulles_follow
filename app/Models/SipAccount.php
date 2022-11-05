<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SipAccount extends Model
{
    use HasFactory;

    protected $table='sip_account';

    public $timestamps = false;

    protected $fillable = [
        'account_number',
        'username',
        'password',
        'sip_name',
        'outbound_caller_number',
        'email',
        'number',
        'status',
        'created_at',
        'modified_at'
    ];

}
