<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\AffiliatePayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AffiliatePayoutController extends Controller
{
    public function index(Request $request)
    {
        $query = AffiliatePayout::query()->with('affiliate.user')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('affiliate_id')) {
            $query->where('affiliate_id', $request->affiliate_id);
        }

        $payouts = $query->paginate(10)->withQueryString();
        $affiliates = Affiliate::query()->with('user')->orderByDesc('id')->get();

        return view('admin.affiliate_payouts.index', compact('payouts', 'affiliates'));
    }

    public function create()
    {
        $affiliates = Affiliate::query()->with('user')->orderByDesc('id')->get();
        return view('admin.affiliate_payouts.create', compact('affiliates'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'affiliate_id' => ['required', 'exists:affiliates,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'status' => ['required', Rule::in(['pending', 'paid'])],
            'notes' => ['nullable', 'string'],
        ]);

        if ($data['status'] === 'paid') {
            $data['paid_at'] = now();
        }

        AffiliatePayout::create($data);

        toast_created('Affiliate Payout');

        return redirect()->route('admin.affiliate-payouts.index');
    }

    public function edit(AffiliatePayout $affiliate_payout)
    {
        $affiliates = Affiliate::query()->with('user')->orderByDesc('id')->get();
        return view('admin.affiliate_payouts.edit', [
            'payout' => $affiliate_payout,
            'affiliates' => $affiliates,
        ]);
    }

    public function update(Request $request, AffiliatePayout $affiliate_payout)
    {
        $data = $request->validate([
            'affiliate_id' => ['required', 'exists:affiliates,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'status' => ['required', Rule::in(['pending', 'paid'])],
            'notes' => ['nullable', 'string'],
        ]);

        $data['paid_at'] = $data['status'] === 'paid'
            ? ($affiliate_payout->paid_at ?? now())
            : null;

        $affiliate_payout->update($data);

        toast_updated('Affiliate Payout');

        return redirect()->route('admin.affiliate-payouts.index');
    }

    public function destroy(AffiliatePayout $affiliate_payout)
    {
        try {
            $affiliate_payout->delete();
            toast_deleted('Affiliate Payout');
        } catch (\Throwable $e) {
            toast_error('Payout cannot be deleted right now.');
        }

        return back();
    }

    public function show(AffiliatePayout $affiliate_payout)
    {
        return redirect()->route('admin.affiliate-payouts.edit', $affiliate_payout);
    }
}
