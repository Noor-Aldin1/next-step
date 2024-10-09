<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('position')->nullable(); // Job position
            $table->string('company_name')->nullable(); // Company name
            $table->text('description')->nullable(); // Description of the experience
            $table->date('start_due')->nullable(); // Start date
            $table->date('end_due')->nullable(); // End date
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experience');
    }
}
