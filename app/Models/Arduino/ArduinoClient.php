<?php

namespace App\Models\Arduino;

use Illuminate\Database\Eloquent\Model;

class ArduinoClient extends Model
{
    protected $casts = [
        'created_at' => 'datetime'
    ];
}
