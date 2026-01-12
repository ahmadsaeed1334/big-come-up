@extends('layouts.app')

@section('title', 'Manage Tags')

@section('content')
    <style>
        /* Search box styling */
        .search-container {
            position: relative;
            /* width: 300px; */
        }

        .search-input {
            padding-left: 40px;
            height: 40px;
            border-radius: 8px;
            border: 1px solid #e3e6f0;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 10;
        }

        .clear-search {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            z-index: 10;
        }

        .clear-search:hover {
            color: #dc3545;
        }

        .tag-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            min-width: 30px;
        }

        .card-header {
            background: linear-gradient(135deg, #f8f9fc 0%, #fff 100%);
            border-bottom: 1px solid #e3e6f0;
        }

        .tag-card {
            transition: all 0.3s ease;
            border: 1px solid #e3e6f0;
            border-radius: 10px;
        }

        .tag-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-color: #4e73df;
            z-index: 5;
        }

        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }

        h3 {
            color: #fff;
        }
    </style>

    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class=" mb-0 ">Judge Tags</h3>
                {{-- <p class="text-muted mb-0">Manage tags to categorize judges by expertise</p> --}}
            </div>
            <div class="d-flex align-items-center gap-3">
                <!-- Search Form -->
                <form action="{{ route('admin.judge-tags.index') }}" method="GET" class="mb-0">
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" name="search" class="form-control search-input"
                            placeholder="Search tags by name..." value="{{ request('search') }}" autocomplete="off">
                        @if (request('search'))
                            <a href="{{ route('admin.judge-tags.index') }}" class="clear-search">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTagModal">
                    <i class="bi bi-plus-circle me-1"></i> Create Tag
                </button>
            </div>
        </div>

        <!-- Search Results Info -->
        {{-- @if (request('search'))
            <div class="alert alert-info mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-search me-2"></i>
                        Showing results for: <strong>"{{ request('search') }}"</strong>
                    </div>
                    <a href="{{ route('admin.judge-tags.index') }}" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-times me-1"></i> Clear search
                    </a>
                </div>
            </div>
        @endif --}}

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">All Tags</h6>
                        <span class="badge bg-secondary">
                            {{ $tags->total() }} tag(s) found
                        </span>
                    </div>
                    <div class="card-body">
                        @if ($tags->isEmpty())
                            <div class="text-center py-5">
                                <i class="bi bi-tags display-1 text-muted"></i>
                                <h5 class="mt-3">No tags found</h5>
                                <p class="text-muted">
                                    @if (request('search'))
                                        No tags found for "{{ request('search') }}"
                                    @else
                                        Create your first tag to assign to judges
                                    @endif
                                </p>
                                @if (request('search'))
                                    <a href="{{ route('admin.judge-tags.index') }}" class="btn btn-primary mt-2">
                                        <i class="fas fa-list me-1"></i> Show all tags
                                    </a>
                                @endif
                            </div>
                        @else
                            <div class="row">
                                @foreach ($tags as $tag)
                                    <div class="col-md-6 mb-3">
                                        <div class="card tag-card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <span
                                                                class="badge tag-badge me-2">{{ $tag->judges_count }}</span>
                                                            <h6 class="mb-0 text-primary">{{ $tag->name }}</h6>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <small class="text-muted">
                                                                <i class="far fa-clock me-1"></i>
                                                                Created {{ $tag->created_at->diffForHumans() }}
                                                            </small>
                                                            @if ($tag->updated_at != $tag->created_at)
                                                                <small class="text-muted">
                                                                    <i class="fas fa-sync me-1"></i>
                                                                    Updated {{ $tag->updated_at->diffForHumans() }}
                                                                </small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="dropdown ms-2">
                                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown">
                                                            <i class="bi bi-three-dots"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#editTagModal{{ $tag->id }}">
                                                                    <i class="fas fa-edit me-2"></i> Edit
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <form id="deleteTagForm{{ $tag->id }}"
                                                                    action="{{ route('admin.judge-tags.destroy', $tag->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="dropdown-item text-danger"
                                                                        onclick="confirmDeleteTag('{{ $tag->id }}', '{{ $tag->name }}')">
                                                                        <i class="fas fa-trash me-2"></i> Delete
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Edit Tag Modal --}}
                                        <div class="modal fade" id="editTagModal{{ $tag->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Tag</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form action="{{ route('admin.judge-tags.update', $tag->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Tag Name</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">
                                                                        <i class="ni ni-tag"></i>
                                                                    </span>
                                                                    <input type="text"
                                                                        class="form-control border-start-0" name="name"
                                                                        value="{{ $tag->name }}"
                                                                        placeholder="Enter tag name" required>
                                                                </div>
                                                                <div class="form-text">Update the tag name</div>
                                                            </div>

                                                            <div class="alert alert-info">
                                                                <i class="bi bi-info-circle me-2"></i>
                                                                This tag is assigned to {{ $tag->judges_count }} judge(s)
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="bi bi-save me-1"></i> Update Tag
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Pagination --}}

                            @include('admin.partials.pagination', ['items' => $tags])

                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tag Statistics</h6>
                    </div>
                    <div class="card-body">
                        @php
                            $sortedTags = $tags->sortByDesc('judges_count');
                            $topTags = $sortedTags->take(5);
                            $totalTags = $tags->count();
                            $totalJudgesTagged = $tags->sum('judges_count');
                            $avgJudgesPerTag = $totalTags > 0 ? $totalJudgesTagged / $totalTags : 0;
                        @endphp

                        @if ($tags->count() > 0)
                            <div class="chart-container">
                                <canvas id="tagChart"></canvas>
                            </div>

                            <div class="mt-4">
                                <h6 class="mb-3">Top Tags by Usage:</h6>
                                <div class="list-group list-group-flush">
                                    @foreach ($topTags as $index => $tag)
                                        <div
                                            class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            <div class="d-flex align-items-center">
                                                <span class="badge bg-primary rounded-circle me-2"
                                                    style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                                                    {{ $index + 1 }}
                                                </span>
                                                <span class="text-truncate"
                                                    style="max-width: 150px;">{{ $tag->name }}</span>
                                            </div>
                                            <span class="badge bg-primary rounded-pill">{{ $tag->judges_count }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-4 p-3 bg-light rounded">
                                <h6 class="mb-2">Total Statistics:</h6>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Total Tags:</span>
                                    <strong>{{ $totalTags }}</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Total Judges Tagged:</span>
                                    <strong>{{ $totalJudgesTagged }}</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Avg. Judges per Tag:</span>
                                    <strong>{{ number_format($avgJudgesPerTag, 1) }}</strong>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-chart-pie fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No tag data available</p>
                                <p class="text-sm text-muted">Create tags first to see statistics</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Create Tag Modal --}}
    <div class="modal fade" id="createTagModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.judge-tags.store') }}" method="POST" id="createTagForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tag Name *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ni ni-tag"></i>
                                </span>
                                <input type="text" class="form-control border-start-0" name="name"
                                    placeholder="e.g., 15+ Years of Experience, Patent Expert" required>
                            </div>
                            <div class="form-text">
                                Tags help categorize judges by expertise, experience, or specialization
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save  me-1"></i> Create Tag
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($tags->count() > 0)
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Prepare chart data
                const tags = {!! json_encode(
                    $tags->take(8)->map(function ($tag) {
                        return [
                            'name' => $tag->name,
                            'count' => $tag->judges_count,
                        ];
                    }),
                ) !!};

                const chartLabels = tags.map(tag => tag.name);
                const chartData = tags.map(tag => tag.count);

                // Colors for chart
                const chartColors = [
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e',
                    '#e74a3b', '#858796', '#6f42c1', '#20c9a6'
                ];

                // Get canvas context
                const ctx = document.getElementById('tagChart').getContext('2d');

                // Create chart
                const tagChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: chartLabels,
                        datasets: [{
                            data: chartData,
                            backgroundColor: chartColors.slice(0, chartLabels.length),
                            borderWidth: 2,
                            borderColor: '#fff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    boxWidth: 12,
                                    padding: 15,
                                    font: {
                                        size: 11
                                    },
                                    generateLabels: function(chart) {
                                        const data = chart.data;
                                        if (data.labels.length && data.datasets.length) {
                                            return data.labels.map(function(label, i) {
                                                const value = data.datasets[0].data[i];
                                                return {
                                                    text: label + ' (' + value + ')',
                                                    fillStyle: data.datasets[0].backgroundColor[i],
                                                    hidden: false,
                                                    index: i
                                                };
                                            });
                                        }
                                        return [];
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        return label + ': ' + value + ' judge(s)';
                                    }
                                }
                            }
                        },
                        cutout: '60%',
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                });

                // Debug logging
                console.log('Chart Data:', {
                    labels: chartLabels,
                    data: chartData,
                    tags: tags
                });
            });
        </script>
    @endif

    <script>
        // Tag Delete Confirmation with SweetAlert
        function confirmDeleteTag(tagId, tagName) {
            Swal.fire({
                title: 'Delete Tag?',
                html: `<div class="text-start">
                            <p class="mb-2">Are you sure you want to delete <strong>"${tagName}"</strong>?</p>
                            <div class="alert alert-warning py-2 mb-3">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                This will remove the tag from all associated judges.
                            </div>
                            <p class="text-danger mb-0"><strong>This action cannot be undone!</strong></p>
                        </div>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                width: '500px',
                customClass: {
                    popup: 'border-radius-10'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`deleteTagForm${tagId}`).submit();
                }
            });
        }

        // Form validation for Create Tag Modal
        document.getElementById('createTagForm')?.addEventListener('submit', function(e) {
            const tagName = this.querySelector('input[name="name"]').value.trim();
            if (!tagName) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Please enter a tag name',
                    confirmButtonColor: '#3085d6',
                });
            }
        });

        // Auto-submit search form when typing stops
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="search"]');
            let searchTimeout;

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        this.form.submit();
                    }, 500); // Submit after 500ms of no typing
                });
            }

            // Auto-focus on modal inputs
            const createModal = document.getElementById('createTagModal');
            if (createModal) {
                createModal.addEventListener('shown.bs.modal', function() {
                    this.querySelector('input[name="name"]').focus();
                });
            }

            // Edit modals focus
            const editModals = document.querySelectorAll('[id^="editTagModal"]');
            editModals.forEach(modal => {
                modal.addEventListener('shown.bs.modal', function() {
                    this.querySelector('input[name="name"]').focus().select();
                });
            });
        });

        // Success message for AJAX tag creation
        function showTagCreatedSuccess(tagName) {
            Swal.fire({
                icon: 'success',
                title: 'Tag Created!',
                text: `"${tagName}" has been created successfully.`,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
        }
    </script>
@endsection
