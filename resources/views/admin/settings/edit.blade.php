@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-0">Settings</h3>
            {{-- <small class="text-muted">Manage app configuration</small> --}}
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf

        <!-- General Settings Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-transparent">
                <h5 class="mb-0">
                    <i class="bi bi-gear me-2"></i>
                    General Settings
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">

                    <!-- Logo Upload Section -->
                    <div class="col-12">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-images me-1"></i>
                            Logo & Images
                        </h6>
                    </div>

                    <!-- White Logo -->
                    <div class="col-md-4">
                        <label class="form-label">White Logo</label>
                        <div class="border rounded p-3 bg-light">
                            @if (!empty($data['general']['white_logo']))
                                <img src="{{ asset('storage/' . $data['general']['white_logo']) }}"
                                    class="img-fluid rounded mb-2 border"
                                    style="height:100px; object-fit:contain; width:100%;">
                            @else
                                <div class="text-center py-4 bg-white rounded">
                                    <i class="bi bi-image text-secondary fs-1"></i>
                                    <p class="text-muted mt-2 mb-0">No logo uploaded</p>
                                </div>
                            @endif
                            <div class="mt-3">
                                <input type="file" name="white_logo" class="form-control" accept="image/*">
                                <div class="form-text mt-1">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Allowed: png, jpg, jpeg, webp
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Black Logo -->
                    <div class="col-md-4">
                        <label class="form-label">Black Logo</label>
                        <div class="border rounded p-3 bg-light">
                            @if (!empty($data['general']['black_logo']))
                                <img src="{{ asset('storage/' . $data['general']['black_logo']) }}"
                                    class="img-fluid rounded mb-2 border"
                                    style="height:100px; object-fit:contain; width:100%;">
                            @else
                                <div class="text-center py-4 bg-white rounded">
                                    <i class="bi bi-image text-secondary fs-1"></i>
                                    <p class="text-muted mt-2 mb-0">No logo uploaded</p>
                                </div>
                            @endif
                            <div class="mt-3">
                                <input type="file" name="black_logo" class="form-control" accept="image/*">
                                <div class="form-text mt-1">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Allowed: png, jpg, jpeg, webp
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Favicon -->
                    <div class="col-md-4">
                        <label class="form-label">Favicon</label>
                        <div class="border rounded p-3 bg-light">
                            @if (!empty($data['general']['favicon']))
                                <img src="{{ asset('storage/' . $data['general']['favicon']) }}"
                                    class="img-fluid rounded mb-2 border"
                                    style="height:100px; object-fit:contain; width:100%;">
                            @else
                                <div class="text-center py-4 bg-white rounded">
                                    <i class="bi bi-window-stack text-secondary fs-1"></i>
                                    <p class="text-muted mt-2 mb-0">No favicon uploaded</p>
                                </div>
                            @endif
                            <div class="mt-3">
                                <input type="file" name="favicon" class="form-control" accept="image/*">
                                <div class="form-text mt-1">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Allowed: png, jpg, jpeg, webp, ico
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Company Information Section -->
                    <div class="col-12 mt-4">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-building me-1"></i>
                            Company Information
                        </h6>
                    </div>

                    <!-- Company Name -->
                    <div class="col-md-6">
                        <label class="form-label">Company Name</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-building"></i>
                            </span>
                            <input type="text" name="company_name" class="form-control"
                                value="{{ old('company_name', $data['general']['company_name'] ?? '') }}"
                                placeholder="Enter company name">
                        </div>
                    </div>

                    <!-- Company Description -->
                    <div class="col-md-6">
                        <label class="form-label">Company Description</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-card-text"></i>
                            </span>
                            <input type="text" name="company_description" class="form-control"
                                value="{{ old('company_description', $data['general']['company_description'] ?? '') }}"
                                placeholder="Enter company description">
                        </div>
                    </div>

                    <!-- Contact Information Section -->
                    <div class="col-12 mt-4">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-telephone me-1"></i>
                            Contact Information
                        </h6>
                    </div>

                    <!-- Email -->
                    <div class="col-md-4">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $data['general']['email'] ?? '') }}" placeholder="email@example.com">
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-4">
                        <label class="form-label">Phone</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-telephone"></i>
                            </span>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone', $data['general']['phone'] ?? '') }}" placeholder="+1234567890">
                        </div>
                    </div>

                    <!-- Website -->
                    <div class="col-md-4">
                        <label class="form-label">Website</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-globe"></i>
                            </span>
                            <input type="text" name="website" class="form-control"
                                value="{{ old('website', $data['general']['website'] ?? '') }}"
                                placeholder="https://example.com">
                        </div>
                    </div>

                    <!-- Fax -->
                    <div class="col-md-4 mt-2">
                        <label class="form-label">Fax</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-printer"></i>
                            </span>
                            <input type="text" name="fax" class="form-control"
                                value="{{ old('fax', $data['general']['fax'] ?? '') }}" placeholder="Fax number">
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-md-8 mt-2">
                        <label class="form-label">Address</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-geo-alt"></i>
                            </span>
                            <input type="text" name="address" class="form-control"
                                value="{{ old('address', $data['general']['address'] ?? '') }}"
                                placeholder="Full company address">
                        </div>
                    </div>

                    <!-- System Configuration Section -->
                    <div class="col-12 mt-4">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-cpu me-1"></i>
                            System Configuration
                        </h6>
                    </div>

                    <!-- Timezone -->
                    <div class="col-md-4">
                        <label class="form-label">System Timezone</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-clock"></i>
                            </span>
                            <input type="text" name="system_timezone" class="form-control"
                                value="{{ old('system_timezone', $data['general']['system_timezone'] ?? 'UTC') }}"
                                placeholder="Asia/Karachi">
                        </div>
                    </div>

                    <!-- Default Password -->
                    <div class="col-md-4">
                        <label class="form-label">Default Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-key"></i>
                            </span>
                            <input type="text" name="default_password" class="form-control"
                                value="{{ old('default_password', $data['general']['default_password'] ?? '') }}"
                                placeholder="Default user password">
                        </div>
                    </div>

                    <!-- Language -->
                    <div class="col-md-4">
                        <label class="form-label">Default Language</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-translate"></i>
                            </span>
                            <input type="text" name="default_language" class="form-control"
                                value="{{ old('default_language', $data['general']['default_language'] ?? 'English') }}"
                                placeholder="System language">
                        </div>
                    </div>

                    <!-- Display Settings Section -->
                    <div class="col-12 mt-4">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-display me-1"></i>
                            Display Settings
                        </h6>
                    </div>

                    <!-- Per Page Items -->
                    <div class="col-md-3">
                        <label class="form-label">Per Page Items</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-list-ol"></i>
                            </span>
                            <input type="number" name="per_page_items" class="form-control"
                                value="{{ old('per_page_items', $data['general']['per_page_items'] ?? 10) }}"
                                min="1" max="200">
                        </div>
                        <div class="form-text">Items per page in lists</div>
                    </div>

                    <!-- Date Format -->
                    <div class="col-md-3">
                        <label class="form-label">Date Format</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-calendar"></i>
                            </span>
                            <input type="text" name="date_format" class="form-control"
                                value="{{ old('date_format', $data['general']['date_format'] ?? 'd/m/Y') }}"
                                placeholder="d/m/Y">
                        </div>
                        <div class="form-text">e.g. d/m/Y, Y-m-d</div>
                    </div>

                    <!-- Layout -->
                    <div class="col-md-3">
                        <label class="form-label">Layout</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-layout-split"></i>
                            </span>
                            <input type="text" name="layout" class="form-control"
                                value="{{ old('layout', $data['general']['layout'] ?? '-fluid') }}" placeholder="-fluid">
                        </div>
                    </div>

                    <!-- Primary Color -->
                    <div class="col-md-3">
                        <label class="form-label">Primary Color</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-palette"></i>
                            </span>
                            <input type="text" name="primary_color" class="form-control"
                                value="{{ old('primary_color', $data['general']['primary_color'] ?? 'Primary') }}"
                                placeholder="Primary">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Toast Colors Settings -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-transparent">
                <h5 class="mb-0">
                    <i class="bi bi-palette me-2"></i>
                    Toast Colors
                </h5>
                <small class="text-muted">Customize toast colors for each type</small>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <!-- Success Colors -->
                    <div class="col-md-6">
                        <h6 class="text-success mb-3">
                            <i class="bi bi-check-circle me-1"></i>
                            Success Toast Colors
                        </h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label">Background</label>
                                <div class="input-group">
                                    <input type="color" name="tc_success_bg" class="form-control form-control-color"
                                        value="{{ old('tc_success_bg', $data['toast_colors']['success_bg'] ?? '#28a745') }}">
                                    <input type="text" class="form-control"
                                        value="{{ old('tc_success_bg', $data['toast_colors']['success_bg'] ?? '#28a745') }}"
                                        oninput="this.previousElementSibling.value=this.value">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Text Color</label>
                                <div class="input-group">
                                    <input type="color" name="tc_success_text" class="form-control form-control-color"
                                        value="{{ old('tc_success_text', $data['toast_colors']['success_text'] ?? '#ffffff') }}">
                                    <input type="text" class="form-control"
                                        value="{{ old('tc_success_text', $data['toast_colors']['success_text'] ?? '#ffffff') }}"
                                        oninput="this.previousElementSibling.value=this.value">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Error Colors -->
                    <div class="col-md-6">
                        <h6 class="text-danger mb-3">
                            <i class="bi bi-x-circle me-1"></i>
                            Error Toast Colors
                        </h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label">Background</label>
                                <div class="input-group">
                                    <input type="color" name="tc_error_bg" class="form-control form-control-color"
                                        value="{{ old('tc_error_bg', $data['toast_colors']['error_bg'] ?? '#dc3545') }}">
                                    <input type="text" class="form-control"
                                        value="{{ old('tc_error_bg', $data['toast_colors']['error_bg'] ?? '#dc3545') }}"
                                        oninput="this.previousElementSibling.value=this.value">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Text Color</label>
                                <div class="input-group">
                                    <input type="color" name="tc_error_text" class="form-control form-control-color"
                                        value="{{ old('tc_error_text', $data['toast_colors']['error_text'] ?? '#ffffff') }}">
                                    <input type="text" class="form-control"
                                        value="{{ old('tc_error_text', $data['toast_colors']['error_text'] ?? '#ffffff') }}"
                                        oninput="this.previousElementSibling.value=this.value">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Warning Colors -->
                    <div class="col-md-6">
                        <h6 class="text-warning mb-3">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Warning Toast Colors
                        </h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label">Background</label>
                                <div class="input-group">
                                    <input type="color" name="tc_warning_bg" class="form-control form-control-color"
                                        value="{{ old('tc_warning_bg', $data['toast_colors']['warning_bg'] ?? '#ffc107') }}">
                                    <input type="text" class="form-control"
                                        value="{{ old('tc_warning_bg', $data['toast_colors']['warning_bg'] ?? '#ffc107') }}"
                                        oninput="this.previousElementSibling.value=this.value">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Text Color</label>
                                <div class="input-group">
                                    <input type="color" name="tc_warning_text" class="form-control form-control-color"
                                        value="{{ old('tc_warning_text', $data['toast_colors']['warning_text'] ?? '#000000') }}">
                                    <input type="text" class="form-control"
                                        value="{{ old('tc_warning_text', $data['toast_colors']['warning_text'] ?? '#000000') }}"
                                        oninput="this.previousElementSibling.value=this.value">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Colors -->
                    <div class="col-md-6">
                        <h6 class="text-info mb-3">
                            <i class="bi bi-info-circle me-1"></i>
                            Info Toast Colors
                        </h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label">Background</label>
                                <div class="input-group">
                                    <input type="color" name="tc_info_bg" class="form-control form-control-color"
                                        value="{{ old('tc_info_bg', $data['toast_colors']['info_bg'] ?? '#17a2b8') }}">
                                    <input type="text" class="form-control"
                                        value="{{ old('tc_info_bg', $data['toast_colors']['info_bg'] ?? '#17a2b8') }}"
                                        oninput="this.previousElementSibling.value=this.value">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Text Color</label>
                                <div class="input-group">
                                    <input type="color" name="tc_info_text" class="form-control form-control-color"
                                        value="{{ old('tc_info_text', $data['toast_colors']['info_text'] ?? '#ffffff') }}">
                                    <input type="text" class="form-control"
                                        value="{{ old('tc_info_text', $data['toast_colors']['info_text'] ?? '#ffffff') }}"
                                        oninput="this.previousElementSibling.value=this.value">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Positions Settings -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-transparent">
                <h5 class="mb-0">
                    <i class="bi bi-geo-alt me-2"></i>
                    Toast Positions
                </h5>
                <small class="text-muted">Set position for each toast type</small>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Success Position</label>
                        <select name="tp_success_position" class="form-select">
                            @foreach ($positionOptions as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('tp_success_position', $data['toast_positions']['success_position'] ?? '') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Error Position</label>
                        <select name="tp_error_position" class="form-select">
                            @foreach ($positionOptions as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('tp_error_position', $data['toast_positions']['error_position'] ?? '') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Warning Position</label>
                        <select name="tp_warning_position" class="form-select">
                            @foreach ($positionOptions as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('tp_warning_position', $data['toast_positions']['warning_position'] ?? '') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Info Position</label>
                        <select name="tp_info_position" class="form-select">
                            @foreach ($positionOptions as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('tp_info_position', $data['toast_positions']['info_position'] ?? '') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- SweetAlert Appearance Settings -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-transparent">
                <h5 class="mb-0">
                    <i class="bi bi-brush me-2"></i>
                    Toast Appearance
                </h5>
                <small class="text-muted">Customize toast appearance</small>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Animation</label>
                        <select name="sa_animation" class="form-select">
                            @foreach ($animationOptions as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('sa_animation', $data['sweetalert']['animation'] ?? '') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Width</label>
                        <div class="input-group">
                            <input type="text" name="sa_width" class="form-control"
                                value="{{ old('sa_width', $data['sweetalert']['width'] ?? '350px') }}"
                                placeholder="350px">
                            <span class="input-group-text">px</span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Padding</label>
                        <input type="text" name="sa_padding" class="form-control"
                            value="{{ old('sa_padding', $data['sweetalert']['padding'] ?? '1rem') }}" placeholder="1rem">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Icon Color</label>
                        <div class="input-group">
                            <input type="color" name="sa_icon_color" class="form-control form-control-color"
                                value="{{ old('sa_icon_color', $data['sweetalert']['icon_color'] ?? '#ffffff') }}">
                            <input type="text" class="form-control"
                                value="{{ old('sa_icon_color', $data['sweetalert']['icon_color'] ?? '#ffffff') }}"
                                oninput="this.previousElementSibling.value=this.value">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Text Color</label>
                        <div class="input-group">
                            <input type="color" name="sa_text_color" class="form-control form-control-color"
                                value="{{ old('sa_text_color', $data['sweetalert']['text_color'] ?? '#000000') }}">
                            <input type="text" class="form-control"
                                value="{{ old('sa_text_color', $data['sweetalert']['text_color'] ?? '#000000') }}"
                                oninput="this.previousElementSibling.value=this.value">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Border Color</label>
                        <div class="input-group">
                            <input type="color" name="sa_border_color" class="form-control form-control-color"
                                value="{{ old('sa_border_color', $data['sweetalert']['border_color'] ?? '#e6b800') }}">
                            <input type="text" class="form-control"
                                value="{{ old('sa_border_color', $data['sweetalert']['border_color'] ?? '#e6b800') }}"
                                oninput="this.previousElementSibling.value=this.value">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- SweetAlert Settings Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-transparent">
                <h5 class="mb-0">
                    <i class="bi bi-bell me-2"></i>
                    Notification Settings (SweetAlert)
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Default Title</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-chat-left-text"></i>
                            </span>
                            <input type="text" name="sa_default_title" class="form-control"
                                value="{{ old('sa_default_title', $data['sweetalert']['default_title'] ?? '') }}"
                                placeholder="Alert title">
                        </div>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label">Default Message</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-chat-left-dots"></i>
                            </span>
                            <input type="text" name="sa_default_message" class="form-control"
                                value="{{ old('sa_default_message', $data['sweetalert']['default_message'] ?? '') }}"
                                placeholder="Alert message">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Display Time (ms)</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-hourglass-split"></i>
                            </span>
                            <input type="number" name="sa_display_time" class="form-control"
                                value="{{ old('sa_display_time', $data['sweetalert']['display_time'] ?? 3000) }}"
                                min="500" max="10000">
                            <span class="input-group-text">ms</span>
                        </div>
                        <div class="form-text">3000 = 3 seconds</div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Background Color</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-paint-bucket"></i>
                            </span>
                            <input type="text" name="sa_background_color" class="form-control"
                                value="{{ old('sa_background_color', $data['sweetalert']['background_color'] ?? '#ffc700') }}"
                                placeholder="#ffc700">
                            <span class="input-group-text color-preview"
                                style="background-color: {{ old('sa_background_color', $data['sweetalert']['background_color'] ?? '#ffc700') }};">
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Alert Position</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-arrow-up-right"></i>
                            </span>
                            <select name="sa_position" class="form-select">
                                <option value="top-end"
                                    {{ old('sa_position', $data['sweetalert']['position'] ?? '') == 'top-end' ? 'selected' : '' }}>
                                    Top Right</option>
                                <option value="top-start"
                                    {{ old('sa_position', $data['sweetalert']['position'] ?? '') == 'top-start' ? 'selected' : '' }}>
                                    Top Left</option>
                                <option value="top-center"
                                    {{ old('sa_position', $data['sweetalert']['position'] ?? '') == 'top-center' ? 'selected' : '' }}>
                                    Top Center</option>
                                <option value="center"
                                    {{ old('sa_position', $data['sweetalert']['position'] ?? '') == 'center' ? 'selected' : '' }}>
                                    Center</option>
                            </select>
                        </div>
                        <div class="form-text">Position on screen</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Email Settings Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-transparent">
                <h5 class="mb-0">
                    <i class="bi bi-envelope me-2"></i>
                    Email Settings
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">From Name</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" name="from_name" class="form-control"
                                value="{{ old('from_name', $data['email_settings']['from_name'] ?? '') }}"
                                placeholder="Sender name">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">From Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope-at"></i>
                            </span>
                            <input type="email" name="from_email" class="form-control"
                                value="{{ old('from_email', $data['email_settings']['from_email'] ?? '') }}"
                                placeholder="sender@example.com">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Reply To Name</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-reply"></i>
                            </span>
                            <input type="text" name="reply_to_name" class="form-control"
                                value="{{ old('reply_to_name', $data['email_settings']['reply_to_name'] ?? '') }}"
                                placeholder="Reply to name">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Reply To Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-reply-fill"></i>
                            </span>
                            <input type="email" name="reply_to_email" class="form-control"
                                value="{{ old('reply_to_email', $data['email_settings']['reply_to_email'] ?? '') }}"
                                placeholder="reply@example.com">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary px-4">
                <i class="fas fa-times me-1"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-check me-1"></i> Save Settings
            </button>
        </div>
    </form>


    <style>
        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            background-color: rgba(0, 0, 0, .02);
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
        }

        .form-control:focus+.input-group-text {
            border-color: #86b7fe;
            background-color: #f8f9fa;
        }

        .color-preview {
            width: 40px;
            border-left: none;
            border-radius: 0 .375rem .375rem 0;
        }

        .form-text {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .border {
            border: 1px solid #dee2e6 !important;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        h6.text-primary {
            font-weight: 600;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c2c7;
            color: #842029;
        }

        .alert-danger ul {
            margin-bottom: 0;
        }

        h3 {
            color: #fff;
        }
    </style>

    <script>
        // Color picker sync between color input and text input
        document.querySelectorAll('input[type="color"]').forEach(colorInput => {
            const textInput = colorInput.nextElementSibling;

            colorInput.addEventListener('input', function() {
                textInput.value = this.value;
            });

            textInput.addEventListener('input', function() {
                if (this.value.match(/^#[0-9A-F]{6}$/i)) {
                    colorInput.value = this.value;
                }
            });
        });

        // Preview toast colors
        function previewToastColors() {
            const colors = {
                success: {
                    bg: document.querySelector('input[name="tc_success_bg"]').value,
                    text: document.querySelector('input[name="tc_success_text"]').value
                },
                error: {
                    bg: document.querySelector('input[name="tc_error_bg"]').value,
                    text: document.querySelector('input[name="tc_error_text"]').value
                },
                warning: {
                    bg: document.querySelector('input[name="tc_warning_bg"]').value,
                    text: document.querySelector('input[name="tc_warning_text"]').value
                },
                info: {
                    bg: document.querySelector('input[name="tc_info_bg"]').value,
                    text: document.querySelector('input[name="tc_info_text"]').value
                }
            };

            // Show preview in console or create visual preview
            console.log('Updated Toast Colors:', colors);

            // You can add a visual preview here if needed
            updateColorPreviews(colors);
        }

        function updateColorPreviews(colors) {
            // Update color preview boxes
            document.querySelectorAll('.color-preview').forEach(preview => {
                const type = preview.dataset.type;
                const property = preview.dataset.property;

                if (colors[type] && colors[type][property]) {
                    preview.style.backgroundColor = colors[type][property];
                }
            });
        }

        // Attach events to color inputs
        document.querySelectorAll('input[name^="tc_"]').forEach(input => {
            input.addEventListener('change', previewToastColors);
            input.addEventListener('input', previewToastColors);
        });
    </script>

    <script>
        // Color preview update
        document.querySelector('input[name="sa_background_color"]').addEventListener('input', function(e) {
            const preview = document.querySelector('.color-preview');
            preview.style.backgroundColor = e.target.value;
        });

        // Live preview for logos
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    const imgPreview = this.closest('.border').querySelector('img');
                    const placeholder = this.closest('.border').querySelector('.text-center');

                    reader.onload = function(e) {
                        if (imgPreview) {
                            imgPreview.src = e.target.result;
                        } else if (placeholder) {
                            placeholder.innerHTML =
                                `<img src="${e.target.result}" class="img-fluid rounded mb-2 border" style="height:100px; object-fit:contain; width:100%;">`;
                        }
                    }
                    reader.readAsDataURL(file);
                }
            });
        });

        // Form submission confirmation
        document.querySelector('form').addEventListener('submit', function(e) {
            if (!confirm('Are you sure you want to save these settings?')) {
                e.preventDefault();
            }
        });
    </script>

@endsection
