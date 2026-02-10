<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompetitionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CompetitionCategoryController extends Controller
{
    public function index(Request $request)
    {
        $title = "Competition Categories";

        $query = CompetitionCategory::query()->latest();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('slug', 'like', "%{$q}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $categories = $query->paginate(10)->withQueryString();

        return view('admin.competition-categories.index', compact('categories', 'title'));
    }

    public function create()
    {
        $title = "Create Competition Category";
        return view('admin.competition-categories.create', compact('title'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:competition_categories,name'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean']
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = (bool)($data['is_active'] ?? true);

        CompetitionCategory::create($data);

        toast_created('Competition Category');

        return redirect()->route('admin.competition-categories.index');
    }

    public function show(CompetitionCategory $competitionCategory)
    {
        return redirect()->route('admin.competition-categories.edit', $competitionCategory);
    }

    public function edit(CompetitionCategory $competitionCategory)
    {
        $title = "Edit Competition Category";
        $category = $competitionCategory;

        return view('admin.competition-categories.edit', compact('category', 'title'));
    }

    public function update(Request $request, CompetitionCategory $competitionCategory)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('competition_categories', 'name')->ignore($competitionCategory->id)
            ],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean']
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = (bool)($data['is_active'] ?? $competitionCategory->is_active);

        $competitionCategory->update($data);

        toast_updated('Competition Category');

        return redirect()->route('admin.competition-categories.index');
    }

    public function destroy(CompetitionCategory $competitionCategory)
    {
        try {
            $competitionCategory->delete();
            toast_deleted('Competition Category');
        } catch (\Throwable $e) {
            toast_error('Category cannot be deleted right now.');
        }

        return back();
    }

    public function toggle(CompetitionCategory $competitionCategory)
    {
        $competitionCategory->update(['is_active' => !$competitionCategory->is_active]);

        $competitionCategory->is_active ?
            toast_updated('Category Activated') :
            toast_updated('Category Deactivated');

        return back();
    }
}
