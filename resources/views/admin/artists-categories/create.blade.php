@extends('layouts.app')

@section('content')
    <h3 class="mb-3">Add Category</h3>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input name="slug" class="form-control" required>
                </div>

                <button class="btn btn-primary">Save</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Cancel</a>
            </form>
        </div>
    </div>
@endsection
