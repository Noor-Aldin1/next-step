<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTask extends Model
{
    use HasFactory;
    protected $table = 'student_tasks';

    // Specify the fillable attributes
    protected $fillable = [
        'student_id',
        'task_id',
        'submission',
        'submited_at'
    ];

    // Define the relationship to the Task model (many-to-one)
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    // Define the relationship to the User model (many-to-one)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
