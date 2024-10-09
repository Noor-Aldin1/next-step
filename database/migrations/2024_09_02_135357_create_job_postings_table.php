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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('employer_id')->constrained('employers', 'id')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('requirements')->nullable();
            $table->string('company_name');
            $table->string('position');
            $table->enum('job_type', ['Full-time', 'Part-time', 'Contract', 'Internship']);
            $table->string('experience')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->date('post_due')->nullable();
            $table->date('last_date_to_apply')->nullable();
            $table->enum('city', [
                'Amman', 'Irbid', 'Balqa', 'Karak', 
                'Ma an', 'Mafraq', 'Tafilah', 
                'Zarqa', 'Madaba', 'Jerash', 'Ajloun', 'Aqaba'
            ]);
            $table->string('address')->nullable(); // Changed 'Address' to 'address' for consistency
            $table->string('education_level')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};