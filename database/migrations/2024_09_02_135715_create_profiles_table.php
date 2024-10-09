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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('full_name')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->enum('gender', ['male', 'female'])->nullable(); // Gender as ENUM
            $table->text('about_me')->nullable(); // About me section
            $table->string('major')->nullable()->default(null);
            $table->string('university')->nullable()->default(null);
            $table->string('gap')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('job_title')->nullable()->default(null);
            $table->string('country')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->integer('age')->nullable()->default(null);
            $table->string('language')->nullable()->default(null);
            $table->string('linkedin')->nullable()->default(null);
            $table->string('github')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
