<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;

    protected $table = 'job_categories'; // The table name is specified

    protected $fillable = [
        'name', // Mass assignable attributes
    ];

    public function jobPostings()
    {
        return $this->belongsToMany(JobPosting::class, 'job_posting_categories', 'category_id', 'job_id');
        // This establishes a many-to-many relationship with the JobPosting model
    }
}
