<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Voidgraphics\Searchable\SearchableTrait;

class Service extends Model
{
    use HasFactory,SearchableTrait;
    public $table = 'services';
    public $timestamps = false;

    protected $fillable = [
        'service_type','service_description'
    ];

    protected $searchable = [
        'columns' => [
            'services.service_type' => 1,
            'services.service_description' => 1,
        ],
    ];

}


