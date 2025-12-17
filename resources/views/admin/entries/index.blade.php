@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Entries</h3>
            <small class="text-muted">Manage competition entries</small>
        </div>
        <a href="{{ route('admin.entries.create') }}" class="btn btn-primary">
            + Add Entry
        </a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2" method="GET" action="{{ route('admin.entries.index') }}">
                <div class="col-12 col-md-4">
                    <select name="competition_id" class="form-select">
                        <option value="">All Competitions</option>
                        @foreach ($competitions as $comp)
                            <option value="{{ $comp->id }}" @selected(request('competition_id') == $comp->id)>
                                {{ $comp->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

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

                <div class="col-12 col-md-2">
                    <button class="btn btn-outline-secondary w-100">Filter</button>
                </div>

                <div class="col-12 col-md-3">
                    <a href="{{ route('admin.entries.index') }}" class="btn btn-light w-100">Reset</a>
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
                            <th>Title</th>
                            <th>User</th>
                            <th>Competition</th>
                            <th>Media</th>
                            <th>Status</th>
                            <th style="width:180px;" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($entries as $index => $e)
                            @php
                                $badge = match ($e->status) {
                                    'approved' => 'success',
                                    'rejected' => 'danger',
                                    default => 'secondary',
                                };
                            @endphp
                            <tr>
                                <td>{{ $entries->firstItem() + $index }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $e->title ?? '—' }}</div>
                                    <div class="small text-muted">#{{ $e->id }}</div>
                                </td>
                                <td>
                                    <div>{{ $e->user->name ?? '—' }}</div>
                                    <div class="small text-muted">{{ $e->user->email ?? '' }}</div>
                                </td>
                                <td>{{ $e->competition->title ?? '—' }}</td>
                                <td>
                                    @if ($e->media_url)
                                        <a href="{{ $e->media_url }}" target="_blank" class="btn btn-sm btn-outline-dark">
                                            Open
                                        </a>
                                    @else
                                        <span class="text-muted small">No media</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $badge }}">{{ ucfirst($e->status) }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.entries.edit', $e) }}" class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>

                                    <x-delete-form :action="route('admin.entries.destroy', $e)" text="Delete this entry?" buttonLabel="Delete" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    No entries found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $entries->links() }}
    </div>
@endsection
