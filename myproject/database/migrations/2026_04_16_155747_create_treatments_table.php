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
    Schema::create('treatments', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('type');
        $table->text('description');
        $table->string('level');
        $table->text('research')->nullable();
        $table->text('steps')->nullable();
        $table->string('category')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
