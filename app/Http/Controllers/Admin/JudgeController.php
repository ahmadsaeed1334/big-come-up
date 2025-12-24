<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Judge;
use App\Models\JudgeTag;
use App\Models\JudgingCredential;
use App\Models\CompetitionsJudged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class JudgeController extends Controller
{
    // Index - List all judges
    public function index(Request $request)
    {
        $title = "Judge";
        $query = Judge::with('tags')->latest();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('bio', 'like', "%{$search}%")
                    ->orWhereHas('tags', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $judges = $query->paginate(15);

        // Stats for dashboard
        $totalJudges = Judge::count();
        $activeJudges = Judge::where('is_active', true)->count();
        $totalTags = JudgeTag::count();
        $judgesThisMonth = Judge::whereMonth('created_at', now()->month)->count();
        $recentJudges = Judge::with('tags')->latest()->take(5)->get();
        return view('admin.judges.index', compact(
            'judges',
            'totalJudges',
            'activeJudges',
            'totalTags',
            'judgesThisMonth',
            'recentJudges',
            'title',

        ));
    }
    // Add this method in your JudgeController.php
    public function show(Judge $judge)
    {

        $judge->load(['tags', 'credentials', 'competitions']);

        // Convert skills and philosophies to arrays
        $skills = $judge->expertise_skills ? explode("\n", $judge->expertise_skills) : [];
        $philosophies = $judge->scoring_philosophy ? explode("\n", $judge->scoring_philosophy) : [];

        $title = "Judge Details - " . $judge->name;

        return view('admin.judges.show', compact('judge', 'skills', 'philosophies', 'title'));
    }
    // Create - Show form
    public function create()
    {
        $title = "Create Judge";
        $tags = JudgeTag::all();
        return view('admin.judges.create', compact('tags', 'title'));
    }

    // Store - Save new judge
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'required|string|max:255',
            'bio' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:judge_tags,id',
            'skills' => 'nullable|array',
            'skills.*' => 'required|string',
            'scoring_philosophies' => 'nullable|array',
            'scoring_philosophies.*' => 'required|string',
            'credentials' => 'nullable|array',
            'credentials.*.title' => 'required_with:credentials|string',
            'credentials.*.value' => 'required_with:credentials|string',
            'competitions' => 'nullable|array',
            'competitions.*.title' => 'required_with:competitions|string',
            'competitions.*.type' => 'required_with:competitions|in:current,previous',
            'competitions.*.year' => 'required_with:competitions|integer',
        ]);

        // Upload avatar if exists
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('judges/avatars', 'public');
            $validated['avatar'] = $path;
        }

        // Convert skills and philosophies to text
        $validated['expertise_skills'] = !empty($validated['skills']) ? implode("\n", $validated['skills']) : null;
        $validated['scoring_philosophy'] = !empty($validated['scoring_philosophies']) ? implode("\n", $validated['scoring_philosophies']) : null;

        // Create judge
        $judge = Judge::create($validated);

        // Sync tags
        if (isset($validated['tags'])) {
            $judge->tags()->sync($validated['tags']);
        }

        // Save credentials
        if (isset($validated['credentials'])) {
            foreach ($validated['credentials'] as $index => $credential) {
                $judge->credentials()->create([
                    'title' => $credential['title'],
                    'value' => $credential['value'],
                    'order' => $index,
                ]);
            }
        }

        // Save competitions
        if (isset($validated['competitions'])) {
            foreach ($validated['competitions'] as $index => $competition) {
                $judge->competitions()->create([
                    'title' => $competition['title'],
                    'type' => $competition['type'],
                    'year' => $competition['year'],
                    'order' => $index,
                ]);
            }
        }

        toast_created('Judge');
        return redirect()->route('admin.judges.index');
    }

    // Edit - Show form
    public function edit(Judge $judge)
    {
        $title = "Edit Judge";
        $judge->load(['tags', 'credentials', 'competitions']);
        $tags = JudgeTag::all();

        // Convert skills and philosophies to arrays for edit form
        $skills = $judge->expertise_skills ? explode("\n", $judge->expertise_skills) : [];
        $philosophies = $judge->scoring_philosophy ? explode("\n", $judge->scoring_philosophy) : [];

        return view('admin.judges.edit', compact('judge', 'tags', 'skills', 'philosophies', 'title'));
    }

    // Update - Update judge
    public function update(Request $request, Judge $judge)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'required|string|max:255',
            'bio' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:judge_tags,id',
            'skills' => 'nullable|array',
            'skills.*' => 'required|string',
            'scoring_philosophies' => 'nullable|array',
            'scoring_philosophies.*' => 'required|string',
            'credentials' => 'nullable|array',
            'credentials.*.id' => 'nullable|exists:judging_credentials,id',
            'credentials.*.title' => 'required_with:credentials|string',
            'credentials.*.value' => 'required_with:credentials|string',
            'competitions' => 'nullable|array',
            'competitions.*.id' => 'nullable|exists:competitions_judged,id',
            'competitions.*.title' => 'required_with:competitions|string',
            'competitions.*.type' => 'required_with:competitions|in:current,previous',
            'competitions.*.year' => 'required_with:competitions|integer',
        ]);

        // Upload new avatar if exists
        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($judge->avatar && Storage::disk('public')->exists($judge->avatar)) {
                Storage::disk('public')->delete($judge->avatar);
            }
            $path = $request->file('avatar')->store('judges/avatars', 'public');
            $validated['avatar'] = $path;
        }

        // Convert skills and philosophies to text
        $validated['expertise_skills'] = !empty($validated['skills']) ? implode("\n", $validated['skills']) : null;
        $validated['scoring_philosophy'] = !empty($validated['scoring_philosophies']) ? implode("\n", $validated['scoring_philosophies']) : null;

        // Update judge
        $judge->update($validated);

        // Sync tags
        $judge->tags()->sync($validated['tags'] ?? []);

        // Update or create credentials
        if (isset($validated['credentials'])) {
            $existingCredentialIds = [];
            foreach ($validated['credentials'] as $index => $credentialData) {
                if (isset($credentialData['id'])) {
                    $credential = JudgingCredential::find($credentialData['id']);
                    if ($credential && $credential->judge_id == $judge->id) {
                        $credential->update([
                            'title' => $credentialData['title'],
                            'value' => $credentialData['value'],
                            'order' => $index,
                        ]);
                        $existingCredentialIds[] = $credential->id;
                    }
                } else {
                    $newCredential = $judge->credentials()->create([
                        'title' => $credentialData['title'],
                        'value' => $credentialData['value'],
                        'order' => $index,
                    ]);
                    $existingCredentialIds[] = $newCredential->id;
                }
            }
            // Delete removed credentials
            $judge->credentials()->whereNotIn('id', $existingCredentialIds)->delete();
        } else {
            $judge->credentials()->delete();
        }

        // Update or create competitions
        if (isset($validated['competitions'])) {
            $existingCompetitionIds = [];
            foreach ($validated['competitions'] as $index => $competitionData) {
                if (isset($competitionData['id'])) {
                    $competition = CompetitionsJudged::find($competitionData['id']);
                    if ($competition && $competition->judge_id == $judge->id) {
                        $competition->update([
                            'title' => $competitionData['title'],
                            'type' => $competitionData['type'],
                            'year' => $competitionData['year'],
                            'order' => $index,
                        ]);
                        $existingCompetitionIds[] = $competition->id;
                    }
                } else {
                    $newCompetition = $judge->competitions()->create([
                        'title' => $competitionData['title'],
                        'type' => $competitionData['type'],
                        'year' => $competitionData['year'],
                        'order' => $index,
                    ]);
                    $existingCompetitionIds[] = $newCompetition->id;
                }
            }
            // Delete removed competitions
            $judge->competitions()->whereNotIn('id', $existingCompetitionIds)->delete();
        } else {
            $judge->competitions()->delete();
        }

        toast_updated('Judge');
        return redirect()->route('admin.judges.index');
    }

    // Destroy - Delete judge
    public function destroy(Judge $judge)
    {
        // Delete avatar if exists
        if ($judge->avatar && Storage::disk('public')->exists($judge->avatar)) {
            Storage::disk('public')->delete($judge->avatar);
        }

        $judge->delete();
        toast_deleted('Judge');

        return redirect()->route('admin.judges.index');
    }
}
