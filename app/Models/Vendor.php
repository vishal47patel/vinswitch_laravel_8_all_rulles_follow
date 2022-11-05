<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Voidgraphics\Searchable\SearchableTrait;

class Vendor extends Model
{
    use HasFactory, SearchableTrait;

    public $timestamps = false;

    protected $table = "vendor";

    protected $fillable = [
        'vendor_name',
        'vendor_code',
        'did_type',
        'status',
        'priority',
        'created_at',

    ];   

    
    protected $searchable = [
        'columns' => [
            'vendor.vendor_name' => 1,            
        ],
    ];
}
