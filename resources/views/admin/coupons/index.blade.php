@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Coupons</h3>
            <small class="text-muted">Manage discount codes</small>
        </div>
        <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
            + Add Coupon
        </a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2" method="GET" action="{{ route('admin.coupons.index') }}">
                <div class="col-12 col-md-4">
                    <input type="text" name="q" class="form-control" placeholder="Search name/code"
                        value="{{ request('q') }}">
                </div>

                <div class="col-12 col-md-3">
                    <select name="type" class="form-select">
                        <option value="">All Types</option>
                        @foreach (['percent', 'fixed'] as $t)
                            <option value="{{ $t }}" @selected(request('type') === $t)>{{ ucfirst($t) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        @foreach (['active', 'inactive'] as $s)
                            <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-1">
                    <button class="btn btn-outline-secondary w-100">Go</button>
                </div>
                <div class="col-12 col-md-1">
                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-light w-100">Reset</a>
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
                        <th>Coupon</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Rules</th>
                        <th>Usage</th>
                        <th>Status</th>
                        <th class="text-end" style="width:180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($coupons as $index => $c)
                        @php
                            $badge = $c->status === 'active' ? 'success' : 'secondary';
                            $valueText =
                                $c->type === 'percent'
                                    ? rtrim(rtrim(number_format((float) $c->value, 2), '0'), '.') . '%'
                                    : number_format((float) $c->value, 2);
                        @endphp
                        <tr>
                            <td>{{ $coupons->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-semibold">{{ $c->name }}</div>
                                <div class="small text-muted">
                                    <code>{{ $c->code }}</code>
                                </div>
                                <div class="small text-muted">
                                    @if ($c->starts_at)
                                        Start: {{ $c->starts_at->format('Y-m-d') }}
                                    @endif
                                    @if ($c->expires_at)
                                        | Exp: {{ $c->expires_at->format('Y-m-d') }}
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ ucfirst($c->type) }}</span>
                            </td>
                            <td class="fw-semibold">
                                {{ $valueText }}
                            </td>
                            <td class="small">
                                @if ($c->min_order_amount)
                                    Min: {{ number_format((float) $c->min_order_amount, 2) }} <br>
                                @endif
                                @if ($c->max_discount_amount)
                                    Max Off: {{ number_format((float) $c->max_discount_amount, 2) }}
                                @endif
                                @if (!$c->min_order_amount && !$c->max_discount_amount)
                                    —
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $c->used_count }}
                                    @if ($c->usage_limit)
                                        / {{ $c->usage_limit }}
                                    @endif
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $badge }}">{{ ucfirst($c->status) }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.coupons.edit', $c) }}" class="btn btn-sm btn-outline-primary">
                                    Edit
                                </a>

                                <x-delete-form :action="route('admin.coupons.destroy', $c)" text="Delete this coupon?" buttonLabel="Delete" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">No coupons found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $coupons->links() }}
    </div>
@endsection
