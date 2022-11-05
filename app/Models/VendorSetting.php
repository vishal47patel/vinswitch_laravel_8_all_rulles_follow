<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Voidgraphics\Searchable\SearchableTrait;

class VendorSetting extends Model
{
    use HasFactory, SearchableTrait;

    protected $table = 'vendor_setting';

    public $timestamps = false;

    protected $fillable = [
        'vendor_id',
        'setting_key',
        'setting_value',
    ];

    protected $searchable = [
        'columns' => [
            'vendor_setting.setting_key' => 1,
            'vendor_setting.setting_value' => 2,
        ],
    ];
}
