@extends('layouts.app')

@section('title', 'Edit Media')

@section('content')
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3>Edit Media Details</h3>
                                <p class="text-sm mb-0 text-muted">Update file information and properties</p>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.media.show', $media) }}" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-eye me-1"></i> View Details
                                </a>
                                <a href="{{ route('admin.media.index') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-arrow-left me-1"></i> Back to Library
                                </a>
                            </div>
                        </div>

                        {{-- File Quick Stats --}}
                        <div class="row mt-3">
                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">File Size</p>
                                                    <h5 class="font-weight-bolder">
                                                        {{ \App\Helpers\MediaHelper::formatBytes($media->size) }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                                    <i class="fas fa-weight text-lg opacity-10"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Type</p>
                                                    <h5 class="font-weight-bolder">
                                                        {{ strtoupper(\App\Helpers\MediaHelper::getExtension($media->file_name)) }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                                    <i class="fas fa-file text-lg opacity-10"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Upload Date</p>
                                                    <h5 class="font-weight-bolder">
                                                        {{ $media->created_at->format('M d, Y') }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                                    <i class="fas fa-calendar text-lg opacity-10"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Collection</p>
                                                    <h5 class="font-weight-bolder">
                                                        {{ $media->collection_name ?: 'default' }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                                    <i class="fas fa-folder text-lg opacity-10"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                                <i class="bi bi-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                Please fix the following errors:
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="row mx-3">
                            <div class="col-lg-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-header pb-0">
                                        <h6>File Preview</h6>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="text-center mb-4">
                                            @if (str_starts_with($media->mime_type, 'image/'))
                                                <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}"
                                                    class="img-fluid rounded shadow"
                                                    style="max-height: 300px; width: auto;">
                                            @elseif(str_starts_with($media->mime_type, 'video/'))
                                                <div class="bg-gradient-dark text-white rounded p-5">
                                                    <div class="icon icon-shape bg-white shadow text-center rounded-circle mb-3 mx-auto"
                                                        style="width: 80px; height: 80px;">
                                                        <i class="fas fa-video fa-2x text-dark"></i>
                                                    </div>
                                                    <h5 class="mb-0">Video File</h5>
                                                    <p class="text-sm opacity-8 mb-0">{{ $media->mime_type }}</p>
                                                </div>
                                            @elseif($media->mime_type == 'application/pdf')
                                                <div class="bg-gradient-danger text-white rounded p-5">
                                                    <div class="icon icon-shape bg-white shadow text-center rounded-circle mb-3 mx-auto"
                                                        style="width: 80px; height: 80px;">
                                                        <i class="fas fa-file-pdf fa-2x text-danger"></i>
                                                    </div>
                                                    <h5 class="mb-0">PDF Document</h5>
                                                    <p class="text-sm opacity-8 mb-0">{{ $media->file_name }}</p>
                                                </div>
                                            @else
                                                <div class="bg-gradient-secondary text-white rounded p-5">
                                                    <div class="icon icon-shape bg-white shadow text-center rounded-circle mb-3 mx-auto"
                                                        style="width: 80px; height: 80px;">
                                                        <i class="fas fa-file fa-2x text-secondary"></i>
                                                    </div>
                                                    <h5 class="mb-0">{{ $media->mime_type }}</h5>
                                                    <p class="text-sm opacity-8 mb-0">{{ $media->file_name }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="d-flex justify-content-center gap-2 mt-3">
                                            <a href="{{ $media->getUrl() }}" target="_blank"
                                                class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-external-link-alt me-1"></i> Open
                                            </a>
                                            <a href="{{ route('admin.media.download', $media) }}"
                                                class="btn btn-outline-success btn-sm">
                                                <i class="fas fa-download me-1"></i> Download
                                            </a>
                                            <button type="button" onclick="copyToClipboard('{{ $media->getUrl() }}')"
                                                class="btn btn-outline-info btn-sm">
                                                <i class="fas fa-copy me-1"></i> Copy URL
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <form method="POST" action="{{ route('admin.media.update', $media) }}" id="editForm"
                                    class="needs-validation" novalidate>
                                    @csrf
                                    @method('PUT')

                                    <div class="card mb-4">
                                        <div class="card-header pb-0">
                                            <h6>Edit Information</h6>
                                        </div>
                                        <div class="card-body">
                                            {{-- Display Name --}}
                                            <div class="form-group mb-4">
                                                <label class="form-label mb-1">Display Name <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-tag text-primary"></i>
                                                    </span>
                                                    <input type="text" name="name"
                                                        class="form-control border-start-0"
                                                        value="{{ old('name', $media->name) }}"
                                                        placeholder="Enter display name" required>
                                                </div>
                                                <div class="form-text text-muted">
                                                    This name will be displayed instead of filename
                                                </div>
                                            </div>

                                            {{-- Collection Name --}}
                                            <div class="form-group mb-4">
                                                <label class="form-label mb-1">Collection Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-folder text-primary"></i>
                                                    </span>
                                                    <input type="text" name="collection_name"
                                                        class="form-control border-start-0"
                                                        value="{{ old('collection_name', $media->collection_name) }}"
                                                        placeholder="e.g., blog-images, gallery">
                                                </div>
                                                <div class="form-text text-muted">
                                                    Group this file with others in the same collection
                                                </div>
                                            </div>

                                            {{-- Order Number --}}
                                            <div class="form-group mb-4">
                                                <label class="form-label mb-1">Order Number</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-sort-numeric-up text-primary"></i>
                                                    </span>
                                                    <input type="number" name="order_column"
                                                        class="form-control border-start-0"
                                                        value="{{ old('order_column', $media->order_column) }}"
                                                        placeholder="e.g., 1" min="0">
                                                </div>
                                                <div class="form-text text-muted">
                                                    Lower numbers appear first when sorting by order
                                                </div>
                                            </div>

                                            {{-- Custom Properties --}}
                                            <div class="form-group mb-4">
                                                <label class="form-label mb-1">Custom Properties</label>
                                                <div class="card border">
                                                    <div class="card-body">
                                                        <div id="customPropertiesContainer">
                                                            @php
                                                                // Handle custom properties safely
                                                                $customProps = $media->custom_properties ?? [];
                                                                if (is_string($customProps)) {
                                                                    $customProps =
                                                                        json_decode($customProps, true) ?? [];
                                                                }

                                                                // Get old input for validation errors
                                                                $oldProps = old('custom_properties', []);
                                                                if (!empty($oldProps)) {
                                                                    $customProps = $oldProps;
                                                                }
                                                            @endphp

                                                            @if (empty($customProps))
                                                                <div class="row g-2 mb-2 property-row">
                                                                    <div class="col-5">
                                                                        <input type="text"
                                                                            name="custom_properties[key][]"
                                                                            class="form-control" placeholder="Key">
                                                                    </div>
                                                                    <div class="col-5">
                                                                        <input type="text"
                                                                            name="custom_properties[value][]"
                                                                            class="form-control" placeholder="Value">
                                                                    </div>
                                                                    <div class="col-2">
                                                                        <button type="button"
                                                                            class="btn btn-outline-danger btn-sm remove-property">
                                                                            <i class="fas fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                @php
                                                                    // Handle different array structures
                                                                    if (
                                                                        isset($customProps['key']) &&
                                                                        isset($customProps['value'])
                                                                    ) {
                                                                        // Form submitted structure
                                                                        $keys = $customProps['key'] ?? [];
                                                                        $values = $customProps['value'] ?? [];
                                                                    } else {
                                                                        // Database structure (associative array)
                                                                        $keys = array_keys($customProps);
                                                                        $values = array_values($customProps);
                                                                    }
                                                                @endphp

                                                                @for ($i = 0; $i < max(count($keys), 1); $i++)
                                                                    <div class="row g-2 mb-2 property-row">
                                                                        <div class="col-5">
                                                                            <input type="text"
                                                                                name="custom_properties[key][]"
                                                                                class="form-control"
                                                                                value="{{ $keys[$i] ?? '' }}"
                                                                                placeholder="Key">
                                                                        </div>
                                                                        <div class="col-5">
                                                                            <input type="text"
                                                                                name="custom_properties[value][]"
                                                                                class="form-control"
                                                                                value="{{ $values[$i] ?? '' }}"
                                                                                placeholder="Value">
                                                                        </div>
                                                                        <div class="col-2">
                                                                            <button type="button"
                                                                                class="btn btn-outline-danger btn-sm remove-property">
                                                                                <i class="fas fa-times"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                @endfor
                                                            @endif
                                                        </div>

                                                        <button type="button" id="addProperty"
                                                            class="btn btn-sm btn-outline-primary mt-2">
                                                            <i class="fas fa-plus me-1"></i> Add Property
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-text text-muted">
                                                    Add custom key-value pairs for additional metadata
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- File Information Card --}}
                                    <div class="card mb-4">
                                        <div class="card-header pb-0">
                                            <h6>File Information</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                            class="icon icon-shape bg-gradient-primary shadow text-center border-radius me-3">
                                                            <i class="fas fa-file-alt text-white"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm mb-0">Original Filename</p>
                                                            <h6 class="mb-0 text-sm">{{ $media->file_name }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                            class="icon icon-shape bg-gradient-success shadow text-center border-radius me-3">
                                                            <i class="fas fa-weight text-white"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm mb-0">File Size</p>
                                                            <h6 class="mb-0 text-sm">
                                                                {{ \App\Helpers\MediaHelper::formatBytes($media->size) }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                            class="icon icon-shape bg-gradient-warning shadow text-center border-radius me-3">
                                                            <i class="fas fa-code text-white"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm mb-0">MIME Type</p>
                                                            <h6 class="mb-0 text-sm">{{ $media->mime_type }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                            class="icon icon-shape bg-gradient-info shadow text-center border-radius me-3">
                                                            <i class="fas fa-hdd text-white"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm mb-0">Storage Disk</p>
                                                            <h6 class="mb-0 text-sm">{{ $media->disk }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                            class="icon icon-shape bg-gradient-secondary shadow text-center border-radius me-3">
                                                            <i class="fas fa-calendar text-white"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm mb-0">Uploaded On</p>
                                                            <h6 class="mb-0 text-sm">
                                                                {{ $media->created_at->format('M d, Y h:i A') }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                            class="icon icon-shape bg-gradient-dark shadow text-center border-radius me-3">
                                                            <i class="fas fa-sync text-white"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm mb-0">Last Updated</p>
                                                            <h6 class="mb-0 text-sm">
                                                                {{ $media->updated_at->format('M d, Y h:i A') }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('admin.media.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-1"></i> Cancel
                                        </a>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.media.show', $media) }}"
                                                class="btn btn-outline-info">
                                                <i class="fas fa-eye me-1"></i> View Details
                                            </a>
                                            <button type="submit" class="btn bg-gradient-primary mb-0">
                                                <i class="fas fa-save me-1"></i> Save Changes
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editForm = document.getElementById('editForm');
            const customPropertiesContainer = document.getElementById('customPropertiesContainer');
            const addPropertyButton = document.getElementById('addProperty');

            // Form validation
            editForm.addEventListener('submit', function(event) {
                if (!this.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                this.classList.add('was-validated');
            }, false);

            // Add custom property row
            addPropertyButton.addEventListener('click', function() {
                const row = document.createElement('div');
                row.className = 'row g-2 mb-2 property-row';
                row.innerHTML = `
                    <div class="col-5">
                        <input type="text" 
                               name="custom_properties[key][]" 
                               class="form-control" 
                               placeholder="Key">
                    </div>
                    <div class="col-5">
                        <input type="text" 
                               name="custom_properties[value][]" 
                               class="form-control" 
                               placeholder="Value">
                    </div>
                    <div class="col-2">
                        <button type="button" 
                                class="btn btn-outline-danger btn-sm remove-property">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                customPropertiesContainer.appendChild(row);

                // Add event listener to remove button
                row.querySelector('.remove-property').addEventListener('click', function() {
                    row.remove();
                });
            });

            // Initialize remove buttons for existing rows
            document.querySelectorAll('.remove-property').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.property-row').remove();
                });
            });

            // Character counter for name input
            const nameInput = document.querySelector('input[name="name"]');
            const nameCounter = document.createElement('small');
            nameCounter.className = 'form-text text-muted mt-1';
            nameCounter.textContent = '0/255 characters';

            if (nameInput.closest('.form-group')) {
                const formGroup = nameInput.closest('.form-group');
                const existingCounter = formGroup.querySelector('.char-counter');
                if (!existingCounter) {
                    nameCounter.classList.add('char-counter');
                    formGroup.appendChild(nameCounter);
                }
            }

            nameInput.addEventListener('input', function() {
                const maxLength = 255;
                const currentLength = this.value.length;
                const counter = this.closest('.form-group').querySelector('.char-counter');
                if (counter) {
                    counter.textContent = `${currentLength}/${maxLength} characters`;

                    if (currentLength > maxLength) {
                        counter.classList.add('text-danger');
                        this.classList.add('is-invalid');
                    } else {
                        counter.classList.remove('text-danger');
                        this.classList.remove('is-invalid');
                    }
                }
            });

            // Trigger input event to update counter on page load
            if (nameInput.value) {
                nameInput.dispatchEvent(new Event('input'));
            }

            // Copy URL functionality
            window.copyToClipboard = function(text) {
                navigator.clipboard.writeText(text).then(function() {
                    showToast('URL copied to clipboard!', 'success');
                }).catch(function(err) {
                    console.error('Failed to copy: ', err);
                    showToast('Failed to copy URL', 'error');
                });
            };

            // Show toast notification
            function showToast(message, type = 'success') {
                const toast = document.createElement('div');
                toast.className =
                    `toast align-items-center text-white bg-${type} border-0 position-fixed bottom-0 end-0 m-3`;
                toast.style.zIndex = '1060';
                toast.innerHTML = `
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                            ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                `;

                document.body.appendChild(toast);
                const bsToast = new bootstrap.Toast(toast);
                bsToast.show();

                toast.addEventListener('hidden.bs.toast', function() {
                    document.body.removeChild(toast);
                });
            }
        });
    </script>
@endpush
