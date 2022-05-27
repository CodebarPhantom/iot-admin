<?php

namespace App\Models\Light;

use Illuminate\Database\Eloquent\Model;

class Light extends Model
{
    protected $casts = [
        'created_at' => 'datetime'
    ];
}
