@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Payments</h3>
            <small class="text-muted">Transactions & order payments</small>
        </div>
        <a href="{{ route('admin.payments.create') }}" class="btn btn-primary">
            + Add Payment
        </a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2" method="GET" action="{{ route('admin.payments.index') }}">
                <div class="col-12 col-md-4">
                    <input type="text" name="q" class="form-control" placeholder="Search payment # or txn id"
                        value="{{ request('q') }}">
                </div>

                <div class="col-12 col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        @foreach (['pending', 'paid', 'failed', 'refunded'] as $s)
                            <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <select name="method" class="form-select">
                        <option value="">All Methods</option>
                        @foreach (['card', 'bank', 'paypal', 'stripe', 'cash', 'other'] as $m)
                            <option value="{{ $m }}" @selected(request('method') === $m)>{{ strtoupper($m) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-1">
                    <button class="btn btn-outline-secondary w-100">Go</button>
                </div>
                <div class="col-12 col-md-1">
                    <a href="{{ route('admin.payments.index') }}" class="btn btn-light w-100">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Payment</th>
                        <th>Order</th>
                        <th>User</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Created</th>
                        <th class="text-end" style="width:180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $index => $p)
                        @php
                            $badge = match ($p->status) {
                                'paid' => 'success',
                                'failed' => 'danger',
                                'refunded' => 'dark',
                                default => 'secondary',
                            };
                        @endphp
                        <tr>
                            <td>{{ $payments->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-semibold">{{ $p->payment_number }}</div>
                                @if ($p->transaction_id)
                                    <div class="small text-muted">Txn: {{ $p->transaction_id }}</div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $p->order->order_number ?? '—' }}</div>
                                <div class="small text-muted">
                                    Order Total: {{ number_format((float) ($p->order->total ?? 0), 2) }}
                                </div>
                            </td>
                            <td>
                                <div>{{ $p->user->name ?? '—' }}</div>
                                <div class="small text-muted">{{ $p->user->email ?? '' }}</div>
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ strtoupper($p->method) }}</span></td>
                            <td><span class="badge bg-{{ $badge }}">{{ ucfirst($p->status) }}</span></td>
                            <td class="fw-semibold">
                                {{ number_format((float) $p->amount, 2) }} {{ $p->currency }}
                            </td>
                            <td class="small text-muted">{{ $p->created_at?->format('Y-m-d H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.payments.edit', $p) }}" class="btn btn-sm btn-outline-primary">
                                    Edit
                                </a>

                                <x-delete-form :action="route('admin.payments.destroy', $p)" text="Delete this payment?" buttonLabel="Delete" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">No payments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $payments->links() }}
    </div>
@endsection
