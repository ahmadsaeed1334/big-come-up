@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">My Referrals</h3>
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
                        <th>User</th>
                        <th>Competition</th>
                        <th>Base</th>
                        <th>Commission</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($referrals as $index => $r)
                        <tr>
                            <td>{{ $referrals->firstItem() + $index }}</td>
                            <td>{{ $r->referredUser?->name ?? '—' }}</td>
                            <td>{{ $r->competition?->title ?? '—' }}</td>
                            <td>{{ number_format((float) $r->base_amount, 2) }}</td>
                            <td class="fw-semibold">{{ number_format((float) $r->commission_amount, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $r->status === 'approved' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($r->status) }}
                                </span>
                            </td>
                            <td class="small text-muted">{{ $r->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No referrals found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $referrals->links() }}
    </div>
@endsection
