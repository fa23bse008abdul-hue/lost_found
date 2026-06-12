@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="panel-card p-4 p-lg-5">
                <h1 class="h2 mb-3">Profile settings</h1>
                <p class="text-muted mb-4">Update your contact identity so other users can verify reports and reach you correctly.</p>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold">Full name</label>
                            <input type="text" id="name" name="name" class="form-control form-control-lg" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold">Email address</label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-semibold">New password</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg">
                            <div class="form-text">Leave blank to keep your current password.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirm new password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-brand btn-lg mt-4">Save changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection
