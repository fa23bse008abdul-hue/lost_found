@extends('layouts.app')

@section('content')
    <section class="mb-4">
        <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">New report</span>
        <h1 class="h2 mb-1">Report a lost item</h1>
        <p class="text-muted mb-0">Add complete details so other users can identify the item quickly.</p>
    </section>

    @include('partials.item-form', [
        'action' => route('lost-items.store'),
        'item' => new \App\Models\LostItem(),
        'statusOptions' => $statusOptions,
        'defaultStatus' => 'pending',
        'submitLabel' => 'Submit lost item report',
        'cancelRoute' => route('lost-items.index'),
    ])
@endsection
