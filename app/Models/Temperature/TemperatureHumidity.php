<?php

namespace App\Models\Temperature;

use Illuminate\Database\Eloquent\Model;

class TemperatureHumidity extends Model
{
    protected $casts = [
        'created_at' => 'datetime'
    ];
}
