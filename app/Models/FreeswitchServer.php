<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Voidgraphics\Searchable\SearchableTrait;

class FreeswitchServer extends Model
{
    use HasFactory,SearchableTrait;
    public $table = 'freeswitch_server';
    public $timestamps = false;
    protected $fillable = [
         'id','freeswitch_host', 'freeswitch_password', 'freeswitch_port', 'status', 'creation_date', 'last_modified_date'
     ];

     protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'freeswitch_server.freeswitch_host' => 1,
            'freeswitch_server.freeswitch_password' => 1,
            'freeswitch_server.freeswitch_port' => 1,
        ],
    ];
}
