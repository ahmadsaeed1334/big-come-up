@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Artists</h3>
            <small class="text-muted">Manage artists information</small>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createArtistModal">
            <i class="fas fa-plus"></i> Add Artist
        </button>
    </div>

    <!-- Artists Table Card -->
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Artist</th>
                        <th>Bio</th>
                        <th>Products</th>
                        <th class="text-end" style="width:150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($artists as $index => $artist)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if ($artist->profile_image_url)
                                        <img src="{{ $artist->profile_image_url }}" alt="{{ $artist->name }}"
                                            class="rounded-circle me-3"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <i class="fas fa-user text-muted"></i>
                                        </div>
                                    @endif
                                    <div class="fw-semibold">{{ $artist->name }}</div>
                                </div>
                            </td>
                            <td>
                                <div class="small text-muted" style="max-width: 300px;">
                                    {{ Str::limit($artist->bio, 100) }}
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $artist->products_count ?? 0 }}</span>
                            </td>
                            <td class="text-end">
                                <!-- View Button -->
                                <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                    data-bs-target="#viewArtistModal{{ $artist->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <!-- Edit Button -->
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#editArtistModal{{ $artist->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.artists.destroy', $artist->id) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure? This will delete all products by this artist!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- View Artist Modal -->
                        <div class="modal fade" id="viewArtistModal{{ $artist->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Artist Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                @if ($artist->profile_image_url)
                                                    <img src="{{ $artist->profile_image_url }}" alt="{{ $artist->name }}"
                                                        class="img-fluid rounded mb-3" id="viewImage{{ $artist->id }}">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3"
                                                        style="height: 300px;">
                                                        <i class="fas fa-user fa-6x text-muted"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-8">
                                                <h4>{{ $artist->name }}</h4>
                                                <p><strong>Bio:</strong></p>
                                                <p>{{ $artist->bio }}</p>
                                                <p><strong>Total Products:</strong> {{ $artist->products_count ?? 0 }}</p>
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
                                    <form action="{{ route('admin.artists.update', $artist->id) }}" method="POST"
                                        enctype="multipart/form-data" id="editForm{{ $artist->id }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Artist</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Name *</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $artist->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Bio *</label>
                                                <textarea name="bio" class="form-control" rows="3" required>{{ $artist->bio }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Profile Image</label>
                                                <input type="file" name="image" class="form-control image-upload"
                                                    accept="image/*" data-preview-id="editPreview{{ $artist->id }}"
                                                    data-current-src="{{ $artist->profile_image_url }}">

                                                <div class="mt-2">
                                                    <small class="text-muted d-block mb-1">Image Preview:</small>
                                                    <div class="image-preview-container">
                                                        @if ($artist->profile_image_url)
                                                            <img src="{{ $artist->profile_image_url }}"
                                                                alt="Current Image" class="img-thumbnail preview-image"
                                                                id="editPreview{{ $artist->id }}"
                                                                style="max-height: 150px;">
                                                        @else
                                                            <img src="" alt="Preview"
                                                                class="img-thumbnail preview-image d-none"
                                                                id="editPreview{{ $artist->id }}"
                                                                style="max-height: 150px;">
                                                            <div
                                                                class="no-image-placeholder text-center py-4 border rounded">
                                                                <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                                                <p class="text-muted mb-0">No image selected</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <small class="text-muted">Leave empty to keep current image</small>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update Artist</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No artists found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bio *</label>
                            <textarea name="bio" class="form-control" rows="3" required></textarea>
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
@endsection

@push('scripts')
    <script>
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

            // Handle modal show events to initialize previews
            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(function(button) {
                button.addEventListener('click', function() {
                    const targetModal = this.getAttribute('data-bs-target');
                    setTimeout(function() {
                        const modal = document.querySelector(targetModal);
                        if (modal) {
                            const imageInput = modal.querySelector('.image-upload');
                            if (imageInput) {
                                handleImagePreview(imageInput);
                            }
                        }
                    }, 500); // Small delay to ensure modal is fully shown
                });
            });
        });
    </script>

    <style>
        .image-preview-container {
            position: relative;
            min-height: 150px;
        }

        .preview-image {
            max-width: 100%;
            object-fit: contain;
        }

        .no-image-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #f8f9fa;
        }
    </style>
@endpush
