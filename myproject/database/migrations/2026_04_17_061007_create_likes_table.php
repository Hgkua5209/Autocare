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
    Schema::create('likes', function (Blueprint $table) {
        $table->id('like_id');
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('post_id');
        $table->timestamps(); // optional
    });
}

public function down()
{
    Schema::dropIfExists('likes');
}

    /**
     * Reverse the migrations.
     */


    
};
