@extends('layouts.app')

@section('title', 'Все заказы')

@section('content')
    <h1 class="h3 page-title">Все заказы</h1>

    <form method="GET" action="{{ route('admin.orders.index') }}" class="row g-2 mb-4">
        <div class="col-md-3">
            <input type="text" name="login" class="form-control" placeholder="Логин пользователя"
                   value="{{ request('login') }}">
        </div>
        <div class="col-md-3">
            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
        </div>
        <div class="col-md-3">
            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary w-100" type="submit">Применить</button>
        </div>
    </form>

    @if ($orders->isEmpty())
        <div class="alert alert-info">Заказы не найдены</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Дата</th>
                    <th>Пользователь</th>
                    <th>Получатель</th>
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
                        <td>{{ $order->user->login }}</td>
                        <td>{{ $order->customer_fullname }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td>{{ $order->product->size->size }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ number_format($order->total_price, 0, '.', ' ') }} ₽</td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('admin.orders.edit', $order) }}"
                               class="btn btn-sm btn-outline-dark">Изменить</a>
                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Удалить заказ №{{ $order->id }}?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $orders->links() }}</div>
    @endif
@endsection