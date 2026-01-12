<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }} - Auth</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">


    @include('admin.partials.style')


</head>

<body class="bg-gray-100">

    {{-- Page Content --}}
    @yield('content')

    @include('admin.partials.script')
</body>

</html>
