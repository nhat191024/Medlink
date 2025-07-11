@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/appointment/booking.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="booking-container">
    {{-- Stepper --}}
    <div class="booking-stepper">
        <div class="step active">1</div>
        <div class="step-line"></div>
        <div class="step">2</div>
        <div class="step-line"></div>
        <div class="step">4</div>
    </div>
    <div class="step-labels">
        <span>Chọn dịch vụ</span>
        <span>Điền thông tin</span>
        <span>Thanh toán & xác nhận</span>
    </div>

    {{-- Doctor Info --}}
    <div class="booking-doctor-info">
        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="doctor-avatar" alt="Doctor">
        <div class="doctor-name">Dr. Esther Howard</div>
    </div>

    <div class="booking-card">
        {{-- Choose services --}}
        <div class="booking-section-title">Choose services</div>
        <div class="booking-services">
            <div class="service-card">
                <div class="service-icon"><i class="fa fa-home"></i></div>
                <div class="service-info">
                    <div class="service-title">Home</div>
                    <div class="service-desc">Doctor visit at home</div>
                </div>
                <div class="service-price">150$</div>
            </div>
            <div class="service-card selected">
                <div class="service-icon"><i class="fa fa-video-camera"></i></div>
                <div class="service-info">
                    <div class="service-title">Online</div>
                    <div class="service-desc">Make a video call with doctor</div>
                </div>
                <div class="service-price">50$</div>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fa fa-hospital-o"></i></div>
                <div class="service-info">
                    <div class="service-title">Clinic</div>
                    <div class="service-desc">Book an office with doctor</div>
                </div>
                <div class="service-price">100$</div>
            </div>
        </div>

        {{-- Choose time --}}
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

        {{-- Continue button & price --}}
        <div class="booking-footer">
            <button class="booking-continue">Continue</button>
            <div class="booking-total">50$</div>
        </div>
    </div>
</div>
@endsection 