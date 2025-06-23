@extends('layouts.app')

@section('content')
<link href="{{ asset('css/auth-otp.css') }}" rel="stylesheet">

<div class="container">
    <div class="left">
        <img class="doctor-img" src="{{ asset('img/doctor.webp') }}" alt="Doctor">
    </div>

    <div class="right">
        <div class="back-btn-container">
            <a class="back-btn" href="{{ route('register') }}">
                <img src="{{ asset('img/back-circle.jpg') }}" alt="Back" class="back-icon">
            </a>
        </div>

        <div class="icon">
            <img src="{{ asset('img/mail.png') }}" alt="Mail Icon">
        </div>

        <h2>Enter the 4-digit code we sent to</h2>
        <p class="otp-phone">+32 456 789 00</p>

        <form method="POST" action="#" class="otp-form">
            @csrf
            <div class="otp-inputs">
                <input type="text" name="digit1" maxlength="1" class="otp-box" required autofocus>
                <input type="text" name="digit2" maxlength="1" class="otp-box" required>
                <input type="text" name="digit3" maxlength="1" class="otp-box" required>
                <input type="text" name="digit4" maxlength="1" class="otp-box" required>
            </div>

            <p class="resend-text">Resend code after <span id="countdown">60s</span></p>

            <button type="submit" class="submit-btn" disabled id="verify-btn">Verify</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.otp-box').forEach((el, index, inputs) => {
        el.addEventListener('input', () => {
            if (el.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
            checkFullCode();
        });
    });

    function checkFullCode() {
        const allFilled = [...document.querySelectorAll('.otp-box')].every(el => el.value.length === 1);
        document.getElementById('verify-btn').disabled = !allFilled;
    }

    let countdown = 60;
    const countdownEl = document.getElementById("countdown");
    const interval = setInterval(() => {
        countdown--;
        countdownEl.textContent = countdown + "s";
        if (countdown <= 0) {
            clearInterval(interval);
            countdownEl.textContent = "Now";
        }
    }, 1000);
</script>
@endpush
