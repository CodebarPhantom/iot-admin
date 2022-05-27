<?php

namespace App\Models\Door;

use Illuminate\Database\Eloquent\Model;

class Door extends Model
{
    protected $casts = [
        'created_at' => 'datetime'
    ];
}
