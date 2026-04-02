<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }

        $items = [];
        $total = 0;
        foreach ($cart as $id => $quantity) {
            $product = Product::find($id);
            if ($product) {
                $subtotal = $product->price * $quantity;
                $total += $subtotal;
                $items[] = ['product' => $product, 'quantity' => $quantity];
            }
        }
        return view('checkout', compact('items', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }

        $userId = Auth::id();

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => $userId,
                'total' => 0,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
            ]);

            $total = 0;
            foreach ($cart as $id => $quantity) {
                $product = Product::find($id);
                if ($product) {
                    $price = $product->price;
                    $subtotal = $price * $quantity;
                    $total += $subtotal;
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $price,
                    ]);
                }
            }
            $order->update(['total' => $total]);

            session()->forget('cart');

            DB::commit();
            return redirect()->route('profile.index')->with('success', 'Заказ успешно оформлен!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Ошибка при оформлении заказа: ' . $e->getMessage());
        }
    }
}