@extends('layouts.app')

@section('content')
    <div class="login-container">
        <div class="login-left">
            <img src="{{ asset('img/bacsi.png') }}" alt="doctor">
        </div>
        <div class="login-right">
            <form class="login-form" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="emoji">
                    <img src="{{ asset('img/bantay.png') }}" alt="bantay">
                </div>

                <h2>{{ __('client/auth.welcome') }}</h2>

                {{-- EMAIL or PHONE --}}
                <div class="form-group">
                    <label for="email">{{ __('client/auth.fields.label.login') }}</label>
                    <input id="email" name="email" type="text" value="{{ old('email') }}" placeholder="{{ __('client/auth.fields.placeholder.login') }}">
                    @error('email')
                        <div style="color: red; font-size: 14px; margin-top: 6px;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="form-group">
                    <label for="password">{{ __('client/auth.fields.label.password') }}</label>
                    <div class="password-wrapper">
                        <input id="password" name="password" type="password" placeholder="{{ __('client/auth.fields.placeholder.password') }}">
                        <span class="toggle-password" onclick="togglePasswordVisibility()">👁️</span>
                    </div>
                    @error('password')
                        <div style="color: red; font-size: 14px; margin-top: 6px;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <a class="forgot-password" href="#">{{ __('client/auth.forgot_password') }}</a>

                <button type="submit">{{ __('client/auth.button.login') }}</button>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("password");
            const icon = document.querySelector(".toggle-password");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.textContent = "👁️‍🗨️";
            } else {
                passwordInput.type = "password";
                icon.textContent = "👁️";
            }
        }
    </script>
@endsection
