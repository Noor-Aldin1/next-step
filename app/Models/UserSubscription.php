<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'package_id',
        'start_date',
        'end_date',
        'number_month',
    ];

    /**
     * Get the user that owns the subscription.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the package associated with the subscription.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'subscription_id');
    }
}
