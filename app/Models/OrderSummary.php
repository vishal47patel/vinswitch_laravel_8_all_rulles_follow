<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSummary extends Model
{
    use HasFactory;

    protected $table = 'order_summary';

    public $timestamps = false;

    protected $fillable = [
        'order_no','description','rate','created_at'
    ];

}
