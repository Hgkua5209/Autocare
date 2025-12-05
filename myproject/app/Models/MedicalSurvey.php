<?php
//test
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalSurvey extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name',
        'age',
        'gender',
        'height_cm',
        'weight_kg',
        'bmi',
        'diet_description',
        'main_symptoms',
        'symptom_duration',
        'pain_level',
        'fatigue_level',
        'impact_on_daily_life',
        'sleep_quality',
        'sleep_duration',
        'stress_level',
        'water_consumption',
        'smoking_status',
        'alcohol_consumption',
        'physical_activity_level',
        'existing_diagnosis',
        'medications',
        'family_history',
        'diagnosis_details',
    ];

    protected $casts = [
        'main_symptoms' => 'array',
    ];
}
