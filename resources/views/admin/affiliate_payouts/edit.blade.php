@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Edit Affiliate Payout</h3>
            <small class="text-muted">
                {{ $payout->affiliate?->user?->name }} - {{ $payout->affiliate?->code }}
            </small>
        </div>
        <a href="{{ route('admin.affiliate-payouts.index') }}" class="btn btn-outline-secondary">
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
            <form method="POST" action="{{ route('admin.affiliate-payouts.update', $payout) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-12 col-md-6">
                        <label class="form-label">Affiliate *</label>
                        <select name="affiliate_id" class="form-select" required>
                            <option value="">Select Affiliate</option>
                            @foreach ($affiliates as $a)
                                <option value="{{ $a->id }}" @selected(old('affiliate_id', $payout->affiliate_id) == $a->id)>
                                    {{ $a->user?->name }} - {{ $a->code }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Amount *</label>
                        <input type="number" step="0.01" min="0.01" name="amount" class="form-control"
                            value="{{ old('amount', $payout->amount) }}" required>
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select" required>
                            <option value="pending" @selected(old('status', $payout->status) === 'pending')>Pending</option>
                            <option value="paid" @selected(old('status', $payout->status) === 'paid')>Paid</option>
                        </select>

                        @if ($payout->paid_at)
                            <div class="form-text">
                                Paid at: {{ $payout->paid_at->format('d M Y, h:i A') }}
                            </div>
                        @endif
                    </div>

                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="3">{{ old('notes', $payout->notes) }}</textarea>
                    </div>

                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.affiliate-payouts.index') }}" class="btn btn-light">
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
