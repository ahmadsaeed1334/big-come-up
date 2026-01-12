@extends('layouts.app')

@section('content')
    <style>
        /* Search box styling - Same as Colors/Sizes */
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

        /* Image preview styles */
        .image-preview-container {
            position: relative;
            min-height: 150px;
        }

        .preview-image {
            max-width: 100%;
            object-fit: contain;
            border-radius: 8px;
        }

        .no-image-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #f8f9fa;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .artist-avatar {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            object-fit: cover;
        }

        .artist-avatar-placeholder {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .bio-text {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Artists</h3>
            {{-- <small class="text-muted">Manage artists information</small> --}}
        </div>
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createArtistModal">
            <i class="fas fa-plus me-1"></i>
            Add Artist
        </button>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Artists</h6>
                            <p class="text-sm mb-0 text-muted">Manage artists information</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <!-- Search Form -->
                            <form action="{{ route('admin.artists.index') }}" method="GET" class="mb-0">
                                <div class="search-container">
                                    <i class="fas fa-search search-icon"></i>
                                    <input type="text" name="search" class="form-control search-input"
                                        placeholder="Search artists by name or bio..." value="{{ request('search') }}"
                                        autocomplete="off">
                                    @if (request('search'))
                                        <a href="{{ route('admin.artists.index') }}" class="clear-search">
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
                                <a href="{{ route('admin.artists.index') }}" class="text-danger ms-2">
                                    <i class="fas fa-times me-1"></i> Clear search
                                </a>
                            </p>
                            <p class="text-sm text-muted mb-0">
                                Found {{ $artists->count() }} artist(s)
                            </p>
                        </div>
                    @endif

                    <div class="table-responsive p-0">
                        @if ($artists->count() > 0)
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">
                                            #
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Artist
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Bio
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
                                    @foreach ($artists as $index => $artist)
                                        <tr>
                                            <td class="text-sm ps-4">
                                                {{ $index + 1 }}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if ($artist->profile_image_url)
                                                        <img src="{{ $artist->profile_image_url }}"
                                                            class="artist-avatar me-3" alt="{{ $artist->name }}">
                                                    @else
                                                        <div class="artist-avatar-placeholder me-3">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $artist->name }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-xs text-secondary bio-text">
                                                    {{ $artist->bio }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="badge badge-sm bg-gradient-info">
                                                    {{ $artist->products_count ?? 0 }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-end pe-4">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <!-- View Button -->
                                                    <button type="button" class="btn btn-sm btn-outline-info action-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#viewArtistModal{{ $artist->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>

                                                    <!-- Edit Button -->
                                                    <button type="button" class="btn btn-sm btn-outline-primary action-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editArtistModal{{ $artist->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <!-- Delete Button -->
                                                    <button type="button" class="btn btn-sm btn-outline-danger action-btn"
                                                        onclick="confirmArtistDelete({{ $artist->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <form id="delete-artist-{{ $artist->id }}"
                                                        action="{{ route('admin.artists.destroy', $artist->id) }}"
                                                        method="POST" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- View Artist Modal -->
                                        <div class="modal fade" id="viewArtistModal{{ $artist->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Artist Details</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                @if ($artist->profile_image_url)
                                                                    <img src="{{ $artist->profile_image_url }}"
                                                                        alt="{{ $artist->name }}"
                                                                        class="img-fluid rounded mb-3"
                                                                        style="max-height: 300px; object-fit: cover;">
                                                                @else
                                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3"
                                                                        style="height: 300px;">
                                                                        <i class="fas fa-user fa-6x text-muted"></i>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-8">
                                                                <h4 class="mb-2">
                                                                    <i
                                                                        class="ni ni-single-02 me-2 text-primary"></i>{{ $artist->name }}
                                                                </h4>

                                                                <p class="mb-1">
                                                                    <i class="ni ni-align-left-2 me-1 text-secondary"></i>
                                                                    <strong>Bio:</strong>
                                                                </p>
                                                                <p class="text-muted">{{ $artist->bio }}</p>

                                                                <p>
                                                                    <i class="ni ni-box-2 me-1 text-info"></i>
                                                                    <strong>Total Products:</strong>
                                                                    <span
                                                                        class="badge bg-info">{{ $artist->products_count ?? 0 }}</span>
                                                                </p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Edit Artist Modal -->
                                        <div class="modal fade" id="editArtistModal{{ $artist->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('admin.artists.update', $artist->id) }}"
                                                        method="POST" enctype="multipart/form-data"
                                                        id="editForm{{ $artist->id }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Artist</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Name *</label>

                                                                <div class="input-group">
                                                                    <span class="input-group-text">
                                                                        <i class="ni ni-single-02"></i>
                                                                    </span>
                                                                    <input type="text" name="name"
                                                                        class="form-control border-start-0"
                                                                        value="{{ old('name', $artist->name) }}"
                                                                        placeholder="Enter artist name" required>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Bio *</label>

                                                                <div class="input-group">
                                                                    <span class="input-group-text">
                                                                        <i class="ni ni-align-left-2"></i>
                                                                    </span>
                                                                    <textarea name="bio" class="form-control border-start-0" rows="3" placeholder="Enter artist bio" required>{{ old('bio', $artist->bio) }}</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Profile Image</label>
                                                                <input type="file" name="image"
                                                                    class="form-control image-upload" accept="image/*"
                                                                    data-preview-id="editPreview{{ $artist->id }}"
                                                                    data-current-src="{{ $artist->profile_image_url }}">

                                                                <div class="mt-2">
                                                                    <small class="text-muted d-block mb-1">Image
                                                                        Preview:</small>
                                                                    <div class="image-preview-container">
                                                                        @if ($artist->profile_image_url)
                                                                            <img src="{{ $artist->profile_image_url }}"
                                                                                alt="Current Image"
                                                                                class="img-thumbnail preview-image"
                                                                                id="editPreview{{ $artist->id }}"
                                                                                style="max-height: 150px;">
                                                                        @else
                                                                            <img src="" alt="Preview"
                                                                                class="img-thumbnail preview-image d-none"
                                                                                id="editPreview{{ $artist->id }}"
                                                                                style="max-height: 150px;">
                                                                            <div
                                                                                class="no-image-placeholder text-center py-4 border rounded">
                                                                                <i
                                                                                    class="fas fa-image fa-3x text-muted mb-2"></i>
                                                                                <p class="text-muted mb-0">No image
                                                                                    selected</p>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <small class="text-muted">Leave empty to keep current
                                                                    image</small>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Update
                                                                Artist</button>
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
                                <i class="fas fa-paint-brush fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted">
                                    @if (request('search'))
                                        No artists found for "{{ request('search') }}"
                                    @else
                                        No artists found
                                    @endif
                                </h6>
                                @if (request('search'))
                                    <a href="{{ route('admin.artists.index') }}"
                                        class="btn btn-sm btn-outline-primary mt-2">
                                        Show all artists
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                    @include('admin.partials.pagination', ['items' => $artists])

                </div>
            </div>
        </div>
    </div>

    <!-- Create Artist Modal -->
    <div class="modal fade" id="createArtistModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.artists.store') }}" method="POST" enctype="multipart/form-data"
                    id="createForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Artist</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name *</label>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ni ni-single-02"></i>
                                </span>
                                <input type="text" name="name" class="form-control border-start-0"
                                    value="{{ old('name') }}" placeholder="Enter artist name" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bio *</label>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ni ni-align-left-2"></i>
                                </span>
                                <textarea name="bio" class="form-control border-start-0" rows="3" placeholder="Enter artist bio" required>{{ old('bio') }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Profile Image *</label>
                            <input type="file" name="image" class="form-control image-upload" accept="image/*"
                                required data-preview-id="createPreview">

                            <div class="mt-2">
                                <small class="text-muted d-block mb-1">Image Preview:</small>
                                <div class="image-preview-container">
                                    <img src="" alt="Preview" class="img-thumbnail preview-image d-none"
                                        id="createPreview" style="max-height: 150px;">
                                    <div class="no-image-placeholder text-center py-4 border rounded">
                                        <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                        <p class="text-muted mb-0">No image selected</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Artist</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmArtistDelete(artistId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This artist and all related products will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#8392ab',
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-artist-' + artistId).submit();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Function to handle image preview
            function handleImagePreview(input) {
                const previewId = input.getAttribute('data-preview-id');
                const previewElement = document.getElementById(previewId);
                const placeholder = input.closest('.mb-3').querySelector('.no-image-placeholder');
                const currentSrc = input.getAttribute('data-current-src');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewElement.src = e.target.result;
                        previewElement.classList.remove('d-none');
                        if (placeholder) placeholder.classList.add('d-none');
                    }

                    reader.readAsDataURL(input.files[0]);
                } else {
                    // If no file selected, show current image or hide preview
                    if (currentSrc) {
                        previewElement.src = currentSrc;
                        previewElement.classList.remove('d-none');
                        if (placeholder) placeholder.classList.add('d-none');
                    } else {
                        previewElement.classList.add('d-none');
                        if (placeholder) placeholder.classList.remove('d-none');
                    }
                }
            }

            // Attach event listener to all image upload inputs
            document.querySelectorAll('.image-upload').forEach(function(input) {
                input.addEventListener('change', function() {
                    handleImagePreview(this);
                });

                // Initialize preview with current image if exists
                const currentSrc = input.getAttribute('data-current-src');
                const previewId = input.getAttribute('data-preview-id');
                const previewElement = document.getElementById(previewId);
                const placeholder = input.closest('.mb-3').querySelector('.no-image-placeholder');

                if (currentSrc && previewElement) {
                    previewElement.src = currentSrc;
                    previewElement.classList.remove('d-none');
                    if (placeholder) placeholder.classList.add('d-none');
                }
            });

            // Reset create form when modal is closed
            const createModal = document.getElementById('createArtistModal');
            if (createModal) {
                createModal.addEventListener('hidden.bs.modal', function() {
                    const createForm = document.getElementById('createForm');
                    if (createForm) createForm.reset();

                    const createPreview = document.getElementById('createPreview');
                    const placeholder = createPreview?.closest('.mb-3')?.querySelector(
                        '.no-image-placeholder');

                    if (createPreview) {
                        createPreview.src = '';
                        createPreview.classList.add('d-none');
                    }
                    if (placeholder) placeholder.classList.remove('d-none');
                });
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
        });
    </script>
@endsection
