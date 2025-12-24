{{-- resources/views/admin/judges/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Manage Judges')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Judges Management</h1>
            <a href="{{ route('admin.judges.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Add New Judge
            </a>
        </div>

        {{-- Stats Cards --}}
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Judges</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalJudges }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Active Judges</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeJudges }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-person-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Tags</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTags }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-tags fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    This Month</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $judgesThisMonth }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-calendar-month fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Table --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">All Judges</h6>

                {{-- Search Form --}}
                <form action="{{ route('admin.judges.index') }}" method="GET" class="d-flex" style="max-width: 300px;">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search judges..."
                            value="{{ request('search') }}">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                        @if (request('search'))
                            <a href="{{ route('admin.judges.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($judges->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-people display-1 text-muted"></i>
                        <h5 class="mt-3">No judges found</h5>
                        <p class="text-muted">Start by adding your first judge</p>
                        <a href="{{ route('admin.judges.create') }}" class="btn btn-primary mt-2">
                            <i class="bi bi-plus-circle me-1"></i> Add Judge
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover" id="judgesTable">
                            <thead class="table-light">
                                <tr>
                                    <th width="60">#</th>
                                    <th width="80">Photo</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Tags</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th width="150" class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($judges as $judge)
                                    <tr>
                                        <td>{{ $judge->id }}</td>
                                        <td>
                                            <div class="avatar avatar-sm">
                                                <img src="{{ $judge->avatar ? Storage::url($judge->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($judge->name) . '&background=random' }}"
                                                    alt="{{ $judge->name }}" class="rounded-circle"
                                                    style="width: 40px; height: 40px; object-fit: cover;">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $judge->name }}</div>
                                            <small class="text-muted">{{ Str::limit($judge->bio, 50) }}</small>
                                        </td>
                                        <td>
                                            <i class="bi bi-geo-alt text-primary me-1"></i>
                                            {{ $judge->location }}
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach ($judge->tags->take(2) as $tag)
                                                    <span class="badge bg-warning text-dark">{{ $tag->name }}</span>
                                                @endforeach
                                                @if ($judge->tags->count() > 2)
                                                    <span class="badge bg-secondary">+{{ $judge->tags->count() - 2 }}
                                                        more</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if ($judge->is_active)
                                                <span class="badge bg-success">
                                                    <i class="bi bi-check-circle me-1"></i> Active
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    <i class="bi bi-x-circle me-1"></i> Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $judge->created_at->format('M d, Y') }}
                                            </small>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end gap-2">
                                                {{-- View Button --}}
                                                <a href="{{ route('admin.judges.show', $judge) }}"
                                                    class="btn btn-sm btn-outline-info" target="_blank"
                                                    title="View Public Profile">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                {{-- Edit Button --}}
                                                <a href="{{ route('admin.judges.edit', $judge->id) }}"
                                                    class="btn btn-sm btn-outline-primary" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                {{-- Delete Button with Modal --}}
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $judge->id }}" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>

                                            {{-- Delete Confirmation Modal --}}
                                            <div class="modal fade" id="deleteModal{{ $judge->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Delete</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="d-flex align-items-center mb-3">
                                                                <div class="avatar me-3">
                                                                    <img src="{{ $judge->avatar ? Storage::url($judge->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($judge->name) . '&background=random' }}"
                                                                        alt="{{ $judge->name }}" class="rounded-circle"
                                                                        style="width: 50px; height: 50px;">
                                                                </div>
                                                                <div>
                                                                    <h6 class="mb-0">{{ $judge->name }}</h6>
                                                                    <small
                                                                        class="text-muted">{{ $judge->location }}</small>
                                                                </div>
                                                            </div>
                                                            <p class="mb-0">Are you sure you want to delete this judge?
                                                                This action cannot be undone.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <form action="{{ route('admin.judges.destroy', $judge->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">
                                                                    <i class="bi bi-trash me-1"></i> Delete Judge
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Showing {{ $judges->firstItem() }} to {{ $judges->lastItem() }} of {{ $judges->total() }}
                            entries
                        </div>
                        <div>
                            {{ $judges->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Quick Actions Card --}}
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('admin.judges.create') }}"
                                class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="bi bi-plus-circle-fill text-primary me-3"></i>
                                <div>
                                    <h6 class="mb-0">Add New Judge</h6>
                                    <small class="text-muted">Create a new judge profile</small>
                                </div>
                            </a>
                            <a href="{{ route('admin.judge-tags.index') }}"
                                class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="bi bi-tags-fill text-success me-3"></i>
                                <div>
                                    <h6 class="mb-0">Manage Tags</h6>
                                    <small class="text-muted">Add/Edit judge tags</small>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="bi bi-download text-info me-3"></i>
                                <div>
                                    <h6 class="mb-0">Export Judges</h6>
                                    <small class="text-muted">Export to CSV/Excel</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
                        <small><a href="#">View All</a></small>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            @foreach ($recentJudges as $recent)
                                <div class="timeline-item mb-3">
                                    <div class="timeline-marker bg-primary"></div>
                                    <div class="timeline-content">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-1">{{ $recent->name }}</h6>
                                            <small class="text-muted">{{ $recent->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="text-muted mb-1">{{ Str::limit($recent->bio, 80) }}</p>
                                        <div class="d-flex gap-1">
                                            @foreach ($recent->tags->take(3) as $tag)
                                                <span class="badge bg-light text-dark">{{ $tag->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .avatar {
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
            }

            .avatar img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .timeline {
                position: relative;
                padding-left: 30px;
            }

            .timeline-item {
                position: relative;
                padding-bottom: 10px;
            }

            .timeline-marker {
                position: absolute;
                left: -30px;
                top: 5px;
                width: 12px;
                height: 12px;
                border-radius: 50%;
            }

            .timeline-content {
                padding-left: 10px;
            }

            .table-hover tbody tr:hover {
                background-color: rgba(0, 0, 0, 0.02);
            }

            .badge {
                font-size: 0.75rem;
                font-weight: 500;
            }

            .list-group-item {
                border: none;
                padding: 1rem;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Search with Enter key
            document.querySelector('input[name="search"]').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    this.form.submit();
                }
            });

            // Bulk actions (optional)
            function bulkAction(action) {
                const selectedIds = [];
                document.querySelectorAll('input[name="selected[]"]:checked').forEach(checkbox => {
                    selectedIds.push(checkbox.value);
                });

                if (selectedIds.length === 0) {
                    alert('Please select at least one judge.');
                    return;
                }

                if (action === 'delete') {
                    if (confirm(`Are you sure you want to delete ${selectedIds.length} judge(s)?`)) {
                        // Submit bulk delete form
                        document.getElementById('bulkDeleteForm').submit();
                    }
                }
            }
        </script>
    @endpush
@endsection
