@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="/css/auth.css">
@endpush

@section('content')
    <div class="avatar-page-container">
        <div class="avatar-page-wrapper">
            <div class="avatar-header">
                <div class="avatar-back-btn-container">
                    <a class="back-btn" href="{{ route('register.profile') }}">
                        @svg('heroicon-o-arrow-left', 'back-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                    </a>
                </div>
                <div class="avatar-progress-indicator" id="progressIndicator">
                    <div class="progress-circle">
                        <svg viewBox="0 0 50 50">
                            <circle class="progress-bg" cx="25" cy="25" r="20"></circle>
                            <circle class="progress-fill" cx="25" cy="25" r="20" stroke-dasharray="0 125.6"
                                id="progressCircle"></circle>
                        </svg>
                        <div class="progress-number" id="progressNumber">0</div>
                    </div>
                </div>
            </div>

            <div class="avatar-main-content">
                <div class="avatar-icon-container">
                    <img src="/img/Closed mailbox with raised flag.png" alt="mailbox icon" class="avatar-icon" />
                </div>
                <div class="avatar-title">
                    {{ __('client/auth.register_flow.avatar.title') }}
                </div>

                <div class="avatar-card">
                    <div class="avatar-card-content">
                        <div class="avatar-preview-container">
                            <img id="avatarPreview" src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="avatar"
                                class="avatar-preview">
                            <button id="removeAvatarBtn" type="button" class="avatar-remove-btn">&times;</button>
                        </div>
                        <div class="avatar-card-title">
                            {{ __('client/auth.register_flow.avatar.add_avatar') }}
                        </div>
                        <div class="avatar-description">
                            {{ __('client/auth.register_flow.avatar.avatar_description') }}
                        </div>
                        <input type="file" id="avatarInput" name="avatar" accept="image/*" class="avatar-input">
                        <button type="button" id="attachPhotoBtn" class="avatar-attach-btn">
                            {{ __('client/auth.register_flow.avatar.attach_photo') }}
                        </button>
                    </div>
                </div>
                <button id="continueBtn" class="avatar-continue-btn">
                    {{ __('client/auth.register_flow.avatar.continue') }}
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Progress Indicator function
        function initProgressIndicator(currentStep, totalSteps = 5) {
            const circle = document.getElementById('progressCircle');
            const numberEl = document.getElementById('progressNumber');
            const circumference = 2 * Math.PI * 20; // radius = 20

            if (!circle || !numberEl) return;

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

        document.addEventListener('DOMContentLoaded', function () {
            // Initialize progress indicator
            initProgressIndicator(5);

            // Cache DOM elements
            const elements = {
                avatarInput: document.getElementById('avatarInput'),
                avatarPreview: document.getElementById('avatarPreview'),
                attachPhotoBtn: document.getElementById('attachPhotoBtn'),
                removeAvatarBtn: document.getElementById('removeAvatarBtn'),
                continueBtn: document.getElementById('continueBtn')
            };

            const defaultAvatar = 'https://cdn-icons-png.flaticon.com/512/847/847969.png';

            // Attach photo button click handler
            if (elements.attachPhotoBtn && elements.avatarInput) {
                elements.attachPhotoBtn.addEventListener('click', () => {
                    elements.avatarInput.click();
                });
            }

            // Avatar input change handler
            if (elements.avatarInput && elements.avatarPreview) {
                elements.avatarInput.addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (ev) {
                            elements.avatarPreview.src = ev.target.result;
                            if (elements.removeAvatarBtn) {
                                elements.removeAvatarBtn.style.display = 'flex';
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Remove avatar button click handler
            if (elements.removeAvatarBtn && elements.avatarPreview && elements.avatarInput) {
                elements.removeAvatarBtn.addEventListener('click', function () {
                    elements.avatarPreview.src = defaultAvatar;
                    elements.avatarInput.value = '';
                    elements.removeAvatarBtn.style.display = 'none';
                });
            }

            // Initialize remove button visibility
            if (elements.avatarPreview && elements.removeAvatarBtn) {
                if (elements.avatarPreview.src === defaultAvatar) {
                    elements.removeAvatarBtn.style.display = 'none';
                }
            }

            // Continue button handler (if needed for navigation)
            if (elements.continueBtn) {
                elements.continueBtn.addEventListener('click', function () {
                    // Add any form submission or navigation logic here
                    console.log('Continue button clicked');
                });
            }
        });
    </script>
@endpush