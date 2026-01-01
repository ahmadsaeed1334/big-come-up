<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @isset($title)
            {{ $title }} – {{ config('app.name') }}
        @else
            {{ config('app.name') }}
        @endisset
    </title>



    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/fontawesome.min.css"
        integrity="sha512-M5Kq4YVQrjg5c2wsZSn27Dkfm/2ALfxmun0vUE3mPiJyK53hQBHYCVAtvMYEC7ZXmYLg8DVG4tF8gD27WmDbsg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet">
    <!-- Select2 CSS (ADD HERE IN HEAD) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @if (session('toast'))
        <script>
            window.__toast = @json(session('toast'));
        </script>
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    @stack('styles')

    <style>
        /* =========================
   Select2 Bootstrap5 - Multi select chip styling
   ========================= */

        /* Whole selection area */
        .select2-container--bootstrap5 .select2-selection--multiple {
            min-height: 44px;
            padding: 6px 10px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, .15);
        }

        /* Chips/tags */
        .select2-container--bootstrap5 .select2-selection--multiple .select2-selection__choice {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 4px 10px;
            margin: 4px 6px 0 0;

            border-radius: 999px;
            border: 1px solid rgba(0, 0, 0, .12);
            background: rgba(13, 110, 253, .08);
            /* bootstrap primary tint */
            color: #0b2e59;

            font-size: 13px;
            line-height: 1.2;
        }

        /* Text inside chip (for newer select2) */
        .select2-container--bootstrap5 .select2-selection--multiple .select2-selection__choice__display {
            padding: 0;
            margin: 0;
        }

        /* Remove button (supports both span & button variants) */
        .select2-container--bootstrap5 .select2-selection--multiple .select2-selection__choice__remove,
        .select2-container--bootstrap5 .select2-selection--multiple button.select2-selection__choice__remove {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;

            width: 18px;
            height: 18px;

            border-radius: 999px;
            border: 1px solid rgba(0, 0, 0, .18);
            background: rgba(220, 53, 69, .10);
            /* bootstrap danger tint */
            color: #dc3545 !important;

            font-size: 12px;
            line-height: 1;
            padding: 0;
            margin: 0;

            cursor: pointer;
            transition: transform .12s ease, background-color .12s ease, border-color .12s ease;
        }

        /* Hover / focus */
        .select2-container--bootstrap5 .select2-selection--multiple .select2-selection__choice__remove:hover,
        .select2-container--bootstrap5 .select2-selection--multiple button.select2-selection__choice__remove:hover {
            background: rgba(220, 53, 69, .18);
            border-color: rgba(220, 53, 69, .45);
            transform: scale(1.05);
        }

        .select2-container--bootstrap5 .select2-selection--multiple .select2-selection__choice__remove:focus,
        .select2-container--bootstrap5 .select2-selection--multiple button.select2-selection__choice__remove:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, .20);
        }

        /* Input inside multi select */
        .select2-container--bootstrap5 .select2-selection--multiple .select2-search__field {
            margin-top: 6px;
            font-size: 14px;
        }

        /* When disabled */
        .select2-container--bootstrap5.select2-container--disabled .select2-selection--multiple {
            background: rgba(0, 0, 0, .03);
            cursor: not-allowed;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'the-big-come-up') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item me-2">
                            <span class="navbar-text text-white-50">
                                {{ auth()->user()->name }}
                            </span>
                        </li>

                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-outline-light btn-sm">Logout</button>
                            </form>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="d-flex">
        @include('admin.partials.ckeditor')

        @auth
            @include('admin.partials.sidebar')
        @endauth
        <main class="container py-4">

            @if (session('status'))
                <div class="alert alert-info">
                    {{ session('status') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="{{ asset('assets/js/select2.min.js') }}"></script> --}}
    <!-- jQuery (Select2 requires jQuery) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        function confirmDelete(formId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
    @stack('scripts')

</body>

</html>
