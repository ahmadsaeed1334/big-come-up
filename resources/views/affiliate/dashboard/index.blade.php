@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Affiliate Dashboard</h3>
            <small class="text-muted">Welcome, {{ $affiliate->user?->name }}</small>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('affiliate.referrals') }}" class="btn btn-outline-secondary">Referrals</a>
            <a href="{{ route('affiliate.payouts') }}" class="btn btn-outline-secondary">Payouts</a>
        </div>
    </div>

    {{-- Summary cards --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-muted small">Clicks</div>
                    <div class="fs-4 fw-semibold">{{ $affiliate->clicks }}</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-muted small">Signups</div>
                    <div class="fs-4 fw-semibold">{{ $affiliate->signups }}</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-muted small">Approved Commission</div>
                    <div class="fs-4 fw-semibold">{{ number_format((float) $approvedCommission, 2) }}</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-muted small">Balance</div>
                    <div class="fs-4 fw-semibold text-success">{{ number_format((float) $balance, 2) }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Referral link --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h6 class="mb-2">Your Referral Link</h6>
            <div class="input-group">
                <input type="text" class="form-control" id="refLink" value="{{ $refLink }}" readonly>
                <button class="btn btn-outline-primary" type="button" id="copyBtn">Copy</button>
            </div>
            <div class="form-text">
                Commission rate: {{ number_format((float) $affiliate->commission_rate, 2) }}%
            </div>
        </div>
    </div>

    {{-- Recent lists --}}
    <div class="row g-3">
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">Recent Referrals</h6>
                        <a href="{{ route('affiliate.referrals') }}" class="small">View all</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Competition</th>
                                    <th>Commission</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentReferrals as $r)
                                    <tr>
                                        <td>{{ $r->referredUser?->name ?? '—' }}</td>
                                        <td>{{ $r->competition?->title ?? '—' }}</td>
                                        <td>{{ number_format((float) $r->commission_amount, 2) }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $r->status === 'approved' ? 'success' : 'secondary' }}">
                                                {{ ucfirst($r->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">No referrals yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">Recent Payouts</h6>
                        <a href="{{ route('affiliate.payouts') }}" class="small">View all</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentPayouts as $p)
                                    <tr>
                                        <td>{{ number_format((float) $p->amount, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $p->status === 'paid' ? 'success' : 'warning' }}">
                                                {{ ucfirst($p->status) }}
                                            </span>
                                        </td>
                                        <td class="small text-muted">
                                            {{ optional($p->paid_at ?? $p->created_at)->format('d M Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-3">No payouts yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('copyBtn');
            const input = document.getElementById('refLink');

            btn.addEventListener('click', async () => {
                try {
                    await navigator.clipboard.writeText(input.value);
                    // if you want, you can also trigger your toast helper via session in future
                    btn.innerText = 'Copied!';
                    setTimeout(() => btn.innerText = 'Copy', 1200);
                } catch (e) {
                    alert('Copy failed');
                }
            });
        });
    </script>
@endsection
