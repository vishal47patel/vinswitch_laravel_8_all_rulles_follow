<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AclList extends Model
{
    use HasFactory;

    protected $table = 'acl_lists';

    public $timestamps = false;
    
    protected $fillable = [
        'acl_name',
        'default_policy',
    ];

    public function aclNodes(){
        return $this->belongsTo(aclNodes::class);
    }
}
