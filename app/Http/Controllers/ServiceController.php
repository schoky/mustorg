<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        return view('services');
    }

    public function rent(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $product = Product::findOrFail($request->product_id);
        $days = (new \DateTime($request->start_date))->diff(new \DateTime($request->end_date))->days + 1;
        $total = $days * $product->rent_price_per_day;

        Rental::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $total,
        ]);

        return redirect()->route('profile.index')->with('success', 'Заявка на аренду отправлена');
    }

    public function repairRequest(Request $request)
    {
        $request->validate([
            'instrument' => 'required|string|max:255',
            'problem' => 'required|string',
        ]);

        // Здесь можно сохранить заявку на ремонт (например, в таблицу repair_requests)
        // Пока просто перенаправляем с сообщением
        return redirect()->back()->with('success', 'Заявка на ремонт принята');
    }

    public function lessonBooking(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'date' => 'required|date|after:today',
        ]);

        // Аналогично – сохраняем запись на занятие
        return redirect()->back()->with('success', 'Вы записаны на пробное занятие');
    }
}