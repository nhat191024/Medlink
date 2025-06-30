@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="/css/auth.css">
@endpush

@section('content')
@if($step === 'avatar')
<div style="min-height:100vh; background:#fafbfc; display:flex; flex-direction:column; align-items:center; justify-content:flex-start;">
    <div style="width:100%; max-width:100%; position:relative; margin-top:0;">
        <div style="position:relative; width:100%; height:64px;">
            <div class="back-btn-container" style="position:absolute; top:18px; left:24px; z-index:10;">
                <a class="back-btn" href="{{ route('splash') }}">
                    @svg('heroicon-o-arrow-left', 'back-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                </a>
            </div>
            <div class="progress-indicator" id="progressIndicator" style="position:absolute; top:18px; right:32px; z-index:10;">
                <div class="progress-circle">
                    <svg viewBox="0 0 50 50">
                        <circle class="progress-bg" cx="25" cy="25" r="20"></circle>
                        <circle class="progress-fill" cx="25" cy="25" r="20" stroke-dasharray="0 125.6" id="progressCircle"></circle>
                    </svg>
                    <div class="progress-number" id="progressNumber">0</div>
                </div>
            </div>
        </div>
        <!-- Nội dung chính -->
        <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; margin-top:32px;">
            <!-- Icon y tế nhỏ ở giữa -->
            <div style="margin-bottom:8px; display:flex; justify-content:center; align-items:center;">
                <img src="/img/Closed mailbox with raised flag.png" alt="mailbox icon" style="width:38px; height:38px; object-fit:contain; display:block;" />
            </div>
            <div style="font-size:1.45rem; font-weight:700; margin-bottom:32px; text-align:center;">{{ __('client/auth.register_flow.avatar.title') }}</div>
            <!-- Khung trắng bo góc bóng đổ lớn -->
            <div style="background:#fff; border-radius:32px; box-shadow:0 8px 40px rgba(0,0,0,0.10); padding:56px 38px 44px 38px; min-width:340px; max-width:99vw; width:760px; text-align:center; position:relative; margin-bottom:48px;">
                <div style="display:flex; flex-direction:column; align-items:center; gap:22px;">
                    <div style="position:relative; width:108px; height:108px; margin:0 auto;">
                        <img id="avatarPreview" src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="avatar" style="width:108px; height:108px; border-radius:50%; object-fit:cover; background:#f3f3f3; border:2.5px solid #f3f3f3;">
                        <button id="removeAvatarBtn" type="button" style="display:none; position:absolute; top:-12px; right:-12px; background:#fff; border:1.5px solid #eee; border-radius:50%; width:32px; height:32px; cursor:pointer; box-shadow:0 2px 8px rgba(0,0,0,0.08); font-size:20px; color:#b91c1c; align-items:center; justify-content:center;">&times;</button>
                    </div>
                    <div style="font-size:1.15rem; font-weight:700; margin-top:18px; margin-bottom:12px;">{{ __('client/auth.register_flow.avatar.add_avatar') }}</div>
                    <div style="color:#888; font-size:1.04rem; margin-bottom:22px; max-width:520px; text-align:center; margin-left:auto; margin-right:auto; line-height:1.6;">{{ __('client/auth.register_flow.avatar.avatar_description') }}</div>
                    <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display:none;">
                    <button type="button" id="attachPhotoBtn" style="background:#df1d32; color:#fff; border:none; border-radius:999px; padding:12px 32px; font-size:1.08rem; font-weight:500; cursor:pointer; margin-top:8px;">{{ __('client/auth.register_flow.avatar.attach_photo') }}</button>
                </div>
            </div>
            <button id="continueBtn" style="background:#111; color:#fff; border:none; border-radius:999px; padding:18px 0; font-size:1.15rem; font-weight:700; width:340px; margin:0 auto; display:block;">{{ __('client/auth.register_flow.avatar.continue') }}</button>
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
    if (avatarPreview && removeAvatarBtn) {
        if (avatarPreview.src === defaultAvatar) {
            removeAvatarBtn.style.display = 'none';
        }
    }
    // Chuyển sang màn progress khi bấm Continue hoặc Skip
    if (continueBtn) {
        continueBtn.addEventListener('click', function() {
            window.location.href = '/register-flow/progress';
        });
    }
    if (skipBtn) {
        skipBtn.addEventListener('click', function() {
            window.location.href = '/register-flow/progress';
        });
    }
});
</script>
@endif
@if($step === 'progress')
<div style="min-height:100vh; background:#fdf3f4; display:flex; flex-direction:column; align-items:center; justify-content:center;">
    <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:70vh;">
        <div style="display:flex; flex-direction:column; align-items:center; gap:22px;">
            <div style="position:relative; width:140px; height:140px; margin:0 auto;">
                <svg id="progressSvg" width="140" height="140" viewBox="0 0 140 140">
                    <circle cx="70" cy="70" r="60" stroke="#f8d7da" stroke-width="12" fill="none"/>
                    <circle id="progressCircle" cx="70" cy="70" r="60" stroke="#df1d32" stroke-width="12" fill="none" stroke-linecap="round" stroke-dasharray="377" stroke-dashoffset="377"/>
                </svg>
                <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);">
                    <div style="background:#fff; border-radius:50%; width:72px; height:72px; display:flex; align-items:center; justify-content:center;">
                        <img src="/img/logo.svg" alt="Logo" style="width:48px; height:48px;">
                    </div>
                </div>
            </div>
            <div id="progressPercent" style="font-size:2rem; font-weight:700; color:#df1d32; margin-top:8px;">0%</div>
            <div style="font-size:1.18rem; font-weight:600; color:#222; margin-top:8px;">{{ __('client/auth.register_flow.progress.assembling_information') }}</div>
            <div style="color:#888; font-size:1.04rem; max-width:420px; text-align:center; margin:0 auto;">{{ __('client/auth.register_flow.progress.account_creating') }}</div>
        </div>
    </div>
