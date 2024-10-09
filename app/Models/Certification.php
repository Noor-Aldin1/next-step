<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $table = 'certification'; 

    protected $fillable = [
        'user_id',
        'name',
        'start_due',
        'end_due',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}