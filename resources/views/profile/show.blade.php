@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
    <h1 class="h3 page-title">Профиль</h1>

    <div class="row g-4">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">Мои данные</div>
                <div class="card-body">
                    <table class="table table-sm mb-0">
                        <tr>
                            <th class="w-25">Логин</th>
                            <td>{{ $user->login }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Телефон</th>
                            <td>{{ $user->phone ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th>Роль</th>
                            <td>{{ $user->role->name }}</td>
                        </tr>
                    </table>

                    <div class="mt-3 d-flex gap-2">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Редактировать</a>
                        <a href="{{ route('profile.password') }}" class="btn btn-outline-secondary">Сменить пароль</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">История заказов</div>
                <div class="card-body">
                    <p class="mb-2">Всего заказов: <strong>{{ $ordersCount }}</strong></p>
                    <p class="mb-3">На сумму: <strong>{{ number_format($ordersTotal, 0, '.', ' ') }} ₽</strong></p>

                    <a href="{{ route('orders.index') }}" class="btn btn-outline-dark">Все мои заказы</a>
                </div>
            </div>
        </div>
    </div>
@endsection