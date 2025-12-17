@extends('layouts.guest')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h4 class="mb-3">Two-Factor Challenge</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Authentication Code</label>
                    <input type="text" name="code" class="form-control" autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label">Or Recovery Code</label>
                    <input type="text" name="recovery_code" class="form-control">
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
@endsection
