@extends('layouts.app')

@section('title', 'Восстановление пароля')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h1 class="h4 mb-3">Восстановление пароля</h1>

                    <p class="text-muted small">
                        Укажите email из вашего профиля — мы отправим ссылку для сброса пароля.
                    </p>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required autofocus>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Отправить ссылку</button>
                    </form>

                    <div class="mt-3 text-center">
                        <a href="{{ route('login') }}" class="small">Вернуться к входу</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection