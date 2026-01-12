@extends('layouts.app')

@section('content')
    <style>
        /* Search box styling */
        .search-container {
            position: relative;
            width: 100%;
        }

        .search-input {
            padding-left: 40px;
            height: 40px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
        }

        /*
                .search-icon {
                    position: absolute;
                    left: 12px;
                    top: 50%;
                    transform: translateY(-50%);
                    color: #6c757d;
                    z-index: 10;
                } */

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

        /* Permission badge styling */
        .permission-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .guard-badge {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        /* Table styling */
        .table> :not(caption)>*>* {
            padding: 1rem 1.5rem;
        }

        .avatar-sm {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* .action-btn {
                            padding: 0.25rem 0.5rem;
                            font-size: 0.875rem;
                        } */

        /* Modal styling */
        .modal-header {
            border-bottom: 1px solid #e9ecef;
        }

        .modal-footer {
            border-top: 1px solid #e9ecef;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Permissions Management</h6>
                            <p class="text-sm mb-0 text-muted">Spatie permissions management</p>
                        </div>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createPermissionModal">
                            <i class="fas fa-plus me-1"></i> Add Permission
                        </button>
                    </div>

                    <!-- Search Form -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <form action="{{ route('admin.permissions.index') }}" method="GET" class="mb-0">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="search-container">
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-search search-icon"></i>
                                                </span>
                                                <input type="text" name="search" class="form-control search-input"
                                                    placeholder="Search permissions by name..."
                                                    value="{{ request('search') }}" autocomplete="off">
                                            </div>
                                            @if (request('search'))
                                                <a href="{{ route('admin.permissions.index') }}" class="clear-search">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <select name="guard" class="form-select">
                                            <option value="">All Guards</option>
                                            <option value="web" {{ request('guard') == 'web' ? 'selected' : '' }}>Web
                                                Guard</option>
                                            <option value="api" {{ request('guard') == 'api' ? 'selected' : '' }}>API
                                                Guard</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn bg-gradient-primary mb-0">
                                                <i class="fas fa-search search-icon"></i> Search
                                            </button>
                                            @if (request()->hasAny(['search', 'guard']))
                                                <a href="{{ route('admin.permissions.index') }}"
                                                    class="btn bg-gradient-secondary mb-0">
                                                    <i class="ni ni-fat-remove"></i> Reset
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Search Results Info -->
                    @if (request()->hasAny(['search', 'guard']))
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="alert alert-light py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            @if (request('search'))
                                                <span class="text-sm">Search:
                                                    <strong>"{{ request('search') }}"</strong></span>
                                            @endif
                                            @if (request('guard'))
                                                <span class="text-sm ms-3">Guard:
                                                    <span class="badge bg-gradient-info">{{ request('guard') }}</span>
                                                </span>
                                            @endif
                                            <span class="text-sm ms-3">Found: <strong>{{ $permissions->total() }}
                                                    permissions</strong></span>
                                        </div>
                                        @if (request()->hasAny(['search', 'guard']))
                                            <a href="{{ route('admin.permissions.index') }}"
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
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive p-0">
                        @if ($permissions->count() > 0)
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">
                                            #
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Permission Name
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Guard Name
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created At
                                        </th>
                                        <th
                                            class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 pe-4">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($permissions as $index => $permission)
                                        <tr>
                                            <td class="text-sm ps-4">
                                                {{ ($permissions->currentPage() - 1) * $permissions->perPage() + $index + 1 }}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        <div class="bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center"
                                                            style="width: 36px; height: 36px;">
                                                            <i class="fas fa-shield-alt text-white"></i>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 text-sm">{{ $permission->name }}</h6>
                                                        <small class="text-muted">
                                                            @php
                                                                $parts = explode(' ', $permission->name);
                                                                $category = $parts[0] ?? 'general';
                                                            @endphp
                                                            {{ ucfirst($category) }} permission
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm bg-gradient-info">
                                                    {{ $permission->guard_name }}
                                                </span>
                                            </td>
                                            <td>
                                                <p class="text-xs mb-0">{{ $permission->created_at->format('M d, Y') }}</p>
                                                <small
                                                    class="text-muted">{{ $permission->created_at->format('h:i A') }}</small>
                                            </td>
                                            <td class="align-middle text-end pe-4">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <!-- Edit Button -->
                                                    <button type="button" class="btn btn-sm btn-outline-primary action-btn"
                                                        data-bs-toggle="modal" data-bs-target="#editPermissionModal"
                                                        data-id="{{ $permission->id }}"
                                                        data-name="{{ $permission->name }}"
                                                        data-guard="{{ $permission->guard_name }}" title="Edit Permission">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <!-- Delete Button -->
                                                    <button type="button" class="btn btn-sm btn-outline-danger action-btn"
                                                        onclick="confirmPermissionDelete({{ $permission->id }})"
                                                        title="Delete Permission">
                                                        <i class="fas fa-trash"></i>
                                                    </button>

                                                    <form id="delete-permission-{{ $permission->id }}"
                                                        action="{{ route('admin.permissions.destroy', $permission->id) }}"
                                                        method="POST" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center py-5">
                                <div class="bg-gradient-primary bg-gradient-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 80px; height: 80px;">
                                    <i class="fas fa-shield-alt fa-2x text-white"></i>
                                </div>
                                <h6 class="text-muted">
                                    @if (request()->hasAny(['search', 'guard']))
                                        No permissions found matching your criteria.
                                    @else
                                        No permissions found.
                                    @endif
                                </h6>
                                <p class="text-muted mb-3">Start by adding your first permission</p>
                                @if (request()->hasAny(['search', 'guard']))
                                    <a href="{{ route('admin.permissions.index') }}"
                                        class="btn btn-sm btn-outline-primary mt-2">
                                        <i class="fas fa-times me-1"></i> Clear Search
                                    </a>
                                @endif
                                <button class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal"
                                    data-bs-target="#createPermissionModal">
                                    <i class="fas fa-plus me-1"></i> Add Permission
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- Pagination -->

                    @include('admin.partials.pagination', ['items' => $permissions])
                </div>
            </div>
        </div>
    </div>

    {{-- CREATE PERMISSION MODAL --}}
    <div class="modal fade" id="createPermissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('admin.permissions.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-plus-circle me-2"></i> Create Permission
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Permission Name *</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-shield-alt"></i>
                            </span>
                            <input type="text" name="name" class="form-control" placeholder="e.g. manage users"
                                value="{{ old('name') }}" required>
                        </div>
                        <small class="text-muted mt-1 d-block">
                            Use lowercase with dots or spaces (e.g., "manage.users" or "manage users")
                        </small>
                    </div>

                    <div class="mb-0">
                        <label class="form-label">Guard Name</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <select name="guard_name" class="form-select">
                                <option value="web" {{ old('guard_name', 'web') == 'web' ? 'selected' : '' }}>Web
                                </option>
                                <option value="api" {{ old('guard_name') == 'api' ? 'selected' : '' }}>API</option>
                            </select>
                        </div>
                        <small class="text-muted mt-1 d-block">
                            Default guard is "web" for web applications
                        </small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Create Permission
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- EDIT PERMISSION MODAL --}}
    <div class="modal fade" id="editPermissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" id="editPermissionForm">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-edit me-2"></i> Edit Permission
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Permission Name *</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-shield-alt"></i>
                            </span>
                            <input type="text" name="name" id="edit-permission-name" class="form-control"
                                required>
                        </div>
                        <small class="text-muted mt-1 d-block">
                            Use lowercase with dots or spaces
                        </small>
                    </div>

                    <div class="mb-0">
                        <label class="form-label">Guard Name</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <select name="guard_name" id="edit-permission-guard" class="form-select">
                                <option value="web">Web</option>
                                <option value="api">API</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update Permission
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmPermissionDelete(permissionId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This permission will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#8392ab',
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-permission-' + permissionId).submit();
                    }
                });
            }

            // Edit Modal Handler
            document.addEventListener('DOMContentLoaded', function() {
                const editModal = document.getElementById('editPermissionModal');
                const editForm = document.getElementById('editPermissionForm');

                editModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;

                    const id = button.getAttribute('data-id');
                    const name = button.getAttribute('data-name');
                    const guard = button.getAttribute('data-guard');

                    // Set form action
                    editForm.action = `{{ url('admin/permissions') }}/${id}`;

                    // Set form values
                    document.getElementById('edit-permission-name').value = name;
                    document.getElementById('edit-permission-guard').value = guard;
                });

                // Auto-submit search form when typing stops
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

                // Auto-submit on guard select change
                const guardSelect = document.querySelector('select[name="guard"]');
                if (guardSelect) {
                    guardSelect.addEventListener('change', function() {
                        this.form.submit();
                    });
                }

                // Enter key to submit search
                if (searchInput) {
                    searchInput.addEventListener('keypress', function(e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            this.form.submit();
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
