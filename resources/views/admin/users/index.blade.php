@extends('layouts.admin')

@section('content')
    <h3>Пользователи</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Администратор</th>
                <th>Дата регистрации</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->is_admin)
                            <span class="badge bg-success">Да</span>
                        @else
                            <span class="badge bg-secondary">Нет</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d.m.Y') }}</td>
                    <td>
                        @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.toggleAdmin', $user) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-warning" type="submit">
                                    {{ $user->is_admin ? 'Снять админа' : 'Сделать админом' }}
                                </button>
                            </form>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Удалить пользователя?')">Удалить</button>
                            </form>
                        @else
                            <span class="text-muted">Это вы</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
@endsection
