@extends('layouts.main')

@section('header-title', $product->name ?? 'Товар')

@section('content')
<div style="display: flex; gap: 40px; background:white; border-radius:24px; padding:30px;">
    <div style="flex:1;">
        <img src="{{ $product->image ?? 'https://via.placeholder.com/500' }}" alt="{{ $product->name }}" style="width:100%; border-radius:16px;">
    </div>
    <div style="flex:1;">
        <h1 style="margin-bottom:15px;">{{ $product->name }}</h1>
        <p style="color:#6B7A8A; margin-bottom:15px;">Бренд: {{ $product->brand ?? '—' }}</p>
        <p style="font-size:32px; font-weight:700; color:#2E7D64; margin-bottom:15px;">{{ number_format($product->price, 0, ',', ' ') }} ₽</p>
        @if($product->rent_price_per_day)
            <p style="margin-bottom:20px;">Аренда: <strong>{{ number_format($product->rent_price_per_day, 0, ',', ' ') }} ₽/день</strong></p>
        @endif
        <p style="line-height:1.6; margin-bottom:25px;">{{ $product->description }}</p>
        
        <div style="display: flex; gap: 15px;">
            <!-- Кнопка добавления в корзину (через форму) -->
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="buy-btn" style="background:#2E7D64; color:white; border:none; padding:12px 30px; cursor:pointer;">Купить</button>
            </form>
            @auth
                <form action="{{ route('profile.addFavorite', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" style="background:#F39C12; border:none; padding:12px 30px; border-radius:50px; cursor:pointer; color:white;">В избранное</button>
                </form>
            @endauth
        </div>
    </div>
</div>
@endsection