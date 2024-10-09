<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $table = 'experience'; // Specify the table name if not plural

    protected $fillable = [
        'user_id',
        'position',
        'company_name',
        'description',
        'start_due',
        'end_due',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
