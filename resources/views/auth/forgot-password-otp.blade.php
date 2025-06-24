@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    {{-- You may need to add specific styles for this page --}}
@endpush

@section('content')
    <div class="container">
        <div class="left">
            <img class="doctor-img" src="{{ asset('img/doctor.webp') }}" alt="Doctor">
        </div>

        <form class="right" method="POST" action="{{ route('forgot-password.verify-otp') }}">
            @csrf
            <div class="back-btn-container">
                <a class="back-btn" href="{{ route('forgot-password') }}">
                    @svg('heroicon-o-arrow-left', 'back-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                </a>
            </div>

        
            <div class="progress-indicator" id="progressIndicator" style="display: none; visibility: hidden;">
           
            </div>

            <div class="icon" style="text-align: center; margin: 2rem 0;">
        
                <img src="{{ asset('img/mail.png') }}" alt="Mail Icon" style="width: 60px; height: auto;">
            </div>

            <h2 style="text-align: center; font-size: 1.25rem;">Enter the 4-digit code</h2>
            <p class="otp-phone" style="text-align: center; color: #666; margin-bottom: 2rem;">
         
            </p>

            <div class="otp-inputs" style="display: flex; justify-content: center; gap: 10px; margin-bottom: 1.5rem;">
                <input type="text" name="digit1" maxlength="1" class="otp-box" required autofocus style="width: 50px; height: 50px; text-align: center; font-size: 1.5rem; border: 1px solid #ccc; border-radius: 8px;">
                <input type="text" name="digit2" maxlength="1" class="otp-box" required style="width: 50px; height: 50px; text-align: center; font-size: 1.5rem; border: 1px solid #ccc; border-radius: 8px;">
                <input type="text" name="digit3" maxlength="1" class="otp-box" required style="width: 50px; height: 50px; text-align: center; font-size: 1.5rem; border: 1px solid #ccc; border-radius: 8px;">
                <input type="text" name="digit4" maxlength="1" class="otp-box" required style="width: 50px; height: 50px; text-align: center; font-size: 1.5rem; border: 1px solid #ccc; border-radius: 8px;">
            </div>

            <input type="hidden" name="otp" id="otp-value">

            <p class="resend-text" style="text-align: center; margin-bottom: 1.5rem;">Resend code after <span id="countdown">60s</span></p>

            <button type="submit" class="login-btn" disabled id="verify-btn">Verify</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const otpInputs = document.querySelectorAll('.otp-box');
            const verifyBtn = document.getElementById('verify-btn');
            const otpValueInput = document.getElementById('otp-value');

            otpInputs.forEach((el, index) => {
                el.addEventListener('input', (e) => {
                    // Only allow numbers
                    e.target.value = e.target.value.replace(/[^0-9]/g, '');

                    if (e.target.value.length === 1 && index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                    checkFullCode();
                });

                el.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && el.value.length === 0 && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                });
            });

            function checkFullCode() {
                const code = [...otpInputs].map(el => el.value).join('');
                const allFilled = code.length === 4;
                verifyBtn.disabled = !allFilled;
                if (allFilled) {
                    otpValueInput.value = code;
                } else {
                    otpValueInput.value = '';
                }
            }

            // Countdown timer
            let countdown = 60;
            const countdownEl = document.getElementById("countdown");
            const resendText = countdownEl.parentElement;
            
            const interval = setInterval(() => {
                countdown--;
                if(countdownEl) {
                    countdownEl.textContent = countdown + "s";
                    if (countdown <= 0) {
                        clearInterval(interval);
                        resendText.innerHTML = '<a href="#">Resend code</a>';
                    }
                }
            }, 1000);
        });
    </script>
@endpush 