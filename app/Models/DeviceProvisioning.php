<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceProvisioning extends Model
{
    protected $table = 'device_provisioning';

    public $timestamps = false;

    protected $fillable = [
        'batch_id',
        'status',
        'device_type',
        'status_class',
        'manufacturer',
        'model',
        'imei',
        'serial',
        'store',
        'user_name',
        'date',
        'time',
        // If using datetime instead:
        // 'processed_at',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i:s',
        // 'processed_at' => 'datetime',
    ];
}
