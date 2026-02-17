@extends('layouts.app')

@section('title', 'Create New Competition')

@section('content')
    <style>
        /* Wizard Steps */
        .wizard-container {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
        }

        .wizard-header {
            margin-bottom: 30px;
        }

        .wizard-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            position: relative;
        }

        .wizard-steps:before {
            content: '';
            position: absolute;
            top: 25px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e9ecef;
            z-index: 1;
        }

        .step {
            position: relative;
            z-index: 2;
            background: #fff;
            padding: 0 10px;
            text-align: center;
            width: 20%;
        }

        .step-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            color: #6c757d;
            font-size: 20px;
            transition: all 0.3s;
        }

        .step.completed .step-icon {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }

        .step.active .step-icon {
            background: linear-gradient(135deg, #5e72e4, #825ee4);
            color: white;
            box-shadow: 0 4px 10px rgba(94, 114, 228, 0.3);
        }

        .step-title {
            font-size: 13px;
            font-weight: 600;
            color: #6c757d;
        }

        .step.active .step-title {
            color: #5e72e4;
        }

        .step.completed .step-title {
            color: #28a745;
        }

        .step-content {
            display: none;
            padding: 20px 0;
        }

        .step-content.active {
            display: block;
        }

        /* Navigation Buttons */
        .wizard-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }

        /* Cover Image */
        .cover-upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            background: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s;
        }

        .cover-upload-area:hover {
            border-color: #5e72e4;
            background: #f1f3fe;
        }

        .cover-preview {
            position: relative;
            display: inline-block;
            margin-top: 10px;
        }

        .cover-preview img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .remove-cover {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #dc3545;
            color: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(220, 53, 69, 0.3);
        }

        /* Criteria Items */
        .criteria-item {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            border-left: 4px solid #5e72e4;
        }

        /* Draft Badge */
        .draft-badge {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">Create New Competition</h3>
                            <p class="text-sm text-muted mb-0">Fill in the details step by step</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="draft-badge">
                                <i class="fas fa-save me-1"></i> Auto-save as Draft
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.competitions.store') }}" method="POST" enctype="multipart/form-data"
                        id="competitionForm">
                        @csrf

                        <!-- Wizard Steps -->
                        <div class="wizard-steps">
                            <div class="step active" data-step="1">
                                <div class="step-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="step-title">Basic Info</div>
                            </div>
                            <div class="step" data-step="2">
                                <div class="step-icon">
                                    <i class="fas fa-gavel"></i>
                                </div>
                                <div class="step-title">Entry Rules</div>
                            </div>
                            <div class="step" data-step="3">
                                <div class="step-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="step-title">Dates</div>
                            </div>
                            <div class="step" data-step="4">
                                <div class="step-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="step-title">Scoring</div>
                            </div>
                            <div class="step" data-step="5">
                                <div class="step-icon">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <div class="step-title">Prize</div>
                            </div>
                        </div>

                        <!-- Step 1: Basic Information -->
                        <div class="step-content active" id="step1">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="mb-3">Basic Information</h5>

                                    <!-- Cover Image Upload (Fixed) -->
                                    <div class="form-group mb-4">
                                        <label class="form-label fw-bold">Cover Image</label>
                                        <div class="cover-upload-area"
                                            onclick="document.getElementById('cover_image').click();">
                                            <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                            <h6>Click to upload cover image</h6>
                                            <p class="text-sm text-muted mb-0">Recommended: 1200x600px, JPG or PNG</p>
                                            <input type="file" id="cover_image" name="cover_image" accept="image/*"
                                                style="display: none;">
                                        </div>
                                        <div id="cover_preview_container" style="display: none;">
                                            <div class="cover-preview">
                                                <img id="cover_preview" src="" alt="Cover Preview">
                                                <button type="button" class="remove-cover" onclick="removeCover()">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @error('cover_image')
                                            <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Title -->
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-bold">Competition Title <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-heading"></i>
                                            </span>
                                            <input type="text" name="title" id="title"
                                                class="form-control border-start-0"
                                                placeholder="e.g., International DJ Battle 2025" value="{{ old('title') }}"
                                                required>
                                        </div>
                                        <small class="text-muted">
                                            <i class="fas fa-link me-1"></i>
                                            Slug: <span id="slug_preview">will-be-generated</span>
                                        </small>
                                    </div>

                                    <!-- Category -->
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-bold">Category <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-tag"></i>
                                            </span>
                                            <select name="category_id" class="form-select border-start-0" required>
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Short Description -->
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-bold">Short Description</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-align-left"></i>
                                            </span>
                                            <textarea name="short_description" class="form-control border-start-0" rows="3"
                                                placeholder="Brief description of the competition">{{ old('short_description') }}</textarea>
                                        </div>
                                        <small class="text-muted">Max 500 characters</small>
                                    </div>

                                    <!-- Submission Type -->
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-bold">Submission Type <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-upload"></i>
                                            </span>
                                            <select name="submission_type" id="submission_type"
                                                class="form-select border-start-0" required>
                                                @foreach ($submissionTypes as $value => $label)
                                                    <option value="{{ $value }}"
                                                        {{ old('submission_type') == $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Video Duration (Conditional) -->
                                    <div id="video_duration_field"
                                        style="display: {{ old('submission_type') == 'video' ? 'block' : 'none' }};">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Video Duration Limit (seconds) <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-clock"></i>
                                                </span>
                                                <input type="number" name="video_duration_limit"
                                                    class="form-control border-start-0" placeholder="e.g., 180"
                                                    min="1" max="3600"
                                                    value="{{ old('video_duration_limit') }}">
                                                <span class="input-group-text">seconds</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-3">
                                                <i class="fas fa-info-circle text-primary me-2"></i>
                                                Tips for Basic Info
                                            </h6>
                                            <ul class="list-unstyled mb-0">
                                                <li class="mb-2">
                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                    Use clear, descriptive title
                                                </li>
                                                <li class="mb-2">
                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                    High-quality cover image attracts participants
                                                </li>
                                                <li class="mb-2">
                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                    Choose relevant category
                                                </li>
                                                <li class="mb-2">
                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                    Keep description concise but informative
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Entry Rules -->
                        <div class="step-content" id="step2">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="mb-3">Entry Rules & Eligibility</h5>

                                    <!-- Eligibility -->
                                    <div class="form-group mb-4">
                                        <label class="form-label fw-bold">Eligibility <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-user-check"></i>
                                            </span>
                                            <select name="eligibility" class="form-select border-start-0" required>
                                                @foreach ($eligibilityTypes as $value => $label)
                                                    <option value="{{ $value }}"
                                                        {{ old('eligibility') == $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Entry Fee -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label class="form-label fw-bold">Fee Type <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-dollar-sign"></i>
                                                    </span>
                                                    <select name="entry_fee_type" id="entry_fee_type"
                                                        class="form-select border-start-0" required>
                                                        <option value="free"
                                                            {{ old('entry_fee_type') == 'free' ? 'selected' : '' }}>Free
                                                        </option>
                                                        <option value="paid"
                                                            {{ old('entry_fee_type') == 'paid' ? 'selected' : '' }}>Paid
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8" id="entry_fee_amount_field"
                                            style="display: {{ old('entry_fee_type') == 'paid' ? 'block' : 'none' }};">
                                            <div class="form-group mb-3">
                                                <label class="form-label fw-bold">Entry Fee Amount <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" step="0.01" min="0"
                                                        name="entry_fee_amount" class="form-control" placeholder="0.00"
                                                        value="{{ old('entry_fee_amount', 0) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Dates & Timeline -->
                        <div class="step-content" id="step3">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="mb-3">Dates & Timeline</h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label fw-bold">Start Date & Time <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </span>
                                                    <input type="datetime-local" name="start_at"
                                                        class="form-control border-start-0" value="{{ old('start_at') }}"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label fw-bold">End Date & Time <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-calendar-times"></i>
                                                    </span>
                                                    <input type="datetime-local" name="end_at"
                                                        class="form-control border-start-0" value="{{ old('end_at') }}"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label fw-bold">Voting Start (Optional)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-vote-yea"></i>
                                                    </span>
                                                    <input type="datetime-local" name="voting_start_at"
                                                        class="form-control border-start-0"
                                                        value="{{ old('voting_start_at') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label fw-bold">Voting End (Optional)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-vote-yea"></i>
                                                    </span>
                                                    <input type="datetime-local" name="voting_end_at"
                                                        class="form-control border-start-0"
                                                        value="{{ old('voting_end_at') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Scoring & Criteria -->
                        <div class="step-content" id="step4">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="mb-3">Scoring Configuration</h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label fw-bold">Judge Score Weight (%)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-gavel"></i>
                                                    </span>
                                                    <input type="number" name="judge_score_weight" id="judge_weight"
                                                        class="form-control border-start-0" min="0" max="100"
                                                        value="{{ old('judge_score_weight', 70) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label fw-bold">Public Votes Weight (%)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-users"></i>
                                                    </span>
                                                    <input type="number" name="public_votes_weight" id="public_weight"
                                                        class="form-control border-start-0" min="0" max="100"
                                                        value="{{ old('public_votes_weight', 30) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="weight_sum_alert" class="alert alert-warning py-2" style="display: none;">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <span id="weight_sum_message"></span>
                                    </div>

                                    <!-- Fraud Protection -->
                                    <div class="form-group mb-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="fraud_protection"
                                                name="fraud_protection" value="1"
                                                {{ old('fraud_protection', true) ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold" for="fraud_protection">
                                                Enable Fraud Protection
                                            </label>
                                        </div>
                                        <small class="text-muted">Advanced algorithms to detect voting fraud</small>
                                    </div>

                                    <!-- Judging Criteria -->
                                    <div class="form-group mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <label class="form-label fw-bold mb-0">Judging Criteria</label>
                                            <button type="button" class="btn btn-sm btn-primary"
                                                onclick="addCriteria()">
                                                <i class="fas fa-plus me-1"></i> Add Criteria
                                            </button>
                                        </div>
                                        <div id="criteria_container">
                                            <!-- Criteria will be added here -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 5: Prize Details -->
                        <div class="step-content" id="step5">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="mb-3">Prize Details</h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label fw-bold">Prize Title <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-trophy"></i>
                                                    </span>
                                                    <input type="text" name="prize_title"
                                                        class="form-control border-start-0"
                                                        placeholder="e.g., Grand Prize" value="{{ old('prize_title') }}"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label fw-bold">Prize Amount <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" step="0.01" min="0"
                                                        name="prize_amount" class="form-control" placeholder="0.00"
                                                        value="{{ old('prize_amount') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label fw-bold">Full Prize Description</label>
                                        <textarea name="prize_description" class="form-control" rows="4"
                                            placeholder="Detailed description of the prize">{{ old('prize_description') }}</textarea>
                                    </div>

                                    <!-- Publish/Draft Option -->
                                    <div class="form-group mt-4 p-3 bg-light rounded">
                                        <div class="d-flex align-items-center">
                                            <div class="form-check form-switch me-3">
                                                <input class="form-check-input" type="checkbox" id="is_published"
                                                    name="is_published" value="1"
                                                    {{ old('is_published') ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold" for="is_published">
                                                    Publish Immediately
                                                </label>
                                            </div>
                                            <div class="ms-3">
                                                <span class="badge bg-secondary">Draft Mode</span>
                                                <small class="text-muted ms-2">Uncheck to save as draft</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="wizard-navigation">
                            <button type="button" class="btn btn-secondary" id="prevBtn" onclick="prevStep()"
                                style="display: none;">
                                <i class="fas fa-arrow-left me-1"></i> Previous
                            </button>
                            <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextStep()">
                                Next <i class="fas fa-arrow-right ms-1"></i>
                            </button>
                            <button type="submit" class="btn btn-success" id="submitBtn" style="display: none;">
                                <i class="fas fa-save me-1"></i> Create Competition
                            </button>
                            <a href="{{ route('admin.competitions.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // ================ WIZARD NAVIGATION ================
            let currentStep = 1;
            const totalSteps = 5;

            function showStep(step) {
                // Hide all steps
                document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
                document.getElementById(`step${step}`).classList.add('active');

                // Update step indicators
                document.querySelectorAll('.step').forEach((el, index) => {
                    el.classList.remove('active', 'completed');
                    if (index + 1 < step) {
                        el.classList.add('completed');
                    } else if (index + 1 === step) {
                        el.classList.add('active');
                    }
                });

                // Show/hide navigation buttons
                document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'block';
                document.getElementById('nextBtn').style.display = step === totalSteps ? 'none' : 'block';
                document.getElementById('submitBtn').style.display = step === totalSteps ? 'block' : 'none';

                currentStep = step;
            }

            window.nextStep = function() {
                if (currentStep < totalSteps) {
                    if (validateStep(currentStep)) {
                        showStep(currentStep + 1);
                    }
                }
            }

            window.prevStep = function() {
                if (currentStep > 1) {
                    showStep(currentStep - 1);
                }
            }

            function validateStep(step) {
                switch (step) {
                    case 1:
                        const title = document.querySelector('input[name="title"]').value;
                        const category = document.querySelector('select[name="category_id"]').value;
                        const submissionType = document.querySelector('select[name="submission_type"]').value;

                        if (!title) {
                            Swal.fire('Validation Error', 'Competition title is required', 'warning');
                            return false;
                        }
                        if (!category) {
                            Swal.fire('Validation Error', 'Please select a category', 'warning');
                            return false;
                        }
                        if (!submissionType) {
                            Swal.fire('Validation Error', 'Please select submission type', 'warning');
                            return false;
                        }
                        if (submissionType === 'video') {
                            const duration = document.querySelector('input[name="video_duration_limit"]').value;
                            if (!duration) {
                                Swal.fire('Validation Error', 'Video duration limit is required', 'warning');
                                return false;
                            }
                        }
                        break;
                    case 2:
                        const eligibility = document.querySelector('select[name="eligibility"]').value;
                        const feeType = document.querySelector('select[name="entry_fee_type"]').value;

                        if (!eligibility) {
                            Swal.fire('Validation Error', 'Please select eligibility', 'warning');
                            return false;
                        }
                        if (feeType === 'paid') {
                            const feeAmount = document.querySelector('input[name="entry_fee_amount"]').value;
                            if (!feeAmount || parseFloat(feeAmount) <= 0) {
                                Swal.fire('Validation Error', 'Please enter valid entry fee amount', 'warning');
                                return false;
                            }
                        }
                        break;
                    case 3:
                        const startAt = document.querySelector('input[name="start_at"]').value;
                        const endAt = document.querySelector('input[name="end_at"]').value;

                        if (!startAt || !endAt) {
                            Swal.fire('Validation Error', 'Start and end dates are required', 'warning');
                            return false;
                        }
                        if (new Date(startAt) >= new Date(endAt)) {
                            Swal.fire('Validation Error', 'End date must be after start date', 'warning');
                            return false;
                        }
                        break;
                    case 4:
                        const judgeWeight = parseInt(document.getElementById('judge_weight').value) || 0;
                        const publicWeight = parseInt(document.getElementById('public_weight').value) || 0;

                        if (judgeWeight + publicWeight !== 100) {
                            Swal.fire('Validation Error', 'Judge and public weights must sum to 100%', 'warning');
                            return false;
                        }
                        break;
                    case 5:
                        const prizeTitle = document.querySelector('input[name="prize_title"]').value;
                        const prizeAmount = document.querySelector('input[name="prize_amount"]').value;

                        if (!prizeTitle) {
                            Swal.fire('Validation Error', 'Prize title is required', 'warning');
                            return false;
                        }
                        if (!prizeAmount || parseFloat(prizeAmount) <= 0) {
                            Swal.fire('Validation Error', 'Please enter valid prize amount', 'warning');
                            return false;
                        }
                        break;
                }
                return true;
            }

            // ================ COVER IMAGE FIX ================
            document.getElementById('cover_image').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('cover_preview');
                        preview.src = e.target.result;
                        document.getElementById('cover_preview_container').style.display = 'block';
                        document.querySelector('.cover-upload-area').style.display = 'none';
                    }
                    reader.readAsDataURL(file);
                }
            });

            window.removeCover = function() {
                document.getElementById('cover_image').value = '';
                document.getElementById('cover_preview_container').style.display = 'none';
                document.querySelector('.cover-upload-area').style.display = 'block';
            }

            // ================ SLUG PREVIEW ================
            document.getElementById('title').addEventListener('input', function() {
                const title = this.value;
                const slug = title.toLowerCase()
                    .replace(/[^\w\s]/gi, '')
                    .replace(/\s+/g, '-');
                document.getElementById('slug_preview').textContent = slug || 'will-be-generated';
            });

            // ================ SUBMISSION TYPE TOGGLE ================
            document.getElementById('submission_type').addEventListener('change', function() {
                const videoField = document.getElementById('video_duration_field');
                videoField.style.display = this.value === 'video' ? 'block' : 'none';
            });

            // ================ ENTRY FEE TOGGLE ================
            document.getElementById('entry_fee_type').addEventListener('change', function() {
                const feeAmountField = document.getElementById('entry_fee_amount_field');
                feeAmountField.style.display = this.value === 'paid' ? 'block' : 'none';
            });

            // ================ WEIGHT VALIDATION ================
            function updateWeights() {
                const judgeWeight = parseInt(document.getElementById('judge_weight').value) || 0;
                const publicWeight = parseInt(document.getElementById('public_weight').value) || 0;
                const total = judgeWeight + publicWeight;

                const alertBox = document.getElementById('weight_sum_alert');
                if (total !== 100) {
                    alertBox.style.display = 'block';
                    document.getElementById('weight_sum_message').innerHTML =
                        `Weights sum to ${total}%. They must sum to 100%.`;
                } else {
                    alertBox.style.display = 'none';
                }
            }

            document.getElementById('judge_weight').addEventListener('input', updateWeights);
            document.getElementById('public_weight').addEventListener('input', updateWeights);

            // ================ CRITERIA ================
            let criteriaCount = 0;

            window.addCriteria = function() {
                criteriaCount++;
                const container = document.getElementById('criteria_container');
                const div = document.createElement('div');
                div.className = 'criteria-item';
                div.innerHTML = `
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h6 class="mb-0">Criterion #${criteriaCount}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label text-sm">Name</label>
                                <input type="text" class="form-control form-control-sm" 
                                    name="criteria[${criteriaCount}][name]" 
                                    placeholder="e.g., Creativity" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label class="form-label text-sm">Weight (%)</label>
                                <input type="number" class="form-control form-control-sm" 
                                    name="criteria[${criteriaCount}][weight]" 
                                    min="1" max="100" value="100">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label class="form-label text-sm">Max Score</label>
                                <input type="number" class="form-control form-control-sm" 
                                    name="criteria[${criteriaCount}][max_score]" 
                                    value="10" min="1" max="100">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control form-control-sm" 
                            name="criteria[${criteriaCount}][description]" 
                            rows="2" placeholder="Description (optional)"></textarea>
                    </div>
                `;
                container.appendChild(div);
            }

            // Add default criterion
            window.addCriteria();

            // ================ FORM SUBMIT ================
            document.getElementById('competitionForm').addEventListener('submit', function(e) {
                if (!validateStep(currentStep)) {
                    e.preventDefault();
                }
            });

            // ================ INITIALIZE ================
            document.addEventListener('DOMContentLoaded', function() {
                showStep(1);
                updateWeights();
            });
        </script>
    @endpush
@endsection
