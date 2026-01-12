@extends('layouts.guest')

@section('content')
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">

                        {{-- ================= LEFT: REGISTER FORM ================= --}}
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card ">

                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Sign Up</h4>
                                    <p class="mb-0">Create a new account</p>
                                </div>

                                <div class="card-body">

                                    {{-- Validation Errors --}}
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        {{-- Name --}}
                                        <div class="mb-3">
                                            <input type="text" name="name"
                                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                                placeholder="Full Name" value="{{ old('name') }}" required autofocus>
                                        </div>

                                        {{-- Email --}}
                                        <div class="mb-3">
                                            <input type="email" name="email"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                placeholder="Email" value="{{ old('email') }}" required>
                                        </div>

                                        {{-- Password --}}
                                        <div class="mb-3">
                                            <input type="password" name="password"
                                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                placeholder="Password" required>
                                        </div>

                                        {{-- Confirm Password --}}
                                        <div class="mb-3">
                                            <input type="password" name="password_confirmation"
                                                class="form-control form-control-lg" placeholder="Confirm Password"
                                                required>
                                        </div>

                                        {{-- Submit --}}
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary w-100 mt-4 mb-0">
                                                Create Account
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Already have an account?
                                        <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">
                                            Sign in
                                        </a>
                                    </p>
                                </div>

                            </div>
                        </div>

                        {{-- ================= RIGHT: IMAGE / QUOTE ================= --}}
                        @include('auth.partials.auth-right-image')

                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
