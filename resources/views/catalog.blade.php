@extends('layouts.main')

@section('header-title')
Каталог товаров
@endsection

@section('content')
<h1 class="catalog-title">Каталог музыкальных инструментов</h1>

<div class="catalog-filter">
    <form method="GET" action="{{ route('catalog') }}">
        <div class="filter-group">
            <label>Категория</label>
            <select name="category">
                <option value="">Все</option>
                @foreach($categories ?? [] as $cat)
                    <option value="{{ $cat }}" @selected(request('category')==$cat)>{{ ucfirst($cat) }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>Бренд</label>
            <select name="brand">
                <option value="">Все</option>
                @foreach($brands ?? [] as $brand)
                    <option value="{{ $brand }}" @selected(request('brand')==$brand)>{{ $brand }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>Цена от</label>
            <input type="number" name="price_min" placeholder="0" value="{{ request('price_min') }}">
        </div>
        <div class="filter-group">
            <label>Цена до</label>
            <input type="number" name="price_max" placeholder="999999" value="{{ request('price_max') }}">
        </div>
        <button type="submit">Применить</button>
    </form>
</div>

<div class="products-grid">
    @forelse($products ?? [] as $product)
        <div class="product-card">
            <div class="product-image">
                <a href="{{ route('product.show', $product->slug) }}">
                    <img src="{{ $product->image ?? 'https://via.placeholder.com/280x220?text=Instrument' }}" alt="{{ $product->name }}">
                </a>
            </div>
            <div class="product-info">
                <h3><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h3>
                <p>{{ Str::limit($product->description, 80) }}</p>
                <div class="product-price">
                    {{ number_format($product->price, 0, ',', ' ') }} ₽
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
    @csrf
    <button type="submit" class="buy-btn">В корзину</button>
</form>
                </div>
            </div>
        </div>
    @empty
        <p style="text-align:center; grid-column:1/-1;">Товаров не найдено.</p>
    @endforelse
</div>

@if(isset($products) && method_exists($products, 'links'))
    <div class="pagination-container">
        {{ $products->links() }}
    </div>
@endif
@endsection