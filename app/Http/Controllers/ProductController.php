<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function catalog(Request $request)
    {
        $query = Product::query();

        // Фильтрация
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        $products = $query->paginate(12);
        $brands = Product::distinct()->pluck('brand');
        $categories = Product::distinct()->pluck('category');

        return view('catalog', compact('products', 'brands', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('product', compact('product'));
    }
}