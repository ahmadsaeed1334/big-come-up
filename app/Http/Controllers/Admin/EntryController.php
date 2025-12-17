<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entry;
use App\Models\User;
use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EntryController extends Controller
{
    public function index(Request $request)
    {
        $query = Entry::query()->with(['user', 'competition'])->latest();

        // optional simple filters (safe defaults)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('competition_id')) {
            $query->where('competition_id', $request->competition_id);
        }

        $entries = $query->paginate(10)->withQueryString();

        $competitions = Competition::query()->orderBy('title')->get(['id', 'title']);

        return view('admin.entries.index', compact('entries', 'competitions'));
    }

    public function create()
    {
        $users = User::query()->orderBy('name')->get(['id', 'name', 'email']);
        $competitions = Competition::query()->orderBy('title')->get(['id', 'title', 'status']);

        return view('admin.entries.create', compact('users', 'competitions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'competition_id' => ['required', 'exists:competitions,id'],
            'title' => ['nullable', 'string', 'max:255'],
            'media_url' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
        ]);

        Entry::create($data);

        toast_created('Entry');

        return redirect()->route('admin.entries.index');
    }

    public function edit(Entry $entry)
    {
        $entry->load(['user', 'competition']);

        $users = User::query()->orderBy('name')->get(['id', 'name', 'email']);
        $competitions = Competition::query()->orderBy('title')->get(['id', 'title', 'status']);

        return view('admin.entries.edit', compact('entry', 'users', 'competitions'));
    }

    public function update(Request $request, Entry $entry)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'competition_id' => ['required', 'exists:competitions,id'],
            'title' => ['nullable', 'string', 'max:255'],
            'media_url' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
        ]);

        $entry->update($data);

        toast_updated('Entry');

        return redirect()->route('admin.entries.index');
    }

    public function destroy(Entry $entry)
    {
        try {
            $entry->delete();
            toast_deleted('Entry');
        } catch (\Throwable $e) {
            toast_error('Entry cannot be deleted right now.');
        }

        return back();
    }

    // We won't use show page for now
    public function show(Entry $entry)
    {
        return redirect()->route('admin.entries.index');
    }
}
