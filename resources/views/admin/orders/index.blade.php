@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Orders</h3>
            <small class="text-muted">Manage store orders</small>
        </div>
        <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">
            + Create Order
        </a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2" method="GET" action="{{ route('admin.orders.index') }}">
                <div class="col-12 col-md-4">
                    <input type="text" name="q" class="form-control" placeholder="Search order number"
                        value="{{ request('q') }}">
                </div>

                <div class="col-12 col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        @foreach (['pending', 'processing', 'shipped', 'completed', 'cancelled'] as $s)
                            <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <select name="payment_status" class="form-select">
                        <option value="">All Payment</option>
                        @foreach (['unpaid', 'paid', 'refunded'] as $s)
                            <option value="{{ $s }}" @selected(request('payment_status') === $s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-1">
                    <button class="btn btn-outline-secondary w-100">Go</button>
                </div>
                <div class="col-12 col-md-1">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-light w-100">Reset</a>
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
                        <th>Order</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Total</th>
                        <th>Created</th>
                        <th class="text-end" style="width:180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $index => $o)
                        @php
                            $statusBadge = match ($o->status) {
                                'completed' => 'success',
                                'cancelled' => 'danger',
                                'processing' => 'warning',
                                'shipped' => 'info',
                                default => 'secondary',
                            };
                            $payBadge = match ($o->payment_status) {
                                'paid' => 'success',
                                'refunded' => 'dark',
                                default => 'secondary',
                            };
                        @endphp
                        <tr>
                            <td>{{ $orders->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-semibold">{{ $o->order_number }}</div>
                                <div class="small text-muted">Subtotal: {{ number_format((float) $o->subtotal, 2) }}</div>
                            </td>
                            <td>
                                <div>{{ $o->user->name ?? '—' }}</div>
                                <div class="small text-muted">{{ $o->user->email ?? '' }}</div>
                            </td>
                            <td><span class="badge bg-{{ $statusBadge }}">{{ ucfirst($o->status) }}</span></td>
                            <td><span class="badge bg-{{ $payBadge }}">{{ ucfirst($o->payment_status) }}</span></td>
                            <td class="fw-semibold">{{ number_format((float) $o->total, 2) }} {{ $o->currency }}</td>
                            <td class="small text-muted">{{ $o->created_at?->format('Y-m-d H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.orders.edit', $o) }}" class="btn btn-sm btn-outline-primary">
                                    Edit
                                </a>
                                <x-delete-form :action="route('admin.orders.destroy', $o)" text="Delete this order?" buttonLabel="Delete" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $orders->links() }}
    </div>
@endsection
