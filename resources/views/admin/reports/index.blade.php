@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Reports</h3>
            <small class="text-muted">User & entry moderation reports</small>
        </div>
        <a href="{{ route('admin.reports.create') }}" class="btn btn-primary">
            + Add Report
        </a>
    </div>

    {{-- Filters --}}
    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2" method="GET" action="{{ route('admin.reports.index') }}">

                <div class="col-12 col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        @foreach (['pending', 'approved', 'rejected'] as $s)
                            <option value="{{ $s }}" @selected(request('status') === $s)>
                                {{ ucfirst($s) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <select name="reporter_id" class="form-select">
                        <option value="">All Reporters</option>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}" @selected(request('reporter_id') == $u->id)>
                                {{ $u->name }} ({{ $u->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <select name="reported_user_id" class="form-select">
                        <option value="">All Reported Users</option>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}" @selected(request('reported_user_id') == $u->id)>
                                {{ $u->name }} ({{ $u->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <select name="entry_id" class="form-select">
                        <option value="">All Entries</option>
                        @foreach ($entries as $e)
                            <option value="{{ $e->id }}" @selected(request('entry_id') == $e->id)>
                                #{{ $e->id }} — {{ $e->title ?? 'Untitled' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <input type="text" name="reason" class="form-control" placeholder="Search reason"
                        value="{{ request('reason') }}">
                </div>

                <div class="col-12 col-md-3">
                    <button class="btn btn-outline-secondary w-100">Filter</button>
                </div>
                <div class="col-12 col-md-3">
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-light w-100">Reset</a>
                </div>

            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th style="width:70px;">#</th>
                            <th>Reason</th>
                            <th>Reporter</th>
                            <th>Reported User</th>
                            <th>Entry</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th style="width:180px;" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $index => $r)
                            @php
                                $badge = match ($r->status) {
                                    'approved' => 'success',
                                    'rejected' => 'danger',
                                    default => 'secondary',
                                };
                            @endphp
                            <tr>
                                <td>{{ $reports->firstItem() + $index }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $r->reason }}</div>
                                    @if ($r->message)
                                        <div class="small text-muted text-truncate" style="max-width: 260px;">
                                            {{ $r->message }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div>{{ $r->reporter->name ?? '—' }}</div>
                                    <div class="small text-muted">{{ $r->reporter->email ?? '' }}</div>
                                </td>
                                <td>
                                    @if ($r->reportedUser)
                                        <div>{{ $r->reportedUser->name }}</div>
                                        <div class="small text-muted">{{ $r->reportedUser->email }}</div>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($r->entry)
                                        #{{ $r->entry->id }} — {{ $r->entry->title ?? 'Untitled' }}
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $badge }}">{{ ucfirst($r->status) }}</span>
                                </td>
                                <td class="small text-muted">
                                    {{ $r->created_at?->format('Y-m-d H:i') }}
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.reports.edit', $r) }}" class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>

                                    <x-delete-form :action="route('admin.reports.destroy', $r)" text="Delete this report?" buttonLabel="Delete" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    No reports found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $reports->links() }}
    </div>
@endsection
