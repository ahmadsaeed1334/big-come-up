@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Competitions</h3>
            <small class="text-muted">Manage competitions</small>
        </div>
        <a href="{{ route('admin.competitions.create') }}" class="btn btn-primary">
            + Add Competition
        </a>
    </div>

    @if (session('status'))
        <div class="alert alert-info">{{ session('status') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th style="width:70px;">#</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Entry Fee</th>
                            <th>Dates</th>
                            <th style="width:180px;" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($competitions as $index => $c)
                            <tr>
                                <td>{{ $competitions->firstItem() + $index }}</td>
                                <td class="fw-semibold">{{ $c->title }}</td>
                                <td><code>{{ $c->slug }}</code></td>
                                <td>
                                    @php
                                        $badge = match ($c->status) {
                                            'active' => 'success',
                                            'closed' => 'dark',
                                            default => 'secondary',
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badge }}">{{ ucfirst($c->status) }}</span>
                                </td>
                                <td>{{ number_format((float) $c->entry_fee, 2) }}</td>
                                <td class="small text-muted">
                                    <div>Start: {{ optional($c->start_date)->format('Y-m-d H:i') ?? '-' }}</div>
                                    <div>End: {{ optional($c->end_date)->format('Y-m-d H:i') ?? '-' }}</div>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.competitions.edit', $c) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>

                                    {{-- <form action="{{ route('admin.competitions.destroy', $c) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Delete this competition?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            Delete
                                        </button>
                                    </form> --}}
                                    <x-delete-form :action="route('admin.competitions.destroy', $c)" text="Delete this competition?" buttonLabel="Delete" />

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    No competitions found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $competitions->links() }}
    </div>
@endsection
