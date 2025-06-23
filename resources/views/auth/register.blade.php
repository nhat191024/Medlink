@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="left">
            <img class="doctor-img" src="{{ asset('img/doctor.webp') }}" alt="Doctor">
        </div>

        <form class="right" method="POST" action="#">
            @csrf

            <div class="back-btn-container">
                <a class="back-btn" href="{{ route('splash') }}">
                    <img src="{{ asset('img/back-circle.jpg') }}" alt="Back" class="back-icon">
                </a>
            </div>

            <div class="icon">
                <img src="{{ asset('img/dienthoai.png') }}" alt="Điện thoại">
            </div>

            <h2>Enter your phone number</h2>

            <div class="form-group">
                <label for="phone">Phone number</label>
                <div class="phone-input">
                    <select id="country_code" name="country_code">
                        <option value="+84">🇻🇳 +84</option>
                        <option value="+228">🇹🇬 +228</option>
                        <option value="+1">🇺🇸 +1</option>
                    </select>
                    <input type="text" id="phone" name="phone" placeholder="456 789 00">
                </div>
            </div>

            <p class="note">
                Don't worry. We won't text you or call you. We'll send you a 4-digit code to confirm your account.
            </p>

            <button type="submit" class="submit-btn">Continue</button>
        </form>
    </div>
@endsection
