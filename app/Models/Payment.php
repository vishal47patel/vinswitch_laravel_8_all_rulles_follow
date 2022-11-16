<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Voidgraphics\Searchable\SearchableTrait;

class Payment extends Model
{
    use HasFactory,SearchableTrait;

    protected $table = "payment";

    protected $primaryKey = 'payment_id';

    public $timestamps = false;

    protected $fillable = [
        'payment_id',
        'account_number',
        'type',
        'date',
        'amount',
        'paypal_fees',
        'final_amount',
        'balance',
        'total',
        'status',
        'payment_method',
        'reference_number',
        'failed_reason',
        'invoice_id',
        'created_at',
    ];

    protected $searchable = [
        'columns' => [
            'payment.date' => 1,
            'payment.account_number' => 2,
            'payment.status' => 3,
            'payment.amount' => 4,
            'payment.paypal_fees' => 5,
            'payment.final_amount' =>6,
            'payment.payment_method' => 7,
            'payment.reference_number' => 8,
            // 'tenant.company_name' => 9,
        ],
        // 'joins' => [
        //     'tenant' => ['payment.account_number','tenant.account_number']
        // ],       
    ];
     
    
    public function tenant(){
        return $this->hasOne(Tenant::class,'account_number','account_number');
    }
}
