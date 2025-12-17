<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WinnerPayout;
use App\Models\Competition;
use App\Models\User;
use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WinnerPayoutController extends Controller
{
    public function index(Request $request)
    {
        $query = WinnerPayout::query()
            ->with([
                'competition:id,title,status',
                'user:id,name,email',
                'entry:id,title,competition_id',
            ])
            ->latest();

        if ($request->filled('competition_id')) {
            $query->where('competition_id', $request->competition_id);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $payouts = $query->paginate(10)->withQueryString();

        $competitions = Competition::query()->orderBy('title')->get(['id', 'title']);
        $users = User::query()->orderBy('name')->limit(200)->get(['id', 'name', 'email']);

        return view('admin.winner_payouts.index', compact('payouts', 'competitions', 'users'));
    }

    public function create()
    {
        $competitions = Competition::query()->orderBy('title')->get(['id', 'title', 'status']);
        $users = User::query()->orderBy('name')->get(['id', 'name', 'email']);
        $entries = Entry::query()->orderBy('id', 'desc')->limit(300)->get(['id', 'title', 'competition_id']);

        return view('admin.winner_payouts.create', compact('competitions', 'users', 'entries'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'competition_id' => ['required', 'exists:competitions,id'],
            'user_id' => ['required', 'exists:users,id'],
            'entry_id' => ['nullable', 'exists:entries,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'type' => ['required', Rule::in(['dj', 'artist', 'affiliate'])],
            'status' => ['required', Rule::in(['pending', 'paid'])],
        ]);

        WinnerPayout::create($data);

        toast_created('Winner Payout');

        return redirect()->route('admin.winner-payouts.index');
    }

    public function edit(WinnerPayout $winner_payout)
    {
        $winner_payout->load(['competition', 'user', 'entry']);

        $competitions = Competition::query()->orderBy('title')->get(['id', 'title', 'status']);
        $users = User::query()->orderBy('name')->get(['id', 'name', 'email']);
        $entries = Entry::query()->orderBy('id', 'desc')->limit(300)->get(['id', 'title', 'competition_id']);

        return view('admin.winner_payouts.edit', [
            'payout' => $winner_payout,
            'competitions' => $competitions,
            'users' => $users,
            'entries' => $entries,
        ]);
    }

    public function update(Request $request, WinnerPayout $winner_payout)
    {
        $data = $request->validate([
            'competition_id' => ['required', 'exists:competitions,id'],
            'user_id' => ['required', 'exists:users,id'],
            'entry_id' => ['nullable', 'exists:entries,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'type' => ['required', Rule::in(['dj', 'artist', 'affiliate'])],
            'status' => ['required', Rule::in(['pending', 'paid'])],
        ]);

        $winner_payout->update($data);

        toast_updated('Winner Payout');

        return redirect()->route('admin.winner-payouts.index');
    }

    public function destroy(WinnerPayout $winner_payout)
    {
        try {
            $winner_payout->delete();
            toast_deleted('Winner Payout');
        } catch (\Throwable $e) {
            toast_error('Winner payout cannot be deleted right now.');
        }

        return back();
    }

    public function show(WinnerPayout $winner_payout)
    {
        return redirect()->route('admin.winner-payouts.index');
    }
}
