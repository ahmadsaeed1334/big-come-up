@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Products</h3>
            <small class="text-muted">Manage store products</small>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            + Add Product
        </a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2" method="GET" action="{{ route('admin.products.index') }}">
                <div class="col-12 col-md-5">
                    <input type="text" name="q" class="form-control" placeholder="Search title / slug / sku"
                        value="{{ request('q') }}">
                </div>
                <div class="col-12 col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        @foreach (['draft', 'active', 'archived'] as $s)
                            <option value="{{ $s }}" @selected(request('status') === $s)>
                                {{ ucfirst($s) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <button class="btn btn-outline-secondary w-100">Filter</button>
                </div>
                <div class="col-12 col-md-2">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-light w-100">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th style="width:70px;">#</th>
                            <th style="width:80px;">Image</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th style="width:180px;" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $index => $p)
                            @php
                                $badge = match ($p->status) {
                                    'active' => 'success',
                                    'archived' => 'dark',
                                    default => 'secondary',
                                };
                            @endphp
                            <tr>
                                <td>{{ $products->firstItem() + $index }}</td>

                                <td>
                                    @if ($p->image_path)
                                        <img src="{{ asset('storage/' . $p->image_path) }}" class="rounded border"
                                            style="height:48px; width:48px; object-fit:cover;">
                                    @else
                                        <span class="text-muted small">No image</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="fw-semibold">{{ $p->title }}</div>
                                    <div class="small text-muted"><code>{{ $p->slug }}</code></div>
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $p->category->name ?? '-' }}
                                    </span>
                                </td>

                                <td>{{ $p->sku ?? '—' }}</td>

                                <td>
                                    <div>{{ number_format((float) $p->price, 2) }}</div>
                                    @if ($p->sale_price)
                                        <div class="small text-success">
                                            Sale: {{ number_format((float) $p->sale_price, 2) }}
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $p->stock }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-{{ $badge }}">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('admin.products.edit', $p) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>

                                    <x-delete-form :action="route('admin.products.destroy', $p)" text="Delete this product?" buttonLabel="Delete" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    No products found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $products->links() }}
    </div>
@endsection
