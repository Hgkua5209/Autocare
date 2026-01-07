<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('food_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // Top-level columns used in your Controller's create() method
            $table->string('name');
            $table->string('type'); // 'food' or 'meal'

            // This stores the image path, ingredients, nutrition, and research
            $table->json('data');

            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');
            $table->text('rejection_reason')->nullable(); // Added here directly
            $table->text('admin_note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('food_submissions');
    }
};
