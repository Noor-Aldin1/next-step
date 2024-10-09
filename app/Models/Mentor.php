<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;
    protected $table = 'mentors';
    protected $fillable = [
        'user_id',
        'expertise',
        'availability',
        'university',
        'major ',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function materials()
    {
        return $this->hasMany(Material::class, 'mentor_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'mentor_id');
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class, 'mentor_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'mentor_id');
    }
}
