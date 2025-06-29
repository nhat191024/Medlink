@extends('layouts.app')

@section('content')
<div style="min-height:100vh; background:#f3fdf4; display:flex; flex-direction:column; align-items:center; justify-content:flex-start;">
    <div style="width:100vw; max-width:100vw; margin-top:32px;">
        <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:70vh;">
            <div style="background:rgba(255,255,255,0.7); border-radius:32px; box-shadow:0 8px 40px rgba(0,0,0,0.06); padding:56px 38px 44px 38px; min-width:340px; max-width:99vw; width:600px; text-align:center; position:relative;">
                <div style="display:flex; flex-direction:column; align-items:center; gap:22px;">
                    <!-- Success Circle with Icon -->
                    <div style="position:relative; width:140px; height:140px; margin:0 auto;">
                        <svg width="140" height="140" viewBox="0 0 140 140">
                            <circle cx="70" cy="70" r="60" stroke="#d1f7d6" stroke-width="12" fill="none"/>
                            <circle cx="70" cy="70" r="60" stroke="#22c55e" stroke-width="12" fill="none" stroke-linecap="round" stroke-dasharray="377" stroke-dashoffset="0"/>
                        </svg>
                        <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);">
                            <!-- Success SVG -->
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="24" cy="24" r="24" fill="#e6fbe9"/>
                                <path d="M16 25L22 31L33 19" stroke="#22c55e" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    <div style="font-size:2rem; font-weight:700; color:#22c55e; margin-top:8px;">Hooray!!!</div>
                    <div style="font-size:1.18rem; font-weight:600; color:#222; margin-top:8px;">You have successfully created an account.</div>
                    <div style="color:#888; font-size:1.04rem; max-width:420px; text-align:center; margin:0 auto;">Welcome to Medlink! You can now explore all features and services.</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Confetti Canvas -->
    <canvas id="confettiCanvas" style="position:fixed; top:0; left:0; width:100vw; height:100vh; pointer-events:none; z-index:999;"></canvas>
</div>
<script>
// Confetti animation
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
@endsection 