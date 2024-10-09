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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('mentor_id')->constrained('mentors', 'id')->cascadeOnDelete();
            $table->tinyInteger('rating')->check('rating BETWEEN 1 AND 5'); // Rating between 1 and 5
            $table->text('description')->nullable(); // Optional description
            $table->timestamps(); // created_at and updated_at

            // Foreign key constraint

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
