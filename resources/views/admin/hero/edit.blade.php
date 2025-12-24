@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Home Hero Section</h4>
            <small>Edit homepage first section</small>
        </div>

        <form method="POST" action="{{ route('admin.hero.update') }}">
            @csrf
            @method('PUT')

            <div class="card-body row g-3">

                <div class="col-12">
                    <label class="form-label">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $hero->subtitle) }}">
                </div>

                <div class="col-12">
                    <label class="form-label">Main Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $hero->title) }}"
                        required>
                </div>

                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control js-ckeditor" rows="6">{!! old('description', $hero->description) !!}</textarea>


                </div>

                <div class="col-md-6">
                    <label class="form-label">Primary Button Text</label>
                    <input type="text" name="primary_btn_text" class="form-control"
                        value="{{ old('primary_btn_text', $hero->primary_btn_text) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Primary Button Link</label>
                    <input type="text" name="primary_btn_link" class="form-control"
                        value="{{ old('primary_btn_link', $hero->primary_btn_link) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Secondary Button Text</label>
                    <input type="text" name="secondary_btn_text" class="form-control"
                        value="{{ old('secondary_btn_text', $hero->secondary_btn_text) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Secondary Button Link</label>
                    <input type="text" name="secondary_btn_link" class="form-control"
                        value="{{ old('secondary_btn_link', $hero->secondary_btn_link) }}">
                </div>

            </div>

            <div class="card-footer text-end">
                <button class="btn btn-primary">Update Section</button>
            </div>
        </form>
    </div>

    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#editor'), {
            toolbar: [
                'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'
            ]
        });
    </script>
@endsection
