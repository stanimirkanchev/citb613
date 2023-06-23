@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<h1 style="margin: 0 0 24px 0;">Вход</h1>
<form class="login-form" action="{{ route('auth.attempt') }}" method="POST">
    @csrf
    <label for="email">E-mail адрес:</label>
    <input type="text" name="email" id="email" placeholder="E-mail адрес:" value="{{ old('email') }}" />
    <label for="password">Парола</label>
    <input type="password" id="password" name="password" placeholder="Парола" />

    @if($errors && count($errors))
    <div class="form-errors">
        @foreach($errors->toArray() as $error)
        <span class="form-error">{{ $error[0] }}</span>
        @endforeach
    </div>
    @endif

    <button type="submit">Вход</button>
</form>
@stop