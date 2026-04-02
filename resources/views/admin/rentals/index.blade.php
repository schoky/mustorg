@extends('layouts.admin')

@section('content')
    <h3>Заявки на аренду</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Пользователь</th>
                <th>Инструмент</th>
                <th>Период</th>
                <th>Итого</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rentals as $rental)
                <tr>
                    <td>{{ $rental->id }}</td>
                    <td>{{ $rental->user->name ?? '—' }}<br><small>{{ $rental->user->email ?? '' }}</small></td>
                    <td>{{ $rental->product->name ?? '—' }}</td>
                    <td>{{ $rental->start_date }} — {{ $rental->end_date }}</td>
                    <td>{{ number_format($rental->total_price, 0, ',', ' ') }} ₽</td>
                    <td>
                        <span class="badge bg-secondary">{{ $rental->status ?? 'pending' }}</span>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.rentals.updateStatus', $rental) }}" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select form-select-sm d-inline-block w-auto">
                                <option value="pending" {{ $rental->status=='pending' ? 'selected' : '' }}>pending</option>
                                <option value="approved" {{ $rental->status=='approved' ? 'selected' : '' }}>approved</option>
                                <option value="active" {{ $rental->status=='active' ? 'selected' : '' }}>active</option>
                                <option value="completed" {{ $rental->status=='completed' ? 'selected' : '' }}>completed</option>
                                <option value="cancelled" {{ $rental->status=='cancelled' ? 'selected' : '' }}>cancelled</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">Обновить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $rentals->links() }}
@endsection
