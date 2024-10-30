<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorMeeting extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    protected $primaryKey = 'meeting_id'; // Specify your primary key

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'meeting_id',
        'mentor_id',
        'start_session',
        'end_session',
        'meeting_link',
        'notes',
        'status',
    ];

    /**
     * Get the mentor for the meeting.
     */
    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    /**
     * Get the user (student) for the meeting.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
