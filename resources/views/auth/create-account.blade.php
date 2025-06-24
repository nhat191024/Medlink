@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="left">
        <div class="welcome-text"></div>
        <img class="doctor-img" src="{{ asset('img/bacsi.png') }}" alt="Doctor">
    </div>

    <div class="right">
        <div class="back-btn-container">
            <a class="back-btn" href="{{ route('otp.form') }}">
                @svg('heroicon-o-arrow-left', 'back-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
            </a>
        </div>

        <div class="progress-indicator" id="progressIndicator">
            <div class="progress-circle">
                <svg viewBox="0 0 50 50">
                    <circle class="progress-bg" cx="25" cy="25" r="20"></circle>
                    <circle class="progress-fill" cx="25" cy="25" r="20" stroke-dasharray="0 125.6" id="progressCircle"></circle>
                </svg>
                <div class="progress-number" id="progressNumber">1</div>
            </div>
        </div>

        <div class="form-content">
            <img src="{{ asset('img/key.svg') }}" class="form-icon" alt="Key Icon">
            <h2 class="form-title">Create your account</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group input-icon-group">
                    <input id="password" name="password" type="password" placeholder="Enter your password" required>
                    <button type="button" class="toggle-password-btn" onclick="togglePassword()">
                        @svg('heroicon-o-eye', 'toggle-password-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                    </button>
                </div>

                <ul class="password-checklist" id="passwordChecklist">
                    <li id="length" class="invalid">At least 8 characters</li>
                    <li id="letters" class="invalid">At least 6 alphabets (a-z, A-Z)</li>
                    <li id="number" class="invalid">At least 1 number</li>
                    <li id="special" class="invalid">At least 1 special character (&, $, #, %)</li>
                </ul>

                <div class="terms-checkbox">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">
                        By registering, you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>
                    </label>
                </div>

                <button type="submit" class="submit-btn" disabled id="continueBtn">Continue</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const circle = document.getElementById('progressCircle');
        const numberEl = document.getElementById('progressNumber');
        const circumference = 2 * Math.PI * 20;
        const progress = (3 / 5) * 100;
        const strokeDasharray = (progress / 100) * circumference;

        setTimeout(() => {
            circle.style.strokeDasharray = `${strokeDasharray} ${circumference}`;
            numberEl.textContent = 3;
            numberEl.classList.add('animate');
            setTimeout(() => numberEl.classList.remove('animate'), 600);
        }, 300);
    });

    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.querySelector('.toggle-password-icon');

        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `@svg('heroicon-o-eye-slash')`;
        } else {
            input.type = 'password';
            icon.innerHTML = `@svg('heroicon-o-eye')`;
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const continueBtn = document.getElementById('continueBtn');

        passwordInput.addEventListener('input', function () {
            const val = passwordInput.value;

            const lengthCheck = val.length >= 8;
            const letterCount = (val.match(/[a-zA-Z]/g) || []).length;
            const letterCheck = letterCount >= 6;
            const numberCheck = /\d/.test(val);
            const specialCheck = /[&$#%]/.test(val);

            toggleValidation('length', lengthCheck);
            toggleValidation('letters', letterCheck);
            toggleValidation('number', numberCheck);
            toggleValidation('special', specialCheck);

            const allValid = lengthCheck && letterCheck && numberCheck && specialCheck;
            continueBtn.disabled = !allValid;
        });

        function toggleValidation(id, isValid) {
            const el = document.getElementById(id);
            el.classList.toggle('valid', isValid);
            el.classList.toggle('invalid', !isValid);
        }
    });
</script>
@endsection
