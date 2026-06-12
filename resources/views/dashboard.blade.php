@extends('layouts.app')

@section('content')
    <section class="hero-card p-4 p-lg-5 mb-4">
        <div class="row g-4 align-items-center">
            <div class="col-lg-8">
                <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">Dashboard</span>
                <h1 class="display-6 fw-bold mb-2">Track reports, recovery progress, and recent activity.</h1>
                <p class="text-muted mb-0">Use the dashboard to jump into new reports, monitor your posted items, and review the latest updates across the platform.</p>
            </div>
            <div class="col-lg-4">
                <div class="d-grid gap-2">
                    <a href="{{ route('lost-items.create') }}" class="btn btn-brand btn-lg">Report lost item</a>
                    <a href="{{ route('found-items.create') }}" class="btn btn-accent btn-lg">Report found item</a>
                </div>
            </div>
        </div>
    </section>

    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="stat-card p-4 h-100">
                <div class="stat-kicker">My lost reports</div>
                <div class="display-6 fw-bold">{{ $myLostItemsCount }}</div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="stat-card p-4 h-100">
                <div class="stat-kicker">My found reports</div>
                <div class="display-6 fw-bold">{{ $myFoundItemsCount }}</div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="stat-card p-4 h-100">
                <div class="stat-kicker">Recovered lost items</div>
                <div class="display-6 fw-bold">{{ $recoveredLostItemsCount }}</div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="stat-card p-4 h-100">
                <div class="stat-kicker">Returned found items</div>
                <div class="display-6 fw-bold">{{ $returnedFoundItemsCount }}</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="panel-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h4 mb-0">Latest lost item reports</h2>
                    <a href="{{ route('lost-items.index') }}" class="btn btn-sm btn-outline-dark">View all</a>
                </div>
                @forelse ($latestLostItems as $item)
                    <div class="border rounded-4 p-3 mb-3">
                        <div class="d-flex justify-content-between gap-2">
                            <div>
                                <div class="fw-semibold">{{ $item->item_name }}</div>
                                <div class="small text-muted">{{ $item->location }} • {{ $item->user->name }}</div>
                            </div>
                            <span class="status-pill status-{{ $item->status }}">{{ ucfirst($item->status) }}</span>
                        </div>
                    </div>
                @empty
                    <div class="empty-state p-4">No lost item activity yet.</div>
                @endforelse
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h4 mb-0">Latest found item reports</h2>
                    <a href="{{ route('found-items.index') }}" class="btn btn-sm btn-outline-dark">View all</a>
                </div>
                @forelse ($latestFoundItems as $item)
                    <div class="border rounded-4 p-3 mb-3">
                        <div class="d-flex justify-content-between gap-2">
                            <div>
                                <div class="fw-semibold">{{ $item->item_name }}</div>
                                <div class="small text-muted">{{ $item->location }} • {{ $item->user->name }}</div>
                            </div>
                            <span class="status-pill status-{{ $item->status }}">{{ ucfirst($item->status) }}</span>
                        </div>
                    </div>
                @empty
                    <div class="empty-state p-4">No found item activity yet.</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
