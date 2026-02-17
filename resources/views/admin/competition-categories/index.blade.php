@extends('layouts.app')

@section('title', 'Competition Categories')

@section('content')
    <style>
        /* Search box styling */
        .search-container {
            position: relative;
        }

        .search-input {
            padding-left: 40px;
            height: 40px;
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

        h3 {
            color: #fff;
        }

        .category-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge-active {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-badge-inactive {
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Categories</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $totalCategories ?? 0 }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="bi bi-grid-3x3-gap-fill text-lg opacity-10"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Active Categories</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $activeCategories ?? 0 }}
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

                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Competitions</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $totalCompetitions ?? 0 }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                        <i class="bi bi-trophy-fill text-lg opacity-10"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Competition Categories</h6>
                            <p class="text-sm mb-0 text-muted">Manage categories for competitions</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <!-- Search Form -->
                            <form action="{{ route('admin.competition-categories.index') }}" method="GET" class="mb-0">
                                <div class="search-container">
                                    <i class="fas fa-search search-icon"></i>
                                    <input type="text" name="search" class="form-control search-input"
                                        placeholder="Search categories by name or slug..." value="{{ request('search') }}"
                                        autocomplete="off">
                                    @if (request('search'))
                                        <a href="{{ route('admin.competition-categories.index') }}" class="clear-search">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </div>
                            </form>

                            <!-- Status Filter -->
                            <select name="status_filter" id="status_filter" class="form-select" style="width: 150px;">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>

                            <!-- Add Category Button -->
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#createCategoryModal">
                                <i class="fas fa-plus me-1"></i>
                                Add Category
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <!-- Search Results Info -->
                    @if (request('search') || request('status'))
                        <div class="px-4 pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-sm text-muted mb-0">
                                        @if (request('search'))
                                            Showing results for: <strong>"{{ request('search') }}"</strong>
                                        @endif
                                        @if (request('status'))
                                            @if (request('search'))
                                                |
                                            @endif
                                            Status: <strong>{{ ucfirst(request('status')) }}</strong>
                                        @endif
                                        <a href="{{ route('admin.competition-categories.index') }}"
                                            class="text-danger ms-2">
                                            <i class="fas fa-times me-1"></i> Clear all filters
                                        </a>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-muted mb-0">
                                        Showing {{ $categories->firstItem() ?? 0 }} - {{ $categories->lastItem() ?? 0 }}
                                        of
                                        {{ $categories->total() }} categories
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive p-0">
                        @if ($categories->count() > 0)
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4"
                                            width="5%">
                                            #
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="25%">
                                            Category
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="20%">
                                            Slug
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="15%">
                                            Description
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="10%">
                                            Competitions
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="10%">
                                            Status
                                        </th>
                                        <th class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 pe-4"
                                            width="15%">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($categories as $index => $category)
                                        <tr>
                                            <td class="text-sm ps-4">
                                                {{ $index + 1 + ($categories->currentPage() - 1) * $categories->perPage() }}
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class=" icon-shape-primary me-3 text-center rounded-circle">
                                                        <i class="fas fa-trophy text-white"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $category->name }}
                                                        </h6>
                                                        <small class="text-muted">ID: #{{ $category->id }}</small>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <span class="badge badge-sm bg-gradient-dark">
                                                    {{ $category->slug }}
                                                </span>
                                            </td>

                                            <td>
                                                <span class="text-xs">
                                                    {{ Str::limit($category->description, 30) ?? '—' }}
                                                </span>
                                            </td>

                                            <td class="align-middle text-center">
                                                <span class="badge badge-sm bg-gradient-info">
                                                    {{ $category->competitions_count ?? 0 }}
                                                </span>
                                            </td>

                                            <td class="align-middle text-center">
                                                @if ($category->is_active)
                                                    <span class="status-badge-active">Active</span>
                                                @else
                                                    <span class="status-badge-inactive">Inactive</span>
                                                @endif
                                            </td>

                                            <td class="align-middle text-end pe-4">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <!-- Toggle Status Button -->
                                                    @if ($category->is_active)
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-warning action-btn"
                                                            onclick="confirmToggleStatus({{ $category->id }}, 'deactivate')"
                                                            data-bs-toggle="tooltip" title="Deactivate Category">
                                                            <i class="fas fa-pause-circle"></i>
                                                        </button>
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-success action-btn"
                                                            onclick="confirmToggleStatus({{ $category->id }}, 'activate')"
                                                            data-bs-toggle="tooltip" title="Activate Category">
                                                            <i class="fas fa-play-circle"></i>
                                                        </button>
                                                    @endif
                                                    <form id="toggle-form-{{ $category->id }}"
                                                        action="{{ route('admin.competition-categories.toggle', $category) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('POST')
                                                    </form>

                                                    <!-- Edit Button -->
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-primary action-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editCategoryModal{{ $category->id }}"
                                                        data-bs-toggle="tooltip" title="Edit Category">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <!-- Delete Button - Only if no competitions -->
                                                    @if (($category->competitions_count ?? 0) == 0)
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger action-btn"
                                                            onclick="confirmCategoryDelete({{ $category->id }})"
                                                            data-bs-toggle="tooltip" title="Delete Category">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <form id="delete-category-{{ $category->id }}"
                                                            action="{{ route('admin.competition-categories.destroy', $category->id) }}"
                                                            method="POST" style="display:none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-secondary action-btn" disabled
                                                            data-bs-toggle="tooltip"
                                                            title="Cannot delete: Has {{ $category->competitions_count }} competition(s)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Edit Category Modal -->
                                        <div class="modal fade" id="editCategoryModal{{ $category->id }}"
                                            tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form
                                                        action="{{ route('admin.competition-categories.update', $category->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">
                                                                <i class="fas fa-edit me-2 text-primary"></i>
                                                                Edit Category
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold">Category Name *</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-tag"></i>
                                                                    </span>
                                                                    <input type="text" name="name"
                                                                        class="form-control border-start-0"
                                                                        value="{{ old('name', $category->name) }}"
                                                                        placeholder="Enter category name" required>
                                                                </div>
                                                                <small class="text-muted">
                                                                    <i class="fas fa-link me-1"></i>
                                                                    Slug will be: <span
                                                                        class="fw-bold">{{ Str::slug($category->name) }}</span>
                                                                </small>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold">Description</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-align-left"></i>
                                                                    </span>
                                                                    <textarea name="description" class="form-control border-start-0" rows="3"
                                                                        placeholder="Enter category description (optional)">{{ old('description', $category->description) }}</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="is_active"
                                                                        id="edit_is_active_{{ $category->id }}"
                                                                        value="1"
                                                                        {{ $category->is_active ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="edit_is_active_{{ $category->id }}">
                                                                        <span class="fw-bold">Active Category</span>
                                                                    </label>
                                                                </div>
                                                                <small class="text-muted">
                                                                    Inactive categories won't appear in competition creation
                                                                    dropdown
                                                                </small>
                                                            </div>

                                                            <div class="bg-light p-3 rounded">
                                                                <div class="d-flex justify-content-between">
                                                                    <span class="text-sm">Created:</span>
                                                                    <span
                                                                        class="text-sm fw-bold">{{ $category->created_at->format('M d, Y H:i') }}</span>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <span class="text-sm">Last Updated:</span>
                                                                    <span
                                                                        class="text-sm fw-bold">{{ $category->updated_at->format('M d, Y H:i') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="fas fa-times me-1"></i> Cancel
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fas fa-save me-1"></i> Update Category
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                                <h5 class="text-muted">
                                    @if (request('search') || request('status'))
                                        No categories found matching your criteria
                                    @else
                                        No competition categories found
                                    @endif
                                </h5>
                                <p class="text-sm text-muted mb-3">
                                    @if (request('search') || request('status'))
                                        Try adjusting your search or filter criteria
                                    @else
                                        Start by creating your first competition category
                                    @endif
                                </p>
                                @if (request('search') || request('status'))
                                    <a href="{{ route('admin.competition-categories.index') }}"
                                        class="btn btn-outline-primary">
                                        <i class="fas fa-undo me-1"></i> Clear Filters
                                    </a>
                                @else
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#createCategoryModal">
                                        <i class="fas fa-plus me-1"></i> Add Category
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Pagination -->
                    @if ($categories->count() > 0)
                        @include('admin.partials.pagination', ['items' => $categories])
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Create Category Modal -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.competition-categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-plus-circle me-2 text-success"></i>
                            Add New Category
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category Name *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-tag"></i>
                                </span>
                                <input type="text" name="name" id="category_name"
                                    class="form-control border-start-0" value="{{ old('name') }}"
                                    placeholder="e.g., DJ Battle, Beat Making, Remix Contest" required>
                            </div>
                            <small class="text-muted">
                                <i class="fas fa-link me-1"></i>
                                Slug will be auto-generated from name
                            </small>
                            <div id="slug-preview" class="mt-1 text-xs" style="display: none;">
                                <span class="text-muted">Slug preview:</span>
                                <span id="slug-text" class="fw-bold text-primary"></span>
                            </div>
                            @error('name')
                                <div class="text-danger text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-align-left"></i>
                                </span>
                                <textarea name="description" class="form-control border-start-0" rows="3"
                                    placeholder="Enter category description (optional)">{{ old('description') }}</textarea>
                            </div>
                            <small class="text-muted">
                                Brief description of what this category represents
                            </small>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="create_is_active"
                                    value="1" checked>
                                <label class="form-check-label" for="create_is_active">
                                    <span class="fw-bold">Active Category</span>
                                </label>
                            </div>
                            <small class="text-muted">
                                Active categories are available for creating competitions
                            </small>
                        </div>

                        <div class="alert alert-info py-2 mb-0">
                            <i class="fas fa-info-circle me-1"></i>
                            <small>Categories help organize competitions and make them easier to find.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Save Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Auto-submit search form when typing stops
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.querySelector('input[name="search"]');
                let searchTimeout;

                if (searchInput) {
                    searchInput.addEventListener('input', function() {
                        clearTimeout(searchTimeout);
                        searchTimeout = setTimeout(() => {
                            this.form.submit();
                        }, 500);
                    });
                }

                // Status filter auto-submit
                const statusFilter = document.getElementById('status_filter');
                if (statusFilter) {
                    statusFilter.addEventListener('change', function() {
                        let url = new URL(window.location.href);
                        if (this.value) {
                            url.searchParams.set('status', this.value);
                        } else {
                            url.searchParams.delete('status');
                        }
                        url.searchParams.delete('page'); // Reset to page 1
                        window.location.href = url.toString();
                    });
                }

                // Live slug preview in create modal
                const categoryNameInput = document.getElementById('category_name');
                const slugPreview = document.getElementById('slug-preview');
                const slugText = document.getElementById('slug-text');

                if (categoryNameInput) {
                    categoryNameInput.addEventListener('input', function() {
                        const name = this.value.trim();
                        if (name) {
                            const slug = name.toLowerCase()
                                .replace(/[^\w\s]/gi, '')
                                .replace(/\s+/g, '-');
                            slugText.textContent = slug;
                            slugPreview.style.display = 'block';
                        } else {
                            slugPreview.style.display = 'none';
                        }
                    });
                }
            });

            // Confirm delete
            function confirmCategoryDelete(categoryId) {
                Swal.fire({
                    title: 'Delete Category?',
                    text: "This category will be permanently deleted. This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#8392ab',
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-category-' + categoryId).submit();
                    }
                });
            }

            // Confirm toggle status
            function confirmToggleStatus(categoryId, action) {
                Swal.fire({
                    title: action === 'activate' ? 'Activate Category?' : 'Deactivate Category?',
                    text: action === 'activate' ?
                        'This category will become available for competitions.' :
                        'This category will not be available for competitions.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: action === 'activate' ? '#28a745' : '#ffc107',
                    cancelButtonColor: '#8392ab',
                    confirmButtonText: action === 'activate' ? 'Yes, activate' : 'Yes, deactivate',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('toggle-form-' + categoryId).submit();
                    }
                });
            }

            // Reinitialize tooltips after modal loads
            document.addEventListener('shown.bs.modal', function() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });

            // Clear form when modal is closed
            document.addEventListener('hidden.bs.modal', function(event) {
                const modal = event.target;
                const form = modal.querySelector('form');
                if (form) {
                    form.reset();
                }
                // Hide slug preview
                if (modal.id === 'createCategoryModal') {
                    const slugPreview = document.getElementById('slug-preview');
                    if (slugPreview) slugPreview.style.display = 'none';
                }
            });

            // Auto-focus on name input when modal opens
            document.addEventListener('shown.bs.modal', function(event) {
                const modal = event.target;
                const nameInput = modal.querySelector('input[name="name"]');
                if (nameInput) {
                    nameInput.focus();
                }
            });
        </script>
    @endpush

    @push('styles')
        <style>
            .icon-shape-primary {
                background: linear-gradient(135deg, #5e72e4 0%, #825ee4 100%);
                width: 36px;
                height: 36px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .status-badge-active,
            .status-badge-inactive {
                display: inline-block;
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 11px;
                font-weight: 600;
            }

            .action-btn {
                width: 32px;
                height: 32px;
                padding: 0;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .modal-header {
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                border-bottom: 1px solid #dee2e6;
            }

            .modal-footer {
                background: #f8f9fa;
                border-top: 1px solid #dee2e6;
            }

            .search-input:focus {
                box-shadow: none;
                border-color: #5e72e4;
            }

            .table td,
            .table th {
                padding: 1rem 0.5rem;
                vertical-align: middle;
            }

            .badge.bg-gradient-dark {
                background: linear-gradient(135deg, #32325d 0%, #212529 100%);
                font-size: 11px;
                font-weight: 500;
            }
        </style>
    @endpush
@endsection
