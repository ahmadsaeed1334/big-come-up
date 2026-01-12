@extends('layouts.app')

@section('content')
    <style>
        /* Star Rating Styles */
        .star-rating {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .star-option {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            transition: all 0.2s;
            background: white;
        }

        .star-option:hover {
            background-color: #f8f9fa;
            border-color: #adb5bd;
        }

        .star-option.selected {
            background-color: #fff3cd;
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
        }

        .star-option .stars {
            color: #ffc107;
            margin-right: 8px;
        }

        .star-option .rating-text {
            color: #6c757d;
            font-weight: 500;
        }

        .star-option input[type="radio"] {
            display: none;
        }

        /* For showing stars in table */
        .rating-stars {
            color: #ffc107;
        }

        .avatar img {
            object-fit: cover;
            width: 40px;
            height: 40px;
        }

        /* Search box styling - Color page ki tarah */
        .search-container {
            position: relative;
            width: 300px;
        }

        .search-input {
            padding-left: 40px;
            height: 40px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
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

        /* Rating filter styling */
        .rating-filter-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .rating-filter-btn {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 8px 12px;
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .rating-filter-btn:hover {
            background-color: #f8f9fa;
            border-color: #adb5bd;
        }

        .rating-filter-btn.active {
            background-color: #e7f1ff;
            border-color: #0d6efd;
            color: #0d6efd;
        }

        .rating-filter-btn .stars {
            color: #ffc107;
        }

        h3 {
            color: #fff;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Product Reviews</h3>
            <small class="text-muted">Manage customer reviews for products</small>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0">Product Reviews</h6>
                    <p class="text-sm mb-0 text-muted">Manage customer reviews for products</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <!-- Search Form -->
                    <form action="{{ route('admin.product-reviews.index') }}" method="GET" class="mb-0">
                        <div class="search-container">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" name="search" class="form-control search-input"
                                placeholder="Search reviews..." value="{{ request('search') }}" autocomplete="off">
                            @if (request('search'))
                                <a href="{{ route('admin.product-reviews.index') }}" class="clear-search">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </form>

                    <!-- Rating Filter -->
                    @if (request('rating'))
                        <a href="{{ route('admin.product-reviews.index') }}" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-times me-1"></i> Clear Filter
                        </a>
                    @endif
                </div>
            </div>

            <!-- Rating Filter Options -->
            <div class="mt-3">
                <div class="d-flex align-items-center gap-2">
                    <span class="text-sm text-muted me-2">Filter by rating:</span>
                    <div class="rating-filter-container">
                        @for ($i = 5; $i >= 1; $i--)
                            <a href="{{ route('admin.product-reviews.index', ['rating' => $i]) }}"
                                class="rating-filter-btn {{ request('rating') == $i ? 'active' : '' }}">
                                <span class="stars">
                                    @for ($j = 1; $j <= $i; $j++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                </span>
                                <span class="rating-text">{{ $i }}+</span>
                            </a>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body px-0 pt-0 pb-2">
            <!-- Search/Filter Results Info -->
            @if (request('search') || request('rating'))
                <div class="px-4 pt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            @if (request('search'))
                                <p class="text-sm text-muted mb-0">
                                    <i class="fas fa-search me-1"></i>Showing results for:
                                    <strong>"{{ request('search') }}"</strong>
                                </p>
                            @endif
                            @if (request('rating'))
                                <p class="text-sm text-muted mb-0">
                                    <i class="fas fa-filter me-1"></i>Rating filter: <strong>{{ request('rating') }} stars
                                        and above</strong>
                                </p>
                            @endif
                            <p class="text-sm text-muted mb-0">
                                <i class="fas fa-list me-1"></i>Found {{ $reviews->count() }} review(s)
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('admin.product-reviews.index') }}" class="text-danger text-sm">
                                <i class="fas fa-times me-1"></i> Clear all filters
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">
                                <i class="fas fa-hashtag me-2"></i>#
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                <i class="fas fa-box me-2"></i>Product
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                <i class="fas fa-comment me-2"></i>Review
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                <i class="fas fa-star me-2"></i>Rating
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                <i class="fas fa-user me-2"></i>Reviewer
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                <i class="fas fa-calendar me-2"></i>Date
                            </th>
                            <th class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 pe-4">
                                <i class="fas fa-cogs me-2"></i>Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($reviews as $index => $review)
                            <tr>
                                <td class="text-sm ps-4">
                                    {{ ($reviews->currentPage() - 1) * $reviews->perPage() + $index + 1 }}
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($review->product && $review->product->images->first())
                                            <img src="{{ $review->product->images->first()->image_url ?? '' }}"
                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                alt="{{ $review->product->name }}" style="object-fit: cover;">
                                        @else
                                            <div
                                                class="avatar avatar-sm me-3 bg-gradient-secondary border-radius-lg d-flex align-items-center justify-content-center">
                                                <i class="ni ni-box-2 text-white"></i>
                                            </div>
                                        @endif
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-0 text-sm">
                                                {{ $review->product ? Str::limit($review->product->title, 30) : 'Deleted Product' }}
                                            </h6>
                                            <small class="text-muted">
                                                <i class="fas fa-paint-brush me-1"></i>
                                                By
                                                {{ $review->product && $review->product->artist ? $review->product->artist->name : 'N/A' }}
                                            </small>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-start">
                                        <div
                                            class="icon icon-shape icon-sm me-3 bg-gradient-info shadow text-center rounded-circle">
                                            <i class="fas fa-comment text-white opacity-10"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-sm">{{ $review->title }}</h6>
                                            <p class="text-xs text-secondary mb-0">
                                                {{ Str::limit($review->review, 50) }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="rating-stars me-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-muted"></i>
                                                @endif
                                            @endfor
                                        </span>
                                        <span class="badge badge-sm bg-gradient-dark ms-1">
                                            <i class="fas fa-star-half-alt me-1"></i>{{ $review->rating }}/5
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="icon icon-shape icon-sm me-3 bg-gradient-warning shadow text-center rounded-circle">
                                            <i class="fas fa-user text-white opacity-10"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-sm">{{ $review->user_name }}</h6>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex flex-column">
                                        <p class="text-xs mb-0">
                                            <i
                                                class="fas fa-calendar-day me-1"></i>{{ $review->created_at->format('M d, Y') }}
                                        </p>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>{{ $review->created_at->format('h:i A') }}
                                        </small>
                                    </div>
                                </td>

                                <td class="align-middle text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <!-- View Button -->
                                        <button type="button" class="btn btn-sm btn-outline-info action-btn"
                                            data-bs-toggle="modal" data-bs-target="#viewReviewModal{{ $review->id }}"
                                            title="View Review">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Edit Button -->
                                        <button type="button" class="btn btn-sm btn-outline-primary action-btn"
                                            data-bs-toggle="modal" data-bs-target="#editReviewModal{{ $review->id }}"
                                            title="Edit Review">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Delete Button -->
                                        <button type="button" class="btn btn-sm btn-outline-danger action-btn"
                                            onclick="confirmReviewDelete({{ $review->id }})" title="Delete Review">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <form id="delete-review-{{ $review->id }}"
                                            action="{{ route('admin.product-reviews.destroy', $review->id) }}"
                                            method="POST" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- View Review Modal -->
                            <div class="modal fade" id="viewReviewModal{{ $review->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                <i class="fas fa-eye me-2"></i>Review Details
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    @if ($review->product && $review->product->getFirstMedia('product_images'))
                                                        <img src="{{ $review->product->getFirstMedia('product_images')->getUrl() }}"
                                                            class="img-fluid rounded mb-3"
                                                            alt="{{ $review->product->title }}">
                                                    @elseif($review->product && $review->product->getFirstMedia('main_image'))
                                                        <img src="{{ $review->product->getFirstMedia('main_image')->getUrl() }}"
                                                            class="img-fluid rounded mb-3"
                                                            alt="{{ $review->product->title }}">
                                                    @else
                                                        <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3"
                                                            style="height: 200px;">
                                                            <i class="fas fa-box fa-4x text-muted"></i>
                                                        </div>
                                                    @endif
                                                    <h6>
                                                        <i class="fas fa-box me-2"></i>
                                                        {{ $review->product ? $review->product->title : 'Deleted Product' }}
                                                    </h6>
                                                    <p class="text-muted mb-0">
                                                        <i class="fas fa-paint-brush me-2"></i>
                                                        By
                                                        {{ $review->product && $review->product->artist ? $review->product->artist->name : 'N/A' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="mb-3">
                                                        <h4>{{ $review->title }}</h4>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <span class="rating-stars me-2">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $review->rating)
                                                                        <i class="fas fa-star fa-lg text-warning"></i>
                                                                    @else
                                                                        <i class="far fa-star fa-lg text-muted"></i>
                                                                    @endif
                                                                @endfor
                                                            </span>
                                                            <span class="badge bg-gradient-dark">
                                                                <i
                                                                    class="fas fa-star-half-alt me-1"></i>{{ $review->rating }}/5
                                                            </span>
                                                        </div>
                                                        <p>
                                                            <i class="fas fa-user me-2"></i>
                                                            <strong>Reviewer:</strong> {{ $review->user_name }}
                                                        </p>
                                                        <p>
                                                            <i class="fas fa-calendar-alt me-2"></i>
                                                            <strong>Review Date:</strong>
                                                            {{ $review->created_at->format('F d, Y h:i A') }}
                                                        </p>
                                                        <hr>
                                                        <p><i class="fas fa-comment me-2"></i><strong>Review:</strong></p>
                                                        <p class="text-justify">{{ $review->review }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">
                                                <i class="fas fa-times me-1"></i> Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Review Modal -->
                            <div class="modal fade" id="editReviewModal{{ $review->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.product-reviews.update', $review->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    <i class="fas fa-edit me-2"></i>Edit Review
                                                </h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">
                                                        <i class="fas fa-user me-2"></i>Reviewer Name *
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-user"></i>
                                                        </span>
                                                        <input type="text" name="user_name" class="form-control"
                                                            value="{{ $review->user_name }}" required>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label mb-2">
                                                        <i class="fas fa-star me-2"></i>Rating *
                                                    </label>
                                                    <div class="star-rating">
                                                        @for ($i = 5; $i >= 1; $i--)
                                                            <label
                                                                class="star-option {{ $review->rating == $i ? 'selected' : '' }}">
                                                                <input type="radio" name="rating"
                                                                    value="{{ $i }}"
                                                                    {{ $review->rating == $i ? 'checked' : '' }}>
                                                                <div class="stars">
                                                                    @for ($j = 1; $j <= $i; $j++)
                                                                        <i class="fas fa-star"></i>
                                                                    @endfor
                                                                </div>
                                                                <span class="rating-text">({{ $i }}
                                                                    Star{{ $i > 1 ? 's' : '' }})</span>
                                                            </label>
                                                        @endfor
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">
                                                        <i class="fas fa-heading me-2"></i>Review Title *
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-heading"></i>
                                                        </span>
                                                        <input type="text" name="title" class="form-control"
                                                            value="{{ $review->title }}" required>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">
                                                        <i class="fas fa-comment me-2"></i>Review *
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-comment"></i>
                                                        </span>
                                                        <textarea name="review" class="form-control" rows="4" required>{{ $review->review }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-1"></i> Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-1"></i> Update Review
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                    <h6 class="text-muted">
                                        @if (request('search') || request('rating'))
                                            No reviews found matching your criteria.
                                        @else
                                            No reviews found.
                                        @endif
                                    </h6>
                                    @if (request('search') || request('rating'))
                                        <a href="{{ route('admin.product-reviews.index') }}"
                                            class="btn btn-sm btn-outline-primary mt-2">
                                            <i class="fas fa-times me-1"></i> Clear filters
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @include('admin.partials.pagination', ['items' => $reviews])
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmReviewDelete(reviewId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This review will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#8392ab',
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-review-' + reviewId).submit();
                }
            });
        }

        // Star rating selection functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Handle star option clicks
            document.querySelectorAll('.star-option').forEach(option => {
                option.addEventListener('click', function() {
                    // Remove selected class from all options in this rating group
                    const ratingGroup = this.closest('.star-rating');
                    ratingGroup.querySelectorAll('.star-option').forEach(opt => {
                        opt.classList.remove('selected');
                    });

                    // Add selected class to clicked option
                    this.classList.add('selected');

                    // Check the radio button
                    const radio = this.querySelector('input[type="radio"]');
                    if (radio) {
                        radio.checked = true;
                    }
                });
            });

            // Initialize modal star ratings when modals are shown
            document.querySelectorAll('[data-bs-target^="#editReviewModal"]').forEach(button => {
                button.addEventListener('click', function() {
                    setTimeout(() => {
                        const targetModal = this.getAttribute('data-bs-target');
                        const modal = document.querySelector(targetModal);
                        if (modal) {
                            // Find checked radio and select the corresponding star-option
                            const checkedRadio = modal.querySelector(
                                'input[name="rating"]:checked');
                            if (checkedRadio) {
                                const starOption = checkedRadio.closest('.star-option');
                                if (starOption) {
                                    // Remove selected from all
                                    modal.querySelectorAll('.star-option').forEach(opt => {
                                        opt.classList.remove('selected');
                                    });
                                    // Add to selected
                                    starOption.classList.add('selected');
                                }
                            }
                        }
                    }, 100);
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
@endpush
