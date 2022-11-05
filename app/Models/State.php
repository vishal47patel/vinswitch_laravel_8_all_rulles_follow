<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'state_id',
        'ID',
        'Country',
        'Name'
    ];

    public function did_number(){
        return $this->belongsTo(DidNumber::class);
    }
}
