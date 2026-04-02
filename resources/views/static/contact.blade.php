@extends('layouts.main')

@section('header-title')
Контакты
@endsection

@section('content')
@if($errors->any())
    <div class='block-error'>
        <ul>
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="main-container">
    <div class="main-block">
        <h1>Наши контакты</h1>
        <p>Электронная почта: <a href="mustorg@yandex.ru">mustorg@yandex.ru</a></p>
        <p>Адрес: Улица Пушкина, 45</p>
        <p>Номер телефона: +7(950)321-34-56</p>
        <form action="{{ route('contact.post') }}" method="POST">
            @csrf

            <label for="name">Имя:</label>
            <input type="text" placeholder='Введите имя' name='name' id='name' value="{{ old('name') }}">

            <label for="email">Электронная почта:</label>
            <input type="email" placeholder='Введите email' name='email' id='email' value="{{ old('email') }}">

            <label for="subject">Тема обращения:</label>
            <input type="text" placeholder='Введите вашу тему' name='subject' id='subject' value="{{ old('subject') }}">

            <label for="message">Обращение</label>
            <textarea name="message" id="message" placeholder='Введите ваше сообщение'>{{ old('message') }}</textarea>

            <button type='submit'>Отправить обращение</button>
        </form>
    </div>

    @include('includes.aside')
</div>
@endsection