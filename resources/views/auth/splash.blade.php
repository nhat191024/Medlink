@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-left">
        <img src="/images/happy-black-male-doctor-showing-thumb-up-medical-product-advertising-concept_1262-12343.avif" alt="Doctor" class="doctor-img">
    </div>
    <div class="login-right">
        <div class="login-box">
            <img src="/images/logo.svg" alt="Logo" class="login-logo">
            <h1 class="login-title">Chăm sóc sức khỏe chỉ cần một chút</h1>
            <a href="{{ route('login') }}" class="logindt-btn">Đăng nhập</a>
            <a href="{{ route('register') }}" class="register-btn">Tạo tài khoản</a>
            <div class="divider">
                <span>hoặc tiếp tục với</span>
            </div>
            <div class="social-btns">
                <a href="#"><img src="/images/747.png" alt="Apple"></a>
                <a href="#"><img src="/images/Google__G__logo.svg.webp" alt="Google"></a>
            </div>
        </div>
    </div>
</div>
@endsection