@extends('layouts.main')

@section('header-title', 'Оформление заказа')

@section('content')
<h1 class="catalog-title">Оформление заказа</h1>

<div style="background:white; border-radius:24px; padding:25px;">
    <form method="POST" action="{{ route('place.order') }}">
        @csrf
        <div style="margin-bottom:20px;">
            <label>Адрес доставки</label>
            <textarea name="shipping_address" required rows="3" style="width:100%; padding:12px; border-radius:8px; border:1px solid #E2E8F0;">{{ old('shipping_address', auth()->user()->address ?? '') }}</textarea>
        </div>

        <h3 style="margin:20px 0 10px;">Ваш заказ</h3>
        <table style="width:100%; border-collapse:collapse;">
            <thead><tr><th>Товар</th><th>Кол-во</th><th>Цена</th><th>Сумма</th></tr></thead>
            <tbody>
                @foreach($items as $item)
                <tr style="border-bottom:1px solid #E2E8F0;">
                    <td style="padding:10px 0;">{{ $item['product']->name }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ number_format($item['product']->price, 0, ',', ' ') }} ₽</td>
                    <td>{{ number_format($item['product']->price * $item['quantity'], 0, ',', ' ') }} ₽</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr><td colspan="3" style="text-align:right; font-weight:bold;">Итого:</td><td style="font-weight:bold; font-size:24px;">{{ number_format($total, 0, ',', ' ') }} ₽</td></tr>
            </tfoot>
        </table>

        <div style="margin-top:30px;">
            <button type="submit" class="hero-button">Подтвердить заказ</button>
            <a href="{{ route('cart.index') }}" style="margin-left:15px;">Вернуться в корзину</a>
        </div>
    </form>
</div>
@endsection