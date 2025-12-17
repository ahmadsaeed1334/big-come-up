@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Edit Payment</h3>
            <small class="text-muted">{{ $payment->payment_number }}</small>
        </div>
        <a href="{{ route('admin.payments.index') }}" class="btn btn-outline-secondary">Back</a>
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
            <form method="POST" action="{{ route('admin.payments.update', $payment) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Order *</label>
                        <select name="order_id" class="form-select" required>
                            @foreach ($orders as $o)
                                <option value="{{ $o->id }}" @selected(old('order_id', $payment->order_id) == $o->id)>
                                    {{ $o->order_number }} — {{ $o->user->name ?? 'User' }}
                                    ({{ number_format((float) $o->total, 2) }} {{ $o->currency }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">User *</label>
                        <select name="user_id" class="form-select" required>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" @selected(old('user_id', $payment->user_id) == $u->id)>
                                    {{ $u->name }} ({{ $u->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Amount *</label>
                        <input type="number" step="0.01" min="0" name="amount" class="form-control"
                            value="{{ old('amount', $payment->amount) }}" required>
                    </div>

                    <div class="col-12 col-md-2">
                        <label class="form-label">Currency *</label>
                        <input type="text" name="currency" class="form-control"
                            value="{{ old('currency', $payment->currency) }}" required>
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Method *</label>
                        <select name="method" class="form-select" required>
                            @foreach (['card', 'bank', 'paypal', 'stripe', 'cash', 'other'] as $m)
                                <option value="{{ $m }}" @selected(old('method', $payment->method) === $m)>
                                    {{ strtoupper($m) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select" required>
                            @foreach (['pending', 'paid', 'failed', 'refunded'] as $s)
                                <option value="{{ $s }}" @selected(old('status', $payment->status) === $s)>
                                    {{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text">Paid/Refunded se order payment_status auto update hoga.</div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Provider</label>
                        <input type="text" name="provider" class="form-control"
                            value="{{ old('provider', $payment->provider) }}">
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Transaction ID</label>
                        <input type="text" name="transaction_id" class="form-control"
                            value="{{ old('transaction_id', $payment->transaction_id) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="3">{{ old('notes', $payment->notes) }}</textarea>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.payments.index') }}" class="btn btn-light">Cancel</a>
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
