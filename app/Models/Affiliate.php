<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    protected $fillable = [
        'user_id',
        'code',
        'is_active',
        'clicks',
        'signups',
        'paid_registrations',
        'commission_rate',
        'notes',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'commission_rate' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referrals()
    {
        return $this->hasMany(AffiliateReferral::class);
    }

    public function payouts()
    {
        return $this->hasMany(AffiliatePayout::class);
    }

    // handy totals
    public function getTotalCommissionAttribute()
    {
        return $this->referrals()
            ->whereIn('status', ['approved'])
            ->sum('commission_amount');
    }

    public function getTotalPaidOutAttribute()
    {
        return $this->payouts()
            ->where('status', 'paid')
            ->sum('amount');
    }

    public function getBalanceAttribute()
    {
        return max(0, (float)$this->total_commission - (float)$this->total_paid_out);
    }
}
