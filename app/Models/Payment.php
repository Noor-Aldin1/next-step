<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subscription_id',
        'amount',
        'payment_date',
        'payment_status',
    ];

    /**
     * Get the subscription associated with the payment.
     */
    public function subscription()
    {
        return $this->belongsTo(UserSubscription::class);
    }
    public function user()
    {
        return $this->hasOneThrough(User::class, UserSubscription::class, 'id', 'id', 'subscription_id', 'user_id');
    }
}
