<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    // 🔥 YOU WERE MISSING THESE THREE BELOW
    protected $fillable = [
        'name',
        'disease_category',
        'recommendation_type',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
