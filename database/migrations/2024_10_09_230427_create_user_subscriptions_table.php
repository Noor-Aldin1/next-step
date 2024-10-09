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
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->id(); // Auto incremented primary key
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();   // Foreign key to users table
            $table->foreignId('package_id')->constrained('packages', 'id')->cascadeOnDelete(); // Foreign key to packages table
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('number_month');
            $table->timestamps(); // Created at and updated at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_subscriptions');
    }
};