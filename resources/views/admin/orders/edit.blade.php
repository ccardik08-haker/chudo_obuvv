@extends('layouts.app')

@section('title', 'Заказ №' . $order->id)

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Все заказы</a></li>
            <li class="breadcrumb-item active">№{{ $order->id }}</li>
        </ol>
    </nav>

    <h1 class="h3 page-title">Редактирование заказа №{{ $order->id }}</h1>

    <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="row g-3">
        @csrf
        @method('PUT')

        <div class="col-md-6">
            <label for="user_id" class="form-label">Пользователь</label>
            <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @selected(old('user_id', $order->user_id) == $user->id)>
                        {{ $user->login }} ({{ $user->role->name }})
                    </option>
                @endforeach
            </select>
            @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-6">
            <label for="product_id" class="form-label">Товар</label>
            <select name="product_id" id="product_id" class="form-select @error('product_id') is-invalid @enderror">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" @selected(old('product_id', $order->product_id) == $product->id)>
                        {{ $product->name }} — {{ number_format($product->price, 0, '.', ' ') }} ₽
                    </option>
                @endforeach
            </select>
            @error('product_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-4">
            <label for="date" class="form-label">Дата заказа</label>
            <input type="datetime-local" name="date" id="date"
                   class="form-control @error('date') is-invalid @enderror"
                   value="{{ old('date', $order->date->format('Y-m-d\TH:i')) }}">
            @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-4">
            <label for="quantity" class="form-label">Количество</label>
            <input type="number" name="quantity" id="quantity" min="1"
                   class="form-control @error('quantity') is-invalid @enderror"
                   value="{{ old('quantity', $order->quantity) }}">
            @error('quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-4">
            <label for="customer_fullname" class="form-label">ФИО получателя</label>
            <input type="text" name="customer_fullname" id="customer_fullname"
                   class="form-control @error('customer_fullname') is-invalid @enderror"
                   value="{{ old('customer_fullname', $order->customer_fullname) }}">
            @error('customer_fullname')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Отмена</a>
        </div>
    </form>
@endsection