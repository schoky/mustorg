<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\ContactMessage;
use App\Models\Rental;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'orders' => Order::count(),
            'users' => User::count(),
            'messages' => ContactMessage::where('is_read', false)->count(),
            'rentals' => Rental::count(),
            'total_income' => Order::sum('total'),
        ];
        $recentOrders = Order::latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
