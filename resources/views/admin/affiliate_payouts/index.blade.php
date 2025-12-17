@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Affiliate Payouts</h3>
            <small class="text-muted">Monthly payout tracking</small>
        </div>
        <a href="{{ route('admin.affiliate-payouts.create') }}" class="btn btn-primary">+ Add Payout</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2" method="GET" action="{{ route('admin.affiliate-payouts.index') }}">
                <div class="col-12 col-md-5">
                    <select name="affiliate_id" class="form-select">
                        <option value="">All Affiliates</option>
                        @foreach ($affiliates as $a)
                            <option value="{{ $a->id }}" @selected((string) request('affiliate_id') === (string) $a->id)>
                                {{ $a->user?->name }} - {{ $a->code }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                        <option value="paid" @selected(request('status') === 'paid')>Paid</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 d-flex gap-2">
                    <button class="btn btn-outline-secondary w-100">Filter</button>
                    <a href="{{ route('admin.affiliate-payouts.index') }}" class="btn btn-light w-100">Reset</a>
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
                        <th>Affiliate</th>
                        <th>Code</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end" style="width:180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payouts as $index => $p)
                        <tr>
                            <td>{{ $payouts->firstItem() + $index }}</td>
                            <td>{{ $p->affiliate?->user?->name }}</td>
                            <td><code>{{ $p->affiliate?->code }}</code></td>
                            <td>{{ number_format((float) $p->amount, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $p->status === 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td class="small text-muted">
                                {{ optional($p->paid_at ?? $p->created_at)->format('d M Y') }}
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.affiliate-payouts.edit', $p) }}"
                                    class="btn btn-sm btn-outline-primary">Edit</a>

                                <x-delete-form :action="route('admin.affiliate-payouts.destroy', $p)" text="Delete this payout?" buttonLabel="Delete" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No payouts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $payouts->links() }}
    </div>
@endsection
