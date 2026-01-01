@extends('layouts.app')

@section('content')
    <h3 class="mb-3">Edit Category</h3>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input name="name" class="form-control" value="{{ $category->name }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input name="slug" class="form-control" value="{{ $category->slug }}">
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Cancel</a>
            </form>
        </div>
    </div>
@endsection
