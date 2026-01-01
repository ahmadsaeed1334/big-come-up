@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Artists Products</h3>
            <small class="text-muted">Manage products by artists</small>
        </div>
        <a href="{{ route('admin.artists-products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Product
        </a>
    </div>

    <!-- Filters Card -->
    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2" method="GET" action="{{ route('admin.artists-products.index') }}">
                <div class="col-12 col-md-4">
                    <input type="text" name="q" class="form-control" placeholder="Search product title"
                        value="{{ request('q') }}">
                </div>

                <div class="col-12 col-md-3">
                    <select name="artists_category_id" class="form-select">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('artists_category_id') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <select name="artist_id" class="form-select">
                        <option value="">All Artists</option>
                        @foreach ($artists as $artist)
                            <option value="{{ $artist->id }}" @selected(request('artist_id') == $artist->id)>
                                {{ $artist->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-1">
                    <button class="btn btn-outline-secondary w-100">Go</button>
                </div>
                <div class="col-12 col-md-1">
                    <a href="{{ route('admin.artists-products.index') }}" class="btn btn-light w-100">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Products Table Card -->
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Artist</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th class="text-end" style="width:200px;">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($products as $index => $product)
                        @php
                            $statusBadge = $product->is_active ? 'success' : 'secondary';
                            $featuredBadge = $product->is_featured ? 'warning' : 'light';
                            // Load media for this product
                            $product->loadMissing('media');
                        @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <!-- MAIN IMAGE from media library -->
                                    @if ($product->main_image_url)
                                        <img src="{{ $product->main_image_url }}" alt="{{ $product->title }}"
                                            class="rounded me-3" style="width:60px;height:60px;object-fit:cover;">
                                    @else
                                        <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center"
                                            style="width:60px;height:60px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif

                                    <div>
                                        <div class="fw-semibold">{{ $product->title }}</div>
                                        <div class="small text-muted">
                                            <code>{{ $product->slug }}</code>
                                        </div>
                                        <div class="small">
                                            <span class="badge bg-{{ $featuredBadge }} text-dark">
                                                {{ $product->is_featured ? 'Featured' : 'Regular' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $product->category->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                {{ $product->artist->name ?? 'N/A' }}
                            </td>
                            <td class="fw-semibold">
                                ₹{{ number_format($product->price, 2) }}
                                @if ($product->sale_price)
                                    <div class="small text-danger text-decoration-line-through">
                                        ₹{{ number_format($product->sale_price, 2) }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $product->reviews_count }} reviews
                                </span>
                                <div class="small text-muted">
                                    Rating: {{ $product->rating }}/5
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-{{ $statusBadge }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <!-- View Button -->
                                <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                    data-bs-target="#viewProductModal{{ $product->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <!-- Edit Button - Link to edit page -->
                                <a href="{{ route('admin.artists-products.edit', $product->id) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Delete Form -->
                                <form action="{{ route('admin.artists-products.destroy', $product->id) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                                <!-- Quick Actions Dropdown -->
                                <div class="btn-group d-inline">
                                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                        data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#manageImagesModal{{ $product->id }}">
                                                <i class="fas fa-images me-2"></i> Manage Images
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#manageColorsModal{{ $product->id }}">
                                                <i class="fas fa-palette me-2"></i> Manage Colors
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#manageSizesModal{{ $product->id }}">
                                                <i class="fas fa-ruler me-2"></i> Manage Sizes
                                            </button>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#addReviewModal{{ $product->id }}">
                                                <i class="fas fa-star me-2"></i> Add Review
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        <!-- View Product Modal -->
                        <div class="modal fade" id="viewProductModal{{ $product->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Product Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <!-- Main Image from media library -->
                                                @if ($product->main_image_url)
                                                    <img src="{{ $product->main_image_url }}"
                                                        alt="{{ $product->title }}" class="img-fluid rounded mb-3">
                                                @else
                                                    <div class="bg-light rounded mb-3 d-flex align-items-center justify-content-center"
                                                        style="height: 200px;">
                                                        <i class="fas fa-image fa-3x text-muted"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-8">
                                                <h4>{{ $product->title }}</h4>
                                                <p><strong>Slug:</strong> {{ $product->slug }}</p>
                                                <p><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</p>
                                                <p><strong>Artist:</strong> {{ $product->artist->name ?? 'N/A' }}</p>
                                                <p><strong>Price:</strong> ₹{{ number_format($product->price, 2) }}</p>
                                                @if ($product->sale_price)
                                                    <p><strong>Sale Price:</strong>
                                                        ₹{{ number_format($product->sale_price, 2) }}</p>
                                                @endif
                                                <p><strong>Rating:</strong> {{ $product->rating }}/5
                                                    ({{ $product->reviews_count }} reviews)
                                                </p>
                                                <p><strong>Description:</strong><br>{{ $product->description }}</p>
                                                @if ($product->product_details)
                                                    <p><strong>Product Details:</strong><br>{{ $product->product_details }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Manage Images Modal -->
                        <div class="modal fade" id="manageImagesModal{{ $product->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Manage Images - {{ $product->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Add Additional Images Form -->
                                        <form action="{{ route('admin.artists-products.update', $product->id) }}"
                                            method="POST" enctype="multipart/form-data" class="mb-4">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="update_type" value="additional_images">
                                            <div class="input-group">
                                                <input type="file" name="images[]" class="form-control"
                                                    accept="image/*" multiple required>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-upload"></i> Upload Additional Images
                                                </button>
                                            </div>
                                            <small class="text-muted">You can select multiple additional images</small>
                                        </form>

                                        <!-- Update Main Image Form -->
                                        <form action="{{ route('admin.artists-products.update', $product->id) }}"
                                            method="POST" enctype="multipart/form-data" class="mb-4">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="update_type" value="main_image">
                                            <div class="input-group">
                                                <input type="file" name="main_image" class="form-control"
                                                    accept="image/*">
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="fas fa-sync"></i> Update Main Image
                                                </button>
                                            </div>
                                            <small class="text-muted">Replace the main product image</small>
                                        </form>

                                        <!-- Main Image Display -->
                                        <h6>Main Image</h6>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <div class="card">
                                                    @if ($product->main_image_url)
                                                        <img src="{{ $product->main_image_url }}" class="card-img-top"
                                                            style="height:150px;object-fit:cover;" alt="Main Image">
                                                    @else
                                                        <div class="bg-light d-flex align-items-center justify-content-center"
                                                            style="height:150px;">
                                                            <i class="fas fa-image fa-2x text-muted"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Additional Images -->
                                        <h6>Additional Images</h6>
                                        @if ($product->getMedia('product_images')->count() > 0)
                                            <div class="row" id="sortable-images-{{ $product->id }}">
                                                @foreach ($product->getMedia('product_images') as $media)
                                                    <div class="col-md-3 mb-3 image-item" data-id="{{ $media->id }}">
                                                        <div class="card">
                                                            <img src="{{ $media->getUrl() }}" class="card-img-top"
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
                                                                        onclick="return confirm('Delete this image?')">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="alert alert-info">No additional images found.</div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Manage Colors Modal -->
                        <div class="modal fade" id="manageColorsModal{{ $product->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Manage Colors - {{ $product->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Add New Color and Attach to Product -->
                                        {{-- <form action="{{ route('admin.colors.store') }}" method="POST" class="mb-4"
                                            id="addColorForm{{ $product->id }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <div class="row g-2">
                                                <div class="col-5">
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Color name" required>
                                                </div>
                                                <div class="col-3">
                                                    <input type="color" name="code"
                                                        class="form-control form-control-color" value="#000000"
                                                        title="Select color">
                                                </div>
                                                <div class="col-4">
                                                    <button type="submit" class="btn btn-success w-100">
                                                        <i class="fas fa-plus"></i> Add & Attach
                                                    </button>
                                                </div>
                                            </div>
                                            <small class="text-muted">New color will be created and attached to this
                                                product</small>
                                        </form> --}}

                                        <!-- Attach Existing Color Form -->
                                        <form action="{{ route('admin.artists-products.update', $product->id) }}"
                                            method="POST" class="mb-4">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="update_type" value="attach_color">
                                            <div class="row g-2">
                                                <div class="col-9">
                                                    <select name="color_id" class="form-select" required>
                                                        <option value="">Select existing color to attach</option>
                                                        @php
                                                            $allColors = App\Models\Color::orderBy('name')->get();
                                                            $existingColorIds = $product->colors
                                                                ->pluck('id')
                                                                ->toArray();
                                                        @endphp
                                                        @foreach ($allColors as $color)
                                                            @if (!in_array($color->id, $existingColorIds))
                                                                <option value="{{ $color->id }}">{{ $color->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <button type="submit" class="btn btn-primary w-100">
                                                        <i class="fas fa-link"></i> Attach
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                        <!-- Existing Colors -->
                                        <h6>Assigned Colors</h6>
                                        @if ($product->colors->count() > 0)
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach ($product->colors as $color)
                                                    <div class="d-flex align-items-center bg-light p-2 rounded">
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
                                                                class="btn btn-sm btn-outline-danger p-0"
                                                                onclick="return confirm('Remove this color from product?')">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="alert alert-info">No colors assigned to this product.</div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
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
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Add New Size and Attach to Product -->
                                        {{-- <form action="{{ route('admin.sizes.store') }}" method="POST" class="mb-4"
                                            id="addSizeForm{{ $product->id }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <div class="row g-2">
                                                <div class="col-5">
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Size name" required>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" name="code" class="form-control"
                                                        placeholder="Code (S, M, L)" required>
                                                </div>
                                                <div class="col-3">
                                                    <button type="submit" class="btn btn-success w-100">
                                                        <i class="fas fa-plus"></i> Add
                                                    </button>
                                                </div>
                                            </div>
                                            <small class="text-muted">New size will be created and attached to this
                                                product</small>
                                        </form> --}}

                                        <!-- Attach Existing Size Form -->
                                        <form action="{{ route('admin.artists-products.update', $product->id) }}"
                                            method="POST" class="mb-4">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="update_type" value="attach_size">
                                            <div class="row g-2">
                                                <div class="col-9">
                                                    <select name="size_id" class="form-select" required>
                                                        <option value="">Select existing size to attach</option>
                                                        @php
                                                            $allSizes = App\Models\Size::orderBy('code')->get();
                                                            $existingSizeIds = $product->sizes->pluck('id')->toArray();
                                                        @endphp
                                                        @foreach ($allSizes as $size)
                                                            @if (!in_array($size->id, $existingSizeIds))
                                                                <option value="{{ $size->id }}">{{ $size->code }} -
                                                                    {{ $size->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <button type="submit" class="btn btn-primary w-100">
                                                        <i class="fas fa-link"></i> Attach
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                        <!-- Existing Sizes -->
                                        <h6>Assigned Sizes</h6>
                                        @if ($product->sizes->count() > 0)
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach ($product->sizes as $size)
                                                    <div class="d-flex align-items-center bg-light p-2 rounded">
                                                        <span class="me-2">{{ $size->code }} -
                                                            {{ $size->name }}</span>
                                                        <form
                                                            action="{{ route('admin.artists-products.update', $product->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="update_type" value="detach_size">
                                                            <input type="hidden" name="size_id"
                                                                value="{{ $size->id }}">
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger p-0"
                                                                onclick="return confirm('Remove this size from product?')">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="alert alert-info">No sizes assigned to this product.</div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Add Review Modal -->
                        <div class="modal fade" id="addReviewModal{{ $product->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.products.reviews.store', $product->id) }}"
                                        method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Review for {{ $product->title }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">User Name *</label>
                                                <input type="text" name="user_name" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Rating *</label>
                                                <select name="rating" class="form-select" required>
                                                    <option value="">Select Rating</option>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}">{{ $i }}
                                                            Star{{ $i > 1 ? 's' : '' }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Title *</label>
                                                <input type="text" name="title" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Review *</label>
                                                <textarea name="review" class="form-control" rows="3" required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Add Review</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination if needed --}}
    {{-- <div class="mt-3">
        {{ $products->links() }}
    </div> --}}
@endsection

@push('scripts')
    <script>
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
                        fetch('{{ route('admin.colors.store') }}', {
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
