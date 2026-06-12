<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use App\Models\LostItem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function welcome()
    {
        return view('welcome', [
            'lostCount' => LostItem::count(),
            'foundCount' => FoundItem::count(),
            'recentLostItems' => LostItem::with('user')->latest()->take(3)->get(),
            'recentFoundItems' => FoundItem::with('user')->latest()->take(3)->get(),
        ]);
    }

    public function index(Request $request)
    {
        $user = $request->user();

        return view('dashboard', [
            'myLostItemsCount' => $user->lostItems()->count(),
            'myFoundItemsCount' => $user->foundItems()->count(),
            'recoveredLostItemsCount' => $user->lostItems()->where('status', 'recovered')->count(),
            'returnedFoundItemsCount' => $user->foundItems()->where('status', 'returned')->count(),
            'latestLostItems' => LostItem::with('user')->latest()->take(5)->get(),
            'latestFoundItems' => FoundItem::with('user')->latest()->take(5)->get(),
        ]);
    }
}
