<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_meetings', function (Blueprint $table) {
            $table->id('meeting_id'); // Auto-incrementing primary key
            $table->foreignId('mentor_id')->constrained('mentors', 'id')->onDelete('cascade'); // Foreign key referencing Mentors table
            $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade'); // Foreign key referencing Users table
            $table->timestamp('meeting_time')->nullable(false); // Meeting time
            $table->string('meeting_link')->nullable(); // Meeting link
            $table->text('notes')->nullable(); // Notes for the meeting
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled'); // Status of the meeting
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mentor_meetings');
    }
}
