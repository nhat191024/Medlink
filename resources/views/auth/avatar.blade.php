@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="/css/auth.css">
@endpush

@section('content')
    <div
        style="min-height:100vh; background:#fafbfc; display:flex; flex-direction:column; align-items:center; justify-content:flex-start;">
        <div style="width:100%; max-width:100%; position:relative; margin-top:0;">
            <div style="position:relative; width:100%; height:64px;">
                <div class="back-btn-container" style="position:absolute; top:18px; left:24px; z-index:10;">
                    <a class="back-btn" href="{{ route('splash') }}">
                        @svg('heroicon-o-arrow-left', 'back-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                    </a>
                </div>
                <div class="progress-indicator" id="progressIndicator"
                    style="position:absolute; top:18px; right:32px; z-index:10;">
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
            <!-- Nội dung chính -->
            <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; margin-top:32px;">
                <!-- Icon y tế nhỏ ở giữa -->
                <div style="margin-bottom:8px; display:flex; justify-content:center; align-items:center;">
                    <img src="/img/Closed mailbox with raised flag.png" alt="mailbox icon"
                        style="width:38px; height:38px; object-fit:contain; display:block;" />
                </div>
                <div style="font-size:1.45rem; font-weight:700; margin-bottom:32px; text-align:center;">
                    {{ __('client/auth.register_flow.avatar.title') }}
                </div>
                <!-- Khung trắng bo góc bóng đổ lớn -->
                <div
                    style="background:#fff; border-radius:32px; box-shadow:0 8px 40px rgba(0,0,0,0.10); padding:56px 38px 44px 38px; min-width:340px; max-width:99vw; width:760px; text-align:center; position:relative; margin-bottom:48px;">
                    <div style="display:flex; flex-direction:column; align-items:center; gap:22px;">
                        <div style="position:relative; width:108px; height:108px; margin:0 auto;">
                            <img id="avatarPreview" src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="avatar"
                                style="width:108px; height:108px; border-radius:50%; object-fit:cover; background:#f3f3f3; border:2.5px solid #f3f3f3;">
                            <button id="removeAvatarBtn" type="button"
                                style="display:none; position:absolute; top:-12px; right:-12px; background:#fff; border:1.5px solid #eee; border-radius:50%; width:32px; height:32px; cursor:pointer; box-shadow:0 2px 8px rgba(0,0,0,0.08); font-size:20px; color:#b91c1c; align-items:center; justify-content:center;">&times;</button>
                        </div>
                        <div style="font-size:1.15rem; font-weight:700; margin-top:18px; margin-bottom:12px;">
                            {{ __('client/auth.register_flow.avatar.add_avatar') }}
                        </div>
                        <div
                            style="color:#888; font-size:1.04rem; margin-bottom:22px; max-width:520px; text-align:center; margin-left:auto; margin-right:auto; line-height:1.6;">
                            {{ __('client/auth.register_flow.avatar.avatar_description') }}
                        </div>
                        <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display:none;">
                        <button type="button" id="attachPhotoBtn"
                            style="background:#df1d32; color:#fff; border:none; border-radius:999px; padding:12px 32px; font-size:1.08rem; font-weight:500; cursor:pointer; margin-top:8px;">{{ __('client/auth.register_flow.avatar.attach_photo') }}</button>
                    </div>
                </div>
                <button id="continueBtn"
                    style="background:#111; color:#fff; border:none; border-radius:999px; padding:18px 0; font-size:1.15rem; font-weight:700; width:340px; margin:0 auto; display:block;">{{ __('client/auth.register_flow.avatar.continue') }}</button>
            </div>
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

        document.addEventListener('DOMContentLoaded', function () {
            initProgressIndicator(5);

            const avatarInput = document.getElementById('avatarInput');
            const avatarPreview = document.getElementById('avatarPreview');
            const attachPhotoBtn = document.getElementById('attachPhotoBtn');
            const removeAvatarBtn = document.getElementById('removeAvatarBtn');
            const defaultAvatar = 'https://cdn-icons-png.flaticon.com/512/847/847969.png';
            const continueBtn = document.getElementById('continueBtn');
            const skipBtn = document.getElementById('skipBtn');

            if (attachPhotoBtn && avatarInput) {
                attachPhotoBtn.addEventListener('click', function () {
                    avatarInput.click();
                });
            }
            if (avatarInput && avatarPreview) {
                avatarInput.addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (ev) {
                            avatarPreview.src = ev.target.result;
                            if (removeAvatarBtn) removeAvatarBtn.style.display = 'flex';
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
            if (removeAvatarBtn && avatarPreview && avatarInput) {
                removeAvatarBtn.addEventListener('click', function () {
                    avatarPreview.src = defaultAvatar;
                    avatarInput.value = '';
                    removeAvatarBtn.style.display = 'none';
                });
            }
            if (avatarPreview && removeAvatarBtn) {
                if (avatarPreview.src === defaultAvatar) {
                    removeAvatarBtn.style.display = 'none';
                }
            }
        });
    </script>
@endpush