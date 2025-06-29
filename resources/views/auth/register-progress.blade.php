@extends('layouts.app')

@section('content')
<div style="min-height:100vh; background:#fdf3f4; display:flex; flex-direction:column; align-items:center; justify-content:flex-start;">
    <div style="width:100vw; max-width:100vw; margin-top:32px;">
        <!-- Navbar giữ nguyên nếu có -->
        <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:70vh;">
            <div style="background:rgba(255,255,255,0.6); border-radius:32px; box-shadow:0 8px 40px rgba(0,0,0,0.06); padding:56px 38px 44px 38px; min-width:340px; max-width:99vw; width:600px; text-align:center; position:relative;">
                <div style="display:flex; flex-direction:column; align-items:center; gap:22px;">
                    <!-- Progress Circle with Rocket Icon -->
                    <div style="position:relative; width:140px; height:140px; margin:0 auto;">
                        <svg id="progressSvg" width="140" height="140" viewBox="0 0 140 140">
                            <circle cx="70" cy="70" r="60" stroke="#f8d7da" stroke-width="12" fill="none"/>
                            <circle id="progressCircle" cx="70" cy="70" r="60" stroke="#df1d32" stroke-width="12" fill="none" stroke-linecap="round" stroke-dasharray="377" stroke-dashoffset="377"/>
                        </svg>
                        <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);">
                            <!-- Rocket SVG -->
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="24" cy="24" r="24" fill="#fff0f1"/>
                                <path d="M24 12L28 28L24 26L20 28L24 12Z" fill="#df1d32"/>
                                <circle cx="24" cy="22" r="2" fill="#fff"/>
                            </svg>
                        </div>
                    </div>
                    <div id="progressPercent" style="font-size:2rem; font-weight:700; color:#df1d32; margin-top:8px;">0%</div>
                    <div style="font-size:1.18rem; font-weight:600; color:#222; margin-top:8px;">Assembling Information</div>
                    <div style="color:#888; font-size:1.04rem; max-width:420px; text-align:center; margin:0 auto;">Your account is being created!</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Progress animation
let percent = 0;
const percentEl = document.getElementById('progressPercent');
const circle = document.getElementById('progressCircle');
const total = 377; // circumference
function animateProgress() {
    if(percent <= 100) {
        percentEl.textContent = percent + '%';
        circle.style.strokeDashoffset = total - (percent/100)*total;
        percent++;
        setTimeout(animateProgress, 22); // tốc độ
    } else {
        // Chuyển sang màn complete sau 1s
        setTimeout(function(){ window.location.href = '/register-complete'; }, 1000);
    }
}
animateProgress();
</script>
@endsection 