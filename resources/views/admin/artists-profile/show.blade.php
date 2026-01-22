@extends('layouts.app')

@section('title', 'Artist Profile - ' . $artist->name)

@section('content')
    <div class="container-fluid px-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="m-0 font-weight-bold text-primary">Artist Profile</h6>
                            <p class="text-sm mb-0 text-muted">View artist details</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.artists-profile.index') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back
                            </a>
                            <a href="{{ route('admin.artists-profile.edit', $artist) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit me-1"></i> Edit Profile
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        @php
                            $profile = $profile ?? $artist->artistProfile;
                            $avatarUrl = $profile?->avatar_path ? Storage::url($profile->avatar_path) : null;
                            $bannerUrl = $profile?->banner_path ? Storage::url($profile->banner_path) : null;
                            $social = (array) ($profile?->social_links ?? []);
                        @endphp

                        <div class="card mb-4 border-left-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            @if ($avatarUrl)
                                                <img src="{{ $avatarUrl }}" class="rounded-circle"
                                                    style="width: 55px;height:55px;object-fit:cover;" alt="">
                                            @else
                                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 55px;height:55px;">
                                                    {{ strtoupper(substr($artist->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h5 class="mb-0">{{ $artist->name }}</h5>
                                            <p class="text-muted mb-0">
                                                {{ $artist->username ? '@' . $artist->username : $artist->email }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge bg-{{ $artist->is_active ? 'success' : 'danger' }}">
                                            <i
                                                class="fas fa-{{ $artist->is_active ? 'check-circle' : 'times-circle' }} me-1"></i>
                                            {{ $artist->is_active ? 'Active' : 'Suspended' }}
                                        </span>
                                        <span class="badge bg-info">
                                            <i class="fas fa-user-tag me-1"></i> Artist
                                        </span>
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-clock me-1"></i>
                                            Joined {{ $artist->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Banner preview --}}
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <h6 class="mb-0">Banner</h6>
                            </div>
                            <div class="card-body">
                                @if ($bannerUrl)
                                    <img src="{{ $bannerUrl }}" alt="Banner" class="img-fluid rounded"
                                        style="max-height:220px; width:100%; object-fit:cover;">
                                @else
                                    <div class="text-muted">No banner uploaded.</div>
                                @endif
                            </div>
                        </div>

                        {{-- Profile Info --}}
                        <div class="card">
                            <div class="card-header pb-0">
                                <h6 class="mb-0">Profile Information</h6>
                                <p class="text-sm mb-0 text-muted">Artist bio, location, and settings</p>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label text-primary mb-1">Bio</label>
                                        <div class="text-sm text-dark">
                                            {{ $profile?->bio ?: '—' }}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label text-primary mb-1">City</label>
                                        <div class="text-sm text-dark">{{ $profile?->location_city ?: '—' }}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label text-primary mb-1">Country</label>
                                        <div class="text-sm text-dark">{{ $profile?->location_country ?: '—' }}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label text-primary mb-1">Public Profile</label>
                                        <div>
                                            <span
                                                class="badge bg-{{ $profile?->is_public ?? false ? 'success' : 'secondary' }}">
                                                {{ $profile?->is_public ?? false ? 'Yes' : 'No' }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label text-primary mb-1">Allow Messages</label>
                                        <div>
                                            <span
                                                class="badge bg-{{ $profile?->allow_messages ?? false ? 'success' : 'secondary' }}">
                                                {{ $profile?->allow_messages ?? false ? 'Yes' : 'No' }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label text-primary mb-1">Social Links</label>
                                        @if (!empty(array_filter($social)))
                                            <ul class="mb-0">
                                                @foreach ($social as $key => $val)
                                                    @if ($val)
                                                        <li class="text-sm">
                                                            <strong>{{ ucfirst($key) }}:</strong>
                                                            <a href="{{ $val }}" target="_blank" rel="noopener">
                                                                {{ $val }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @else
                                            <div class="text-muted">—</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-4 pt-3 border-top d-flex justify-content-end">
                                    <a href="{{ route('admin.artists-profile.edit', $artist) }}" class="btn btn-primary">
                                        <i class="fas fa-edit me-1"></i> Edit Profile
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .border-left-primary {
            border-left: 4px solid #4e73df !important;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.875rem;
        }
    </style>
@endsection
