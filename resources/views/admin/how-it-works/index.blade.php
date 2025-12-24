{{-- resources/views/admin/how-it-works/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>How It Works Section</h4>
        </div>

        <div class="card-body">
            {{-- ADD --}}
            <form method="POST" action="{{ route('admin.how.store') }}" class="row g-3 mb-4">
                @csrf
                <div class="col-md-2">
                    <input type="number" name="step_number" class="form-control" placeholder="0">
                </div>
                <div class="col-md-4">
                    <input type="text" name="title" class="form-control" placeholder="Step Title">
                </div>
                <div class="col-md-6">
                    <textarea name="description" class="form-control editor" rows="3"></textarea>
                </div>
                <div class="col-12 text-end">
                    <button class="btn btn-primary">Add Step</button>
                </div>
            </form>

            {{-- LIST --}}
            @foreach ($steps as $step)
                {{-- UPDATE FORM --}}
                <form method="POST" action="{{ route('admin.how.update', $step) }}" class="card mb-3">
                    @csrf
                    @method('PUT')

                    <div class="card-body row g-3">
                        <div class="col-md-2">
                            <input type="number" name="step_number" value="{{ $step->step_number }}" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <input type="text" name="title" value="{{ $step->title }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <textarea name="description" class="form-control editor" rows="3">{!! $step->description !!}</textarea>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">
                            Update
                        </button>

                        {{-- DELETE BUTTON (separate form trigger) --}}
                        <button type="button" class="btn btn-danger"
                            onclick="confirmDelete('delete-step-{{ $step->id }}')">
                            Delete
                        </button>

                    </div>
                </form>

                {{-- DELETE FORM (OUTSIDE) --}}
                <form id="delete-step-{{ $step->id }}" method="POST" action="{{ route('admin.how.destroy', $step) }}"
                    style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach

        </div>
    </div>

    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script>
        document.querySelectorAll('.editor').forEach(el => {
            ClassicEditor.create(el);
        });
    </script>
@endsection
