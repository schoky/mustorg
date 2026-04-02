@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Панель управления</h1>

    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Товары</h5>
                    <h2>{{ $stats['products'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Заказы</h5>
                    <h2>{{ $stats['orders'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Пользователи</h5>
                    <h2>{{ $stats['users'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Новые сообщения</h5>
                    <h2>{{ $stats['messages'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Доход от заказов</div>
                <div class="card-body">
                    <h3>{{ number_format($stats['total_income'], 0, ',', ' ') }} ₽</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Активных аренд</div>
                <div class="card-body">
                    <h3>{{ $stats['rentals'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="card">
            <div class="card-header">Последние заказы</div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead><tr><th>ID</th><th>Сумма</th><th>Статус</th><th>Дата</th><th></th></tr></thead>
                    <tbody>
                    @foreach($recentOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ number_format($order->total, 0, ',', ' ') }} ₽</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->created_at->diffForHumans() }}</td>
                            <td><a href="{{ route('admin.orders.show', $order) }}">Просмотр</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
