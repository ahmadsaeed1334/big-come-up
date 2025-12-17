<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\User;
use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $title = "Report";

        $query = Report::query()
            ->with([
                'reporter:id,name,email',
                'reportedUser:id,name,email',
                'entry:id,title,competition_id',
            ])
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('reporter_id')) {
            $query->where('user_id', $request->reporter_id);
        }

        if ($request->filled('reported_user_id')) {
            $query->where('reported_user_id', $request->reported_user_id);
        }

        if ($request->filled('entry_id')) {
            $query->where('entry_id', $request->entry_id);
        }

        if ($request->filled('reason')) {
            $query->where('reason', 'like', '%' . $request->reason . '%');
        }

        $reports = $query->paginate(10)->withQueryString();

        $users = User::query()->orderBy('name')->limit(200)->get(['id', 'name', 'email']);
        $entries = Entry::query()->orderBy('id', 'desc')->limit(200)->get(['id', 'title']);

        return view('admin.reports.index', compact('reports', 'users', 'entries', 'title'));
    }

    public function create()
    {
        $title = "Create Report";

        $users = User::query()->orderBy('name')->get(['id', 'name', 'email']);
        $entries = Entry::query()->orderBy('id', 'desc')->limit(300)->get(['id', 'title', 'competition_id']);

        return view('admin.reports.create', compact('users', 'entries', 'title'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'], // reporter
            'reported_user_id' => ['nullable', 'exists:users,id'],
            'entry_id' => ['nullable', 'exists:entries,id'],
            'reason' => ['required', 'string', 'max:255'],
            'message' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
        ]);

        Report::create($data);

        toast_created('Report');

        return redirect()->route('admin.reports.index');
    }

    public function edit(Report $report)
    {
        $title = "Edit Report";

        $report->load(['reporter', 'reportedUser', 'entry']);

        $users = User::query()->orderBy('name')->get(['id', 'name', 'email']);
        $entries = Entry::query()->orderBy('id', 'desc')->limit(300)->get(['id', 'title', 'competition_id']);

        return view('admin.reports.edit', compact('report', 'users', 'entries', 'title'));
    }

    public function update(Request $request, Report $report)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'reported_user_id' => ['nullable', 'exists:users,id'],
            'entry_id' => ['nullable', 'exists:entries,id'],
            'reason' => ['required', 'string', 'max:255'],
            'message' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
        ]);

        $report->update($data);

        toast_updated('Report');

        return redirect()->route('admin.reports.index');
    }

    public function destroy(Report $report)
    {
        try {
            $report->delete();
            toast_deleted('Report');
        } catch (\Throwable $e) {
            toast_error('Report cannot be deleted right now.');
        }

        return back();
    }

    public function show(Report $report)
    {
        return redirect()->route('admin.reports.index');
    }
}
