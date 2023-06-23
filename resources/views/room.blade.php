@extends('layouts.app')

@section('title', $room->name)

@section('content')
<div class="container">
    <div id="room">
        <div class="inner-wrapper">
            <div class="images">
                <figure class="main-image">
                    <img src="{{ $room->getMainImage($room->id) }}" alt="{{ $room->name }}" />
                </figure>
                @if(count($room->getGalleryItems()))
                <div class="gallery">
                    @foreach($room->getGalleryItems() as $item)
                    <figure class="gallery-item">
                        <img src="/images/rooms/{{ $item->image_path }}" alt="{{ $room->name }}" />
                    </figure>
                    @endforeach
                </div>
                @endif
            </div>
            <div class="content">
                <h1>{{ $room->name }}</h1>
                <ul>
                    <li>
                        Участници: <strong>{{ $room->capacity_min }} - {{ $room->capacity_max }}</strong>
                    </li>
                    <li>
                        Цена на участник: <strong>{{ $room->getPrice() }}лв.</strong>
                    </li>
                    <li>Продължителност: <strong>{{ $room->duration}} минути</strong></li>
                    <li>Ниво на трудност: <strong>{{ $room->level }}</strong></li>
                    <li>Адрес: <strong>{{ $room->city}}, {{ $room->address}}</strong></li>
                </ul>
                <h4>Описание:</h4>
                <p>{!! $room->description !!}</p>
            </div>
            <h2>Направи резервация</h2>
            <div id="reservation_slots">
                <div class="days-of-week">
                    @foreach($daysOfWeek as $day)
                    <div class="day">
                        <h5>{{ $day->translatedFormat('d.m l') }}</h5>
                        <div class="timeslot">
                            @foreach($room->getIntervals() as $time)
                            @if($room->checkAvailability($day, $time))
                            <a href="#" class="time_slot" data-time="{{ $time }}" data-day="{{ $day }}">
                                {{ $time }}
                            </a>
                            @else
                            <a href="javascript:void(0);" class="unavailable">{{ $time }}</a>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div id="reservation_modal_overlay"></div>
        <div id="reservation_modal">
            <header>
                <h4>Запази час</h4>
                <div id="reservation_modal_close" class="close">X</div>
            </header>
            @guest
            <div class="alert">
                Правите резервация, като гост ще използваме данните ви за да ви съсздадем акаунт.</div>
            @endif
            <form action="{{ route('rooms.reservation.create', $room->id) }}" method="POST" id="reservation_form">
                @csrf
                <input type="hidden" name="time" id="timeHiddenInput" />
                <input type="hidden" name="day" id="dayHiddenInput" />
                @auth
                <input type="hidden" name="user_id" id="userIdInput" value="{{ Auth::user()->id }}" />
                @endif
                <div class="form-item half">
                    <label>Име</label>
                    <input type="text" id="firstNameInput" name="first_name" placeholder="Име"
                        value="{{ Auth::user() ? Auth::user()->first_name : '' }}" />
                </div>
                <div class="form-item half">
                    <label>Фамилия</label>
                    <input type="text" id="lastNameInput" name="last_name" placeholder="Фамилия"
                        value="{{ Auth::user() ? Auth::user()->last_name : '' }}" />
                </div>
                <div class="form-item half">
                    <label>Email адрес</label>
                    <input type="email" id="emailInput" name="email" placeholder="Email дрес"
                        value="{{ Auth::user() ? Auth::user()->email : '' }}" />
                </div>
                <div class="form-item half">
                    <label>Телефон</label>
                    <input type="text" id="phoneInput" name="phone" placeholder="Телефон"
                        value="{{ Auth::user() ? Auth::user()->phone : '' }}" />
                </div>
                @guest
                <div class="form-item half">
                    <label>Парола</label>
                    <input type="password" id="passwordInput" name="password" placeholder="Въведете парола" />
                </div>
                <div class="form-item half">
                    <label>Потвърдете парола</label>
                    <input type="password" id="passwordConfirmationInput" name="password_confirmation"
                        placeholder="Потвърдете паролата" />
                </div>
                @endif
                <div class="form-item full">
                    <label>Брой играчи</label>
                    <select id="peopleInput" name="people" placeholder="Брой играчи">
                        <option value="" selected disabled>Изберете брой играчи</option>
                        @foreach (range($room->capacity_min, $room->capacity_max) as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="errors-wrapper">
                    <div id="emailExistsError"></div>
                    <div id="takenError"></div>
                    <div id="reservationPasswordErrors"></div>
                    <div id="reservationErrorsPlaceholder"></div>
                </div>
                <footer>
                    <input type="hidden" id="rawPrice" value="{{ $room->getPrice() }}" />
                    <input type="hidden" id="rawCapacity" value="0" />
                    <span>Обща цена: <strong id="totalPrice">Изберете брой играчи</strong></span>
                    <a href="javascript:void(0);" id="reservation_button">Запази час</a>
                </footer>
            </form>
        </div>
    </div>
</div>
@stop