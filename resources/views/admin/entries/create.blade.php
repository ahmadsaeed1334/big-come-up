@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Create Entry</h3>
            <small class="text-muted">Add a new entry</small>
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
            <form method="POST" action="{{ route('admin.entries.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">User *</label>
                        <select name="user_id" class="form-select" required>
                            <option value="">Select User</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" @selected(old('user_id') == $u->id)>
                                    {{ $u->name }} ({{ $u->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Competition *</label>
                        <select name="competition_id" class="form-select" required>
                            <option value="">Select Competition</option>
                            @foreach ($competitions as $c)
                                <option value="{{ $c->id }}" @selected(old('competition_id') == $c->id)>
                                    {{ $c->title }} — {{ $c->status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Entry Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                            placeholder="Optional">
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select" required>
                            @foreach (['pending', 'approved', 'rejected'] as $s)
                                <option value="{{ $s }}" @selected(old('status', 'pending') === $s)>
                                    {{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Media URL</label>
                        <input type="text" name="media_url" class="form-control" value="{{ old('media_url') }}"
                            placeholder="Video/Image URL">
                        <div class="form-text">You can paste YouTube, Drive, image link, etc.</div>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.entries.index') }}" class="btn btn-light">
                        Cancel
                    </a>
                    <button class="btn btn-primary">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
