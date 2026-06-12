@extends('layouts.app')

@section('content')
    <section class="mb-4">
        <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">New report</span>
        <h1 class="h2 mb-1">Report a found item</h1>
        <p class="text-muted mb-0">Add clear information so the owner can confirm and recover it safely.</p>
    </section>

    @include('partials.item-form', [
        'action' => route('found-items.store'),
        'item' => new \App\Models\FoundItem(),
        'statusOptions' => $statusOptions,
        'defaultStatus' => 'available',
        'submitLabel' => 'Submit found item report',
        'cancelRoute' => route('found-items.index'),
    ])
@endsection
