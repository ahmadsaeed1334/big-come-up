@extends('layouts.app')

@section('title', 'Media Statistics')

@section('content')
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3>Media Library Statistics</h3>
                                <p class="text-sm mb-0 text-muted">Comprehensive overview of media library usage</p>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.media.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-upload me-1"></i> Upload Files
                                </a>
                                <a href="{{ route('admin.media.index') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-arrow-left me-1"></i> Back to Library
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
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Files</p>
                                                    <h5 class="font-weight-bolder">
                                                        {{ number_format($totalFiles) }}
                                                    </h5>
                                                    <p class="mb-0 text-sm">
                                                        <span class="text-success text-sm font-weight-bolder">
                                                            <i class="fas fa-database me-1"></i>
                                                            {{ \App\Helpers\MediaHelper::formatBytes($totalSize) }}
                                                        </span>
                                                        total storage
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                                    <i class="fas fa-file-archive text-lg opacity-10"></i>
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
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Images</p>
                                                    <h5 class="font-weight-bolder">
                                                        {{ number_format($imageCount = $byMimeType->where('type', 'image')->first()->count ?? 0) }}
                                                    </h5>
                                                    <p class="mb-0 text-sm">
                                                        <span class="text-success text-sm font-weight-bolder">
                                                            @if ($totalFiles > 0)
                                                                {{ number_format(($imageCount / $totalFiles) * 100, 1) }}%
                                                            @else
                                                                0%
                                                            @endif
                                                        </span>
                                                        of total files
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
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
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Videos</p>
                                                    <h5 class="font-weight-bolder">
                                                        {{ number_format($videoCount = $byMimeType->where('type', 'video')->first()->count ?? 0) }}
                                                    </h5>
                                                    <p class="mb-0 text-sm">
                                                        <span class="text-warning text-sm font-weight-bolder">
                                                            @if ($totalFiles > 0)
                                                                {{ number_format(($videoCount / $totalFiles) * 100, 1) }}%
                                                            @else
                                                                0%
                                                            @endif
                                                        </span>
                                                        of total files
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                                    <i class="fas fa-video text-lg opacity-10"></i>
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
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Documents</p>
                                                    <h5 class="font-weight-bolder">
                                                        {{ number_format($docCount = $byMimeType->where('type', 'application')->first()->count ?? 0) }}
                                                    </h5>
                                                    <p class="mb-0 text-sm">
                                                        <span class="text-info text-sm font-weight-bolder">
                                                            @if ($totalFiles > 0)
                                                                {{ number_format(($docCount / $totalFiles) * 100, 1) }}%
                                                            @else
                                                                0%
                                                            @endif
                                                        </span>
                                                        of total files
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                                    <i class="fas fa-file-alt text-lg opacity-10"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="row mx-3">
                            {{-- File Type Distribution Chart --}}
                            <div class="col-lg-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                        <h6>File Type Distribution</h6>
                                        <small class="text-muted">Visual breakdown</small>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="chart-container" style="position: relative; height: 300px;">
                                            <canvas id="typeChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Collection Distribution --}}
                            <div class="col-lg-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                        <h6>Collection Distribution</h6>
                                        <small class="text-muted">Files per collection</small>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Collection</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Files</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Percentage</th>
                                                        <th class="text-secondary opacity-7"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($byCollection as $collection)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div>
                                                                        <div
                                                                            class="icon icon-shape bg-gradient-secondary shadow text-center border-radius me-3">
                                                                            <i class="fas fa-folder text-white"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm">
                                                                            {{ $collection->collection_name ?: 'default' }}
                                                                        </h6>
                                                                        <p class="text-xs text-secondary mb-0">
                                                                            @if ($collection->collection_name)
                                                                                {{ str_replace('_', ' ', $collection->collection_name) }}
                                                                            @else
                                                                                Default collection
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <span class="badge badge-sm bg-gradient-primary">
                                                                    {{ $collection->count }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="progress-wrapper w-100 mx-2">
                                                                        <div class="progress-info">
                                                                            <span class="text-xs font-weight-bold">
                                                                                @if ($totalFiles > 0)
                                                                                    {{ number_format(($collection->count / $totalFiles) * 100, 1) }}%
                                                                                @else
                                                                                    0%
                                                                                @endif
                                                                            </span>
                                                                        </div>
                                                                        <div class="progress" style="height: 6px;">
                                                                            <div class="progress-bar bg-gradient-primary"
                                                                                role="progressbar"
                                                                                style="width: {{ $totalFiles > 0 ? ($collection->count / $totalFiles) * 100 : 0 }}%">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="align-middle">
                                                                <a href="{{ route('admin.media.index', ['collection_name' => $collection->collection_name]) }}"
                                                                    class="btn btn-sm btn-outline-primary">
                                                                    <i class="fas fa-eye me-1"></i> View
                                                                </a>
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

                        {{-- Recent Uploads & Largest Files --}}
                        <div class="row mx-3">
                            <div class="col-lg-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                        <h6>Recent Uploads</h6>
                                        <small><a href="{{ route('admin.media.index') }}">View All</a></small>
                                    </div>
                                    <div class="card-body p-0 pt-3">
                                        <div class="table-responsive">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                                                    @foreach ($recentUploads as $media)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div>
                                                                        @if (str_starts_with($media->mime_type, 'image/'))
                                                                            <div
                                                                                class="avatar avatar-sm bg-gradient-primary me-3 d-flex align-items-center justify-content-center">
                                                                                <i class="fas fa-image text-white"></i>
                                                                            </div>
                                                                        @elseif(str_starts_with($media->mime_type, 'video/'))
                                                                            <div
                                                                                class="avatar avatar-sm bg-gradient-success me-3 d-flex align-items-center justify-content-center">
                                                                                <i class="fas fa-video text-white"></i>
                                                                            </div>
                                                                        @elseif($media->mime_type == 'application/pdf')
                                                                            <div
                                                                                class="avatar avatar-sm bg-gradient-danger me-3 d-flex align-items-center justify-content-center">
                                                                                <i class="fas fa-file-pdf text-white"></i>
                                                                            </div>
                                                                        @else
                                                                            <div
                                                                                class="avatar avatar-sm bg-gradient-secondary me-3 d-flex align-items-center justify-content-center">
                                                                                <i class="fas fa-file text-white"></i>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm text-truncate"
                                                                            style="max-width: 150px;">
                                                                            {{ $media->name ?: $media->file_name }}
                                                                        </h6>
                                                                        <p class="text-xs text-secondary mb-0">
                                                                            {{ strtoupper(\App\Helpers\MediaHelper::getExtension($media->file_name)) }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge badge-sm bg-gradient-{{ str_starts_with($media->mime_type, 'image/')
                                                                        ? 'primary'
                                                                        : (str_starts_with($media->mime_type, 'video/')
                                                                            ? 'success'
                                                                            : ($media->mime_type == 'application/pdf'
                                                                                ? 'danger'
                                                                                : 'secondary')) }}">
                                                                    {{ \App\Helpers\MediaHelper::getFileType($media->mime_type) }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="text-xs font-weight-bold">
                                                                    {{ \App\Helpers\MediaHelper::formatBytes($media->size) }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="text-secondary text-xs font-weight-bold">
                                                                    {{ $media->created_at->diffForHumans() }}
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

                            <div class="col-lg-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                        <h6>Largest Files</h6>
                                        <small><a href="{{ route('admin.media.index') }}">View All</a></small>
                                    </div>
                                    <div class="card-body p-0 pt-3">
                                        <div class="table-responsive">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            File</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Collection</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Size</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Uploaded</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($largestFiles as $media)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div>
                                                                        @if (str_starts_with($media->mime_type, 'image/'))
                                                                            <div
                                                                                class="avatar avatar-sm bg-gradient-primary me-3 d-flex align-items-center justify-content-center">
                                                                                <i class="fas fa-image text-white"></i>
                                                                            </div>
                                                                        @elseif(str_starts_with($media->mime_type, 'video/'))
                                                                            <div
                                                                                class="avatar avatar-sm bg-gradient-success me-3 d-flex align-items-center justify-content-center">
                                                                                <i class="fas fa-video text-white"></i>
                                                                            </div>
                                                                        @elseif($media->mime_type == 'application/pdf')
                                                                            <div
                                                                                class="avatar avatar-sm bg-gradient-danger me-3 d-flex align-items-center justify-content-center">
                                                                                <i class="fas fa-file-pdf text-white"></i>
                                                                            </div>
                                                                        @else
                                                                            <div
                                                                                class="avatar avatar-sm bg-gradient-secondary me-3 d-flex align-items-center justify-content-center">
                                                                                <i class="fas fa-file text-white"></i>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm text-truncate"
                                                                            style="max-width: 150px;">
                                                                            {{ $media->name ?: $media->file_name }}
                                                                        </h6>
                                                                        <p class="text-xs text-secondary mb-0">
                                                                            {{ strtoupper(\App\Helpers\MediaHelper::getExtension($media->file_name)) }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <span class="badge badge-sm bg-gradient-info">
                                                                    {{ $media->collection_name ?: 'default' }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="text-xs font-weight-bold text-danger">
                                                                    {{ \App\Helpers\MediaHelper::formatBytes($media->size) }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="text-secondary text-xs font-weight-bold">
                                                                    {{ $media->created_at->format('M d, Y') }}
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

                        {{-- Storage Overview --}}
                        <div class="row mx-3">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header pb-0">
                                        <h6>Storage Overview</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-lg-4 text-center">
                                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle mb-3"
                                                    style="width: 80px; height: 80px;">
                                                    <i class="fas fa-hdd fa-2x text-white opacity-10"></i>
                                                </div>
                                                <h3 class="text-gradient text-primary mb-0">
                                                    {{ \App\Helpers\MediaHelper::formatBytes($totalSize) }}
                                                </h3>
                                                <p class="text-muted mb-0">Total Storage Used</p>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    @php
                                                        $imageCount =
                                                            $byMimeType->where('type', 'image')->first()->count ?? 0;
                                                        $videoCount =
                                                            $byMimeType->where('type', 'video')->first()->count ?? 0;
                                                        $docCount =
                                                            $byMimeType->where('type', 'application')->first()->count ??
                                                            0;
                                                        $otherCount =
                                                            $totalFiles - ($imageCount + $videoCount + $docCount);
                                                    @endphp

                                                    <div class="col-3 text-center">
                                                        <div
                                                            class="icon icon-shape bg-gradient-primary shadow text-center border-radius-lg mb-2">
                                                            <i class="fas fa-image text-white"></i>
                                                        </div>
                                                        <h5 class="mb-1">{{ number_format($imageCount) }}</h5>
                                                        <small class="text-muted">Images</small>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <div
                                                            class="icon icon-shape bg-gradient-success shadow text-center border-radius-lg mb-2">
                                                            <i class="fas fa-video text-white"></i>
                                                        </div>
                                                        <h5 class="mb-1">{{ number_format($videoCount) }}</h5>
                                                        <small class="text-muted">Videos</small>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <div
                                                            class="icon icon-shape bg-gradient-warning shadow text-center border-radius-lg mb-2">
                                                            <i class="fas fa-file-alt text-white"></i>
                                                        </div>
                                                        <h5 class="mb-1">{{ number_format($docCount) }}</h5>
                                                        <small class="text-muted">Documents</small>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <div
                                                            class="icon icon-shape bg-gradient-info shadow text-center border-radius-lg mb-2">
                                                            <i class="fas fa-file text-white"></i>
                                                        </div>
                                                        <h5 class="mb-1">{{ number_format($otherCount) }}</h5>
                                                        <small class="text-muted">Others</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // File Type Distribution Chart
            const typeCtx = document.getElementById('typeChart').getContext('2d');

            // Prepare data for chart
            const labels = [];
            const data = [];
            const backgroundColors = [];

            // Color mapping based on type
            const colorMap = {
                'image': '#4e73df', // Primary
                'video': '#1cc88a', // Success
                'application': '#36b9cc', // Info
                'audio': '#f6c23e', // Warning
                'text': '#e74a3b', // Danger
                'other': '#858796' // Secondary
            };

            @foreach ($byMimeType as $type)
                labels.push('{{ ucfirst($type->type) }}');
                data.push({{ $type->count }});
                backgroundColors.push(colorMap['{{ strtolower($type->type) }}'] || '#858796');
            @endforeach

            // Create chart
            new Chart(typeCtx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: backgroundColors,
                        borderWidth: 2,
                        borderColor: '#fff',
                        hoverOffset: 15
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                font: {
                                    size: 11
                                },
                                generateLabels: function(chart) {
                                    const data = chart.data;
                                    if (data.labels.length && data.datasets.length) {
                                        return data.labels.map(function(label, i) {
                                            const value = data.datasets[0].data[i];
                                            const total = {{ $totalFiles }};
                                            const percentage = total > 0 ? Math.round((value /
                                                total) * 100) : 0;
                                            return {
                                                text: label + ' (' + percentage + '%)',
                                                fillStyle: data.datasets[0].backgroundColor[i],
                                                hidden: false,
                                                index: i
                                            };
                                        });
                                    }
                                    return [];
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = {{ $totalFiles }};
                                    const percentage = total > 0 ? ((value / total) * 100).toFixed(1) :
                                        0;
                                    return `${label}: ${value} files (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '60%',
                    animation: {
                        animateScale: true,
                        animateRotate: true,
                        duration: 1000
                    }
                }
            });
        });
    </script>
@endpush
