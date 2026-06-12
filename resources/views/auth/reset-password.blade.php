@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="panel-card p-4 p-lg-5">
                <h1 class="h2 mb-3">Choose a new password</h1>
                <p class="text-muted mb-4">Set a new password to regain access to your account.</p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="email" class="form-label fw-semibold">Email address</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg" value="{{ old('email', $email) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-semibold">New password</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirm password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-accent btn-lg w-100 mt-4">Reset password</button>
                </form>
            </div>
        </div>
    </div>
@endsection
