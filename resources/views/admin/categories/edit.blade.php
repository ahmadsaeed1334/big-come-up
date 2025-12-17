@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Edit Category</h3>
            <small class="text-muted">{{ $category->name }}</small>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Name *</label>
                        <input type="text" name="name" id="title" class="form-control"
                            value="{{ old('name', $category->name) }}" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="form-label mb-0">Slug</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="autoSlugToggle" checked>
                                <label class="form-check-label small" for="autoSlugToggle">Auto</label>
                            </div>
                        </div>
                        <input type="text" name="slug" id="slug" class="form-control"
                            value="{{ old('slug', $category->slug) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select" required>
                            @foreach (['active', 'inactive'] as $s)
                                <option value="{{ $s }}" @selected(old('status', $category->status) === $s)>
                                    {{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Cancel</a>
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const title = document.getElementById('title');
            const slug = document.getElementById('slug');
            const autoToggle = document.getElementById('autoSlugToggle');

            const slugify = (text) => (text || '')
                .toString().toLowerCase().trim()
                .replace(/&/g, 'and')
                .replace(/[\s\W-]+/g, '-')
                .replace(/^-+|-+$/g, '');

            const syncSlug = () => {
                if (!autoToggle.checked) return;
                slug.value = slugify(title.value);
            };

            title.addEventListener('input', syncSlug);
            autoToggle.addEventListener('change', () => {
                if (autoToggle.checked) syncSlug();
            });
        });
    </script>
@endsection
