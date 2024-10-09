<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMaterial extends Model
{
    use HasFactory;
    protected $table = 'student_materials';
    protected $fillable = ['student_id', 'material_id'];


    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
