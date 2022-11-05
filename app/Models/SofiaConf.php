<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SofiaConf extends Model
{
    use HasFactory;

    public $timestamp = false;

    protected $table = 'sofia_conf';

    protected $fillable = [
        'profile_name'
    ];
}
