@extends('layouts.app')

@section('content')
    <style>
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

        .form-control-color {
            height: 38px;
            width: 60px;
            padding: 3px;
        }

        .preview-image-container {
            position: relative;
            border: 2px solid #dee2e6;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .preview-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .preview-badge {
            position: absolute;
            top: 5px;
            left: 5px;
            z-index: 10;
        }

        .remove-preview-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 10;
            width: 24px;
            height: 24px;
            padding: 0;
            line-height: 1;
        }

        .empty-preview {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 200px;
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 5px;
            color: #6c757d;
        }

        .current-image {
            max-height: 200px;
            object-fit: contain;
        }
    </style>


    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Edit Product</h3>
            <small class="text-muted">Update product details</small>
        </div>
        <div>
            <a href="{{ route('admin.artists-products.index') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="{{ route('admin.artists-products.create') }}" class="btn btn-outline-primary">
                <i class="fas fa-plus"></i> Add New
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <!-- CHANGE HERE: $product to $artistsProduct -->
            <form action="{{ route('admin.artists-products.update', ['artists_product' => $artistsProduct->id]) }}"
                method="POST" enctype="multipart/form-data" id="productForm">
                @csrf
                @method('PUT')
                <!-- Hidden field to prevent accidental delete -->

                <div class="row">
                    <!-- Basic Information -->
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Basic Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Product Title *</label>
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title', $artistsProduct->title) }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Slug</label>
                                        <input type="text" class="form-control" value="{{ $artistsProduct->slug }}"
                                            readonly>
                                        <small class="text-muted">Auto-generated from title</small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Category *</label>
                                        <select name="artists_category_id"
                                            class="form-select @error('artists_category_id') is-invalid @enderror" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('artists_category_id', $artistsProduct->artists_category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('artists_category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Artist *</label>
                                        <select name="artist_id"
                                            class="form-select @error('artist_id') is-invalid @enderror" required>
                                            <option value="">Select Artist</option>
                                            @foreach ($artists as $artist)
                                                <option value="{{ $artist->id }}"
                                                    {{ old('artist_id', $artistsProduct->artist_id) == $artist->id ? 'selected' : '' }}>
                                                    {{ $artist->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('artist_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Price (₹) *</label>
                                        <input type="number" step="0.01" name="price"
                                            class="form-control @error('price') is-invalid @enderror"
                                            value="{{ old('price', $artistsProduct->price) }}" required min="0">
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Sale Price (₹)</label>
                                        <input type="number" step="0.01" name="sale_price"
                                            class="form-control @error('sale_price') is-invalid @enderror"
                                            value="{{ old('sale_price', $artistsProduct->sale_price) }}" min="0">
                                        @error('sale_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Rating (0-5)</label>
                                        <input type="number" step="0.1" min="0" max="5" name="rating"
                                            class="form-control @error('rating') is-invalid @enderror"
                                            value="{{ old('rating', $artistsProduct->rating) }}">
                                        @error('rating')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Based on {{ $artistsProduct->reviews_count }}
                                            reviews</small>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Description *</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $artistsProduct->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Product Details</label>
                                        <textarea name="product_details" class="form-control @error('product_details') is-invalid @enderror" rows="3">{{ old('product_details', $artistsProduct->product_details) }}</textarea>
                                        @error('product_details')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Images Section -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Product Images</h5>
                            </div>
                            <div class="card-body">
                                <!-- Current Main Image -->
                                <div class="mb-4">
                                    <label class="form-label">Current Main Image</label>
                                    @if ($artistsProduct->getFirstMediaUrl('main_image'))
                                        <div class="text-center mb-3">
                                            <img src="{{ $artistsProduct->getFirstMediaUrl('main_image') }}"
                                                alt="{{ $artistsProduct->title }}"
                                                class="img-fluid rounded current-image">
                                            <div>
                                                <small class="text-muted">Current main image</small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-center text-muted py-4">
                                            <i class="fas fa-image fa-3x mb-2"></i>
                                            <p>No main image set</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Update Main Image -->
                                <div class="mb-4">
                                    <label class="form-label">Update Main Image</label>
                                    <div class="input-group">
                                        <input type="file" name="main_image"
                                            class="form-control @error('main_image') is-invalid @enderror"
                                            accept="image/jpeg,image/png,image/gif,image/webp" id="mainImageInput">
                                        <button type="button" class="btn btn-outline-secondary"
                                            onclick="document.getElementById('mainImageInput').value=''">
                                            Clear
                                        </button>
                                    </div>
                                    <small class="text-muted">Leave empty to keep current image (max: 5MB)</small>
                                    @error('main_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <!-- Main Image Preview -->
                                    <div class="mt-3">
                                        <label class="form-label">New Main Image Preview:</label>
                                        <div id="mainImagePreview" class="text-center">
                                            <div class="border rounded p-3 bg-light"
                                                style="height: 200px; display: flex; align-items: center; justify-content: center;">
                                                <div class="text-muted">
                                                    <i class="fas fa-image fa-3x mb-2"></i>
                                                    <p>No new image selected</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Current Gallery Images -->
                                <div class="mb-4">
                                    <label class="form-label">Current Gallery Images</label>
                                    @if ($artistsProduct->getMedia('product_images')->count() > 0)
                                        <div class="row g-2">
                                            @foreach ($artistsProduct->getMedia('product_images') as $image)
                                                <div class="col-6 col-md-4 col-lg-3">
                                                    <div class="preview-image-container">
                                                        <img src="{{ $image->getUrl() }}" class="preview-image"
                                                            alt="Gallery Image">
                                                        <span class="badge bg-secondary preview-badge">Gallery</span>
                                                        <input type="hidden" name="keep_images[]"
                                                            value="{{ $image->id }}">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm remove-preview-btn js-remove-image"
                                                            data-url="{{ route('admin.artists-products.removeImage', $artistsProduct->id) }}"
                                                            data-media-id="{{ $image->id }}">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="alert alert-info">No gallery images</div>
                                    @endif
                                </div>

                                <!-- Add More Gallery Images -->
                                <div class="mb-4">
                                    <label class="form-label">Add More Gallery Images</label>
                                    <div class="input-group">
                                        <input type="file" name="images[]"
                                            class="form-control @error('images.*') is-invalid @enderror"
                                            accept="image/jpeg,image/png,image/gif,image/webp" multiple
                                            id="additionalImagesInput">
                                        <button type="button" class="btn btn-outline-secondary"
                                            onclick="clearAllNewImages()">
                                            Clear All
                                        </button>
                                    </div>
                                    <small class="text-muted">Select multiple images to add to gallery (max 5MB
                                        each)</small>
                                    @error('images.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <!-- Additional Images Preview -->
                                    <div class="mt-3">
                                        <label class="form-label">New Gallery Images Preview:</label>
                                        <div id="additionalImagesPreview" class="row g-2">
                                            <!-- Preview will appear here -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-md-4">
                        <!-- Status Card -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Status & Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active"
                                            value="1"
                                            {{ old('is_active', $artistsProduct->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active Product
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" name="is_featured" class="form-check-input"
                                            id="is_featured" value="1"
                                            {{ old('is_featured', $artistsProduct->is_featured) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Featured Product
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product Statistics -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Product Statistics</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <span>Reviews</span>
                                        <span
                                            class="badge bg-info rounded-pill">{{ $artistsProduct->reviews_count }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <span>Images</span>
                                        <span
                                            class="badge bg-info rounded-pill">{{ $artistsProduct->getMedia('product_images')->count() + ($artistsProduct->getFirstMediaUrl('main_image') ? 1 : 0) }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <span>Colors</span>
                                        <span
                                            class="badge bg-info rounded-pill">{{ $artistsProduct->colors->count() }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <span>Sizes</span>
                                        <span
                                            class="badge bg-info rounded-pill">{{ $artistsProduct->sizes->count() }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <span>Created</span>
                                        <small
                                            class="text-muted">{{ $artistsProduct->created_at->format('Y-m-d') }}</small>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <span>Updated</span>
                                        <small
                                            class="text-muted">{{ $artistsProduct->updated_at->format('Y-m-d') }}</small>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Variants Card -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Product Variants</h5>
                            </div>
                            <div class="card-body">
                                <!-- Colors with Select2 -->
                                <div class="mb-3">
                                    <label class="form-label">Select Colors</label>
                                    <select name="color_ids[]"
                                        class="select2-colors @error('color_ids') is-invalid @enderror" multiple
                                        data-placeholder="Choose colors..." id="colorSelect">
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}" data-color-code="{{ $color->code }}"
                                                {{ in_array($color->id, old('color_ids', $artistsProduct->colors->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                {{ $color->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('color_ids')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @error('color_ids.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Type to search or click to select multiple colors</small>
                                </div>

                                <!-- Sizes with Select2 -->
                                <div class="mb-3">
                                    <label class="form-label">Select Sizes</label>
                                    <select name="size_ids[]"
                                        class="select2-sizes @error('size_ids') is-invalid @enderror" multiple
                                        data-placeholder="Choose sizes..." id="sizeSelect">
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}"
                                                {{ in_array($size->id, old('size_ids', $artistsProduct->sizes->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                {{ $size->code }} - {{ $size->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('size_ids')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @error('size_ids.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Type to search or click to select multiple sizes</small>
                                </div>

                                <!-- Add new color/size buttons -->
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm" id="addColorBtn">
                                        <i class="fas fa-plus me-1"></i> Add New Color
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm" id="addSizeBtn">
                                        <i class="fas fa-plus me-1"></i> Add New Size
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Add Color Modal -->
                        <div class="modal fade" id="addColorModal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add New Color</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="colorFormContainer">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label">Color Name *</label>
                                                <input type="text" name="color_name" class="form-control"
                                                    id="colorName">
                                                <div class="invalid-feedback" id="nameError"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Color Code (HEX)</label>
                                                <div class="input-group">
                                                    <input type="color" name="color_code"
                                                        class="form-control form-control-color" value="#000000"
                                                        id="colorPicker">
                                                    <input type="text" name="color_hex" class="form-control"
                                                        id="colorHex" value="#000000" maxlength="7"
                                                        placeholder="#000000">
                                                </div>
                                                <small class="text-muted">Click color box or enter HEX code</small>
                                                <div class="invalid-feedback" id="codeError"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" id="saveColorBtn">Add
                                            Color</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add Size Modal -->
                        <div class="modal fade" id="addSizeModal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add New Size</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="sizeFormContainer">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label">Size Name *</label>
                                                <input type="text" name="size_name" class="form-control"
                                                    id="sizeName">
                                                <div class="invalid-feedback" id="sizeNameError"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Size Code *</label>
                                                <input type="text" name="size_code" class="form-control"
                                                    id="sizeCode">
                                                <small class="text-muted">Unique code like S, M, L, XL</small>
                                                <div class="invalid-feedback" id="sizeCodeError"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" id="saveSizeBtn">Add Size</button>
                                    </div>
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
                                    Cancel
                                </a>

                                <!-- Delete Button -->
                                <button type="button" class="btn btn-outline-danger w-100" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    <i class="fas fa-trash me-2"></i> Delete Product
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
                    <p class="text-danger"><strong>Warning:</strong> This will also delete all associated images, colors,
                        sizes, and reviews!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.artists-products.destroy', $artistsProduct->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Make sure jQuery is loaded BEFORE Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // ========== GLOBAL VARIABLES AND FUNCTIONS ==========
        // Global variables to track files
        let currentFiles = [];
        let removedFileIndices = new Set();

        // Toast functions (global بنا دیں تاکہ سب جگہ استعمال ہو سکیں)
        function showSuccessToast(message) {
            if (typeof Swal !== 'undefined') {
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
            } else {
                alert(message);
            }
        }

        function showErrorToast(message) {
            if (typeof Swal !== 'undefined') {
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
            } else {
                alert(message);
            }
        }

        // ========== AJAX IMAGE REMOVE FUNCTIONALITY (UPDATED) ==========
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
                    // Remove the image container from DOM
                    const container = btn.closest('.col-6, .col-md-4, .col-lg-3');
                    if (container) {
                        container.remove();

                        // Also remove the hidden input from form
                        const hiddenInput = container.querySelector('input[name="keep_images[]"]');
                        if (hiddenInput) {
                            hiddenInput.remove();
                        }

                        // Show success message
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

        // ========== NEW IMAGE HANDLING FUNCTIONS ==========
        // Remove new image preview and mark file for removal
        function removeNewImagePreview(previewId, fileIndex) {
            const element = document.getElementById(previewId);
            if (element && confirm('Remove this new image?')) {
                element.remove();
                removedFileIndices.add(fileIndex);
                updateFileInput();
                showSuccessToast('Image removed from selection');
            }
        }

        // Update file input to remove deleted files
        function updateFileInput() {
            if (currentFiles.length === 0) return;

            // Create new DataTransfer object
            const dataTransfer = new DataTransfer();

            // Add only files that are not removed
            currentFiles.forEach((file, index) => {
                if (!removedFileIndices.has(index)) {
                    dataTransfer.items.add(file);
                }
            });

            // Update the file input
            const additionalImagesInput = document.getElementById('additionalImagesInput');
            if (additionalImagesInput) {
                additionalImagesInput.files = dataTransfer.files;

                // Update currentFiles
                currentFiles = Array.from(additionalImagesInput.files);
            }
        }

        // Clear all new images (both preview and actual files)
        function clearAllNewImages() {
            if (currentFiles.length === 0) return;

            if (confirm('Clear all new images?')) {
                const additionalImagesInput = document.getElementById('additionalImagesInput');
                if (additionalImagesInput) {
                    additionalImagesInput.value = '';
                }
                currentFiles = [];
                removedFileIndices.clear();
                clearAdditionalPreviews();
                showSuccessToast('All new images cleared');
            }
        }

        // Clear additional previews
        function clearAdditionalPreviews() {
            const additionalImagesPreview = document.getElementById('additionalImagesPreview');
            if (additionalImagesPreview) {
                additionalImagesPreview.innerHTML = '';
            }
        }

        // Clear main preview
        function clearMainPreview() {
            const mainImageInput = document.getElementById('mainImageInput');
            const mainImagePreview = document.getElementById('mainImagePreview');
            if (mainImageInput) {
                mainImageInput.value = '';
            }
            if (mainImagePreview) {
                mainImagePreview.innerHTML = `
                <div class="empty-preview">
                    <i class="fas fa-image fa-3x mb-2"></i>
                    <p>No new image selected</p>
                </div>
            `;
            }
        }

        // Remove specific preview (old function - keep for compatibility)
        function removePreview(previewId) {
            const element = document.getElementById(previewId);
            if (element) {
                element.remove();
            }
        }

        // ========== DOM CONTENT LOADED ==========
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded - Setting up edit page');

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

                    // Validate hex color
                    if (/^#[0-9A-F]{6}$/i.test(hexValue)) {
                        colorPicker.value = hexValue;
                        this.value = hexValue;
                    }
                });
            }

            // Open Color Modal
            const addColorBtn = document.getElementById('addColorBtn');
            if (addColorBtn) {
                console.log('Add color button found');
                addColorBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Add color button clicked');

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

                    // Reset color picker
                    if (colorPicker) {
                        colorPicker.value = '#000000';
                    }
                    if (colorHex) {
                        colorHex.value = '#000000';
                    }

                    // Clear errors
                    document.getElementById('nameError').textContent = '';
                    document.getElementById('codeError').textContent = '';
                    document.getElementById('colorName')?.classList.remove('is-invalid');
                    document.getElementById('colorHex')?.classList.remove('is-invalid');

                    // Show modal using Bootstrap 5
                    const colorModalElement = document.getElementById('addColorModal');
                    if (colorModalElement) {
                        const colorModal = new bootstrap.Modal(colorModalElement);
                        colorModal.show();
                        console.log('Color modal shown');
                    } else {
                        console.error('Color modal element not found!');
                    }
                });
            } else {
                console.error('Add color button not found!');
            }

            // Save Color via AJAX
            const saveColorBtn = document.getElementById('saveColorBtn');
            if (saveColorBtn) {
                saveColorBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Save color button clicked');

                    const btn = this;
                    const originalText = btn.innerHTML;

                    // Get form data from inputs
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

                    // Create form data manually
                    const formData = new FormData();
                    formData.append('name', colorName);
                    formData.append('code', colorCode);
                    formData.append('_token', token);

                    // Send AJAX request
                    fetch('{{ route('admin.colors.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: formData
                        })
                        .then(response => {
                            console.log('Response status:', response.status);
                            if (!response.ok) {
                                throw new Error(`HTTP error! Status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Response received:', data);
                            if (data.success) {
                                // Add new option to select2
                                const newOption = new Option(data.color.name, data.color.id, false,
                                    false);
                                newOption.setAttribute('data-color-code', data.color.code || '#cccccc');

                                // Append to select
                                const colorSelect = document.getElementById('colorSelect');
                                if (colorSelect) {
                                    colorSelect.appendChild(newOption);

                                    // Refresh Select2
                                    $(colorSelect).trigger('change');

                                    // Select the new color
                                    $(colorSelect).val(data.color.id).trigger('change');

                                    console.log('New color added to select');
                                }

                                // Close modal
                                const modalElement = document.getElementById('addColorModal');
                                if (modalElement) {
                                    const modal = bootstrap.Modal.getInstance(modalElement);
                                    if (modal) {
                                        modal.hide();
                                    }
                                }

                                // Show success message
                                showSuccessToast(data.message || 'Color added successfully!');
                            } else {
                                // Show validation errors
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

                                    // Show error toast
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
                            // Re-enable button
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
                    console.log('Add size button clicked');

                    // Reset form container
                    const sizeFormContainer = document.getElementById('sizeFormContainer');
                    if (sizeFormContainer) {
                        const inputs = sizeFormContainer.querySelectorAll('input[type="text"]');
                        inputs.forEach(input => {
                            input.value = '';
                        });
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
                        console.log('Size modal shown');
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

                    // Get form data from inputs
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

                    // Create form data manually
                    const formData = new FormData();
                    formData.append('name', sizeName);
                    formData.append('code', sizeCode);
                    formData.append('_token', token);

                    // Send AJAX request
                    fetch('{{ route('admin.sizes.store') }}', {
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

                                // Append to select
                                const sizeSelect = document.getElementById('sizeSelect');
                                if (sizeSelect) {
                                    sizeSelect.appendChild(newOption);

                                    // Refresh Select2
                                    $(sizeSelect).trigger('change');

                                    // Select the new size
                                    $(sizeSelect).val(data.size.id).trigger('change');
                                }

                                // Close modal
                                const modalElement = document.getElementById('addSizeModal');
                                if (modalElement) {
                                    const modal = bootstrap.Modal.getInstance(modalElement);
                                    if (modal) {
                                        modal.hide();
                                    }
                                }

                                // Show success message
                                showSuccessToast(data.message || 'Size added successfully!');
                            } else {
                                // Show validation errors
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

                                    // Show error toast
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
                            // Re-enable button
                            btn.disabled = false;
                            btn.innerHTML = originalText;
                        });
                });
            }

            // ========== UPDATED IMAGE PREVIEW FUNCTIONALITY ==========
            const productForm = document.getElementById('productForm');
            const submitBtn = document.getElementById('submitBtn');
            const mainImageInput = document.getElementById('mainImageInput');
            const additionalImagesInput = document.getElementById('additionalImagesInput');
            const mainImagePreview = document.getElementById('mainImagePreview');
            const additionalImagesPreview = document.getElementById('additionalImagesPreview');

            // Form submission handling
            if (productForm && submitBtn) {
                productForm.addEventListener('submit', function(e) {
                    console.log('Form submitted - preparing data');

                    // Log for debugging
                    const keepImages = document.querySelectorAll('input[name="keep_images[]"]');
                    console.log('Keep images count:', keepImages.length);
                    console.log('New images to upload:', currentFiles.length - removedFileIndices.size);

                    // Disable button and show loading
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Updating...';

                    // Form will submit normally
                });
            }

            // Main image preview (unchanged)
            if (mainImageInput && mainImagePreview) {
                mainImageInput.addEventListener('change', function(e) {
                    const file = this.files[0];
                    if (file) {
                        previewMainImage(file);
                    }
                });
            }

            // ========== UPDATED ADDITIONAL IMAGES HANDLING ==========
            // ========== FIXED ADDITIONAL IMAGES HANDLING ==========
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
          <img src="${e.target.result}" class="preview-image" alt="Additional Image Preview">
          <span class="badge bg-secondary preview-badge">New</span>
          <button type="button"
                  class="btn btn-danger btn-sm remove-preview-btn"
                  data-remove-index="${idx}">
            <i class="fas fa-times"></i>
          </button>
        </div>
      `;
                        additionalImagesPreview.appendChild(col);
                    };
                    reader.readAsDataURL(file);
                });
            }

            if (additionalImagesInput && additionalImagesPreview) {
                additionalImagesInput.addEventListener('change', function() {
                    selectedFiles = Array.from(this.files || []);
                    renderPreviews();
                    syncInputFiles();
                });

                additionalImagesPreview.addEventListener('click', function(e) {
                    const btn = e.target.closest('button[data-remove-index]');
                    if (!btn) return;

                    const idx = Number(btn.getAttribute('data-remove-index'));
                    if (Number.isNaN(idx)) return;

                    selectedFiles.splice(idx, 1);
                    syncInputFiles();
                    renderPreviews();
                });
            }

            // Clear button ke liye aapka existing onclick support
            window.clearAdditionalPreviews = function() {
                selectedFiles = [];
                if (additionalImagesInput) additionalImagesInput.value = '';
                if (additionalImagesPreview) additionalImagesPreview.innerHTML = '';
            };


            // Old preview function (keep for compatibility)
            function previewMainImage(file) {
                if (!file.type.match('image.*')) {
                    alert('Please select an image file');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    if (mainImagePreview) {
                        mainImagePreview.innerHTML = `
                        <div class="preview-image-container">
                            <img src="${e.target.result}" class="preview-image" alt="Main Image Preview">
                            <span class="badge bg-primary preview-badge">New Main</span>
                            <button type="button" class="btn btn-danger btn-sm remove-preview-btn" onclick="clearMainPreview()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `;
                    }
                };
                reader.readAsDataURL(file);
            }

            console.log('Edit page setup complete');
        });
    </script>
    @push('scripts')
        <script>
            $(document).ready(function() {
                console.log('jQuery ready - Setting up Select2');

                function formatColor(option) {
                    if (!option.id) {
                        return option.text;
                    }

                    const code = $(option.element).data('color-code');
                    if (!code) return option.text;

                    return $(`
            <span style="display:flex;align-items:center;gap:6px;">
                <span style="
                    width:14px;
                    height:14px;
                    border-radius:3px;
                    background:${code};
                    border:1px solid #ccc;
                    display:inline-block;
                "></span>
                <span>${option.text}</span>
            </span>
        `);
                }

                // Initialize Select2 for colors
                $('.select2-colors').select2({
                    theme: 'bootstrap5',
                    placeholder: 'Choose colors...',
                    width: '100%',
                    closeOnSelect: false,
                    templateResult: formatColor,
                    templateSelection: formatColor,
                    escapeMarkup: markup => markup
                });

                // Initialize Select2 for sizes
                $('.select2-sizes').select2({
                    theme: 'bootstrap5',
                    placeholder: 'Choose sizes...',
                    width: '100%',
                    closeOnSelect: false
                });

                console.log('Select2 initialized successfully');
            });
        </script>
    @endpush
@endsection
