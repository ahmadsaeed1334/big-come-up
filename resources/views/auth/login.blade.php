@extends('layouts.guest')

@section('content')
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">

                        {{-- ================= LEFT: LOGIN FORM ================= --}}
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card">

                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Sign In</h4>
                                    <p class="mb-0">Enter your email and password to sign in</p>
                                </div>

                                <div class="card-body">

                                    {{-- Session expired --}}
                                    @if (session('session_expired'))
                                        <div class="alert alert-warning">
                                            {{ session('session_expired') }}
                                        </div>
                                    @endif

                                    {{-- Validation errors --}}
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    {{-- Status --}}
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        {{-- Email --}}
                                        <div class="mb-3">
                                            <input type="email" name="email"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                placeholder="Email" value="{{ old('email') }}" required autofocus>
                                        </div>

                                        {{-- Password --}}
                                        <div class="mb-3">
                                            <input type="password" name="password"
                                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                placeholder="Password" required>
                                        </div>

                                        {{-- Remember --}}
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                                            <label class="form-check-label" for="rememberMe">
                                                Remember me
                                            </label>
                                        </div>

                                        {{-- Submit --}}
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary w-100 mt-4 mb-0">
                                                Sign in
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-2 text-sm mx-auto">
                                        <a href="{{ route('password.request') }}"
                                            class="text-primary text-gradient font-weight-bold">
                                            Forgot your password?
                                        </a>
                                    </p>

                                    <p class="mb-0 text-sm mx-auto">
                                        Don't have an account?
                                        <a href="{{ route('register') }}"
                                            class="text-primary text-gradient font-weight-bold">
                                            Sign up
                                        </a>
                                    </p>
                                </div>

                            </div>
                        </div>

                        {{-- ================= RIGHT: IMAGE / QUOTE ================= --}}
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
                                   background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">
                                    "Attention is the new currency"
                                </h4>
                                <p class="text-white position-relative">
                                    The more effortless the writing looks, the more effort the writer actually put into the
                                    process.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
