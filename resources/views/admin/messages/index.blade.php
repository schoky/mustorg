@extends('layouts.admin')

@section('content')
    <h3>Сообщения из контактной формы</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Тема</th>
                <th>Дата</th>
                <th>Статус</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($messages as $msg)
                <tr class="{{ $msg->is_read ? '' : 'table-warning' }}">
                    <td>{{ $msg->id }}</td>
                    <td>{{ $msg->name }}</td>
                    <td>{{ $msg->email }}</td>
                    <td>{{ $msg->subject }}</td>
                    <td>{{ $msg->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $msg->is_read ? 'Прочитано' : 'Новое' }}</td>
                    <td>
                        <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-sm btn-info">Просмотр</a>
                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Удалить сообщение?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $messages->links() }}
@endsection
