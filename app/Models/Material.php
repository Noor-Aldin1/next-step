<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $table = 'materials';
    protected $fillable = ['mentor_id', 'title', 'description', 'file_path'];

    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'mentor_id');
    }

    public function courseMaterials()
    {
        return $this->hasMany(CourseMaterial::class, 'material_id');
    }

    public function studentMaterials()
    {
        return $this->hasMany(StudentMaterial::class, 'material_id');
    }
}
