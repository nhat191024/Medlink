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

                <h2>Welcome back!</h2>

                {{-- EMAIL OR PHONE --}}
                <div class="form-group">
                    <label for="email">Email or Phone</label>
                    <input id="email" name="email" type="text" value="{{ old('email') }}" placeholder="Enter your email or phone number">
                    @error('email')
                        <div style="color: red; font-size: 14px;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input id="password" name="password" type="password" placeholder="Enter your password">
                        <span class="toggle-password" onclick="togglePasswordVisibility()">👁️</span>
                    </div>
                    @error('password')
                        <div style="color: red; font-size: 14px;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <a class="forgot-password" href="#">Forgot password</a>

                <button type="submit">Log In</button>
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
