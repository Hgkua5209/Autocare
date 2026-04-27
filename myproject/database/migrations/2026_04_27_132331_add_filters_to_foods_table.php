<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('foods', function (Blueprint $table) {
            // To store: 'General', 'Lupus (SLE)', 'Rheumatoid Arthritis (RA)', etc.
            $table->string('disease_category')->default('General')->after('name');

            // To store: 'Benefit' or 'Avoid'
            $table->string('recommendation_type')->default('Benefit')->after('disease_category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('foods', function (Blueprint $table) {
            //
        });
    }
};
