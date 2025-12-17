<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use App\Models\Competition;
use App\Models\Entry;
use App\Models\User;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index(Request $request)
    {
        $title = "Vote";
        $query = Vote::query()
            ->with([
                'user:id,name,email',
                'entry:id,title,competition_id',
                'competition:id,title,status',
            ])
            ->latest();

        if ($request->filled('competition_id')) {
            $query->where('competition_id', $request->competition_id);
        }

        if ($request->filled('entry_id')) {
            $query->where('entry_id', $request->entry_id);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('ip_address')) {
            $query->where('ip_address', 'like', '%' . $request->ip_address . '%');
        }

        // Optional date filter (simple)
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $votes = $query->paginate(10)->withQueryString();

        $competitions = Competition::query()->orderBy('title')->get(['id', 'title']);
        $entries = Entry::query()->orderBy('id', 'desc')->limit(200)->get(['id', 'title', 'competition_id']);
        $users = User::query()->orderBy('name')->limit(200)->get(['id', 'name', 'email']);

        return view('admin.votes.index', compact('votes', 'competitions', 'entries', 'users', 'title'));
    }

    public function destroy(Vote $vote)
    {
        try {
            $vote->delete();
            toast_deleted('Vote');
        } catch (\Throwable $e) {
            toast_error('Vote cannot be deleted right now.');
        }

        return back();
    }
}
