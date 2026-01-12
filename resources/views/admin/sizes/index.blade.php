@extends('layouts.app')

@section('content')
    <style>
        /* Search box styling - Same as Colors */
        .search-container {
            position: relative;
            /* width: 300px; */
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

        .badge-size-code {
            min-width: 40px;
            text-align: center;
            font-weight: 600;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Sizes</h3>
        </div>
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createSizeModal">
            <i class="fas fa-plus me-1"></i>
            Add Size
        </button>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Sizes</h6>
                            <p class="text-sm mb-0 text-muted">Manage product sizes</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <!-- Search Form -->
                            <form action="{{ route('admin.sizes.index') }}" method="GET" class="mb-0">
                                <div class="search-container">
                                    <i class="fas fa-search search-icon"></i>
                                    <input type="text" name="search" class="form-control search-input"
                                        placeholder="Search sizes by name or code..." value="{{ request('search') }}"
                                        autocomplete="off">
                                    @if (request('search'))
                                        <a href="{{ route('admin.sizes.index') }}" class="clear-search">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <!-- Search Results Info -->
                    @if (request('search'))
                        <div class="px-4 pt-3">
                            <p class="text-sm text-muted mb-0">
                                Showing results for: <strong>"{{ request('search') }}"</strong>
                                <a href="{{ route('admin.sizes.index') }}" class="text-danger ms-2">
                                    <i class="fas fa-times me-1"></i> Clear search
                                </a>
                            </p>
                            <p class="text-sm text-muted mb-0">
                                Found {{ $sizes->count() }} size(s)
                            </p>
                        </div>
                    @endif

                    <div class="table-responsive p-0">
                        @if ($sizes->count() > 0)
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">
                                            #
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Code</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Products</th>
                                        <th
                                            class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 pe-4">
                                            Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($sizes as $index => $size)
                                        <tr>
                                            <td class="text-sm ps-4">
                                                {{ $index + 1 }}
                                            </td>
                                            <td>
                                                <span class="badge badge-sm bg-gradient-dark badge-size-code">
                                                    {{ $size->code }}
                                                </span>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-sm">
                                                    {{ $size->name }}
                                                </h6>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="badge badge-sm {{ $size->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                    {{ $size->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="badge badge-sm bg-gradient-info">
                                                    {{ $size->products_count ?? 0 }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-end pe-4">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <button type="button" class="btn btn-sm btn-outline-primary action-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editSizeModal{{ $size->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger action-btn"
                                                        onclick="confirmSizeDelete({{ $size->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <form id="delete-size-{{ $size->id }}"
                                                        action="{{ route('admin.sizes.destroy', $size->id) }}"
                                                        method="POST" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Edit Size Modal -->
                                        <div class="modal fade" id="editSizeModal{{ $size->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('admin.sizes.update', $size->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Size</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Size Name *</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-text-width"></i>
                                                                    </span>
                                                                    <input type="text" name="name"
                                                                        class="form-control"
                                                                        value="{{ old('name', $size->name) }}" required>

                                                                </div>
                                                                <small class="text-muted">e.g., Small, Medium, Large,
                                                                    Extra
                                                                    Large</small>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Size Code *</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-code"></i>
                                                                    </span>
                                                                    <input type="text" name="code"
                                                                        class="form-control"
                                                                        value="{{ old('code', $size->code) }}" required
                                                                        maxlength="10">

                                                                </div>
                                                                <small class="text-muted">e.g., S, M, L, XL, 38, 42,
                                                                    etc.</small>
                                                            </div>

                                                            <div class="mb-3 form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="is_active" value="1"
                                                                    id="isActive{{ $size->id }}"
                                                                    {{ $size->is_active ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="isActive{{ $size->id }}">
                                                                    Active
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Update
                                                                Size</button>
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
                                <i class="fas fa-ruler fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted">
                                    @if (request('search'))
                                        No sizes found for "{{ request('search') }}"
                                    @else
                                        No sizes found
                                    @endif
                                </h6>
                                @if (request('search'))
                                    <a href="{{ route('admin.sizes.index') }}"
                                        class="btn btn-sm btn-outline-primary mt-2">
                                        Show all sizes
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                    @include('admin.partials.pagination', ['items' => $sizes])

                </div>
            </div>
        </div>
    </div>

    <!-- Create Size Modal -->
    <div class="modal fade" id="createSizeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.sizes.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Size</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Size Name *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-text-width"></i>
                                </span>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                    required>

                            </div>
                            <small class="text-muted">e.g., Small, Medium, Large, Extra Large</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Size Code *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-code"></i>
                                </span>
                                <input type="text" name="code" class="form-control" value="{{ old('code') }}"
                                    required maxlength="10">

                            </div>
                            <small class="text-muted">e.g., S, M, L, XL, 38, 42, etc.</small>
                        </div>

                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                id="createIsActive" checked>
                            <label class="form-check-label" for="createIsActive">
                                Active
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Size</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmSizeDelete(sizeId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This size will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#8392ab',
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-size-' + sizeId).submit();
                }
            });
        }

        // Auto-uppercase for size code
        document.addEventListener('DOMContentLoaded', function() {
            const codeInputs = document.querySelectorAll('input[name="code"]');
            codeInputs.forEach(input => {
                input.addEventListener('input', function() {
                    this.value = this.value.toUpperCase();
                });
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
        });
    </script>
@endsection
