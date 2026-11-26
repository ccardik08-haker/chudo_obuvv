<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Чудо Обувь')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body>

<nav class="navbar navbar-expand-lg mb-4">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Чудо Обувь" class="chudo-logo">
            <span>Чудо Обувь</span>
        </a>
        <div class="d-flex align-items-center gap-3">
            <a class="nav-link" href="{{ route('products.index') }}">Каталог</a>
            @auth
            <a class="nav-link" href="{{ route('orders.index') }}">Мои заказы</a>
            @if (in_array(auth()->user()->role->name, ['admin', 'manager'], true))
                <a class="nav-link" href="{{ route('admin.orders.index') }}">Все заказы</a>
            @endif
                <a class="nav-link" href="{{ route('profile.show') }}">{{ auth()->user()->login }}</a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-sm btn-outline-light" type="submit">Выйти</button>
                </form>
            @else
                <a class="nav-link" href="{{ route('login') }}">Войти</a>
            @endauth
        </div>
    </div>
</nav>

<main class="container pb-5">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @yield('content')
</main>

</body>
</html>