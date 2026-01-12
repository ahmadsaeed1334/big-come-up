@extends('layouts.app')

@section('title', 'Create User')

@section('content')
    <div class="container-fluid px-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="m-0 font-weight-bold text-primary">Create New User</h6>
                            <p class="text-sm mb-0 text-muted">Add a new user to the system</p>
                        </div>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Users
                        </a>
                    </div>
                    <div class="card-body">
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

                        <form method="POST" action="{{ route('admin.users.store') }}" class="needs-validation" novalidate>
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-primary mb-1">Full Name <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                            <input type="text" name="name" class="form-control border-start-0"
                                                value="{{ old('name') }}" placeholder="Enter full name" required>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide a valid name.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-primary mb-1">Email Address <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <input type="email" name="email" class="form-control border-start-0"
                                                value="{{ old('email') }}" placeholder="Enter email address" required>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide a valid email address.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-primary mb-1">Password <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                            <input type="password" name="password" class="form-control border-start-0"
                                                placeholder="Enter password" required>
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <div class="form-text text-muted">
                                            Minimum 8 characters with letters and numbers.
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide a password.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-primary mb-1">Confirm Password <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                            <input type="password" name="password_confirmation"
                                                class="form-control border-start-0" placeholder="Confirm password" required>
                                        </div>
                                        <div class="invalid-feedback">
                                            Passwords must match.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-primary mb-1">Role <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-user-tag"></i>
                                            </span>
                                            <select name="role" class="form-select border-start-0" required>
                                                <option value="">Select a role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}"
                                                        {{ old('role') == $role->name ? 'selected' : '' }}>
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
                                        <label class="form-label text-primary mb-1">Status</label>
                                        <div class="d-flex align-items-center">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    name="is_active" value="1" id="is_active"
                                                    {{ old('is_active', 1) ? 'checked' : '' }}>
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
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Create User
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

        .needs-validation .was-validated .form-control:invalid,
        .needs-validation .form-control.is-invalid {
            border-color: #dc3545;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
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

            // Password strength indicator
            const passwordInput = document.querySelector('input[name="password"]');
            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const password = this.value;
                    const strengthIndicator = document.getElementById('passwordStrength');

                    if (!strengthIndicator) {
                        // Create strength indicator if it doesn't exist
                        const indicator = document.createElement('div');
                        indicator.id = 'passwordStrength';
                        indicator.className = 'mt-2';
                        this.parentNode.parentNode.appendChild(indicator);
                    }

                    updatePasswordStrength(password, strengthIndicator);
                });
            }

            function updatePasswordStrength(password, indicator) {
                let strength = 0;
                let text = '';
                let color = 'danger';

                if (password.length >= 8) strength++;
                if (/[A-Z]/.test(password)) strength++;
                if (/[0-9]/.test(password)) strength++;
                if (/[^A-Za-z0-9]/.test(password)) strength++;

                switch (strength) {
                    case 0:
                        text = 'Very Weak';
                        color = 'danger';
                        break;
                    case 1:
                        text = 'Weak';
                        color = 'danger';
                        break;
                    case 2:
                        text = 'Fair';
                        color = 'warning';
                        break;
                    case 3:
                        text = 'Good';
                        color = 'info';
                        break;
                    case 4:
                        text = 'Strong';
                        color = 'success';
                        break;
                }

                indicator.innerHTML = `
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-${color}" role="progressbar" 
                             style="width: ${strength * 25}%"></div>
                    </div>
                    <small class="text-${color}">${text}</small>
                `;
            }
        });
    </script>
@endsection
