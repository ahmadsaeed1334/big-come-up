@extends('layouts.app')

@section('content')
    <style>
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

        /* Search box styling */
        .search-container {
            position: relative;

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
    </style>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Colors</h3>
            {{-- <small class="text-muted">Manage product sizes</small> --}}
        </div>
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createColorModal">
            <i class="fas fa-plus me-1"></i>
            Add Color
        </button>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Colors</h6>
                            <p class="text-sm mb-0 text-muted">Manage product colors</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <!-- Search Form -->
                            <form action="{{ route('admin.colors.index') }}" method="GET" class="mb-0">
                                <div class="search-container">
                                    <i class="fas fa-search search-icon"></i>
                                    <input type="text" name="search" class="form-control search-input"
                                        placeholder="Search colors by name or code..." value="{{ request('search') }}"
                                        autocomplete="off">
                                    @if (request('search'))
                                        <a href="{{ route('admin.colors.index') }}" class="clear-search">
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
                                <a href="{{ route('admin.colors.index') }}" class="text-danger ms-2">
                                    <i class="fas fa-times me-1"></i> Clear search
                                </a>
                            </p>
                            <p class="text-sm text-muted mb-0">
                                Found {{ $colors->count() }} color(s)
                            </p>
                        </div>
                    @endif

                    <div class="table-responsive p-0">
                        @if ($colors->count() > 0)
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            #
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Color</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Code
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Products</th>
                                        <th
                                            class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($colors as $index => $color)
                                        <tr>
                                            <td class="text-sm ps-4">
                                                {{ $index + 1 }}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center ps-3">
                                                    <div class="color-preview me-3"
                                                        style="width: 30px; height: 30px; border-radius: 6px; background-color: {{ $color->code ?? '#ccc' }}; border: 1px solid #dee2e6;">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-sm">
                                                    {{ $color->name }}
                                                </h6>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm bg-gradient-dark">
                                                    {{ $color->code ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="badge badge-sm {{ $color->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                    {{ $color->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="badge badge-sm bg-gradient-info">
                                                    {{ $color->products_count ?? 0 }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-end pe-4">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <button type="button" class="btn btn-sm btn-outline-primary action-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editColorModal{{ $color->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger action-btn"
                                                        onclick="confirmColorDelete({{ $color->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <form id="delete-color-{{ $color->id }}"
                                                        action="{{ route('admin.colors.destroy', $color->id) }}"
                                                        method="POST" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Edit Color Modal -->
                                        <div class="modal fade" id="editColorModal{{ $color->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('admin.colors.update', $color->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Color</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Color Name *</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-pen"></i>
                                                                    </span>
                                                                    <input type="text" name="name"
                                                                        class="form-control"
                                                                        value="{{ old('name', $color->name) }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Color Code *</label>
                                                                <div class="color-picker-section">
                                                                    <div class="color-picker-wrapper">
                                                                        <input type="color"
                                                                            class="form-control form-control-color"
                                                                            id="colorPicker{{ $color->id }}"
                                                                            value="{{ old('code', $color->code) ?? '#000000' }}">
                                                                    </div>
                                                                    <div class="hex-input-container">
                                                                        <div class="input-group">
                                                                            <span class="input-group-text">#</span>
                                                                            <input type="text" name="code"
                                                                                class="form-control color-code-input"
                                                                                id="colorCode{{ $color->id }}"
                                                                                value="{{ old('code', str_replace('#', '', $color->code)) }}"
                                                                                placeholder="FFFFFF" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <small class="text-muted mt-2 d-block">
                                                                    Click the color box to pick a color or enter hex
                                                                    code manually
                                                                </small>
                                                                <div class="mt-2">
                                                                    <div class="color-preview-large"
                                                                        id="preview{{ $color->id }}"
                                                                        style="background-color: {{ $color->code ?? '#000000' }};">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="is_active" value="1"
                                                                    id="isActive{{ $color->id }}"
                                                                    {{ $color->is_active ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="isActive{{ $color->id }}">
                                                                    Active
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Update
                                                                Color</button>
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
                                <i class="fas fa-palette fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted">
                                    @if (request('search'))
                                        No colors found for "{{ request('search') }}"
                                    @else
                                        No colors found
                                    @endif
                                </h6>
                                @if (request('search'))
                                    <a href="{{ route('admin.colors.index') }}"
                                        class="btn btn-sm btn-outline-primary mt-2">
                                        Show all colors
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                    @include('admin.partials.pagination', ['items' => $colors])

                </div>
            </div>
        </div>
    </div>

    <!-- Create Color Modal -->
    <div class="modal fade" id="createColorModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.colors.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Color</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Color Name *</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-pen"></i>
                                </span>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                    required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Color Code *</label>
                            <div class="color-picker-section">
                                <div class="color-picker-wrapper">
                                    <input type="color" class="form-control form-control-color" id="createColorPicker"
                                        value="#000000">
                                </div>
                                <div class="hex-input-container">
                                    <div class="input-group">
                                        <span class="input-group-text">#</span>
                                        <input type="text" name="code" class="form-control color-code-input"
                                            id="createColorCode" value="000000" placeholder="FFFFFF" required>
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted mt-2 d-block">
                                Click the color box to pick a color or enter hex code manually
                            </small>
                            <div class="mt-2">
                                <div class="color-preview-large" id="createPreview" style="background-color: #000000;">
                                </div>
                            </div>
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
                        <button type="submit" class="btn btn-primary">Save Color</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmColorDelete(colorId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This color will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#8392ab',
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('Deleting color ID:', colorId);
                    document.getElementById('delete-color-' + colorId).submit();
                }
            });
        }

        // Simple Color Picker Functionality
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Color page loaded');

            function syncColorPicker(pickerId, codeId, previewId) {
                console.log('Syncing:', pickerId, codeId, previewId);

                const picker = document.getElementById(pickerId);
                const codeInput = document.getElementById(codeId);
                const preview = document.getElementById(previewId);

                if (!picker || !codeInput) {
                    console.error('Elements not found:', {
                        pickerId,
                        codeId
                    });
                    return;
                }

                console.log('Picker value:', picker.value);
                console.log('Code input value:', codeInput.value);

                // Picker to Code input
                picker.addEventListener('input', function() {
                    const colorValue = this.value;
                    console.log('Picker changed to:', colorValue);
                    codeInput.value = colorValue.replace('#', '');
                    console.log('Code input updated to:', codeInput.value);
                    if (preview) {
                        preview.style.backgroundColor = colorValue;
                        console.log('Preview updated');
                    }
                });

                // Code input to Picker
                codeInput.addEventListener('input', function() {
                    let hex = this.value.trim();
                    console.log('Code input changed to:', hex);

                    if (hex && !hex.startsWith('#')) {
                        hex = '#' + hex;
                    }

                    // Validate hex
                    const hexPattern = /^#?[A-Fa-f0-9]{6}$/;
                    console.log('Hex pattern test:', hexPattern.test(hex), hex);

                    if (hexPattern.test(hex)) {
                        if (!hex.startsWith('#')) {
                            hex = '#' + hex;
                        }
                        picker.value = hex;
                        console.log('Picker updated to:', picker.value);
                        if (preview) {
                            preview.style.backgroundColor = hex;
                        }
                    }
                });

                // Initialize
                if (preview && picker.value) {
                    preview.style.backgroundColor = picker.value;
                }
            }

            // Initialize Create Modal
            console.log('Initializing create modal');
            syncColorPicker('createColorPicker', 'createColorCode', 'createPreview');

            // Initialize Edit Modals
            @foreach ($colors as $color)
                console.log('Initializing edit modal for color {{ $color->id }}');
                syncColorPicker('colorPicker{{ $color->id }}',
                    'colorCode{{ $color->id }}',
                    'preview{{ $color->id }}');
            @endforeach

            // Form submission debugging
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    console.log('Form submitting:', this.action);
                    console.log('Form data:', new FormData(this));

                    const codeInput = this.querySelector('input[name="code"]');
                    const nameInput = this.querySelector('input[name="name"]');

                    console.log('Name value:', nameInput ? nameInput.value : 'Not found');
                    console.log('Code value:', codeInput ? codeInput.value : 'Not found');

                    if (codeInput && codeInput.value) {
                        let code = codeInput.value.trim();
                        console.log('Original code:', code);

                        if (!code.startsWith('#')) {
                            code = '#' + code;
                        }

                        console.log('Processed code:', code);

                        const hexPattern = /^#[A-Fa-f0-9]{6}$/;
                        console.log('Hex validation:', hexPattern.test(code));

                        if (!hexPattern.test(code)) {
                            e.preventDefault();
                            console.log('Invalid hex code, showing error');
                            Swal.fire({
                                icon: 'error',
                                title: 'Invalid Color Code',
                                text: 'Please enter a valid 6-digit hex color code (e.g., #FF0000)'
                            });
                        }
                    }
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
