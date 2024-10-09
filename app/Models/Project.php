<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects'; // Specify the table name if not plural

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'start_due',
        'end_due',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
