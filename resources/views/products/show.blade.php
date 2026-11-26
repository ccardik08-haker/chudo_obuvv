@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Каталог</a></li>
            <li class="breadcrumb-item">{{ $product->category->name }}</li>
            <li class="breadcrumb-item active">{{ $product->subcategory->name }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-md-6">
            @if ($product->image)
                <img src="{{ asset($product->image) }}" class="img-fluid rounded product-image-small"
                style="height: 360px;" alt="{{ $product->name }}">
            @endif
        </div>

        <div class="col-md-6">
            <h1 class="h3">{{ $product->name }}</h1>
            <p class="text-muted">{{ $product->manufacture }}</p>

            <p class="h3 text-danger mb-3">{{ number_format($product->price, 0, '.', ' ') }} ₽</p>

            <table class="table table-sm">
                <tr>
                    <th class="w-25">Размер</th>
                    <td>{{ $product->size->size }}</td>
                </tr>
                <tr>
                    <th>В наличии</th>
                    <td>{{ $product->quantity }} шт.</td>
                </tr>
                <tr>
                    <th>Состав</th>
                    <td>{{ $product->composition ?? '—' }}</td>
                </tr>
            </table>

            <p>{{ $product->description }}</p>

            @auth
                @if ($product->quantity > 0)
                    <a href="{{ route('orders.create', $product) }}" class="btn btn-success btn-lg">
                        Заказать
                    </a>
                @else
                    <button class="btn btn-secondary btn-lg" disabled>Нет в наличии</button>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">
                    Войдите, чтобы заказать
                </a>
            @endauth
        </div>
    </div>

    @if ($related->isNotEmpty())
        <h2 class="h4 mt-5 mb-3">Похожие товары</h2>
        <div class="row row-cols-2 row-cols-md-4 g-3">
            @foreach ($related as $item)
                <div class="col">
                    <a href="{{ route('products.show', $item) }}" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            @if ($item->image)
                                <img src="{{ asset($item->image) }}" class="card-img-top product-image-small"
                                    alt="{{ $item->name }}">
                            @endif
                            <div class="card-body p-2">
                                <p class="small mb-1">{{ $item->name }}</p>
                                <strong>{{ number_format($item->price, 0, '.', ' ') }} ₽</strong>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
@endsection