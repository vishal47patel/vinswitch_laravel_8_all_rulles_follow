<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Voidgraphics\Searchable\SearchableTrait;

class NpaNxxMaster extends Model
{
    use HasFactory , SearchableTrait;
    public $table = 'npa_nxx_master';
    public $timestamps = false;

    protected $fillable = [
        'name','isdefault'
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
            'npa_nxx_master.name' => 1,
            'npa_nxx_master.isdefault' => 1,
        ],
    ];
   
}