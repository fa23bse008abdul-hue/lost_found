@extends('layouts.app')

@section('content')
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="panel-card p-4 p-lg-5 h-100">
                <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
                    <div>
                        <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">Lost item details</span>
                        <h1 class="h2 mb-1">{{ $item->item_name }}</h1>
                        <div class="text-muted">{{ $item->category ?: 'General item' }}</div>
                    </div>
                    <span class="status-pill status-{{ $item->status }}">{{ ucfirst($item->status) }}</span>
                </div>

                @if ($item->image_path)
                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->item_name }}" class="item-thumb mb-4">
                @else
                    <div class="image-placeholder mb-4">
                        <div>
                            <div class="fw-semibold">{{ $item->item_name }}</div>
                            <div class="small">No image uploaded for this report</div>
                        </div>
                    </div>
                @endif

                <h2 class="h5">Description</h2>
                <p class="text-muted">{{ $item->description }}</p>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <div class="small text-uppercase text-muted fw-semibold">Last seen location</div>
                        <div class="fw-semibold">{{ $item->location }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="small text-uppercase text-muted fw-semibold">Reported on</div>
                        <div class="fw-semibold">{{ $item->created_at->format('M d, Y h:i A') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="panel-card p-4 p-lg-5 mb-4">
                <h2 class="h4 mb-3">Contact and ownership</h2>
                <div class="mb-3">
                    <div class="small text-uppercase text-muted fw-semibold">Reported by</div>
                    <div class="fw-semibold">{{ $item->user->name }}</div>
                </div>
                <div class="mb-3">
                    <div class="small text-uppercase text-muted fw-semibold">Email</div>
                    <div>{{ $item->user->email }}</div>
                </div>
                <div class="mb-0">
                    <div class="small text-uppercase text-muted fw-semibold">Additional contact details</div>
                    <div>{{ $item->contact_details ?: 'No alternate contact provided.' }}</div>
                </div>
            </div>

            <div class="panel-card p-4 p-lg-5">
                <div class="d-grid gap-2">
                    <a href="{{ route('lost-items.index') }}" class="btn btn-outline-dark">Back to reports</a>
                    @if (auth()->id() === $item->user_id)
                        <a href="{{ route('lost-items.edit', $item) }}" class="btn btn-brand">Edit report</a>
                        <form method="POST" action="{{ route('lost-items.destroy', $item) }}" onsubmit="return confirm('Delete this report?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100">Delete report</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
