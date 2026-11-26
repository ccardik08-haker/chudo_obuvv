@extends('layouts.app')

@section('title', 'Мои заказы')

@section('content')
    <h1 class="h3 mb-4">Мои заказы</h1>

    @if ($orders->isEmpty())
        <div class="alert alert-info">
            У вас пока нет заказов.
            <a href="{{ route('products.index') }}">Перейти в каталог</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Дата</th>
                    <th>Товар</th>
                    <th>Размер</th>
                    <th>Кол-во</th>
                    <th>Сумма</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->date->format('d.m.Y') }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td>{{ $order->product->size->size }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ number_format($order->total_price, 0, '.', ' ') }} ₽</td>
                        <td class="text-end">
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-dark">
                                Открыть
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $orders->links() }}
        </div>
    @endif
@endsection