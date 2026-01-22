{{-- resources/views/admin/judges/show.blade.php --}}
@extends('layouts.app')

@section('title', $title)

@section('content')

    <!-- Header with Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card p-4">
                <div class="card-header pb-3 p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Judge Details</h6>
                            <p class="text-sm mb-0">View detailed information about {{ $judge->name }}</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.judges.edit', $judge) }}" class="btn btn-primary btn-sm mb-0">
                                <i class="bi bi-pencil me-1"></i> Edit Judge
                            </a>
                            <a href="{{ route('admin.judges.index') }}" class="btn btn-outline-secondary btn-sm mb-0">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </div>
                </div>


                <!-- Quick Stats -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Credentials</p>
                                            <h5 class="font-weight-bolder">
                                                {{ $judge->credentials->count() }}
                                            </h5>
                                            <p class="mb-0">
                                                <span
                                                    class="text-success text-sm font-weight-bolder">+{{ $judge->credentials->count() }}</span>
                                                total
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                            <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
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
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Competitions</p>
                                            <h5 class="font-weight-bolder">
                                                {{ $judge->competitions->count() }}
                                            </h5>
                                            <p class="mb-0">
                                                <span class="text-success text-sm font-weight-bolder">
                                                    {{ $judge->currentCompetitions->count() }} active
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                            <i class="ni ni-trophy text-lg opacity-10" aria-hidden="true"></i>
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
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Skills</p>
                                            <h5 class="font-weight-bolder">
                                                {{ count($skills) }}
                                            </h5>
                                            <p class="mb-0">
                                                <span class="text-success text-sm font-weight-bolder">Expertise</span>
                                                areas
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                            <i class="ni ni-ruler-pencil text-lg opacity-10" aria-hidden="true"></i>
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
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Status</p>
                                            <h5 class="font-weight-bolder">
                                                @if ($judge->is_active)
                                                    Active
                                                @else
                                                    Inactive
                                                @endif
                                            </h5>
                                            <p class="mb-0">
                                                @if ($judge->is_active)
                                                    <span class="text-success text-sm font-weight-bolder">Available</span>
                                                @else
                                                    <span class="text-danger text-sm font-weight-bolder">Unavailable</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                            <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <!-- Left Column: Profile Information -->
                    <div class="col-lg-4">
                        <!-- Profile Card -->
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="text-center">
                                    <!-- Avatar -->
                                    <div class="mb-4 d-flex justify-content-center">
                                        <img src="{{ $judge->avatar ? Storage::url($judge->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($judge->name) . '&background=random&size=200' }}"
                                            alt="{{ $judge->name }}" class="img-fluid rounded-circle border"
                                            style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>

                                    <!-- Name & Title -->
                                    <h3 class="h4 mb-1">{{ $judge->name }}</h3>
                                    <p class="text-muted mb-3">Judge</p>

                                    <!-- Location -->
                                    <div class="d-flex align-items-center justify-content-center mb-3">
                                        <i class="ni ni-pin-3 text-primary me-2"></i>
                                        <span>{{ $judge->location }}</span>
                                    </div>

                                    <!-- Status Badge -->
                                    <div class="mb-4">
                                        @if ($judge->is_active)
                                            <span class="badge bg-gradient-success">
                                                <i class="ni ni-check-bold me-1"></i> Active
                                            </span>
                                        @else
                                            <span class="badge bg-gradient-secondary">
                                                <i class="ni ni-fat-remove me-1"></i> Inactive
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Bio -->
                                    <div class="text-start mb-4">
                                        <h6 class="text-primary mb-2">Bio</h6>
                                        <p class="text-sm text-muted">{{ $judge->bio }}</p>
                                    </div>

                                    <!-- Tags -->
                                    @if ($judge->tags->count() > 0)
                                        <div class="text-start">
                                            <h6 class="text-primary mb-2">Tags</h6>
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach ($judge->tags as $tag)
                                                    <span class="badge bg-gradient-primary">{{ $tag->name }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer pt-0">
                                <hr class="horizontal dark mb-3">
                                <small class="text-muted text-sm">
                                    Created: {{ $judge->created_at->format('M d, Y') }} |
                                    Updated: {{ $judge->updated_at->format('M d, Y') }}
                                </small>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card mt-4">
                            <div class="card-header pb-3 p-3">
                                <h6 class="mb-0">Quick Actions</h6>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-group">
                                    <li
                                        class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex align-items-center">
                                            <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                <i class="ni ni-single-copy-04 text-white opacity-10"></i>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-1 text-dark text-sm">Edit Profile</h6>
                                                <span class="text-xs">Update judge information</span>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <a href="{{ route('admin.judges.edit', $judge->id) }}"
                                                class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                                                <i class="ni ni-bold-right" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li
                                        class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex align-items-center">
                                            <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                <i class="ni ni-world text-white opacity-10"></i>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-1 text-dark text-sm">Public Profile</h6>
                                                <span class="text-xs">View as public</span>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <a href="{{ route('judge.profile', $judge->id) }}" target="_blank"
                                                class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                                                <i class="ni ni-bold-right" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li
                                        class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                        <div class="d-flex align-items-center">
                                            <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                <i class="ni ni-archive-2 text-white opacity-10"></i>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-1 text-dark text-sm">Delete Judge</h6>
                                                <span class="text-xs">Remove permanently</span>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <button type="button"
                                                class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                <i class="ni ni-bold-right" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Detailed Information -->
                    <div class="col-lg-8">
                        <!-- Expertise & Skills -->
                        @if (count($skills) > 0)
                            <div class="card mb-4">
                                <div class="card-header pb-3 p-3">
                                    <h6 class="mb-0">Expertise & Skills</h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        @foreach ($skills as $skill)
                                            <div class="col-md-6 mb-3">
                                                <div class="d-flex align-items-start">
                                                    <div
                                                        class="icon icon-shape icon-sm me-3 bg-gradient-success shadow text-center">
                                                        <i class="ni ni-check-bold text-white opacity-10"></i>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm mb-0">{{ $skill }}</p>
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
                            <div class="card mb-4">
                                <div class="card-header pb-3 p-3">
                                    <h6 class="mb-0">Scoring Philosophy</h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        @foreach ($philosophies as $philosophy)
                                            <div class="col-md-6 mb-3">
                                                <div class="d-flex align-items-start">
                                                    <div
                                                        class="icon icon-shape icon-sm me-3 bg-gradient-warning shadow text-center">
                                                        <i class="ni ni-favourite-28 text-white opacity-10"></i>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm mb-0">{{ $philosophy }}</p>
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
                            <div class="card mb-4">
                                <div class="card-header pb-3 p-3 d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Judging Credentials</h6>
                                    <span class="badge bg-gradient-primary">{{ $judge->credentials->count() }}</span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Title</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($judge->credentials as $credential)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div>
                                                                    <div
                                                                        class="icon icon-shape icon-sm bg-gradient-info shadow text-center">
                                                                        <i
                                                                            class="ni ni-single-copy-04 text-white opacity-10"></i>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="d-flex flex-column justify-content-center mx-2">
                                                                    <h6 class="mb-0 text-sm">{{ $credential->title }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="text-sm font-weight-bold mb-0">
                                                                {{ $credential->value }}</p>
                                                        </td>
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
                            <div class="card">
                                <div class="card-header pb-3 p-3">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-0">Competitions Judged</h6>
                                        <span class="badge bg-gradient-primary">{{ $judge->competitions->count() }}</span>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <tbody>
                                            <!-- Currently Judging -->
                                            @if ($judge->currentCompetitions->count() > 0)
                                                @foreach ($judge->currentCompetitions as $competition)
                                                    <tr>
                                                        <td class="w-30">
                                                            <div class="d-flex px-2 py-1 align-items-center">
                                                                <div>
                                                                    <div
                                                                        class="icon icon-shape icon-sm bg-gradient-success shadow text-center rounded-circle">
                                                                        <i
                                                                            class="ni ni-spaceship text-white opacity-10"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="ms-4">
                                                                    <p class="text-xs font-weight-bold mb-0">Competition:
                                                                    </p>
                                                                    <h6 class="text-sm mb-0">{{ $competition->title }}
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                <p class="text-xs font-weight-bold mb-0">Year:</p>
                                                                <h6 class="text-sm mb-0">{{ $competition->year }}</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                <p class="text-xs font-weight-bold mb-0">Status:</p>
                                                                <h6 class=" badge bg-gradient-success">Active</h6>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-sm">
                                                            <div class="col text-center">
                                                                <p class="text-xs font-weight-bold mb-0">Currently judging
                                                                </p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                            <!-- Previously Judged -->
                                            @if ($judge->previousCompetitions->count() > 0)
                                                @foreach ($judge->previousCompetitions as $competition)
                                                    <tr>
                                                        <td class="w-30">
                                                            <div class="d-flex px-2 py-1 align-items-center">
                                                                <div>
                                                                    <div
                                                                        class="icon icon-shape icon-sm bg-gradient-secondary shadow text-center rounded-circle">
                                                                        <i class="ni ni-trophy text-white opacity-10"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="ms-4">
                                                                    <p class="text-xs font-weight-bold mb-0">Competition:
                                                                    </p>
                                                                    <h6 class="text-sm mb-0">{{ $competition->title }}
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                <p class="text-xs font-weight-bold mb-0">Year:</p>
                                                                <h6 class="text-sm mb-0">{{ $competition->year }}</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                <p class="text-xs font-weight-bold mb-0">Status:</p>
                                                                <h6 class="badge bg-gradient-success">Completed</h6>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-sm">
                                                            <div class="col text-center">
                                                                <p class="text-xs font-weight-bold mb-0">Previously judged
                                                                </p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Timeline Activity -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pb-3 p-3">
                                <h6 class="mb-0">Timeline Activity</h6>
                            </div>
                            <div class="card-body p-3">
                                <div class="timeline timeline-one-side">
                                    <!-- Created -->
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step bg-gradient-primary">
                                            <i class="ni ni-single-02 text-white"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">Judge Created</h6>
                                            <p class="text-secondary text-xs mt-1 mb-0">
                                                {{ $judge->created_at->diffForHumans() }}
                                            </p>
                                            <p class="text-sm mt-3 mb-2">Profile was created in the system</p>
                                        </div>
                                    </div>

                                    <!-- Last Updated -->
                                    @if ($judge->created_at != $judge->updated_at)
                                        <div class="timeline-block mb-3">
                                            <span class="timeline-step bg-gradient-success">
                                                <i class="ni ni-curved-next text-white"></i>
                                            </span>
                                            <div class="timeline-content">
                                                <h6 class="text-dark text-sm font-weight-bold mb-0">Profile Updated</h6>
                                                <p class="text-secondary text-xs mt-1 mb-0">
                                                    {{ $judge->updated_at->diffForHumans() }}</p>
                                                <p class="text-sm mt-3 mb-2">Profile information was last updated</p>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Credentials Added -->
                                    @if ($judge->credentials->count() > 0)
                                        <div class="timeline-block">
                                            <span class="timeline-step bg-gradient-info">
                                                <i class="ni ni-hat-3 text-white"></i>
                                            </span>
                                            <div class="timeline-content">
                                                <h6 class="text-dark text-sm font-weight-bold mb-0">Credentials Added</h6>
                                                <p class="text-secondary text-xs mt-1 mb-0">
                                                    {{ $judge->credentials->count() }}
                                                    total</p>
                                                <p class="text-sm mt-3 mb-2">{{ $judge->credentials->count() }} judging
                                                    credentials recorded</p>
                                            </div>
                                        </div>
                                    @endif
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
                                            alt="{{ $judge->name }}" class="rounded-circle"
                                            style="width: 50px; height: 50px;">
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $judge->name }}</h6>
                                        <small class="text-muted">{{ $judge->location }}</small>
                                    </div>
                                </div>
                                <div class="alert bg-gradient-danger">
                                    <i class="ni ni-notification-70 text-white me-2"></i>
                                    <span class="text-white"><strong>Warning:</strong> This action cannot be undone. The
                                        following will
                                        be deleted:</span>
                                    <ul class="mb-0 mt-2 text-white">
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
                                <button type="button" class="btn bg-gradient-secondary mb-0"
                                    data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('admin.judges.destroy', $judge->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn bg-gradient-danger mb-0">
                                        <i class="ni ni-fat-remove me-1"></i> Delete Judge
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    <div class="alert bg-gradient-danger text-white py-2">
                        <i class="ni ni-notification-70 me-2"></i>
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
