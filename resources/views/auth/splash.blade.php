@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <div class="left">
            <img class="doctor-img" src="{{ asset('img/doctor.webp') }}" alt="Doctor">
        </div>

        <div class="right">

            <img class="logo" src="{{ asset('img/logo.svg') }}" alt="Logo">
            <h1 class="title">{{ __('client/auth.splash_title') }}</h1>
            <a class="login-btn" href="{{ route('login') }}">{{ __('client/auth.button.login') }}</a>
            <a class="register-btn" href="{{ route('register.phone') }}">{{ __('client/auth.button.register') }}</a>
            <div class="divider">
                <span>{{ __('client/auth.or_continue_with') }}</span>
            </div>
            <div class="social-btns">
                <a href="#"><img src="{{ asset('img/apple.svg') }}" alt="Apple"></a>
                <a href="#"><img src="{{ asset('img/google.svg') }}" alt="Google"></a>
            </div>

        </div>
    </div>
@endsection