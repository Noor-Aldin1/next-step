<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;
    protected $table = 'lectures';
    protected $fillable = ['mentor_id', 'title', 'description', 'linke_lecture'];

    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'mentor_id');
    }

    public function courseLectures()
    {
        return $this->hasMany(CourseLecture::class, 'lecture_id');
    }
}
