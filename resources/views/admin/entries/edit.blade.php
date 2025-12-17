@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Edit Entry</h3>
            <small class="text-muted">#{{ $entry->id }}</small>
        </div>
        <a href="{{ route('admin.entries.index') }}" class="btn btn-outline-secondary">
            Back
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.entries.update', $entry) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">User *</label>
                        <select name="user_id" class="form-select" required>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" @selected(old('user_id', $entry->user_id) == $u->id)>
                                    {{ $u->name }} ({{ $u->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Competition *</label>
                        <select name="competition_id" class="form-select" required>
                            @foreach ($competitions as $c)
                                <option value="{{ $c->id }}" @selected(old('competition_id', $entry->competition_id) == $c->id)>
                                    {{ $c->title }} — {{ $c->status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Entry Title</label>
                        <input type="text" name="title" class="form-control"
                            value="{{ old('title', $entry->title) }}">
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select" required>
                            @foreach (['pending', 'approved', 'rejected'] as $s)
                                <option value="{{ $s }}" @selected(old('status', $entry->status) === $s)>
                                    {{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Media URL</label>
                        <input type="text" name="media_url" class="form-control"
                            value="{{ old('media_url', $entry->media_url) }}">
                        @if ($entry->media_url)
                            <div class="mt-2">
                                <a href="{{ $entry->media_url }}" target="_blank" class="btn btn-sm btn-outline-dark">
                                    Preview Link
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.entries.index') }}" class="btn btn-light">
                        Cancel
                    </a>
                    <button class="btn btn-primary">
                        Update
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
