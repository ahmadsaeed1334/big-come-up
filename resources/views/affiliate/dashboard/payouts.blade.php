@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">My Payouts</h3>
            <small class="text-muted">Code: {{ $affiliate->code }}</small>
        </div>
        <a href="{{ route('affiliate.dashboard') }}" class="btn btn-outline-secondary">Back</a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Paid At</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payouts as $index => $p)
                        <tr>
                            <td>{{ $payouts->firstItem() + $index }}</td>
                            <td class="fw-semibold">{{ number_format((float) $p->amount, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $p->status === 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td class="small text-muted">
                                {{ $p->paid_at ? $p->paid_at->format('d M Y') : '—' }}
                            </td>
                            <td>{{ $p->notes ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No payouts found.</td>
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
