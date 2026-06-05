<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = [
        'title',
        'disease_name',
        'type',
        'description',
        'level',
        'research',
        'steps',
        'category'
    ];
}

