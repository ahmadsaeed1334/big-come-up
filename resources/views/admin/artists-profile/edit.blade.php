@extends('layouts.app')

@section('title', 'Edit Artist - ' . $artist->name)

@section('content')
    <div class="container-fluid px-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="m-0 font-weight-bold text-primary">Edit Artist Profile</h6>
                            <p class="text-sm mb-0 text-muted">Update artist profile information</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.artists-profile.index') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back
                            </a>
                            <a href="{{ route('admin.artists-profile.show', $artist) }}"
                                class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye me-1"></i> View
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Please fix the following errors:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="card mb-4 border-left-primary">
                            <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div>
                                    <h5 class="mb-0">{{ $artist->name }}</h5>
                                    <p class="text-muted mb-0">{{ $artist->email }}</p>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-info"><i class="fas fa-user-tag me-1"></i> Artist</span>
                                    <span class="badge bg-{{ $artist->is_active ? 'success' : 'danger' }}">
                                        <i
                                            class="fas fa-{{ $artist->is_active ? 'check-circle' : 'times-circle' }} me-1"></i>
                                        {{ $artist->is_active ? 'Active' : 'Suspended' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('admin.artists-profile.update', $artist) }}"
                            class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label text-primary mb-1">Bio</label>
                                        <textarea name="bio" rows="4" class="form-control" placeholder="Write artist bio...">{{ old('bio', $profile->bio) }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-primary mb-1">City</label>
                                        <input type="text" name="location_city" class="form-control"
                                            value="{{ old('location_city', $profile->location_city) }}" placeholder="City">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-primary mb-1">Country</label>
                                        <input type="text" name="location_country" class="form-control"
                                            value="{{ old('location_country', $profile->location_country) }}"
                                            placeholder="Country">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-primary mb-1">Public Profile</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" name="is_public"
                                                value="1" id="is_public"
                                                {{ old('is_public', $profile->is_public) ? 'checked' : '' }}>
                                            <label class="form-check-label ms-2" for="is_public">Visible to public</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-primary mb-1">Allow Messages</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                name="allow_messages" value="1" id="allow_messages"
                                                {{ old('allow_messages', $profile->allow_messages) ? 'checked' : '' }}>
                                            <label class="form-check-label ms-2" for="allow_messages">Allow direct
                                                messages</label>
                                        </div>
                                    </div>
                                </div>

                                @php
                                    $social = (array) ($profile->social_links ?? []);
                                @endphp

                                <div class="col-12">
                                    <div class="card mt-2">
                                        <div class="card-header pb-0">
                                            <h6 class="mb-0">Social Links</h6>
                                            <p class="text-sm mb-0 text-muted">Add links (optional)</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label text-primary mb-1">Instagram</label>
                                                    <input type="text" name="social_links[instagram]"
                                                        class="form-control"
                                                        value="{{ old('social_links.instagram', $social['instagram'] ?? '') }}"
                                                        placeholder="https://instagram.com/...">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label text-primary mb-1">YouTube</label>
                                                    <input type="text" name="social_links[youtube]" class="form-control"
                                                        value="{{ old('social_links.youtube', $social['youtube'] ?? '') }}"
                                                        placeholder="https://youtube.com/...">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label text-primary mb-1">TikTok</label>
                                                    <input type="text" name="social_links[tiktok]"
                                                        class="form-control"
                                                        value="{{ old('social_links.tiktok', $social['tiktok'] ?? '') }}"
                                                        placeholder="https://tiktok.com/@...">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label text-primary mb-1">Website</label>
                                                    <input type="text" name="social_links[website]"
                                                        class="form-control"
                                                        value="{{ old('social_links.website', $social['website'] ?? '') }}"
                                                        placeholder="https://...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-top">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.artists-profile.index') }}"
                                        class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="mt-4 pt-3 border-top d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-danger" onclick="confirmArtistDelete()">
                                <i class="fas fa-trash me-1"></i> Delete Artist
                            </button>

                            <form id="delete-artist" action="{{ route('admin.artists-profile.destroy', $artist) }}"
                                method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .border-left-primary {
            border-left: 4px solid #4e73df !important;
        }

        .form-check-input:checked {
            background-color: #4e73df;
            border-color: #4e73df;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        });

        function confirmArtistDelete() {
            Swal.fire({
                title: 'Delete Artist?',
                text: "This will permanently delete the artist user.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-artist').submit();
                }
            });
        }
    </script>
@endsection
