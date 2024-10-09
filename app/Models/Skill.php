<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    // Specify the table name (optional if following naming conventions)
    protected $table = 'skills';

    // Specify the fillable properties
    protected $fillable = [
        'name',
    ];

    // If you need to allow mass assignment, ensure the properties are included in $fillable.
    // You can also add hidden properties if needed
    // protected $hidden = ['created_at', 'updated_at'];

    // Define any relationships if necessary, for example:
    public function userSkills()
    {
        return $this->hasMany(UserSkill::class);
    }
}