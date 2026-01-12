@extends('layouts.app')

@section('content')
    <style>
        /* Search box styling - Same as other pages */
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

        /* Pagination styling */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            padding: 0 20px;
        }

        .page-info {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .category-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Artists Categories</h3>
        </div>
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
            <i class="fas fa-plus me-1"></i>
            Add Category
        </button>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Artists Categories</h6>
                            <p class="text-sm mb-0 text-muted">Manage product categories for artists</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <!-- Search Form -->
                            <form action="{{ route('admin.artists-categories.index') }}" method="GET" class="mb-0">
                                <div class="search-container">
                                    <i class="fas fa-search search-icon"></i>
                                    <input type="text" name="search" class="form-control search-input"
                                        placeholder="Search categories by name or slug..." value="{{ request('search') }}"
                                        autocomplete="off">
                                    @if (request('search'))
                                        <a href="{{ route('admin.artists-categories.index') }}" class="clear-search">
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
                                <a href="{{ route('admin.artists-categories.index') }}" class="text-danger ms-2">
                                    <i class="fas fa-times me-1"></i> Clear search
                                </a>
                            </p>
                            <p class="text-sm text-muted mb-0">
                                Showing {{ $categories->firstItem() ?? 0 }} - {{ $categories->lastItem() ?? 0 }} of
                                {{ $categories->total() }} category(s)
                            </p>
                        </div>
                    @endif

                    <div class="table-responsive p-0">
                        @if ($categories->count() > 0)
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">
                                            #
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Category
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Slug
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Products
                                        </th>
                                        <th
                                            class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 pe-4">
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
                                                    <div
                                                        class="icon-shape icon-shape-primary me-3 text-center rounded-circle">
                                                        <i class="fas fa-folder text-white"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $category->name }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <span class="badge badge-sm bg-gradient-dark">
                                                    {{ $category->slug }}
                                                </span>
                                            </td>

                                            <td class="align-middle text-center">
                                                <span class="badge badge-sm bg-gradient-info">
                                                    {{ $category->products_count ?? 0 }}
                                                </span>
                                            </td>

                                            <td class="align-middle text-end pe-4">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <button type="button" class="btn btn-sm btn-outline-primary action-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editCategoryModal{{ $category->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger action-btn"
                                                        onclick="confirmCategoryDelete({{ $category->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <form id="delete-category-{{ $category->id }}"
                                                        action="{{ route('admin.artists-categories.destroy', $category->id) }}"
                                                        method="POST" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Edit Category Modal -->
                                        <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form
                                                        action="{{ route('admin.artists-categories.update', $category->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Category</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Category Name *</label>

                                                                <div class="input-group">
                                                                    <span class="input-group-text">
                                                                        <i class="ni ni-tag"></i>
                                                                    </span>
                                                                    <input type="text" name="name"
                                                                        class="form-control border-start-0"
                                                                        value="{{ old('name', $category->name) }}"
                                                                        placeholder="Enter category name" required>
                                                                </div>

                                                                <small class="text-muted">
                                                                    <i class="ni ni-link-66 me-1"></i>
                                                                    Slug will be auto-generated from name
                                                                </small>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Update
                                                                Category</button>
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
                                <i class="fas fa-folder fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted">
                                    @if (request('search'))
                                        No categories found for "{{ request('search') }}"
                                    @else
                                        No categories found
                                    @endif
                                </h6>
                                @if (request('search'))
                                    <a href="{{ route('admin.artists-categories.index') }}"
                                        class="btn btn-sm btn-outline-primary mt-2">
                                        Show all categories
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>


                    @include('admin.partials.pagination', ['items' => $categories])
                </div>
            </div>
        </div>
    </div>

    <!-- Create Category Modal -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.artists-categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Category Name *</label>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ni ni-tag"></i>
                                </span>
                                <input type="text" name="name" class="form-control border-start-0"
                                    value="{{ old('name') }}" placeholder="Enter category name" required>
                            </div>

                            <small class="text-muted">
                                <i class="ni ni-link-66 me-1"></i>
                                Slug will be auto-generated from name
                            </small>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmCategoryDelete(categoryId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This category will be permanently deleted!",
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

        // Auto-submit search form when typing stops
        document.addEventListener('DOMContentLoaded', function() {
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

            // Auto-generate slug on name input
            const nameInputs = document.querySelectorAll('input[name="name"]');
            nameInputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value) {
                        // You can show a preview of the slug if needed
                        const slugPreview = this.nextElementSibling;
                        if (slugPreview && slugPreview.classList.contains('slug-preview')) {
                            const slug = this.value.toLowerCase()
                                .replace(/[^\w\s]/g, '')
                                .replace(/\s+/g, '-');
                            slugPreview.textContent = 'Slug: ' + slug;
                        }
                    }
                });
            });
        });
    </script>
@endsection
