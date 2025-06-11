<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Medlink') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body>
    <!-- Navbar Component -->
    <x-navbar />

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Scripts -->
    @stack('scripts')
</body>

</html>
