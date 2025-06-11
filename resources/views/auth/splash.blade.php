@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/splash.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="splash-container">
        <div class="splash-left">
            <img class="doctor-img" src="/images/happy-black-male-doctor-showing-thumb-up-medical-product-advertising-concept_1262-12343.avif" alt="Doctor">
        </div>
        <div class="splash-right">
            <div class="splash-box">
                <img class="splash-logo" src="/images/logo.svg" alt="Logo">
                <h1 class="splash-title">{{ __('client/auth.splash_title') }}</h1>
                <a class="splashdt-btn" href="{{ route('splash') }}">{{ __('client/auth.button.login') }}</a>
                <a class="register-btn" href="{{ route('register') }}">{{ __('client/auth.button.register') }}</a>
                <div class="divider">
                    <span>{{ __('client/auth.or_continue_with') }}</span>
                </div>
                <div class="social-btns">
                    <a href="#"><img src="/images/747.png" alt="Apple"></a>
                    <a href="#"><img src="/images/Google__G__logo.svg.webp" alt="Google"></a>
                </div>
            </div>
        </div>
    </div>
@endsection
