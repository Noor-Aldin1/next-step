<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPostingCategory extends Model
{
    use HasFactory;
    protected $table = 'job_posting_categories';
    protected $fillable = [
        'job_id',
        'category_id',
    ];

    public function job()
    {
        return $this->belongsTo(JobPosting::class, 'job_id');
    }

    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'category_id');
    }
}
