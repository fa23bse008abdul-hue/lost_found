@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="panel-card p-4 p-lg-5">
                <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">New account</span>
                <h1 class="h2 mb-3">Create your Lost &amp; Found profile</h1>
                <p class="text-muted mb-4">Register with your campus details so reports can be traced securely to the right person.</p>

                <form method="POST" action="{{ route('register.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="name" class="form-label fw-semibold">Full name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label fw-semibold">Email address</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg" value="{{ old('email') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirm password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-accent btn-lg w-100 mt-4">Create account</button>
                </form>

                <p class="text-muted mt-3 mb-0">Already registered? <a href="{{ route('login') }}">Sign in here</a>.</p>
            </div>
        </div>
    </div>
@endsection
