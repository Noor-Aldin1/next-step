<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'ratings';
    protected $fillable = ['mentor_id', 'rating', 'description'];

    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'mentor_id');
    }
}
