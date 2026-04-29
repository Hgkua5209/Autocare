<?php

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
Schema::create('daily_logs', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id');

    // ======================
    // SYMPTOMS (CORE)
    // ======================
    $table->integer('pain_level');        // 1–10
    $table->integer('fatigue_level');     // 1–10
    $table->integer('stress_level');      // 1–10

    $table->json('symptoms')->nullable(); // checkbox (joint pain, rash etc)

    // ======================
    // LIFESTYLE
    // ======================
    $table->integer('sleep_hours');       // contoh: 5, 6, 7
    $table->integer('water_intake');      // gelas air
    $table->string('activity_level');     // low / moderate / high

    // ======================
    // TRIGGERS & FOOD
    // ======================
    $table->json('food_intake')->nullable();
    $table->json('triggers')->nullable();

    // ======================
    // MEDICATION
    // ======================
    $table->boolean('took_medication');   // yes/no
    $table->text('medication_note')->nullable();

    // ======================
    // OVERALL CONDITION
    // ======================
    $table->integer('overall_condition'); // 1–10

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
Schema::create('daily_logs', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id');

    // ======================
    // SYMPTOMS (CORE)
    // ======================
    $table->integer('pain_level');        // 1–10
    $table->integer('fatigue_level');     // 1–10
    $table->integer('stress_level');      // 1–10

    $table->json('symptoms')->nullable(); // checkbox (joint pain, rash etc)

    // ======================
    // LIFESTYLE
    // ======================
    $table->integer('sleep_hours');       // contoh: 5, 6, 7
    $table->integer('water_intake');      // gelas air
    $table->string('activity_level');     // low / moderate / high

    // ======================
    // TRIGGERS & FOOD
    // ======================
    $table->json('food_intake')->nullable();
    $table->json('triggers')->nullable();

    // ======================
    // MEDICATION
    // ======================
    $table->boolean('took_medication');   // yes/no
    $table->text('medication_note')->nullable();

    // ======================
    // OVERALL CONDITION
    // ======================
    $table->integer('overall_condition'); // 1–10

    $table->timestamps();
});
    }
};
