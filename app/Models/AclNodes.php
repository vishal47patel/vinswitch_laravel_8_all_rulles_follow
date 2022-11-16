<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Voidgraphics\Searchable\SearchableTrait;

class AclNodes extends Model
{
    use HasFactory, SearchableTrait;

    protected $table = 'acl_nodes';

    public $timestamps = false;
    
    protected $fillable = [
        'cidr',
        'type',
        'list_id',
        'is_endpoint',
    ];

    protected $searchable = [
        'columns' => [
            'acl_nodes.cidr' => 1,
            'acl_nodes.type' => 1,
            'acl_nodes.list_id' => 1,
        ],
    ];

    public function aclList(){
        return $this->hasOne(AclList::class,'id','list_id');
    }
}
