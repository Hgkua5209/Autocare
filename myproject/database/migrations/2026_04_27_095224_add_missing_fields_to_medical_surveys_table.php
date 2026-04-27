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
Schema::table('medical_surveys', function (Blueprint $table) {


    $table->longText('skin_symptoms')->nullable();
    $table->longText('eye_symptoms')->nullable();
    $table->longText('triggers')->nullable();
    $table->string('digestive_pattern')->nullable();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
Schema::table('medical_surveys', function (Blueprint $table) {

    $table->longText('skin_symptoms')->nullable();
    $table->longText('eye_symptoms')->nullable();
    $table->longText('triggers')->nullable();
    $table->string('digestive_pattern')->nullable();

});
    }
};
