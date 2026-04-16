<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = [
        'title',
        'type',
        'description',
        'level',
        'research',
        'steps',
        'category'
    ];
}