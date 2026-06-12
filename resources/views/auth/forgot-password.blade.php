@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="panel-card p-4 p-lg-5">
                <h1 class="h2 mb-3">Reset your password</h1>
                <p class="text-muted mb-4">Enter the email linked to your account and the system will send a password reset link.</p>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">Email address</label>
                        <input type="email" name="email" id="email" class="form-control form-control-lg" value="{{ old('email') }}" required>
                    </div>
                    <button type="submit" class="btn btn-brand btn-lg w-100">Email reset link</button>
                </form>
            </div>
        </div>
    </div>
@endsection
