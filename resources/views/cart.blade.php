@extends('layouts.main')

@section('header-title', 'Корзина')

@section('content')
<h1 class="catalog-title">Корзина</h1>

@if(session('success'))
    <div class="success-message">{{ session('success') }}</div>
@endif

@if(!empty($items))
    <div style="background:white; border-radius:24px; padding:25px;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr><th>Товар</th><th>Цена</th><th>Количество</th><th>Сумма</th><th></th></tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr style="border-bottom:1px solid #E2E8F0;">
                    <td style="padding:15px 0;">
                        <img src="{{ $item['product']->image ?? 'https://via.placeholder.com/60' }}" style="width:60px; height:60px; object-fit:cover; border-radius:8px; margin-right:15px;">
                        {{ $item['product']->name }}
                    </td>
                    <td style="padding:15px 0;">{{ number_format($item['product']->price, 0, ',', ' ') }} ₽</td>
                    <td style="padding:15px 0;">
                        <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" style="display:flex; gap:5px;">
                            @csrf @method('PUT')
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width:70px; padding:5px;">
                            <button type="submit" class="buy-btn" style="padding:5px 12px;">Обновить</button>
                        </form>
                    </td>
                    <td style="padding:15px 0;">{{ number_format($item['subtotal'], 0, ',', ' ') }} ₽</td>
                    <td style="padding:15px 0;">
                        <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:#e63946; border:none; padding:5px 12px; border-radius:20px; color:white;">Удалить</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr><td colspan="3" style="text-align:right; font-weight:bold;">Итого:</td><td style="font-weight:bold; font-size:24px; color:#2E7D64;">{{ number_format($total, 0, ',', ' ') }} ₽</td><td></td></tr>
            </tfoot>
        </table>
        <div style="display:flex; justify-content:space-between; margin-top:30px;">
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit" style="background:#6B7A8A; border:none; padding:12px 25px; border-radius:50px; color:white;">Очистить корзину</button>
            </form>
            <a href="{{ route('checkout') }}" class="hero-button" style="text-decoration:none;">Оформить заказ</a>
        </div>
    </div>
@else
    <p style="text-align:center; font-size:20px;">Корзина пуста. Перейдите в <a href="{{ route('catalog') }}">каталог</a>, чтобы выбрать товары.</p>
@endif
@endsection