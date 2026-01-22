@extends('layouts.app')

@section('title', 'Manage Judges')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Judges Management</h3>
                        <a href="{{ route('admin.judges.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle me-1"></i> Add New Judge
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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Judges</p>
                                                <h5 class="font-weight-bolder">
                                                    {{ $totalJudges ?? 0 }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Active Judges</p>
                                                <h5 class="font-weight-bolder">
                                                    {{ $activeJudges ?? 0 }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                                <i class="bi bi-person-check text-lg opacity-10"></i>
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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Tags</p>
                                                <h5 class="font-weight-bolder">
                                                    {{ $totalTags ?? 0 }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                                <i class="bi bi-tags text-lg opacity-10"></i>
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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">This Month</p>
                                                <h5 class="font-weight-bolder">
                                                    {{ $judgesThisMonth ?? 0 }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                                <i class="bi bi-calendar-month text-lg opacity-10"></i>
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
                            <form action="{{ route('admin.judges.index') }}" method="GET" class="mb-0">
                                <div class="row g-3">

                                    {{-- Search --}}
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-search search-icon"></i>
                                            </span>
                                            <input type="text" class="form-control border-start-0" name="search"
                                                placeholder="Search judges..." value="{{ request('search') }}">
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="ni ni-check-bold"></i>
                                            </span>
                                            <select name="status" class="form-select border-start-0">
                                                <option value="">All Status</option>
                                                <option value="active" @selected(request('status') == 'active')>Active</option>
                                                <option value="inactive" @selected(request('status') == 'inactive')>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Tags --}}
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="ni ni-tag"></i>
                                            </span>
                                            <select name="tag" class="form-select border-start-0">
                                                <option value="">All Tags</option>
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}" @selected(request('tag') == $tag->id)>
                                                        {{ $tag->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="col-md-3">
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn bg-gradient-primary mb-0">
                                                <i class="fas fa-search search-icon"></i> Search
                                            </button>

                                            @if (request()->hasAny(['search', 'status', 'tag']))
                                                <a href="{{ route('admin.judges.index') }}"
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
                    @if (request()->hasAny(['search', 'status', 'tag']))
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="alert alert-light py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            @if (request('search'))
                                                <span class="text-sm">Search:
                                                    <strong>"{{ request('search') }}"</strong></span>
                                            @endif
                                            @if (request('status'))
                                                <span class="text-sm ms-3">Status:
                                                    <strong>{{ ucfirst(request('status')) }}</strong></span>
                                            @endif
                                            @if (request('tag'))
                                                @php
                                                    $selectedTag = $tags->firstWhere('id', request('tag'));
                                                @endphp
                                                @if ($selectedTag)
                                                    <span class="text-sm ms-3">Tag: <span
                                                            class="badge bg-gradient-warning">{{ $selectedTag->name }}</span></span>
                                                @endif
                                            @endif
                                            <span class="text-sm ms-3">Found: <strong>{{ $judges->total() }}
                                                    judges</strong></span>
                                        </div>
                                        @if (request()->hasAny(['search', 'status', 'tag']))
                                            <a href="{{ route('admin.judges.index') }}"
                                                class="btn btn-sm btn-outline-danger">
                                                <i class="ni ni-fat-remove me-1"></i> Clear All
                                            </a>
                                        @endif
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

                    @if ($judges->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-people display-1 text-muted"></i>
                            <h5 class="mt-3">No judges found</h5>
                            <p class="text-muted">
                                @if (request()->hasAny(['search', 'status', 'tag']))
                                    No judges match your search criteria
                                @else
                                    Start by adding your first judge
                                @endif
                            </p>
                            <a href="{{ route('admin.judges.create') }}" class="btn btn-primary mt-2">
                                <i class="bi bi-plus-circle me-1"></i> Add Judge
                            </a>
                        </div>
                    @else
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Judge</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Location</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tags</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Credentials</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($judges as $judge)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ $judge->avatar ? Storage::url($judge->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($judge->name) . '&background=random' }}"
                                                            class="avatar avatar-sm me-3" alt="{{ $judge->name }}">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $judge->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ Str::limit($judge->bio, 30) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    <i class="bi bi-geo-alt text-primary me-1"></i>
                                                    {{ $judge->location }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-center flex-wrap gap-1">
                                                    @foreach ($judge->tags->take(2) as $tag)
                                                        <span
                                                            class="badge badge-sm bg-gradient-warning">{{ $tag->name }}</span>
                                                    @endforeach
                                                    @if ($judge->tags->count() > 2)
                                                        <span class="badge badge-sm bg-gradient-secondary">
                                                            +{{ $judge->tags->count() - 2 }} more
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="badge badge-sm bg-gradient-info">
                                                    {{ $judge->credentials->count() }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($judge->is_active)
                                                    <span class="badge badge-sm bg-gradient-success">Active</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $judge->created_at->format('M d, Y') }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex gap-1">
                                                    {{-- View Button --}}
                                                    <a href="{{ route('admin.judges.show', $judge) }}"
                                                        class="btn btn-sm btn-outline-info action-btn"
                                                        data-toggle="tooltip" data-original-title="View Profile">
                                                        <i class="bi bi-eye"></i>
                                                    </a>

                                                    {{-- Edit Button --}}
                                                    <a href="{{ route('admin.judges.edit', $judge->id) }}"
                                                        class="btn btn-sm btn-outline-primary action-btn"
                                                        data-toggle="tooltip" data-original-title="Edit Judge">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    {{-- Delete Button --}}
                                                    <a href="javascript:;"
                                                        class="btn btn-sm btn-outline-danger action-btn"
                                                        onclick="confirmDelete('delete-form-{{ $judge->id }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $judge->id }}"
                                                        action="{{ route('admin.judges.destroy', $judge->id) }}"
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
                        {{-- <div class="px-3 pt-3">
                            {{ $judges->withQueryString()->links() }}
                        </div> --}}
                        @include('admin.partials.pagination', ['items' => $judges])
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Additional Cards --}}
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Quick Actions</h6>
                </div>
                <div class="card-body p-0 pt-3">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin.judges.create') }}"
                            class="list-group-item list-group-item-action d-flex align-items-center border-0">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius me-3">
                                <i class="bi bi-plus-circle text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-sm">Add New Judge</h6>
                                <small class="text-muted">Create a new judge profile</small>
                            </div>
                        </a>
                        <a href="{{ route('admin.judge-tags.index') }}"
                            class="list-group-item list-group-item-action d-flex align-items-center border-0">
                            <div class="icon icon-shape bg-gradient-success shadow text-center border-radius me-3">
                                <i class="bi bi-tags text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-sm">Manage Tags</h6>
                                <small class="text-muted">Add/Edit judge tags</small>
                            </div>
                        </a>
                        <a href="#"
                            class="list-group-item list-group-item-action d-flex align-items-center border-0">
                            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius me-3">
                                <i class="bi bi-download text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-sm">Export Judges</h6>
                                <small class="text-muted">Export to CSV/Excel</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Recent Judges</h6>
                    <small><a href="{{ route('admin.judges.index') }}">View All</a></small>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judge
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Location</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Added</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentJudges as $recent)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ $recent->avatar ? Storage::url($recent->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($recent->name) . '&background=random' }}"
                                                        class="avatar avatar-sm me-3" alt="{{ $recent->name }}">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $recent->name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ Str::limit($recent->bio, 25) }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                <i class="bi bi-geo-alt text-primary me-1"></i>
                                                {{ $recent->location }}
                                            </p>
                                        </td>
                                        <td>
                                            @if ($recent->is_active)
                                                <span class="badge badge-sm bg-gradient-success">Active</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">Inactive</span>
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
                </div>
            </div>
        </div>
    </div>



    @push('scripts')
        <script>
            // Delete confirmation
            function confirmDelete(formId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This judge will be permanently deleted!",
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

            // Auto-submit search on Enter key
            document.querySelector('input[name="search"]')?.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    this.form.submit();
                }
            });

            // Initialize tooltips
            document.addEventListener('DOMContentLoaded', function() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });

            // Auto-submit filters when changed (optional)
            document.querySelectorAll('select[name="status"], select[name="tag"]').forEach(select => {
                select.addEventListener('change', function() {
                    this.form.submit();
                });
            });
        </script>
    @endpush
@endsection
