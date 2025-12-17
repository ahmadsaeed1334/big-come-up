@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Votes</h3>
            <small class="text-muted">Track votes across competitions</small>
        </div>
    </div>

    {{-- FILTERS --}}
    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2" method="GET" action="{{ route('admin.votes.index') }}">
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
                    <select name="entry_id" class="form-select">
                        <option value="">All Entries</option>
                        @foreach ($entries as $e)
                            <option value="{{ $e->id }}" @selected(request('entry_id') == $e->id)>
                                #{{ $e->id }} — {{ $e->title ?? 'Untitled' }}
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
                    <input type="text" name="ip_address" class="form-control" placeholder="Search IP"
                        value="{{ request('ip_address') }}">
                </div>

                <div class="col-12 col-md-3">
                    <input type="date" name="from" class="form-control" value="{{ request('from') }}">
                </div>

                <div class="col-12 col-md-3">
                    <input type="date" name="to" class="form-control" value="{{ request('to') }}">
                </div>

                <div class="col-12 col-md-3">
                    <button class="btn btn-outline-secondary w-100">
                        Filter
                    </button>
                </div>

                <div class="col-12 col-md-3">
                    <a href="{{ route('admin.votes.index') }}" class="btn btn-light w-100">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th style="width:70px;">#</th>
                            <th>User</th>
                            <th>Entry</th>
                            <th>Competition</th>
                            <th>IP</th>
                            <th>Voted At</th>
                            <th style="width:120px;" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($votes as $index => $v)
                            <tr>
                                <td>{{ $votes->firstItem() + $index }}</td>

                                <td>
                                    <div class="fw-semibold">{{ $v->user->name ?? '—' }}</div>
                                    <div class="small text-muted">{{ $v->user->email ?? '' }}</div>
                                </td>

                                <td>
                                    <div class="fw-semibold">
                                        #{{ $v->entry_id }} — {{ $v->entry->title ?? 'Untitled' }}
                                    </div>
                                </td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $v->competition->title ?? '—' }}
                                    </span>
                                </td>

                                <td>
                                    <code>{{ $v->ip_address ?? '-' }}</code>
                                </td>

                                <td class="small text-muted">
                                    {{ $v->created_at?->format('Y-m-d H:i') }}
                                </td>

                                <td class="text-end">
                                    <x-delete-form :action="route('admin.votes.destroy', $v)" text="Delete this vote?" buttonLabel="Delete" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    No votes found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $votes->links() }}
    </div>
@endsection
