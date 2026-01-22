<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @isset($title)
            {{ $title }} – {{ config('app.name') }}
        @else
            {{ config('app.name') }}
        @endisset
    </title>
    @include('admin.partials.style')
</head>

<body class="g-sidenav-show {{ $themeSettings['dark_mode'] ? 'dark-version' : '' }} bg-gray-100">
    <div class="min-height-300 bg-dark position-absolute w-100"></div>
    @auth
        @include('admin.partials.sidebar')
    @endauth

    <main class="main-content position-relative border-radius-lg ">
        @include('admin.partials.navbar')
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @yield('content')
            @include('admin.partials.footer')
        </div>
        @include('admin.partials.setting')
    </main>

    @include('admin.partials.script')

    <!-- Theme Settings Script -->
    <script>
        // Load theme settings on page load
        document.addEventListener('DOMContentLoaded', function() {
            applyThemeSettings();
        });

        function applyThemeSettings() {
            // Get theme settings from server
            fetch('/admin/theme/settings')
                .then(response => response.json())
                .then(data => {
                    const theme = data.theme;

                    // Apply sidebar color
                    if (theme.sidebar_color) {
                        applySidebarColor(theme.sidebar_color);
                    }

                    // Apply sidenav type
                    if (theme.sidenav_type) {
                        applySidenavType(theme.sidenav_type);
                    }

                    // Apply dark mode
                    if (theme.dark_mode) {
                        applyDarkMode(true);
                    }
                })
                .catch(error => {
                    console.error('Error loading theme settings:', error);
                });
        }

        function applySidebarColor(color) {
            // Remove existing color classes
            document.querySelectorAll('.badge-colors .badge.filter').forEach(badge => {
                badge.classList.remove('active');
            });

            // Add active class to selected color
            const selectedBadge = document.querySelector(`.badge.filter[data-color="${color}"]`);
            if (selectedBadge) {
                selectedBadge.classList.add('active');
            }

            // Apply to sidebar
            const sidenav = document.querySelector('.sidenav');
            if (sidenav) {
                sidenav.setAttribute('data-color', color);
            }
        }

        function applySidenavType(type) {
            const sidenav = document.querySelector('.sidenav');
            if (sidenav) {
                // Remove existing type classes
                sidenav.classList.remove('bg-white', 'bg-default');
                // Add new type class
                sidenav.classList.add(type);
            }

            // Update buttons
            document.querySelectorAll('.btn[data-class]').forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('data-class') === type) {
                    btn.classList.add('active');
                }
            });
        }

        function applyDarkMode(enabled) {
            const body = document.body;
            const checkbox = document.getElementById('dark-version');

            if (enabled) {
                body.classList.add('dark-version');
                if (checkbox) checkbox.checked = true;
            } else {
                body.classList.remove('dark-version');
                if (checkbox) checkbox.checked = false;
            }
        }

        // Update sidebar color function
        function sidebarColor(element) {
            const color = element.getAttribute('data-color');

            // Send to server
            fetch('/admin/theme/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        sidebar_color: color
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        applySidebarColor(color);
                    }
                });
        }

        // Update sidebar type function
        function sidebarType(element) {
            const type = element.getAttribute('data-class');

            // Send to server
            fetch('/admin/theme/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        sidenav_type: type
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        applySidenavType(type);
                    }
                });
        }

        // Update dark mode function
        function darkMode(element) {
            const enabled = element.checked;

            // Send to server
            fetch('/admin/theme/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        dark_mode: enabled
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        applyDarkMode(enabled);
                    }
                });
        }
    </script>
</body>

</html>
