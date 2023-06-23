@extends('layouts.app')

@section('title', 'Success')

@section('content')
<div class="success">
    <div class="container">
        <div class="success-wrapper" id="reservation-success">
            Направихте успешна резервация за стая: <strong>{{ $room->name }}</strong><br />
            На името на <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>
            <br /><br />
            Информация за резервацията:
            <ul>
                <li>Брой играчи: <strong>{{ $reservation->people }}</strong></li>
                <li>Дата и час: <strong>{{ $reservation->reservation_at->format('j.m.Y - H:i') }}ч.</strong>
                </li>
                <li>Адрес: <strong>{{ $room->city }}, {{ $room->address }}</strong></li>
                <li>Цена на човек: <strong>{{ $room->getPrice() }}лв.</strong></li>
                <li>Обща цена: <strong>{{ $reservation->getTotalPrice() }}лв.</strong></li>
            </ul>
        </div>
    </div>
</div>
@stop