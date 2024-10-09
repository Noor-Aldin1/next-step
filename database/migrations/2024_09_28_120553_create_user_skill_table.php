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
        Schema::create('user_skill', function (Blueprint $table) {
            $table->id(); // Create a primary key with auto-incrementing id
         
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete()->unique();
            $table->foreignId('skill_id')->constrained('skills', 'id')->cascadeOnDelete()->unique();
            $table->integer('rate')->unsigned()->default(0)->nullable(); // RATE COLUMN with default value of 0

            // Define composite primary key


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_skill');
    }
};