<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('header-title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <div class="inner">
            <span class="logo">MusTorg</span>
            <nav>
                <ul>
                    <li><a href="{{ route('home') }}">Главная</a></li>
                    <li><a href="{{ route('catalog') }}">Каталог</a></li>
                    <li><a href="{{ route('services') }}">Услуги</a></li>
                    <li><a href="{{ route('about') }}">О нас</a></li>
                    <li><a href="{{ route('contact') }}">Контакты</a></li>
                    <li><a href="{{ route('cart.index') }}">Корзина</a></li>  <!-- новая ссылка -->
                    @auth
                        <li><a href="{{ route('profile.index') }}">Личный кабинет</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                                @csrf
                                <button type="submit" style="background:none; border:none; color:white; cursor:pointer;">Выйти</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Вход</a></li>
                        <li><a href="{{ route('register') }}">Регистрация</a></li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>

    <div class="content">
        @yield('content')
    </div>

    <footer>2026 Все права защищены</footer>
</body>
</html>