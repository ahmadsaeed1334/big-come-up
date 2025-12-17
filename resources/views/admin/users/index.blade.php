@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Users</h3>
            <small class="text-muted">Manage users, roles & status</small>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            + Add User
        </a>
    </div>

    {{-- Filters --}}
    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2" method="GET" action="{{ route('admin.users.index') }}">
                <div class="col-12 col-md-3">
                    <input type="text" name="q" class="form-control" placeholder="Search name/email"
                        value="{{ request('q') }}">
                </div>

                <div class="col-12 col-md-3">
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
                    <select name="user_type" class="form-select">
                        <option value="">All Types</option>
                        @foreach ($types as $id => $label)
                            <option value="{{ $id }}" @selected((string) request('user_type') === (string) $id)>
                                {{ $label }}
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

                <div class="col-12 col-md-1">
                    <button class="btn btn-outline-secondary w-100">Go</button>
                </div>
                <div class="col-12 col-md-1">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light w-100">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Role</th>
                        <th>User Type</th>
                        <th>Status</th>
                        <th class="text-end" style="width:240px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $u)
                        @php
                            $roleName = $u->getRoleNames()->first() ?? ($u->role ?? '—');
                            $typeLabel = $types[$u->user_type] ?? '—';
                            $statusBadge = $u->is_active ? 'success' : 'danger';
                        @endphp
                        <tr>
                            <td>{{ $users->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-semibold">{{ $u->name }}</div>
                                <div class="small text-muted">{{ $u->email }}</div>
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $roleName }}</span></td>
                            <td><span class="badge bg-light text-dark border">{{ $typeLabel }}</span></td>
                            <td>
                                <span class="badge bg-{{ $statusBadge }}">
                                    {{ $u->is_active ? 'Active' : 'Suspended' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-sm btn-outline-primary">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('admin.users.toggle', $u) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-outline-{{ $u->is_active ? 'warning' : 'success' }}">
                                        {{ $u->is_active ? 'Suspend' : 'Activate' }}
                                    </button>
                                </form>

                                <x-delete-form :action="route('admin.users.destroy', $u)" text="Delete this user?" buttonLabel="Delete" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $users->links() }}
    </div>
@endsection
