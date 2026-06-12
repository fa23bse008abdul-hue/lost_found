@extends('layouts.app')

@section('content')
    <section class="hero-card hero-gradient p-4 p-lg-5 mb-4 overflow-hidden">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="badge rounded-pill text-bg-light text-brand px-3 py-2 mb-3">University-ready item recovery platform</span>
                <h1 class="display-5 fw-bold mb-3">Report lost items, publish found objects, and reconnect them faster.</h1>
                <p class="lead mb-4 text-white-50">This Laravel-based system gives students and staff one organized place to report belongings, search records, and securely contact the right person.</p>
                <div class="d-flex flex-column flex-sm-row gap-2">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg">Open dashboard</a>
                        <a href="{{ route('lost-items.create') }}" class="btn btn-outline-light btn-lg">Report a lost item</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg">Get started</a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">I already have an account</a>
                    @endauth
                </div>
            </div>
            <div class="col-lg-5">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="stat-card p-3 p-lg-4 h-100 text-dark">
                            <div class="stat-kicker">Lost reports</div>
                            <div class="display-6 fw-bold">{{ $lostCount }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-card p-3 p-lg-4 h-100 text-dark">
                            <div class="stat-kicker">Found reports</div>
                            <div class="display-6 fw-bold">{{ $foundCount }}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="stat-card p-3 p-lg-4 text-dark">
                            <div class="stat-kicker mb-2">How it works</div>
                            <div class="fw-semibold">1. Register</div>
                            <div class="fw-semibold">2. Report an item</div>
                            <div class="fw-semibold">3. Search and connect</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="panel-card p-4 h-100">
                <h2 class="h3 mb-3">Recent lost item reports</h2>
                @forelse ($recentLostItems as $item)
                    <div class="border rounded-4 p-3 mb-3">
                        <div class="d-flex justify-content-between gap-2 align-items-start">
                            <div>
                                <div class="fw-semibold">{{ $item->item_name }}</div>
                                <div class="text-muted small">{{ $item->location }} • {{ $item->user->name }}</div>
                            </div>
                            <span class="status-pill status-{{ $item->status }}">{{ ucfirst($item->status) }}</span>
                        </div>
                    </div>
                @empty
                    <div class="empty-state p-4">No lost item reports yet.</div>
                @endforelse
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel-card p-4 h-100">
                <h2 class="h3 mb-3">Recent found item reports</h2>
                @forelse ($recentFoundItems as $item)
                    <div class="border rounded-4 p-3 mb-3">
                        <div class="d-flex justify-content-between gap-2 align-items-start">
                            <div>
                                <div class="fw-semibold">{{ $item->item_name }}</div>
                                <div class="text-muted small">{{ $item->location }} • {{ $item->user->name }}</div>
                            </div>
                            <span class="status-pill status-{{ $item->status }}">{{ ucfirst($item->status) }}</span>
                        </div>
                    </div>
                @empty
                    <div class="empty-state p-4">No found item reports yet.</div>
                @endforelse
            </div>
        </div>
    </div>

    <section class="panel-card p-4 p-lg-5">
        <div class="row g-4">
            <div class="col-md-4">
                <h3 class="h4">Secure authentication</h3>
                <p class="text-muted mb-0">Users can register, sign in, reset passwords, and maintain their own profile information.</p>
            </div>
            <div class="col-md-4">
                <h3 class="h4">Smart record search</h3>
                <p class="text-muted mb-0">Search by item name, category, location, or status to reduce time spent checking physical logs.</p>
            </div>
            <div class="col-md-4">
                <h3 class="h4">Clear ownership trail</h3>
                <p class="text-muted mb-0">Every report is linked to a user account, making it easier to verify and coordinate recovery.</p>
            </div>
        </div>
    </section>
@endsection
