<!DOCTYPE html>
<html>

<head>
    <title>@yield('title') | CITB613</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:regular,semibold&display=swap">
    @vite(['resources/scss/reset.css', 'resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
    <main class="main-content">
        @include('components/header')
        @include('components/nav')
        @yield('content')
    </main>
</body>

</html>