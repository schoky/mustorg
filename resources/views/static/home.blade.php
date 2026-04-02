@extends('layouts.main')

@section('header-title')
Главная страница
@endsection

@section('content')
<div class="hero">
    <div class="hero-overlay">
        <h1>Добро пожаловать в MusTorg</h1>
        <p>Покупайте качественный товар только у нас</p>
        <a href="{{ route('catalog') }}" class='hero-button'>В каталог</a>
    </div>
</div>

<!-- Баннеры акций -->
<div class="promo-banners" style="display: flex; gap: 20px; margin-bottom: 40px;">
    <div class="banner" style="flex:1; background: #2E7D64; color:white; padding:20px; border-radius:16px; text-align:center;">🎸 Скидка 20% на первую аренду!</div>
    <div class="banner" style="flex:1; background: #F39C12; color:white; padding:20px; border-radius:16px; text-align:center;">🎹 Рассрочка 0% на гитары Fender</div>
</div>

<!-- Услуги на главной -->
<div class="services-preview" style="margin-bottom: 40px;">
    <h2 style="text-align:center; margin-bottom:25px;">Наши услуги</h2>
    <div style="display: flex; gap: 25px; justify-content: center;">
        <div style="background:white; padding:20px; border-radius:16px; text-align:center; width:200px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">🎸 Аренда инструментов</div>
        <div style="background:white; padding:20px; border-radius:16px; text-align:center; width:200px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">🔧 Ремонт и настройка</div>
        <div style="background:white; padding:20px; border-radius:16px; text-align:center; width:200px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">🎓 Пробные занятия</div>
    </div>
</div>

<!-- Отзывы клиентов -->
<div class="reviews" style="margin-bottom: 40px;">
    <h2 style="text-align:center; margin-bottom:25px;">Отзывы наших клиентов</h2>
    <div style="display: flex; gap: 25px;">
        <div style="background:white; padding:20px; border-radius:16px; flex:1; box-shadow:0 4px 12px rgba(0,0,0,0.05);">⭐️⭐️⭐️⭐️⭐️<br>“Отличный магазин! Купил первую гитару, помогли с выбором.” — Иван</div>
        <div style="background:white; padding:20px; border-radius:16px; flex:1; box-shadow:0 4px 12px rgba(0,0,0,0.05);">⭐️⭐️⭐️⭐️⭐️<br>“Брал в аренду синтезатор, всё прошло отлично.” — Мария</div>
        <div style="background:white; padding:20px; border-radius:16px; flex:1; box-shadow:0 4px 12px rgba(0,0,0,0.05);">⭐️⭐️⭐️⭐️<br>“Профессиональный ремонт, быстро и качественно.” — Алексей</div>
    </div>
</div>

<div class="main-container">
    <div class="main-block">
        <h1>MusTorg — музыка для всех</h1>
        <p>Широкий выбор инструментов, доступные цены, профессиональная консультация. У нас вы найдёте всё для музыки: от аксессуаров до профессионального оборудования.</p>
    </div>
    @include('includes.aside')
</div>
@endsection