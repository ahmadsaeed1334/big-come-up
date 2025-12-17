<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'The Big Come Up') }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }

        .hero-section {
            padding: 100px 0;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: #6c757d;
        }

        .btn-main {
            padding: 10px 25px;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                {{ config('app.name', 'The Big Come Up') }}
            </a>

            <div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-dark ms-2">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-dark me-2">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-dark">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="hero-title">Welcome to {{ config('app.name') }}</h1>
            <p class="hero-subtitle mt-3">
                A complete platform powered by Laravel — secure, fast, and modern.
            </p>

            <div class="mt-4">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-dark btn-main me-2">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-dark btn-main">Register</a>
                    @endif
                @else
                    <a href="{{ url('/dashboard') }}" class="btn btn-dark btn-main">Go to Dashboard</a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
