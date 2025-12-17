@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Permissions</h3>
            <small class="text-muted">Spatie permissions management</small>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPermissionModal">
            + Add Permission
        </button>
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

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 60px;">#</th>
                            <th>Name</th>
                            {{-- <th>Guard</th> --}}
                            <th style="width: 160px;" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permissions as $index => $permission)
                            <tr>
                                <td>{{ $permissions->firstItem() + $index }}</td>
                                <td class="fw-semibold">{{ $permission->name }}</td>
                                {{-- <td>
                                    <span class="badge bg-secondary">
                                        {{ $permission->guard_name }}
                                    </span>
                                </td> --}}
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#editPermissionModal" data-id="{{ $permission->id }}"
                                        data-name="{{ $permission->name }}" data-guard="{{ $permission->guard_name }}">
                                        Edit
                                    </button>

                                    <x-delete-form :action="route('admin.permissions.destroy', $permission)" text="Delete this permission?" buttonLabel="Delete" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    No permissions found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $permissions->links() }}
    </div>

    {{-- CREATE MODAL --}}
    <div class="modal fade" id="createPermissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('admin.permissions.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. manage users" required>
                    </div>

                    {{-- <div class="mb-0">
                        <label class="form-label">Guard Name</label>
                        <input type="text" name="guard_name" class="form-control" value="web">
                    </div> --}}
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    {{-- EDIT MODAL --}}
    <div class="modal fade" id="editPermissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" id="editPermissionForm">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" id="edit-name" class="form-control" required>
                    </div>

                    {{-- <div class="mb-0">
                        <label class="form-label">Guard Name</label>
                        <input type="text" name="guard_name" id="edit-guard" class="form-control">
                    </div> --}}
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
            const editModal = document.getElementById('editPermissionModal');
            const editForm = document.getElementById('editPermissionForm');

            editModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;

                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const guard = button.getAttribute('data-guard');

                editForm.action = `{{ url('/admin/permissions') }}/${id}`;

                document.getElementById('edit-name').value = name;
                document.getElementById('edit-guard').value = guard;
            });
        });
    </script>
@endsection
