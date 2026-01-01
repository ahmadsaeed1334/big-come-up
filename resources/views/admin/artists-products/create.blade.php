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

        /* .select2-container--bootstrap5 .select2-results__option--selected {
                                                        background-color: #0d6efd !important;
                                                    } */

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
    </style>


    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Add New Product</h3>
            <small class="text-muted">Create a new artist product</small>
        </div>
        <a href="{{ route('admin.artists-products.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Products
        </a>
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
            <form action="{{ route('admin.artists-products.store') }}" method="POST" enctype="multipart/form-data"
                id="productForm">
                @csrf

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
                                            value="{{ old('title') }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Slug (Auto-generated)</label>
                                        <input type="text" class="form-control bg-light" readonly>
                                        <small class="text-muted">Will be automatically generated from title</small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Category *</label>
                                        <select name="artists_category_id"
                                            class="form-select @error('artists_category_id') is-invalid @enderror" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('artists_category_id') == $category->id ? 'selected' : '' }}>
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
                                                    {{ old('artist_id') == $artist->id ? 'selected' : '' }}>
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
                                            value="{{ old('price') }}" required min="0">
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Sale Price (₹)</label>
                                        <input type="number" step="0.01" name="sale_price"
                                            class="form-control @error('sale_price') is-invalid @enderror"
                                            value="{{ old('sale_price') }}" min="0">
                                        @error('sale_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Initial Rating (0-5)</label>
                                        <input type="number" step="0.1" min="0" max="5" name="rating"
                                            class="form-control @error('rating') is-invalid @enderror"
                                            value="{{ old('rating', 0) }}">
                                        @error('rating')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Description *</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Product Details (Optional)</label>
                                        <textarea name="product_details" class="form-control @error('product_details') is-invalid @enderror" rows="3">{{ old('product_details') }}</textarea>
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
                                <!-- Main Image -->
                                <div class="mb-4">
                                    <label class="form-label">Main Image *</label>
                                    <div class="input-group">
                                        <input type="file" name="main_image"
                                            class="form-control @error('main_image') is-invalid @enderror"
                                            accept="image/jpeg,image/png,image/gif,image/webp" required
                                            id="mainImageInput">
                                        <button type="button" class="btn btn-outline-secondary"
                                            onclick="document.getElementById('mainImageInput').value=''">
                                            Clear
                                        </button>
                                    </div>
                                    <small class="text-muted">Primary product image (max: 5MB, JPEG, PNG, GIF,
                                        WebP)</small>
                                    @error('main_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <!-- Main Image Preview -->
                                    <div class="mt-3">
                                        <label class="form-label">Main Image Preview:</label>
                                        <div id="mainImagePreview" class="text-center">
                                            <div class="border rounded p-3 bg-light"
                                                style="height: 200px; display: flex; align-items: center; justify-content: center;">
                                                <div class="text-muted">
                                                    <i class="fas fa-image fa-3x mb-2"></i>
                                                    <p>No main image selected</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Images -->
                                <div class="mb-4">
                                    <label class="form-label">Additional Images (Optional)</label>
                                    <div class="input-group">
                                        <input type="file" name="images[]"
                                            class="form-control @error('images.*') is-invalid @enderror"
                                            accept="image/jpeg,image/png,image/gif,image/webp" multiple
                                            id="additionalImagesInput">
                                        <button type="button" class="btn btn-outline-secondary"
                                            onclick="document.getElementById('additionalImagesInput').value=''; clearAdditionalPreviews()">
                                            Clear All
                                        </button>
                                    </div>
                                    <small class="text-muted">Select multiple images for gallery view (max 5MB
                                        each)</small>
                                    @error('images.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <!-- Additional Images Preview -->
                                    <div class="mt-3">
                                        <label class="form-label">Additional Images Preview:</label>
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
                                            value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active Product
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" name="is_featured" class="form-check-input"
                                            id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Featured Product
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Variants Card - FIXED VERSION -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Product Variants</h5>
                            </div>
                            <div class="card-body">
                                <!-- Colors with Select2 - Remove "required" attribute for select -->
                                <div class="mb-3">
                                    <label class="form-label">Select Colors</label>
                                    <select name="color_ids[]"
                                        class="select2-colors @error('color_ids') is-invalid @enderror" multiple
                                        data-placeholder="Choose colors..." id="colorSelect">
                                        <!-- Remove empty option for multiple select -->
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}" data-color-code="{{ $color->code }}"
                                                {{ in_array($color->id, old('color_ids', [])) ? 'selected' : '' }}>
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
                                        <!-- Remove empty option for multiple select -->
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}"
                                                {{ in_array($size->id, old('size_ids', [])) ? 'selected' : '' }}>
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

                        <!-- Add Color Modal - Remove required attribute -->
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
                                                <!-- Remove required attribute -->
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
                                                    <!-- Remove required attribute -->
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

                        <!-- Add Size Modal - Remove required attribute -->
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
                                                <!-- Remove required attribute -->
                                                <input type="text" name="size_name" class="form-control"
                                                    id="sizeName">
                                                <div class="invalid-feedback" id="sizeNameError"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Size Code *</label>
                                                <!-- Remove required attribute -->
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
                                    <i class="fas fa-save me-2"></i> Save Product
                                </button>
                                <a href="{{ route('admin.artists-products.index') }}"
                                    class="btn btn-outline-secondary w-100">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Make sure jQuery is loaded BEFORE Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
            console.log('DOM loaded - Setting up modals');

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

                    // Reset form - Now using container div instead of form
                    const colorFormContainer = document.getElementById('colorFormContainer');
                    if (colorFormContainer) {
                        // Reset all inputs in the container
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

            // Save Color via AJAX - Updated
            const saveColorBtn = document.getElementById('saveColorBtn');
            if (saveColorBtn) {
                saveColorBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Save color button clicked');

                    const btn = this;
                    const originalText = btn.innerHTML;

                    // Get form data from inputs (not from form)
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

            // Open Size Modal - Updated
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

            // Save Size via AJAX - Updated
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

            console.log('Modal setup complete');
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productForm = document.getElementById('productForm');
            const submitBtn = document.getElementById('submitBtn');
            const mainImageInput = document.getElementById('mainImageInput');
            const additionalImagesInput = document.getElementById('additionalImagesInput');
            const mainImagePreview = document.getElementById('mainImagePreview');
            const additionalImagesPreview = document.getElementById('additionalImagesPreview');

            // Handle form submission
            productForm.addEventListener('submit', function(e) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Saving...';
            });

            // Main image preview
            if (mainImageInput) {
                mainImageInput.addEventListener('change', function(e) {
                    const file = this.files[0];
                    if (file) {
                        previewMainImage(file);
                    }
                });
            }

            function previewMainImage(file) {
                if (!file.type.match('image.*')) {
                    alert('Please select an image file');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    mainImagePreview.innerHTML = `
                <div class="preview-image-container">
                    <img src="${e.target.result}" class="preview-image" alt="Main Image Preview">
                    <span class="badge bg-primary preview-badge">Main</span>
                    <button type="button" class="btn btn-danger btn-sm remove-preview-btn" onclick="clearMainPreview()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
                };
                reader.readAsDataURL(file);
            }


            // Clear main preview
            window.clearMainPreview = function() {
                mainImageInput.value = '';
                mainImagePreview.innerHTML = `
            <div class="empty-preview">
                <i class="fas fa-image fa-3x mb-2"></i>
                <p>No main image selected</p>
            </div>
        `;
            };


            // Auto-generate slug preview
            const titleInput = document.querySelector('input[name="title"]');
            if (titleInput) {
                titleInput.addEventListener('blur', function() {
                    if (!this.value) return;

                    const slugPreview = this.value
                        .toLowerCase()
                        .replace(/[^\w\s]/gi, '')
                        .replace(/\s+/g, '-')
                        .replace(/--+/g, '-')
                        .trim();

                    const slugField = document.querySelector('input[name="slug"]');
                    if (slugField) {
                        slugField.value = slugPreview;
                    }
                });
            }

            // Show file info on selection
            function showFileInfo(input, type) {
                if (input.files.length > 0) {
                    const file = input.files[0];
                    console.log(`${type} Image Selected:`, {
                        name: file.name,
                        size: (file.size / 1024).toFixed(2) + ' KB',
                        type: file.type
                    });
                }
            }

            // ===== FIXED Additional Images (Create) =====
            let selectedAdditionalFiles = [];

            // sync selectedAdditionalFiles -> input.files
            function syncAdditionalInputFiles() {
                const dt = new DataTransfer();
                selectedAdditionalFiles.forEach(f => dt.items.add(f));
                additionalImagesInput.files = dt.files;
            }

            function renderAdditionalPreviews() {
                additionalImagesPreview.innerHTML = '';

                selectedAdditionalFiles.forEach((file, idx) => {
                    if (!file.type.match('image.*')) return;

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-6 col-md-4 col-lg-3';
                        col.innerHTML = `
        <div class="preview-image-container">
          <img src="${e.target.result}" class="preview-image" alt="Additional Image Preview">
          <span class="badge bg-secondary preview-badge">Gallery</span>
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

            // When selecting files (replace selection)
            if (additionalImagesInput) {
                additionalImagesInput.addEventListener('change', function() {
                    selectedAdditionalFiles = Array.from(this.files || []);
                    renderAdditionalPreviews();
                    syncAdditionalInputFiles();
                });
            }

            // Remove one file from selectedAdditionalFiles
            additionalImagesPreview.addEventListener('click', function(e) {
                const btn = e.target.closest('button[data-remove-index]');
                if (!btn) return;

                const idx = Number(btn.getAttribute('data-remove-index'));
                if (Number.isNaN(idx)) return;

                selectedAdditionalFiles.splice(idx, 1);
                syncAdditionalInputFiles();
                renderAdditionalPreviews();
            });

            // Clear all (your button calls clearAdditionalPreviews())
            window.clearAdditionalPreviews = function() {
                selectedAdditionalFiles = [];
                if (additionalImagesInput) additionalImagesInput.value = '';
                if (additionalImagesPreview) additionalImagesPreview.innerHTML = '';
            };

            // Debug info
            mainImageInput.addEventListener('change', () => showFileInfo(mainImageInput, 'Main'));

        });
    </script>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

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
                width: '100%'
            });

        });
    </script>
@endpush
