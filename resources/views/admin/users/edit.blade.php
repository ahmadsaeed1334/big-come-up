@extends('layouts.app')

@section('title', 'Edit User - ' . $user->name)

@section('content')
    <div class="container-fluid px-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="m-0 font-weight-bold  ">Edit User</h6>
                            <p class="text-sm mb-0 text-muted">Update user information</p>
                        </div>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Users
                        </a>
                    </div>
                    <div class="card-body">
                        <!-- User Info Card -->
                        <div class="card mb-4 border-left-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="  mb-2">Current Information</h6>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="avatar me-3">
                                                @if ($user->avatar)
                                                    <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}"
                                                        class="rounded-circle"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width: 50px; height: 50px;">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <h5 class="mb-0">{{ $user->name }}</h5>
                                                <p class="text-muted mb-0">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex flex-wrap gap-2">
                                            <span class="badge bg-{{ $user->is_active ? 'success' : 'danger' }}">
                                                <i
                                                    class="fas fa-{{ $user->is_active ? 'check-circle' : 'times-circle' }} me-1"></i>
                                                {{ $user->is_active ? 'Active' : 'Suspended' }}
                                            </span>
                                            <span class="badge bg-info">
                                                <i class="fas fa-user-tag me-1"></i>
                                                {{ ucfirst($userRole) }}
                                            </span>
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-clock me-1"></i>
                                                Joined {{ $user->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Please fix the following errors:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="needs-validation"
                            novalidate>
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label   mb-1">Full Name <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                            <input type="text" name="name" class="form-control border-start-0"
                                                value="{{ old('name', $user->name) }}" placeholder="Enter full name"
                                                required>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide a valid name.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label   mb-1">Email Address <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <input type="email" name="email" class="form-control border-start-0"
                                                value="{{ old('email', $user->email) }}" placeholder="Enter email address"
                                                required>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide a valid email address.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label   mb-1">New Password (Optional)</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                            <input type="password" name="password" class="form-control border-start-0"
                                                placeholder="Leave blank to keep current password">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <div class="form-text text-muted">
                                            Leave empty if you don't want to change the password.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label   mb-1">Confirm Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                            <input type="password" name="password_confirmation"
                                                class="form-control border-start-0" placeholder="Confirm new password">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label   mb-1">Role <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-user-tag"></i>
                                            </span>
                                            <select name="role" class="form-select border-start-0" required>
                                                <option value="">Select a role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}"
                                                        {{ old('role', $userRole) == $role->name ? 'selected' : '' }}>
                                                        {{ ucfirst($role->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please select a role.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label   mb-1">Status</label>
                                        <div class="d-flex align-items-center">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    name="is_active" value="1" id="is_active"
                                                    {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                                                <label class="form-check-label ms-2" for="is_active">
                                                    Active User
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-text text-muted">
                                            Inactive users cannot login to the system.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-top">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-1"></i> Cancel
                                        </a>
                                        <button type="button" class="btn btn-outline-danger ms-2"
                                            onclick="confirmDelete()">
                                            <i class="fas fa-trash me-1"></i> Delete User
                                        </button>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Update User
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .input-group-text {
            background-color: #f8f9fc;
            border-right: 0;
        }

        .form-control.border-start-0 {
            border-left: 0;
        }

        .form-check-input:checked {
            background-color: #4e73df;
            border-color: #4e73df;
        }

        .form-check-input:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .avatar {
            width: 50px;
            height: 50px;
            flex-shrink: 0;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }

        .border-left-primary {
            border-left: 4px solid #4e73df !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    const password = document.querySelector('input[name="password"]').value;
                    const confirmPassword = document.querySelector(
                        'input[name="password_confirmation"]').value;

                    if (password && password !== confirmPassword) {
                        event.preventDefault();
                        event.stopPropagation();
                        alert('Passwords do not match!');
                        return false;
                    }

                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });

            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    const passwordInput = document.querySelector('input[name="password"]');
                    const icon = this.querySelector('i');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            }

            // Confirm delete
            window.confirmDelete = function() {
                Swal.fire({
                    title: 'Delete User?',
                    html: `<div class="text-start">
                            <p>Are you sure you want to delete <strong>"{{ $user->name }}"</strong>?</p>
                            <div class="alert alert-warning py-2 mb-3">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                This action will permanently delete the user account.
                            </div>
                            <p class="text-danger mb-0"><strong>This action cannot be undone!</strong></p>
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
                        const deleteForm = document.createElement('form');
                        deleteForm.method = 'POST';
                        deleteForm.action = '{{ route('admin.users.destroy', $user) }}';
                        deleteForm.style.display = 'none';

                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';

                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'DELETE';

                        deleteForm.appendChild(csrfToken);
                        deleteForm.appendChild(methodInput);
                        document.body.appendChild(deleteForm);
                        deleteForm.submit();
                    }
                });
            };
        });
    </script>
@endsection
