<div class="container">
    <nav class="main-nav">
        <a href="{{ route('home') }}" class="{{ (Route::current()->getName() === 'home' ? 'active' : '') }}">
            Всички стаи
        </a>
        <a href="{{ route('home') }}" class="{{ (Route::current()->getName() === 'questions' ? 'active' : '') }}">
            Въпроси
        </a>
        <a href="{{ route('home') }}" class="{{ (Route::current()->getName() === 'contacts' ? 'active' : '') }}">
            Контакти
        </a>
    </nav>
</div>