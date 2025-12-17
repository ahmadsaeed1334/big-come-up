<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateReferral extends Model
{
    protected $fillable = [
        'affiliate_id',
        'referred_user_id',
        'competition_id',
        'payment_id',
        'base_amount',
        'commission_amount',
        'status',
        'approved_at',
    ];

    protected $casts = [
        'base_amount' => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function referredUser()
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
