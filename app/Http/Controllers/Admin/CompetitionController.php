<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class CompetitionController extends Controller
{
    public function index()
    {
        $title = "Competition";
        $competitions = Competition::query()
            ->latest()
            ->paginate(10);

        return view('admin.competitions.index', compact('competitions', 'title'));
    }

    public function create()
    {
        $title = "Create Competition";
        return view('admin.competitions.create', compact('title'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:competitions,slug'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['draft', 'active', 'closed'])],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'entry_fee' => ['nullable', 'numeric', 'min:0'],
            'rules' => ['nullable', 'string'],
        ]);
        if (!empty($data['start_date'])) {
            $data['start_date'] = Carbon::parse($data['start_date']);
        }

        if (!empty($data['end_date'])) {
            $data['end_date'] = Carbon::parse($data['end_date']);
        }
        // Auto slug if not provided
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);

        // Ensure unique slug if title duplicates
        $data['slug'] = $this->uniqueSlug($data['slug']);

        $data['entry_fee'] = $data['entry_fee'] ?? 0;

        Competition::create($data);

        toast_created('Competition');

        return redirect()->route('admin.competitions.index');
    }

    public function edit(Competition $competition)
    {
        $title = "Edit Competition";
        return view('admin.competitions.edit', compact('competition', 'title'));
    }

    public function update(Request $request, Competition $competition)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('competitions', 'slug')->ignore($competition->id),
            ],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['draft', 'active', 'closed'])],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'entry_fee' => ['nullable', 'numeric', 'min:0'],
            'rules' => ['nullable', 'string'],
        ]);

        if (!empty($data['start_date'])) {
            $data['start_date'] = Carbon::parse($data['start_date']);
        }

        if (!empty($data['end_date'])) {
            $data['end_date'] = Carbon::parse($data['end_date']);
        }

        // Auto slug if empty
        $slug = $data['slug'] ?: Str::slug($data['title']);

        // If slug changed or title changed, keep uniqueness
        if ($slug !== $competition->slug) {
            $slug = $this->uniqueSlug($slug, $competition->id);
        }

        $data['slug'] = $slug;
        $data['entry_fee'] = $data['entry_fee'] ?? 0;

        $competition->update($data);

        toast_updated('Competition');

        return redirect()->route('admin.competitions.index');
    }

    public function destroy(Competition $competition)
    {
        try {
            $competition->delete();
            toast_deleted('Competition');
        } catch (\Throwable $e) {
            toast_error('Competition cannot be deleted right now.');
        }

        return back();
    }

    private function uniqueSlug(string $baseSlug, ?int $ignoreId = null): string
    {
        $slug = $baseSlug;
        $i = 1;

        while (
            Competition::query()
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()
        ) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
