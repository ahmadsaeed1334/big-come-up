<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\CompetitionCategory;
use App\Models\CompetitionCriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CompetitionController extends Controller
{
    private function submissionTypes(): array
    {
        return [
            'video' => 'Video',
            'audio' => 'Audio',
            'image' => 'Image',
            'text' => 'Text'
        ];
    }

    private function eligibilityTypes(): array
    {
        return [
            'all_verified_entertainers' => 'All Verified Entertainers',
            'all_entertainers' => 'All Entertainers',
            'only_invited' => 'Only Invited'
        ];
    }

    public function index(Request $request)
    {
        $title = "Competitions";

        // Main query with filters
        $query = Competition::query()->with('category')->latest();

        // Search
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('slug', 'like', "%{$q}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->where('is_published', true);
            } elseif ($request->status === 'draft') {
                $query->where('is_published', false);
            } elseif ($request->status === 'live') {
                $now = now();
                $query->where('start_at', '<=', $now)
                    ->where('end_at', '>=', $now)
                    ->where('is_published', true);
            } elseif ($request->status === 'upcoming') {
                $query->where('start_at', '>', now())
                    ->where('is_published', true);
            } elseif ($request->status === 'ended') {
                $query->where('end_at', '<', now())
                    ->where('is_published', true);
            }
        }

        // Filter by entry fee type
        if ($request->filled('fee_type')) {
            $query->where('entry_fee_type', $request->fee_type);
        }

        $competitions = $query->paginate(10)->withQueryString();

        // Get categories for filter dropdown
        $categories = CompetitionCategory::where('is_active', true)->get();

        // ================ FIX: Add recent competitions ================
        $recentCompetitions = Competition::with('category')
            ->latest()
            ->limit(5)
            ->get();
        // ==============================================================

        // Stats for cards
        $totalCompetitions = Competition::count();
        $publishedCompetitions = Competition::where('is_published', true)->count();
        $upcomingCompetitions = Competition::where('start_at', '>', now())
            ->where('is_published', true)
            ->count();
        $totalPrizePool = Competition::where('is_published', true)->sum('prize_amount');

        return view('admin.competitions.index', compact(
            'competitions',
            'categories',
            'title',
            'recentCompetitions',    // ✅ Added here
            'totalCompetitions',
            'publishedCompetitions',
            'upcomingCompetitions',
            'totalPrizePool'
        ));
    }

    public function create()
    {
        $title = "Create Competition";
        $categories = CompetitionCategory::where('is_active', true)->get();
        $submissionTypes = $this->submissionTypes();
        $eligibilityTypes = $this->eligibilityTypes();

        return view('admin.competitions.create', compact('categories', 'submissionTypes', 'eligibilityTypes', 'title'));
    }

    public function store(Request $request)
    {
        $data = $this->validateCompetition($request);

        // Generate slug
        $data['slug'] = Str::slug($data['title']);

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('competitions', 'public');
        }

        // Create competition
        $competition = Competition::create($data);

        // Save criteria
        if ($request->filled('criteria')) {
            foreach ($request->criteria as $criterion) {
                if (!empty($criterion['name'])) {
                    $competition->criteria()->create([
                        'name' => $criterion['name'],
                        'weight' => $criterion['weight'] ?? 100,
                        'max_score' => $criterion['max_score'] ?? 10,
                        'description' => $criterion['description'] ?? null
                    ]);
                }
            }
        }

        toast_created('Competition');

        return redirect()->route('admin.competitions.index');
    }

    public function show(Competition $competition)
    {
        $title = "View Competition";
        $competition->load('category', 'criteria');
        $eligibilityTypes = $this->eligibilityTypes();
        $submissionTypes = $this->submissionTypes();

        // Get counts (you can replace with actual relationships later)
        $competition->submissions_count = 0;
        $competition->participants_count = 0;
        $competition->votes_count = 0;

        return view('admin.competitions.show', compact('competition', 'title', 'eligibilityTypes', 'submissionTypes'));
    }

    public function edit(Competition $competition)
    {
        $title = "Edit Competition";
        $competition->load('criteria');
        $categories = CompetitionCategory::where('is_active', true)->get();
        $submissionTypes = $this->submissionTypes();
        $eligibilityTypes = $this->eligibilityTypes();

        return view('admin.competitions.edit', compact('competition', 'categories', 'submissionTypes', 'eligibilityTypes', 'title'));
    }

    public function update(Request $request, Competition $competition)
    {
        $data = $this->validateCompetition($request, $competition->id);

        // Update slug if title changed
        if ($competition->title !== $data['title']) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($competition->cover_image) {
                Storage::disk('public')->delete($competition->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('competitions', 'public');
        }

        // Check if cover should be removed
        if ($request->input('remove_cover') == '1' && $competition->cover_image) {
            Storage::disk('public')->delete($competition->cover_image);
            $data['cover_image'] = null;
        }

        // Update competition
        $competition->update($data);

        // Update criteria
        $competition->criteria()->delete();
        if ($request->filled('criteria')) {
            foreach ($request->criteria as $criterion) {
                if (!empty($criterion['name'])) {
                    $competition->criteria()->create([
                        'name' => $criterion['name'],
                        'weight' => $criterion['weight'] ?? 100,
                        'max_score' => $criterion['max_score'] ?? 10,
                        'description' => $criterion['description'] ?? null
                    ]);
                }
            }
        }

        toast_updated('Competition');

        return redirect()->route('admin.competitions.index');
    }

    public function destroy(Competition $competition)
    {
        try {
            // Delete cover image if exists
            if ($competition->cover_image) {
                Storage::disk('public')->delete($competition->cover_image);
            }

            $competition->delete();
            toast_deleted('Competition');
        } catch (\Throwable $e) {
            toast_error('Competition cannot be deleted right now.');
        }

        return redirect()->back();
    }

    public function toggle(Competition $competition)
    {
        $competition->update(['is_published' => !$competition->is_published]);

        $competition->is_published ?
            toast_updated('Competition Published') :
            toast_updated('Competition Unpublished');

        return redirect()->back();
    }

    private function validateCompetition(Request $request, $competitionId = null)
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:competition_categories,id'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],

            'submission_type' => ['required', Rule::in(array_keys($this->submissionTypes()))],
            'video_duration_limit' => ['nullable', 'required_if:submission_type,video', 'integer', 'min:1', 'max:3600'],

            'eligibility' => ['required', Rule::in(array_keys($this->eligibilityTypes()))],

            'entry_fee_type' => ['required', Rule::in(['free', 'paid'])],
            'entry_fee_amount' => ['required_if:entry_fee_type,paid', 'nullable', 'numeric', 'min:0', 'max:10000'],

            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date', 'after:start_at'],
            'voting_start_at' => ['nullable', 'date', 'after_or_equal:start_at'],
            'voting_end_at' => ['nullable', 'date', 'after:voting_start_at', 'before_or_equal:end_at'],

            'judge_score_weight' => ['required', 'integer', 'min:0', 'max:100'],
            'public_votes_weight' => ['required', 'integer', 'min:0', 'max:100'],
            'fraud_protection' => ['nullable', 'boolean'],

            'prize_title' => ['required', 'string', 'max:255'],
            'prize_amount' => ['required', 'numeric', 'min:0', 'max:999999.99'],
            'prize_description' => ['nullable', 'string'],

            'is_published' => ['nullable', 'boolean'],

            'criteria' => ['nullable', 'array'],
            'criteria.*.name' => ['required_with:criteria', 'string', 'max:255'],
            'criteria.*.weight' => ['nullable', 'integer', 'min:1', 'max:100'],
            'criteria.*.max_score' => ['nullable', 'integer', 'min:1', 'max:100'],
            'criteria.*.description' => ['nullable', 'string']
        ];

        // Add unique title rule for create/update
        if ($competitionId) {
            $rules['title'][] = Rule::unique('competitions', 'title')->ignore($competitionId);
        } else {
            $rules['title'][] = 'unique:competitions,title';
        }

        // Validate judge and public weights sum
        $request->validate($rules, [
            'judge_score_weight.required' => 'Judge score weight is required',
            'public_votes_weight.required' => 'Public votes weight is required',
            'end_at.after' => 'End date must be after start date',
            'voting_end_at.after' => 'Voting end date must be after voting start date',
            'video_duration_limit.required_if' => 'Video duration limit is required for video submissions',
            'entry_fee_amount.required_if' => 'Entry fee amount is required for paid competitions'
        ]);

        // Custom validation for weights sum
        if (($request->judge_score_weight + $request->public_votes_weight) !== 100) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'judge_score_weight' => 'Judge score and public votes weights must sum to 100%',
                'public_votes_weight' => 'Judge score and public votes weights must sum to 100%'
            ]);
        }

        return $request->only(array_keys($rules));
    }
}
