@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Edit Winner Payout</h3>
            <small class="text-muted">#{{ $payout->id }}</small>
        </div>
        <a href="{{ route('admin.winner-payouts.index') }}" class="btn btn-outline-secondary">Back</a>
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
            <form method="POST" action="{{ route('admin.winner-payouts.update', $payout) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Competition *</label>
                        <select name="competition_id" class="form-select" required>
                            @foreach ($competitions as $c)
                                <option value="{{ $c->id }}" @selected(old('competition_id', $payout->competition_id) == $c->id)>
                                    {{ $c->title }} — {{ $c->status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Winner/User *</label>
                        <select name="user_id" class="form-select" required>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" @selected(old('user_id', $payout->user_id) == $u->id)>
                                    {{ $u->name }} ({{ $u->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Entry (optional)</label>
                        <select name="entry_id" class="form-select">
                            <option value="">No Entry</option>
                            @foreach ($entries as $e)
                                <option value="{{ $e->id }}" @selected(old('entry_id', $payout->entry_id) == $e->id)>
                                    #{{ $e->id }} — {{ $e->title ?? 'Untitled' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Type *</label>
                        <select name="type" class="form-select" required>
                            @foreach (['artist', 'dj', 'affiliate'] as $t)
                                <option value="{{ $t }}" @selected(old('type', $payout->type) === $t)>
                                    {{ strtoupper($t) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select" required>
                            @foreach (['pending', 'paid'] as $s)
                                <option value="{{ $s }}" @selected(old('status', $payout->status) === $s)>
                                    {{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">Amount *</label>
                        <input type="number" step="0.01" min="0" name="amount" class="form-control"
                            value="{{ old('amount', $payout->amount) }}" required>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.winner-payouts.index') }}" class="btn btn-light">Cancel</a>
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
