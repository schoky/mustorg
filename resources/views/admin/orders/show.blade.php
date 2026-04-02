@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Заказ #{{ $order->id }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Пользователь:</strong> {{ $order->user->name ?? 'Гость' }} ({{ $order->user->email ?? '—' }})</p>
            <p><strong>Адрес доставки:</strong> {{ $order->shipping_address }}</p>
            <p><strong>Общая сумма:</strong> {{ number_format($order->total, 0, ',', ' ') }} ₽</p>
            <p><strong>Дата заказа:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>

            <h4>Товары в заказе</h4>
            <table class="table table-sm">
                <thead>
                <tr><th>Товар</th><th>Цена</th><th>Кол-во</th><th>Сумма</th></tr>
                </thead>
                <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ number_format($item->price, 0, ',', ' ') }} ₽</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} ₽</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" class="mt-3">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-auto">
                        <select name="status" class="form-select">
                            <option value="pending" {{ $order->status=='pending' ? 'selected' : '' }}>Ожидает</option>
                            <option value="processing" {{ $order->status=='processing' ? 'selected' : '' }}>В обработке</option>
                            <option value="shipped" {{ $order->status=='shipped' ? 'selected' : '' }}>Отправлен</option>
                            <option value="delivered" {{ $order->status=='delivered' ? 'selected' : '' }}>Доставлен</option>
                            <option value="cancelled" {{ $order->status=='cancelled' ? 'selected' : '' }}>Отменён</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Обновить статус</button>
                    </div>
                </div>
            </form>

            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">Назад к заказам</a>
        </div>
    </div>
@endsection
