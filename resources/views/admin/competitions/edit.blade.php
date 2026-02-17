@extends('layouts.app')

@section('title', 'Edit Competition: ' . $competition->title)

@section('content')
    <form action="{{ route('admin.competitions.update', $competition) }}" method="POST" enctype="multipart/form-data"
        id="editCompetitionForm">
        @csrf
        @method('PUT')

        <!-- Profile Header Card -->
        <div class="card shadow-lg mx-4 card-profile-bottom mb-4">
            <div class="card-body p-3">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative" id="coverPreviewContainer">
                            <img src="{{ $competition->cover_image ? Storage::url($competition->cover_image) : 'https://ui-avatars.com/api/?name=' . urlencode($competition->title) . '&background=random&length=2&size=120' }}"
                                alt="Cover Preview" class="w-100 border-radius-lg shadow-sm" id="coverPreview">
                            <div class="avatar-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 rounded"
                                style="display:none !important">
                                <i class="ni ni-camera-compact text-white text-lg"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                <input type="text" class="form-control form-control-lg border-0 px-0 bg-transparent"
                                    id="title" name="title" value="{{ old('title', $competition->title) }}"
                                    placeholder="Enter Competition Title" required
                                    style="font-size: 1.5rem; font-weight: 600; max-width: 400px;">
                                @error('title')
                                    <div class="text-danger text-sm">{{ $message }}</div>
                                @enderror
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                <span id="slug-preview" class="text-muted">slug: {{ $competition->slug }}</span>
                            </p>
                            <span class="badge bg-gradient-info mt-2">ID: #{{ $competition->id }}</span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                <li class="nav-item">
                                    <label
                                        class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center cursor-pointer"
                                        for="cover_image">
                                        <i class="ni ni-camera-compact"></i>
                                        <span class="ms-2">Change Cover</span>
                                        <input type="file" class="d-none" id="cover_image" name="cover_image"
                                            accept="image/*">
                                    </label>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.competitions.show', $competition) }}"
                                        class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-eye"></i>
                                        <span class="ms-2">Preview</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <button type="button"
                                        class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center bg-gradient-danger text-white"
                                        onclick="confirmDelete()">
                                        <i class="fas fa-trash"></i>
                                        <span class="ms-2">Delete</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Steps -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div
                            class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                            <div class="step step-active">
                                <div class="step-icon-wrap">
                                    <div class="step-icon"><i class="fas fa-info-circle"></i></div>
                                </div>
                                <h6 class="step-title">Basic Info</h6>
                            </div>
                            <div class="step">
                                <div class="step-icon-wrap">
                                    <div class="step-icon"><i class="fas fa-gavel"></i></div>
                                </div>
                                <h6 class="step-title">Entry Rules</h6>
                            </div>
                            <div class="step">
                                <div class="step-icon-wrap">
                                    <div class="step-icon"><i class="fas fa-calendar-alt"></i></div>
                                </div>
                                <h6 class="step-title">Dates & Timeline</h6>
                            </div>
                            <div class="step">
                                <div class="step-icon-wrap">
                                    <div class="step-icon"><i class="fas fa-star"></i></div>
                                </div>
                                <h6 class="step-title">Scoring & Criteria</h6>
                            </div>
                            <div class="step">
                                <div class="step-icon-wrap">
                                    <div class="step-icon"><i class="fas fa-trophy"></i></div>
                                </div>
                                <h6 class="step-title">Prize Details</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column: Main Form -->
            <div class="col-md-8">
                <!-- Step 1: Basic Information Card -->
                <div class="card mb-4" id="step1">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0 text-uppercase text-sm font-weight-bold">
                                <span class="badge bg-gradient-primary me-2">Step 1</span> Basic Information
                            </p>
                            <span class="badge bg-gradient-{{ $competition->is_published ? 'success' : 'secondary' }} ms-3">
                                {{ $competition->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Category -->
                                <div class="form-group mb-3">
                                    <label class="form-label mb-1">Category <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-grid-3x3-gap-fill"></i>
                                        </span>
                                        <select name="category_id" class="form-select border-start-0" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('category_id', $competition->category_id) == $category->id)>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Submission Type -->
                                <div class="form-group mb-3">
                                    <label class="form-label mb-1">Submission Type <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-file-earmark-arrow-up"></i>
                                        </span>
                                        <select name="submission_type" class="form-select border-start-0" required
                                            id="submission_type">
                                            @foreach ($submissionTypes as $value => $label)
                                                <option value="{{ $value }}" @selected(old('submission_type', $competition->submission_type) == $value)>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('submission_type')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Short Description -->
                        <div class="form-group mb-3">
                            <label class="form-label mb-1">Short Description</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ni ni-align-left-2"></i>
                                </span>
                                <textarea name="short_description" class="form-control border-start-0" rows="3"
                                    placeholder="Brief description of the competition (max 500 characters)">{{ old('short_description', $competition->short_description) }}</textarea>
                            </div>
                            @error('short_description')
                                <div class="text-danger text-sm">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Displayed on competition cards and listings</small>
                        </div>

                        <!-- Video Duration Limit (Conditional) -->
                        <div class="form-group mb-3" id="video_duration_field"
                            style="{{ $competition->submission_type == 'video' ? 'display: block;' : 'display: none;' }}">
                            <label class="form-label mb-1">Video Duration Limit (seconds) <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-camera-reels"></i>
                                </span>
                                <input type="number" name="video_duration_limit" class="form-control border-start-0"
                                    placeholder="e.g., 180" min="1"
                                    value="{{ old('video_duration_limit', $competition->video_duration_limit) }}">
                                <span class="input-group-text">seconds</span>
                            </div>
                            @error('video_duration_limit')
                                <div class="text-danger text-sm">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Maximum video length allowed for submissions</small>
                        </div>

                        <!-- Current Cover Image Info -->
                        @if ($competition->cover_image)
                            <div class="alert alert-light py-2 mt-2">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-image text-primary me-2"></i>
                                    <span class="text-sm">Current cover image:
                                        {{ basename($competition->cover_image) }}</span>
                                    <button type="button" class="btn btn-sm btn-link text-danger ms-auto"
                                        onclick="removeCover()">
                                        <i class="fas fa-times"></i> Remove
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="remove_cover" id="remove_cover" value="0">
                        @endif
                    </div>
                </div>

                <!-- Step 2: Entry Rules Card -->
                <div class="card mb-4" id="step2">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0 text-uppercase text-sm font-weight-bold">
                                <span class="badge bg-gradient-primary me-2">Step 2</span> Entry Rules
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Eligibility -->
                        <div class="form-group mb-4">
                            <label class="form-label mb-1">Eligibility <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-person-check"></i>
                                </span>
                                <select name="eligibility" class="form-select border-start-0" required>
                                    @foreach ($eligibilityTypes as $value => $label)
                                        <option value="{{ $value }}" @selected(old('eligibility', $competition->eligibility) == $value)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('eligibility')
                                <div class="text-danger text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Entry Fee -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label mb-1">Fee Type <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-currency-dollar"></i>
                                        </span>
                                        <select name="entry_fee_type" class="form-select border-start-0" required
                                            id="entry_fee_type">
                                            <option value="free" @selected(old('entry_fee_type', $competition->entry_fee_type) == 'free')>Free</option>
                                            <option value="paid" @selected(old('entry_fee_type', $competition->entry_fee_type) == 'paid')>Paid</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8" id="entry_fee_amount_field"
                                style="{{ $competition->entry_fee_type == 'paid' ? 'display: block;' : 'display: none;' }}">
                                <div class="form-group mb-3">
                                    <label class="form-label mb-1">Entry Fee Amount <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" min="0" name="entry_fee_amount"
                                            class="form-control" placeholder="0.00"
                                            value="{{ old('entry_fee_amount', $competition->entry_fee_amount) }}">
                                    </div>
                                    @error('entry_fee_amount')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Dates & Timeline Card -->
                <div class="card mb-4" id="step3">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0 text-uppercase text-sm font-weight-bold">
                                <span class="badge bg-gradient-primary me-2">Step 3</span> Dates & Timeline
                            </p>
                            @php
                                $now = now();
                                $isLive = $now->between($competition->start_at, $competition->end_at);
                                $isEnded = $now->greaterThan($competition->end_at);
                            @endphp
                            @if ($isLive)
                                <span class="badge bg-gradient-success ms-3">Live Now</span>
                            @elseif($isEnded)
                                <span class="badge bg-gradient-dark ms-3">Ended</span>
                            @else
                                <span class="badge bg-gradient-info ms-3">Upcoming</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label mb-1">Start Date & Time <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar-check"></i>
                                        </span>
                                        <input type="datetime-local" name="start_at" class="form-control border-start-0"
                                            required
                                            value="{{ old('start_at', $competition->start_at->format('Y-m-d\TH:i')) }}">
                                    </div>
                                    @error('start_at')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label mb-1">End Date & Time <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar-x"></i>
                                        </span>
                                        <input type="datetime-local" name="end_at" class="form-control border-start-0"
                                            required
                                            value="{{ old('end_at', $competition->end_at->format('Y-m-d\TH:i')) }}">
                                    </div>
                                    @error('end_at')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label mb-1">Voting Start (Optional)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar-check"></i>
                                        </span>
                                        <input type="datetime-local" name="voting_start_at"
                                            class="form-control border-start-0"
                                            value="{{ old('voting_start_at', $competition->voting_start_at ? $competition->voting_start_at->format('Y-m-d\TH:i') : '') }}">
                                    </div>
                                    @error('voting_start_at')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label mb-1">Voting End (Optional)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar-x"></i>
                                        </span>
                                        <input type="datetime-local" name="voting_end_at"
                                            class="form-control border-start-0"
                                            value="{{ old('voting_end_at', $competition->voting_end_at ? $competition->voting_end_at->format('Y-m-d\TH:i') : '') }}">
                                    </div>
                                    @error('voting_end_at')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info py-2">
                            <i class="bi bi-info-circle me-2"></i>
                            <small>If voting dates are not specified, public voting will be open throughout the competition
                                period.</small>
                        </div>

                        <!-- Timeline Status -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="bg-gray-100 p-3 border-radius-lg">
                                    <h6 class="text-sm mb-2">Competition Timeline Status</h6>
                                    <div class="progress mb-2" style="height: 8px;">
                                        @php
                                            $totalDuration = $competition->start_at->diffInSeconds(
                                                $competition->end_at,
                                            );
                                            $elapsed = $now->greaterThan($competition->start_at)
                                                ? ($now->lessThan($competition->end_at)
                                                    ? $now->diffInSeconds($competition->start_at)
                                                    : $totalDuration)
                                                : 0;
                                            $progress = $totalDuration > 0 ? ($elapsed / $totalDuration) * 100 : 0;
                                        @endphp
                                        <div class="progress-bar bg-gradient-success" role="progressbar"
                                            style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-xs">{{ $competition->start_at->format('M d, Y H:i') }}</span>
                                        <span class="text-xs font-weight-bold">
                                            @if ($isEnded)
                                                Ended
                                            @elseif($isLive)
                                                Live ({{ $now->diffInDays($competition->end_at) }} days left)
                                            @else
                                                Starts in {{ $now->diffInDays($competition->start_at) }} days
                                            @endif
                                        </span>
                                        <span class="text-xs">{{ $competition->end_at->format('M d, Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Scoring & Criteria Card -->
                <div class="card mb-4" id="step4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-0 text-uppercase text-sm font-weight-bold">
                                    <span class="badge bg-gradient-primary me-2">Step 4</span> Scoring & Criteria
                                </p>
                            </div>
                            <span class="badge bg-gradient-warning">Weights must sum to 100%</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label mb-1">Judge Score Weight (%)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-person-badge"></i>
                                        </span>
                                        <input type="number" name="judge_score_weight"
                                            class="form-control border-start-0" min="0" max="100"
                                            value="{{ old('judge_score_weight', $competition->judge_score_weight) }}"
                                            id="judge_weight">
                                    </div>
                                    @error('judge_score_weight')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label mb-1">Public Votes Weight (%)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-people"></i>
                                        </span>
                                        <input type="number" name="public_votes_weight"
                                            class="form-control border-start-0" min="0" max="100"
                                            value="{{ old('public_votes_weight', $competition->public_votes_weight) }}"
                                            id="public_weight">
                                    </div>
                                    @error('public_votes_weight')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div id="weight-sum-alert" class="alert" style="display: none;">
                            <span id="weight-sum-message"></span>
                        </div>

                        <!-- Fraud Protection -->
                        <div class="form-group mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="fraud_protection"
                                    name="fraud_protection" value="1"
                                    {{ old('fraud_protection', $competition->fraud_protection) ? 'checked' : '' }}>
                                <label class="form-check-label" for="fraud_protection">
                                    Enable Fraud Protection
                                </label>
                            </div>
                            <small class="form-text text-muted">
                                Advanced algorithms to detect and prevent voting fraud
                            </small>
                        </div>

                        <!-- Judging Criteria -->
                        <div class="form-group mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-control-label">Judging Criteria</label>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addCriteria()">
                                    <i class="ni ni-fat-add"></i> Add Criteria
                                </button>
                            </div>
                            <div id="criteria-container">
                                @forelse ($competition->criteria as $index => $criterion)
                                    <div class="mb-3 p-3 bg-gray-100 border-radius-lg">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="mb-0 text-sm">Criterion #{{ $index + 1 }}</h6>
                                            <button type="button" class="btn btn-sm btn-link text-danger p-0"
                                                onclick="this.parentElement.parentElement.remove(); updateCriteriaCount();">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                    <label class="form-control-label text-sm">Name</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-check-circle"></i>
                                                        </span>
                                                        <input type="text" class="form-control"
                                                            name="criteria[{{ $index }}][name]"
                                                            placeholder="e.g., Creativity & Originality" required
                                                            value="{{ $criterion->name }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-2">
                                                    <label class="form-control-label text-sm">Weight (%)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">%</span>
                                                        <input type="number" class="form-control"
                                                            name="criteria[{{ $index }}][weight]" min="1"
                                                            max="100" value="{{ $criterion->weight }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-2">
                                                    <label class="form-control-label text-sm">Max Score</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-star"></i>
                                                        </span>
                                                        <input type="number" class="form-control"
                                                            name="criteria[{{ $index }}][max_score]"
                                                            value="{{ $criterion->max_score ?? 10 }}" min="1"
                                                            max="100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label text-sm">Description (Optional)</label>
                                            <textarea class="form-control form-control-sm" name="criteria[{{ $index }}][description]" rows="2"
                                                placeholder="Detailed explanation of this criterion">{{ $criterion->description }}</textarea>
                                        </div>
                                    </div>
                                @empty
                                    <div class="mb-3 p-3 bg-gray-100 border-radius-lg">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="mb-0 text-sm">Criterion #1</h6>
                                            <button type="button" class="btn btn-sm btn-link text-danger p-0"
                                                onclick="this.parentElement.parentElement.remove(); updateCriteriaCount();">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                    <label class="form-control-label text-sm">Name</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-check-circle"></i>
                                                        </span>
                                                        <input type="text" class="form-control"
                                                            name="criteria[0][name]"
                                                            placeholder="e.g., Creativity & Originality" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-2">
                                                    <label class="form-control-label text-sm">Weight (%)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">%</span>
                                                        <input type="number" class="form-control"
                                                            name="criteria[0][weight]" min="1" max="100"
                                                            value="100">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-2">
                                                    <label class="form-control-label text-sm">Max Score</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-star"></i>
                                                        </span>
                                                        <input type="number" class="form-control"
                                                            name="criteria[0][max_score]" value="10" min="1"
                                                            max="100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label text-sm">Description (Optional)</label>
                                            <textarea class="form-control form-control-sm" name="criteria[0][description]" rows="2"
                                                placeholder="Detailed explanation of this criterion"></textarea>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 5: Prize Details Card -->
                <div class="card mb-4" id="step5">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0 text-uppercase text-sm font-weight-bold">
                                <span class="badge bg-gradient-primary me-2">Step 5</span> Prize Details
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label mb-1">Prize Title <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-trophy"></i>
                                        </span>
                                        <input type="text" name="prize_title" class="form-control border-start-0"
                                            placeholder="e.g., Grand Prize" required
                                            value="{{ old('prize_title', $competition->prize_title) }}">
                                    </div>
                                    @error('prize_title')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label mb-1">Prize Amount <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" min="0" name="prize_amount"
                                            class="form-control" placeholder="0.00" required
                                            value="{{ old('prize_amount', $competition->prize_amount) }}">
                                    </div>
                                    @error('prize_amount')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label mb-1">Full Prize Description</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ni ni-align-left-2"></i>
                                </span>
                                <textarea name="prize_description" class="form-control border-start-0" rows="4"
                                    placeholder="Detailed description of the prize (cash, trophies, certificates, etc.)">{{ old('prize_description', $competition->prize_description) }}</textarea>
                            </div>
                            @error('prize_description')
                                <div class="text-danger text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Publish Status Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-group mb-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_published" name="is_published"
                                    value="1" {{ old('is_published', $competition->is_published) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_published">
                                    <span class="font-weight-bold">Publish Competition</span>
                                </label>
                            </div>
                            <small class="form-text text-muted">
                                If published, the competition will be visible to users immediately. If not, save as draft.
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Last Updated Info -->
                <div class="alert alert-light">
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted d-block">Created</small>
                            <span>{{ $competition->created_at->format('F d, Y h:i A') }}</span>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Last Updated</small>
                            <span>{{ $competition->updated_at->format('F d, Y h:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Side Cards -->
            <div class="col-md-4">
                <!-- Competition Preview Card -->
                <div class="card mb-4">
                    <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                        <h6 class="mb-0">Live Preview</h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="text-center mb-3">
                            <div class="avatar avatar-xxl mx-auto mb-3">
                                <img src="{{ $competition->cover_image ? Storage::url($competition->cover_image) : 'https://ui-avatars.com/api/?name=' . urlencode($competition->title) . '&background=random&length=2&size=120' }}"
                                    id="preview-cover" class="avatar-img rounded">
                            </div>
                            <h5 id="preview-title">{{ $competition->title }}</h5>
                            <p class="text-sm text-muted mb-2" id="preview-category">
                                Category: {{ $competition->category->name ?? 'Not selected' }}
                            </p>
                            <div class="d-flex justify-content-center mb-2">
                                <span
                                    class="badge bg-gradient-{{ $competition->entry_fee_type == 'free' ? 'success' : 'warning' }} me-1"
                                    id="preview-fee">
                                    {{ $competition->entry_fee_type == 'free' ? 'Free' : '$' . number_format($competition->entry_fee_amount, 2) }}
                                </span>
                                <span class="badge bg-gradient-info" id="preview-submission">
                                    {{ $submissionTypes[$competition->submission_type] ?? $competition->submission_type }}
                                </span>
                            </div>
                            <p class="text-sm" id="preview-description">
                                {{ $competition->short_description ?? 'No description provided' }}
                            </p>
                        </div>
                        <div class="border-top pt-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-sm">Prize:</span>
                                <span class="font-weight-bold"
                                    id="preview-prize">${{ number_format($competition->prize_amount, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-sm">Prize Title:</span>
                                <span class="text-muted text-sm">{{ $competition->prize_title }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-sm">Start Date:</span>
                                <span class="text-muted text-sm"
                                    id="preview-start">{{ $competition->start_at->format('M d, Y H:i') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-sm">End Date:</span>
                                <span class="text-muted text-sm"
                                    id="preview-end">{{ $competition->end_at->format('M d, Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Timeline Summary Card -->
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Timeline Summary</h6>
                    </div>
                    <div class="card-body">
                        <div class="timeline-steps">
                            <div class="d-flex mb-3">
                                <div class="timeline-icon bg-gradient-success text-white">
                                    <i class="bi bi-flag"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0 text-sm">Competition Starts</h6>
                                    <span class="text-xs text-muted" id="summary-start">
                                        {{ $competition->start_at->format('M d, Y H:i') }}
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <div class="timeline-icon bg-gradient-info text-white">
                                    <i class="bi bi-vote"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0 text-sm">Voting Period</h6>
                                    <span class="text-xs text-muted" id="summary-voting">
                                        @if ($competition->voting_start_at && $competition->voting_end_at)
                                            {{ $competition->voting_start_at->format('M d, Y H:i') }} -
                                            {{ $competition->voting_end_at->format('M d, Y H:i') }}
                                        @else
                                            Throughout competition
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="timeline-icon bg-gradient-danger text-white">
                                    <i class="bi bi-flag-fill"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0 text-sm">Competition Ends</h6>
                                    <span class="text-xs text-muted" id="summary-end">
                                        {{ $competition->end_at->format('M d, Y H:i') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Scoring Summary Card -->
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Scoring Configuration</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-sm">Judge Weight:</span>
                            <span class="font-weight-bold"
                                id="preview-judge-weight">{{ $competition->judge_score_weight }}%</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-sm">Public Weight:</span>
                            <span class="font-weight-bold"
                                id="preview-public-weight">{{ $competition->public_votes_weight }}%</span>
                        </div>
                        <div class="progress mb-3" style="height: 8px;">
                            <div class="progress-bar bg-primary" role="progressbar" id="judge-progress"
                                style="width: {{ $competition->judge_score_weight }}%;"></div>
                            <div class="progress-bar bg-info" role="progressbar" id="public-progress"
                                style="width: {{ $competition->public_votes_weight }}%;"></div>
                        </div>
                        <div id="preview-criteria-count" class="text-sm text-muted">
                            <i class="bi bi-check-circle me-1"></i> {{ $competition->criteria->count() }} criteria added
                        </div>
                        <div class="mt-2">
                            <span
                                class="badge bg-gradient-{{ $competition->fraud_protection ? 'success' : 'secondary' }}">
                                <i class="bi bi-shield-check me-1"></i>
                                Fraud Protection: {{ $competition->fraud_protection ? 'Enabled' : 'Disabled' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Statistics Card -->
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Competition Statistics</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-sm">Total Submissions:</span>
                            <span class="badge bg-gradient-info">{{ $competition->submissions_count ?? 0 }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-sm">Total Participants:</span>
                            <span class="badge bg-gradient-primary">{{ $competition->participants_count ?? 0 }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-sm">Total Votes:</span>
                            <span class="badge bg-gradient-warning">{{ $competition->votes_count ?? 0 }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-sm">Days Remaining:</span>
                            @php
                                $daysRemaining = now()->diffInDays($competition->end_at, false);
                            @endphp
                            <span
                                class="badge bg-gradient-{{ $daysRemaining > 7 ? 'success' : ($daysRemaining > 3 ? 'warning' : 'danger') }}">
                                {{ $daysRemaining > 0 ? $daysRemaining . ' days' : 'Ended' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                <i class="fas fa-save me-2"></i> Update Competition
                            </button>
                            <a href="{{ route('admin.competitions.show', $competition) }}"
                                class="btn btn-outline-info w-100">
                                <i class="bi bi-eye me-2"></i> View Details
                            </a>
                            <a href="{{ route('admin.competitions.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-arrow-left me-2"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Delete Form (Hidden) -->
    <form id="delete-form" action="{{ route('admin.competitions.destroy', $competition) }}" method="POST"
        style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
        <script>
            let criteriaCount = {{ max($competition->criteria->count(), 1) }};

            // Cover image preview
            document.getElementById('cover_image').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('coverPreview').src = e.target.result;
                        document.getElementById('preview-cover').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Remove cover image
            window.removeCover = function() {
                Swal.fire({
                    title: 'Remove Cover Image?',
                    text: 'The current cover image will be removed.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, remove it',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('remove_cover').value = '1';
                        document.getElementById('coverPreview').src = 'https://ui-avatars.com/api/?name=' +
                            encodeURIComponent(document.getElementById('title').value || 'New Competition') +
                            '&background=random&length=2&size=120';
                        document.getElementById('preview-cover').src = 'https://ui-avatars.com/api/?name=' +
                            encodeURIComponent(document.getElementById('title').value || 'New Competition') +
                            '&background=random&length=2&size=120';

                        Swal.fire(
                            'Removed!',
                            'Cover image will be removed upon update.',
                            'success'
                        );
                    }
                });
            };

            // Title input updates preview and slug
            document.getElementById('title').addEventListener('input', function(e) {
                const title = e.target.value || '{{ $competition->title }}';
                const slug = title.toLowerCase()
                    .replace(/[^\w\s]/gi, '')
                    .replace(/\s+/g, '-');

                document.getElementById('slug-preview').textContent = 'slug: ' + slug;
                document.getElementById('preview-title').textContent = title;
            });

            // Category preview
            document.querySelector('select[name="category_id"]').addEventListener('change', function(e) {
                const selected = e.target.options[e.target.selectedIndex];
                const categoryName = selected.text || 'Not selected';
                document.getElementById('preview-category').textContent = `Category: ${categoryName}`;
            });

            // Submission type preview
            document.querySelector('select[name="submission_type"]').addEventListener('change', function(e) {
                const selected = e.target.options[e.target.selectedIndex];
                document.getElementById('preview-submission').textContent = selected.text;

                // Show/hide video duration field
                const videoField = document.getElementById('video_duration_field');
                if (e.target.value === 'video') {
                    videoField.style.display = 'block';
                    document.querySelector('input[name="video_duration_limit"]').setAttribute('required', 'required');
                } else {
                    videoField.style.display = 'none';
                    document.querySelector('input[name="video_duration_limit"]').removeAttribute('required');
                }
            });

            // Entry fee type preview
            document.querySelector('select[name="entry_fee_type"]').addEventListener('change', function(e) {
                const amountField = document.getElementById('entry_fee_amount_field');
                const previewFee = document.getElementById('preview-fee');

                if (e.target.value === 'free') {
                    amountField.style.display = 'none';
                    previewFee.textContent = 'Free';
                    previewFee.className = 'badge bg-gradient-success me-1';
                } else {
                    amountField.style.display = 'block';
                    previewFee.textContent = 'Paid';
                    previewFee.className = 'badge bg-gradient-warning me-1';

                    // Trigger amount update
                    const amountInput = document.querySelector('input[name="entry_fee_amount"]');
                    if (amountInput.value) {
                        previewFee.textContent = '$' + parseFloat(amountInput.value).toFixed(2);
                    }
                }
            });

            // Entry fee amount preview
            document.querySelector('input[name="entry_fee_amount"]').addEventListener('input', function(e) {
                if (document.querySelector('select[name="entry_fee_type"]').value === 'paid') {
                    const amount = parseFloat(e.target.value || 0).toFixed(2);
                    document.getElementById('preview-fee').textContent = `$${amount}`;
                }
            });

            // Short description preview
            document.querySelector('textarea[name="short_description"]').addEventListener('input', function(e) {
                const desc = e.target.value || '{{ $competition->short_description ?? 'No description provided' }}';
                document.getElementById('preview-description').textContent =
                    desc.length > 100 ? desc.substring(0, 100) + '...' : desc;
            });

            // Prize preview
            document.querySelector('input[name="prize_amount"]').addEventListener('input', function(e) {
                const amount = parseFloat(e.target.value || 0).toFixed(2);
                document.getElementById('preview-prize').textContent = `$${amount}`;
            });

            // Date preview
            document.querySelector('input[name="start_at"]').addEventListener('change', function(e) {
                const date = e.target.value ? new Date(e.target.value).toLocaleString() : 'Not set';
                document.getElementById('preview-start').textContent = date;
                document.getElementById('summary-start').textContent = date;
            });

            document.querySelector('input[name="end_at"]').addEventListener('change', function(e) {
                const date = e.target.value ? new Date(e.target.value).toLocaleString() : 'Not set';
                document.getElementById('preview-end').textContent = date;
                document.getElementById('summary-end').textContent = date;
            });

            document.querySelector('input[name="voting_start_at"]').addEventListener('change', function(e) {
                updateVotingSummary();
            });

            document.querySelector('input[name="voting_end_at"]').addEventListener('change', function(e) {
                updateVotingSummary();
            });

            function updateVotingSummary() {
                const start = document.querySelector('input[name="voting_start_at"]').value;
                const end = document.querySelector('input[name="voting_end_at"]').value;

                if (start && end) {
                    const startDate = new Date(start).toLocaleString();
                    const endDate = new Date(end).toLocaleString();
                    document.getElementById('summary-voting').textContent = `${startDate} - ${endDate}`;
                } else {
                    document.getElementById('summary-voting').textContent = 'Throughout competition';
                }
            }

            // Judge & Public weights
            function updateWeights() {
                const judgeWeight = parseInt(document.getElementById('judge_weight').value) || 0;
                const publicWeight = parseInt(document.getElementById('public_weight').value) || 0;
                const total = judgeWeight + publicWeight;

                document.getElementById('preview-judge-weight').textContent = judgeWeight + '%';
                document.getElementById('preview-public-weight').textContent = publicWeight + '%';

                // Update progress bar
                document.getElementById('judge-progress').style.width = judgeWeight + '%';
                document.getElementById('public-progress').style.width = publicWeight + '%';

                // Show alert if not 100%
                const alertBox = document.getElementById('weight-sum-alert');
                if (total !== 100) {
                    alertBox.className = 'alert alert-warning';
                    document.getElementById('weight-sum-message').innerHTML =
                        `<i class="bi bi-exclamation-triangle me-2"></i> Judge and Public weights sum to ${total}%. They should sum to 100%.`;
                    alertBox.style.display = 'block';
                } else {
                    alertBox.style.display = 'none';
                }
            }

            document.getElementById('judge_weight').addEventListener('input', updateWeights);
            document.getElementById('public_weight').addEventListener('input', updateWeights);
            updateWeights();

            // Add Criteria
            window.addCriteria = function() {
                criteriaCount++;
                const container = document.getElementById('criteria-container');
                const div = document.createElement('div');
                div.className = 'mb-3 p-3 bg-gray-100 border-radius-lg';
                div.innerHTML = `
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h6 class="mb-0 text-sm">Criterion #${criteriaCount}</h6>
                        <button type="button" class="btn btn-sm btn-link text-danger p-0" 
                            onclick="this.parentElement.parentElement.remove(); updateCriteriaCount();">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-control-label text-sm">Name</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-check-circle"></i>
                                    </span>
                                    <input type="text" class="form-control" name="criteria[${criteriaCount}][name]" 
                                        placeholder="e.g., Technical Skill" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label class="form-control-label text-sm">Weight (%)</label>
                                <div class="input-group">
                                    <span class="input-group-text">%</span>
                                    <input type="number" class="form-control" name="criteria[${criteriaCount}][weight]" 
                                        min="1" max="100" value="100">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label class="form-control-label text-sm">Max Score</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-star"></i>
                                    </span>
                                    <input type="number" class="form-control" name="criteria[${criteriaCount}][max_score]" 
                                        value="10" min="1" max="100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label text-sm">Description (Optional)</label>
                        <textarea class="form-control form-control-sm" name="criteria[${criteriaCount}][description]" 
                            rows="2" placeholder="Detailed explanation of this criterion"></textarea>
                    </div>
                `;
                container.appendChild(div);
                updateCriteriaCount();
            };

            window.updateCriteriaCount = function() {
                const count = document.querySelectorAll('#criteria-container > div').length;
                document.getElementById('preview-criteria-count').innerHTML =
                    `<i class="bi bi-check-circle me-1"></i> ${count} criteria added`;
            };

            // Form validation
            function validateForm() {
                const title = document.getElementById('title').value.trim();
                const category = document.querySelector('select[name="category_id"]').value;
                const startAt = document.querySelector('input[name="start_at"]').value;
                const endAt = document.querySelector('input[name="end_at"]').value;
                const prizeTitle = document.querySelector('input[name="prize_title"]').value.trim();
                const prizeAmount = document.querySelector('input[name="prize_amount"]').value;

                if (!title) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validation Error',
                        text: 'Competition title is required',
                        confirmButtonColor: '#3085d6',
                    });
                    return false;
                }

                if (!category) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validation Error',
                        text: 'Please select a category',
                        confirmButtonColor: '#3085d6',
                    });
                    return false;
                }

                if (!startAt || !endAt) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validation Error',
                        text: 'Start and end dates are required',
                        confirmButtonColor: '#3085d6',
                    });
                    return false;
                }

                if (new Date(startAt) >= new Date(endAt)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validation Error',
                        text: 'End date must be after start date',
                        confirmButtonColor: '#3085d6',
                    });
                    return false;
                }

                if (!prizeTitle) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validation Error',
                        text: 'Prize title is required',
                        confirmButtonColor: '#3085d6',
                    });
                    return false;
                }

                if (!prizeAmount || parseFloat(prizeAmount) <= 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validation Error',
                        text: 'Prize amount must be greater than 0',
                        confirmButtonColor: '#3085d6',
                    });
                    return false;
                }

                const judgeWeight = parseInt(document.getElementById('judge_weight').value) || 0;
                const publicWeight = parseInt(document.getElementById('public_weight').value) || 0;

                if (judgeWeight + publicWeight !== 100) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validation Error',
                        text: 'Judge and public weights must sum to 100%',
                        confirmButtonColor: '#3085d6',
                    });
                    return false;
                }

                // Validate video duration if submission type is video
                const submissionType = document.querySelector('select[name="submission_type"]').value;
                if (submissionType === 'video') {
                    const duration = document.querySelector('input[name="video_duration_limit"]').value;
                    if (!duration || parseInt(duration) <= 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Validation Error',
                            text: 'Video duration limit is required for video submissions',
                            confirmButtonColor: '#3085d6',
                        });
                        return false;
                    }
                }

                // Validate paid entry fee
                const feeType = document.querySelector('select[name="entry_fee_type"]').value;
                if (feeType === 'paid') {
                    const feeAmount = document.querySelector('input[name="entry_fee_amount"]').value;
                    if (!feeAmount || parseFloat(feeAmount) <= 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Validation Error',
                            text: 'Entry fee amount is required for paid competitions',
                            confirmButtonColor: '#3085d6',
                        });
                        return false;
                    }
                }

                return true;
            }

            // Confirm delete
            window.confirmDelete = function() {
                Swal.fire({
                    title: 'Delete Competition',
                    text: 'Are you sure you want to delete this competition? This action cannot be undone.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#8392ab',
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form').submit();
                    }
                });
            };

            // Form submission
            document.getElementById('editCompetitionForm').addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                    return;
                }

                const submitBtn = document.getElementById('submitBtn');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="ni ni-hourglass-split me-2"></i> Updating Competition...';
            });

            // Initialize on load
            document.addEventListener('DOMContentLoaded', function() {
                updateCriteriaCount();
                updateVotingSummary();
            });
        </script>
    @endpush

    @push('styles')
        <style>
            .steps {
                display: flex;
                justify-content: space-between;
            }

            .step {
                text-align: center;
                width: 20%;
                position: relative;
            }

            .step:not(:last-child):before {
                content: '';
                position: absolute;
                top: 20px;
                left: 60%;
                width: 80%;
                height: 2px;
                background-color: #e9ecef;
            }

            .step-active .step-icon {
                background: linear-gradient(87deg, #5e72e4, #825ee4);
                color: white;
            }

            .step-icon {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background-color: #e9ecef;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 8px;
                transition: all 0.3s;
            }

            .timeline-icon {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 14px;
            }
        </style>
    @endpush
@endsection