</div>
<script>
let percent = 0;
const percentEl = document.getElementById('progressPercent');
const circle = document.getElementById('progressCircle');
const total = 377;
function animateProgress() {
    if(percent <= 100) {
        percentEl.textContent = percent + '%';
        circle.style.strokeDashoffset = total - (percent/100)*total;
        percent++;
        setTimeout(animateProgress, 22);
    } else {
        setTimeout(function(){ window.location.href = '/register-flow/complete'; }, 1000);
    }
}
animateProgress();
</script>
@endif
@if($step === 'complete')
<div style="min-height:100vh; background:#f3fdf4; display:flex; flex-direction:column; align-items:center; justify-content:center;">
    <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:70vh;">
        <div style="display:flex; flex-direction:column; align-items:center; gap:22px;">
            <div style="position:relative; width:140px; height:140px; margin:0 auto;">
                <svg width="140" height="140" viewBox="0 0 140 140">
                    <circle cx="70" cy="70" r="60" stroke="#d1f7d6" stroke-width="12" fill="none"/>
                    <circle cx="70" cy="70" r="60" stroke="#22c55e" stroke-width="12" fill="none" stroke-linecap="round" stroke-dasharray="377" stroke-dashoffset="0"/>
                </svg>
                <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="24" cy="24" r="24" fill="#e6fbe9"/>
                        <path d="M16 25L22 31L33 19" stroke="#22c55e" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
            <div style="font-size:2rem; font-weight:700; color:#22c55e; margin-top:8px;">{{ __('client/auth.register_flow.complete.hooray') }}</div>
            <div style="font-size:1.18rem; font-weight:600; color:#222; margin-top:8px;">{{ __('client/auth.register_flow.complete.success_message') }}</div>
            <div style="color:#888; font-size:1.04rem; max-width:420px; text-align:center; margin:0 auto;">{{ __('client/auth.register_flow.complete.welcome_message') }}</div>
        </div>
    </div>
    <canvas id="confettiCanvas" style="position:fixed; top:0; left:0; width:100vw; height:100vh; pointer-events:none; z-index:999;"></canvas>
</div>
<script>
const canvas = document.getElementById('confettiCanvas');
const ctx = canvas.getContext('2d');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;
window.addEventListener('resize', () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
});
const colors = ['#fbbf24','#22c55e','#3b82f6','#ef4444','#a78bfa','#f472b6','#facc15','#38bdf8','#34d399','#f87171'];
function randomColor() { return colors[Math.floor(Math.random()*colors.length)]; }
function ConfettiParticle() {
    this.x = Math.random()*canvas.width;
    this.y = Math.random()*-canvas.height;
    this.r = 6+Math.random()*10;
    this.d = Math.random()*canvas.height/2;
    this.color = randomColor();
    this.tilt = Math.floor(Math.random()*10)-10;
    this.tiltAngleIncremental = (Math.random()*0.07)+.05;
    this.tiltAngle = 0;
}
ConfettiParticle.prototype.draw = function() {
    ctx.beginPath();
    ctx.lineWidth = this.r;
    ctx.strokeStyle = this.color;
    ctx.moveTo(this.x+this.tilt+this.r/3, this.y);
    ctx.lineTo(this.x+this.tilt, this.y+this.tilt+this.r/5);
    ctx.stroke();
}
let particles = [];
for(let i=0;i<120;i++) particles.push(new ConfettiParticle());
function draw() {
    ctx.clearRect(0,0,canvas.width,canvas.height);
    for(let i=0;i<particles.length;i++) {
        particles[i].draw();
    }
    update();
}
function update() {
    for(let i=0;i<particles.length;i++) {
        let p = particles[i];
        p.y += (Math.cos(p.d)+3+ p.r/2)/2;
        p.x += Math.sin(0.01*p.d);
        p.tiltAngle += p.tiltAngleIncremental;
        p.tilt = Math.sin(p.tiltAngle- (i%3))*15;
        if(p.y > canvas.height) {
            p.x = Math.random()*canvas.width;
            p.y = -10;
            p.tilt = Math.floor(Math.random()*10)-10;
        }
    }
}
(function animateConfetti(){
    draw();
    requestAnimationFrame(animateConfetti);
})();
</script>
@endif
@endsection 