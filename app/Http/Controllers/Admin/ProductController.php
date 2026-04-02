<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'rent_price_per_day' => 'nullable|numeric|min:0',
            'brand' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'level' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048',
            'in_stock' => 'boolean',
        ]);

        $data = $validated;
        $data['slug'] = Str::slug($data['name'] . '-' . uniqid());

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = '/storage/' . $path;
        }

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Товар добавлен');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'rent_price_per_day' => 'nullable|numeric|min:0',
            'brand' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'level' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048',
            'in_stock' => 'boolean',
        ]);

        $data = $validated;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = '/storage/' . $path;
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Товар обновлён');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Товар удалён');
    }
}
