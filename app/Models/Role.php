<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Role extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable = [
        'id',
        'name',
        'description',
    ];

     protected $hidden = [
        'deleted_at'
    ];
 
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
