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
            <div class="back-btn-container">
                <a class="back-btn" href="{{ route('register') }}">
                    @svg('heroicon-o-arrow-left', 'back-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                </a>
            </div>

            <!-- Progress Indicator -->
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

            <div class="icon">
                <img src="{{ asset('img/mail.png') }}" alt="Mail Icon">
            </div>

            <h2>{{ __('client/auth.otp') }}</h2>
            <p class="otp-phone">+32 456 789 00</p>

            <form method="POST" action="#" class="otp-form">
                @csrf
                <div class="otp-inputs">
                    <input type="text" name="digit1" maxlength="1" class="otp-box" required autofocus>
                    <input type="text" name="digit2" maxlength="1" class="otp-box" required>
                    <input type="text" name="digit3" maxlength="1" class="otp-box" required>
                    <input type="text" name="digit4" maxlength="1" class="otp-box" required>
                </div>

                <p class="resend-text">{{ __('client/auth.resend-text') }} <span id="countdown">60s</span></p>

                <button type="submit" class="submit-btn" disabled id="verify-btn">Verify</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Progress Indicator - Easy copy-paste to other files
        function initProgressIndicator(currentStep, totalSteps = 5) {
            const circle = document.getElementById('progressCircle');
            const numberEl = document.getElementById('progressNumber');
            const circumference = 2 * Math.PI * 20; // radius = 20

            // Calculate progress percentage
            const progress = (currentStep / totalSteps) * 100;
            const strokeDasharray = (progress / 100) * circumference;

            // Animate from previous step
            setTimeout(() => {
                // Animate circle
                circle.style.strokeDasharray = `${strokeDasharray} ${circumference}`;

                // Animate number
                numberEl.textContent = currentStep;
                numberEl.classList.add('animate');

                // Remove animation class after animation completes
                setTimeout(() => {
                    numberEl.classList.remove('animate');
                }, 600);
            }, 300);
        }

        // Initialize progress when page loads - CHANGE THIS NUMBER FOR EACH PAGE
        document.addEventListener('DOMContentLoaded', function () {
            initProgressIndicator(2); // Step 2 for OTP page
        });

        // OTP functionality
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
