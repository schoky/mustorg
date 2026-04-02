@extends('layouts.main')

@section('header-title')
Услуги
@endsection

@section('content')
<h1 class="catalog-title">Наши услуги</h1>

<div style="display: flex; flex-direction: column; gap: 40px;">
    <!-- Аренда -->
    <div style="background:white; border-radius:24px; padding:25px;">
        <h2 style="color:#2E7D64; margin-bottom:20px;">🎸 Аренда инструментов</h2>
        <form action="{{ route('rent.submit') }}" method="POST" style="display: flex; flex-wrap: wrap; gap: 15px;">
            @csrf
            <select name="product_id" required style="padding:12px; border-radius:8px; border:1px solid #E2E8F0; min-width:200px;">
                <option value="">Выберите инструмент</option>
                @foreach(\App\Models\Product::whereNotNull('rent_price_per_day')->get() as $item)
                    <option value="{{ $item->id }}">{{ $item->name }} — {{ $item->rent_price_per_day }}₽/день</option>
                @endforeach
            </select>
            <input type="date" name="start_date" required style="padding:12px; border-radius:8px; border:1px solid #E2E8F0;">
            <input type="date" name="end_date" required style="padding:12px; border-radius:8px; border:1px solid #E2E8F0;">
            <button type="submit" style="background:#2E7D64; color:white; border:none; padding:12px 30px; border-radius:50px; cursor:pointer;">Оставить заявку</button>
        </form>
    </div>

    <!-- Ремонт -->
    <div style="background:white; border-radius:24px; padding:25px;">
        <h2 style="color:#2E7D64; margin-bottom:20px;">🔧 Ремонтная мастерская</h2>
        <form action="{{ route('repair.request') }}" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            @csrf
            <input type="text" name="instrument" placeholder="Инструмент" required style="padding:12px; border-radius:8px; border:1px solid #E2E8F0;">
            <textarea name="problem" placeholder="Опишите проблему" required style="padding:12px; border-radius:8px; border:1px solid #E2E8F0; min-height:100px;"></textarea>
            <button type="submit" style="background:#2E7D64; color:white; border:none; padding:12px 30px; border-radius:50px; cursor:pointer; width:200px;">Отправить заявку</button>
        </form>
    </div>

    <!-- Пробные занятия -->
    <div style="background:white; border-radius:24px; padding:25px;">
        <h2 style="color:#2E7D64; margin-bottom:20px;">🎓 Запись на пробное занятие</h2>
        <form action="{{ route('lesson.booking') }}" method="POST" style="display: flex; flex-wrap: wrap; gap: 15px;">
            @csrf
            <input type="text" name="name" placeholder="Ваше имя" required style="padding:12px; border-radius:8px; border:1px solid #E2E8F0;">
            <input type="tel" name="phone" placeholder="Телефон" required style="padding:12px; border-radius:8px; border:1px solid #E2E8F0;">
            <input type="date" name="date" required style="padding:12px; border-radius:8px; border:1px solid #E2E8F0;">
            <button type="submit" style="background:#2E7D64; color:white; border:none; padding:12px 30px; border-radius:50px; cursor:pointer;">Записаться</button>
        </form>
    </div>
</div>
@endsection