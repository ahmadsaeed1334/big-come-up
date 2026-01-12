@extends('layouts.guest')

@section('content')
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">

                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card">

                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Forgot Password</h4>
                                    <p class="mb-0">Enter your email to receive a reset link</p>
                                </div>

                                <div class="card-body">

                                    @if (session('status'))
                                        <div class="alert alert-success">{{ session('status') }}</div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <input type="email" name="email" class="form-control form-control-lg"
                                                placeholder="Email" value="{{ old('email') }}" required autofocus>
                                        </div>

                                        <div class="text-center">
                                            <button class="btn btn-lg btn-primary w-100 mt-4">
                                                Send Reset Link
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        @include('auth.partials.auth-right-image')

                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
