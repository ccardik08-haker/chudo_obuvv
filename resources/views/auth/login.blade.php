@extends('layouts.app')

@section('title', 'Вход')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h1 class="h4 mb-3">Вход</h1>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="login" class="form-label">Логин, телефон или email</label>
                            <input type="text" name="login" id="login"
                                   class="form-control @error('login') is-invalid @enderror"
                                   value="{{ old('login') }}" required autofocus>
                            @error('login')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input">
                            <label for="remember" class="form-check-label">Запомнить меня</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Войти</button>
                    </form>
                                        <div class="mt-3 text-center">
                                            <a href="{{ route('password.request') }}" class="small">Забыли пароль?</a>
                                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection