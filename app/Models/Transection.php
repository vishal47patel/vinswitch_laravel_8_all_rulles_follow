<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transection extends Model
{
    use HasFactory;

    protected $table = 'tenant_log';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'account_number',
        'summary',
        'debit',
        'credit',
        'balance',
        'referenceno',
        'created_date',
    ];
}
