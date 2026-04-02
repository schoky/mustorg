@extends('layouts.admin')
@section('content')
    <h1>Товары <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Добавить</a></h1>
    <table class="table">
        <thead><tr><th>ID</th><th>Название</th><th>Цена</th><th>В наличии</th><th></th></tr></thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->price, 0, ',', ' ') }} ₽</td>
                <td>{{ $product->in_stock ? 'Да' : 'Нет' }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">Ред.</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Уд.</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
@endsection
