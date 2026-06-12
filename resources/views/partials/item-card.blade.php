@php
    $imageUrl = $item->image_path ? asset('storage/' . $item->image_path) : null;
    $statusClass = 'status-' . $item->status;
@endphp

<div class="item-card h-100 p-3 p-lg-4">
    @if ($imageUrl)
        <img src="{{ $imageUrl }}" alt="{{ $item->item_name }}" class="item-thumb mb-3">
    @else
        <div class="image-placeholder mb-3">
            <div>
                <div class="fw-semibold">{{ $item->item_name }}</div>
                <div class="small">No image uploaded</div>
            </div>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
        <div>
            <div class="small text-uppercase text-muted fw-semibold">{{ $label }}</div>
            <h5 class="mb-1">{{ $item->item_name }}</h5>
            <div class="text-muted">{{ $item->category ?: 'General item' }}</div>
        </div>
        <span class="status-pill {{ $statusClass }}">{{ ucfirst($item->status) }}</span>
    </div>

    <p class="text-muted mb-3">{{ \Illuminate\Support\Str::limit($item->description, 120) }}</p>

    <div class="small text-muted mb-1">Location: {{ $item->location }}</div>
    <div class="small text-muted mb-3">Reported by {{ $item->user->name }} on {{ $item->created_at->format('M d, Y') }}</div>

    <a href="{{ route($routePrefix . '.show', $item) }}" class="btn btn-outline-dark w-100">View details</a>
</div>
