@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Settings</h3>
            <small class="text-muted">Manage app configuration</small>
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

        {{-- ===================== GENERAL SETTINGS ===================== --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="mb-3">General Settings</h5>

                <div class="row g-3">

                    {{-- White Logo --}}
                    <div class="col-12 col-md-4">
                        <label class="form-label">White Logo</label>
                        <div class="border rounded p-2 bg-light">
                            @if (!empty($data['general']['white_logo']))
                                <img src="{{ asset('storage/' . $data['general']['white_logo']) }}"
                                    class="img-fluid rounded mb-2" style="height:120px; object-fit:contain;">
                            @endif
                            <input type="file" name="white_logo" class="form-control" accept="image/*">
                            <div class="form-text">Allowed: png, jpg, jpeg, webp</div>
                        </div>
                    </div>

                    {{-- Black Logo --}}
                    <div class="col-12 col-md-4">
                        <label class="form-label">Black Logo</label>
                        <div class="border rounded p-2 bg-light">
                            @if (!empty($data['general']['black_logo']))
                                <img src="{{ asset('storage/' . $data['general']['black_logo']) }}"
                                    class="img-fluid rounded mb-2" style="height:120px; object-fit:contain;">
                            @endif
                            <input type="file" name="black_logo" class="form-control" accept="image/*">
                            <div class="form-text">Allowed: png, jpg, jpeg, webp</div>
                        </div>
                    </div>

                    {{-- Favicon --}}
                    <div class="col-12 col-md-4">
                        <label class="form-label">Favicon</label>
                        <div class="border rounded p-2 bg-light">
                            @if (!empty($data['general']['favicon']))
                                <img src="{{ asset('storage/' . $data['general']['favicon']) }}"
                                    class="img-fluid rounded mb-2" style="height:120px; object-fit:contain;">
                            @endif
                            <input type="file" name="favicon" class="form-control" accept="image/*">
                            <div class="form-text">Allowed: png, jpg, jpeg, webp, ico</div>
                        </div>
                    </div>

                    {{-- Company Name --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">Company Name</label>
                        <input type="text" name="company_name" class="form-control"
                            value="{{ old('company_name', $data['general']['company_name'] ?? '') }}">
                    </div>

                    {{-- Company Description --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">Company Description</label>
                        <input type="text" name="company_description" class="form-control"
                            value="{{ old('company_description', $data['general']['company_description'] ?? '') }}">
                    </div>

                    {{-- Email --}}
                    <div class="col-12 col-md-3">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class="form-control"
                            value="{{ old('email', $data['general']['email'] ?? '') }}">
                    </div>

                    {{-- Website --}}
                    <div class="col-12 col-md-3">
                        <label class="form-label">Website</label>
                        <input type="text" name="website" class="form-control"
                            value="{{ old('website', $data['general']['website'] ?? '') }}">
                    </div>

                    {{-- Phone --}}
                    <div class="col-12 col-md-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control"
                            value="{{ old('phone', $data['general']['phone'] ?? '') }}">
                    </div>

                    {{-- Fax --}}
                    <div class="col-12 col-md-3">
                        <label class="form-label">Fax</label>
                        <input type="text" name="fax" class="form-control"
                            value="{{ old('fax', $data['general']['fax'] ?? '') }}">
                    </div>

                    {{-- Address --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control"
                            value="{{ old('address', $data['general']['address'] ?? '') }}">
                    </div>

                    {{-- Timezone --}}
                    <div class="col-12 col-md-3">
                        <label class="form-label">System Timezone</label>
                        <input type="text" name="system_timezone" class="form-control"
                            value="{{ old('system_timezone', $data['general']['system_timezone'] ?? 'UTC') }}"
                            placeholder="Asia/Karachi">
                    </div>

                    {{-- Default Password --}}
                    <div class="col-12 col-md-3">
                        <label class="form-label">Default Password</label>
                        <input type="text" name="default_password" class="form-control"
                            value="{{ old('default_password', $data['general']['default_password'] ?? '') }}">
                    </div>

                    {{-- Per page --}}
                    <div class="col-12 col-md-2">
                        <label class="form-label">Per Page Items</label>
                        <input type="number" name="per_page_items" class="form-control"
                            value="{{ old('per_page_items', $data['general']['per_page_items'] ?? 10) }}">
                    </div>

                    {{-- Date format --}}
                    <div class="col-12 col-md-3">
                        <label class="form-label">Date Format</label>
                        <input type="text" name="date_format" class="form-control"
                            value="{{ old('date_format', $data['general']['date_format'] ?? 'd/m/Y') }}">
                    </div>

                    {{-- Layout --}}
                    <div class="col-12 col-md-2">
                        <label class="form-label">Layout</label>
                        <input type="text" name="layout" class="form-control"
                            value="{{ old('layout', $data['general']['layout'] ?? '-fluid') }}">
                    </div>

                    {{-- Primary Color --}}
                    <div class="col-12 col-md-2">
                        <label class="form-label">Primary Color</label>
                        <input type="text" name="primary_color" class="form-control"
                            value="{{ old('primary_color', $data['general']['primary_color'] ?? 'Primary') }}">
                    </div>

                    {{-- Default Language --}}
                    <div class="col-12 col-md-3">
                        <label class="form-label">Default Language</label>
                        <input type="text" name="default_language" class="form-control"
                            value="{{ old('default_language', $data['general']['default_language'] ?? 'English') }}">
                    </div>

                </div>
            </div>
        </div>

        {{-- ===================== SWEET ALERT SETTINGS ===================== --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="mb-3">Sweet Alert Settings</h5>

                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <label class="form-label">Default Title</label>
                        <input type="text" name="sa_default_title" class="form-control"
                            value="{{ old('sa_default_title', $data['sweetalert']['default_title'] ?? '') }}">
                    </div>

                    <div class="col-12 col-md-8">
                        <label class="form-label">Default Message</label>
                        <input type="text" name="sa_default_message" class="form-control"
                            value="{{ old('sa_default_message', $data['sweetalert']['default_message'] ?? '') }}">
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Display Time (ms)</label>
                        <input type="number" name="sa_display_time" class="form-control"
                            value="{{ old('sa_display_time', $data['sweetalert']['display_time'] ?? 3000) }}">
                        <div class="form-text">3000 = 3 seconds</div>
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Background Color</label>
                        <input type="text" name="sa_background_color" class="form-control"
                            value="{{ old('sa_background_color', $data['sweetalert']['background_color'] ?? '#ffc700') }}">
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Alert Position</label>
                        <input type="text" name="sa_position" class="form-control"
                            value="{{ old('sa_position', $data['sweetalert']['position'] ?? 'top-end') }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- ===================== EMAIL SETTINGS ===================== --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="mb-3">Email Settings</h5>

                <div class="row g-3">
                    <div class="col-12 col-md-3">
                        <label class="form-label">From Name</label>
                        <input type="text" name="from_name" class="form-control"
                            value="{{ old('from_name', $data['email_settings']['from_name'] ?? '') }}">
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">From Email</label>
                        <input type="text" name="from_email" class="form-control"
                            value="{{ old('from_email', $data['email_settings']['from_email'] ?? '') }}">
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Reply To Name</label>
                        <input type="text" name="reply_to_name" class="form-control"
                            value="{{ old('reply_to_name', $data['email_settings']['reply_to_name'] ?? '') }}">
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Reply To Email</label>
                        <input type="text" name="reply_to_email" class="form-control"
                            value="{{ old('reply_to_email', $data['email_settings']['reply_to_email'] ?? '') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button class="btn btn-primary px-4">Submit</button>
        </div>

    </form>
@endsection
