@extends('layouts.guest')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h4 class="mb-3">Register</h4>

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

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required
                        autocomplete="name">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required
                        autocomplete="username">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required autocomplete="new-password">
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required
                        autocomplete="new-password">
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a class="small" href="{{ route('login') }}">Already registered?</a>
                    <button class="btn btn-success">Create account</button>
                </div>
            </form>
        </div>
    </div>
@endsection
