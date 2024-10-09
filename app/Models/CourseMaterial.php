<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseMaterial extends Model
{
    use HasFactory;
    protected $table = 'course_materials';
    protected $fillable = ['course_id', 'material_id'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}