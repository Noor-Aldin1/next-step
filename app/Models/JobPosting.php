<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    use HasFactory;
    protected $table = 'job_postings';
    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'requirements',
        'company_name',
        'position',
        'job_type',
        'experience',
        'salary',
        'post_due',
        'last_date_to_apply',
        'city',
        'address',
        'education_level',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }

    public function categories()
    {
        return $this->belongsToMany(JobCategory::class, 'job_posting_categories', 'job_id', 'category_id');
    }
}
