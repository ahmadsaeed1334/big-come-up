@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Create Report</h3>
            <small class="text-muted">Add a moderation report</small>
        </div>
        <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary">Back</a>
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
            <form method="POST" action="{{ route('admin.reports.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Reporter *</label>
                        <select name="user_id" class="form-select" required>
                            <option value="">Select Reporter</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" @selected(old('user_id') == $u->id)>
                                    {{ $u->name }} ({{ $u->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Reported User (optional)</label>
                        <select name="reported_user_id" class="form-select">
                            <option value="">None</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" @selected(old('reported_user_id') == $u->id)>
                                    {{ $u->name }} ({{ $u->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Entry (optional)</label>
                        <select name="entry_id" class="form-select">
                            <option value="">None</option>
                            @foreach ($entries as $e)
                                <option value="{{ $e->id }}" @selected(old('entry_id') == $e->id)>
                                    #{{ $e->id }} — {{ $e->title ?? 'Untitled' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Reason *</label>
                        <input type="text" name="reason" class="form-control" value="{{ old('reason') }}" required>
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
                        <label class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="4">{{ old('message') }}</textarea>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-light">Cancel</a>
                    <button class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection
