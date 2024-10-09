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
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // Auto incremented primary key
            $table->foreignId('subscription_id')->constrained('user_subscriptions', 'id')->cascadeOnDelete(); // Foreign key to user_subscriptions table
            $table->decimal('amount', 10, 2); // DECIMAL(10,2)
            $table->dateTime('payment_date');
            $table->enum('payment_status', ['pending', 'completed', 'failed']); // ENUM for payment status
            $table->timestamps(); // Created at and updated at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};