@extends('layouts.app')

@section('title', 'Оформление заказа')

@section('content')
    <h1 class="h3 mb-4">Оформление заказа</h1>

    <div class="row g-4">
        <div class="col-md-4">
            @if ($product->image)
                <img src="{{ asset($product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
            @endif
        </div>

        <div class="col-md-8">
            <h2 class="h5">{{ $product->name }}</h2>
            <p class="text-muted">{{ $product->manufacture }}</p>
            <p>Размер: <strong>{{ $product->size->size }}</strong></p>
            <p>В наличии: {{ $product->quantity }} шт.</p>
            <p class="h4 text-danger">{{ number_format($product->price, 0, '.', ' ') }} ₽</p>

            <form method="POST" action="{{ route('orders.store') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="mb-3">
                    <label for="customer_fullname" class="form-label">ФИО получателя</label>
                    <input type="text" name="customer_fullname" id="customer_fullname"
                           class="form-control @error('customer_fullname') is-invalid @enderror"
                           value="{{ old('customer_fullname', auth()->user()->login) }}"
                           required>
                    @error('customer_fullname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Количество</label>
                    <input type="number" name="quantity" id="quantity" min="1"
                           max="{{ $product->quantity }}"
                           class="form-control @error('quantity') is-invalid @enderror"
                           value="{{ old('quantity', 1) }}" required>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Оформить заказ</button>
            </form>
        </div>
    </div>
@endsection