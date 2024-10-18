<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role_id',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relation 
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function employer()
    {
        return $this->hasOne(Employer::class, 'user_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'user_id');
    }

    public function mentor()
    {
        return $this->hasOne(Mentor::class, 'user_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    public function messagesSent()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function messagesReceived()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'mentor_id');
    }

    public function liveChats()
    {
        return $this->hasMany(LiveChat::class, 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function verifications()
    {
        return $this->hasOne(Verification::class, 'user_id');
    }


    public function studentTasks()
    {
        return $this->hasMany(StudentTask::class, 'student_id');
    }

    public function studentMaterials()
    {
        return $this->hasMany(StudentMaterial::class, 'student_id');
    }

    public function courseStudents()
    {
        return $this->hasMany(CourseStudent::class, 'student_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function experience()
    {
        return $this->hasMany(Experience::class);
    }

    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }
    public function userSkills()
    {
        return $this->hasMany(UserSkill::class);
    }
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skill')->withPivot('rate');
    }
    public function subscriptions()
    {
        return $this->hasMany(UserSubscription::class);
    }

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, UserSubscription::class, 'user_id', 'subscription_id');
    }

    /**
     * The relationship with mentors.
     * Many users (students) can have many mentors.
     */
    public function mentors()
    {
        return $this->belongsToMany(Mentor::class, 'user_mentor', 'student_id', 'mentor_id')
            ->withTimestamps();
    }

    public function meetings()
    {
        return $this->hasMany(MentorMeeting::class, 'user_id');
    }
}