@extends('layouts.app')

@section('title', 'Каталог обуви')

@section('content')
    <h1 class="h3 mb-4">Каталог</h1>

    <form method="GET" action="{{ route('products.index') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Поиск по названию"
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-3">
            <select name="cat_id" class="form-select" onchange="this.form.submit()">
                <option value="">Все категории</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('cat_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <select name="sort" class="form-select" onchange="this.form.submit()">
                <option value="name_asc" @selected($sort === 'name_asc')>Название А-Я</option>
                <option value="name_desc" @selected($sort === 'name_desc')>Название Я-А</option>
                <option value="price_asc" @selected($sort === 'price_asc')>Цена по возрастанию</option>
                <option value="price_desc" @selected($sort === 'price_desc')>Цена по убыванию</option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100" type="submit">Найти</button>
        </div>
    </form>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse ($products as $product)
            <div class="col {{ $product->quantity <= 3 ? 'product-low-stock' : '' }}">
                <div class="card h-100">
                    @if ($product->image)
                        <img src="{{ asset($product->image) }}" class="card-img-top product-image"
                            alt="{{ $product->name }}">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted small mb-2">{{ $product->manufacture }}</p>

                        <p class="mb-1">
                            <span class="badge bg-secondary">{{ $product->category->name }}</span>
                            <span class="badge bg-secondary">{{ $product->subcategory->name }}</span>
                        </p>

                        <p class="mb-2">
                            Размер: <strong>{{ $product->size->size }}</strong><br>
                            В наличии: {{ $product->quantity }} шт.
                        </p>

                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0">{{ number_format($product->price, 0, '.', ' ') }} ₽</span>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-dark">
                                Подробнее
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Товары не найдены</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
@endsection