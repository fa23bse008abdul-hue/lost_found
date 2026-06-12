@extends('layouts.app')

@section('content')
    <section class="mb-4">
        <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">Update report</span>
        <h1 class="h2 mb-1">Edit found item</h1>
        <p class="text-muted mb-0">Update availability and contact details as the claim process moves forward.</p>
    </section>

    @include('partials.item-form', [
        'action' => route('found-items.update', $item),
        'method' => 'PUT',
        'item' => $item,
        'statusOptions' => $statusOptions,
        'defaultStatus' => 'available',
        'submitLabel' => 'Save found item changes',
        'cancelRoute' => route('found-items.show', $item),
    ])
@endsection
