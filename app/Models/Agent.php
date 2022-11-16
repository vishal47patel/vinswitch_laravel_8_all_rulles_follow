<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Voidgraphics\Searchable\SearchableTrait;

class Agent extends Model
{
    use HasFactory ,SearchableTrait;

    protected $table = 'agent';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'account_code',
        'join_date',
        'firstname',
        'lastname',
        'email',
        'contact_no',
        'balance',
        'company_name',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'status',
        'suspended',
    ];

    protected $searchable = [
        'columns' => [
            'agent.account_code' => 1,
            'agent.firstname' => 1,
            'agent.company_name' => 1,
            'agent.status' => 1,
            'agent.suspended' => 1,
        ],
    ];
}
