@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <div class="left">
            <img class="doctor-img" src="{{ asset('img/doctor.webp') }}" alt="Doctor">
        </div>

        <form class="right" method="POST" action="#">
            @csrf

            <img src="{{ asset('img/lock.png') }}" alt="Lock Icon" style="width: 48px; height: auto;">
            <h1>{{ __('client/auth.new_password') }}</h1>
            <p class="description" style="margin-bottom: 2rem; color: #666;">
                {{ __('client/auth.new_password_note') }}
            </p>

            <div class="form-group">
                <div class="input-icon-group">
                    <input id="password" name="password" type="password">
                    <label for="password">{{ __('client/auth.fields.placeholder.password') }}</label>
                    <button class="toggle-password-btn" type="button" onclick="togglePassword('password')">
                        @svg('heroicon-o-eye', 'toggle-password-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                    </button>
                </div>
                @if ($errors->has('password'))
                    <span class="error">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group">
                <div class="input-icon-group">
                    <input id="password_confirmation" name="password_confirmation" type="password">
                    <label for="password_confirmation">{{ __('client/auth.fields.placeholder.confirm_password') }}</label>
                    <button class="toggle-password-btn" type="button" onclick="togglePassword('password_confirmation')">
                        @svg('heroicon-o-eye', 'toggle-password-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                    </button>
                </div>
                @if ($errors->has('password'))
                    <span class="error">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <button class="login-btn" type="submit">{{ __('client/auth.button.reset') }}</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const iconContainer = input.parentElement.querySelector('.toggle-password-btn');
            if (input.type === 'password') {
                input.type = 'text';
                iconContainer.innerHTML = `@svg('heroicon-o-eye-slash', 'toggle-password-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])`;
            } else {
                input.type = 'password';
                iconContainer.innerHTML = `@svg('heroicon-o-eye', 'toggle-password-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])`;
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
            const inputs = document.querySelectorAll('#password, #password_confirmation');
            inputs.forEach(function (input) {
                updateHasValueClass(input);
                input.addEventListener('input', function () {
                    updateHasValueClass(input);
                });
            });
        });
    </script>
@endpush
