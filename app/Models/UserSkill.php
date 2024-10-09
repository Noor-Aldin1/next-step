<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    use HasFactory;

    // Disable the incrementing and timestamps since it's a pivot table
    public $incrementing = false;
    public $timestamps = true; // Optional, set to false if you don't want timestamps

    // Specify the table name (optional if following naming conventions)
    protected $table = 'user_skill';

    // Specify the fillable properties
    protected $fillable = [
        'user_id',
        'skill_id',
        'rate',
    ];

    // Define relationships to User and Skill models
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
