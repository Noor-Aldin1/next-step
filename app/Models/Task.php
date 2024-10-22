<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $fillable = ['mentor_id', 'title', 'description', 'due_date', 'status'];
    protected $dates = ['due_date'];

    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'mentor_id');
    }

    public function courseTasks()
    {
        return $this->hasMany(CourseTask::class, 'task_id');
    }

    public function studentTasks()
    {
        return $this->hasMany(StudentTask::class, 'task_id');
    }
}
