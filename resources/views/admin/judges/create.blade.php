{{-- resources/views/admin/judges/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Create New Judge')

@section('content')
    <!-- Breadcrumb -->
    {{-- <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.judges.index') }}">Judges</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav> --}}

    <form action="{{ route('admin.judges.store') }}" method="POST" enctype="multipart/form-data" id="createJudgeForm">
        @csrf

        <!-- Profile Header Card -->
        <div class="card shadow-lg mx-4 card-profile-bottom mb-4">
            <div class="card-body p-3">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative" id="avatarPreviewContainer">
                            <img src="https://ui-avatars.com/api/?name=New+Judge&background=random" alt="Avatar Preview"
                                class="w-100 border-radius-lg shadow-sm" id="avatarPreview">
                            <div class="avatar-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 rounded"
                                style="display:none !important">
                                <i class="ni ni-camera-compact text-white text-lg"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                <input type="text" class="form-control form-control-lg border-0 px-0 bg-transparent"
                                    id="name" name="name" value="{{ old('name') }}" placeholder="Enter Judge Name"
                                    required style="font-size: 1.5rem; font-weight: 600; max-width: 300px;">
                                @error('name')
                                    <div class="text-danger text-sm">{{ $message }}</div>
                                @enderror
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                <input type="text" class="form-control border-0 px-0 bg-transparent" id="location"
                                    name="location" value="{{ old('location') }}" placeholder="Enter Location" required
                                    style="max-width: 200px;">
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
                                        <span class="ms-2">Upload Avatar</span>
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
                                {{-- <li class="nav-item">
                                    <button type="button"
                                        class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center"
                                        onclick="validateForm()">
                                        <i class="ni ni-settings-gear-65"></i>
                                        <span class="ms-2">Validate</span>
                                    </button>
                                </li> --}}
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
                                <i class="ni ni-single-02"></i> Fill Basic Info
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="basic-info">
                            <!-- Bio -->
                            <div class="form-group mb-3">
                                <label class="form-label  mb-1">Bio <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ni ni-single-copy-04"></i>
                                    </span>
                                    <textarea name="bio" class="form-control border-start-0" rows="4" placeholder="Enter judge biography"
                                        required>{{ old('bio') }}</textarea>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="form-group mb-4">
                                <label class="form-control-label">Status</label>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                        value="1" checked>
                                    <label class="form-check-label" for="is_active">
                                        Active Judge
                                    </label>
                                </div>

                                <small class="form-text text-muted">
                                    Active judges will be visible in the system
                                </small>
                            </div>


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
                                    <div class="mb-2">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="ni ni-hat-3"></i>
                                            </span>
                                            <input type="text" class="form-control" name="skills[]"
                                                placeholder="e.g., EDM & Festival Mixes" required>
                                        </div>
                                    </div>
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
                                    <div class="mb-2">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                            <input type="text" class="form-control" name="scoring_philosophies[]"
                                                placeholder="e.g., Creativity: How unique the mix feels" required>
                                        </div>
                                    </div>
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
                                                    value="{{ $tag->id }}" id="tag_{{ $tag->id }}">
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
                            <div class="mb-3 p-3 bg-gray-100 border-radius-lg">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0 text-sm">Credential #1</h6>
                                    <button type="button" class="btn btn-sm btn-link text-danger p-0"
                                        onclick="this.parentElement.parentElement.remove()">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                {{-- <div class="mb-2">
                                    <label class="form-control-label text-sm">Title</label>
                                    <input type="text" class="form-control form-control-sm"
                                        name="credentials[0][title]" placeholder="e.g., Official Judge" required>
                                </div> --}}
                                <div class="form-group mb-2">
                                    <label class="form-label mb-1">Credential Title</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-award"></i>
                                        </span>
                                        <input type="text" name="credentials[0][title]"
                                            class="form-control border-start-0" placeholder="e.g. Official Judge"
                                            required>
                                    </div>
                                </div>

                                {{-- <div>
                                    <label class="form-control-label text-sm">Value</label>
                                    <input type="text" class="form-control form-control-sm"
                                        name="credentials[0][value]" placeholder="e.g., Global DJ Battle 2025" required>
                                </div> --}}
                                <div class="form-group mb-2">
                                    <label class="form-label  mb-1">Credential Value</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-certificate"></i>
                                        </span>
                                        <input type="text" name="credentials[0][value]"
                                            class="form-control border-start-0" placeholder="e.g. Global DJ Battle 2025"
                                            required>
                                    </div>
                                </div>

                            </div>
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
                            <div class="mb-3 p-3 bg-gray-100 border-radius-lg">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0 text-sm">Competition #1</h6>
                                    <button type="button" class="btn btn-sm btn-link text-danger p-0"
                                        onclick="this.parentElement.parentElement.remove()">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="form-label  mb-1">Competition</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-trophy"></i>
                                        </span>
                                        <input type="text" name="competitions[0][title]"
                                            class="form-control border-start-0" placeholder="Competition name" required>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label class="form-control-label text-sm">Type</label>
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
                                        <label class="form-control-label text-sm">Year</label>
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
                        </div>
                        <div class="text-center">
                            <small class="text-muted">Add competitions this judge has participated in</small>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                <i class="fas fa-save me-2"></i> Create Judge
                            </button>
                            <a href="{{ route('admin.judges.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-times me-2"></i> Cancel
                            </a>
                        </div>
                        <div class="text-center mt-3">
                            <small class="text-muted">* Required fields must be filled</small>
                        </div>
                    </div>
                </div>

                <!-- Stats Preview -->
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="text-center">
                            <h6 class="mb-3">Preview Stats</h6>
                            <div class="d-flex justify-content-center">
                                <div class="d-grid text-center mx-3">
                                    <span class="text-lg font-weight-bolder" id="skillsCount">0</span>
                                    <span class="text-sm opacity-8">Skills</span>
                                </div>
                                <div class="d-grid text-center mx-3">
                                    <span class="text-lg font-weight-bolder" id="credentialsCount">0</span>
                                    <span class="text-sm opacity-8">Credentials</span>
                                </div>
                                <div class="d-grid text-center mx-3">
                                    <span class="text-lg font-weight-bolder" id="competitionsCount">0</span>
                                    <span class="text-sm opacity-8">Competitions</span>
                                </div>
                            </div>
                        </div>
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
                <form id="createTagForm">
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
                </form>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            let credentialCount = 1;
            let competitionCount = 1;
            let skillCount = 1;
            let philosophyCount = 1;

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
                const name = e.target.value || 'New Judge';
                const avatar = document.getElementById('avatarPreview');
                if (!avatar.src.includes('data:image')) { // Only update if not custom image
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
            <h6 class="mb-0 text-sm">Credential #${credentialCount}</h6>
            <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="this.parentElement.parentElement.remove(); updateStats();">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        <div class="mb-2">
            <label class="form-control-label text-sm">Title</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-award"></i>
                </span>
                <input type="text" class="form-control form-control-sm" name="credentials[${credentialCount}][title]" 
                       placeholder="e.g., Panelist" required>
            </div>
        </div>
        <div>
            <label class="form-control-label text-sm">Value</label>
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
            <h6 class="mb-0 text-sm">Competition #${competitionCount}</h6>
            <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="this.parentElement.parentElement.remove(); updateStats();">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        <div class="mb-2">
            <label class="form-control-label text-sm">Title</label>
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
                <label class="form-control-label text-sm">Type</label>
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
                <label class="form-control-label text-sm">Year</label>
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
                        confirmButtonColor: '#3085d6',
                    });
                    return;
                }

                const formData = new FormData();
                formData.append('name', tagName);
                formData.append('_token', '{{ csrf_token() }}');

                fetch('{{ route('admin.judges-tag.store') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => {
                        const contentType = response.headers.get('content-type');
                        if (!contentType || !contentType.includes('application/json')) {
                            throw new Error('Server returned HTML instead of JSON');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {

                            const container = document.getElementById('tags-container');
                            const newCol = document.createElement('div');
                            newCol.className = 'col-md-6 mb-2 tag-item';
                            newCol.setAttribute('data-tag-id', data.tag.id);

                            newCol.innerHTML = `
            <div class="form-check form-switch">

                <input class="form-check-input" type="checkbox"
                       name="tags[]" value="${data.tag.id}"
                       id="tag_${data.tag.id}" checked>
                <label class="form-check-label" for="tag_${data.tag.id}">
                    ${data.tag.name}
                </label>
            </div>
        `;

                            container.appendChild(newCol);

                            // ✅ 1️⃣ MODAL PROPERLY CLOSE
                            const modalEl = document.getElementById('createTagModal');
                            const modalInstance = bootstrap.Modal.getInstance(modalEl);
                            modalInstance.hide();

                            //  FORCE CLEANUP (THIS IS THE KEY FIX)
                            // document.body.classList.remove('modal-open');
                            // document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                            fullyUnlockScroll();
                            //  NOW SHOW SWEET ALERT
                            Swal.fire({
                                icon: 'success',
                                title: 'Tag Created',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                fullyUnlockScroll();
                            });

                            tagNameInput.value = '';
                        } else {
                            throw new Error(data.message || 'Failed to create tag');
                        }
                    })

                    .catch(error => {
                        console.error('Error:', error);
                        if (error.message.includes('HTML instead of JSON')) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Server Error',
                                text: 'The server returned an incorrect response. Please refresh the page and try again.',
                                confirmButtonColor: '#3085d6',
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: error.message || 'Failed to create tag. Please try again.',
                                confirmButtonColor: '#3085d6',
                            });
                        }
                    });
            }

            function validateForm() {
                const name = document.getElementById('name').value.trim();
                const location = document.getElementById('location').value.trim();
                const bio = document.getElementById('bio').value.trim();

                if (!name || !location || !bio) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Incomplete Form',
                        text: 'Please fill all required fields marked with *',
                        confirmButtonColor: '#3085d6',
                    });
                    return false;
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Form Valid',
                    text: 'All required fields are filled correctly!',
                    confirmButtonColor: '#3085d6',
                });
                return true;
            }

            function resetForm() {
                Swal.fire({
                    title: 'Reset Form?',
                    text: 'This will clear all form fields. Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, reset it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('createJudgeForm').reset();
                        document.getElementById('avatarPreview').src =
                            'https://ui-avatars.com/api/?name=New+Judge&background=random';
                        document.getElementById('skills-container').innerHTML =
                            '<div class="mb-2"><input type="text" class="form-control" name="skills[]" placeholder="e.g., EDM & Festival Mixes" required></div>';
                        document.getElementById('philosophies-container').innerHTML =
                            '<div class="mb-2"><input type="text" class="form-control" name="scoring_philosophies[]" placeholder="e.g., Creativity: How unique the mix feels" required></div>';
                        document.getElementById('credentials-container').innerHTML =
                            document.querySelector('#credentials-container > div').outerHTML;
                        document.getElementById('competitions-container').innerHTML =
                            document.querySelector('#competitions-container > div').outerHTML;
                        updateStats();

                        Swal.fire(
                            'Reset!',
                            'Form has been reset.',
                            'success'
                        );
                    }
                });
            }

            function scrollToSection(id) {
                document.getElementById(id).scrollIntoView({
                    behavior: 'smooth'
                });
            }

            // Form submission
            document.getElementById('createJudgeForm').addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                    return;
                }

                const submitBtn = document.getElementById('submitBtn');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="ni ni-hourglass-split me-2"></i> Creating...';
            });
            // Update stats on load
            document.addEventListener('DOMContentLoaded', updateStats);
            // Auto-focus on modal
            document.addEventListener('DOMContentLoaded', function() {
                const createModal = document.getElementById('createTagModal');
                if (createModal) {
                    createModal.addEventListener('shown.bs.modal', function() {
                        document.getElementById('newTagName').focus();
                    });
                }
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
