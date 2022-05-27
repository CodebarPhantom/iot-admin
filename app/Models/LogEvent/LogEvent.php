<?php

namespace App\Models\LogEvent;

use Illuminate\Database\Eloquent\Model;

class LogEvent extends Model
{
    protected $casts = [
        'created_at' => 'datetime'
    ];
}
