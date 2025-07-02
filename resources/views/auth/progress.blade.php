@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="/css/auth.css">
@endpush

@section('content')
    <div style="min--height:70vh;">
        <div
            style="display:flex; flex-direction:column; align-items:ceheight:100vh; background:#fdf3f4; display:flex; flex-direction:column; align-items:center; justify-content:center;">
            <div
                style="display:flex; flex-direction:column; align-items:center; justify-content:center; minnter; gap:22px;">
                <div style="position:relative; width:140px; height:140px; margin:0 auto;">
                    <svg id="progressSvg" width="140" height="140" viewBox="0 0 140 140">
                        <circle cx="70" cy="70" r="60" stroke="#f8d7da" stroke-width="12" fill="none" />
                        <circle id="progressCircle" cx="70" cy="70" r="60" stroke="#df1d32" stroke-width="12" fill="none"
                            stroke-linecap="round" stroke-dasharray="377" stroke-dashoffset="377" />
                    </svg>
                    <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);">
                        <div
                            style="background:#fff; border-radius:50%; width:72px; height:72px; display:flex; align-items:center; justify-content:center;">
                            <img src="/img/logo.svg" alt="Logo" style="width:48px; height:48px;">
                        </div>
                    </div>
                </div>
                <div id="progressPercent" style="font-size:2rem; font-weight:700; color:#df1d32; margin-top:8px;">0%</div>
                <div style="font-size:1.18rem; font-weight:600; color:#222; margin-top:8px;">
                    {{ __('client/auth.register_flow.progress.assembling_information') }}
                </div>
                <div style="color:#888; font-size:1.04rem; max-width:420px; text-align:center; margin:0 auto;">
                    {{ __('client/auth.register_flow.progress.account_creating') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let percent = 0;
        const percentEl = document.getElementById('progressPercent');
        const circle = document.getElementById('progressCircle');
        const total = 377;
        function animateProgress() {
            if (percent <= 100) {
                percentEl.textContent = percent + '%';
                circle.style.strokeDashoffset = total - (percent / 100) * total;
                percent++;
                setTimeout(animateProgress, 22);
            } else {
                console.log('Progress complete');
            }
        }
        animateProgress();
    </script>
@endpush