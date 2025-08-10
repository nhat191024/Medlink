@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="auth-container">
        <div class="left">
            <div class="welcome-text"></div>
            <img class="doctor-img" src="{{ asset('img/bacsi.png') }}" alt="Doctor">
        </div>

        <div class="right">
            <div class="back-btn-container">
                <a class="back-btn" href="{{ route('register.otp') }}">
                    @svg('heroicon-o-arrow-left', 'back-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                </a>
            </div>

            <div class="progress-indicator" id="progressIndicator">
                <div class="progress-circle">
                    <svg viewBox="0 0 50 50">
                        <circle class="progress-bg" cx="25" cy="25" r="20"></circle>
                        <circle class="progress-fill" cx="25" cy="25" r="20" stroke-dasharray="0 125.6" id="progressCircle">
                        </circle>
                    </svg>
                    <div class="progress-number" id="progressNumber">1</div>
                </div>
            </div>

            <div class="form-content">
                <img src="{{ asset('img/key.svg') }}" class="form-icon" alt="Key Icon">
                <h2 class="form-title">{{ __('client/auth.form-title') }}</h2>

                <form method="POST" action="{{ route('register.create-account.submit') }}" class="create-account-form">
                    @csrf

                    <div class="form-group">
                        <input type="email" name="email"
                            placeholder="{{ __('client/auth.fields.placeholder.login_email') }}" required>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group input-icon-group">
                        <input id="password" name="password" type="password"
                            placeholder="{{ __('client/auth.fields.placeholder.password') }}" required>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        <button type="button" class="toggle-password-btn" onclick="togglePassword()">
                            @svg('heroicon-o-eye', 'toggle-password-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                        </button>
                    </div>

                    <ul class="password-checklist" id="passwordChecklist">
                        <li id="length" class="invalid">{{ __('client/auth.validation.password_min') }}</li>
                        <li id="letters" class="invalid">{{ __('client/auth.validation.password_regex_letters') }}</li>
                        <li id="number" class="invalid">{{ __('client/auth.validation.password_regex_number') }}</li>
                        <li id="special" class="invalid">{{ __('client/auth.validation.password_regex_special') }}</li>
                    </ul>

                    <div class="terms-checkbox">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">
                            {{ __("client/auth.terms.1") }}
                            <a href="#">{{ __("client/auth.terms.2") }}</a>
                            {{ __("client/auth.terms.3") }}
                            <a href="#">{{ __("client/auth.terms.4") }}</a>
                        </label>
                    </div>

                    <button type="submit" class="submit-btn" disabled
                        id="continueBtn">{{ __('client/auth.button.continue') }}
                    </button>
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