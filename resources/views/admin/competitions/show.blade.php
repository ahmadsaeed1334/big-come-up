@extends('layouts.app')

@section('title', $competition->title)

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Header Card -->
            <div class="card shadow-lg mx-4 card-profile-bottom mb-4">
                <div class="card-body p-3">
                    <div class="row gx-4">
                        <div class="col-auto">
                            <div class="avatar avatar-xl position-relative">
                                <img src="{{ $competition->cover_image ? Storage::url($competition->cover_image) : 'https://ui-avatars.com/api/?name=' . urlencode($competition->title) . '&background=random&length=2&size=120' }}"
                                    alt="Cover Image" class="w-100 border-radius-lg shadow-sm">
                            </div>
                        </div>
                        <div class="col-auto my-auto">
                            <div class="h-100">
                                <div class="d-flex align-items-center">
                                    <h5 class="mb-1">{{ $competition->title }}</h5>
                                    @if ($competition->is_published)
                                        <span class="badge bg-gradient-success ms-3">Published</span>
                                    @else
                                        <span class="badge bg-gradient-secondary ms-3">Draft</span>
                                    @endif
                                </div>
                                <p class="mb-0 font-weight-bold text-sm text-muted">
                                    Slug: {{ $competition->slug }} | ID: #{{ $competition->id }}
                                </p>
                                <div class="mt-2">
                                    <span
                                        class="badge bg-gradient-info">{{ $competition->category->name ?? 'Uncategorized' }}</span>
                                    @php
                                        $now = now();
                                        if ($now->greaterThan($competition->end_at)) {
                                            echo '<span class="badge bg-gradient-dark ms-2">Ended</span>';
                                        } elseif ($now->between($competition->start_at, $competition->end_at)) {
                                            echo '<span class="badge bg-gradient-success ms-2">Live Now</span>';
                                        } else {
                                            echo '<span class="badge bg-gradient-primary ms-2">Upcoming</span>';
                                        }
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                            <div class="nav-wrapper position-relative end-0">
                                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.competitions.edit', $competition) }}"
                                            class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center">
                                            <i class="fas fa-edit"></i>
                                            <span class="ms-2">Edit</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:;"
                                            class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center bg-gradient-danger text-white"
                                            onclick="confirmDelete()">
                                            <i class="fas fa-trash"></i>
                                            <span class="ms-2">Delete</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.competitions.index') }}"
                                            class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center">
                                            <i class="fas fa-arrow-left"></i>
                                            <span class="ms-2">Back</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Submissions</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $competition->submissions_count ?? 0 }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="bi bi-file-earmark-arrow-up text-lg opacity-10"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Participants</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $competition->participants_count ?? 0 }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                        <i class="bi bi-people-fill text-lg opacity-10"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Votes</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $competition->votes_count ?? 0 }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                        <i class="bi bi-vote text-lg opacity-10"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Prize Pool</p>
                                        <h5 class="font-weight-bolder">
                                            ${{ number_format($competition->prize_amount, 2) }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                        <i class="bi bi-trophy-fill text-lg opacity-10"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Left Column: Competition Details -->
                <div class="col-md-8">
                    <!-- Basic Information Card -->
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <h6>Competition Information</h6>
                                <span
                                    class="badge bg-gradient-{{ $competition->entry_fee_type == 'free' ? 'success' : 'warning' }} ms-2">
                                    {{ $competition->entry_fee_type == 'free' ? 'Free Entry' : 'Paid Entry ($' . number_format($competition->entry_fee_amount, 2) . ')' }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <small class="text-muted d-block">Competition Title</small>
                                        <span class="font-weight-bold">{{ $competition->title }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <small class="text-muted d-block">Category</small>
                                        <span
                                            class="badge bg-gradient-info">{{ $competition->category->name ?? 'Uncategorized' }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <small class="text-muted d-block">Submission Type</small>
                                        <span class="badge bg-gradient-primary">
                                            {{ ucfirst($competition->submission_type) }}
                                            @if ($competition->submission_type == 'video' && $competition->video_duration_limit)
                                                (Max: {{ $competition->video_duration_limit }} seconds)
                                            @endif
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <small class="text-muted d-block">Eligibility</small>
                                        <span>{{ $eligibilityTypes[$competition->eligibility] ?? $competition->eligibility }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <small class="text-muted d-block">Start Date & Time</small>
                                        <span><i class="bi bi-calendar-check text-primary me-1"></i>
                                            {{ $competition->start_at->format('F d, Y h:i A') }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <small class="text-muted d-block">End Date & Time</small>
                                        <span><i class="bi bi-calendar-x text-danger me-1"></i>
                                            {{ $competition->end_at->format('F d, Y h:i A') }}</span>
                                    </div>
                                    @if ($competition->voting_start_at && $competition->voting_end_at)
                                        <div class="mb-3">
                                            <small class="text-muted d-block">Voting Period</small>
                                            <span><i class="bi bi-calendar-check text-info me-1"></i>
                                                {{ $competition->voting_start_at->format('M d, Y') }} -
                                                {{ $competition->voting_end_at->format('M d, Y') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-12">
                                    <small class="text-muted d-block mb-2">Short Description</small>
                                    <p class="mb-0">{{ $competition->short_description ?? 'No description provided.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Prize Details Card -->
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Prize Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <div
                                        class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle mb-3 mx-auto">
                                        <i class="bi bi-trophy-fill text-white"></i>
                                    </div>
                                    <h5 class="font-weight-bolder text-warning">
                                        ${{ number_format($competition->prize_amount, 2) }}
                                    </h5>
                                    <span class="text-sm">{{ $competition->prize_title }}</span>
                                </div>
                                <div class="col-md-8">
                                    <small class="text-muted d-block mb-2">Full Prize Description</small>
                                    <p class="mb-0">
                                        {{ $competition->prize_description ?? 'No detailed description provided.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Judging Criteria Card -->
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6>Judging Criteria</h6>
                                <div>
                                    <span class="badge bg-gradient-primary me-1">Judge:
                                        {{ $competition->judge_score_weight }}%</span>
                                    <span class="badge bg-gradient-info">Public:
                                        {{ $competition->public_votes_weight }}%</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($competition->criteria->isEmpty())
                                <p class="text-muted text-center py-3">No judging criteria specified.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Criterion</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Weight</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Max Score</th>
                                                <th class="text-secondary opacity-7">Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($competition->criteria as $criterion)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">{{ $criterion->name }}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="badge bg-gradient-primary">{{ $criterion->weight }}%</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="badge bg-gradient-info">{{ $criterion->max_score ?? 10 }}</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <p class="text-xs mb-0">{{ $criterion->description ?? '—' }}</p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Scoring Weights Progress Bar -->
                                <div class="mt-4">
                                    <small class="text-muted d-block mb-2">Scoring Distribution</small>
                                    <div class="progress" style="height: 12px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ $competition->judge_score_weight }}%;"
                                            aria-valuenow="{{ $competition->judge_score_weight }}" aria-valuemin="0"
                                            aria-valuemax="100">
                                            Judge {{ $competition->judge_score_weight }}%
                                        </div>
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{ $competition->public_votes_weight }}%;"
                                            aria-valuenow="{{ $competition->public_votes_weight }}" aria-valuemin="0"
                                            aria-valuemax="100">
                                            Public {{ $competition->public_votes_weight }}%
                                        </div>
                                    </div>
                                </div>

                                <!-- Fraud Protection Status -->
                                <div class="mt-3">
                                    <span
                                        class="badge bg-gradient-{{ $competition->fraud_protection ? 'success' : 'secondary' }}">
                                        <i class="bi bi-shield-check me-1"></i>
                                        Fraud Protection: {{ $competition->fraud_protection ? 'Enabled' : 'Disabled' }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column: Side Cards -->
                <div class="col-md-4">
                    <!-- Timeline Card -->
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Timeline</h6>
                        </div>
                        <div class="card-body">
                            <div class="timeline-steps">
                                <div class="d-flex mb-3">
                                    <div class="timeline-icon bg-gradient-success text-white">
                                        <i class="bi bi-flag"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-0 text-sm">Starts</h6>
                                        <span
                                            class="text-xs text-muted">{{ $competition->start_at->format('M d, Y h:i A') }}</span>
                                        @if ($now->lessThan($competition->start_at))
                                            <span class="badge bg-gradient-primary ms-2 text-xs">Upcoming</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="timeline-icon bg-gradient-info text-white">
                                        <i class="bi bi-vote"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-0 text-sm">Voting</h6>
                                        @if ($competition->voting_start_at && $competition->voting_end_at)
                                            <span
                                                class="text-xs text-muted">{{ $competition->voting_start_at->format('M d, Y') }}
                                                - {{ $competition->voting_end_at->format('M d, Y') }}</span>
                                        @else
                                            <span class="text-xs text-muted">Throughout competition</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="timeline-icon bg-gradient-danger text-white">
                                        <i class="bi bi-flag-fill"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-0 text-sm">Ends</h6>
                                        <span
                                            class="text-xs text-muted">{{ $competition->end_at->format('M d, Y h:i A') }}</span>
                                        @php
                                            $daysRemaining = now()->diffInDays($competition->end_at, false);
                                        @endphp
                                        @if ($daysRemaining > 0)
                                            <span
                                                class="badge bg-gradient-{{ $daysRemaining > 7 ? 'success' : ($daysRemaining > 3 ? 'warning' : 'danger') }} ms-2 text-xs">
                                                {{ $daysRemaining }} days left
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Countdown Timer (if live) -->
                            @if ($now->between($competition->start_at, $competition->end_at))
                                <div class="text-center">
                                    <small class="text-muted d-block mb-2">Competition ends in</small>
                                    <div class="d-flex justify-content-center">
                                        <div class="countdown-item me-2 text-center">
                                            <span id="days" class="h5 font-weight-bold">0</span>
                                            <span class="d-block text-xs">Days</span>
                                        </div>
                                        <div class="countdown-item me-2 text-center">
                                            <span id="hours" class="h5 font-weight-bold">0</span>
                                            <span class="d-block text-xs">Hours</span>
                                        </div>
                                        <div class="countdown-item me-2 text-center">
                                            <span id="minutes" class="h5 font-weight-bold">0</span>
                                            <span class="d-block text-xs">Mins</span>
                                        </div>
                                        <div class="countdown-item text-center">
                                            <span id="seconds" class="h5 font-weight-bold">0</span>
                                            <span class="d-block text-xs">Secs</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Actions Card -->
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Quick Actions</h6>
                        </div>
                        <div class="card-body p-0 pt-3">
                            <div class="list-group list-group-flush">
                                <a href="{{ route('admin.competitions.edit', $competition) }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center border-0">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius me-3">
                                        <i class="fas fa-edit text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-sm">Edit Competition</h6>
                                        <small class="text-muted">Modify competition details</small>
                                    </div>
                                </a>
                                <a href="javascript:;"
                                    class="list-group-item list-group-item-action d-flex align-items-center border-0"
                                    onclick="confirmTogglePublish()">
                                    <div
                                        class="icon icon-shape bg-gradient-{{ $competition->is_published ? 'warning' : 'success' }} shadow text-center border-radius me-3">
                                        <i
                                            class="bi bi-{{ $competition->is_published ? 'pause-circle' : 'play-circle' }} text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-sm">
                                            {{ $competition->is_published ? 'Unpublish' : 'Publish' }} Competition</h6>
                                        <small class="text-muted">Change competition visibility</small>
                                    </div>
                                </a>
                                <form id="toggle-publish-form"
                                    action="{{ route('admin.competitions.toggle', $competition) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('POST')
                                </form>
                                <a href="#"
                                    class="list-group-item list-group-item-action d-flex align-items-center border-0">
                                    <div class="icon icon-shape bg-gradient-info shadow text-center border-radius me-3">
                                        <i class="bi bi-download text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-sm">Export Submissions</h6>
                                        <small class="text-muted">Download all submissions</small>
                                    </div>
                                </a>
                                @if ($competition->is_published && $now->lessThan($competition->end_at))
                                    <a href="#"
                                        class="list-group-item list-group-item-action d-flex align-items-center border-0">
                                        <div
                                            class="icon icon-shape bg-gradient-success shadow text-center border-radius me-3">
                                            <i class="bi bi-send text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-sm">Send Reminder</h6>
                                            <small class="text-muted">Notify participants</small>
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Metadata Card -->
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Metadata</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <small class="text-muted d-block">Created By</small>
                                <span>{{ $competition->creator->name ?? 'System' }}</span>
                            </div>
                            <div class="mb-2">
                                <small class="text-muted d-block">Created At</small>
                                <span>{{ $competition->created_at->format('F d, Y h:i A') }}</span>
                                <small class="text-muted d-block">{{ $competition->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="mb-2">
                                <small class="text-muted d-block">Last Updated</small>
                                <span>{{ $competition->updated_at->format('F d, Y h:i A') }}</span>
                                <small class="text-muted d-block">{{ $competition->updated_at->diffForHumans() }}</small>
                            </div>
                            @if ($competition->deleted_at)
                                <div class="mb-2">
                                    <small class="text-muted d-block">Deleted At</small>
                                    <span
                                        class="text-danger">{{ $competition->deleted_at->format('F d, Y h:i A') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Submissions Section (if any) -->
            @if (($competition->submissions_count ?? 0) > 0)
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                <h6>Recent Submissions</h6>
                                <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Participant</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Submission</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Score</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Submitted</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="5" class="text-center py-4">
                                                    <p class="text-muted mb-0">Submissions feature coming soon...</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Form (Hidden) -->
    <form id="delete-form" action="{{ route('admin.competitions.destroy', $competition) }}" method="POST"
        style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
        <script>
            // Confirm delete
            function confirmDelete() {
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
            }

            // Confirm toggle publish
            function confirmTogglePublish() {
                const action = '{{ $competition->is_published ? 'Unpublish' : 'Publish' }}';
                Swal.fire({
                    title: `${action} Competition`,
                    text: `Are you sure you want to ${action.toLowerCase()} this competition?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: action === 'Publish' ? '#28a745' : '#ffc107',
                    cancelButtonColor: '#8392ab',
                    confirmButtonText: `Yes, ${action} it`,
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('toggle-publish-form').submit();
                    }
                });
            }

            // Countdown timer (if competition is live)
            @if ($now->between($competition->start_at, $competition->end_at))
                function updateCountdown() {
                    const endDate = new Date("{{ $competition->end_at }}").getTime();
                    const now = new Date().getTime();
                    const distance = endDate - now;

                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    document.getElementById('days').innerHTML = days;
                    document.getElementById('hours').innerHTML = hours;
                    document.getElementById('minutes').innerHTML = minutes;
                    document.getElementById('seconds').innerHTML = seconds;

                    if (distance < 0) {
                        clearInterval(countdownTimer);
                        document.getElementById('days').innerHTML = 0;
                        document.getElementById('hours').innerHTML = 0;
                        document.getElementById('minutes').innerHTML = 0;
                        document.getElementById('seconds').innerHTML = 0;
                    }
                }

                const countdownTimer = setInterval(updateCountdown, 1000);
                updateCountdown();
            @endif
        </script>
    @endpush

    @push('styles')
        <style>
            .timeline-icon {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 14px;
            }

            .countdown-item {
                background: #f8f9fa;
                padding: 8px 12px;
                border-radius: 8px;
                min-width: 60px;
            }
        </style>
    @endpush
@endsection
