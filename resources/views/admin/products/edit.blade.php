@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Редактировать товар: {{ $product->name }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Название *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Цена (₽) *</label>
                        <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" required>
                        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Цена аренды (₽/день)</label>
                        <input type="number" step="0.01" name="rent_price_per_day" class="form-control" value="{{ old('rent_price_per_day', $product->rent_price_per_day) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Бренд</label>
                        <input type="text" name="brand" class="form-control" value="{{ old('brand', $product->brand) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Категория</label>
                        <input type="text" name="category" class="form-control" value="{{ old('category', $product->category) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Уровень</label>
                        <input type="text" name="level" class="form-control" value="{{ old('level', $product->level) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Описание</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Текущее изображение</label>
                    @if($product->image)
                        <div class="mb-2"><img src="{{ $product->image }}" width="100"></div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">Оставьте пустым, чтобы не менять</small>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="in_stock" class="form-check-input" value="1" {{ old('in_stock', $product->in_stock) ? 'checked' : '' }}>
                    <label class="form-check-label">В наличии</label>
                </div>

                <button type="submit" class="btn btn-primary">Обновить товар</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Назад</a>
            </form>
        </div>
    </div>
@endsection
