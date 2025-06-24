@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <div class="left">
            <img class="doctor-img" src="{{ asset('img/doctor.webp') }}" alt="Doctor">
        </div>

        <form class="right" method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="back-btn-container">
                <a class="back-btn" href="{{ route('splash') }}">
                    @svg('heroicon-o-arrow-left', 'back-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                </a>
            </div>

            <img class="logo" src="{{ asset('img/logo.svg') }}" alt="Logo">

            <h1>{{ __('client/auth.welcome') }}</h1>

            @if (session('status'))
                <div class="alert alert-success" style="color: green; margin-bottom: 1rem; text-align: center;">
                    {{ session('status') }}
                </div>
            @endif

            <div class="form-group {{ old('email') ? 'has-value' : '' }}">
                <input id="email" name="email" type="text" value="{{ old('email') }}">
                <label for="email">{{ __('client/auth.fields.label.login') }}</label>

                @error('email')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <div class="input-icon-group">
                    <input id="password" name="password" type="password">
                    <label for="password">{{ __('client/auth.fields.label.password') }}</label>
                    <button class="toggle-password-btn" type="button" onclick="togglePassword()">
                        @svg('heroicon-o-eye', 'toggle-password-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                    </button>
                </div>
                @error('password')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <a class="forgot-password" href="{{ route('forgot-password') }}">{{ __('client/auth.forgot_password') }}</a>

            <button class="login-btn" type="submit">{{ __('client/auth.button.login') }}</button>
        </form>

    </div>
@endsection

@push('scripts')
    <script>
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

        // Auto label floating for input fields
        function updateHasValueClass(input) {
            const formGroup = input.closest('.form-group');
            if (input.value) {
                formGroup.classList.add('has-value');
            } else {
                formGroup.classList.remove('has-value');
            }
        }
        document.addEventListener('DOMContentLoaded', function () {
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            [emailInput, passwordInput].forEach(function (input) {
                updateHasValueClass(input);
                input.addEventListener('input', function () {
                    updateHasValueClass(input);
                });
            });
        });
    </script>
@endpush