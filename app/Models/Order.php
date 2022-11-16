<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    public $timestamps = false;

    protected $fillable = [
        'order_no','datetime','tenant_account_no','amount','type','status'
    ];

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account_no()
    {
        return $this->belongsTo(Tenant::class, 'tenant_account_no', 'account_number');
    }

}
