<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons (for search/cart/user icons) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Google Font (optional) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
    <link href="https://fonts.cdnfonts.com/css/alegreya" rel="stylesheet">

    <link rel="stylesheet" href="{{ 'assets/css/style.css' }}">
    @stack('styles')
</head>

<body class="space-bg">
    @yield('content')
    @include('user-side.partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Small helper: add active class based on current URL (optional)
        (function() {
            const links = document.querySelectorAll('[data-nav]');
            const path = window.location.pathname.replace(/\/+$/, '');
            links.forEach(a => {
                const href = (a.getAttribute('href') || '').replace(location.origin, '').replace(/\/+$/, '');
                if (href && href !== '#' && href === path) {
                    a.classList.add('active');
                    a.style.background = 'rgba(0,0,0,.06)';
                }
            });
        })();
    </script>

    @stack('scripts')
</body>

</html>
