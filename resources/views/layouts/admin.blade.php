<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель MusTorg</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .admin-sidebar {
            width: 280px;
            background: #1e293b;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
        }
        .admin-main {
            margin-left: 280px;
            background: #f1f5f9;
            min-height: 100vh;
        }
        .admin-nav a {
            display: block;
            padding: 12px 20px;
            color: #cbd5e1;
            text-decoration: none;
            transition: 0.3s;
        }
        .admin-nav a:hover, .admin-nav a.active {
            background: #334155;
            color: white;
        }
        .admin-nav a i {
            width: 24px;
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="admin-sidebar">
    <div class="p-3 text-white fs-5 fw-bold border-bottom">MusTorg Admin</div>
    <nav class="admin-nav">
        <a href="{{ route('admin.dashboard') }}">📊 Главная</a>
        <a href="{{ route('admin.products.index') }}">🎸 Товары</a>
        <a href="{{ route('admin.orders.index') }}">📦 Заказы</a>
        <a href="{{ route('admin.rentals.index') }}">🎵 Аренда</a>
        <a href="{{ route('admin.messages.index') }}">✉️ Сообщения</a>
        <a href="{{ route('admin.users.index') }}">👥 Пользователи</a>
        <a href="{{ route('home') }}" target="_blank">🌐 На сайт</a>
    </nav>
</div>
<div class="admin-main">
    <div class="p-3 bg-white shadow-sm d-flex justify-content-between align-items-center">
        <span>Привет, <strong>{{ auth()->user()->name }}</strong></span>
        <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger">Выйти</button>
        </form>
    </div>
    <div class="p-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
