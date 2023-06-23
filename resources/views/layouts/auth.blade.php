<!DOCTYPE html>
<html>

<head>
    <title>@yield('title') | CITB613</title>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/scss/reset.css', 'resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
    <main class="auth-content">
        <div class="container">
            <header class="auth-header">
                <a class="logo" href="/" title="Back to home">
                    <img src="/images/logo.svg" alt="Escape rooms in Sofia" />
                </a>
            </header>
            <div class="auth-wrapper">
                @yield('content')
            </div>
        </div>
        </div>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>

</html>