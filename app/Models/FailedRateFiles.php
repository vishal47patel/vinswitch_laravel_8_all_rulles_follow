<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedRateFiles extends Model
{
    use HasFactory;

    protected $table = 'failed_rate_files';

    protected $fillable = [
        'id',
        'rateplan_id',
        'file_name',
        'created_at',
    ];

}
