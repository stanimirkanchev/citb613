@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<h1 style="margin: 0 0 24px 0;">Регистрация</h1>
<form class="register-form" action="{{ route('auth.register.create') }}" method="POST">
    @csrf
    <label for="first_name">Име</label>
    <input type="text" name="first_name" id="first_name" placeholder="Име" value="{{ old('first_name') }}" />
    <label for="last_name">Фамилия</label>
    <input type="text" name="last_name" id="last_name" placeholder="Фамилия" value="{{ old('last_name') }}" />
    <label for="phone">Телефон</label>
    <input type="text" name="phone" id="phone" placeholder="Телефон" value="{{ old('phone') }}" />
    <label for="email">E-mail адрес</label>
    <input type="text" name="email" id="email" placeholder="E-mail адрес" value="{{ old('email') }}" />
    <label for="password">Парола</label>
    <input type="password" id="password" name="password" placeholder="Парола" />
    <label for="password_confirmation">Потвърди паролата</label>
    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Потвърди паролата" />

    @if($errors && count($errors))
    <div class="form-errors">
        @foreach($errors->toArray() as $error)
        <span class="form-error">{{ $error[0] }}</span>
        @endforeach
    </div>
    @endif

    <button type="submit">Регистрация</button>
</form>
@stop