@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="/css/auth.css">
@endpush

@section('content')
    <div class="complete-page-container">
        <div class="complete-main-wrapper">
            <div class="complete-content">
                <div class="complete-circle-container">
                    <svg class="complete-svg" viewBox="0 0 140 140">
                        <circle cx="70" cy="70" r="60" class="complete-bg-circle" />
                        <circle cx="70" cy="70" r="60" class="complete-fill-circle" />
                    </svg>
                    <div class="complete-checkmark-container">
                        <svg class="complete-checkmark-svg" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="24" cy="24" r="24" class="complete-checkmark-bg" />
                            <path d="M16 25L22 31L33 19" class="complete-checkmark-icon" />
                        </svg>
                    </div>
                </div>
                <div class="complete-hooray-text">
                    {{ __('client/auth.register_flow.complete.hooray') }}
                </div>
                <div class="complete-success-message">
                    {{ __('client/auth.register_flow.complete.success_message') }}
                </div>
                <div class="complete-welcome-message">
                    {{ __('client/auth.register_flow.complete.welcome_message') }}
                </div>
            </div>
        </div>
        <canvas id="confettiCanvas" class="complete-confetti-canvas"></canvas>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Confetti configuration
            const config = {
                particleCount: 120,
                colors: ['#fbbf24', '#22c55e', '#3b82f6', '#ef4444', '#a78bfa', '#f472b6', '#facc15', '#38bdf8', '#34d399', '#f87171']
            };

            // Cache DOM elements
            const canvas = document.getElementById('confettiCanvas');
            const ctx = canvas.getContext('2d');

            // Set initial canvas size
            function resizeCanvas() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
            }

            // Initialize canvas
            resizeCanvas();
            window.addEventListener('resize', resizeCanvas);

            // Utility functions
            function randomColor() {
                return config.colors[Math.floor(Math.random() * config.colors.length)];
            }

            // Confetti Particle class
            class ConfettiParticle {
                constructor() {
                    this.reset();
                    this.y = Math.random() * -canvas.height;
                    this.color = randomColor();
                    this.tiltAngleIncremental = (Math.random() * 0.07) + 0.05;
                    this.tiltAngle = 0;
                }

                reset() {
                    this.x = Math.random() * canvas.width;
                    this.y = -10;
                    this.r = 6 + Math.random() * 10;
                    this.d = Math.random() * canvas.height / 2;
                    this.tilt = Math.floor(Math.random() * 10) - 10;
                }

                draw() {
                    ctx.beginPath();
                    ctx.lineWidth = this.r;
                    ctx.strokeStyle = this.color;
                    ctx.moveTo(this.x + this.tilt + this.r / 3, this.y);
                    ctx.lineTo(this.x + this.tilt, this.y + this.tilt + this.r / 5);
                    ctx.stroke();
                }

                update() {
                    this.y += (Math.cos(this.d) + 3 + this.r / 2) / 2;
                    this.x += Math.sin(0.01 * this.d);
                    this.tiltAngle += this.tiltAngleIncremental;
                    this.tilt = Math.sin(this.tiltAngle) * 15;

                    // Reset particle when it goes off screen
                    if (this.y > canvas.height) {
                        this.reset();
                    }
                }
            }

            // Initialize particles
            const particles = [];
            for (let i = 0; i < config.particleCount; i++) {
                particles.push(new ConfettiParticle());
            }

            // Animation functions
            function draw() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                particles.forEach(particle => {
                    particle.draw();
                    particle.update();
                });
            }

            // Animation loop
            function animateConfetti() {
                draw();
                requestAnimationFrame(animateConfetti);
            }

            // Start animation
            animateConfetti();
        });
    </script>
@endpush
