@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
<div class="homepage">
    <div class="container">
        <div class="rooms-wrapper">
            @foreach($rooms as $room)
            <div class="room">
                <div class="image">
                    <img src="{{ $room->getMainImage($room->id) }}" alt="{{ $room->name }}" />
                </div>
                <div class="content">
                    <h4>{{ $room->name }}</h4>
                    <ul>
                        <li>Участници: {{ $room->capacity_min }} - {{ $room->capacity_max }}</li>
                        <li>Цена: {{ $room->getPrice() }}лв.</li>
                        <li>Продължителност: {{ $room->duration}} минути</li>
                        <li>Ниво на трудност: {{ $room->level }}</li>
                        <li>Адрес: {{ $room->city}}, {{ $room->address}}</li>
                    </ul>
                    <a href="/room/{{$room->id}}">Резервирай</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@stop