<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    // Specify the table associated with the model (optional if using plural form of model name)
    protected $table = 'packages';

    // Specify the fillable attributes
    protected $fillable = [
        'name',
        'attributes',
        'price',
    ];

    // Optionally, you can define the casts for attributes
    protected $casts = [
        'attributes' => 'array', // Assuming attributes will be stored as JSON
        'price' => 'decimal:2',
    ];
}
