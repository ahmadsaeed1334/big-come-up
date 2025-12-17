@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Winner Payouts</h3>
            <small class="text-muted">Manage payouts for winners/affiliates</small>
        </div>
        <a href="{{ route('admin.winner-payouts.create') }}" class="btn btn-primary">
            + Add Payout
        </a>
    </div>

    {{-- Filters --}}
    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2" method="GET" action="{{ route('admin.winner-payouts.index') }}">

                <div class="col-12 col-md-3">
                    <select name="competition_id" class="form-select">
                        <option value="">All Competitions</option>
                        @foreach ($competitions as $c)
                            <option value="{{ $c->id }}" @selected(request('competition_id') == $c->id)>
                                {{ $c->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <select name="user_id" class="form-select">
                        <option value="">All Users</option>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}" @selected(request('user_id') == $u->id)>
                                {{ $u->name }} ({{ $u->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <select name="type" class="form-select">
                        <option value="">All Types</option>
                        @foreach (['dj', 'artist', 'affiliate'] as $t)
                            <option value="{{ $t }}" @selected(request('type') === $t)>
                                {{ strtoupper($t) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        @foreach (['pending', 'paid'] as $s)
                            <option value="{{ $s }}" @selected(request('status') === $s)>
                                {{ ucfirst($s) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <button class="btn btn-outline-secondary w-100">Filter</button>
                </div>
                <div class="col-12 col-md-3">
                    <a href="{{ route('admin.winner-payouts.index') }}" class="btn btn-light w-100">Reset</a>
                </div>

            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th style="width:70px;">#</th>
                            <th>Competition</th>
                            <th>Winner</th>
                            <th>Entry</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th style="width:180px;" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payouts as $index => $p)
                            @php
                                $statusBadge = $p->status === 'paid' ? 'success' : 'secondary';
                                $typeBadge = match ($p->type) {
                                    'dj' => 'warning',
                                    'affiliate' => 'info',
                                    default => 'dark',
                                };
                            @endphp
                            <tr>
                                <td>{{ $payouts->firstItem() + $index }}</td>
                                <td>{{ $p->competition->title ?? '—' }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $p->user->name ?? '—' }}</div>
                                    <div class="small text-muted">{{ $p->user->email ?? '' }}</div>
                                </td>
                                <td>
                                    @if ($p->entry)
                                        #{{ $p->entry->id }} — {{ $p->entry->title ?? 'Untitled' }}
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td><span class="badge bg-{{ $typeBadge }}">{{ strtoupper($p->type) }}</span></td>
                                <td>{{ number_format((float) $p->amount, 2) }}</td>
                                <td><span class="badge bg-{{ $statusBadge }}">{{ ucfirst($p->status) }}</span></td>
                                <td class="text-end">
                                    <a href="{{ route('admin.winner-payouts.edit', $p) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>

                                    <x-delete-form :action="route('admin.winner-payouts.destroy', $p)" text="Delete this payout?" buttonLabel="Delete" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">No payouts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $payouts->links() }}
    </div>
@endsection
