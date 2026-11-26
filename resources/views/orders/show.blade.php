@extends('layouts.app')

@section('title', 'Заказ №' . $order->id)

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Мои заказы</a></li>
            <li class="breadcrumb-item active">№{{ $order->id }}</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h1 class="h4 mb-3">Заказ №{{ $order->id }}</h1>

            <table class="table table-sm">
                <tr>
                    <th class="w-25">Дата</th>
                    <td>{{ $order->date->format('d.m.Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Получатель</th>
                    <td>{{ $order->customer_fullname }}</td>
                </tr>
                <tr>
                    <th>Товар</th>
                    <td>
                        <a href="{{ route('products.show', $order->product) }}">
                            {{ $order->product->name }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Категория</th>
                    <td>
                        {{ $order->product->category->name }} /
                        {{ $order->product->subcategory->name }}
                    </td>
                </tr>
                <tr>
                    <th>Размер</th>
                    <td>{{ $order->product->size->size }}</td>
                </tr>
                <tr>
                    <th>Количество</th>
                    <td>{{ $order->quantity }} шт.</td>
                </tr>
                <tr>
                    <th>Итого</th>
                    <td class="h5">{{ number_format($order->total_price, 0, '.', ' ') }} ₽</td>
                </tr>
            </table>

            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">Назад к списку</a>
        </div>
    </div>
@endsection