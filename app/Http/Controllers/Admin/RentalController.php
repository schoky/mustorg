<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with('user', 'product')->latest()->paginate(20);
        return view('admin.rentals.index', compact('rentals'));
    }

    public function updateStatus(Request $request, Rental $rental)
    {
        $request->validate(['status' => 'required|in:pending,approved,active,completed,cancelled']);
        $rental->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Статус аренды обновлён');
    }
}
