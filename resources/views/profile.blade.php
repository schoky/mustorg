@extends('layouts.main')

@section('header-title')
Личный кабинет
@endsection

@section('content')
<h1 class="catalog-title">Личный кабинет</h1>

<div style="display: flex; flex-direction: column; gap: 30px;">
    <!-- Мои заказы -->
    <div style="background:white; border-radius:24px; padding:25px;">
        <h2 style="color:#2E7D64; margin-bottom:20px;">📦 Мои заказы</h2>
        @forelse($orders ?? [] as $order)
            <div style="border-bottom:1px solid #E2E8F0; padding:15px 0;">
                Заказ #{{ $order->id }} — статус: <strong>{{ $order->status }}</strong>, сумма: {{ number_format($order->total, 0, ',', ' ') }} ₽
            </div>
        @empty
            <p>У вас пока нет заказов.</p>
        @endforelse
    </div>

    <!-- Аренда -->
    <div style="background:white; border-radius:24px; padding:25px;">
        <h2 style="color:#2E7D64; margin-bottom:20px;">🎸 Мои аренды</h2>
        @forelse($rentals ?? [] as $rental)
            <div style="border-bottom:1px solid #E2E8F0; padding:15px 0;">
                {{ $rental->product->name }}: {{ $rental->start_date }} — {{ $rental->end_date }}, статус: {{ $rental->status }}
            </div>
        @empty
            <p>У вас нет активных аренд.</p>
        @endforelse
    </div>

    <!-- Избранное -->
    <div style="background:white; border-radius:24px; padding:25px;">
        <h2 style="color:#2E7D64; margin-bottom:20px;">❤️ Избранные товары</h2>
        <div style="display: flex; flex-wrap: wrap; gap: 20px;">
            @forelse($favorites ?? [] as $fav)
                <div style="border:1px solid #E2E8F0; border-radius:16px; padding:10px; width:200px;">
                    <img src="{{ $fav->image ?? 'https://via.placeholder.com/180' }}" style="width:100%; height:120px; object-fit:cover; border-radius:8px;">
                    <p style="margin:10px 0;"><strong>{{ $fav->name }}</strong></p>
                    <form method="POST" action="{{ route('profile.removeFavorite', $fav->id) }}">
                        @csrf @method('DELETE')
                        <button style="background:#e63946; color:white; border:none; padding:5px 12px; border-radius:20px; cursor:pointer;">Удалить</button>
                    </form>
                </div>
            @empty
                <p>Нет избранных товаров.</p>
            @endforelse
        </div>
    </div>

    <!-- Редактирование данных -->
    <div style="background:white; border-radius:24px; padding:25px;">
        <h2 style="color:#2E7D64; margin-bottom:20px;">✏️ Редактировать профиль</h2>
        <form method="POST" action="{{ route('profile.update') }}" style="display: flex; flex-direction: column; gap: 15px;">
            @csrf @method('PUT')
            <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" placeholder="Имя" required style="padding:12px; border-radius:8px; border:1px solid #E2E8F0;">
            <input type="text" name="address" value="{{ old('address', $user->address ?? '') }}" placeholder="Адрес доставки" style="padding:12px; border-radius:8px; border:1px solid #E2E8F0;">
            <button type="submit" style="background:#2E7D64; color:white; border:none; padding:12px; border-radius:50px; cursor:pointer;">Сохранить изменения</button>
        </form>
    </div>
</div>
@endsection