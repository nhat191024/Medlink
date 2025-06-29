@extends('layouts.app')

@section('content')
<div style="min-height:100vh; background:#fafbfc; display:flex; flex-direction:column; align-items:center; justify-content:flex-start;">
    <div style="width:100vw; max-width:100vw; position:relative; margin-top:32px;">
        <!-- Nút Back góc trái -->
        <div style="position:absolute; top:0; left:32px; z-index:10;">
            <a href="/" style="display:flex; align-items:center; justify-content:center; width:44px; height:44px; background:#fff; border-radius:50%; box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                @svg('heroicon-o-arrow-left', 'back-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
            </a>
        </div>
        <!-- Nút Skip góc phải -->
        <div style="position:absolute; top:12px; right:60px; z-index:10;">
            <button id="skipBtn" style="background:transparent; border:none; color:#888; font-size:1.08rem; font-weight:500; cursor:pointer;">Skip</button>
        </div>
        <!-- Nội dung chính -->
        <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; margin-top:32px;">
            <!-- Icon y tế nhỏ ở giữa -->
            <div style="font-size:2.2rem; color:#3b82f6; margin-bottom:8px;">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="24" height="24" rx="6" fill="#3b82f6"/><path d="M12 7V17" stroke="white" stroke-width="2" stroke-linecap="round"/><path d="M7 12H17" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>
            </div>
            <div style="font-size:1.45rem; font-weight:700; margin-bottom:32px; text-align:center;">Complete your profile</div>
            <!-- Khung trắng bo góc bóng đổ lớn -->
            <div style="background:#fff; border-radius:32px; box-shadow:0 8px 40px rgba(0,0,0,0.10); padding:56px 38px 44px 38px; min-width:340px; max-width:99vw; width:760px; text-align:center; position:relative; margin-bottom:48px;">
                <div style="display:flex; flex-direction:column; align-items:center; gap:22px;">
                    <div style="position:relative; width:108px; height:108px; margin:0 auto;">
                        <img id="avatarPreview" src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="avatar" style="width:108px; height:108px; border-radius:50%; object-fit:cover; background:#f3f3f3; border:2.5px solid #f3f3f3;">
                        <button id="removeAvatarBtn" type="button" style="display:none; position:absolute; top:-12px; right:-12px; background:#fff; border:1.5px solid #eee; border-radius:50%; width:32px; height:32px; cursor:pointer; box-shadow:0 2px 8px rgba(0,0,0,0.08); font-size:20px; color:#b91c1c; align-items:center; justify-content:center;">&times;</button>
                    </div>
                    <div style="font-size:1.15rem; font-weight:700; margin-top:8px;">Add your avatar</div>
                    <div style="color:#888; font-size:1.04rem; margin-bottom:8px; max-width:520px; text-align:center; margin-left:auto; margin-right:auto;">Avatar must be an actual photo of you. Logo, clip-art, group photos and digitally altered images are not allowed.</div>
                    <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display:none;">
                    <button type="button" id="attachPhotoBtn" style="background:#df1d32; color:#fff; border:none; border-radius:999px; padding:12px 32px; font-size:1.08rem; font-weight:500; cursor:pointer; margin-top:8px;">Attach photo</button>
                </div>
            </div>
            <button id="continueBtn" style="background:#111; color:#fff; border:none; border-radius:999px; padding:18px 0; font-size:1.15rem; font-weight:700; width:340px; margin:0 auto; display:block;">Continue</button>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const avatarInput = document.getElementById('avatarInput');
    const avatarPreview = document.getElementById('avatarPreview');
    const attachPhotoBtn = document.getElementById('attachPhotoBtn');
    const removeAvatarBtn = document.getElementById('removeAvatarBtn');
    const defaultAvatar = 'https://cdn-icons-png.flaticon.com/512/847/847969.png';
    const continueBtn = document.getElementById('continueBtn');
    const skipBtn = document.getElementById('skipBtn');

    if (attachPhotoBtn && avatarInput) {
        attachPhotoBtn.addEventListener('click', function() {
            avatarInput.click();
        });
    }
    if (avatarInput && avatarPreview) {
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    avatarPreview.src = ev.target.result;
                    if (removeAvatarBtn) removeAvatarBtn.style.display = 'flex';
                };
                reader.readAsDataURL(file);
            }
        });
    }
    if (removeAvatarBtn && avatarPreview && avatarInput) {
        removeAvatarBtn.addEventListener('click', function() {
            avatarPreview.src = defaultAvatar;
            avatarInput.value = '';
            removeAvatarBtn.style.display = 'none';
        });
    }
    // Ẩn nút xóa nếu là avatar mặc định
    if (avatarPreview && removeAvatarBtn) {
        if (avatarPreview.src === defaultAvatar) {
            removeAvatarBtn.style.display = 'none';
        }
    }
    // Chuyển sang profile khi bấm Continue hoặc Skip
    if (continueBtn) {
        continueBtn.addEventListener('click', function() {
            window.location.href = '/profile';
        });
    }
    if (skipBtn) {
        skipBtn.addEventListener('click', function() {
            window.location.href = '/profile';
        });
    }
});
</script>
@endsection 