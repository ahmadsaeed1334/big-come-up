@extends('layouts.app')

@section('content')
    <style>
        .search-container {
            position: relative;
        }

        .search-input {
            padding-left: 40px;
            height: 40px;
            font-size: 0.875rem;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 10;
        }

        .clear-search {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            z-index: 10;
        }

        .clear-search:hover {
            color: #dc3545;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">{{ $title ?? 'Artists' }}</h5>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-sm">
                                    <a class="text-secondary" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Artists</li>
                            </ol>
                        </nav>
                    </div>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary mb-0">
                        <i class="fas fa-plus me-1"></i>
                        Add User
                    </a>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6 class="mb-0">Filters</h6>
                <p class="text-sm mb-0 text-muted">Search artist by name, username, or email</p>
            </div>
            <div class="card-body">
                <form class="row g-3" method="GET" action="{{ route('admin.artists-profile.index') }}">
                    <div class="col-12 col-md-6">
                        <div class="search-container">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" name="q" class="form-control search-input"
                                placeholder="Search name / username / email..." value="{{ request('q') }}">
                            @if (request('q'))
                                <a href="{{ route('admin.artists-profile.index') }}" class="clear-search">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <button class="btn btn-outline-secondary w-100 mb-0" type="submit">Search</button>
                    </div>

                    @if (request('q'))
                        <div class="col-12 col-md-3">
                            <a href="{{ route('admin.artists-profile.index') }}" class="btn btn-outline-danger w-100 mb-0">
                                <i class="fas fa-times me-1"></i> Clear
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">Artists List</h6>
                                <p class="text-sm mb-0 text-muted">
                                    @if (request('q'))
                                        Showing results for <strong class="text-dark">"{{ request('q') }}"</strong>
                                    @else
                                        Showing all artists
                                    @endif
                                </p>
                            </div>
                            <div>
                                <span class="badge bg-gradient-info">Total: {{ $artists->total() }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        @if ($artists->count() > 0)
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">
                                                #</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Artist</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Username</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Profile</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 pe-4">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($artists as $index => $artist)
                                            @php
                                                $hasProfile = optional($artist->artistProfile)->exists ?? false;
                                                // safer: check relation loaded? if not, keep simple flag false
                                                $statusBadge = $artist->is_active ? 'success' : 'danger';
                                            @endphp
                                            <tr>
                                                <td class="text-sm ps-4">{{ $artists->firstItem() + $index }}</td>

                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h6 class="mb-0 text-sm">{{ $artist->name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $artist->email }}</p>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <span class="text-sm text-dark">
                                                        {{ $artist->username ? '@' . $artist->username : '—' }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span
                                                        class="badge badge-sm bg-gradient-{{ $artist->artistProfile ? 'success' : 'secondary' }}">
                                                        {{ $artist->artistProfile ? 'Created' : 'Not Created' }}
                                                    </span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span class="badge badge-sm bg-gradient-{{ $statusBadge }}">
                                                        {{ $artist->is_active ? 'Active' : 'Suspended' }}
                                                    </span>
                                                </td>

                                                <td class="align-middle text-end pe-4">
                                                    <div class="d-flex justify-content-end gap-2">
                                                        <a href="{{ route('admin.artists-profile.show', $artist) }}"
                                                            class="btn btn-sm btn-outline-info mb-0 action-btn"
                                                            title="View">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('admin.artists-profile.edit', $artist) }}"
                                                            class="btn btn-sm btn-outline-primary mb-0 action-btn"
                                                            title="Edit Profile">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger mb-0 action-btn"
                                                            onclick="confirmArtistDelete({{ $artist->id }})"
                                                            title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>

                                                        <form id="delete-artist-{{ $artist->id }}"
                                                            action="{{ route('admin.artists-profile.destroy', $artist) }}"
                                                            method="POST" style="display:none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @include('admin.partials.pagination', ['items' => $artists])
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-user-music fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted mb-2">
                                    @if (request('q'))
                                        No artists found matching your search
                                    @else
                                        No artists found
                                    @endif
                                </h6>
                                @if (request('q'))
                                    <a href="{{ route('admin.artists-profile.index') }}"
                                        class="btn btn-sm btn-outline-primary mt-2">
                                        Show all artists
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmArtistDelete(artistId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This artist will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#8392ab',
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-artist-' + artistId).submit();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="q"]');
            let t;

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(t);
                    t = setTimeout(() => this.form.submit(), 500);
                });
            }
        });
    </script>
@endsection
