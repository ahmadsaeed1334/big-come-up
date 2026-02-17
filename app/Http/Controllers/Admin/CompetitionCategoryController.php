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

        $query = CompetitionCategory::query()
            ->withCount('competitions')
            ->latest();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $categories = $query->paginate(10)->withQueryString();

        // Stats for cards
        $totalCategories = CompetitionCategory::count();
        $activeCategories = CompetitionCategory::where('is_active', true)->count();
        $totalCompetitions = \App\Models\Competition::count();

        return view('admin.competition-categories.index', compact(
            'categories',
            'title',
            'totalCategories',
            'activeCategories',
            'totalCompetitions'
        ));
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

        return redirect()->back();
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

        return redirect()->back();
    }

    public function destroy(CompetitionCategory $competitionCategory)
    {
        // Check if category has competitions
        if ($competitionCategory->competitions()->count() > 0) {
            toast_error('Cannot delete category with existing competitions.');
            return redirect()->back();
        }

        try {
            $competitionCategory->delete();
            toast_deleted('Competition Category');
        } catch (\Throwable $e) {
            toast_error('Category cannot be deleted right now.');
        }

        return redirect()->back();
    }

    public function toggle(CompetitionCategory $competitionCategory)
    {
        $competitionCategory->update(['is_active' => !$competitionCategory->is_active]);

        $competitionCategory->is_active ?
            toast_updated('Category Activated') :
            toast_updated('Category Deactivated');

        return redirect()->back();
    }
}
