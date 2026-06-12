<?php

namespace App\Http\Controllers;

use App\Models\LostItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class LostItemController extends Controller
{
    public function index(Request $request)
    {
        $items = LostItem::query()
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

        return view('lost-items.index', [
            'items' => $items,
            'statusOptions' => LostItem::statusOptions(),
        ]);
    }

    public function create()
    {
        return view('lost-items.create', [
            'statusOptions' => LostItem::statusOptions(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['user_id'] = $request->user()->id;
        $data['image_path'] = $request->hasFile('image')
            ? $request->file('image')->store('item-images', 'public')
            : null;

        $item = LostItem::create($data);

        return redirect()
            ->route('lost-items.show', $item)
            ->with('status', 'Lost item reported successfully.');
    }

    public function show(LostItem $lostItem)
    {
        $lostItem->load('user');

        return view('lost-items.show', [
            'item' => $lostItem,
        ]);
    }

    public function edit(LostItem $lostItem)
    {
        $this->authorizeOwner($lostItem, request()->user()->id);

        return view('lost-items.edit', [
            'item' => $lostItem,
            'statusOptions' => LostItem::statusOptions(),
        ]);
    }

    public function update(Request $request, LostItem $lostItem)
    {
        $this->authorizeOwner($lostItem, $request->user()->id);

        $data = $this->validatedData($request);

        if ($request->hasFile('image')) {
            if ($lostItem->image_path) {
                Storage::disk('public')->delete($lostItem->image_path);
            }

            $data['image_path'] = $request->file('image')->store('item-images', 'public');
        }

        $lostItem->update($data);

        return redirect()
            ->route('lost-items.show', $lostItem)
            ->with('status', 'Lost item updated successfully.');
    }

    public function destroy(LostItem $lostItem)
    {
        $this->authorizeOwner($lostItem, request()->user()->id);

        if ($lostItem->image_path) {
            Storage::disk('public')->delete($lostItem->image_path);
        }

        $lostItem->delete();

        return redirect()
            ->route('lost-items.index')
            ->with('status', 'Lost item removed successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'contact_details' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(array_keys(LostItem::statusOptions()))],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);
    }

    private function authorizeOwner(LostItem $item, int $userId): void
    {
        abort_unless($item->user_id === $userId, 403);
    }
}
