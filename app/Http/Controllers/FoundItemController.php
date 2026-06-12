<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class FoundItemController extends Controller
{
    public function index(Request $request)
    {
        $items = FoundItem::query()
            ->with('user')
            ->when(
                $request->filled('search'),
                function ($query) use ($request) {
                    $search = $request->string('search')->trim()->toString();

                    $query->where(function ($itemQuery) use ($search) {
                        $itemQuery
                            ->where('item_name', 'like', "%{$search}%")
                            ->orWhere('category', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%")
                            ->orWhere('location', 'like', "%{$search}%");
                    });
                }
            )
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->when($request->boolean('mine'), fn ($query) => $query->where('user_id', $request->user()->id))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('found-items.index', [
            'items' => $items,
            'statusOptions' => FoundItem::statusOptions(),
        ]);
    }

    public function create()
    {
        return view('found-items.create', [
            'statusOptions' => FoundItem::statusOptions(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['user_id'] = $request->user()->id;
        $data['image_path'] = $request->hasFile('image')
            ? $request->file('image')->store('item-images', 'public')
            : null;

        $item = FoundItem::create($data);

        return redirect()
            ->route('found-items.show', $item)
            ->with('status', 'Found item reported successfully.');
    }

    public function show(FoundItem $foundItem)
    {
        $foundItem->load('user');

        return view('found-items.show', [
            'item' => $foundItem,
        ]);
    }

    public function edit(FoundItem $foundItem)
    {
        $this->authorizeOwner($foundItem, request()->user()->id);

        return view('found-items.edit', [
            'item' => $foundItem,
            'statusOptions' => FoundItem::statusOptions(),
        ]);
    }

    public function update(Request $request, FoundItem $foundItem)
    {
        $this->authorizeOwner($foundItem, $request->user()->id);

        $data = $this->validatedData($request);

        if ($request->hasFile('image')) {
            if ($foundItem->image_path) {
                Storage::disk('public')->delete($foundItem->image_path);
            }

            $data['image_path'] = $request->file('image')->store('item-images', 'public');
        }

        $foundItem->update($data);

        return redirect()
            ->route('found-items.show', $foundItem)
            ->with('status', 'Found item updated successfully.');
    }

    public function destroy(FoundItem $foundItem)
    {
        $this->authorizeOwner($foundItem, request()->user()->id);

        if ($foundItem->image_path) {
            Storage::disk('public')->delete($foundItem->image_path);
        }

        $foundItem->delete();

        return redirect()
            ->route('found-items.index')
            ->with('status', 'Found item removed successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'contact_details' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(array_keys(FoundItem::statusOptions()))],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);
    }

    private function authorizeOwner(FoundItem $item, int $userId): void
    {
        abort_unless($item->user_id === $userId, 403);
    }
}
