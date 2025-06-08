@extends('layouts.app')

@section('content')
<div class="splash-container">
    <div class="splash-left">
        <img src="/images/happy-black-male-doctor-showing-thumb-up-medical-product-advertising-concept_1262-12343.avif" alt="Doctor" class="doctor-img">
    </div>
    <div class="splash-right">
        <div class="splash-box">
            <img src="/images/logo.svg" alt="Logo" class="splash-logo">
            <h1 class="splash-title">Chăm sóc sức khỏe chỉ cần một chút</h1>
            <a href="{{ route('splash') }}" class="splashdt-btn">Đăng nhập</a>
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