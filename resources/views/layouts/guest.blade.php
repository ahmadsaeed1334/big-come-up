<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'the-big-come-up') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if (session('toast'))
        <script>
            window.__toast = @json(session('toast'));
        </script>
    @endif
</head>

<body class="bg-light">

    <div class="min-vh-100 d-flex align-items-center justify-content-center py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-7 col-lg-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

</body>

</html>
