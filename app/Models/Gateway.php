<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Voidgraphics\Searchable\SearchableTrait;

class Gateway extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SearchableTrait;

    protected $table = 'gateways';

    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'gateway_name',
        'prefix',
        'username',
        'password',
        'auth_username',
        'realm',
        'from_user',
        'from_domain',
        'proxy',
        'register_proxy',
        'outbound_proxy',
        'expire_seconds',
        'register',
        'retry_seconds',
        'ping',
        'caller_id_in_from',
        'channels',
        'profile',
        'hostname',
        'outbound_default',
        'created_at',
    ];

    protected $searchable = [
        'columns' => [
            'gateways.gateway_name' => 1,
            'gateways.expire_seconds' => 1,
            'gateways.retry_seconds' => 1,
            'gateways.register' => 1,
            'gateways.hostname' => 1,
            'gateways.outbound_default' => 1,
        ],
    ];
}
