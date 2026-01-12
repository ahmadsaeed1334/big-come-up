{{-- resources/views/admin/artists-products/show.blade.php --}}
@extends('layouts.app')

@section('title', $title)

@section('content')

    <!-- Header with Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-3 p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Product Details</h6>
                            <p class="text-sm mb-0">View detailed information about {{ $product->title }}</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.artists-products.edit', $product) }}"
                                class="btn btn-primary btn-sm mb-0">
                                <i class="bi bi-pencil me-1"></i> Edit Product
                            </a>
                            <a href="{{ route('admin.artists-products.index') }}"
                                class="btn btn-outline-secondary btn-sm mb-0">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Price</p>
                                <h5 class="font-weight-bolder">
                                    ${{ number_format($product->price, 2) }}
                                </h5>
                                <p class="mb-0">
                                    @if ($product->sale_price)
                                        <span
                                            class="text-success text-sm font-weight-bolder">${{ number_format($product->sale_price, 2) }}</span>
                                        sale
                                    @else
                                        <span class="text-muted text-sm">Regular</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
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
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Rating</p>
                                <h5 class="font-weight-bolder">
                                    {{ $product->rating ?? 'N/A' }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">
                                        {{ $product->reviews_count }} reviews
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="ni ni-satisfied text-lg opacity-10" aria-hidden="true"></i>
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
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Gallery</p>
                                <h5 class="font-weight-bolder">
                                    {{ $product->getMedia('product_images')->count() }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">Images</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                <i class="ni ni-image text-lg opacity-10" aria-hidden="true"></i>
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
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Status</p>
                                <h5 class="font-weight-bolder">
                                    @if ($product->is_active)
                                        Active
                                    @else
                                        Inactive
                                    @endif
                                </h5>
                                <p class="mb-0">
                                    @if ($product->is_featured)
                                        <span class="text-warning text-sm font-weight-bolder">Featured</span>
                                    @else
                                        <span class="text-muted text-sm">Regular</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Left Column: Product Information -->
        <div class="col-lg-4">
            <!-- Product Card -->
            <div class="card">
                <div class="card-body p-3">
                    <div class="text-center">
                        <!-- Main Image -->
                        <div class="mb-4">
                            @php
                                $mainImage = $product->getFirstMediaUrl('main_image');
                            @endphp
                            <img src="{{ $mainImage ?: 'https://via.placeholder.com/300x300?text=No+Image' }}"
                                alt="{{ $product->title }}" class="img-fluid rounded border"
                                style="width: 100%; max-width: 300px; height: 300px; object-fit: cover;">
                        </div>

                        <!-- Title -->
                        <h3 class="h4 mb-1">{{ $product->title }}</h3>
                        <p class="text-muted mb-3">{{ $product->category->name ?? 'Uncategorized' }}</p>

                        <!-- Artist Info -->
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <i class="ni ni-single-02 text-primary me-2"></i>
                            <span>{{ $product->artist->name ?? 'Unknown Artist' }}</span>
                        </div>

                        <!-- Price Info -->
                        <div class="mb-4">
                            <h4 class="text-primary mb-0">${{ number_format($product->price, 2) }}</h4>
                            @if ($product->sale_price)
                                <p class="text-sm text-muted mb-0">
                                    <del>${{ number_format($product->price, 2) }}</del>
                                    <span class="text-success ms-2">${{ number_format($product->sale_price, 2) }}</span>
                                </p>
                            @endif
                        </div>

                        <!-- Status Badges -->
                        <div class="mb-4">
                            @if ($product->is_active)
                                <span class="badge bg-gradient-success">
                                    <i class="ni ni-check-bold me-1"></i> Active
                                </span>
                            @else
                                <span class="badge bg-gradient-secondary">
                                    <i class="ni ni-fat-remove me-1"></i> Inactive
                                </span>
                            @endif

                            @if ($product->is_featured)
                                <span class="badge bg-gradient-warning">
                                    <i class="ni ni-favourite-28 me-1"></i> Featured
                                </span>
                            @endif
                        </div>

                        <!-- Description -->
                        <div class="text-start mb-4">
                            <h6 class="text-primary mb-2">Description</h6>
                            <p class="text-sm text-muted">{{ $product->description }}</p>
                        </div>

                        <!-- Colors -->
                        @if ($product->colors->count() > 0)
                            <div class="text-start mb-4">
                                <h6 class="text-primary mb-2">Available Colors</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($product->colors as $color)
                                        <span class="badge"
                                            style="background-color: {{ $color->code }}; color: #fff; padding: 8px 12px;">
                                            {{ $color->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Sizes -->
                        @if ($product->sizes->count() > 0)
                            <div class="text-start">
                                <h6 class="text-primary mb-2">Available Sizes</h6>
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach ($product->sizes as $size)
                                        <span class="badge bg-gradient-dark">{{ $size->code }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer pt-0">
                    <hr class="horizontal dark mb-3">
                    <small class="text-muted text-sm">
                        Created: {{ $product->created_at->format('M d, Y') }} |
                        Updated: {{ $product->updated_at->format('M d, Y') }}
                    </small>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mt-4">
                <div class="card-header pb-3 p-3">
                    <h6 class="mb-0">Quick Actions</h6>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                    <i class="ni ni-single-copy-04 text-white opacity-10"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Edit Product</h6>
                                    <span class="text-xs">Update product information</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('admin.artists-products.edit', $product->id) }}"
                                    class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                                    <i class="ni ni-bold-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                    <i class="ni ni-archive-2 text-white opacity-10"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Delete Product</h6>
                                    <span class="text-xs">Remove permanently</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <button type="button"
                                    class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="ni ni-bold-right" aria-hidden="true"></i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Right Column: Detailed Information -->
        <div class="col-lg-8">
            <!-- Product Details -->
            @if ($product->product_details)
                <div class="card mb-4">
                    <div class="card-header pb-3 p-3">
                        <h6 class="mb-0">Product Details</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="text-sm">
                            {!! nl2br(e($product->product_details)) !!}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Product Gallery -->
            @if ($product->getMedia('product_images')->count() > 0)
                <div class="card mb-4">
                    <div class="card-header pb-3 p-3 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Product Gallery</h6>
                        <span class="badge bg-gradient-primary">{{ $product->getMedia('product_images')->count() }}
                            Images</span>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3">
                            @foreach ($product->getMedia('product_images') as $image)
                                <div class="col-md-4 col-6">
                                    <div class="position-relative">
                                        <img src="{{ $image->getUrl() }}" alt="{{ $product->title }}"
                                            class="img-fluid rounded"
                                            style="width: 100%; height: 200px; object-fit: cover;">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Category & Artist Info -->
            <div class="card mb-4">
                <div class="card-header pb-3 p-3">
                    <h6 class="mb-0">Category & Artist Information</h6>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <div class="icon icon-shape icon-sm me-3 bg-gradient-primary shadow text-center">
                                    <i class="ni ni-folder-17 text-white opacity-10"></i>
                                </div>
                                <div>
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">Category</p>
                                    <h6 class="text-sm mb-0">{{ $product->category->name ?? 'N/A' }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <div class="icon icon-shape icon-sm me-3 bg-gradient-info shadow text-center">
                                    <i class="ni ni-single-02 text-white opacity-10"></i>
                                </div>
                                <div>
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">Artist</p>
                                    <h6 class="text-sm mb-0">{{ $product->artist->name ?? 'N/A' }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Specifications -->
            <div class="card">
                <div class="card-header pb-3 p-3">
                    <h6 class="mb-0">Product Specifications</h6>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <tbody>
                                <tr>
                                    <td class="w-30">
                                        <p class="text-xs font-weight-bold mb-0">SKU / Slug:</p>
                                    </td>
                                    <td>
                                        <p class="text-sm mb-0">{{ $product->slug }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-30">
                                        <p class="text-xs font-weight-bold mb-0">Price:</p>
                                    </td>
                                    <td>
                                        <p class="text-sm mb-0">${{ number_format($product->price, 2) }}</p>
                                    </td>
                                </tr>
                                @if ($product->sale_price)
                                    <tr>
                                        <td class="w-30">
                                            <p class="text-xs font-weight-bold mb-0">Sale Price:</p>
                                        </td>
                                        <td>
                                            <p class="text-sm mb-0 text-success">
                                                ${{ number_format($product->sale_price, 2) }}</p>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="w-30">
                                        <p class="text-xs font-weight-bold mb-0">Rating:</p>
                                    </td>
                                    <td>
                                        <p class="text-sm mb-0">{{ $product->rating ?? 'Not rated' }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-30">
                                        <p class="text-xs font-weight-bold mb-0">Reviews:</p>
                                    </td>
                                    <td>
                                        <p class="text-sm mb-0">{{ $product->reviews_count }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-30">
                                        <p class="text-xs font-weight-bold mb-0">Colors Available:</p>
                                    </td>
                                    <td>
                                        <p class="text-sm mb-0">{{ $product->colors->count() }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-30">
                                        <p class="text-xs font-weight-bold mb-0">Sizes Available:</p>
                                    </td>
                                    <td>
                                        <p class="text-sm mb-0">{{ $product->sizes->count() }}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Timeline Activity -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-3 p-3">
                    <h6 class="mb-0">Timeline Activity</h6>
                </div>
                <div class="card-body p-3">
                    <div class="timeline timeline-one-side">
                        <!-- Created -->
                        <div class="timeline-block mb-3">
                            <span class="timeline-step bg-gradient-primary">
                                <i class="ni ni-bag-17 text-white"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Product Created</h6>
                                <p class="text-secondary text-xs mt-1 mb-0">{{ $product->created_at->diffForHumans() }}
                                </p>
                                <p class="text-sm mt-3 mb-2">Product was added to the system</p>
                            </div>
                        </div>

                        <!-- Last Updated -->
                        @if ($product->created_at != $product->updated_at)
                            <div class="timeline-block mb-3">
                                <span class="timeline-step bg-gradient-success">
                                    <i class="ni ni-curved-next text-white"></i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Product Updated</h6>
                                    <p class="text-secondary text-xs mt-1 mb-0">
                                        {{ $product->updated_at->diffForHumans() }}</p>
                                    <p class="text-sm mt-3 mb-2">Product information was last updated</p>
                                </div>
                            </div>
                        @endif

                        <!-- Gallery Images -->
                        @if ($product->getMedia('product_images')->count() > 0)
                            <div class="timeline-block">
                                <span class="timeline-step bg-gradient-info">
                                    <i class="ni ni-image text-white"></i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Gallery Images</h6>
                                    <p class="text-secondary text-xs mt-1 mb-0">
                                        {{ $product->getMedia('product_images')->count() }} images</p>
                                    <p class="text-sm mt-3 mb-2">Product gallery contains
                                        {{ $product->getMedia('product_images')->count() }} images</p>
                                </div>
                            </div>
                        @endif
                    </div>
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
                    <div class="d-flex align-items-center mb-3">
                        @php
                            $mainImage = $product->getFirstMediaUrl('main_image');
                        @endphp
                        <div class="avatar me-3">
                            <img src="{{ $mainImage ?: 'https://via.placeholder.com/50' }}" alt="{{ $product->title }}"
                                class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                        </div>
                        <div>
                            <h6 class="mb-0">{{ $product->title }}</h6>
                            <small class="text-muted">{{ $product->category->name ?? 'Uncategorized' }}</small>
                        </div>
                    </div>
                    <div class="alert bg-gradient-danger">
                        <i class="ni ni-notification-70 text-white me-2"></i>
                        <span class="text-white"><strong>Warning:</strong> This action cannot be undone. The following will
                            be deleted:</span>
                        <ul class="mb-0 mt-2 text-white">
                            <li>Product information</li>
                            <li>Main image</li>
                            <li>{{ $product->getMedia('product_images')->count() }} gallery images</li>
                            <li>{{ $product->colors->count() }} color associations</li>
                            <li>{{ $product->sizes->count() }} size associations</li>
                        </ul>
                    </div>
                    <p class="mb-0">Are you sure you want to delete this product?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary mb-0" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.artists-products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn bg-gradient-danger mb-0">
                            <i class="ni ni-fat-remove me-1"></i> Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Delete confirmation with SweetAlert
            document.addEventListener('DOMContentLoaded', function() {
                const deleteForm = document.querySelector('#deleteModal form');
                if (deleteForm) {
                    deleteForm.addEventListener('submit', function(e) {
                        e.preventDefault();

                        Swal.fire({
                            title: 'Are you sure?',
                            html: `<div class="text-start">
                    <p>You are about to delete <strong>"{{ $product->title }}"</strong> permanently.</p>
                    <div class="alert bg-gradient-danger text-white py-2">
                        <i class="ni ni-notification-70 me-2"></i>
                        This will delete all associated data including:
                        <ul class="mb-0 mt-1">
                            <li>{{ $product->getMedia('product_images')->count() }} gallery images</li>
                            <li>{{ $product->colors->count() }} color associations</li>
                            <li>{{ $product->sizes->count() }} size associations</li>
                        </ul>
                    </div>
                    <p class="text-danger"><strong>This action cannot be undone!</strong></p>
                </div>`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'Cancel',
                            width: '500px'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.submit();
                            }
                        });
                    });
                }
            });
        </script>
    @endpush
@endsection
