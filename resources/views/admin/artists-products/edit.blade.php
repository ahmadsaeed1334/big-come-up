@extends('layouts.app')

@section('content')
    <style>
        /* Same styling as create page */
        .color-preview {
            transition: transform 0.2s;
        }

        .color-preview:hover {
            transform: scale(1.1);
        }

        .color-picker-wrapper {
            width: 60px;
            height: 25px;
            flex-shrink: 0;
            position: relative;
        }

        .form-control-color {
            width: 100% !important;
            height: 100% !important;
            padding: 0;
            border-radius: 6px;
            border: 2px solid #dee2e6;
            cursor: pointer;
            transition: border-color 0.2s;
            position: absolute;
            top: 0;
            left: 0;
        }

        .color-preview-large {
            transition: background-color 0.3s ease;
            width: 100%;
            height: 40px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            margin-top: 10px;
        }

        .hex-input-container {
            flex: 1;
            min-width: 0;
        }

        .color-picker-section {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 5px;
        }

        /* Search box styling - Same as other pages */
        .search-container {
            position: relative;
            width: 300px;
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

        /* Select2 styling */
        .select2-container--bootstrap5 .select2-selection {
            min-height: 42px;
            border: 1px solid #dee2e6 !important;
            border-radius: 0.375rem !important;
        }

        .select2-container--bootstrap5 .select2-selection--multiple {
            min-height: 42px;
        }

        .select2-container--bootstrap5 .select2-selection--multiple .select2-selection__choice__remove {
            color: white !important;
            margin-right: 4px !important;
        }

        .select2-container--bootstrap5 .select2-dropdown {
            border: 1px solid #dee2e6 !important;
            border-radius: 0.375rem !important;
        }

        .select2-container--bootstrap5 .select2-results__option {
            padding: 8px 12px !important;
        }

        .color-badge-select2 {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            display: inline-block;
            margin-right: 8px;
            vertical-align: middle;
            border: 1px solid #ccc;
        }

        /* Image preview styling */
        .preview-image-container {
            position: relative;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .preview-image-container:hover {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .preview-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .preview-badge {
            position: absolute;
            top: 8px;
            left: 8px;
            z-index: 10;
            font-size: 11px;
            padding: 4px 8px;
        }

        .remove-preview-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            z-index: 10;
            width: 28px;
            height: 28px;
            padding: 0;
            line-height: 1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .empty-preview {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 200px;
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .empty-preview:hover {
            border-color: #86b7fe;
            background: #f0f7ff;
        }

        /* Card styling like other pages */
        .card-header.bg-light {
            background-color: #f8f9fa !important;
            border-bottom: 1px solid #dee2e6;
        }

        .card-header.bg-light h5 {
            font-weight: 600;
            color: #495057;
        }

        /* Form control focus effects */
        .form-control:focus,
        .form-select:focus,
        .select2-container--bootstrap5 .select2-selection:focus {
            border-color: #86b7fe !important;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
        }

        /* Button styling */
        .btn-outline-secondary {
            border-color: #dee2e6;
            color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
        }

        /* Modal styling */

        .modal-header .btn-close {
            filter: invert(1) brightness(2);
        }

        /* Price input styling */
        .price-input-group {
            position: relative;
        }

        .price-input-group::before {
            content: "₹";
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-weight: 600;
            z-index: 10;
        }

        .price-input-group input {
            padding-left: 30px;
        }

        /* Alert styling */
        .alert {
            border-radius: 8px;
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
        }

        /* Badge styling */
        .badge {
            border-radius: 6px;
            font-weight: 600;
            padding: 4px 8px;
        }

        /* Current image styling */
        .current-image {
            max-height: 250px;
            object-fit: contain;
            border-radius: 8px;
            border: 2px solid #dee2e6;
        }

        /* Statistics styling */
        .list-group-item {
            border: none;
            padding: 10px 0;
        }

        .list-group-item:not(:last-child) {
            border-bottom: 1px solid #dee2e6;
        }
    </style>

    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="mb-0">Edit Product</h3>
                <small class="text-muted">Update product details</small>
            </div>
            <div>
                <a href="{{ route('admin.artists-products.index') }}" class="btn btn-sm btn-outline-secondary me-2">
                    <i class="fas fa-arrow-left me-1"></i> Back to Products
                </a>
                <a href="{{ route('admin.artists-products.create') }}" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-plus me-1"></i> Add New Product
                </a>
            </div>
        </div>

        <!-- Error/Success Messages -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Main Form Card -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body p-4">
                        <form
                            action="{{ route('admin.artists-products.update', ['artists_product' => $artistsProduct->id]) }}"
                            method="POST" enctype="multipart/form-data" id="productForm">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Left Column: Basic Information -->
                                <div class="col-lg-8">
                                    <!-- Basic Information Card -->
                                    <div class="card mb-4">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Basic Information</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Product Title *</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-heading"></i>
                                                        </span>
                                                        <input type="text" id="title" name="title"
                                                            class="form-control @error('title') is-invalid @enderror"
                                                            value="{{ old('title', $artistsProduct->title) }}" required
                                                            placeholder="Enter product title">
                                                    </div>
                                                    @error('title')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Slug</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-link"></i>
                                                        </span>
                                                        <input type="text" id="slug" class="form-control bg-light"
                                                            value="{{ $artistsProduct->slug }}" readonly>
                                                    </div>
                                                    <small class="text-muted">
                                                        <i class="fas fa-info-circle me-1"></i>Auto-generated from title
                                                    </small>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Category *</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-folder"></i>
                                                        </span>
                                                        <select name="artists_category_id"
                                                            class="form-select @error('artists_category_id') is-invalid @enderror"
                                                            required>
                                                            <option value="">Select Category</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ old('artists_category_id', $artistsProduct->artists_category_id) == $category->id ? 'selected' : '' }}>
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('artists_category_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Artist *</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-user"></i>
                                                        </span>
                                                        <select name="artist_id"
                                                            class="form-select @error('artist_id') is-invalid @enderror"
                                                            required>
                                                            <option value="">Select Artist</option>
                                                            @foreach ($artists as $artist)
                                                                <option value="{{ $artist->id }}"
                                                                    {{ old('artist_id', $artistsProduct->artist_id) == $artist->id ? 'selected' : '' }}>
                                                                    {{ $artist->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('artist_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Price (₹) *</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-rupee-sign"></i>
                                                        </span>
                                                        <input type="number" step="0.01" name="price"
                                                            class="form-control @error('price') is-invalid @enderror"
                                                            value="{{ old('price', $artistsProduct->price) }}" required
                                                            min="0" placeholder="0.00">
                                                    </div>
                                                    @error('price')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Sale Price (₹)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-tag"></i>
                                                        </span>
                                                        <input type="number" step="0.01" name="sale_price"
                                                            class="form-control @error('sale_price') is-invalid @enderror"
                                                            value="{{ old('sale_price', $artistsProduct->sale_price) }}"
                                                            min="0" placeholder="0.00">
                                                    </div>
                                                    @error('sale_price')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Rating (0-5)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-star"></i>
                                                        </span>
                                                        <input type="number" step="0.1" min="0"
                                                            max="5" name="rating"
                                                            class="form-control @error('rating') is-invalid @enderror"
                                                            value="{{ old('rating', $artistsProduct->rating) }}"
                                                            placeholder="0.0">
                                                    </div>
                                                    @error('rating')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <small class="text-muted">
                                                        <i class="fas fa-chart-line me-1"></i>Based on
                                                        {{ $artistsProduct->reviews_count }} reviews
                                                    </small>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label class="form-label">Description *</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-align-left"></i>
                                                        </span>
                                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required
                                                            placeholder="Enter product description">{{ old('description', $artistsProduct->description) }}</textarea>
                                                    </div>
                                                    @error('description')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label class="form-label">Product Details (Optional)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-list"></i>
                                                        </span>
                                                        <textarea name="product_details" class="form-control @error('product_details') is-invalid @enderror" rows="3"
                                                            placeholder="Additional product details">{{ old('product_details', $artistsProduct->product_details) }}</textarea>
                                                    </div>
                                                    @error('product_details')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Images Section Card -->
                                    <div class="card mb-4">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0"><i class="fas fa-images me-2"></i>Product Images</h5>
                                        </div>
                                        <div class="card-body">
                                            <!-- Current Main Image -->
                                            <div class="mb-4">
                                                <label class="form-label">Current Main Image</label>
                                                @if ($artistsProduct->getFirstMediaUrl('main_image'))
                                                    <div class="text-center mb-4">
                                                        <img src="{{ $artistsProduct->getFirstMediaUrl('main_image') }}"
                                                            alt="{{ $artistsProduct->title }}"
                                                            class="current-image mb-2">
                                                        <div>
                                                            <small class="text-muted">
                                                                <i class="fas fa-image me-1"></i>Current main image
                                                            </small>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="empty-preview">
                                                        <i class="fas fa-image fa-3x mb-2"></i>
                                                        <p class="mb-0">No main image set</p>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Update Main Image -->
                                            <div class="mb-4">
                                                <label class="form-label">Update Main Image</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-camera"></i>
                                                    </span>
                                                    <input type="file" name="main_image"
                                                        class="form-control @error('main_image') is-invalid @enderror"
                                                        accept="image/jpeg,image/png,image/gif,image/webp"
                                                        id="mainImageInput">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        onclick="clearMainPreview()">
                                                        <i class="fas fa-times me-1"></i> Clear
                                                    </button>
                                                </div>
                                                <small class="text-muted">
                                                    <i class="fas fa-info-circle me-1"></i>Leave empty to keep current
                                                    image (max: 5MB, JPEG, PNG, GIF, WebP)
                                                </small>
                                                @error('main_image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                                <!-- Main Image Preview -->
                                                <div class="mt-3">
                                                    <label class="form-label">New Main Image Preview:</label>
                                                    <div id="mainImagePreview" class="text-center">
                                                        <div class="empty-preview">
                                                            <i class="fas fa-image fa-3x mb-2"></i>
                                                            <p class="mb-0">No new image selected</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Current Gallery Images -->
                                            <div class="mb-4">
                                                <label class="form-label">Current Gallery Images</label>
                                                @if ($artistsProduct->getMedia('product_images')->count() > 0)
                                                    <div class="row g-3">
                                                        @foreach ($artistsProduct->getMedia('product_images') as $image)
                                                            <div class="col-6 col-md-4 col-lg-3">
                                                                <div class="preview-image-container">
                                                                    <img src="{{ $image->getUrl() }}"
                                                                        class="preview-image" alt="Gallery Image">
                                                                    <span class="badge bg-info preview-badge">
                                                                        <i class="fas fa-image me-1"></i>Gallery
                                                                    </span>
                                                                    <input type="hidden" name="keep_images[]"
                                                                        value="{{ $image->id }}">

                                                                    <!-- Remove Button -->
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-sm remove-preview-btn js-remove-image"
                                                                        data-url="{{ route('admin.artists-products.removeImage', $artistsProduct->id) }}"
                                                                        data-media-id="{{ $image->id }}"
                                                                        title="Remove image">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle me-2"></i>No gallery images
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Add More Gallery Images -->
                                            <div class="mb-4">
                                                <label class="form-label">Add More Gallery Images</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-images"></i>
                                                    </span>
                                                    <input type="file" name="images[]"
                                                        class="form-control @error('images.*') is-invalid @enderror"
                                                        accept="image/jpeg,image/png,image/gif,image/webp" multiple
                                                        id="additionalImagesInput">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        onclick="clearAllNewImages()">
                                                        <i class="fas fa-times me-1"></i> Clear All
                                                    </button>
                                                </div>
                                                <small class="text-muted">
                                                    <i class="fas fa-info-circle me-1"></i>Select multiple images to add to
                                                    gallery (max 5MB each)
                                                </small>
                                                @error('images.*')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                                <!-- Additional Images Preview -->
                                                <div class="mt-3">
                                                    <label class="form-label">New Gallery Images Preview:</label>
                                                    <div id="additionalImagesPreview" class="row g-3">
                                                        <!-- Preview will appear here -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column: Sidebar -->
                                <div class="col-lg-4">
                                    <!-- Status Card -->
                                    <div class="card mb-4">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0"><i class="fas fa-toggle-on me-2"></i>Status & Settings</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="input-group">
                                                    {{-- <span class="input-group-text">
                                                        <i class="fas fa-power-off"></i>
                                                    </span> --}}
                                                    <div class="form-check form-switch ms-2 mt-2">
                                                        <input type="checkbox" name="is_active" class="form-check-input"
                                                            id="is_active" value="1"
                                                            {{ old('is_active', $artistsProduct->is_active) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="is_active">
                                                            Active Product
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="input-group">
                                                    {{-- <span class="input-group-text">
                                                        <i class="fas fa-star"></i>
                                                    </span> --}}
                                                    <div class="form-check form-switch ms-2 mt-2">
                                                        <input type="checkbox" name="is_featured"
                                                            class="form-check-input" id="is_featured" value="1"
                                                            {{ old('is_featured', $artistsProduct->is_featured) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="is_featured">
                                                            Featured Product
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Product Statistics Card -->
                                    <div class="card mb-4">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Product Statistics
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                    <span><i class="fas fa-star text-warning me-2"></i>Reviews</span>
                                                    <span
                                                        class="badge bg-info rounded-pill">{{ $artistsProduct->reviews_count }}</span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                    <span><i class="fas fa-image text-primary me-2"></i>Images</span>
                                                    <span class="badge bg-info rounded-pill">
                                                        {{ $artistsProduct->getMedia('product_images')->count() + ($artistsProduct->getFirstMediaUrl('main_image') ? 1 : 0) }}
                                                    </span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                    <span><i class="fas fa-palette text-success me-2"></i>Colors</span>
                                                    <span
                                                        class="badge bg-info rounded-pill">{{ $artistsProduct->colors->count() }}</span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                    <span><i class="fas fa-arrows-alt-h text-danger me-2"></i>Sizes</span>
                                                    <span
                                                        class="badge bg-info rounded-pill">{{ $artistsProduct->sizes->count() }}</span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                    <span><i
                                                            class="fas fa-calendar-plus text-secondary me-2"></i>Created</span>
                                                    <small
                                                        class="text-muted">{{ $artistsProduct->created_at->format('Y-m-d') }}</small>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                    <span><i
                                                            class="fas fa-calendar-check text-secondary me-2"></i>Updated</span>
                                                    <small
                                                        class="text-muted">{{ $artistsProduct->updated_at->format('Y-m-d') }}</small>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Variants Card -->
                                    <div class="card mb-4">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0"><i class="fas fa-palette me-2"></i>Product Variants</h5>
                                        </div>
                                        <div class="card-body">
                                            <!-- Colors -->
                                            <div class="mb-3">
                                                <label class="form-label">Select Colors</label>
                                                <div class="input-group">
                                                    {{-- <span class="input-group-text">
                                                        <i class="fas fa-palette"></i>
                                                    </span> --}}
                                                    <select name="color_ids[]"
                                                        class="form-select select2-colors @error('color_ids') is-invalid @enderror"
                                                        multiple data-placeholder="Choose colors..." id="colorSelect">
                                                        @foreach ($colors as $color)
                                                            <option value="{{ $color->id }}"
                                                                data-color-code="{{ $color->code }}"
                                                                {{ in_array($color->id, old('color_ids', $artistsProduct->colors->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                                {{ $color->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('color_ids')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                @error('color_ids.*')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Type to search or click to select multiple
                                                    colors</small>
                                            </div>

                                            <!-- Sizes -->
                                            <div class="mb-3">
                                                <label class="form-label">Select Sizes</label>
                                                <div class="input-group">
                                                    {{-- <span class="input-group-text">
                                                        <i class="fas fa-arrows-alt-h"></i>
                                                    </span> --}}
                                                    <select name="size_ids[]"
                                                        class="form-select select2-sizes @error('size_ids') is-invalid @enderror"
                                                        multiple data-placeholder="Choose sizes..." id="sizeSelect">
                                                        @foreach ($sizes as $size)
                                                            <option value="{{ $size->id }}"
                                                                {{ in_array($size->id, old('size_ids', $artistsProduct->sizes->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                                {{ $size->code }} - {{ $size->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('size_ids')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                @error('size_ids.*')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Type to search or click to select multiple
                                                    sizes</small>
                                            </div>

                                            <!-- Add new buttons -->
                                            <div class="d-flex gap-2">
                                                <button type="button" class="btn btn-sm btn-info flex-fill"
                                                    id="addColorBtn">
                                                    <i class="fas fa-plus me-1"></i> Add Color
                                                </button>
                                                <button type="button" class="btn btn-sm btn-dark flex-fill"
                                                    id="addSizeBtn">
                                                    <i class="fas fa-plus me-1"></i> Add Size
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Actions Card -->
                                    <div class="card">
                                        <div class="card-body">
                                            <button type="submit" class="btn btn-primary w-100 mb-2" id="submitBtn">
                                                <i class="fas fa-save me-2"></i> Update Product
                                            </button>
                                            <a href="{{ route('admin.artists-products.index') }}"
                                                class="btn btn-outline-secondary w-100 mb-2">
                                                <i class="fas fa-times me-2"></i> Cancel
                                            </a>

                                            <!-- Delete Button -->
                                            <button type="button" class="btn btn-outline-danger w-100"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                <i class="fas fa-trash me-2"></i> Delete Product
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Color Modal -->
    <div class="modal fade" id="addColorModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-palette me-2"></i>Add New Color</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="colorFormContainer">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Color Name *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-pen"></i>
                                </span>
                                <input type="text" name="color_name" class="form-control" id="colorName">
                            </div>
                            <div class="invalid-feedback" id="nameError"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Color Code (HEX)</label>
                            <div class="color-picker-section">
                                <div class="input-group mb-2">
                                    {{-- <span class="input-group-text">
                                    <i class="fas fa-fill-drip"></i>
                                </span> --}}
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="color_code" class="form-control form-control-color"
                                            value="#000000" id="colorPicker">
                                    </div>
                                    <div class="hex-input-container">
                                        <input type="text" name="color_hex" class="form-control" id="colorHex"
                                            value="#000000" maxlength="7" placeholder="#000000">
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted">Click color box or enter HEX code</small>
                            <div class="invalid-feedback" id="codeError"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancel
                    </button>
                    <button type="button" class="btn btn-primary" id="saveColorBtn">
                        <i class="fas fa-plus me-1"></i> Add Color
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Size Modal -->
    <div class="modal fade" id="addSizeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-arrows-alt-h me-2"></i>Add New Size</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="sizeFormContainer">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Size Name *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-text-width"></i>
                                </span>
                                <input type="text" name="size_name" class="form-control" id="sizeName">
                            </div>
                            <div class="invalid-feedback" id="sizeNameError"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Size Code *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-code"></i>
                                </span>
                                <input type="text" name="size_code" class="form-control" id="sizeCode">
                            </div>
                            <small class="text-muted">Unique code like S, M, L, XL</small>
                            <div class="invalid-feedback" id="sizeCodeError"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancel
                    </button>
                    <button type="button" class="btn btn-primary" id="saveSizeBtn">
                        <i class="fas fa-plus me-1"></i> Add Size
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                    <p class="text-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Warning:</strong> This will also delete all associated images, colors, sizes, and reviews!
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.artists-products.destroy', $artistsProduct->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-2"></i> Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Auto-generate slug from title
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('title');
            const slugInput = document.getElementById('slug');

            if (titleInput && slugInput) {
                titleInput.addEventListener('input', function() {
                    const slug = generateSlug(this.value);
                    slugInput.value = slug;
                });

                // Generate initial slug if title has value
                if (titleInput.value) {
                    slugInput.value = generateSlug(titleInput.value);
                }
            }

            function generateSlug(text) {
                return text
                    .toString()
                    .toLowerCase()
                    .trim()
                    .replace(/[\s\W-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
            }
        });
    </script>

    <script>
        // Toast notification functions
        function showSuccessToast(message) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: message,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    popup: 'swal2-toast'
                }
            });
        }

        function showErrorToast(message) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: message,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 4000,
                timerProgressBar: true,
                customClass: {
                    popup: 'swal2-toast'
                }
            });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Color picker functionality
            const colorPicker = document.getElementById('colorPicker');
            const colorHex = document.getElementById('colorHex');

            if (colorPicker && colorHex) {
                colorPicker.addEventListener('input', function() {
                    colorHex.value = this.value;
                });

                colorHex.addEventListener('input', function() {
                    let hexValue = this.value;
                    if (!hexValue.startsWith('#')) {
                        hexValue = '#' + hexValue;
                    }

                    if (/^#[0-9A-F]{6}$/i.test(hexValue)) {
                        colorPicker.value = hexValue;
                        this.value = hexValue;
                    }
                });
            }

            // Open Color Modal
            const addColorBtn = document.getElementById('addColorBtn');
            if (addColorBtn) {
                addColorBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Reset form
                    const colorFormContainer = document.getElementById('colorFormContainer');
                    if (colorFormContainer) {
                        const inputs = colorFormContainer.querySelectorAll('input');
                        inputs.forEach(input => {
                            if (input.type === 'color') {
                                input.value = '#000000';
                            } else if (input.type === 'text') {
                                input.value = '';
                            }
                        });
                    }

                    // Clear errors
                    document.getElementById('nameError').textContent = '';
                    document.getElementById('codeError').textContent = '';
                    document.getElementById('colorName')?.classList.remove('is-invalid');
                    document.getElementById('colorHex')?.classList.remove('is-invalid');

                    // Show modal
                    const colorModalElement = document.getElementById('addColorModal');
                    if (colorModalElement) {
                        const colorModal = new bootstrap.Modal(colorModalElement);
                        colorModal.show();
                    }
                });
            }

            // Save Color via AJAX
            const saveColorBtn = document.getElementById('saveColorBtn');
            if (saveColorBtn) {
                saveColorBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    const btn = this;
                    const originalText = btn.innerHTML;

                    // Get form data
                    const colorName = document.getElementById('colorName')?.value;
                    const colorCode = document.getElementById('colorHex')?.value;
                    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                            'content') ||
                        document.querySelector('input[name="_token"]')?.value;

                    // Validate
                    if (!colorName || colorName.trim() === '') {
                        const nameInput = document.getElementById('colorName');
                        const nameError = document.getElementById('nameError');
                        if (nameInput) nameInput.classList.add('is-invalid');
                        if (nameError) nameError.textContent = 'Color name is required';
                        return;
                    }

                    // Disable button and show loading
                    btn.disabled = true;
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Adding...';

                    // Create form data
                    const formData = new FormData();
                    formData.append('name', colorName);
                    formData.append('code', colorCode);
                    formData.append('_token', token);

                    // Send AJAX request - Use correct route for colors
                    fetch('{{ route('admin.artists-products.colors.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Add new option to select2
                                const newOption = new Option(data.color.name, data.color.id, false,
                                    false);
                                newOption.setAttribute('data-color-code', data.color.code || '#cccccc');

                                const colorSelect = document.getElementById('colorSelect');
                                if (colorSelect) {
                                    colorSelect.appendChild(newOption);
                                    $(colorSelect).trigger('change');
                                    $(colorSelect).val(data.color.id).trigger('change');
                                }

                                // Close modal
                                const modalElement = document.getElementById('addColorModal');
                                if (modalElement) {
                                    const modal = bootstrap.Modal.getInstance(modalElement);
                                    if (modal) modal.hide();
                                }

                                showSuccessToast(data.message || 'Color added successfully!');
                            } else {
                                if (data.errors) {
                                    if (data.errors.name) {
                                        const nameInput = document.getElementById('colorName');
                                        const nameError = document.getElementById('nameError');
                                        if (nameInput) nameInput.classList.add('is-invalid');
                                        if (nameError) nameError.textContent = data.errors.name[0];
                                    }
                                    if (data.errors.code) {
                                        const codeInput = document.getElementById('colorHex');
                                        const codeError = document.getElementById('codeError');
                                        if (codeInput) codeInput.classList.add('is-invalid');
                                        if (codeError) codeError.textContent = data.errors.code[0];
                                    }
                                    if (data.message) {
                                        showErrorToast(data.message);
                                    }
                                } else if (data.message) {
                                    showErrorToast(data.message || 'Failed to add color');
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Fetch Error:', error);
                            showErrorToast('Failed to add color. Please try again.');
                        })
                        .finally(() => {
                            btn.disabled = false;
                            btn.innerHTML = originalText;
                        });
                });
            }

            // Open Size Modal
            const addSizeBtn = document.getElementById('addSizeBtn');
            if (addSizeBtn) {
                addSizeBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Reset form
                    const sizeFormContainer = document.getElementById('sizeFormContainer');
                    if (sizeFormContainer) {
                        const inputs = sizeFormContainer.querySelectorAll('input[type="text"]');
                        inputs.forEach(input => input.value = '');
                    }

                    // Clear errors
                    document.getElementById('sizeNameError').textContent = '';
                    document.getElementById('sizeCodeError').textContent = '';
                    document.getElementById('sizeName')?.classList.remove('is-invalid');
                    document.getElementById('sizeCode')?.classList.remove('is-invalid');

                    // Show modal
                    const sizeModalElement = document.getElementById('addSizeModal');
                    if (sizeModalElement) {
                        const sizeModal = new bootstrap.Modal(sizeModalElement);
                        sizeModal.show();
                    }
                });
            }

            // Save Size via AJAX
            const saveSizeBtn = document.getElementById('saveSizeBtn');
            if (saveSizeBtn) {
                saveSizeBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    const btn = this;
                    const originalText = btn.innerHTML;

                    // Get form data
                    const sizeName = document.getElementById('sizeName')?.value;
                    const sizeCode = document.getElementById('sizeCode')?.value;
                    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                            'content') ||
                        document.querySelector('input[name="_token"]')?.value;

                    // Validate
                    let isValid = true;
                    if (!sizeName || sizeName.trim() === '') {
                        document.getElementById('sizeName')?.classList.add('is-invalid');
                        document.getElementById('sizeNameError').textContent = 'Size name is required';
                        isValid = false;
                    }
                    if (!sizeCode || sizeCode.trim() === '') {
                        document.getElementById('sizeCode')?.classList.add('is-invalid');
                        document.getElementById('sizeCodeError').textContent = 'Size code is required';
                        isValid = false;
                    }

                    if (!isValid) return;

                    // Disable button and show loading
                    btn.disabled = true;
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Adding...';

                    // Create form data
                    const formData = new FormData();
                    formData.append('name', sizeName);
                    formData.append('code', sizeCode);
                    formData.append('_token', token);

                    // Send AJAX request
                    fetch('{{ route('admin.artists-products.sizes.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Add new option to select2
                                const newOption = new Option(data.size.code + ' - ' + data.size.name,
                                    data.size.id, false, false);

                                const sizeSelect = document.getElementById('sizeSelect');
                                if (sizeSelect) {
                                    sizeSelect.appendChild(newOption);
                                    $(sizeSelect).trigger('change');
                                    $(sizeSelect).val(data.size.id).trigger('change');
                                }

                                // Close modal
                                const modalElement = document.getElementById('addSizeModal');
                                if (modalElement) {
                                    const modal = bootstrap.Modal.getInstance(modalElement);
                                    if (modal) modal.hide();
                                }

                                showSuccessToast(data.message || 'Size added successfully!');
                            } else {
                                if (data.errors) {
                                    if (data.errors.name) {
                                        document.getElementById('sizeName')?.classList.add(
                                            'is-invalid');
                                        document.getElementById('sizeNameError').textContent = data
                                            .errors.name[0];
                                    }
                                    if (data.errors.code) {
                                        document.getElementById('sizeCode')?.classList.add(
                                            'is-invalid');
                                        document.getElementById('sizeCodeError').textContent = data
                                            .errors.code[0];
                                    }
                                    if (data.message) {
                                        showErrorToast(data.message);
                                    }
                                } else if (data.message) {
                                    showErrorToast(data.message || 'Failed to add size');
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showErrorToast('Failed to add size. Please try again.');
                        })
                        .finally(() => {
                            btn.disabled = false;
                            btn.innerHTML = originalText;
                        });
                });
            }

            // Image preview functionality
            const productForm = document.getElementById('productForm');
            const submitBtn = document.getElementById('submitBtn');
            const mainImageInput = document.getElementById('mainImageInput');
            const additionalImagesInput = document.getElementById('additionalImagesInput');
            const mainImagePreview = document.getElementById('mainImagePreview');
            const additionalImagesPreview = document.getElementById('additionalImagesPreview');

            // Handle form submission
            if (productForm && submitBtn) {
                productForm.addEventListener('submit', function(e) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Updating...';
                });
            }

            // Main image preview
            if (mainImageInput) {
                mainImageInput.addEventListener('change', function(e) {
                    const file = this.files[0];
                    if (file) previewMainImage(file);
                });
            }

            function previewMainImage(file) {
                if (!file.type.match('image.*')) {
                    showErrorToast('Please select an image file');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    mainImagePreview.innerHTML = `
                        <div class="preview-image-container">
                            <img src="${e.target.result}" class="preview-image" alt="Main Image Preview">
                            <span class="badge bg-primary preview-badge">New Main</span>
                            <button type="button" class="btn btn-danger btn-sm remove-preview-btn" onclick="clearMainPreview()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `;
                };
                reader.readAsDataURL(file);
            }

            // Additional images
            let selectedFiles = [];

            function syncInputFiles() {
                const dt = new DataTransfer();
                selectedFiles.forEach(f => dt.items.add(f));
                additionalImagesInput.files = dt.files;
            }

            function renderPreviews() {
                additionalImagesPreview.innerHTML = '';

                selectedFiles.forEach((file, idx) => {
                    if (!file.type.match('image.*')) return;

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-6 col-md-4 col-lg-3';
                        col.innerHTML = `
                            <div class="preview-image-container">
                                <img src="${e.target.result}" class="preview-image" alt="New Gallery Image">
                                <span class="badge bg-success preview-badge">New</span>
                                <button type="button" class="btn btn-danger btn-sm remove-preview-btn" data-remove-index="${idx}">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        `;
                        additionalImagesPreview.appendChild(col);
                    };
                    reader.readAsDataURL(file);
                });
            }

            if (additionalImagesInput) {
                additionalImagesInput.addEventListener('change', function() {
                    selectedFiles = Array.from(this.files || []);
                    renderPreviews();
                    syncInputFiles();
                });
            }

            // Remove image from preview
            additionalImagesPreview.addEventListener('click', function(e) {
                const btn = e.target.closest('button[data-remove-index]');
                if (!btn) return;

                const idx = Number(btn.getAttribute('data-remove-index'));
                if (Number.isNaN(idx)) return;

                selectedFiles.splice(idx, 1);
                syncInputFiles();
                renderPreviews();
            });

            // AJAX image removal
            document.addEventListener('click', async (e) => {
                const btn = e.target.closest('.js-remove-image');
                if (!btn) return;

                if (!confirm('Remove this image from product?')) return;

                const url = btn.dataset.url;
                const mediaId = btn.dataset.mediaId;
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const formData = new FormData();
                formData.append('_method', 'DELETE');
                formData.append('_token', token);
                formData.append('media_id', mediaId);

                try {
                    const res = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    });

                    const data = await res.json();

                    if (data.success) {
                        const container = btn.closest('.col-6, .col-md-4, .col-lg-3');
                        if (container) {
                            container.remove();
                            showSuccessToast('Image removed successfully!');

                            // Refresh the page after 1.5 seconds
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        }
                    } else {
                        showErrorToast(data.message || 'Image remove failed.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showErrorToast('Network error. Please try again.');
                }
            });

            // Global functions for clearing previews
            window.clearMainPreview = function() {
                if (mainImageInput) mainImageInput.value = '';
                mainImagePreview.innerHTML = `
                    <div class="empty-preview">
                        <i class="fas fa-image fa-3x mb-2"></i>
                        <p class="mb-0">No new image selected</p>
                    </div>
                `;
            };

            window.clearAllNewImages = function() {
                selectedFiles = [];
                if (additionalImagesInput) additionalImagesInput.value = '';
                if (additionalImagesPreview) additionalImagesPreview.innerHTML = '';
                showSuccessToast('All new images cleared');
            };
        });
    </script>

    <script>
        // Select2 initialization
        $(document).ready(function() {
            function formatColor(option) {
                if (!option.id) return option.text;

                const code = $(option.element).data('color-code');
                if (!code) return option.text;

                return $(`
                    <span style="display:flex;align-items:center;gap:8px;">
                        <span style="
                            width:16px;
                            height:16px;
                            border-radius:4px;
                            background:${code};
                            border:1px solid #dee2e6;
                            display:inline-block;
                        "></span>
                        <span>${option.text}</span>
                    </span>
                `);
            }

            $('.select2-colors').select2({
                theme: 'bootstrap5',
                placeholder: 'Choose colors...',
                width: '100%',
                closeOnSelect: false,
                templateResult: formatColor,
                templateSelection: formatColor,
                escapeMarkup: markup => markup
            });

            $('.select2-sizes').select2({
                theme: 'bootstrap5',
                placeholder: 'Choose sizes...',
                width: '100%',
                closeOnSelect: false
            });
        });
    </script>
@endsection
