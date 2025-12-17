@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Roles</h3>
            <small class="text-muted">Assign permissions to roles</small>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary">
                Permissions
            </a>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoleModal">
                + Add Role
            </button>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-3">
        @forelse ($roles as $role)
            @php
                $perms = $role->permissions->pluck('name')->values();
                $preview = $perms->take(4);
                $remaining = $perms->count() - $preview->count();
            @endphp

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="mb-1">{{ $role->name }}</h5>
                                <span class="badge bg-secondary">{{ $role->guard_name }}</span>
                            </div>

                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                    ⋮
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editRoleModal"
                                            data-id="{{ $role->id }}" data-name="{{ $role->name }}"
                                            data-guard="{{ $role->guard_name }}"
                                            data-permissions='@json($role->permissions->pluck('name'))'>
                                            Edit
                                        </button>
                                    </li>
                                    <li>
                                        <x-delete-form :action="route('admin.roles.destroy', $role)" text="Delete this role?" buttonLabel="Delete"
                                            buttonClass="dropdown-item text-danger" />

                                    </li>
                                </ul>
                            </div>
                        </div>

                        <hr>

                        <div class="mb-2">
                            <div class="small text-muted mb-2">Permissions</div>

                            @if ($perms->isEmpty())
                                <span class="text-muted small">No permissions assigned</span>
                            @else
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach ($preview as $p)
                                        <span class="badge text-bg-light border">{{ $p }}</span>
                                    @endforeach

                                    @if ($remaining > 0)
                                        <span class="badge text-bg-dark">
                                            +{{ $remaining }} more
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#editRoleModal" data-id="{{ $role->id }}"
                                data-name="{{ $role->name }}" data-guard="{{ $role->guard_name }}"
                                data-permissions='@json($role->permissions->pluck('name'))'>
                                Manage Permissions
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light border">
                    No roles found.
                </div>
            </div>
        @endforelse
    </div>

    {{-- =========================
    CREATE ROLE MODAL
========================= --}}
    <div class="modal fade" id="createRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" method="POST" action="{{ route('admin.roles.store') }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Create Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label">Role Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. admin" required>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label">Guard Name</label>
                            <input type="text" name="guard_name" class="form-control" value="web">
                        </div>
                    </div>

                    <hr>

                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label mb-0">Assign Permissions</label>
                            <span class="small text-muted">{{ $permissions->count() }} available</span>
                        </div>

                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="{{ $permission->name }}" id="cperm-{{ $permission->id }}">
                                        <label class="form-check-label" for="cperm-{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    {{-- =========================
    EDIT ROLE MODAL
========================= --}}
    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" method="POST" id="editRoleForm">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label">Role Name</label>
                            <input type="text" name="name" id="edit-role-name" class="form-control" required>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label">Guard Name</label>
                            <input type="text" name="guard_name" id="edit-role-guard" class="form-control">
                        </div>
                    </div>

                    <hr>

                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label mb-0">Assign Permissions</label>
                            <span class="small text-muted">{{ $permissions->count() }} available</span>
                        </div>

                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-check">
                                        <input class="form-check-input edit-perm-checkbox" type="checkbox"
                                            name="permissions[]" value="{{ $permission->name }}"
                                            id="eperm-{{ $permission->id }}">
                                        <label class="form-check-label" for="eperm-{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editModal = document.getElementById('editRoleModal');
            const editForm = document.getElementById('editRoleForm');
            const permChecks = () => document.querySelectorAll('.edit-perm-checkbox');

            editModal.addEventListener('show.bs.modal', (event) => {
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

                editForm.action = `{{ url('/admin/roles') }}/${id}`;

                document.getElementById('edit-role-name').value = name;
                document.getElementById('edit-role-guard').value = guard;

                // reset all
                permChecks().forEach(cb => cb.checked = false);

                // check assigned
                permChecks().forEach(cb => {
                    if (perms.includes(cb.value)) cb.checked = true;
                });
            });
        });
    </script>
@endsection
