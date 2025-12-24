{{-- resources/views/admin/judges/show.blade.php --}}
@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="container-fluid px-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.judges.index') }}">Judges</a></li>
                <li class="breadcrumb-item active">{{ $judge->name }}</li>
            </ol>
        </nav>

        <!-- Header with Actions -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Judge Details</h1>
                <p class="text-muted mb-0">View detailed information about {{ $judge->name }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.judges.edit', $judge) }}" class="btn btn-primary">
                    <i class="bi bi-pencil me-1"></i> Edit Judge
                </a>
                <a href="{{ route('admin.judges.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back to List
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Left Column: Profile Information -->
            <div class="col-lg-4">
                <!-- Profile Card -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
                    </div>
                    <div class="card-body text-center">
                        <!-- Avatar -->
                        <div class="mb-4">
                            <img src="{{ $judge->avatar ? Storage::url($judge->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($judge->name) . '&background=random&size=200' }}"
                                alt="{{ $judge->name }}" class="img-fluid rounded-circle border"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        </div>

                        <!-- Name & Title -->
                        <h3 class="h4 mb-1">{{ $judge->name }}</h3>
                        <p class="text-muted mb-3">Judge</p>

                        <!-- Location -->
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                            <span>{{ $judge->location }}</span>
                        </div>

                        <!-- Status Badge -->
                        <div class="mb-4">
                            @if ($judge->is_active)
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle me-1"></i> Active
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    <i class="bi bi-x-circle me-1"></i> Inactive
                                </span>
                            @endif
                        </div>

                        <!-- Bio -->
                        <div class="text-start mb-4">
                            <h6 class="text-primary mb-2">Bio</h6>
                            <p class="text-muted">{{ $judge->bio }}</p>
                        </div>

                        <!-- Tags -->
                        @if ($judge->tags->count() > 0)
                            <div class="text-start">
                                <h6 class="text-primary mb-2">Tags</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($judge->tags as $tag)
                                        <span class="badge bg-primary">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            Created: {{ $judge->created_at->format('M d, Y') }} |
                            Updated: {{ $judge->updated_at->format('M d, Y') }}
                        </small>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Quick Stats</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <div class="h4 text-primary">{{ $judge->credentials->count() }}</div>
                                <small class="text-muted">Credentials</small>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="h4 text-primary">{{ $judge->competitions->count() }}</div>
                                <small class="text-muted">Competitions</small>
                            </div>
                            <div class="col-6">
                                <div class="h4 text-primary">{{ $judge->tags->count() }}</div>
                                <small class="text-muted">Tags</small>
                            </div>
                            <div class="col-6">
                                <div class="h4 text-primary">{{ count($skills) }}</div>
                                <small class="text-muted">Skills</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Detailed Information -->
            <div class="col-lg-8">
                <!-- Expertise & Skills -->
                @if (count($skills) > 0)
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Expertise & Skills</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($skills as $skill)
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-start">
                                            <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                            <div>
                                                <p class="mb-0">{{ $skill }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Scoring Philosophy -->
                @if (count($philosophies) > 0)
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Scoring Philosophy</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($philosophies as $philosophy)
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-start">
                                            <i class="bi bi-star-fill text-warning me-2 mt-1"></i>
                                            <div>
                                                <p class="mb-0">{{ $philosophy }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Judging Credentials -->
                @if ($judge->credentials->count() > 0)
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Judging Credentials</h6>
                            <span class="badge bg-primary">{{ $judge->credentials->count() }}</span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="40">#</th>
                                            <th>Title</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($judge->credentials as $credential)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <strong>{{ $credential->title }}</strong>
                                                </td>
                                                <td>{{ $credential->value }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Competitions Judged -->
                @if ($judge->competitions->count() > 0)
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Competitions Judged</h6>
                            <span class="badge bg-primary">{{ $judge->competitions->count() }}</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Currently Judging -->
                                @if ($judge->currentCompetitions->count() > 0)
                                    <div class="col-md-6 mb-4">
                                        <h6 class="text-success mb-3">
                                            <i class="bi bi-record-circle me-2"></i> Currently Judging
                                        </h6>
                                        <div class="list-group">
                                            @foreach ($judge->currentCompetitions as $competition)
                                                <div class="list-group-item list-group-item-action">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h6 class="mb-1">{{ $competition->title }}</h6>
                                                        <small>{{ $competition->year }}</small>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-success me-2">Active</span>
                                                        <small class="text-muted">Currently participating</small>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Previously Judged -->
                                @if ($judge->previousCompetitions->count() > 0)
                                    <div class="col-md-6">
                                        <h6 class="text-secondary mb-3">
                                            <i class="bi bi-check-circle me-2"></i> Previously Judged
                                        </h6>
                                        <div class="list-group">
                                            @foreach ($judge->previousCompetitions as $competition)
                                                <div class="list-group-item list-group-item-action">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h6 class="mb-1">{{ $competition->title }}</h6>
                                                        <small>{{ $competition->year }}</small>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-secondary me-2">Completed</span>
                                                        <small class="text-muted">Previously judged</small>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Timeline Activity -->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Timeline</h6>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <!-- Created -->
                            <div class="timeline-item mb-3">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">Judge Created</h6>
                                        <small class="text-muted">{{ $judge->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="text-muted mb-0">Profile was created in the system</p>
                                </div>
                            </div>

                            <!-- Last Updated -->
                            @if ($judge->created_at != $judge->updated_at)
                                <div class="timeline-item mb-3">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-1">Profile Updated</h6>
                                            <small class="text-muted">{{ $judge->updated_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="text-muted mb-0">Profile information was last updated</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Credentials Added -->
                            @if ($judge->credentials->count() > 0)
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-info"></div>
                                    <div class="timeline-content">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-1">Credentials Added</h6>
                                            <small class="text-muted">{{ $judge->credentials->count() }} total</small>
                                        </div>
                                        <p class="text-muted mb-0">{{ $judge->credentials->count() }} judging credentials
                                            recorded</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons Footer -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('admin.judges.edit', $judge->id) }}" class="btn btn-primary">
                                    <i class="bi bi-pencil me-1"></i> Edit Judge
                                </a>
                                <a href="{{ route('judge.profile', $judge->id) }}" class="btn btn-info" target="_blank">
                                    <i class="bi bi-eye me-1"></i> View Public Profile
                                </a>
                            </div>
                            <div>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    <i class="bi bi-trash me-1"></i> Delete Judge
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar me-3">
                            <img src="{{ $judge->avatar ? Storage::url($judge->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($judge->name) . '&background=random' }}"
                                alt="{{ $judge->name }}" class="rounded-circle" style="width: 50px; height: 50px;">
                        </div>
                        <div>
                            <h6 class="mb-0">{{ $judge->name }}</h6>
                            <small class="text-muted">{{ $judge->location }}</small>
                        </div>
                    </div>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Warning:</strong> This action cannot be undone. The following will be deleted:
                        <ul class="mb-0 mt-2">
                            <li>Judge profile and all information</li>
                            <li>{{ $judge->credentials->count() }} credentials</li>
                            <li>{{ $judge->competitions->count() }} competition records</li>
                            <li>{{ $judge->tags->count() }} associated tags</li>
                            @if ($judge->avatar)
                                <li>Avatar image file</li>
                            @endif
                        </ul>
                    </div>
                    <p class="mb-0">Are you sure you want to delete this judge?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.judges.destroy', $judge->id) }}" method="POST">
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

    @push('styles')
        <style>
            .timeline {
                position: relative;
                padding-left: 30px;
            }

            .timeline-item {
                position: relative;
                padding-bottom: 20px;
            }

            .timeline-marker {
                position: absolute;
                left: -30px;
                top: 0;
                width: 16px;
                height: 16px;
                border-radius: 50%;
                border: 3px solid #fff;
                box-shadow: 0 0 0 3px var(--bs-primary);
            }

            .timeline-content {
                padding-left: 10px;
            }

            .timeline-item:last-child {
                padding-bottom: 0;
            }

            .timeline-item:not(:last-child)::before {
                content: '';
                position: absolute;
                left: -24px;
                top: 16px;
                bottom: -20px;
                width: 2px;
                background: #e3e6f0;
            }

            .card {
                border-radius: 10px;
                overflow: hidden;
            }

            .list-group-item {
                border-left: none;
                border-right: none;
                border-radius: 0 !important;
            }

            .list-group-item:first-child {
                border-top: none;
            }

            .list-group-item:last-child {
                border-bottom: none;
            }

            .avatar {
                width: 50px;
                height: 50px;
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

            .badge {
                font-size: 0.75rem;
                font-weight: 500;
                padding: 0.35em 0.65em;
            }

            .table-hover tbody tr:hover {
                background-color: rgba(0, 0, 0, 0.02);
            }

            .alert-danger {
                background-color: rgba(220, 53, 69, 0.1);
                border-color: rgba(220, 53, 69, 0.2);
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Delete confirmation with SweetAlert
            document.addEventListener('DOMContentLoaded', function() {
                const deleteForm = document.querySelector('#deleteModal form');
                if (deleteForm) {
                    deleteForm.addEventListener('submit', function(e) {
                        e.preventDefault();

                        Swal.fire({
                            title: 'Are you sure?',
                            html: `<div class="text-start">
                        <p>You are about to delete <strong>"{{ $judge->name }}"</strong> permanently.</p>
                        <div class="alert alert-danger py-2">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            This will delete all associated data including:
                            <ul class="mb-0 mt-1">
                                <li>{{ $judge->credentials->count() }} credentials</li>
                                <li>{{ $judge->competitions->count() }} competitions</li>
                                <li>{{ $judge->tags->count() }} tags</li>
                            </ul>
                        </div>
                        <p class="text-danger"><strong>This action cannot be undone!</strong></p>
                    </div>`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'Cancel',
                            width: '500px'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.submit();
                            }
                        });
                    });
                }
            });

            // Print functionality
            function printProfile() {
                window.print();
            }

            // Copy profile link
            function copyProfileLink() {
                const link = '{{ route('admin.judges.show', $judge->id) }}';
                navigator.clipboard.writeText(link).then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Copied!',
                        text: 'Profile link copied to clipboard',
                        showConfirmButton: false,
                        timer: 2000
                    });
                });
            }
        </script>
    @endpush
@endsection
