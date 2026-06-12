@php
    $imageUrl = $item->image_path ? asset('storage/' . $item->image_path) : null;
@endphp

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="panel-card p-4 p-lg-5">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    <div class="row g-4">
        <div class="col-md-6">
            <label for="item_name" class="form-label fw-semibold">Item name</label>
            <input type="text" id="item_name" name="item_name" class="form-control form-control-lg" value="{{ old('item_name', $item->item_name) }}" required>
        </div>
        <div class="col-md-6">
            <label for="category" class="form-label fw-semibold">Category</label>
            <input type="text" id="category" name="category" class="form-control form-control-lg" value="{{ old('category', $item->category) }}" placeholder="Phone, wallet, ID card">
        </div>
        <div class="col-md-6">
            <label for="location" class="form-label fw-semibold">Location</label>
            <input type="text" id="location" name="location" class="form-control form-control-lg" value="{{ old('location', $item->location) }}" required>
        </div>
        <div class="col-md-6">
            <label for="status" class="form-label fw-semibold">Status</label>
            <select id="status" name="status" class="form-select form-select-lg" required>
                @foreach ($statusOptions as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $item->status ?: $defaultStatus) === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <label for="description" class="form-label fw-semibold">Description</label>
            <textarea id="description" name="description" rows="5" class="form-control" required>{{ old('description', $item->description) }}</textarea>
        </div>
        <div class="col-md-6">
            <label for="contact_details" class="form-label fw-semibold">Contact details</label>
            <input type="text" id="contact_details" name="contact_details" class="form-control form-control-lg" value="{{ old('contact_details', $item->contact_details) }}" placeholder="Phone number or alternate contact">
        </div>
        <div class="col-md-6">
            <label for="image" class="form-label fw-semibold">Item image</label>
            <input type="file" id="image" name="image" class="form-control form-control-lg" accept="image/*">
            <div class="form-text">Optional. Upload JPG, PNG, WEBP, or GIF up to 2MB.</div>
        </div>
        @if ($imageUrl)
            <div class="col-12">
                <div class="small text-muted mb-2">Current image</div>
                <img src="{{ $imageUrl }}" alt="{{ $item->item_name }}" class="item-thumb" style="max-width: 320px;">
            </div>
        @endif
    </div>

    <div class="d-flex flex-column flex-md-row gap-2 mt-4">
        <button type="submit" class="btn btn-brand btn-lg">{{ $submitLabel }}</button>
        <a href="{{ $cancelRoute }}" class="btn btn-outline-secondary btn-lg">Cancel</a>
    </div>
</form>
