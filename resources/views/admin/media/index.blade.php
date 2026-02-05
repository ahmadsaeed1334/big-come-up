@extends('layouts.app')

@section('title', 'Media Library')

@section('content')
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3>Media Library</h3>
                                <p class="text-sm mb-0 text-muted">Manage all uploaded files and images</p>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.media.statistics') }}" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-chart-bar me-1"></i> Statistics
                                </a>
                                <a href="{{ route('admin.media.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-upload me-1"></i> Upload Files
                                </a>
                            </div>
                        </div>

                        {{-- Statistics Cards --}}
                        <div class="row mt-3">
                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Images</p>
                                                    <h5 class="font-weight-bolder">
                                                        {{ $totalImages ?? 0 }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                                    <i class="fas fa-image text-lg opacity-10"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Videos</p>
                                                    <h5 class="font-weight-bolder">
                                                        {{ $totalVideos ?? 0 }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                                    <i class="fas fa-video text-lg opacity-10"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Documents
                                                    </p>
                                                    <h5 class="font-weight-bolder">
                                                        {{ $totalDocuments ?? 0 }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                                    <i class="fas fa-file-alt text-lg opacity-10"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Other Files</p>
                                                    <h5 class="font-weight-bolder">
                                                        {{ $totalOthers ?? 0 }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                                    <i class="fas fa-file text-lg opacity-10"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Search & Filters Form --}}
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <form method="GET" action="{{ route('admin.media.index') }}" class="mb-0">
                                    <div class="row g-3">
                                        {{-- Search --}}
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-search search-icon"></i>
                                                </span>
                                                <input type="text" class="form-control border-start-0" name="search"
                                                    placeholder="Search by filename, name, or type..."
                                                    value="{{ request('search') }}">
                                            </div>
                                        </div>

                                        {{-- File Type --}}
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-filter"></i>
                                                </span>
                                                <select name="type" class="form-select border-start-0">
                                                    <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>
                                                        All Types</option>
                                                    <option value="image"
                                                        {{ request('type') == 'image' ? 'selected' : '' }}>Images</option>
                                                    <option value="video"
                                                        {{ request('type') == 'video' ? 'selected' : '' }}>Videos</option>
                                                    <option value="pdf"
                                                        {{ request('type') == 'pdf' ? 'selected' : '' }}>PDFs</option>
                                                    <option value="document"
                                                        {{ request('type') == 'document' ? 'selected' : '' }}>Documents
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- Sort By --}}
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-sort"></i>
                                                </span>
                                                <select name="sort" class="form-select border-start-0">
                                                    <option value="newest"
                                                        {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First
                                                    </option>
                                                    <option value="oldest"
                                                        {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First
                                                    </option>
                                                    <option value="largest"
                                                        {{ request('sort') == 'largest' ? 'selected' : '' }}>Largest Files
                                                    </option>
                                                    <option value="smallest"
                                                        {{ request('sort') == 'smallest' ? 'selected' : '' }}>Smallest
                                                        Files</option>
                                                    <option value="name_asc"
                                                        {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name A-Z
                                                    </option>
                                                    <option value="name_desc"
                                                        {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name Z-A
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- Actions --}}
                                        <div class="col-md-3">
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn bg-gradient-primary mb-0">
                                                    <i class="fas fa-search me-1"></i> Filter
                                                </button>
                                                @if (request()->hasAny(['search', 'type', 'sort']))
                                                    <a href="{{ route('admin.media.index') }}"
                                                        class="btn bg-gradient-secondary mb-0">
                                                        <i class="fas fa-times me-1"></i> Clear
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Search Results Info --}}
                        @if (request()->hasAny(['search', 'type', 'sort']))
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="alert alert-light py-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                @if (request('search'))
                                                    <span class="text-sm">Search:
                                                        <strong>"{{ request('search') }}"</strong></span>
                                                @endif
                                                @if (request('type') && request('type') != 'all')
                                                    <span class="text-sm ms-3">Type:
                                                        <strong>{{ ucfirst(request('type')) }}</strong></span>
                                                @endif
                                                @if (request('sort'))
                                                    <span class="text-sm ms-3">Sorted by:
                                                        <strong>{{ ucfirst(str_replace('_', ' ', request('sort'))) }}</strong></span>
                                                @endif
                                                <span class="text-sm ms-3">Found: <strong>{{ $media->total() }}
                                                        files</strong></span>
                                            </div>
                                            @if (request()->hasAny(['search', 'type', 'sort']))
                                                <a href="{{ route('admin.media.index') }}"
                                                    class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-times me-1"></i> Clear All
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                                <i class="bi bi-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if ($media->isEmpty())
                            <div class="text-center py-5">
                                <i class="fas fa-images display-1 text-muted"></i>
                                <h5 class="mt-3">No media files found</h5>
                                <p class="text-muted">
                                    @if (request()->hasAny(['search', 'type', 'sort']))
                                        No files match your search criteria
                                    @else
                                        Upload your first file to get started
                                    @endif
                                </p>
                                <a href="{{ route('admin.media.create') }}" class="btn btn-primary mt-2">
                                    <i class="fas fa-upload me-1"></i> Upload Files
                                </a>
                            </div>
                        @else
                            <div class="row g-3 mx-3">
                                @foreach ($media as $item)
                                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                        <div class="card media-card" data-media-id="{{ $item->id }}">
                                            <div class="card-img-top position-relative">
                                                @if (str_starts_with($item->mime_type, 'image/'))
                                                    <img src="{{ $item->getUrl() }}" alt="{{ $item->name }}"
                                                        class="img-fluid"
                                                        style="height: 150px; width: 100%; object-fit: cover; border-radius: 0.375rem 0.375rem 0 0;">
                                                @elseif(str_starts_with($item->mime_type, 'video/'))
                                                    <div class="bg-dark text-center"
                                                        style="height: 150px; display: flex; align-items: center; justify-content: center; border-radius: 0.375rem 0.375rem 0 0;">
                                                        <i class="fas fa-video fa-3x text-white"></i>
                                                    </div>
                                                @elseif($item->mime_type == 'application/pdf')
                                                    <div class="bg-danger text-center"
                                                        style="height: 150px; display: flex; align-items: center; justify-content: center; border-radius: 0.375rem 0.375rem 0 0;">
                                                        <i class="fas fa-file-pdf fa-3x text-white"></i>
                                                    </div>
                                                @elseif(in_array($item->mime_type, [
                                                        'application/msword',
                                                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                                    ]))
                                                    <div class="bg-primary text-center"
                                                        style="height: 150px; display: flex; align-items: center; justify-content: center; border-radius: 0.375rem 0.375rem 0 0;">
                                                        <i class="fas fa-file-word fa-3x text-white"></i>
                                                    </div>
                                                @elseif(in_array($item->mime_type, [
                                                        'application/vnd.ms-excel',
                                                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                                    ]))
                                                    <div class="bg-success text-center"
                                                        style="height: 150px; display: flex; align-items: center; justify-content: center; border-radius: 0.375rem 0.375rem 0 0;">
                                                        <i class="fas fa-file-excel fa-3x text-white"></i>
                                                    </div>
                                                @else
                                                    <div class="bg-secondary text-center"
                                                        style="height: 150px; display: flex; align-items: center; justify-content: center; border-radius: 0.375rem 0.375rem 0 0;">
                                                        <i class="fas fa-file fa-3x text-white"></i>
                                                    </div>
                                                @endif

                                                {{-- Quick Actions Overlay --}}
                                                <div class="position-absolute top-0 end-0 p-2">
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button" class="btn btn-light"
                                                            onclick="copyToClipboard('{{ $item->getUrl() }}')"
                                                            title="Copy URL">
                                                            <i class="fas fa-link"></i>
                                                        </button>
                                                        <a href="{{ route('admin.media.show', $item) }}"
                                                            class="btn btn-light" title="View Details">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-body p-3">
                                                <h6 class="card-title text-truncate mb-1" title="{{ $item->name }}">
                                                    {{ $item->name ?: $item->file_name }}
                                                </h6>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">
                                                        {{ strtoupper(\App\Helpers\MediaHelper::getExtension($item->file_name)) }}
                                                    </small>
                                                    <small class="text-muted">
                                                        {{ \App\Helpers\MediaHelper::formatBytes($item->size) }}
                                                    </small>
                                                </div>
                                            </div>

                                            <div class="card-footer p-2 bg-light">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">
                                                        {{ $item->created_at->format('M d, Y') }}
                                                    </small>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li>
                                                                <a class="dropdown-item" href="{{ $item->getUrl() }}"
                                                                    target="_blank">
                                                                    <i class="fas fa-external-link-alt me-2"></i> Open
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.media.download', $item) }}">
                                                                    <i class="fas fa-download me-2"></i> Download
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.media.edit', $item) }}">
                                                                    <i class="fas fa-edit me-2"></i> Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);"
                                                                    class="dropdown-item text-danger"
                                                                    onclick="confirmMediaDelete({{ json_encode([
                                                                        'id' => $item->id,
                                                                        'name' => $item->name ?: $item->file_name,
                                                                        'url' => route('admin.media.destroy', $item),
                                                                    ]) }})">
                                                                    <i class="fas fa-trash me-2"></i> Delete
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Pagination --}}
                            <div class="px-3 pt-3">
                                @include('admin.partials.pagination', ['items' => $media])
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Additional Cards --}}
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Quick Actions</h6>
                    </div>
                    <div class="card-body p-0 pt-3">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('admin.media.create') }}"
                                class="list-group-item list-group-item-action d-flex align-items-center border-0">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius me-3">
                                    <i class="fas fa-upload text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-sm">Upload Files</h6>
                                    <small class="text-muted">Upload new files to the library</small>
                                </div>
                            </a>
                            <a href="{{ route('admin.media.statistics') }}"
                                class="list-group-item list-group-item-action d-flex align-items-center border-0">
                                <div class="icon icon-shape bg-gradient-success shadow text-center border-radius me-3">
                                    <i class="fas fa-chart-bar text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-sm">View Statistics</h6>
                                    <small class="text-muted">Detailed media usage statistics</small>
                                </div>
                            </a>
                            <a href="#"
                                class="list-group-item list-group-item-action d-flex align-items-center border-0">
                                <div class="icon icon-shape bg-gradient-info shadow text-center border-radius me-3">
                                    <i class="fas fa-download text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-sm">Bulk Download</h6>
                                    <small class="text-muted">Download multiple files at once</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Recent Uploads</h6>
                        <small><a href="{{ route('admin.media.index') }}">View All</a></small>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            File</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Type</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Size</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Uploaded</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentMedia as $recent)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        @if (str_starts_with($recent->mime_type, 'image/'))
                                                            <img src="{{ $recent->getUrl() }}"
                                                                class="avatar avatar-sm me-3" alt="{{ $recent->name }}"
                                                                style="object-fit: cover;">
                                                        @elseif(str_starts_with($recent->mime_type, 'video/'))
                                                            <div
                                                                class="avatar avatar-sm bg-dark me-3 d-flex align-items-center justify-content-center">
                                                                <i class="fas fa-video text-white"></i>
                                                            </div>
                                                        @elseif($recent->mime_type == 'application/pdf')
                                                            <div
                                                                class="avatar avatar-sm bg-danger me-3 d-flex align-items-center justify-content-center">
                                                                <i class="fas fa-file-pdf text-white"></i>
                                                            </div>
                                                        @else
                                                            <div
                                                                class="avatar avatar-sm bg-secondary me-3 d-flex align-items-center justify-content-center">
                                                                <i class="fas fa-file text-white"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm text-truncate" style="max-width: 150px;">
                                                            {{ $recent->name ?: $recent->file_name }}
                                                        </h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ strtoupper(\App\Helpers\MediaHelper::getExtension($recent->file_name)) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-sm bg-gradient-{{ str_starts_with($recent->mime_type, 'image/')
                                                        ? 'primary'
                                                        : (str_starts_with($recent->mime_type, 'video/')
                                                            ? 'success'
                                                            : ($recent->mime_type == 'application/pdf'
                                                                ? 'danger'
                                                                : 'secondary')) }}">
                                                    {{ \App\Helpers\MediaHelper::getFileType($recent->mime_type) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold">
                                                    {{ \App\Helpers\MediaHelper::formatBytes($recent->size) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $recent->created_at->diffForHumans() }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Copy to Clipboard
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                showToast('URL copied to clipboard!', 'success');
            }).catch(function(err) {
                console.error('Failed to copy: ', err);
                showToast('Failed to copy URL', 'error');
            });
        }

        // Show Toast
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-white bg-${type} border-0 position-fixed bottom-0 end-0 m-3`;
            toast.style.zIndex = '1060';
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;

            document.body.appendChild(toast);
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();

            toast.addEventListener('hidden.bs.toast', function() {
                document.body.removeChild(toast);
            });
        }

        function confirmMediaDelete(mediaData) {
            const mediaId = mediaData.id;
            const fileName = mediaData.name;
            const deleteUrl = mediaData.url;

            Swal.fire({
                title: 'Delete File?',
                html: `<div class="text-start">
            <p class="mb-2">Are you sure you want to delete <strong>"${fileName}"</strong>?</p>
            <div class="alert alert-danger py-2 mb-3">
                <i class="fas fa-exclamation-triangle me-2"></i>
                This action cannot be undone! All file data will be permanently removed.
            </div>
        </div>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                width: '450px'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Create and submit form dynamically
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = deleteUrl;
                    form.style.display = 'none';

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';

                    form.appendChild(csrfInput);
                    form.appendChild(methodInput);
                    document.body.appendChild(form);

                    // Show loading
                    Swal.fire({
                        title: 'Deleting...',
                        text: 'Please wait while we delete the file',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Submit form
                    setTimeout(() => {
                        form.submit();
                    }, 500);
                }
            });
        }

        // Auto-submit search on Enter key
        document.querySelector('input[name="search"]')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                this.form.submit();
            }
        });

        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"], [title]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        // Auto-submit filters when changed (optional)
        document.querySelectorAll('select[name="type"], select[name="sort"]').forEach(select => {
            select.addEventListener('change', function() {
                this.form.submit();
            });
        });
    </script>
@endsection
