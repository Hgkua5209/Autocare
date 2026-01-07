<?php
//test
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medical_surveys', function (Blueprint $table) {
            $table->id();
            // Personal Info
            $table->string('patient_name');
            $table->integer('age');
            $table->string('gender');
            $table->integer('height_cm');
            $table->decimal('weight_kg', 8, 2);
            $table->decimal('bmi', 8, 2);

            // Symptoms
            $table->json('main_symptoms');
            $table->string('symptom_duration');
            $table->integer('pain_level');
            $table->integer('fatigue_level');
            $table->integer('impact_on_daily_life');

            // Lifestyle & Diet
            $table->text('diet_description');
            $table->integer('sleep_quality');
            $table->string('sleep_duration');
            $table->integer('stress_level');
            $table->integer('water_consumption');

            // Habits
            $table->string('smoking_status');
            $table->string('alcohol_consumption');
            $table->string('physical_activity_level');

            // Medical History
            $table->text('existing_diagnosis')->nullable();
            $table->text('medications')->nullable();
            $table->text('family_history')->nullable();
            $table->text('diagnosis_details')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_surveys');
    }
};
