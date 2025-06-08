@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-left">
        <img src="/images/image.png" alt="Doctor" class="doctor-img">
    </div>
    <div class="login-right">
        <div class="login-box">
            <img src="/images/logo.svg" alt="Logo" class="login-logo">
            <h1 class="login-title">Chăm sóc sức khỏe chỉ cần một chút</h1>
            <a href="{{ route('login') }}" class="logindt-btn">Log In</a>
            <a href="{{ route('register') }}" class="register-btn">Create an Account</a>
            <div class="divider">
                <span>or continue with</span>
            </div>
            <div class="social-btns">
                <a href="#"><img src="/images/747.png" alt="Apple"></a>
                <a href="#"><img src="/images/Google__G__logo.svg.webp" alt="Google"></a>
            </div>
        </div>
    </div>
</div>
@endsection