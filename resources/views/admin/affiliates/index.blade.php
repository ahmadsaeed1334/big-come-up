@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Affiliates</h3>
            <small class="text-muted">Manage affiliate accounts & stats</small>
        </div>
        <a href="{{ route('admin.affiliates.create') }}" class="btn btn-primary">+ Add Affiliate</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2" method="GET" action="{{ route('admin.affiliates.index') }}">
                <div class="col-12 col-md-6">
                    <input type="text" name="q" class="form-control" placeholder="Search user or code"
                        value="{{ request('q') }}">
                </div>
                <div class="col-12 col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="active" @selected(request('status') === 'active')>Active</option>
                        <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
                    </select>
                </div>
                <div class="col-12 col-md-3 d-flex gap-2">
                    <button class="btn btn-outline-secondary w-100">Filter</button>
                    <a href="{{ route('admin.affiliates.index') }}" class="btn btn-light w-100">Reset</a>
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
                        <th>Clicks</th>
                        <th>Signups</th>
                        <th>Paid Reg.</th>
                        <th>Rate</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 240px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($affiliates as $index => $a)
                        <tr>
                            <td>{{ $affiliates->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-semibold">{{ $a->user?->name }}</div>
                                <div class="small text-muted">{{ $a->user?->email }}</div>
                            </td>
                            <td><code>{{ $a->code }}</code></td>
                            <td>{{ $a->clicks }}</td>
                            <td>{{ $a->signups }}</td>
                            <td>{{ $a->paid_registrations }}</td>
                            <td>{{ number_format((float) $a->commission_rate, 2) }}%</td>
                            <td>
                                <span class="badge bg-{{ $a->is_active ? 'success' : 'danger' }}">
                                    {{ $a->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.affiliates.edit', $a) }}"
                                    class="btn btn-sm btn-outline-primary">Edit</a>

                                <form class="d-inline" method="POST" action="{{ route('admin.affiliates.toggle', $a) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-outline-{{ $a->is_active ? 'warning' : 'success' }}">
                                        {{ $a->is_active ? 'Suspend' : 'Activate' }}
                                    </button>
                                </form>

                                <x-delete-form :action="route('admin.affiliates.destroy', $a)" text="Delete this affiliate?" buttonLabel="Delete" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">No affiliates found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $affiliates->links() }}
    </div>
@endsection
