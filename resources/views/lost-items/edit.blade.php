@extends('layouts.app')

@section('content')
    <section class="mb-4">
        <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">Update report</span>
        <h1 class="h2 mb-1">Edit lost item</h1>
        <p class="text-muted mb-0">Keep the report accurate as the recovery process progresses.</p>
    </section>

    @include('partials.item-form', [
        'action' => route('lost-items.update', $item),
        'method' => 'PUT',
        'item' => $item,
        'statusOptions' => $statusOptions,
        'defaultStatus' => 'pending',
        'submitLabel' => 'Save lost item changes',
        'cancelRoute' => route('lost-items.show', $item),
    ])
@endsection
