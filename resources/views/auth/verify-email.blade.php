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
                                    <h4 class="font-weight-bolder">Verify Email</h4>
                                    <p class="mb-0">Please verify your email address</p>
                                </div>

                                <div class="card-body">

                                    @if (session('status') === 'verification-link-sent')
                                        <div class="alert alert-success">
                                            A new verification link has been sent to your email.
                                        </div>
                                    @endif

                                    <p class="text-muted">
                                        Before continuing, check your email for a verification link.
                                    </p>

                                    <div class="d-flex justify-content-between mt-4">

                                        <form method="POST" action="{{ route('verification.send') }}">
                                            @csrf
                                            <button class="btn btn-primary btn-sm">Resend Email</button>
                                        </form>

                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="btn btn-outline-secondary btn-sm">Logout</button>
                                        </form>

                                    </div>
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
