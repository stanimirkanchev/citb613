<div class="container">
    <header class="main-header">
        <div class="phone">
            За връзка: <a href="tel:+35988932323">+359 88 93 23 23</a>
        </div>
        <a href="/" title="Back to home">
            <img class="logo" src="/images/logo.svg" alt="Escape rooms in Sofia" />
        </a>
        <div class="auth">
            @guest
            <a class="login-button" href="{{ route('auth.login') }}">Влез в акаунта си</a>
            <em>или</em>
            <a class="register-button" href="{{ route('auth.register') }}">Създай акаунт</a>
            @endguest
            @auth
            <span class="greet">Добре дошъл, {{ Auth::user()->first_name }}</span>
            <form class="logout" action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit">Изход</button>
            </form>
            @endauth
        </div>
    </header>
</div>