<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    use HasFactory;

    protected $table = "user_notification";

    public $timestamps = false;
    
    protected $fillable = [
        'tenant_id',
        'note',
        'url',
        'notification_type',
        'flag',
        'created_at'
    ];
}
