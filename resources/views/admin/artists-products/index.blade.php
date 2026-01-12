{{-- resources/views/admin/artists-products/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Artists Products')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Artists Products Management</h6>
                        <a href="{{ route('admin.artists-products.create') }}" class="btn btn-primary btn-sm">
                            <i class="ni ni-fat-add"></i> Add Product
                        </a>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row mt-3">
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Products</p>
                                                <h5 class="font-weight-bolder">
                                                    {{ $totalProducts ?? 0 }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                                <i class="ni ni-box-2 text-lg opacity-10"></i>
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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Active Products</p>
                                                <h5 class="font-weight-bolder">
                                                    {{ $activeProducts ?? 0 }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                                <i class="ni ni-check-bold text-lg opacity-10"></i>
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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Featured Products
                                                </p>
                                                <h5 class="font-weight-bolder">
                                                    {{ $featuredProducts ?? 0 }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                                <i class="ni ni-diamond text-lg opacity-10"></i>
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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Categories</p>
                                                <h5 class="font-weight-bolder">
                                                    {{ $categories->count() ?? 0 }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                                <i class="ni ni-tag text-lg opacity-10"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Search & Filters Form -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <form action="{{ route('admin.artists-products.index') }}" method="GET" class="mb-0">
                                <div class="row g-3">

                                    {{-- Search --}}
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-search search-icon"></i>
                                            </span>
                                            <input type="text" class="form-control border-start-0" name="q"
                                                placeholder="Search product title..." value="{{ request('q') }}">
                                        </div>
                                    </div>

                                    {{-- Category --}}
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="ni ni-bullet-list-67"></i>
                                            </span>
                                            <select name="artists_category_id" class="form-select border-start-0">
                                                <option value="">All Categories</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @selected(request('artists_category_id') == $category->id)>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Artist --}}
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="ni ni-single-02"></i>
                                            </span>
                                            <select name="artist_id" class="form-select border-start-0">
                                                <option value="">All Artists</option>
                                                @foreach ($artists as $artist)
                                                    <option value="{{ $artist->id }}" @selected(request('artist_id') == $artist->id)>
                                                        {{ $artist->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="col-md-3">
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn bg-gradient-primary mb-0">
                                                <i class="fas fa-search search-icon me-1"></i> Search
                                            </button>

                                            @if (request()->hasAny(['q', 'artists_category_id', 'artist_id']))
                                                <a href="{{ route('admin.artists-products.index') }}"
                                                    class="btn bg-gradient-secondary mb-0">
                                                    <i class="ni ni-refresh me-1"></i> Reset
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <div class="card-body px-0 pt-0 pb-2">


                    @if ($products->isEmpty())
                        <div class="text-center py-5">
                            <i class="ni ni-box-2 display-1 text-muted"></i>
                            <h5 class="mt-3">No products found</h5>
                            <p class="text-muted">Start by adding your first product</p>
                            <a href="{{ route('admin.artists-products.create') }}" class="btn btn-primary mt-2">
                                <i class="ni ni-fat-add me-1"></i> Add Product
                            </a>
                        </div>
                    @else
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Product</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Category & Artist</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Price</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Reviews</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        @if ($product->main_image_url)
                                                            <img src="{{ $product->main_image_url }}"
                                                                class="avatar avatar-sm me-3"
                                                                alt="{{ $product->title }}">
                                                        @else
                                                            <div
                                                                class="avatar avatar-sm bg-gradient-dark me-3 d-flex align-items-center justify-content-center">
                                                                <i class="ni ni-album-2 text-white"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $product->title }}</h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            <code>{{ $product->slug }}</code>
                                                        </p>
                                                        @if ($product->is_featured)
                                                            <span
                                                                class="badge badge-sm bg-gradient-warning">Featured</span>
                                                        @else
                                                            <span
                                                                class="badge badge-sm bg-gradient-secondary">Regular</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <p class="text-xs font-weight-bold mb-1">
                                                        <span
                                                            class="badge bg-gradient-info">{{ $product->category->name ?? 'N/A' }}</span>
                                                    </p>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="ni ni-single-02 me-1"></i>
                                                        {{ $product->artist->name ?? 'N/A' }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-xs font-weight-bold">
                                                    ₹{{ number_format($product->price, 2) }}
                                                </span>
                                                @if ($product->sale_price)
                                                    <br>
                                                    <span class="text-xs text-danger text-decoration-line-through">
                                                        ₹{{ number_format($product->sale_price, 2) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column align-items-center">
                                                    <span class="text-xs font-weight-bold">
                                                        {{ $product->reviews_count }} reviews
                                                    </span>
                                                    <div class="rating-stars">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= floor($product->rating))
                                                                <i class="ni ni-star-fill text-warning"></i>
                                                            @elseif($i <= $product->rating)
                                                                <i class="ni ni-star-half text-warning"></i>
                                                            @else
                                                                <i class="ni ni-star text-warning"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <span
                                                        class="text-xs text-secondary">{{ number_format($product->rating, 1) }}/5</span>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($product->is_active)
                                                    <span class="badge badge-sm bg-gradient-success">Active</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-end">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <!-- View Button -->
                                                    <a href="{{ route('admin.artists-products.show', $product->id) }}"
                                                        class="btn
                                                        btn-sm btn-outline-info action-btn"
                                                        data-toggle="tooltip" data-original-title="View Details">
                                                        <i class="bi bi-eye"></i>
                                                    </a>

                                                    <!-- Edit Button -->
                                                    <a href="{{ route('admin.artists-products.edit', $product->id) }}"
                                                        class="btn btn-sm btn-outline-primary action-btn"
                                                        data-toggle="tooltip" data-original-title="Edit Product">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <a href="javascript:;"
                                                        class="btn btn-sm btn-outline-danger action-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteProductModal{{ $product->id }}"
                                                        data-toggle="tooltip" data-original-title="Delete Product">
                                                        <i class="fas fa-trash"></i>
                                                    </a>

                                                    <!-- Quick Actions Dropdown -->
                                                    <div class="dropdown dropstart">
                                                        <a href="javascript:;"
                                                            class="btn btn-sm btn-outline-secondary action-btn"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            data-toggle="tooltip" data-original-title="More Actions">
                                                            <i class="bi bi-three-dots-vertical"></i>
                                                            <!-- Bootstrap Dots Icon -->
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li>
                                                                <a class="dropdown-item d-flex align-items-center"
                                                                    href="javascript:;" data-bs-toggle="modal"
                                                                    data-bs-target="#manageImagesModal{{ $product->id }}">
                                                                    <i class="bi bi-images text-info me-2"></i>
                                                                    <span>Manage Images</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item d-flex align-items-center"
                                                                    href="javascript:;" data-bs-toggle="modal"
                                                                    data-bs-target="#manageColorsModal{{ $product->id }}">
                                                                    <i class="bi bi-palette text-success me-2"></i>
                                                                    <span>Manage Colors</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item d-flex align-items-center"
                                                                    href="javascript:;" data-bs-toggle="modal"
                                                                    data-bs-target="#manageSizesModal{{ $product->id }}">
                                                                    <i class="bi bi-rulers text-warning me-2"></i>
                                                                    <span>Manage Sizes</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item d-flex align-items-center"
                                                                    href="javascript:;" data-bs-toggle="modal"
                                                                    data-bs-target="#addReviewModal{{ $product->id }}">
                                                                    <i class="bi bi-star text-danger me-2"></i>
                                                                    <span>Add Review</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>


                                        <!-- View Product Modal -->
                                        <div class="modal fade" id="viewProductModal{{ $product->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Product Details</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                @if ($product->main_image_url)
                                                                    <img src="{{ $product->main_image_url }}"
                                                                        class="img-fluid rounded mb-3"
                                                                        alt="{{ $product->title }}">
                                                                @else
                                                                    <div class="bg-gradient-dark rounded mb-3 d-flex align-items-center justify-content-center"
                                                                        style="height: 200px;">
                                                                        <i class="ni ni-image text-white fa-3x"></i>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-8">
                                                                <h4>{{ $product->title }}</h4>
                                                                <p><strong>Slug:</strong> {{ $product->slug }}</p>
                                                                <p><strong>Category:</strong>
                                                                    {{ $product->category->name ?? 'N/A' }}</p>
                                                                <p><strong>Artist:</strong>
                                                                    {{ $product->artist->name ?? 'N/A' }}</p>
                                                                <p><strong>Price:</strong>
                                                                    ₹{{ number_format($product->price, 2) }}</p>
                                                                @if ($product->sale_price)
                                                                    <p><strong>Sale Price:</strong>
                                                                        ₹{{ number_format($product->sale_price, 2) }}
                                                                    </p>
                                                                @endif
                                                                <p><strong>Rating:</strong>
                                                                    {{ $product->rating }}/5
                                                                    ({{ $product->reviews_count }} reviews)
                                                                </p>
                                                                <p><strong>Description:</strong><br>{{ $product->description }}
                                                                </p>
                                                                @if ($product->product_details)
                                                                    <p><strong>Product
                                                                            Details:</strong><br>{{ $product->product_details }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn bg-gradient-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Confirmation Modal -->
                                        <div class="modal fade" id="deleteProductModal{{ $product->id }}"
                                            tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirm Delete</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="d-flex align-items-center mb-3">
                                                            <div class="me-3">
                                                                @if ($product->main_image_url)
                                                                    <img src="{{ $product->main_image_url }}"
                                                                        class="rounded"
                                                                        style="width: 50px; height: 50px; object-fit: cover;"
                                                                        alt="{{ $product->title }}">
                                                                @else
                                                                    <div class="avatar bg-gradient-dark rounded d-flex align-items-center justify-content-center"
                                                                        style="width: 50px; height: 50px;">
                                                                        <i class="ni ni-image text-white"></i>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0">{{ $product->title }}</h6>
                                                                <small
                                                                    class="text-muted">{{ $product->category->name ?? 'N/A' }}</small>
                                                            </div>
                                                        </div>
                                                        <p class="mb-0">Are you sure you want to delete this
                                                            product? This action cannot be undone.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn bg-gradient-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <form
                                                            action="{{ route('admin.artists-products.destroy', $product->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn bg-gradient-danger">
                                                                <i class="ni ni-fat-remove me-1"></i> Delete
                                                                Product
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Manage Images Modal -->
                                        <div class="modal fade" id="manageImagesModal{{ $product->id }}"
                                            tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Manage Images - {{ $product->title }}</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Add Additional Images Form -->
                                                        <form
                                                            action="{{ route('admin.artists-products.update', $product->id) }}"
                                                            method="POST" enctype="multipart/form-data" class="mb-4">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="update_type"
                                                                value="additional_images">
                                                            <div class="input-group input-group-outline">
                                                                <input type="file" name="images[]"
                                                                    class="form-control" accept="image/*" multiple
                                                                    required>
                                                                <button type="submit" class="btn bg-gradient-primary">
                                                                    <i class="ni ni-cloud-upload-96"></i> Upload Additional
                                                                    Images
                                                                </button>
                                                            </div>
                                                            <small class="text-muted d-block mt-1">You can select multiple
                                                                additional images</small>
                                                        </form>

                                                        <!-- Update Main Image Form -->
                                                        <form
                                                            action="{{ route('admin.artists-products.update', $product->id) }}"
                                                            method="POST" enctype="multipart/form-data" class="mb-4">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="update_type" value="main_image">
                                                            <div class="input-group input-group-outline">
                                                                <input type="file" name="main_image"
                                                                    class="form-control" accept="image/*">
                                                                <button type="submit" class="btn bg-gradient-warning">
                                                                    <i class="ni ni-settings"></i> Update Main Image
                                                                </button>
                                                            </div>
                                                            <small class="text-muted d-block mt-1">Replace the main product
                                                                image</small>
                                                        </form>

                                                        <!-- Main Image Display -->
                                                        <h6 class="mt-4 mb-2">Main Image</h6>
                                                        <div class="row mb-3">
                                                            <div class="col-md-4">
                                                                <div class="card border-0 shadow-sm">
                                                                    @if ($product->main_image_url)
                                                                        <img src="{{ $product->main_image_url }}"
                                                                            class="card-img-top"
                                                                            style="height:150px;object-fit:cover;"
                                                                            alt="Main Image">
                                                                        <div class="card-body text-center p-2">
                                                                            <small class="text-muted">Current Main
                                                                                Image</small>
                                                                        </div>
                                                                    @else
                                                                        <div class="bg-gradient-dark d-flex align-items-center justify-content-center"
                                                                            style="height:150px;">
                                                                            <i class="ni ni-image text-white fa-2x"></i>
                                                                        </div>
                                                                        <div class="card-body text-center p-2">
                                                                            <small class="text-muted">No main image
                                                                                uploaded</small>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Additional Images -->
                                                        <h6 class="mt-4 mb-2">Additional Images</h6>
                                                        @php
                                                            // Get all media for this product
                                                            $additionalImages = $product->getMedia('product_images');
                                                        @endphp

                                                        @if ($additionalImages->count() > 0)
                                                            <div class="row">
                                                                @foreach ($additionalImages as $media)
                                                                    <div class="col-md-3 mb-3">
                                                                        <div class="card border-0 shadow-sm">
                                                                            <img src="{{ $media->getUrl() }}"
                                                                                class="card-img-top"
                                                                                style="height:100px;object-fit:cover;"
                                                                                alt="Product Image">
                                                                            <div class="card-body p-2 text-center">
                                                                                <form method="POST"
                                                                                    action="{{ route('admin.artists-products.removeImage', $product->id) }}"
                                                                                    class="d-inline">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <input type="hidden" name="media_id"
                                                                                        value="{{ $media->id }}">
                                                                                    <button type="submit"
                                                                                        class="btn btn-sm btn-outline-danger"
                                                                                        onclick="return confirm('Are you sure you want to delete this image?')">
                                                                                        <i class="ni ni-fat-remove"></i>
                                                                                        Remove
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="text-muted mt-2">
                                                                Total: {{ $additionalImages->count() }} additional images
                                                            </div>
                                                        @else
                                                            <div class="alert alert-info">
                                                                <i class="ni ni-info text-info me-2"></i>
                                                                No additional images found for this product.
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn bg-gradient-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Manage Colors Modal -->
                                        <div class="modal fade" id="manageColorsModal{{ $product->id }}"
                                            tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Manage Colors - {{ $product->title }}</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Attach Existing Color Form -->
                                                        <form
                                                            action="{{ route('admin.artists-products.update', $product->id) }}"
                                                            method="POST" class="mb-4">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="update_type"
                                                                value="attach_color">
                                                            <div class="row g-2">
                                                                <div class="col-9">
                                                                    <select name="color_id" class="form-select" required>
                                                                        <option value="">Select existing color to
                                                                            attach</option>
                                                                        @php
                                                                            $allColors = App\Models\Color::orderBy(
                                                                                'name',
                                                                            )->get();
                                                                            $existingColorIds = $product->colors
                                                                                ->pluck('id')
                                                                                ->toArray();
                                                                        @endphp
                                                                        @foreach ($allColors as $color)
                                                                            @if (!in_array($color->id, $existingColorIds))
                                                                                <option value="{{ $color->id }}">
                                                                                    {{ $color->name }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-3">
                                                                    <button type="submit"
                                                                        class="btn bg-gradient-primary w-100">
                                                                        <i class="ni ni-check-bold"></i> Attach
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted d-block mt-1">Attach an existing color
                                                                to this product</small>
                                                        </form>

                                                        <!-- Existing Colors -->
                                                        <h6 class="mt-4 mb-2">Assigned Colors</h6>
                                                        @if ($product->colors->count() > 0)
                                                            <div class="d-flex flex-wrap gap-2">
                                                                @foreach ($product->colors as $color)
                                                                    <div
                                                                        class="d-flex align-items-center bg-light p-2 rounded border">
                                                                        @if ($color->code)
                                                                            <span class="color-badge me-2"
                                                                                style="width:20px;height:20px;background:{{ $color->code }};border-radius:3px;border:1px solid #ccc;"></span>
                                                                        @endif
                                                                        <span class="me-2">{{ $color->name }}</span>
                                                                        <form
                                                                            action="{{ route('admin.artists-products.update', $product->id) }}"
                                                                            method="POST" class="d-inline">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <input type="hidden" name="update_type"
                                                                                value="detach_color">
                                                                            <input type="hidden" name="color_id"
                                                                                value="{{ $color->id }}">
                                                                            <button type="submit"
                                                                                class="btn btn-sm btn-outline-danger p-0 px-1"
                                                                                onclick="return confirm('Remove this color from product?')">
                                                                                <i class="ni ni-fat-remove"></i>
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="text-muted mt-2">
                                                                Total: {{ $product->colors->count() }} colors assigned
                                                            </div>
                                                        @else
                                                            <div class="alert alert-info">
                                                                <i class="ni ni-info text-info me-2"></i>
                                                                No colors assigned to this product.
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn bg-gradient-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Manage Sizes Modal -->
                                        <div class="modal fade" id="manageSizesModal{{ $product->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Manage Sizes - {{ $product->title }}</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Attach Existing Size Form -->
                                                        <form
                                                            action="{{ route('admin.artists-products.update', $product->id) }}"
                                                            method="POST" class="mb-4">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="update_type" value="attach_size">
                                                            <div class="row g-2">
                                                                <div class="col-9">
                                                                    <select name="size_id" class="form-select" required>
                                                                        <option value="">Select existing size to
                                                                            attach</option>
                                                                        @php
                                                                            $allSizes = App\Models\Size::orderBy(
                                                                                'code',
                                                                            )->get();
                                                                            $existingSizeIds = $product->sizes
                                                                                ->pluck('id')
                                                                                ->toArray();
                                                                        @endphp
                                                                        @foreach ($allSizes as $size)
                                                                            @if (!in_array($size->id, $existingSizeIds))
                                                                                <option value="{{ $size->id }}">
                                                                                    {{ $size->code }} -
                                                                                    {{ $size->name }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-3">
                                                                    <button type="submit"
                                                                        class="btn bg-gradient-primary w-100">
                                                                        <i class="ni ni-check-bold"></i> Attach
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted d-block mt-1">Attach an existing size
                                                                to this product</small>
                                                        </form>

                                                        <!-- Existing Sizes -->
                                                        <h6 class="mt-4 mb-2">Assigned Sizes</h6>
                                                        @if ($product->sizes->count() > 0)
                                                            <div class="d-flex flex-wrap gap-2">
                                                                @foreach ($product->sizes as $size)
                                                                    <div
                                                                        class="d-flex align-items-center bg-light p-2 rounded border">
                                                                        <span class="me-2">{{ $size->code }} -
                                                                            {{ $size->name }}</span>
                                                                        <form
                                                                            action="{{ route('admin.artists-products.update', $product->id) }}"
                                                                            method="POST" class="d-inline">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <input type="hidden" name="update_type"
                                                                                value="detach_size">
                                                                            <input type="hidden" name="size_id"
                                                                                value="{{ $size->id }}">
                                                                            <button type="submit"
                                                                                class="btn btn-sm btn-outline-danger p-0 px-1"
                                                                                onclick="return confirm('Remove this size from product?')">
                                                                                <i class="ni ni-fat-remove"></i>
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="text-muted mt-2">
                                                                Total: {{ $product->sizes->count() }} sizes assigned
                                                            </div>
                                                        @else
                                                            <div class="alert alert-info">
                                                                <i class="ni ni-info text-info me-2"></i>
                                                                No sizes assigned to this product.
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn bg-gradient-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Add Review Modal (This one is already working fine) -->
                                        <div class="modal fade" id="addReviewModal{{ $product->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form
                                                        action="{{ route('admin.products.reviews.store', $product->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Add Review for {{ $product->title }}
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-control-label">User Name *</label>
                                                                <input type="text" name="user_name"
                                                                    class="form-control" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-control-label">Rating *</label>
                                                                <select name="rating" class="form-select" required>
                                                                    <option value="">Select Rating</option>
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <option value="{{ $i }}">
                                                                            {{ $i }}
                                                                            Star{{ $i > 1 ? 's' : '' }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-control-label">Title *</label>
                                                                <input type="text" name="title" class="form-control"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-control-label">Review *</label>
                                                                <textarea name="review" class="form-control" rows="3" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn bg-gradient-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn bg-gradient-primary">Add
                                                                Review</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @include('admin.partials.pagination', ['items' => $products])

                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Card -->
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Quick Actions</h6>
                </div>
                <div class="card-body p-0 pt-3">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin.artists-products.create') }}"
                            class="list-group-item list-group-item-action d-flex align-items-center border-0">
                            <div
                                class="icon icon-shape icon-sm bg-gradient-primary shadow text-center border-radius-md me-3">
                                <i class="ni ni-fat-add text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-sm">Add New Product</h6>
                                <small class="text-muted">Create a new product</small>
                            </div>
                        </a>
                        <a href="{{ route('admin.artists-categories.index') }}"
                            class="list-group-item list-group-item-action d-flex align-items-center border-0">
                            <div
                                class="icon icon-shape icon-sm bg-gradient-success shadow text-center border-radius-md me-3">
                                <i class="ni ni-tag text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-sm">Manage Categories</h6>
                                <small class="text-muted">Add/Edit categories</small>
                            </div>
                        </a>
                        <a href="{{ route('admin.artists.index') }}"
                            class="list-group-item list-group-item-action d-flex align-items-center border-0">
                            <div class="icon icon-shape icon-sm bg-gradient-info shadow text-center border-radius-md me-3">
                                <i class="ni ni-single-02 text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-sm">Manage Artists</h6>
                                <small class="text-muted">View/Edit artists</small>
                            </div>
                        </a>
                        <a href="#"
                            class="list-group-item list-group-item-action d-flex align-items-center border-0">
                            <div
                                class="icon icon-shape icon-sm bg-gradient-warning shadow text-center border-radius-md me-3">
                                <i class="ni ni-chart-bar-32 text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-sm">Product Reports</h6>
                                <small class="text-muted">View sales & analytics</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Recent Products</h6>
                    <small><a href="javascript:;">View All</a></small>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Artist
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Added
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentProducts ?? [] as $recent)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                @if ($recent->main_image_url)
                                                    <img src="{{ $recent->main_image_url }}"
                                                        class="avatar avatar-sm me-3" alt="{{ $recent->title }}">
                                                @else
                                                    <div
                                                        class="avatar avatar-sm bg-gradient-dark me-3 d-flex align-items-center justify-content-center">
                                                        <i class="ni ni-image text-white"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ Str::limit($recent->title, 20) }}</h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    {{ $recent->category->name ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            <i class="ni ni-single-02 text-primary me-1"></i>
                                            {{ $recent->artist->name ?? 'N/A' }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            ₹{{ number_format($recent->price, 2) }}
                                        </p>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $recent->created_at->diffForHumans() }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });

            document.querySelector('input[name="q"]')?.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    this.form.submit();
                }
            });

            // Fix dropdown positioning and scroll issues
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize tooltips
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });

                // Handle dropdown show event
                document.querySelectorAll('.dropdown-toggle').forEach(function(dropdownToggle) {
                    dropdownToggle.addEventListener('show.bs.dropdown', function(e) {
                        // Prevent body scroll
                        document.body.classList.add('dropdown-open');

                        // Get dropdown menu
                        var dropdownMenu = this.nextElementSibling;

                        // Calculate position
                        var rect = this.getBoundingClientRect();
                        var windowHeight = window.innerHeight;
                        var menuHeight = dropdownMenu.offsetHeight;

                        // If dropdown would go off screen, adjust position
                        if (rect.bottom + menuHeight > windowHeight) {
                            dropdownMenu.classList.add('dropdown-menu-end');
                            dropdownMenu.style.top = 'auto';
                            dropdownMenu.style.bottom = '100%';
                            dropdownMenu.style.marginTop = '0';
                            dropdownMenu.style.marginBottom = '5px';
                        }
                    });

                    dropdownToggle.addEventListener('hidden.bs.dropdown', function(e) {
                        // Restore body scroll
                        document.body.classList.remove('dropdown-open');

                        // Reset dropdown position
                        var dropdownMenu = this.nextElementSibling;
                        dropdownMenu.classList.remove('dropdown-menu-end');
                        dropdownMenu.style.top = '';
                        dropdownMenu.style.bottom = '';
                        dropdownMenu.style.marginTop = '';
                        dropdownMenu.style.marginBottom = '';
                    });
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.dropdown')) {
                        document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                            var dropdown = menu.closest('.dropdown');
                            if (dropdown) {
                                var toggle = dropdown.querySelector('.dropdown-toggle');
                                if (toggle) {
                                    bootstrap.Dropdown.getInstance(toggle)?.hide();
                                }
                            }
                        });
                    }
                });

                // Fix for modal backdrop issue
                document.addEventListener('show.bs.modal', function() {
                    document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                        var dropdown = menu.closest('.dropdown');
                        if (dropdown) {
                            var toggle = dropdown.querySelector('.dropdown-toggle');
                            if (toggle) {
                                bootstrap.Dropdown.getInstance(toggle)?.hide();
                            }
                        }
                    });
                });
            });

            // Handle AJAX form submission for color and size creation
            document.addEventListener('DOMContentLoaded', function() {
                // Color form submission
                @foreach ($products as $product)
                    const colorForm{{ $product->id }} = document.getElementById('addColorForm{{ $product->id }}');
                    if (colorForm{{ $product->id }}) {
                        colorForm{{ $product->id }}.addEventListener('submit', function(e) {
                            e.preventDefault();

                            const formData = new FormData(this);
                            const submitBtn = this.querySelector('button[type="submit"]');
                            const originalText = submitBtn.innerHTML;

                            submitBtn.disabled = true;
                            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

                            // Add proper headers for form submission
                            fetch('{{ route('admin.artists-products.colors.store') }}', {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        showSuccessToast(data.message || 'Color added successfully!');
                                        // Small delay before reloading to show toast
                                        setTimeout(() => {
                                            location.reload();
                                        }, 1500);
                                    } else {
                                        showErrorToast(data.message || 'Failed to add color');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    showErrorToast('Failed to add color. Please try again.');
                                })
                                .finally(() => {
                                    submitBtn.disabled = false;
                                    submitBtn.innerHTML = originalText;
                                });
                        });
                    }

                    // Size form submission
                    const sizeForm{{ $product->id }} = document.getElementById('addSizeForm{{ $product->id }}');
                    if (sizeForm{{ $product->id }}) {
                        sizeForm{{ $product->id }}.addEventListener('submit', function(e) {
                            e.preventDefault();

                            const formData = new FormData(this);
                            const submitBtn = this.querySelector('button[type="submit"]');
                            const originalText = submitBtn.innerHTML;

                            submitBtn.disabled = true;
                            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

                            // Add proper headers for form submission
                            fetch('{{ route('admin.sizes.store') }}', {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        showSuccessToast(data.message || 'Size added successfully!');
                                        // Small delay before reloading to show toast
                                        setTimeout(() => {
                                            location.reload();
                                        }, 1500);
                                    } else {
                                        showErrorToast(data.message || 'Failed to add size');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    showErrorToast('Failed to add size. Please try again.');
                                })
                                .finally(() => {
                                    submitBtn.disabled = false;
                                    submitBtn.innerHTML = originalText;
                                });
                        });
                    }
                @endforeach

                // Success/Error toast functions
                function showSuccessToast(message) {
                    if (typeof toastr !== 'undefined') {
                        toastr.success(message);
                    } else {
                        alert(message);
                    }
                }

                function showErrorToast(message) {
                    if (typeof toastr !== 'undefined') {
                        toastr.error(message);
                    } else {
                        alert(message);
                    }
                }
            });
        </script>
    @endpush
@endsection
