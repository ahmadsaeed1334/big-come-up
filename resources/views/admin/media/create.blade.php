@extends('layouts.app')

@section('title', 'Upload Media')

@section('content')
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3>Upload Media Files</h3>
                                <p class="text-sm mb-0 text-muted">Upload images, videos, documents, and other files</p>
                            </div>
                            <a href="{{ route('admin.media.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i> Back to Library
                            </a>
                        </div>

                        {{-- Quick Stats --}}
                        <div class="row mt-3">
                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Max File Size
                                                    </p>
                                                    <h5 class="font-weight-bolder">
                                                        {{ ini_get('upload_max_filesize') }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                                    <i class="fas fa-sd-card text-lg opacity-10"></i>
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
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Supported Images
                                                    </p>
                                                    <h5 class="font-weight-bolder">
                                                        JPG, PNG, GIF
                                                    </h5>
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
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Supported Videos
                                                    </p>
                                                    <h5 class="font-weight-bolder">
                                                        MP4, MOV, AVI
                                                    </h5>
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
                                                        PDF, Word, Excel
                                                    </h5>
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
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                                <i class="bi bi-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                Please fix the following errors:
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="row mx-3">
                            <div class="col-lg-8">
                                <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data"
                                    id="uploadForm" class="needs-validation" novalidate>
                                    @csrf

                                    {{-- File Upload Area --}}
                                    <div class="card mb-4">
                                        <div class="card-header pb-0">
                                            <h6>Select Files</h6>
                                            <p class="text-sm text-muted mb-0">Drag & drop files or click to browse</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="file-upload-area" id="dropArea">
                                                <div class="text-center py-5">
                                                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle mb-3 mx-auto"
                                                        style="width: 80px; height: 80px;">
                                                        <i class="fas fa-cloud-upload-alt fa-2x text-white opacity-10"></i>
                                                    </div>
                                                    <h5 class="mb-2">Drop files here or click to upload</h5>
                                                    <p class="text-sm text-muted mb-4">
                                                        Supports images, videos, PDFs, and documents
                                                    </p>
                                                    <input type="file" name="files[]" id="fileInput"
                                                        class="form-control d-none" multiple
                                                        accept="image/*,video/*,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.mp3,.wav"
                                                        required>
                                                    <button type="button" class="btn bg-gradient-primary mb-0"
                                                        onclick="document.getElementById('fileInput').click()">
                                                        <i class="fas fa-folder-open me-1"></i> Browse Files
                                                    </button>
                                                    <div class="mt-3 text-sm text-muted">
                                                        <i class="fas fa-info-circle me-1"></i>
                                                        Max file size: {{ ini_get('upload_max_filesize') }}
                                                    </div>
                                                </div>
                                                <div class="file-upload-preview mt-3" id="filePreview"></div>
                                            </div>
                                            <div class="form-text text-muted mt-2">
                                                <i class="fas fa-check-circle text-success me-1"></i>
                                                Supported: Images (JPG, PNG, GIF, BMP, WEBP, SVG), Videos (MP4, MOV, AVI,
                                                WMV),
                                                PDF, Word, Excel, PowerPoint, Audio (MP3, WAV)
                                            </div>
                                        </div>
                                    </div>

                                    {{-- File Details --}}
                                    <div class="card mb-4">
                                        <div class="card-header pb-0">
                                            <h6>File Details</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                {{-- Collection Name --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label mb-1">Collection Name</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-folder text-primary"></i>
                                                            </span>
                                                            <input type="text" name="collection_name"
                                                                class="form-control border-start-0"
                                                                placeholder="e.g., blog-images, gallery, documents"
                                                                value="{{ old('collection_name') }}">
                                                        </div>
                                                        <div class="form-text text-muted">
                                                            Group files by collection (optional)
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Custom Name --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label mb-1">Custom Name (Optional)</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-tag text-primary"></i>
                                                            </span>
                                                            <input type="text" name="custom_name"
                                                                class="form-control border-start-0"
                                                                placeholder="Custom name for all files"
                                                                value="{{ old('custom_name') }}">
                                                        </div>
                                                        <div class="form-text text-muted">
                                                            Applies to all selected files
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="d-flex justify-content-between align-items-center mt-4">
                                        <a href="{{ route('admin.media.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-1"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn bg-gradient-primary mb-0" id="uploadButton">
                                            <i class="fas fa-upload me-1"></i> Upload Files
                                        </button>
                                    </div>
                                </form>
                            </div>

                            {{-- Sidebar --}}
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header pb-0">
                                        <h6>Upload Guidelines</h6>
                                    </div>
                                    <div class="card-body p-0 pt-3">
                                        <div class="list-group list-group-flush">
                                            <div
                                                class="list-group-item list-group-item-action d-flex align-items-center border-0">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow text-center border-radius me-3">
                                                    <i class="fas fa-file-image text-white"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-sm">Image Files</h6>
                                                    <small class="text-muted">JPG, PNG, GIF, BMP, WEBP, SVG</small>
                                                </div>
                                            </div>
                                            <div
                                                class="list-group-item list-group-item-action d-flex align-items-center border-0">
                                                <div
                                                    class="icon icon-shape bg-gradient-success shadow text-center border-radius me-3">
                                                    <i class="fas fa-file-video text-white"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-sm">Video Files</h6>
                                                    <small class="text-muted">MP4, MOV, AVI, WMV, FLV</small>
                                                </div>
                                            </div>
                                            <div
                                                class="list-group-item list-group-item-action d-flex align-items-center border-0">
                                                <div
                                                    class="icon icon-shape bg-gradient-warning shadow text-center border-radius me-3">
                                                    <i class="fas fa-file-pdf text-white"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-sm">PDF Files</h6>
                                                    <small class="text-muted">All PDF documents</small>
                                                </div>
                                            </div>
                                            <div
                                                class="list-group-item list-group-item-action d-flex align-items-center border-0">
                                                <div
                                                    class="icon icon-shape bg-gradient-info shadow text-center border-radius me-3">
                                                    <i class="fas fa-file-word text-white"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-sm">Document Files</h6>
                                                    <small class="text-muted">DOC, DOCX, XLS, XLSX, PPT, PPTX</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mt-4">
                                    <div class="card-header pb-0">
                                        <h6>Quick Tips</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="alert alert-light p-3">
                                            <i class="fas fa-lightbulb text-warning me-2"></i>
                                            <strong>Pro Tip:</strong> Use meaningful collection names for better
                                            organization.
                                        </div>
                                        <div class="alert alert-light p-3">
                                            <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                                            <strong>Note:</strong> Large files may take longer to upload.
                                        </div>
                                        <div class="alert alert-light p-3">
                                            <i class="fas fa-sync text-primary me-2"></i>
                                            <strong>Remember:</strong> You can edit file details after upload.
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('fileInput');
            const filePreview = document.getElementById('filePreview');
            const uploadForm = document.getElementById('uploadForm');
            const uploadButton = document.getElementById('uploadButton');
            const dropArea = document.getElementById('dropArea');

            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropArea.classList.add('highlight');
            }

            function unhighlight() {
                dropArea.classList.remove('highlight');
            }

            dropArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;
                fileInput.dispatchEvent(new Event('change'));
            }

            // File preview
            fileInput.addEventListener('change', function() {
                filePreview.innerHTML = '';

                if (this.files.length > 0) {
                    const header = document.createElement('div');
                    header.className = 'd-flex justify-content-between align-items-center mb-3';
                    header.innerHTML = `
                        <h6 class="mb-0">Selected Files (${this.files.length})</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearFiles()">
                            <i class="fas fa-times me-1"></i> Clear All
                        </button>
                    `;
                    filePreview.appendChild(header);

                    const fileList = document.createElement('div');
                    fileList.className = 'row g-3';

                    let totalSize = 0;

                    for (let i = 0; i < this.files.length; i++) {
                        const file = this.files[i];
                        totalSize += file.size;

                        const col = document.createElement('div');
                        col.className = 'col-md-6 col-lg-4';

                        // File icon based on type
                        let iconClass = 'fa-file text-secondary';
                        let bgClass = 'bg-gradient-secondary';
                        if (file.type.startsWith('image/')) {
                            iconClass = 'fa-image text-primary';
                            bgClass = 'bg-gradient-primary';
                        } else if (file.type.startsWith('video/')) {
                            iconClass = 'fa-video text-success';
                            bgClass = 'bg-gradient-success';
                        } else if (file.type === 'application/pdf') {
                            iconClass = 'fa-file-pdf text-danger';
                            bgClass = 'bg-gradient-danger';
                        } else if (file.type.includes('word')) {
                            iconClass = 'fa-file-word text-primary';
                            bgClass = 'bg-gradient-primary';
                        } else if (file.type.includes('excel') || file.type.includes('spreadsheet')) {
                            iconClass = 'fa-file-excel text-success';
                            bgClass = 'bg-gradient-success';
                        } else if (file.type.includes('powerpoint') || file.type.includes('presentation')) {
                            iconClass = 'fa-file-powerpoint text-warning';
                            bgClass = 'bg-gradient-warning';
                        } else if (file.type.startsWith('audio/')) {
                            iconClass = 'fa-file-audio text-info';
                            bgClass = 'bg-gradient-info';
                        }

                        col.innerHTML = `
                            <div class="card file-card">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="icon icon-shape ${bgClass} shadow text-center border-radius">
                                            <i class="fas ${iconClass} text-white"></i>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-icon" onclick="removeFile(${i})">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <h6 class="mb-1 text-truncate" title="${file.name}">${file.name}</h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">${formatBytes(file.size)}</small>
                                        <small class="text-muted">${getFileExtension(file.name)}</small>
                                    </div>
                                </div>
                            </div>
                        `;

                        fileList.appendChild(col);
                    }

                    filePreview.appendChild(fileList);

                    // Add total size info
                    const sizeInfo = document.createElement('div');
                    sizeInfo.className = 'alert alert-info mt-3';
                    sizeInfo.innerHTML = `
                        <i class="fas fa-info-circle me-2"></i>
                        Total: ${this.files.length} file(s) • ${formatBytes(totalSize)} • 
                        ${Math.ceil(totalSize / (1024 * 1024))} MB
                    `;
                    filePreview.appendChild(sizeInfo);

                    // Update button text
                    uploadButton.innerHTML =
                        `<i class="fas fa-upload me-1"></i> Upload ${this.files.length} File${this.files.length > 1 ? 's' : ''}`;
                } else {
                    uploadButton.innerHTML = `<i class="fas fa-upload me-1"></i> Upload Files`;
                }
            });

            // Form validation
            uploadForm.addEventListener('submit', function(event) {
                if (fileInput.files.length === 0) {
                    event.preventDefault();
                    event.stopPropagation();
                    showToast('Please select at least one file to upload', 'error');
                    return false;
                }

                // Check file sizes
                let totalSize = 0;
                const maxSize = parseFloat('{{ ini_get('upload_max_filesize') }}'.replace('M', '')) * 1024 *
                    1024;

                for (let i = 0; i < fileInput.files.length; i++) {
                    totalSize += fileInput.files[i].size;
                    if (fileInput.files[i].size > maxSize) {
                        event.preventDefault();
                        showToast(`File "${fileInput.files[i].name}" exceeds maximum size limit`, 'error');
                        return false;
                    }
                }

                if (totalSize > maxSize) {
                    event.preventDefault();
                    showToast('Total file size exceeds maximum upload limit', 'error');
                    return false;
                }

                uploadButton.innerHTML = `<i class="fas fa-spinner fa-spin me-1"></i> Uploading...`;
                uploadButton.disabled = true;
            }, false);

            // Show toast notification
            function showToast(message, type = 'success') {
                const toast = document.createElement('div');
                toast.className =
                    `toast align-items-center text-white bg-${type} border-0 position-fixed bottom-0 end-0 m-3`;
                toast.style.zIndex = '1060';
                toast.innerHTML = `
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
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
        });

        // Helper functions
        function formatBytes(bytes, decimals = 2) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const dm = decimals < 0 ? 0 : decimals;
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        }

        function getFileExtension(filename) {
            return filename.split('.').pop().toUpperCase();
        }

        function removeFile(index) {
            const fileInput = document.getElementById('fileInput');
            const dt = new DataTransfer();

            for (let i = 0; i < fileInput.files.length; i++) {
                if (i !== index) {
                    dt.items.add(fileInput.files[i]);
                }
            }

            fileInput.files = dt.files;
            fileInput.dispatchEvent(new Event('change'));
        }

        function clearFiles() {
            document.getElementById('fileInput').value = '';
            document.getElementById('fileInput').dispatchEvent(new Event('change'));
        }
    </script>
@endpush
