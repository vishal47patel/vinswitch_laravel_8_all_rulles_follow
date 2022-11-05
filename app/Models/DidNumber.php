<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Voidgraphics\Searchable\SearchableTrait;

class DidNumber extends Model
{
    use HasFactory, SearchableTrait;

    public $timestamps = false;

    protected $fillable = [
        'number_did',
        'account_number',
        'number_country',
        'number_state',
        'number_area',
        'number_service_type',
        'number_channel_limit',
        'number_enable',
        'number_description',
        'sms_capable',
        'order_no',
        'status',
        'vendor_id',
        'activated_date',
        'release_date'
    ];
    protected $searchable = [
        'columns' => [
            'did_number.number_did' => 1,
            'did_number.number_service_type' => 1,
            'did_number.sms_capable' => 1,
            'did_number.status' => 1,
            'did_number.number_channel_limit' => 1,
            'did_number.number_enable' => 1,
        ],
    ];

    public function tenant(){
        return $this->hasOne(Tenant::class,'account_number','account_number');
    }
     
    // public function state(){
    //     return $this->hasOne(State::class);
    // }
}
