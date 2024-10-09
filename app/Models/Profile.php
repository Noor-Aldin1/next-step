<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';
    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'gender',
        'about_me',
        'major',
        'university',
        'gap',
        'email',
        'job_title',
        'country',
        'city',
        'age',
        'language',
        'linkedin',
        'github'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}