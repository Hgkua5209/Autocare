<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyLog extends Model
{
    protected $fillable = [
        'user_id',
        'progress_id', 
        'pain_level',
        'fatigue_level',
        'stress_level',
        'symptoms',
        'sleep_hours',
        'water_intake',
        'activity_level',
        'food_intake',
        'triggers',
        'took_medication',
        'medication_note',
        'overall_condition',
        'food_intake',
        'triggers',
    ];

    protected $casts = [
        'symptoms' => 'array',
        'food_intake' => 'array',
        'triggers' => 'array',
    ];

    public function progress()
{
    return $this->belongsTo(Progress::class);
}
}

