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
                                    <h4 class="font-weight-bolder">Confirm Password</h4>
                                    <p class="mb-0">Please confirm your password to continue</p>
                                </div>

                                <div class="card-body">

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('password.confirm') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <input type="password" name="password" class="form-control form-control-lg"
                                                placeholder="Password" required>
                                        </div>

                                        <div class="text-center">
                                            <button class="btn btn-lg btn-primary w-100 mt-4">
                                                Confirm Password
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
