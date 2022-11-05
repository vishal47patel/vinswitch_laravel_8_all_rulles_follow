<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Voidgraphics\Searchable\SearchableTrait;

class NpaNxxDetail extends Model
{
    use HasFactory,SearchableTrait;
    public $table = 'npa_nxx_detail';
    public $timestamps = false;
    protected $fillable = [
          'id','npanxx_id', 'state', 'npanxx', 'lata', 'zipcode', 'zipcode_count', 'zipcode_freq', 'npa', 'nxx,flag', 'safe'
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
            'npa_nxx_master.npanxx' => 1,
            'npa_nxx_detail.lata' => 1,
        ],
    ];

    //relationship 
    public function npa_nxx_master()
    {
        return $this->belongsTo(NpaNxxMaster::class, 'npanxx_id', 'id');

    }
}
