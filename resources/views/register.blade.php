@extends('layouts.main')

@section('header-title')
Регистрация
@endsection

@section('content')
<div style="max-width: 500px; margin: 0 auto; background:white; padding:40px; border-radius:24px;">
    <h1 style="text-align:center; margin-bottom:30px;">Регистрация</h1>
    @if($errors->any())
        <div class="block-error" style="margin-bottom:20px;">
            <ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
        </div>
    @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div style="margin-bottom:20px;">
            <label>Имя</label>
            <input type="text" name="name" value="{{ old('name') }}" required style="width:100%; padding:12px; border-radius:8px; border:1px solid #E2E8F0;">
        </div>
        <div style="margin-bottom:20px;">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required style="width:100%; padding:12px; border-radius:8px; border:1px solid #E2E8F0;">
        </div>
        <div style="margin-bottom:20px;">
            <label>Пароль</label>
            <input type="password" name="password" required style="width:100%; padding:12px; border-radius:8px; border:1px solid #E2E8F0;">
        </div>
        <div style="margin-bottom:25px;">
            <label>Подтверждение пароля</label>
            <input type="password" name="password_confirmation" required style="width:100%; padding:12px; border-radius:8px; border:1px solid #E2E8F0;">
        </div>
        <button type="submit" style="width:100%; background:#2E7D64; color:white; border:none; padding:14px; border-radius:50px; font-weight:600; cursor:pointer;">Зарегистрироваться</button>
    </form>
    <p style="text-align:center; margin-top:20px;">Уже есть аккаунт? <a href="{{ route('login') }}" style="color:#F39C12;">Войти</a></p>
</div>
@endsection