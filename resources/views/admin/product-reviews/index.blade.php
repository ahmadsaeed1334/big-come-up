@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Product Reviews</h3>
            <small class="text-muted">Manage customer reviews</small>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2" method="GET" action="{{ route('admin.product-reviews.index') }}">
                <div class="col-12 col-md-4">
                    <input type="text" name="q" class="form-control" placeholder="Search user name or title"
                        value="{{ request('q') }}">
                </div>

                <div class="col-12 col-md-3">
                    <select name="rating" class="form-select">
                        <option value="">All Ratings</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" @selected(request('rating') == $i)>
                                {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="col-12 col-md-1">
                    <button class="btn btn-outline-secondary w-100">Go</button>
                </div>
                <div class="col-12 col-md-1">
                    <a href="{{ route('admin.product-reviews.index') }}" class="btn btn-light w-100">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Reviews Table Card -->
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Review</th>
                        <th>Product</th>
                        <th>Rating</th>
                        <th>Date</th>
                        <th class="text-end" style="width:150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $index => $review)
                        <tr>
                            <td>{{ $reviews->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-semibold">{{ $review->title }}</div>
                                <div class="small text-muted">{{ Str::limit($review->review, 100) }}</div>
                                <div class="small">
                                    <strong>By:</strong> {{ $review->user_name }}
                                </div>
                            </td>
                            <td>
                                <div class="small">
                                    {{ $review->product->title ?? 'N/A' }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rating)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-muted"></i>
                                        @endif
                                    @endfor
                                    <span class="ms-2 fw-semibold">{{ $review->rating }}/5</span>
                                </div>
                            </td>
                            <td>
                                <div class="small text-muted">
                                    {{ $review->created_at->format('Y-m-d') }}
                                </div>
                            </td>
                            <td class="text-end">
                                <!-- Edit Button -->
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#editReviewModal{{ $review->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.product-reviews.destroy', $review->id) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this review?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Review Modal -->
                        <div class="modal fade" id="editReviewModal{{ $review->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.product-reviews.update', $review->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Review</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">User Name *</label>
                                                <input type="text" name="user_name" class="form-control"
                                                    value="{{ $review->user_name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Rating *</label>
                                                <select name="rating" class="form-select" required>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}"
                                                            {{ $review->rating == $i ? 'selected' : '' }}>
                                                            {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Title *</label>
                                                <input type="text" name="title" class="form-control"
                                                    value="{{ $review->title }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Review *</label>
                                                <textarea name="review" class="form-control" rows="3" required>{{ $review->review }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update Review</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No reviews found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($reviews->hasPages())
        <div class="mt-3">
            {{ $reviews->links() }}
        </div>
    @endif
@endsection
