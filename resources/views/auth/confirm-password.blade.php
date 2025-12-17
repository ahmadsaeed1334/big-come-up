@extends('layouts.guest')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h4 class="mb-3">Confirm Password</h4>
            <p class="text-muted small">
                Please confirm your password before continuing.
            </p>

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
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required autocomplete="current-password">
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
@endsection
