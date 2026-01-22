@extends('layouts.app')

@section('title', 'Media Details')
@section('content')
    <div class="container-fluid px-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="m-0 font-weight-bold">Media Details</h6>
                            <p class="text-sm mb-0 text-muted">View and manage media file</p>
                        </div>
                        <a href="{{ route('admin.media.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Media Library
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            {{-- Left Column: Media Preview --}}
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="m-0 font-weight-bold">Preview</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        @if (str_starts_with($media->mime_type, 'image/'))
                                            <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}"
                                                class="img-fluid rounded" style="max-height: 400px;">
                                        @elseif(str_starts_with($media->mime_type, 'video/'))
                                            <div class="bg-dark rounded p-4">
                                                <i class="fas fa-video fa-5x text-white mb-3"></i>
                                                <p class="text-white mb-0">Video File</p>
                                            </div>
                                        @elseif($media->mime_type == 'application/pdf')
                                            <div class="bg-danger rounded p-4">
                                                <i class="fas fa-file-pdf fa-5x text-white mb-3"></i>
                                                <p class="text-white mb-0">PDF Document</p>
                                            </div>
                                        @else
                                            <div class="bg-secondary rounded p-4">
                                                <i class="fas fa-file fa-5x text-white mb-3"></i>
                                                <p class="text-white mb-0">{{ $media->mime_type }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ $media->getUrl() }}" target="_blank"
                                                class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-external-link-alt me-1"></i> Open
                                            </a>
                                            <a href="{{ route('admin.media.download', $media) }}"
                                                class="btn btn-outline-success btn-sm">
                                                <i class="fas fa-download me-1"></i> Download
                                            </a>
                                            <button type="button" class="btn btn-outline-info btn-sm"
                                                onclick="copyToClipboard('{{ $media->getUrl() }}')">
                                                <i class="fas fa-copy me-1"></i> Copy URL
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Right Column: Media Details --}}
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="m-0 font-weight-bold">File Information</h6>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="40%">File Name</th>
                                                <td>{{ $media->file_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Display Name</th>
                                                <td>{{ $media->name ?: 'Not set' }}</td>
                                            </tr>
                                            <tr>
                                                <th>File Type</th>
                                                <td>
                                                    <span class="badge bg-info">
                                                        {{ $media->mime_type }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>File Size</th>
                                                <td>
                                                    {{ \App\Helpers\MediaHelper::formatBytes($media->size) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Collection</th>
                                                <td>
                                                    <span class="badge bg-secondary">
                                                        {{ $media->collection_name ?: 'default' }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Dimensions</th>
                                                <td>
                                                    @if ($media->hasCustomProperty('width') && $media->hasCustomProperty('height'))
                                                        {{ $media->getCustomProperty('width') }} ×
                                                        {{ $media->getCustomProperty('height') }} pixels
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Uploaded On</th>
                                                <td>{{ $media->created_at->format('F d, Y h:i A') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Last Modified</th>
                                                <td>{{ $media->updated_at->format('F d, Y h:i A') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Disk</th>
                                                <td>{{ $media->disk }}</td>
                                            </tr>
                                            <tr>
                                                <th>Model Type</th>
                                                <td>{{ $media->model_type }}</td>
                                            </tr>
                                        </table>

                                        <div class="mt-4">
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.media.edit', $media) }}" class="btn btn-primary">
                                                    <i class="fas fa-edit me-1"></i> Edit Details
                                                </a>
                                                <form action="{{ route('admin.media.destroy', $media) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this file?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash me-1"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- URL Information --}}
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="m-0 font-weight-bold">URL Information</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label mb-1">Direct URL</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" value="{{ $media->getUrl() }}"
                                                    readonly id="directUrl">
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="copyToClipboard('{{ $media->getUrl() }}')">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </div>
                                        </div>

                                        @if ($media->hasGeneratedConversion('thumb'))
                                            <div class="form-group">
                                                <label class="form-label mb-1">Thumbnail URL</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        value="{{ $media->getUrl('thumb') }}" readonly id="thumbUrl">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        onclick="copyToClipboard('{{ $media->getUrl('thumb') }}')">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="mt-3">
                                            <h6>Usage Example:</h6>
                                            <pre class="bg-light p-3 rounded"><code>&lt;img src="{{ $media->getUrl() }}" alt="{{ $media->name }}"&gt;</code></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Related Files --}}
                        @if ($related->isNotEmpty())
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="m-0 font-weight-bold">Related Files</h6>
                                            <p class="text-sm mb-0 text-muted">Other files in the same collection</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                @foreach ($related as $item)
                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="card media-thumb-card"
                                                            onclick="window.location.href='{{ route('admin.media.show', $item) }}'"
                                                            style="cursor: pointer;">
                                                            <div class="card-img-top">
                                                                @if (str_starts_with($item->mime_type, 'image/'))
                                                                    <img src="{{ $item->getUrl() }}"
                                                                        alt="{{ $item->name }}" class="img-fluid"
                                                                        style="height: 100px; width: 100%; object-fit: cover;">
                                                                @else
                                                                    <div class="bg-secondary text-center"
                                                                        style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                                                        <i class="fas fa-file fa-2x text-white"></i>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="card-body p-2">
                                                                <h6 class="card-title text-truncate mb-0"
                                                                    title="{{ $item->name }}">
                                                                    {{ $item->name ?: $item->file_name }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // Show success toast
                showToast('URL copied to clipboard!', 'success');
            }).catch(function(err) {
                console.error('Failed to copy: ', err);
                showToast('Failed to copy URL', 'error');
            });
        }

        function showToast(message, type = 'success') {
            // Create toast element
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

            // Initialize and show toast
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();

            // Remove from DOM after hide
            toast.addEventListener('hidden.bs.toast', function() {
                document.body.removeChild(toast);
            });
        }
    </script>

    <style>
        .media-thumb-card {
            transition: transform 0.2s;
        }

        .media-thumb-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .table th {
            background-color: #f8f9fc;
            font-weight: 600;
        }

        .badge {
            font-size: 0.75em;
            padding: 0.35em 0.65em;
        }

        pre code {
            font-size: 0.875rem;
        }

        .card {
            border: 1px solid #e3e6f0;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
        }

        .card-header h6 {
            color: #4e73df;
        }
    </style>
@endsection

@php
    // Helper function for displaying file sizes
    if (!function_exists('formatBytes')) {
        function formatBytes($bytes, $precision = 2)
        {
            $units = ['B', 'KB', 'MB', 'GB', 'TB'];
            $bytes = max($bytes, 0);
            $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
            $pow = min($pow, count($units) - 1);
            $bytes /= pow(1024, $pow);
            return round($bytes, $precision) . ' ' . $units[$pow];
        }
    }
@endphp
