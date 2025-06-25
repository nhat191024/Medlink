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

            <div class="back-btn-container">
                <a class="back-btn" href="{{ route('forgot-password') }}">
                    @svg('heroicon-o-arrow-left', 'back-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                </a>
            </div>

            <img src="{{ asset('img/lock.png') }}" alt="Lock Icon" style="width: 48px; height: auto;">

            <h1>Create new password</h1>
            <p class="description" style="margin-bottom: 2rem; color: #666;">Password should have at least 8 characters, include of 6 alphabets, 1 number and 1 special character</p>

            <div class="form-group">
                <div class="input-icon-group">
                    <input id="password" name="password" type="password">
                    <label for="password">Password</label>
                    <button class="toggle-password-btn" type="button" onclick="togglePassword('password')">
                        @svg('heroicon-o-eye', 'toggle-password-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                    </button>
                </div>
            </div>

            <div class="form-group">
                <div class="input-icon-group">
                    <input id="password_confirmation" name="password_confirmation" type="password">
                    <label for="password_confirmation">Confirm Password</label>
                    <button class="toggle-password-btn" type="button" onclick="togglePassword('password_confirmation')">
                        @svg('heroicon-o-eye', 'toggle-password-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                    </button>
                </div>
            </div>

            <button class="login-btn" type="submit">Reset password</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('#password, #password_confirmation');
            inputs.forEach(function(input) {
                updateHasValueClass(input);
                input.addEventListener('input', function() {
                    updateHasValueClass(input);
                });
            });
        });
    </script>
@endpush 