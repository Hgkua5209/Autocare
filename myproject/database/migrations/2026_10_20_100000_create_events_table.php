<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->string('type', 30)->default('talk');          // talk, wellness, workshop, support_group, other
            $table->text('description');
            $table->dateTime('starts_at');
            $table->dateTime('ends_at')->nullable();
            $table->string('location');                            // venue or "Online"
            $table->string('organizer')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_phone', 30);                   // how users reach the admin to register
            $table->string('registration_info', 500)->nullable();  // extra registration notes
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index(['is_published', 'starts_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
