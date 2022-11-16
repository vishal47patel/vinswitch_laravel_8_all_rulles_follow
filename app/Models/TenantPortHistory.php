<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantPortHistory extends Model
{
    use HasFactory;

    protected $table = 'tenant_port_history';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'account_number',
        'old_port',
        'new_port',
        'description',
        'created_at',
    ];

    public function add_data($account_number,$old_port,$new_port,$desc)
    {
        $model = new TenantPortHistory;
        $model->account_number = $account_number;
        $model->old_port = $old_port;
        $model->new_port = $new_port;
        $model->description = $desc;
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();
    }
}
