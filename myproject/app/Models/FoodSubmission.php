<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodSubmission extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'data',   // This handles the big array from your controller
        'status',
        'admin_note',
    ];

    protected $casts = [
        'data' => 'array', // This is crucial for your Controller logic
    ];
}
