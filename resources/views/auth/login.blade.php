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

            {{-- EMAIL --}}
            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    placeholder="Type your email">
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
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        placeholder="Enter your password">
                    <span class="toggle-password" onclick="togglePasswordVisibility()">👁️</span>
                </div>
                @error('password')
                    <div style="color: red; font-size: 14px;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <a href="#" class="forgot-password">Forgot password</a>
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
