@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="panel-card p-4 p-lg-5">
                <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">Welcome back</span>
                <h1 class="h2 mb-3">Sign in to manage reports</h1>
                <p class="text-muted mb-4">Access your dashboard to report lost items, review found objects, and update records.</p>

                <form method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email address</label>
                        <input type="email" name="email" id="email" class="form-control form-control-lg" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control-lg" required>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Keep me signed in</label>
                    </div>
                    <button type="submit" class="btn btn-brand btn-lg w-100 mb-3">Login</button>
                </form>

                <div class="d-flex justify-content-between flex-wrap gap-2">
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                    <a href="{{ route('register') }}">Create an account</a>
                </div>
            </div>
        </div>
    </div>
@endsection
