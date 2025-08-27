<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link type="image/x-icon" rel="icon" href="{{ asset('storage/assets/site_favicon.ico') }}">

    <title>{{ config('app.name', 'Medlink') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('styles')

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Main Content -->
    <main>
        @if (session('error'))
            <div class="alert alert-error m-3">
                <span>{{ session('error') }}</span>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success m-3">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @yield('content')

    </main>

    <!-- Scripts -->
    @stack('scripts')
</body>

</html>
