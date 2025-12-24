{{-- resources/views/admin/judges/create.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <h1>Create New Judge</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.judges.index') }}">Judges</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </nav>
            </div>
        </div>

        <form action="{{ route('admin.judges.store') }}" method="POST" enctype="multipart/form-data" id="createJudgeForm">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Basic Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="location" class="form-label">Location *</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                        id="location" name="location" value="{{ old('location') }}" required>
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="bio" class="form-label">Bio *</label>
                                    <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="4" required>{{ old('bio') }}</textarea>
                                    @error('bio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="avatar" class="form-label">Avatar</label>
                                    <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                        id="avatar" name="avatar" accept="image/*">
                                    <div class="form-text">Recommended size: 300x300px</div>
                                    @error('avatar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Expertise & Skills</h5>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSkill()">
                                <i class="bi bi-plus"></i> Add Skill
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="skills-container">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="skills[]"
                                        placeholder="e.g., EDM & Festival Mixes" required>
                                </div>
                            </div>
                            <div class="form-text">Add specific skills and expertise areas</div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Scoring Philosophy</h5>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addPhilosophy()">
                                <i class="bi bi-plus"></i> Add Philosophy
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="philosophies-container">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="scoring_philosophies[]"
                                        placeholder="e.g., Creativity: How unique the mix feels" required>
                                </div>
                            </div>
                            <div class="form-text">Add scoring criteria and philosophy points</div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Tags</h5>
                        </div>
                        <div class="card-body">
                            <label class="form-label">Select Tags</label>
                            <div class="row" id="tags-container">
                                @foreach ($tags as $tag)
                                    <div class="col-md-6 mb-2 tag-item" data-tag-id="{{ $tag->id }}">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="tags[]"
                                                value="{{ $tag->id }}" id="tag_{{ $tag->id }}">
                                            <label class="form-check-label" for="tag_{{ $tag->id }}">
                                                {{ $tag->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-3">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#createTagModal">
                                    <i class="bi bi-plus"></i> Create New Tag
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Judging Credentials</h5>
                        </div>
                        <div class="card-body">
                            <div id="credentials-container">
                                <div class="mb-3 p-3 border rounded">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="mb-0">Credential #1</h6>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="this.parentElement.parentElement.remove()">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="credentials[0][title]"
                                            placeholder="e.g., Official Judge" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Value</label>
                                        <input type="text" class="form-control" name="credentials[0][value]"
                                            placeholder="e.g., Global DJ Battle 2025" required>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary w-100 mt-2"
                                onclick="addCredential()">
                                <i class="bi bi-plus"></i> Add Credential
                            </button>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Competitions Judged</h5>
                        </div>
                        <div class="card-body">
                            <div id="competitions-container">
                                <div class="mb-3 p-3 border rounded">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="mb-0">Competition #1</h6>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="this.parentElement.parentElement.remove()">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="competitions[0][title]"
                                            placeholder="e.g., Global DJ Battle 2025" required>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label class="form-label">Type</label>
                                            <select class="form-select" name="competitions[0][type]" required>
                                                <option value="current">Currently Judging</option>
                                                <option value="previous">Previously Judged</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Year</label>
                                            <input type="number" class="form-control" name="competitions[0][year]"
                                                min="2000" max="2030" value="{{ date('Y') }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary w-100 mt-2"
                                onclick="addCompetition()">
                                <i class="bi bi-plus"></i> Add Competition
                            </button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary w-100" id="submitBtn">
                                <i class="bi bi-save"></i> Create Judge
                            </button>
                            <a href="{{ route('admin.judges.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

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
                        <div class="mb-3">
                            <label class="form-label">Tag Name *</label>
                            <input type="text" class="form-control" id="newTagName"
                                placeholder="e.g., 15+ Years of Experience" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="createTag()">
                            <i class="bi bi-plus-circle me-1"></i> Create Tag
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        let credentialCount = 1;
        let competitionCount = 1;
        let skillCount = 1;
        let philosophyCount = 1;

        function addSkill() {
            skillCount++;
            const container = document.getElementById('skills-container');
            const div = document.createElement('div');
            div.className = 'mb-3 d-flex gap-2';
            div.innerHTML = `
        <input type="text" class="form-control" name="skills[]" 
               placeholder="e.g., Transition Flow & Precision" required>
        <button type="button" class="btn btn-sm btn-danger" onclick="this.parentElement.remove()">
            <i class="bi bi-trash"></i>
        </button>
    `;
            container.appendChild(div);
        }

        function addPhilosophy() {
            philosophyCount++;
            const container = document.getElementById('philosophies-container');
            const div = document.createElement('div');
            div.className = 'mb-3 d-flex gap-2';
            div.innerHTML = `
        <input type="text" class="form-control" name="scoring_philosophies[]" 
               placeholder="e.g., Technique: Scratching, transitions, timing" required>
        <button type="button" class="btn btn-sm btn-danger" onclick="this.parentElement.remove()">
            <i class="bi bi-trash"></i>
        </button>
    `;
            container.appendChild(div);
        }

        function addCredential() {
            credentialCount++;
            const container = document.getElementById('credentials-container');
            const div = document.createElement('div');
            div.className = 'mb-3 p-3 border rounded';
            div.innerHTML = `
        <div class="d-flex justify-content-between align-items-start mb-2">
            <h6 class="mb-0">Credential #${credentialCount}</h6>
            <button type="button" class="btn btn-sm btn-danger" onclick="this.parentElement.parentElement.remove()">
                <i class="bi bi-trash"></i>
            </button>
        </div>
        <div class="mb-2">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="credentials[${credentialCount}][title]" 
                   placeholder="e.g., Panelist" required>
        </div>
        <div>
            <label class="form-label">Value</label>
            <input type="text" class="form-control" name="credentials[${credentialCount}][value]" 
                   placeholder="e.g., International DJ Conference 2025" required>
        </div>
    `;
            container.appendChild(div);
        }

        function addCompetition() {
            competitionCount++;
            const container = document.getElementById('competitions-container');
            const div = document.createElement('div');
            div.className = 'mb-3 p-3 border rounded';
            div.innerHTML = `
        <div class="d-flex justify-content-between align-items-start mb-2">
            <h6 class="mb-0">Competition #${competitionCount}</h6>
            <button type="button" class="btn btn-sm btn-danger" onclick="this.parentElement.parentElement.remove()">
                <i class="bi bi-trash"></i>
            </button>
        </div>
        <div class="mb-2">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="competitions[${competitionCount}][title]" 
                   placeholder="e.g., Electro Bass Cup 2024" required>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <label class="form-label">Type</label>
                <select class="form-select" name="competitions[${competitionCount}][type]" required>
                    <option value="current">Currently Judging</option>
                    <option value="previous">Previously Judged</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Year</label>
                <input type="number" class="form-control" name="competitions[${competitionCount}][year]" 
                       min="2000" max="2030" value="{{ date('Y') }}" required>
            </div>
        </div>
    `;
            container.appendChild(div);
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

            // Create form data instead of JSON
            const formData = new FormData();
            formData.append('name', tagName);
            formData.append('_token', '{{ csrf_token() }}');

            // Create AJAX request with proper headers
            fetch('{{ route('admin.judge-tags.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => {
                    // First check if response is JSON
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        throw new Error('Server returned HTML instead of JSON');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Add new checkbox immediately
                        const container = document.getElementById('tags-container');
                        const newCol = document.createElement('div');
                        newCol.className = 'col-md-6 mb-2 tag-item';
                        newCol.setAttribute('data-tag-id', data.tag.id);
                        newCol.innerHTML = `
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" 
                           name="tags[]" value="${data.tag.id}" 
                           id="tag_${data.tag.id}" checked>
                    <label class="form-check-label" for="tag_${data.tag.id}">
                        ${data.tag.name}
                    </label>
                </div>
            `;
                        container.appendChild(newCol);

                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message || `"${data.tag.name}" has been created successfully.`,
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                        });

                        // Close modal and reset input
                        const modal = bootstrap.Modal.getInstance(document.getElementById('createTagModal'));
                        modal.hide();
                        tagNameInput.value = '';
                    } else {
                        throw new Error(data.message || 'Failed to create tag');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);

                    // If it's a JSON parse error, show specific message
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

        // Form validation
        document.getElementById('createJudgeForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Creating...';

            // Validate required fields
            const name = this.querySelector('#name').value.trim();
            const location = this.querySelector('#location').value.trim();
            const bio = this.querySelector('#bio').value.trim();

            if (!name || !location || !bio) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Please fill all required fields',
                    confirmButtonColor: '#3085d6',
                });
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="bi bi-save"></i> Create Judge';
            }
        });

        // Auto-focus on modal
        document.addEventListener('DOMContentLoaded', function() {
            const createModal = document.getElementById('createTagModal');
            if (createModal) {
                createModal.addEventListener('shown.bs.modal', function() {
                    document.getElementById('newTagName').focus();
                });
            }
        });
    </script>
@endsection
