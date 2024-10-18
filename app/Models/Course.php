<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'courses';
    protected $fillable = ['title', 'description', 'mentor_id'];

    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'mentor_id');
    }

    public function materials()
    {
        return $this->hasMany(CourseMaterial::class, 'course_id');
    }

    public function tasks()
    {
        return $this->hasMany(CourseTask::class, 'course_id');
    }

    public function lectures()
    {
        return $this->hasMany(CourseLecture::class, 'course_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_students', 'course_id', 'student_id');
    }
    public function courseStudents()
    {
        return $this->hasMany(CourseStudent::class, 'course_id');
    }
}
