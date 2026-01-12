{{-- resources/views/admin/judges/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Judge')

@section('content')
    <style>
        .form-check-input[type="checkbox"]:checked {
            background-color: #4e73df !important;
            border-color: #4e73df !important;
        }
    </style>
    <form action="{{ route('admin.judges.update', $judge->id) }}" method="POST" enctype="multipart/form-data"
        id="editJudgeForm">
        @csrf
        @method('PUT')

        <!-- Profile Header Card -->
        <div class="card shadow-lg mx-4 card-profile-bottom mb-4">
            <div class="card-body p-3">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative" id="avatarPreviewContainer">
                            <img src="{{ $judge->avatar ? Storage::url($judge->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($judge->name) . '&background=random' }}"
                                alt="{{ $judge->name }}" class="w-100 border-radius-lg shadow-sm" id="avatarPreview">
                            <div class="avatar-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 rounded"
                                style="display:none !important">
                                <i class="ni ni-camera-compact text-white text-lg"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                <input type="text"
                                    class="form-control form-control-lg border-0 px-0 bg-transparent @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $judge->name) }}"
                                    placeholder="Enter Judge Name" required
                                    style="font-size: 1.5rem; font-weight: 600; max-width: 300px;">
                                @error('name')
                                    <div class="text-danger text-sm">{{ $message }}</div>
                                @enderror
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                <input type="text"
                                    class="form-control border-0 px-0 bg-transparent @error('location') is-invalid @enderror"
                                    id="location" name="location" value="{{ old('location', $judge->location) }}"
                                    placeholder="Enter Location" required style="max-width: 200px;">
                                @error('location')
                                <div class="text-danger text-sm">{{ $message }}</div>
                            @enderror
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                <li class="nav-item">
                                    <label
                                        class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center cursor-pointer"
                                        for="avatar">
                                        <i class="ni ni-camera-compact"></i>
                                        <span class="ms-2">Change Avatar</span>
                                        <input type="file" class="d-none" id="avatar" name="avatar" accept="image/*">
                                    </label>
                                </li>
                                <li class="nav-item">
                                    <button type="button"
                                        class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center"
                                        onclick="resetForm()">
                                        <i class="ni ni-refresh"></i>
                                        <span class="ms-2">Reset Form</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column: Main Form -->
            <div class="col-md-8">
                <!-- Basic Information Card -->
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0 text-uppercase text-sm font-weight-bold">Basic Information</p>
                            <button type="button" class="btn btn-primary btn-sm ms-auto"
                                onclick="scrollToSection('basic-info')">
                                <i class="ni ni-single-02"></i> Edit Basic Info
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="basic-info">
                            <!-- Bio -->
                            <div class="form-group mb-4">
                                <label for="bio" class="form-control-label">Bio *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ni ni-single-copy-04"></i>
                                    </span>
                                    <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="5"
                                        placeholder="Enter judge's biography and background..." required>{{ old('bio', $judge->bio) }}</textarea>
                                </div>
                                <small class="form-text text-muted">Provide a detailed biography about the judge</small>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="form-group mb-4">
                                <label class="form-control-label">Status</label>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                        value="1" {{ $judge->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active Judge
                                    </label>
                                </div>

                                <small class="form-text text-muted">
                                    Active judges will be visible in the system
                                </small>
                            </div>

                            <!-- Remove Avatar Checkbox -->
                            @if ($judge->avatar)
                                <div class="form-group mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remove_avatar"
                                            id="remove_avatar" value="1">
                                        <label class="form-check-label text-danger" for="remove_avatar">
                                            <i class="fas fa-trash me-1"></i> Remove current avatar
                                        </label>
                                    </div>
                                    <small class="form-text text-muted">
                                        Check this if you want to remove the current avatar
                                    </small>
                                </div>
                            @endif

                            <!-- Skills -->
                            <div class="form-group mb-4">
                                <label class="form-control-label">Expertise & Skills</label>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-sm">Add specific skills and expertise areas</span>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSkill()">
                                        <i class="ni ni-fat-add"></i> Add Skill
                                    </button>
                                </div>
                                <div id="skills-container">
                                    @if (count($skills) > 0)
                                        @foreach ($skills as $index => $skill)
                                            <div class="mb-2 d-flex gap-2">
                                                <div class="input-group flex-grow-1">
                                                    <span class="input-group-text">
                                                        <i class="ni ni-hat-3"></i>
                                                    </span>
                                                    <input type="text" class="form-control" name="skills[]"
                                                        value="{{ $skill }}" required>
                                                </div>
                                                <button type="button" class="btn btn-outline-danger"
                                                    onclick="this.parentElement.remove(); updateStats();">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="mb-2 d-flex gap-2">
                                            <div class="input-group flex-grow-1">
                                                <span class="input-group-text">
                                                    <i class="ni ni-hat-3"></i>
                                                </span>
                                                <input type="text" class="form-control" name="skills[]"
                                                    placeholder="e.g., EDM & Festival Mixes" required>
                                            </div>
                                            <button type="button" class="btn btn-outline-danger"
                                                onclick="this.parentElement.remove(); updateStats();">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <!-- Scoring Philosophy -->
                            <div class="form-group mb-4">
                                <label class="form-control-label">Scoring Philosophy</label>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-sm">Add scoring criteria and philosophy points</span>
                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                        onclick="addPhilosophy()">
                                        <i class="ni ni-fat-add"></i> Add Philosophy
                                    </button>
                                </div>
                                <div id="philosophies-container">
                                    @if (count($philosophies) > 0)
                                        @foreach ($philosophies as $index => $philosophy)
                                            <div class="mb-2 d-flex gap-2">
                                                <div class="input-group flex-grow-1">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-check-circle"></i>
                                                    </span>
                                                    <input type="text" class="form-control"
                                                        name="scoring_philosophies[]" value="{{ $philosophy }}"
                                                        required>
                                                </div>
                                                <button type="button" class="btn btn-outline-danger"
                                                    onclick="this.parentElement.remove(); updateStats();">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="mb-2 d-flex gap-2">
                                            <div class="input-group flex-grow-1">
                                                <span class="input-group-text">
                                                    <i class="fas fa-check-circle"></i>
                                                </span>
                                                <input type="text" class="form-control" name="scoring_philosophies[]"
                                                    placeholder="e.g., Creativity: How unique the mix feels" required>
                                            </div>
                                            <button type="button" class="btn btn-outline-danger"
                                                onclick="this.parentElement.remove(); updateStats();">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Tags -->
                            <div class="form-group">
                                <label class="form-control-label">Tags</label>
                                <div class="row" id="tags-container">
                                    @foreach ($tags as $tag)
                                        <div class="col-md-6 mb-2 tag-item" data-tag-id="{{ $tag->id }}">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="tags[]"
                                                    value="{{ $tag->id }}" id="tag_{{ $tag->id }}"
                                                    {{ in_array($tag->id, $judge->tags->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="tag_{{ $tag->id }}">
                                                    {{ $tag->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary mt-2" data-bs-toggle="modal"
                                    data-bs-target="#createTagModal">
                                    <i class="ni ni-fat-add"></i> Create New Tag
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Side Cards -->
            <div class="col-md-4">
                <!-- Credentials Card -->
                <div class="card card-profile mb-4">
                    <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Judging Credentials</h6>
                            <button type="button" class="btn btn-sm btn-info mb-0" onclick="addCredential()">
                                <i class="ni ni-fat-add"></i> Add
                            </button>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div id="credentials-container">
                            @if ($judge->credentials->count() > 0)
                                @foreach ($judge->credentials as $index => $credential)
                                    <div class="mb-3 p-3 bg-gray-100 border-radius-lg">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="mb-0 text-sm">Credential #{{ $index + 1 }}</h6>
                                            <button type="button" class="btn btn-sm btn-link text-danger p-0"
                                                onclick="this.parentElement.parentElement.remove(); updateStats();">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <input type="hidden" name="credentials[{{ $index }}][id]"
                                            value="{{ $credential->id }}">
                                        <div class="mb-2">
                                            <label class="form-control-label text-sm">Title *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-award"></i>
                                                </span>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="credentials[{{ $index }}][title]"
                                                    value="{{ $credential->title }}" required>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="form-control-label text-sm">Value *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-certificate"></i>
                                                </span>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="credentials[{{ $index }}][value]"
                                                    value="{{ $credential->value }}" required>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="mb-3 p-3 bg-gray-100 border-radius-lg">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="mb-0 text-sm">Credential #1</h6>
                                        <button type="button" class="btn btn-sm btn-link text-danger p-0"
                                            onclick="this.parentElement.parentElement.remove(); updateStats();">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-control-label text-sm">Title *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-award"></i>
                                            </span>
                                            <input type="text" class="form-control form-control-sm"
                                                name="credentials[0][title]" placeholder="e.g., Official Judge" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-control-label text-sm">Value *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-certificate"></i>
                                            </span>
                                            <input type="text" class="form-control form-control-sm"
                                                name="credentials[0][value]" placeholder="e.g., Global DJ Battle 2025"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="text-center">
                            <small class="text-muted">Add the judge's credentials and achievements</small>
                        </div>
                    </div>
                </div>

                <!-- Competitions Card -->
                <div class="card card-profile mb-4">
                    <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Competitions Judged</h6>
                            <button type="button" class="btn btn-sm btn-dark mb-0" onclick="addCompetition()">
                                <i class="ni ni-fat-add"></i> Add
                            </button>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div id="competitions-container">
                            @if ($judge->competitions->count() > 0)
                                @foreach ($judge->competitions as $index => $competition)
                                    <div class="mb-3 p-3 bg-gray-100 border-radius-lg">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="mb-0 text-sm">Competition #{{ $index + 1 }}</h6>
                                            <button type="button" class="btn btn-sm btn-link text-danger p-0"
                                                onclick="this.parentElement.parentElement.remove(); updateStats();">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <input type="hidden" name="competitions[{{ $index }}][id]"
                                            value="{{ $competition->id }}">
                                        <div class="mb-2">
                                            <label class="form-control-label text-sm">Title *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="ni ni-trophy"></i>
                                                </span>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="competitions[{{ $index }}][title]"
                                                    value="{{ $competition->title }}" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label class="form-control-label text-sm">Type *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ni ni-calendar-grid-58"></i>
                                                    </span>
                                                    <select class="form-select form-select-sm"
                                                        name="competitions[{{ $index }}][type]" required>
                                                        <option value="current"
                                                            {{ $competition->type == 'current' ? 'selected' : '' }}>
                                                            Currently Judging</option>
                                                        <option value="previous"
                                                            {{ $competition->type == 'previous' ? 'selected' : '' }}>
                                                            Previously Judged</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-control-label text-sm">Year *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ni ni-calendar-grid-58"></i>
                                                    </span>
                                                    <input type="number" class="form-control form-control-sm"
                                                        name="competitions[{{ $index }}][year]"
                                                        value="{{ $competition->year }}" min="2000" max="2030"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="mb-3 p-3 bg-gray-100 border-radius-lg">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="mb-0 text-sm">Competition #1</h6>
                                        <button type="button" class="btn btn-sm btn-link text-danger p-0"
                                            onclick="this.parentElement.parentElement.remove(); updateStats();">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-control-label text-sm">Title *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="ni ni-trophy"></i>
                                            </span>
                                            <input type="text" class="form-control form-control-sm"
                                                name="competitions[0][title]" placeholder="e.g., Global DJ Battle 2025"
                                                required>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label class="form-control-label text-sm">Type *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="ni ni-calendar-grid-58"></i>
                                                </span>
                                                <select class="form-select form-select-sm" name="competitions[0][type]"
                                                    required>
                                                    <option value="current">Currently Judging</option>
                                                    <option value="previous">Previously Judged</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-control-label text-sm">Year *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="ni ni-calendar-grid-58"></i>
                                                </span>
                                                <input type="number" class="form-control form-control-sm"
                                                    name="competitions[0][year]" min="2000" max="2030"
                                                    value="{{ date('Y') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="text-center">
                            <small class="text-muted">Add competitions this judge has participated in</small>
                        </div>
                    </div>
                </div>
            </div>
    </form>

    <!-- Create Tag Modal -->
    <div class="modal fade" id="createTagModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-control-label">Tag Name *</label>
                        <input type="text" class="form-control" id="newTagName"
                            placeholder="e.g., 15+ Years of Experience" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary w-100"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn bg-gradient-primary" onclick="createTag()">
                        <i class="ni ni-fat-add me-1"></i> Create Tag
                    </button>
                </div>
            </div>
        </div>
    </div>




    @push('scripts')
        <script>
            let credentialCount = {{ $judge->credentials->count() > 0 ? $judge->credentials->count() : 0 }};
            let competitionCount = {{ $judge->competitions->count() > 0 ? $judge->competitions->count() : 0 }};
            let skillCount = {{ count($skills) > 0 ? count($skills) : 1 }};
            let philosophyCount = {{ count($philosophies) > 0 ? count($philosophies) : 1 }};

            // Initialize stats on page load
            document.addEventListener('DOMContentLoaded', function() {
                updateStats();
            });

            // Avatar preview
            document.getElementById('avatar').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('avatarPreview').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Name input updates avatar
            document.getElementById('name').addEventListener('input', function(e) {
                const name = e.target.value || 'Judge';
                const avatar = document.getElementById('avatarPreview');
                const isCustomImage = avatar.src.includes('data:image') ||
                    (document.getElementById('avatar').files && document.getElementById('avatar').files.length > 0);

                if (!isCustomImage && !avatar.src.includes(
                        '{{ $judge->avatar ? Storage::url($judge->avatar) : '' }}')) {
                    avatar.src =
                        `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=random&size=120`;
                }
            });

            function addSkill() {
                skillCount++;
                const container = document.getElementById('skills-container');
                const div = document.createElement('div');
                div.className = 'mb-2 d-flex gap-2';
                div.innerHTML = `
        <div class="input-group flex-grow-1">
            <span class="input-group-text">
                <i class="ni ni-hat-3"></i>
            </span>
            <input type="text" class="form-control" name="skills[]" 
                   placeholder="e.g., Transition Flow & Precision" required>
        </div>
        <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove(); updateStats();">
            <i class="fas fa-trash"></i>
        </button>
    `;
                container.appendChild(div);
                updateStats();
            }

            function addPhilosophy() {
                philosophyCount++;
                const container = document.getElementById('philosophies-container');
                const div = document.createElement('div');
                div.className = 'mb-2 d-flex gap-2';
                div.innerHTML = `
        <div class="input-group flex-grow-1">
            <span class="input-group-text">
                <i class="fas fa-check-circle"></i>
            </span>
            <input type="text" class="form-control" name="scoring_philosophies[]" 
                   placeholder="e.g., Technique: Scratching, transitions, timing" required>
        </div>
        <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove(); updateStats();">
            <i class="fas fa-trash"></i>
        </button>
    `;
                container.appendChild(div);
                updateStats();
            }

            function addCredential() {
                credentialCount++;
                const container = document.getElementById('credentials-container');
                const div = document.createElement('div');
                div.className = 'mb-3 p-3 bg-gray-100 border-radius-lg';
                div.innerHTML = `
        <div class="d-flex justify-content-between align-items-start mb-2">
            <h6 class="mb-0 text-sm">Credential #${credentialCount + 1}</h6>
            <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="this.parentElement.parentElement.remove(); updateStats();">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        <div class="mb-2">
            <label class="form-control-label text-sm">Title *</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-award"></i>
                </span>
                <input type="text" class="form-control form-control-sm" name="credentials[${credentialCount}][title]" 
                       placeholder="e.g., Panelist" required>
            </div>
        </div>
        <div>
            <label class="form-control-label text-sm">Value *</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-certificate"></i>
                </span>
                <input type="text" class="form-control form-control-sm" name="credentials[${credentialCount}][value]" 
                       placeholder="e.g., International DJ Conference 2025" required>
            </div>
        </div>
    `;
                container.appendChild(div);
                updateStats();
            }

            function addCompetition() {
                competitionCount++;
                const container = document.getElementById('competitions-container');
                const div = document.createElement('div');
                div.className = 'mb-3 p-3 bg-gray-100 border-radius-lg';
                div.innerHTML = `
        <div class="d-flex justify-content-between align-items-start mb-2">
            <h6 class="mb-0 text-sm">Competition #${competitionCount + 1}</h6>
            <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="this.parentElement.parentElement.remove(); updateStats();">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        <div class="mb-2">
            <label class="form-control-label text-sm">Title *</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="ni ni-trophy"></i>
                </span>
                <input type="text" class="form-control form-control-sm" name="competitions[${competitionCount}][title]" 
                       placeholder="e.g., Electro Bass Cup 2024" required>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <label class="form-control-label text-sm">Type *</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="ni ni-calendar-grid-58"></i>
                    </span>
                    <select class="form-select form-select-sm" name="competitions[${competitionCount}][type]" required>
                        <option value="current">Currently Judging</option>
                        <option value="previous">Previously Judged</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-control-label text-sm">Year *</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="ni ni-calendar-grid-58"></i>
                    </span>
                    <input type="number" class="form-control form-control-sm" name="competitions[${competitionCount}][year]" 
                           min="2000" max="2030" value="{{ date('Y') }}" required>
                </div>
            </div>
        </div>
    `;
                container.appendChild(div);
                updateStats();
            }

            function updateStats() {
                document.getElementById('skillsCount').textContent =
                    document.querySelectorAll('#skills-container input[type="text"]').length;
                document.getElementById('credentialsCount').textContent =
                    document.querySelectorAll('#credentials-container > div').length;
                document.getElementById('competitionsCount').textContent =
                    document.querySelectorAll('#competitions-container > div').length;
            }

            function createTag() {
                const tagNameInput = document.getElementById('newTagName');
                const tagName = tagNameInput.value.trim();

                if (!tagName) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please enter a tag name',
                    });
                    return;
                }

                const formData = new FormData();
                formData.append('name', tagName);

                fetch('{{ route('admin.judges-tag.store') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {

                        if (!data.success) {
                            throw new Error(data.message || 'Failed to create tag');
                        }

                        // ✅ Add checkbox to list
                        const container = document.getElementById('tags-container');

                        // Prevent duplicates
                        if (container.querySelector(`[data-tag-id="${data.tag.id}"]`)) {
                            return;
                        }

                        const div = document.createElement('div');
                        div.className = 'col-md-6 mb-2 tag-item';
                        div.setAttribute('data-tag-id', data.tag.id);

                        div.innerHTML = `
                        <div class="form-check form-switch">
                            <input class="form-check-input"
                                type="checkbox"
                                name="tags[]"
                                value="${data.tag.id}"
                                id="tag_${data.tag.id}"
                                checked>
                            <label class="form-check-label" for="tag_${data.tag.id}">
                                ${data.tag.name}
                            </label>
                        </div>
                    `;

                        container.appendChild(div);

                        // ✅ Properly close modal
                        const modalEl = document.getElementById('createTagModal');
                        const modal = bootstrap.Modal.getInstance(modalEl);
                        modal.hide();

                        fullyUnlockScroll();


                        Swal.fire({
                            icon: 'success',
                            title: 'Tag Created',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            fullyUnlockScroll();
                        });

                        tagNameInput.value = '';

                    })
                    .catch(err => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: err.message
                        });
                    });
            }


            function resetForm() {
                Swal.fire({
                    title: 'Reset Form?',
                    text: 'This will revert all changes to original values. Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, reset it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Reload the page to get original values
                        window.location.reload();
                    }
                });
            }

            function scrollToSection(id) {
                document.getElementById(id).scrollIntoView({
                    behavior: 'smooth'
                });
            }

            // Form submission
            document.getElementById('editJudgeForm').addEventListener('submit', function(e) {
                // Basic validation
                const name = document.getElementById('name').value.trim();
                const location = document.getElementById('location').value.trim();
                const bio = document.getElementById('bio').value.trim();

                if (!name || !location || !bio) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please fill all required fields (Name, Location, Bio)',
                        confirmButtonColor: '#3085d6',
                    });
                    return;
                }

                // Disable button and show loading
                const submitBtn = document.getElementById('submitBtn');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="ni ni-hourglass-split me-2"></i> Updating...';
            });

            // Listen for modal hidden event to clear input
            document.getElementById('createTagModal').addEventListener('hidden.bs.modal', function() {
                document.getElementById('newTagName').value = '';
            });

            function fullyUnlockScroll() {
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';

                document.documentElement.style.overflow = '';
                document.documentElement.style.paddingRight = '';

                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            }
        </script>
    @endpush
@endsection
