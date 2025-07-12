@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/appointment/booking.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="booking-container">
        <div class="booking-stepper">
            <div class="step-block">
                <div class="step active">1</div>
                <span class="step-label">Chọn dịch vụ</span>
            </div>
            <div class="step-line"></div>
            <div class="step-block">
                <div class="step">2</div>
                <span class="step-label">Điền thông tin</span>
            </div>
            <div class="step-line"></div>
            <div class="step-block">
                <div class="step">4</div>
                <span class="step-label">Thanh toán & xác nhận</span>
            </div>
        </div>

        <div class="booking-content-wrapper">
            <div class="booking-title">Book appointment</div>
            <div class="booking-doctor-info">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" class="doctor-avatar" alt="Doctor">
                <div class="doctor-name">Dr. Esther Howard</div>
            </div>

            <div class="booking-card">
                <div class="booking-card__inner">
                    <div class="booking-section-title">Choose services</div>
                    <div class="booking-services">
                        <div class="service-card">
                            <div class="service-icon-circle">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ea1d2c"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 10.5L12 4l9 6.5" />
                                    <path d="M4 10.5V20a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V10.5" />
                                    <rect x="9" y="14" width="6" height="7" rx="1" />
                                </svg>
                            </div>
                            <div class="service-title">Home</div>
                            <div class="service-desc">Doctor visit at home</div>
                            <div class="service-price">150$</div>
                        </div>
                        <div class="service-card selected">
                            <div class="service-icon-circle">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ea1d2c"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="7" width="15" height="10" rx="2" />
                                    <path d="M17 9l4-2v10l-4-2" />
                                </svg>
                            </div>
                            <div class="service-title">Online</div>
                            <div class="service-desc">Make a video call with doctor</div>
                            <div class="service-price">50$</div>
                        </div>
                        <div class="service-card">
                            <div class="service-icon-circle">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ea1d2c"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="7" width="18" height="13" rx="2" />
                                    <path d="M8 7V4h8v3" />
                                    <path d="M12 12v3" />
                                    <path d="M10.5 13.5h3" />
                                </svg>
                            </div>
                            <div class="service-title">Clinic</div>
                            <div class="service-desc">Book an office with doctor</div>
                            <div class="service-price">100$</div>
                        </div>
                    </div>

                    <div class="booking-section-title">Choose time</div>
                    <div class="booking-time">
                        <div class="booking-calendar-header">
                            <span>Sep, 2025</span>
                            <span class="calendar-nav">
                                <button class="calendar-prev">&lt;</button>
                                <button class="calendar-next">&gt;</button>
                            </span>
                        </div>
                        <div class="booking-calendar-days">
                            <div class="calendar-day">Mon<br>02</div>
                            <div class="calendar-day">Tue<br>03</div>
                            <div class="calendar-day">Wed<br>04</div>
                            <div class="calendar-day selected">Thu<br>05</div>
                            <div class="calendar-day">Fri<br>06</div>
                            <div class="calendar-day">Sat<br>07</div>
                        </div>
                        <div class="booking-calendar-times">
                            <button class="calendar-time">7:00 AM</button>
                            <button class="calendar-time">7:30 AM</button>
                            <button class="calendar-time disabled" disabled>8:00 AM</button>
                            <button class="calendar-time">8:30 AM</button>
                            <button class="calendar-time">9:30 AM</button>
                            <button class="calendar-time selected">15:00 PM</button>
                            <button class="calendar-time">15:00 PM</button>
                        </div>
                    </div>

                    <div class="booking-footer">
                        <button class="booking-continue">Continue</button>
                        <div class="booking-total">50$</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
