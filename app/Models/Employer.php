<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;
    protected $table = 'employers';
    protected $fillable = [

        'company_name',
        'business_sector',
        'employee_num',
        'city',
        'account_manager',
        'phone',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jobPostings()
    {
        return $this->hasMany(JobPosting::class, 'employer_id');
    }
}
