<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTask extends Model
{
    use HasFactory;
    protected $table = 'course_tasks';
    protected $fillable = ['course_id', 'task_id'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}