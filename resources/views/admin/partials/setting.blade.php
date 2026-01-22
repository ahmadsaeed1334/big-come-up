<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
        <div class="card-header pb-0 pt-3 ">
            <div class="float-start">
                <h5 class="mt-3 mb-0">Theme Configurator</h5>
                <p>Customize your dashboard.</p>
            </div>
            <div class="float-end mt-4">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0 overflow-auto">
            <!-- Sidebar Backgrounds -->
            <div>
                <h6 class="mb-0">Nav Item Active Colors</h6>
            </div>
            <a href="javascript:void(0)" class="switch-trigger background-color">
                <div class="badge-colors my-2 text-start">
                    @php
                        $colors = ['primary', 'dark', 'info', 'success', 'warning', 'danger'];
                        $currentColor = $themeSettings['sidebar_color'] ?? 'primary';
                    @endphp
                    @foreach ($colors as $color)
                        <span
                            class="badge filter bg-gradient-{{ $color }} {{ $color == $currentColor ? 'active' : '' }}"
                            data-color="{{ $color }}" onclick="sidebarColor(this)"></span>
                    @endforeach
                </div>
            </a>

            <!-- Sidenav Type -->
            <div class="mt-3">
                <h6 class="mb-0">Sidenav Type</h6>
                <p class="text-sm">Choose between 2 different sidenav types.</p>
            </div>
            <div class="d-flex">
                @php
                    $currentType = $themeSettings['sidenav_type'] ?? 'bg-white';
                @endphp
                <button
                    class="btn bg-gradient-primary w-100 px-3 mb-2 me-2 {{ $currentType == 'bg-white' ? 'active' : '' }}"
                    data-class="bg-white" onclick="sidebarType(this)">White</button>
                <button
                    class="btn bg-gradient-primary w-100 px-3 mb-2 {{ $currentType == 'bg-default' ? 'active' : '' }}"
                    data-class="bg-default" onclick="sidebarType(this)">Dark</button>
            </div>

            <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
            <hr class="horizontal dark my-sm-4">

            <!-- Light / Dark Mode -->
            <div class="mt-2 mb-5 d-flex">
                <h6 class="mb-0">Light / Dark</h6>
                <div class="form-check form-switch ps-0 ms-auto my-auto">
                    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                        {{ $themeSettings['dark_mode'] ?? false ? 'checked' : '' }} onclick="darkMode(this)">
                </div>
            </div>

            <!-- Save Button -->
            <div class="mt-3">
                <button class="btn btn-primary w-100" onclick="saveAllSettings()">
                    <i class="fa fa-save me-2"></i> Save Settings
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to save all settings at once
    function saveAllSettings() {
        const sidebarColor = document.querySelector('.badge-colors .badge.filter.active')?.getAttribute('data-color') ||
            'primary';
        const sidenavType = document.querySelector('.btn[data-class].active')?.getAttribute('data-class') || 'bg-white';
        const darkMode = document.getElementById('dark-version')?.checked || false;

        fetch('/admin/theme/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    sidebar_color: sidebarColor,
                    sidenav_type: sidenavType,
                    dark_mode: darkMode
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Theme settings saved successfully!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            })
            .catch(error => {
                console.error('Error saving settings:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to save settings. Please try again.',
                });
            });
    }
</script>
