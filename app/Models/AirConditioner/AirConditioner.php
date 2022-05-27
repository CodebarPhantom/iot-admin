<?php

namespace App\Models\AirConditioner;

use Illuminate\Database\Eloquent\Model;

class AirConditioner extends Model
{
    protected $casts = [
        'created_at' => 'datetime'
    ];
}
