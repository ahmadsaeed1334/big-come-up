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

</head>

<body class="g-sidenav-show   bg-gray-100">
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

</body>

</html>
