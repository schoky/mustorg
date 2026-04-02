@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            Сообщение от {{ $message->name }}
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ $message->email }}</p>
            <p><strong>Тема:</strong> {{ $message->subject }}</p>
            <p><strong>Дата:</strong> {{ $message->created_at->format('d.m.Y H:i') }}</p>
            <hr>
            <p><strong>Сообщение:</strong></p>
            <p>{{ nl2br(e($message->message)) }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">Назад</a>
            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" style="display:inline-block;">
                @csrf @method('DELETE')
                <button class="btn btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
            </form>
        </div>
    </div>
@endsection
