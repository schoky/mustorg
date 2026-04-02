<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders()->with('items.product')->get();
        $rentals = $user->rentals()->with('product')->get();
        $favorites = $user->favorites()->get();
        return view('profile', compact('user', 'orders', 'rentals', 'favorites'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);
        $user->update($validated);
        return redirect()->back()->with('success', 'Данные обновлены');
    }

    public function addToFavorites($productId)
    {
        $user = Auth::user();
        if (!$user->favorites()->where('product_id', $productId)->exists()) {
            $user->favorites()->attach($productId);
        }
        return redirect()->back()->with('success', 'Товар добавлен в избранное');
    }

    public function removeFromFavorites($productId)
    {
        Auth::user()->favorites()->detach($productId);
        return redirect()->back()->with('success', 'Товар удалён из избранного');
    }
}