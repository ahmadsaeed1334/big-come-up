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

        /* Role card styling */
        .role-card {
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
        }

        .role-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .role-header {
            padding: 1rem 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .role-body {
            padding: 1.5rem;
        }

        .role-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            background: rgba(0, 0, 0, 0.02);
        }

        /* Role color indicators */
        .role-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .role-admin {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .role-editor {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .role-viewer {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }

        .role-user {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
        }

        .role-default {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #495057;
        }

        /* Badge styling */
        .guard-badge {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            font-size: 0.75rem;
        }

        .permission-badge {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #495057;
            font-size: 0.7rem;
            padding: 4px 10px;
            border-radius: 20px;
            margin: 2px;
            display: inline-block;
        }

        /* Stats styling */
        .stat-item {
            display: flex;
            align-items: center;
            margin-right: 15px;
        }

        .stat-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            background: rgba(0, 0, 0, 0.05);
        }

        .stat-label {
            font-size: 0.75rem;
            color: #6c757d;
        }

        .stat-value {
            font-weight: 600;
            color: #495057;
        }

        /* Action buttons */
        .action-btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 6px;
            transition: all 0.2s;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 2rem;
        }

        /* Permission chips */
        .permission-chip {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            margin: 2px;
            background: #f8f9fa;
            border-radius: 20px;
            font-size: 0.75rem;
            color: #495057;
            border: 1px solid #dee2e6;
        }

        .permission-chip i {
            margin-right: 5px;
            color: #6c757d;
        }

        /* Bootstrap 5 Custom Checkbox Styling */
        .form-check-input {
            width: 1.2em !important;
            height: 1.2em !important;
            margin-top: 0.15em !important;
            vertical-align: top !important;
            background-color: #fff !important;
            background-repeat: no-repeat !important;
            background-position: center !important;
            background-size: contain !important;
            border: 2px solid #adb5bd !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            appearance: none !important;
            -webkit-print-color-adjust: exact !important;
            color-adjust: exact !important;
            print-color-adjust: exact !important;
            border-radius: 0.25em !important;
        }

        .form-check-input[type="checkbox"] {
            border-radius: 0.25em !important;
        }

        .form-check-input[type="checkbox"]:checked {
            background-color: #4e73df !important;
            border-color: #4e73df !important;
        }

        .form-check-input[type="checkbox"]:checked[type="checkbox"] {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e") !important;
        }

        .form-check-input:focus {
            border-color: #86b7fe !important;
            outline: 0 !important;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
        }

        .form-check-input:checked:focus {
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.5) !important;
        }

        .form-check-input:indeterminate {
            background-color: #4e73df !important;
            border-color: #4e73df !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10h8'/%3e%3c/svg%3e") !important;
        }

        /* Make sure checkboxes are visible in modals */
        .modal-body .form-check {
            padding-left: 0 !important;
        }

        .modal-body .form-check-input {
            flex-shrink: 0 !important;
        }

        /* Label styling */
        .form-check-label {
            margin-left: 8px;
            cursor: pointer;
            user-select: none;
            font-size: 0.9rem;
            color: #495057;
        }

        /* Container for checkboxes in modals */
        .permission-list {
            max-height: 300px;
            overflow-y: auto;
            padding: 15px !important;
            border: 1px solid #dee2e6 !important;
            border-radius: 6px !important;
        }

        .permission-list .form-check {
            /* margin-bottom: 8px !important;
                        padding: 8px 12px !important; */
            border-radius: 6px !important;
            transition: all 0.2s ease !important;
        }

        .permission-list .form-check:hover {
            background-color: rgba(78, 115, 223, 0.05) !important;
            transform: translateX(2px) !important;
        }

        /* Badge styling inside checkboxes */
        .form-check-label .badge {
            font-size: 0.7rem;
            padding: 0.25em 0.5em;
            margin-right: 8px;
        }

        /* Select All checkbox styling */
        #selectAllPermissions,
        #editSelectAllPermissions {
            margin-left: 0 !important;
            margin-right: 8px !important;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Roles Management</h6>
                            <p class="text-sm mb-0 text-muted">Assign permissions to roles</p>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('admin.permissions.index') }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-shield-alt me-1"></i> Permissions
                            </a>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createRoleModal">
                                <i class="fas fa-plus me-1"></i> Add Role
                            </button>
                        </div>
                    </div>

                    <!-- Search Form -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <form action="{{ route('admin.roles.index') }}" method="GET" class="mb-0">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="search-container">
                                            <i class="fas fa-search search-icon"></i>
                                            <input type="text" name="search" class="form-control search-input"
                                                placeholder="Search roles by name..." value="{{ request('search') }}"
                                                autocomplete="off">
                                            @if (request('search'))
                                                <a href="{{ route('admin.roles.index') }}" class="clear-search">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
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
                                            {{-- <button type="submit" class="btn bg-gradient-primary mb-0">
                                                <i class="ni ni-zoom-split-in"></i> Search
                                            </button> --}}
                                            @if (request()->hasAny(['search', 'guard']))
                                                <a href="{{ route('admin.roles.index') }}"
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
                                            <span class="text-sm ms-3">Found: <strong>{{ $roles->total() }}
                                                    roles</strong></span>
                                        </div>
                                        @if (request()->hasAny(['search', 'guard']))
                                            <a href="{{ route('admin.roles.index') }}"
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

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($roles->count() > 0)
                        <div class="row g-4">
                            @foreach ($roles as $role)
                                @php
                                    $roleClass = 'role-default';
                                    if (str_contains(strtolower($role->name), 'admin')) {
                                        $roleClass = 'role-admin';
                                    } elseif (str_contains(strtolower($role->name), 'editor')) {
                                        $roleClass = 'role-editor';
                                    } elseif (str_contains(strtolower($role->name), 'view')) {
                                        $roleClass = 'role-viewer';
                                    } elseif (str_contains(strtolower($role->name), 'user')) {
                                        $roleClass = 'role-user';
                                    }
                                @endphp

                                <div class="col-xl-4 col-lg-6 col-md-6">
                                    <div class="card role-card shadow-sm">
                                        <div class="role-header">
                                            <div class="d-flex align-items-center">
                                                <div class="role-icon {{ $roleClass }}">
                                                    <i class="fas fa-user-shield"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1">{{ $role->name }}</h5>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-gradient-info me-2">
                                                            {{ $role->guard_name }}
                                                        </span>
                                                        <span class="text-sm text-muted">
                                                            Created {{ $role->created_at->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="role-body">
                                            <!-- Stats -->
                                            <div class="d-flex mb-3">
                                                <div class="stat-item">
                                                    <div class="stat-icon">
                                                        <i class="fas fa-users text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <div class="stat-label">Users</div>
                                                        <div class="stat-value">{{ $role->users_count ?? 0 }}</div>
                                                    </div>
                                                </div>
                                                <div class="stat-item">
                                                    <div class="stat-icon">
                                                        <i class="fas fa-shield-alt text-success"></i>
                                                    </div>
                                                    <div>
                                                        <div class="stat-label">Permissions</div>
                                                        <div class="stat-value">{{ $role->permissions->count() }}</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Permissions Preview -->
                                            <div>
                                                <h6 class="text-sm mb-2">Permissions:</h6>
                                                <div class="d-flex flex-wrap">
                                                    @foreach ($role->permissions->take(5) as $permission)
                                                        <span class="permission-chip" title="{{ $permission->name }}">
                                                            <i class="fas fa-check-circle"></i>
                                                            {{ Str::limit($permission->name, 12) }}
                                                        </span>
                                                    @endforeach
                                                    @if ($role->permissions->count() > 5)
                                                        <span class="permission-chip bg-gradient-info text-primary">
                                                            +{{ $role->permissions->count() - 5 }} more
                                                        </span>
                                                    @endif
                                                    @if ($role->permissions->count() === 0)
                                                        <span class="text-muted text-sm">No permissions assigned</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="role-footer">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <button type="button" class="btn btn-sm btn-outline-info action-btn"
                                                        data-bs-toggle="modal" data-bs-target="#viewPermissionsModal"
                                                        data-name="{{ $role->name }}"
                                                        data-permissions='@json($role->permissions->pluck('name'))'
                                                        title="View Permissions">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <!-- Edit Button -->
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-primary action-btn"
                                                        data-bs-toggle="modal" data-bs-target="#editRoleModal"
                                                        data-id="{{ $role->id }}" data-name="{{ $role->name }}"
                                                        data-guard="{{ $role->guard_name }}"
                                                        data-permissions='@json($role->permissions->pluck('id'))' title="Edit Role">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <!-- Delete Button -->
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger action-btn"
                                                        onclick="confirmRoleDelete({{ $role->id }}, '{{ $role->name }}')"
                                                        title="Delete Role">
                                                        <i class="fas fa-trash"></i>
                                                    </button>

                                                    <form id="delete-role-{{ $role->id }}"
                                                        action="{{ route('admin.roles.destroy', $role->id) }}"
                                                        method="POST" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if ($roles->hasPages())
                            <div class="mt-4">
                                {{ $roles->withQueryString()->links() }}
                            </div>
                        @endif
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <h5 class="mb-2">
                                @if (request()->hasAny(['search', 'guard']))
                                    No roles found matching your criteria.
                                @else
                                    No roles found
                                @endif
                            </h5>
                            <p class="text-muted mb-4">Start by adding your first role</p>
                            <div class="d-flex justify-content-center gap-2">
                                @if (request()->hasAny(['search', 'guard']))
                                    <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-primary">
                                        <i class="fas fa-times me-1"></i> Clear Search
                                    </a>
                                @endif
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoleModal">
                                    <i class="fas fa-plus me-1"></i> Add Role
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- CREATE ROLE MODAL --}}
    <div class="modal fade" id="createRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" method="POST" action="{{ route('admin.roles.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-plus-circle me-2"></i> Create Role
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Role Name *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user-tag"></i>
                                </span>
                                <input type="text" name="name" class="form-control"
                                    placeholder="e.g. admin, editor, viewer" value="{{ old('name') }}" required>
                            </div>
                            <small class="text-muted mt-1 d-block">
                                Use lowercase with no spaces (e.g., "admin", "content-editor")
                            </small>
                        </div>

                        <div class="col-md-6">
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

                    <hr>

                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">
                                <i class="fas fa-shield-alt me-2"></i> Assign Permissions
                            </h6>
                            <span class="badge bg-gradient-info">{{ $permissions->count() }} available</span>
                        </div>

                        <div class="permission-list"
                            style="max-height: 300px; overflow-y: auto; padding: 15px; border: 1px solid #dee2e6; border-radius: 6px;">
                            <div class="row">
                                @foreach ($permissions as $permission)
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permissions[]"
                                                value="{{ $permission->name }}" id="cperm-{{ $permission->id }}">
                                            <label class="form-check-label d-flex align-items-center"
                                                for="cperm-{{ $permission->id }}">
                                                <span
                                                    class="badge bg-gradient-warning me-2">{{ $permission->guard_name }}</span>
                                                <span>{{ $permission->name }}</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAllPermissions">
                                <label class="form-check-label" for="selectAllPermissions">
                                    Select All Permissions
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Create Role
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- EDIT ROLE MODAL --}}
    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" method="POST" id="editRoleForm">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-edit me-2"></i> Edit Role
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Role Name *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user-tag"></i>
                                </span>
                                <input type="text" name="name" id="edit-role-name" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Guard Name</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <select name="guard_name" id="edit-role-guard" class="form-select">
                                    <option value="web">Web</option>
                                    <option value="api">API</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">
                                <i class="fas fa-shield-alt me-2"></i> Assign Permissions
                            </h6>
                            <span class="badge bg-gradient-info">{{ $permissions->count() }} available</span>
                        </div>

                        <div class="permission-list"
                            style="max-height: 300px; overflow-y: auto; padding: 15px; border: 1px solid #dee2e6; border-radius: 6px;">
                            <div class="row">
                                @foreach ($permissions as $permission)
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input edit-perm-checkbox ms-1 me-1" type="checkbox"
                                                name="permissions[]" value="{{ $permission->name }}"
                                                id="eperm-{{ $permission->id }}">
                                            <label class="form-check-label d-flex align-items-center"
                                                for="eperm-{{ $permission->id }}">
                                                <span
                                                    class="badge bg-gradient-warning me-2">{{ $permission->guard_name }}</span>
                                                <span>{{ $permission->name }}</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="editSelectAllPermissions">
                                <label class="form-check-label" for="editSelectAllPermissions">
                                    Select All Permissions
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update Role
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- VIEW PERMISSIONS MODAL --}}
    <div class="modal fade" id="viewPermissionsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-shield-alt me-2"></i> Role Permissions
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h6 id="view-role-name" class="mb-3"></h6>
                    <div id="view-permissions-list" class="permission-list"
                        style="max-height: 300px; overflow-y: auto; padding: 15px; border: 1px solid #dee2e6; border-radius: 6px;">
                        <!-- Permissions will be loaded here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmRoleDelete(roleId, roleName) {
                Swal.fire({
                    title: 'Are you sure?',
                    html: `You are about to delete the role <strong>"${roleName}"</strong>. This action cannot be undone.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#8392ab',
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-role-' + roleId).submit();
                    }
                });
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Edit Modal Handler
                const editModal = document.getElementById('editRoleModal');
                const editForm = document.getElementById('editRoleForm');

                editModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;

                    const id = button.getAttribute('data-id');
                    const name = button.getAttribute('data-name');
                    const guard = button.getAttribute('data-guard');
                    const permsRaw = button.getAttribute('data-permissions');

                    let perms = [];
                    try {
                        perms = JSON.parse(permsRaw) || [];
                    } catch (e) {
                        perms = [];
                    }

                    // Set form action
                    editForm.action = `{{ url('admin/roles') }}/${id}`;

                    // Set form values
                    document.getElementById('edit-role-name').value = name;
                    document.getElementById('edit-role-guard').value = guard;

                    // Reset all checkboxes
                    document.querySelectorAll('.edit-perm-checkbox').forEach(cb => {
                        cb.checked = false;
                    });

                    // Check assigned permissions
                    perms.forEach(permId => {
                        const checkbox = document.getElementById(`eperm-${permId}`);
                        if (checkbox) checkbox.checked = true;
                    });

                    // Update select all checkbox
                    updateSelectAllCheckbox('editSelectAllPermissions', '.edit-perm-checkbox');
                });

                // View Permissions Modal
                const viewModal = document.getElementById('viewPermissionsModal');
                viewModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const roleName = button.getAttribute('data-name');
                    const permsRaw = button.getAttribute('data-permissions');

                    let perms = [];
                    try {
                        perms = JSON.parse(permsRaw) || [];
                    } catch (e) {
                        perms = [];
                    }

                    document.getElementById('view-role-name').textContent =
                        `${roleName} - ${perms.length} permissions`;

                    const permissionsList = document.getElementById('view-permissions-list');
                    permissionsList.innerHTML = '';

                    if (perms.length === 0) {
                        permissionsList.innerHTML =
                            '<p class="text-muted text-center py-3">No permissions assigned</p>';
                    } else {
                        perms.forEach(perm => {
                            const permItem = document.createElement('div');
                            permItem.className = 'permission-item mb-2 p-2 bg-light rounded';
                            permItem.innerHTML = `
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>${perm}</span>
                            </div>
                        `;
                            permissionsList.appendChild(permItem);
                        });
                    }
                });

                // Select All Permissions for Create Modal
                const selectAllCreate = document.getElementById('selectAllPermissions');
                if (selectAllCreate) {
                    selectAllCreate.addEventListener('change', function() {
                        document.querySelectorAll('input[name="permissions[]"]').forEach(cb => {
                            cb.checked = this.checked;
                        });
                    });
                }

                // Select All Permissions for Edit Modal
                const selectAllEdit = document.getElementById('editSelectAllPermissions');
                if (selectAllEdit) {
                    selectAllEdit.addEventListener('change', function() {
                        document.querySelectorAll('.edit-perm-checkbox').forEach(cb => {
                            cb.checked = this.checked;
                        });
                    });
                }

                // Update select all checkbox state
                function updateSelectAllCheckbox(selectAllId, checkboxClass) {
                    const selectAll = document.getElementById(selectAllId);
                    const checkboxes = document.querySelectorAll(checkboxClass);

                    if (selectAll && checkboxes.length > 0) {
                        const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                        const someChecked = Array.from(checkboxes).some(cb => cb.checked);

                        selectAll.checked = allChecked;
                        selectAll.indeterminate = someChecked && !allChecked;
                    }
                }

                // Auto-submit search form when typing stops
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
