<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrialSession extends Model
{
    use HasFactory;

    protected $table = 'trial_sessions';
    protected $fillable = ['user_id', 'start_date', 'end_date', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
