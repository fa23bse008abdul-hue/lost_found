@extends('layouts.app')

@section('content')
    <section class="panel-card p-4 p-lg-5 mb-4">
        <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-4">
            <div>
                <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">Lost item reports</span>
                <h1 class="h2 mb-1">Search and manage missing belongings</h1>
                <p class="text-muted mb-0">Filter the latest lost item records by keyword, ownership, and recovery status.</p>
            </div>
            <div class="align-self-lg-center">
                <a href="{{ route('lost-items.create') }}" class="btn btn-brand btn-lg">New lost item report</a>
            </div>
        </div>

        <form method="GET" action="{{ route('lost-items.index') }}" class="row g-3">
            <div class="col-lg-5">
                <input type="text" name="search" class="form-control form-control-lg" value="{{ request('search') }}" placeholder="Search by item name, category, description, or location">
            </div>
            <div class="col-lg-3">
                <select name="status" class="form-select form-select-lg">
                    <option value="">All statuses</option>
                    @foreach ($statusOptions as $value => $label)
                        <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2 d-flex align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="mine" name="mine" @checked(request()->boolean('mine'))>
                    <label class="form-check-label" for="mine">Only my reports</label>
                </div>
            </div>
            <div class="col-lg-2 d-grid">
                <button type="submit" class="btn btn-outline-dark btn-lg">Filter</button>
            </div>
        </form>
    </section>

    <div class="row g-4">
        @forelse ($items as $item)
            <div class="col-md-6 col-xl-4">
                @include('partials.item-card', ['item' => $item, 'routePrefix' => 'lost-items', 'label' => 'Lost item'])
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state p-5">No lost item reports matched your search.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $items->links() }}
    </div>
@endsection
