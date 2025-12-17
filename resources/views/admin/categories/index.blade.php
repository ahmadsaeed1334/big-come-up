@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Categories</h3>
            <small class="text-muted">Manage product categories</small>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Add Category</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2" method="GET">
                <div class="col-12 col-md-6">
                    <input type="text" name="q" class="form-control" placeholder="Search name/slug"
                        value="{{ request('q') }}">
                </div>
                <div class="col-12 col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        @foreach (['active', 'inactive'] as $s)
                            <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-1">
                    <button class="btn btn-outline-secondary w-100">Go</button>
                </div>
                <div class="col-12 col-md-2">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light w-100">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width:70px;">#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th style="width:180px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $index => $c)
                        <tr>
                            <td>{{ $categories->firstItem() + $index }}</td>
                            <td class="fw-semibold">{{ $c->name }}</td>
                            <td><code>{{ $c->slug }}</code></td>
                            <td>
                                <span class="badge bg-{{ $c->status === 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($c->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.categories.edit', $c) }}" class="btn btn-sm btn-outline-primary">
                                    Edit
                                </a>
                                <x-delete-form :action="route('admin.categories.destroy', $c)" text="Delete this category?" buttonLabel="Delete" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $categories->links() }}
    </div>
@endsection
