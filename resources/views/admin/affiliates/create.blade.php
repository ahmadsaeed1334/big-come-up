@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Create Affiliate</h3>
            <small class="text-muted">Link a user with referral code</small>
        </div>
        <a href="{{ route('admin.affiliates.index') }}" class="btn btn-outline-secondary">Back</a>
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
            <form method="POST" action="{{ route('admin.affiliates.store') }}">
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

                    <div class="col-12 col-md-3">
                        <label class="form-label">Code (optional)</label>
                        <input type="text" name="code" class="form-control" value="{{ old('code') }}"
                            placeholder="Auto if empty">
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Commission %</label>
                        <input type="number" step="0.01" min="0" max="100" name="commission_rate"
                            class="form-control" value="{{ old('commission_rate', 30) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                @checked(old('is_active', 1))>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.affiliates.index') }}" class="btn btn-light">Cancel</a>
                    <button class="btn btn-primary">Create</button>
                </div>

            </form>
        </div>
    </div>
@endsection
