@extends('layouts.guest')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h4 class="mb-3">Verify Your Email</h4>

            <p class="text-muted small">
                Before continuing, please verify your email address by clicking the link we just sent.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success">
                    A new verification link has been sent to your email.
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button class="btn btn-primary btn-sm">Resend Verification Email</button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-secondary btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </div>
@endsection
