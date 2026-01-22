@extends('layouts.app')

@section('content')
    <style>
        .search-container {
            position: relative;
        }

        .search-input {
            padding-left: 40px;
            height: 40px;
            font-size: 0.875rem;
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
            color: white;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">Users</h3>

                    </div>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary mb-0">
                        <i class="fas fa-plus me-1"></i>
                        Add User
                    </a>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6 class="mb-0">Filters</h6>
                <p class="text-sm mb-0 text-muted">Filter users by different criteria</p>
            </div>
            <div class="card-body">
                <form class="row g-3" method="GET" action="{{ route('admin.users.index') }}">
                    <div class="col-12 col-md-4">
                        <div class="search-container">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" name="q" class="form-control search-input"
                                placeholder="Search name or email..." value="{{ request('q') }}">
                            @if (request('q'))
                                <a href="{{ route('admin.users.index') }}" class="clear-search">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 col-md-2">
                        <select name="role" class="form-select">
                            <option value="">All Roles</option>
                            @foreach ($roles as $r)
                                <option value="{{ $r->name }}" @selected(request('role') === $r->name)>
                                    {{ ucfirst($r->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-2">
                        <select name="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="active" @selected(request('status') === 'active')>Active</option>
                            <option value="suspended" @selected(request('status') === 'suspended')>Suspended</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-2">
                        <button class="btn btn-outline-secondary w-100 mb-0" type="submit">Filter</button>
                    </div>

                    {{-- Clear Filter Button - Only show when filters are active --}}
                    @if (request()->hasAny(['q', 'role', 'status']))
                        <div class="col-12 col-md-2">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-danger w-100 mb-0">
                                <i class="fas fa-times me-1"></i>
                                Clear Filters
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">Users List</h6>
                                <p class="text-sm mb-0 text-muted">
                                    @if (request()->hasAny(['q', 'role', 'status']))
                                        Showing filtered results
                                    @else
                                        Showing all users
                                    @endif
                                </p>
                            </div>
                            <div>
                                <span class="badge bg-gradient-info">
                                    Total: {{ $users->total() }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <!-- Search Results Info -->
                        @if (request()->hasAny(['q', 'role', 'status']))
                            <div class="px-4 pt-3">
                                <p class="text-sm text-muted mb-0">
                                    Showing results for:
                                    @if (request('q'))
                                        <strong class="text-dark">"{{ request('q') }}"</strong>
                                    @endif
                                    @if (request('role'))
                                        <span class="mx-2">•</span>
                                        <strong class="text-dark">Role: {{ ucfirst(request('role')) }}</strong>
                                    @endif
                                    @if (request('status'))
                                        <span class="mx-2">•</span>
                                        <strong class="text-dark">Status: {{ ucfirst(request('status')) }}</strong>
                                    @endif
                                    <a href="{{ route('admin.users.index') }}" class="text-danger ms-2">
                                        <i class="fas fa-times me-1"></i> Clear all
                                    </a>
                                </p>
                            </div>
                        @endif

                        @if ($users->count() > 0)
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">
                                                #
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                User
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Role
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status
                                            </th>
                                            <th
                                                class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 pe-4">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $index => $u)
                                            @php
                                                $roleName = $u->getRoleNames()->first() ?? ($u->role ?? '—');
                                                $statusBadge = $u->is_active ? 'success' : 'danger';
                                            @endphp
                                            <tr>
                                                <td class="text-sm ps-4">
                                                    {{ $users->firstItem() + $index }}
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h6 class="mb-0 text-sm">{{ $u->name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $u->email }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-sm bg-gradient-dark">
                                                        {{ $roleName }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="badge badge-sm bg-gradient-{{ $statusBadge }}">
                                                        {{ $u->is_active ? 'Active' : 'Suspended' }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-end pe-4">
                                                    <div class="d-flex justify-content-end gap-2">
                                                        <a href="{{ route('admin.users.edit', $u) }}"
                                                            class="btn btn-sm btn-outline-primary mb-0 action-btn">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form method="POST" action="{{ route('admin.users.toggle', $u) }}"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-{{ $u->is_active ? 'warning' : 'success' }} mb-0 action-btn">
                                                                @if ($u->is_active)
                                                                    <i class="fas fa-user-slash"></i>
                                                                @else
                                                                    <i class="fas fa-user-check"></i>
                                                                @endif
                                                            </button>
                                                        </form>

                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger mb-0 action-btn"
                                                            onclick="confirmUserDelete({{ $u->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <form id="delete-user-{{ $u->id }}"
                                                            action="{{ route('admin.users.destroy', $u) }}" method="POST"
                                                            style="display:none;">
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

                            <!-- Pagination -->
                            @include('admin.partials.pagination', ['items' => $users])
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted mb-2">
                                    @if (request()->hasAny(['q', 'role', 'status']))
                                        No users found matching your criteria
                                    @else
                                        No users found
                                    @endif
                                </h6>
                                @if (request()->hasAny(['q', 'role', 'status']))
                                    <a href="{{ route('admin.users.index') }}"
                                        class="btn btn-sm btn-outline-primary mt-2">
                                        Show all users
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmUserDelete(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This user will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#8392ab',
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-user-' + userId).submit();
                }
            });
        }

        // Auto-submit search form when typing stops
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="q"]');
            let searchTimeout;

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        this.form.submit();
                    }, 500);
                });
            }

            // Auto-submit filter changes
            const selectFilters = document.querySelectorAll('select[name="role"], select[name="status"]');
            selectFilters.forEach(select => {
                select.addEventListener('change', function() {
                    this.form.submit();
                });
            });
        });
    </script>
@endsection
