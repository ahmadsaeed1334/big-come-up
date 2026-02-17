@extends('layouts.app')

@section('title', 'Manage Competitions')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Competitions Management</h3>
                        <a href="{{ route('admin.competitions.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle me-1"></i> Create New Competition
                        </a>
                    </div>

                    {{-- Stats Cards --}}
                    <div class="row mt-3">
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Competitions
                                                </p>
                                                <h5 class="font-weight-bolder">
                                                    {{ $totalCompetitions ?? 0 }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                                <i class="bi bi-trophy-fill text-lg opacity-10"></i>
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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Active / Published
                                                </p>
                                                <h5 class="font-weight-bolder">
                                                    {{ $publishedCompetitions ?? 0 }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                                <i class="bi bi-check-circle-fill text-lg opacity-10"></i>
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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Upcoming</p>
                                                <h5 class="font-weight-bolder">
                                                    {{ $upcomingCompetitions ?? 0 }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                                <i class="bi bi-calendar-event-fill text-lg opacity-10"></i>
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
                                                    ${{ number_format($totalPrizePool ?? 0, 2) }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                                <i class="bi bi-cash-stack text-lg opacity-10"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Search & Filters Form --}}
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <form action="{{ route('admin.competitions.index') }}" method="GET" class="mb-0">
                                <div class="row g-3">
                                    {{-- Search --}}
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-search search-icon"></i>
                                            </span>
                                            <input type="text" class="form-control border-start-0" name="q"
                                                placeholder="Search competitions..." value="{{ request('q') }}">
                                        </div>
                                    </div>

                                    {{-- Category --}}
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-grid-3x3-gap-fill"></i>
                                            </span>
                                            <select name="category" class="form-select border-start-0">
                                                <option value="">All Categories</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="ni ni-check-bold"></i>
                                            </span>
                                            <select name="status" class="form-select border-start-0">
                                                <option value="">All Status</option>
                                                <option value="published" @selected(request('status') == 'published')>Published</option>
                                                <option value="draft" @selected(request('status') == 'draft')>Draft</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Fee Type --}}
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-currency-dollar"></i>
                                            </span>
                                            <select name="fee_type" class="form-select border-start-0">
                                                <option value="">All Entry Fees</option>
                                                <option value="free" @selected(request('fee_type') == 'free')>Free</option>
                                                <option value="paid" @selected(request('fee_type') == 'paid')>Paid</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="col-md-3">
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn bg-gradient-primary mb-0">
                                                <i class="fas fa-search search-icon"></i> Search
                                            </button>

                                            @if (request()->hasAny(['q', 'category', 'status', 'fee_type']))
                                                <a href="{{ route('admin.competitions.index') }}"
                                                    class="btn bg-gradient-secondary mb-0">
                                                    <i class="ni ni-refresh me-1"></i> Reset
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Search Results Info --}}
                    @if (request()->hasAny(['q', 'category', 'status', 'fee_type']))
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="alert alert-light py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            @if (request('q'))
                                                <span class="text-sm">Search:
                                                    <strong>"{{ request('q') }}"</strong></span>
                                            @endif
                                            @if (request('category'))
                                                @php $cat = $categories->firstWhere('id', request('category')); @endphp
                                                @if ($cat)
                                                    <span class="text-sm ms-3">Category:
                                                        <strong>{{ $cat->name }}</strong></span>
                                                @endif
                                            @endif
                                            @if (request('status'))
                                                <span class="text-sm ms-3">Status:
                                                    <strong>{{ ucfirst(request('status')) }}</strong></span>
                                            @endif
                                            @if (request('fee_type'))
                                                <span class="text-sm ms-3">Fee:
                                                    <strong>{{ ucfirst(request('fee_type')) }}</strong></span>
                                            @endif
                                            <span class="text-sm ms-3">Found: <strong>{{ $competitions->total() }}
                                                    competitions</strong></span>
                                        </div>
                                        <a href="{{ route('admin.competitions.index') }}"
                                            class="btn btn-sm btn-outline-danger">
                                            <i class="ni ni-fat-remove me-1"></i> Clear All
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($competitions->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-trophy display-1 text-muted"></i>
                            <h5 class="mt-3">No competitions found</h5>
                            <p class="text-muted">
                                @if (request()->hasAny(['q', 'category', 'status', 'fee_type']))
                                    No competitions match your search criteria
                                @else
                                    Start by creating your first competition
                                @endif
                            </p>
                            <a href="{{ route('admin.competitions.create') }}" class="btn btn-primary mt-2">
                                <i class="bi bi-plus-circle me-1"></i> Create Competition
                            </a>
                        </div>
                    @else
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Competition</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Category</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Entry Fee</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Timeline</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Prize</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($competitions as $competition)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ $competition->cover_image ? Storage::url($competition->cover_image) : 'https://ui-avatars.com/api/?name=' . urlencode($competition->title) . '&background=random&length=2' }}"
                                                            class="avatar avatar-sm me-3"
                                                            alt="{{ $competition->title }}">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $competition->title }}</h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ Str::limit($competition->short_description, 30) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    <span class="badge bg-gradient-info">
                                                        {{ $competition->category->name ?? 'Uncategorized' }}
                                                    </span>
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                @if ($competition->entry_fee_type == 'free')
                                                    <span class="badge badge-sm bg-gradient-success">Free</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-warning">
                                                        ${{ number_format($competition->entry_fee_amount, 2) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column">
                                                    <span class="text-xs">
                                                        <i class="bi bi-calendar-check text-primary me-1"></i>
                                                        {{ $competition->start_at->format('M d') }}
                                                    </span>
                                                    <span class="text-xs text-muted">
                                                        <i class="bi bi-calendar-x text-danger me-1"></i>
                                                        {{ $competition->end_at->format('M d, Y') }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    ${{ number_format($competition->prize_amount, 2) }}
                                                </span>
                                                <p class="text-xs mb-0">{{ Str::limit($competition->prize_title, 20) }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column align-items-center">
                                                    @if ($competition->is_published)
                                                        <span class="badge badge-sm bg-gradient-success">Published</span>
                                                    @else
                                                        <span class="badge badge-sm bg-gradient-secondary">Draft</span>
                                                    @endif
                                                    @php
                                                        $now = now();
                                                        $status = 'upcoming';
                                                        $statusColor = 'info';
                                                        if ($now->greaterThan($competition->end_at)) {
                                                            $status = 'ended';
                                                            $statusColor = 'dark';
                                                        } elseif (
                                                            $now->between($competition->start_at, $competition->end_at)
                                                        ) {
                                                            $status = 'live';
                                                            $statusColor = 'success';
                                                        }
                                                    @endphp
                                                    <span class="badge badge-sm bg-gradient-{{ $statusColor }} mt-1">
                                                        {{ ucfirst($status) }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex gap-1">
                                                    {{-- Toggle Publish Button --}}
                                                    <a href="javascript:;"
                                                        class="btn btn-sm {{ $competition->is_published ? 'btn-outline-warning' : 'btn-outline-success' }} action-btn"
                                                        onclick="confirmToggle('{{ $competition->is_published ? 'Unpublish' : 'Publish' }}', 'toggle-form-{{ $competition->id }}')"
                                                        data-toggle="tooltip"
                                                        data-original-title="{{ $competition->is_published ? 'Unpublish' : 'Publish' }}">
                                                        <i
                                                            class="bi {{ $competition->is_published ? 'bi-pause-circle' : 'bi-play-circle' }}"></i>
                                                    </a>
                                                    <form id="toggle-form-{{ $competition->id }}"
                                                        action="{{ route('admin.competitions.toggle', $competition) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('POST')
                                                    </form>

                                                    {{-- View Button --}}
                                                    <a href="{{ route('admin.competitions.show', $competition) }}"
                                                        class="btn btn-sm btn-outline-info action-btn"
                                                        data-toggle="tooltip" data-original-title="View Details">
                                                        <i class="bi bi-eye"></i>
                                                    </a>

                                                    {{-- Edit Button --}}
                                                    <a href="{{ route('admin.competitions.edit', $competition) }}"
                                                        class="btn btn-sm btn-outline-primary action-btn"
                                                        data-toggle="tooltip" data-original-title="Edit Competition">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    {{-- Delete Button --}}
                                                    <a href="javascript:;"
                                                        class="btn btn-sm btn-outline-danger action-btn"
                                                        onclick="confirmDelete('delete-form-{{ $competition->id }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $competition->id }}"
                                                        action="{{ route('admin.competitions.destroy', $competition) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @include('admin.partials.pagination', ['items' => $competitions])
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions & Recent Competitions --}}
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Quick Actions</h6>
                </div>
                <div class="card-body p-0 pt-3">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin.competitions.create') }}"
                            class="list-group-item list-group-item-action d-flex align-items-center border-0">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius me-3">
                                <i class="bi bi-plus-circle text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-sm">Create New Competition</h6>
                                <small class="text-muted">Start a new competition</small>
                            </div>
                        </a>
                        <a href="{{ route('admin.competition-categories.index') }}"
                            class="list-group-item list-group-item-action d-flex align-items-center border-0">
                            <div class="icon icon-shape bg-gradient-success shadow text-center border-radius me-3">
                                <i class="bi bi-grid-3x3-gap-fill text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-sm">Manage Categories</h6>
                                <small class="text-muted">Add/Edit competition categories</small>
                            </div>
                        </a>
                        <a href="#"
                            class="list-group-item list-group-item-action d-flex align-items-center border-0">
                            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius me-3">
                                <i class="bi bi-download text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-sm">Export Report</h6>
                                <small class="text-muted">Export competitions to CSV/Excel</small>
                            </div>
                        </a>
                        <a href="{{ route('admin.competitions.index') }}?status=live"
                            class="list-group-item list-group-item-action d-flex align-items-center border-0">
                            <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius me-3">
                                <i class="bi bi-broadcast text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-sm">Live Competitions</h6>
                                <small class="text-muted">View currently active competitions</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Recent Competitions</h6>
                    <small><a href="{{ route('admin.competitions.index') }}">View All</a></small>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @if ($recentCompetitions->isEmpty())
                        <div class="text-center py-4">
                            <p class="text-muted mb-0">No recent competitions</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Competition</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Category</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Prize</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Status</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentCompetitions as $recent)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ $recent->cover_image ? Storage::url($recent->cover_image) : 'https://ui-avatars.com/api/?name=' . urlencode($recent->title) . '&background=random&length=2' }}"
                                                            class="avatar avatar-sm me-3" alt="{{ $recent->title }}">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $recent->title }}</h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ Str::limit($recent->short_description, 20) }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-gradient-info">{{ $recent->category->name ?? 'Uncategorized' }}</span>
                                            </td>
                                            <td>
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    ${{ number_format($recent->prize_amount, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($recent->is_published)
                                                    <span class="badge badge-sm bg-gradient-success">Published</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-secondary">Draft</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $recent->created_at->diffForHumans() }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmDelete(formId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This competition will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#8392ab',
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(formId).submit();
                    }
                });
            }

            function confirmToggle(action, formId) {
                Swal.fire({
                    title: `Confirm ${action}`,
                    text: `Are you sure you want to ${action.toLowerCase()} this competition?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: action === 'Publish' ? '#28a745' : '#ffc107',
                    cancelButtonColor: '#8392ab',
                    confirmButtonText: `Yes, ${action} it`,
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(formId).submit();
                    }
                });
            }

            // Auto-submit search on Enter key
            document.querySelector('input[name="q"]')?.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    this.form.submit();
                }
            });

            // Auto-submit filters when changed
            document.querySelectorAll('select[name="category"], select[name="status"], select[name="fee_type"]').forEach(
                select => {
                    select.addEventListener('change', function() {
                        this.form.submit();
                    });
                });
        </script>
    @endpush
@endsection
