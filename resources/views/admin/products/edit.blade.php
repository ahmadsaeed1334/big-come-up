@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Edit Product</h3>
            <small class="text-muted">{{ $product->title }}</small>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Back</a>
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
            <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- Category --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">Category *</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Title --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">Title *</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ old('title', $product->title) }}" required>
                    </div>

                    {{-- Slug --}}
                    <div class="col-12 col-md-6">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="form-label mb-0">Slug</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="autoSlugToggle" checked>
                                <label class="form-check-label small" for="autoSlugToggle">Auto</label>
                            </div>
                        </div>
                        <input type="text" name="slug" id="slug" class="form-control"
                            value="{{ old('slug', $product->slug) }}">
                    </div>

                    {{-- SKU --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">SKU</label>
                        <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}">
                    </div>

                    {{-- Description --}}
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                    </div>

                    {{-- Price --}}
                    <div class="col-12 col-md-4">
                        <label class="form-label">Price *</label>
                        <input type="number" step="0.01" min="0" name="price" class="form-control"
                            value="{{ old('price', $product->price) }}" required>
                    </div>

                    {{-- Sale Price --}}
                    <div class="col-12 col-md-4">
                        <label class="form-label">Sale Price</label>
                        <input type="number" step="0.01" min="0" name="sale_price" class="form-control"
                            value="{{ old('sale_price', $product->sale_price) }}">
                    </div>

                    {{-- Stock --}}
                    <div class="col-12 col-md-4">
                        <label class="form-label">Stock</label>
                        <input type="number" min="0" name="stock" class="form-control"
                            value="{{ old('stock', $product->stock) }}">
                    </div>

                    {{-- Image Upload --}}
                    <div class="col-12 col-md-8">
                        <label class="form-label">Product Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <div class="form-text">New image upload karoge to old replace ho jayegi.</div>

                        @if ($product->image_path)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $product->image_path) }}" class="img-thumbnail"
                                    style="max-height:140px;">
                            </div>
                        @endif
                    </div>

                    {{-- Status --}}
                    <div class="col-12 col-md-4">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select" required>
                            @foreach (['draft', 'active', 'archived'] as $s)
                                <option value="{{ $s }}" @selected(old('status', $product->status) === $s)>
                                    {{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-light">Cancel</a>
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
