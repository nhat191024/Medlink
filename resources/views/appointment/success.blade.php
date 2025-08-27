@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/appointment/success.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add confetti animation after page load
            function createConfetti() {
                const container = document.querySelector('.success-container');
                for (let i = 0; i < 5; i++) {
                    const confetti = document.createElement('div');
                    confetti.classList.add('confetti');
                    confetti.style.left = Math.random() * 100 + '%';
                    confetti.style.animationDelay = Math.random() * 3 + 's';
                    confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
                    container.appendChild(confetti);

                    // Remove confetti after animation
                    setTimeout(() => {
                        if (confetti.parentNode) {
                            confetti.remove();
                        }
                    }, 5000);
                }
            }

            // Start confetti after 1 second
            setTimeout(createConfetti, 1000);

            // Add click sound effect for buttons
            const buttons = document.querySelectorAll('.btn-success');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    // Add a subtle click animation
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 100);
                });
            });

            // Show success message in console
            console.log('🎉 Appointment booked successfully!');
        });
    </script>
@endpush

@section('content')
    <div class="success-container">
        <div class="success-card">
            <div class="success-icon"></div>

            <h1 class="success-title">Chúc mừng!</h1>
            <p class="success-subtitle">Cuộc hẹn đã được đặt thành công</p>
            <p class="success-description">
                Chúng tôi đã gửi thông tin chi tiết về cuộc hẹn qua email.
                Vui lòng kiểm tra hộp thư để biết thêm chi tiết.
            </p>

            <div class="appointment-details">
                <div class="detail-item">
                    <div class="detail-icon service-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Dịch vụ</div>
                        <div class="detail-value">{{ session('serviceName', 'Khám tổng quát') }}</div>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-icon time-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Thời gian</div>
                        <div class="detail-value">
                            {{ session('date', 'Chưa xác định') }}<br>
                            <span style="color: #6b7280; font-size: 1rem;">{{ session('time', 'Chưa xác định') }}</span>
                        </div>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-icon location-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Địa điểm</div>
                        <div class="detail-value">Phòng khám MedLink</div>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <a class="btn-success btn-success-secondary" href="{{ route('home') }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Quay lại trang chủ
                </a>
                <a class="btn-success btn-success-primary" href="#" onclick="window.print(); return false;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    In thông tin
                </a>
            </div>
        </div>
    </div>
@endsection
