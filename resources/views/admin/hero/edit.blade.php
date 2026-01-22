@extends('layouts.app')

@section('title', 'Edit Hero Section')
@section('content')
    <div class="container-fluid px-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="m-0 font-weight-bold">Edit Hero Section</h6>
                            <p class="text-sm mb-0 text-muted">Update the homepage hero section content</p>
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

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

                        <form method="POST" action="{{ route('admin.hero.update') }}" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                {{-- Subtitle Field --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label mb-1">Subtitle</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-heading"></i>
                                            </span>
                                            <input type="text" name="subtitle" class="form-control border-start-0"
                                                value="{{ old('subtitle', $hero->subtitle) }}"
                                                placeholder="e.g., THE BIG COME UP">
                                        </div>
                                        <div class="form-text text-muted">
                                            Small text above the main title
                                        </div>
                                    </div>
                                </div>

                                {{-- Main Title Field --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label mb-1">Main Title <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-text-height"></i>
                                            </span>
                                            <input type="text" name="title" class="form-control border-start-0"
                                                value="{{ old('title', $hero->title) }}"
                                                placeholder="e.g., The World's Biggest DJ, Artist & Music Competition Platform"
                                                required>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide a main title.
                                        </div>
                                    </div>
                                </div>

                                {{-- Description Field with CKEditor --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label mb-1">Description <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            {{-- <span class="input-group-text align-items-start pt-3">
                                                <i class="fas fa-align-left"></i>
                                            </span> --}}
                                            <textarea name="description" class="form-control border-start-0" id="description" rows="6" required
                                                placeholder="Enter detailed description for the hero section">{{ old('description', $hero->description) }}</textarea>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide a description.
                                        </div>
                                    </div>
                                </div>

                                {{-- Primary Button Text --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label mb-1">Primary Button Text</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-mouse-pointer"></i>

                                            </span>
                                            <input type="text" name="primary_btn_text"
                                                class="form-control border-start-0"
                                                value="{{ old('primary_btn_text', $hero->primary_btn_text) }}"
                                                placeholder="e.g., Sign Up Now">
                                        </div>
                                        <div class="form-text text-muted">
                                            Leave empty to hide button
                                        </div>
                                    </div>
                                </div>

                                {{-- Primary Button Link --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label mb-1">Primary Button Link</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-link"></i>
                                            </span>
                                            <input type="text" name="primary_btn_link"
                                                class="form-control border-start-0"
                                                value="{{ old('primary_btn_link', $hero->primary_btn_link) }}"
                                                placeholder="e.g., /register or #">
                                        </div>
                                        <div class="form-text text-muted">
                                            Use absolute or relative URL
                                        </div>
                                    </div>
                                </div>

                                {{-- Secondary Button Text --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label mb-1">Secondary Button Text</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-mouse-pointer"></i>

                                            </span>
                                            <input type="text" name="secondary_btn_text"
                                                class="form-control border-start-0"
                                                value="{{ old('secondary_btn_text', $hero->secondary_btn_text) }}"
                                                placeholder="e.g., Watch Videos">
                                        </div>
                                        <div class="form-text text-muted">
                                            Leave empty to hide button
                                        </div>
                                    </div>
                                </div>

                                {{-- Secondary Button Link --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label mb-1">Secondary Button Link</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-link"></i>
                                            </span>
                                            <input type="text" name="secondary_btn_link"
                                                class="form-control border-start-0"
                                                value="{{ old('secondary_btn_link', $hero->secondary_btn_link) }}"
                                                placeholder="e.g., /videos or #">
                                        </div>
                                        <div class="form-text text-muted">
                                            Use absolute or relative URL
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-top">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Update Hero Section
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CKEditor 5 --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
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

            // Initialize CKEditor
            ClassicEditor
                .create(document.querySelector('#description'), {
                    toolbar: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'undo',
                        'redo'
                    ],
                    placeholder: 'Enter description here...',
                    height: '200px'
                })
                .then(editor => {
                    window.editor = editor;

                    // Update form validation when editor content changes
                    editor.model.document.on('change:data', () => {
                        const descriptionInput = document.querySelector('textarea[name="description"]');
                        if (descriptionInput) {
                            descriptionInput.value = editor.getData();

                            // Trigger validation
                            if (descriptionInput.value.trim() === '') {
                                descriptionInput.setCustomValidity('Please provide a description.');
                            } else {
                                descriptionInput.setCustomValidity('');
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error(error);
                });

            // Character count for title
            const titleInput = document.querySelector('input[name="title"]');
            const titleCounter = document.createElement('small');
            titleCounter.className = 'form-text text-muted d-flex justify-content-end mt-1';
            titleInput.parentNode.parentNode.appendChild(titleCounter);

            titleInput.addEventListener('input', function() {
                const maxLength = 255;
                const currentLength = this.value.length;
                titleCounter.textContent = `${currentLength}/${maxLength} characters`;

                if (currentLength > maxLength) {
                    titleCounter.classList.add('text-danger');
                    this.classList.add('is-invalid');
                } else {
                    titleCounter.classList.remove('text-danger');
                    this.classList.remove('is-invalid');
                }
            });

            // Real-time validation
            const inputs = document.querySelectorAll('input[required], textarea[required]');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    validateField(this);
                });

                input.addEventListener('input', function() {
                    if (this.classList.contains('is-invalid')) {
                        validateField(this);
                    }
                });
            });

            function validateField(field) {
                if (field.value.trim() === '') {
                    field.classList.add('is-invalid');
                    field.classList.remove('is-valid');
                } else {
                    field.classList.remove('is-invalid');
                    field.classList.add('is-valid');
                }
            }

            // Validate required fields on page load if they have values
            inputs.forEach(input => {
                if (input.value.trim() !== '') {
                    input.classList.add('is-valid');
                }
            });
        });
    </script>


@endsection
