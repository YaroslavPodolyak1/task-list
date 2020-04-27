<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'completed' => 'boolean',
        'edited' => 'boolean',
    ];

}