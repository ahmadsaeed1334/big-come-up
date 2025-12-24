@extends('layouts.app')

@section('title', 'Manage Tags')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Judge Tags</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTagModal">
                <i class="bi bi-plus-circle me-1"></i> Create Tag
            </button>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">All Tags</h6>
                    </div>
                    <div class="card-body">
                        @if ($tags->isEmpty())
                            <div class="text-center py-5">
                                <i class="bi bi-tags display-1 text-muted"></i>
                                <h5 class="mt-3">No tags created yet</h5>
                                <p class="text-muted">Create your first tag to assign to judges</p>
                            </div>
                        @else
                            <div class="row">
                                @foreach ($tags as $tag)
                                    <div class="col-md-6 mb-3">
                                        <div class="card border">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h6 class="mb-1">
                                                            <span
                                                                class="badge bg-primary me-2">{{ $tag->judges_count }}</span>
                                                            {{ $tag->name }}
                                                        </h6>
                                                        <small class="text-muted">
                                                            Created {{ $tag->created_at->diffForHumans() }}
                                                        </small>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown">
                                                            <i class="bi bi-three-dots"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#editTagModal{{ $tag->id }}">
                                                                    <i class="bi bi-pencil me-2"></i> Edit
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
                                                                        <i class="bi bi-trash me-2"></i> Delete
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
                                                                <input type="text" class="form-control" name="name"
                                                                    value="{{ $tag->name }}" required>
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
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tag Usage</h6>
                    </div>
                    <div class="card-body">
                        @if ($tags->isNotEmpty())
                            <canvas id="tagChart" height="250"></canvas>
                            <div class="mt-3">
                                <h6>Most Popular Tags:</h6>
                                <div class="list-group list-group-flush">
                                    @foreach ($tags->sortByDesc('judges_count')->take(5) as $tag)
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>{{ $tag->name }}</span>
                                            <span class="badge bg-primary rounded-pill">{{ $tag->judges_count }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <p class="text-muted">No tag data available</p>
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
                            <input type="text" class="form-control" name="name"
                                placeholder="e.g., 15+ Years of Experience" required>
                            <div class="form-text">Tags help categorize judges by expertise</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i> Create Tag
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @if ($tags->isNotEmpty())
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('tagChart').getContext('2d');
            const tagChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($tags->pluck('name')->toArray()) !!},
                    datasets: [{
                        data: {!! json_encode($tags->pluck('judges_count')->toArray()) !!},
                        backgroundColor: [
                            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                            '#9966FF', '#FF9F40', '#8AC926', '#1982C4'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                padding: 15
                            }
                        }
                    }
                }
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

        // Success message for AJAX tag creation (if you're using AJAX in create judge page)
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

        // Auto-focus on modal inputs
        document.addEventListener('DOMContentLoaded', function() {
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
    </script>

    @push('styles')
        <style>
            .border-radius-10 {
                border-radius: 10px !important;
            }

            .dropdown-menu {
                min-width: 120px;
            }

            .card {
                border-radius: 10px;
                overflow: hidden;
            }

            .card.border {
                border: 1px solid #e3e6f0 !important;
            }

            .list-group-item {
                border: none;
                padding: 0.75rem 0;
            }

            .modal-content {
                border-radius: 10px;
                border: none;
            }

            .modal-header {
                background: #f8f9fc;
                border-bottom: 1px solid #e3e6f0;
                border-radius: 10px 10px 0 0;
            }

            .alert-info {
                background-color: rgba(13, 110, 253, 0.1);
                border-color: rgba(13, 110, 253, 0.2);
                color: #0d6efd;
            }
        </style>
    @endpush
@endsection
