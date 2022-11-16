<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Voidgraphics\Searchable\SearchableTrait;

class Taxation extends Model
{
    use HasFactory,SearchableTrait;
    public $table = 'taxation';
    public $timestamps = false;

    protected $fillable = [
        'name','rate'
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
            'taxation.name' => 1,
            'taxation.rate' => 1,
        ],
    ];
    

}
