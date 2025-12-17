<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $affiliate = Affiliate::query()
            ->with(['user'])
            ->where('user_id', auth()->id())
            ->first();

        // if user not affiliate yet, show empty state
        if (!$affiliate) {
            return view('affiliate.dashboard.empty');
        }

        $approvedCommission = $affiliate->referrals()
            ->where('status', 'approved')
            ->sum('commission_amount');

        $paidOut = $affiliate->payouts()
            ->where('status', 'paid')
            ->sum('amount');

        $balance = max(0, (float)$approvedCommission - (float)$paidOut);

        $recentReferrals = $affiliate->referrals()
            ->latest()
            ->take(5)
            ->get();

        $recentPayouts = $affiliate->payouts()
            ->latest()
            ->take(5)
            ->get();

        $refLink = route('affiliate.track', $affiliate->code);

        return view('affiliate.dashboard.index', compact(
            'affiliate',
            'approvedCommission',
            'paidOut',
            'balance',
            'recentReferrals',
            'recentPayouts',
            'refLink'
        ));
    }

    public function referrals()
    {
        $affiliate = Affiliate::where('user_id', auth()->id())->firstOrFail();

        $referrals = $affiliate->referrals()
            ->with(['referredUser', 'competition'])
            ->latest()
            ->paginate(10);

        return view('affiliate.dashboard.referrals', compact('affiliate', 'referrals'));
    }

    public function payouts()
    {
        $affiliate = Affiliate::where('user_id', auth()->id())->firstOrFail();

        $payouts = $affiliate->payouts()
            ->latest()
            ->paginate(10);

        return view('affiliate.dashboard.payouts', compact('affiliate', 'payouts'));
    }
}
