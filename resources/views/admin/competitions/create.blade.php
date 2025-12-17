@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Create Competition</h3>
            <small class="text-muted">Add a new competition</small>
        </div>
        <a href="{{ route('admin.competitions.index') }}" class="btn btn-outline-secondary">
            Back
        </a>
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
            <form method="POST" action="{{ route('admin.competitions.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Title *</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                            required>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="form-label mb-0">Slug</label>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="autoSlugToggle" checked>
                                <label class="form-check-label small" for="autoSlugToggle">Auto</label>
                            </div>
                        </div>

                        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}"
                            placeholder="Auto-generate from title">

                        <div class="form-text">
                            Auto ON ho to title se slug generate hoga.
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select" required>
                            @foreach (['draft', 'active', 'closed'] as $s)
                                <option value="{{ $s }}" @selected(old('status', 'draft') === $s)>
                                    {{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">Start Date</label>
                        <input type="datetime-local" name="start_date" class="form-control" value="{{ old('start_date') }}">
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">End Date</label>
                        <input type="datetime-local" name="end_date" class="form-control" value="{{ old('end_date') }}">
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">Entry Fee</label>
                        <input type="number" step="0.01" min="0" name="entry_fee" class="form-control"
                            value="{{ old('entry_fee', 0) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Rules</label>
                        <textarea name="rules" class="form-control" rows="4">{{ old('rules') }}</textarea>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.competitions.index') }}" class="btn btn-light">
                        Cancel
                    </a>
                    <button class="btn btn-primary">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const title = document.getElementById('title');
            const slug = document.getElementById('slug');
            const autoToggle = document.getElementById('autoSlugToggle');

            const slugify = (text) => {
                return (text || '')
                    .toString()
                    .toLowerCase()
                    .trim()
                    .replace(/&/g, 'and')
                    .replace(/[\s\W-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
            };

            const syncSlug = () => {
                if (!autoToggle.checked) return;
                slug.value = slugify(title.value);
            };

            // initial fill if slug empty
            if (!slug.value && title.value) syncSlug();

            title.addEventListener('input', syncSlug);

            autoToggle.addEventListener('change', () => {
                if (autoToggle.checked) syncSlug();
            });
        });
    </script>
@endsection
