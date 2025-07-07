@extends('layouts.app')

@section('content')
<div class="doctor-detail-container">
    <!-- Profile section -->
    <div class="doctor-profile-section">
        <img src="https://randomuser.me/api/portraits/med/women/75.jpg" class="doctor-profile-img" alt="Doctor">
        <div class="doctor-name">Dr. Esther Howard</div>
        <div class="doctor-specialty">Cardiologist</div>
        <div class="doctor-desc">Hi, I'm Dr. Esther 1 lane a specialist with 8 year of experience and treating eyes.</div>
    </div>
    <!-- Info row -->
    <div class="doctor-info-row">
        <div class="doctor-info-col">
            <div class="doctor-info-label">Location</div>
            <div class="doctor-info-value">Paris</div>
        </div>
        <div class="doctor-info-col">
            <div class="doctor-info-label">Rating</div>
            <div class="doctor-info-value"><span class="doctor-star">★</span>4.6<span class="doctor-rating-count">(415)</span></div>
        </div>
        <div class="doctor-info-col">
            <div class="doctor-info-label">Schedule</div>
            <div class="doctor-info-value doctor-schedule-available">Available</div>
        </div>
    </div>
    <div class="doctor-languages">
        <span class="doctor-lang"><img src="https://flagcdn.com/fr.svg" class="doctor-flag doctor-flag-round"> French</span>
        <span class="doctor-lang"><img src="https://flagcdn.com/gb.svg" class="doctor-flag doctor-flag-round"> English</span>
        <span class="doctor-lang"><img src="https://flagcdn.com/vn.svg" class="doctor-flag doctor-flag-round"> Vietnamese</span>
    </div>
    <!-- Services -->
    <div class="doctor-section-title">Services</div>
    <div class="doctor-services doctor-services-new">
        <div class="doctor-service-list">
            <div class="doctor-service-item-new">
                <span class="doctor-service-icon-new"><i class="fa fa-home"></i></span>
                <span class="doctor-service-content">
                    <div class="doctor-service-title">Home visit</div>
                    <div class="doctor-service-desc">Book a date to visit your home</div>
                </span>
                <span class="doctor-service-price-new">50$</span>
            </div>
            <div class="doctor-service-item-new">
                <span class="doctor-service-icon-new"><i class="fa fa-video"></i></span>
                <span class="doctor-service-content">
                    <div class="doctor-service-title">Video appointment</div>
                    <div class="doctor-service-desc">Make a video call with doctor</div>
                </span>
                <span class="doctor-service-price-new">50$</span>
            </div>
            <div class="doctor-service-item-new">
                <span class="doctor-service-icon-new"><i class="fa fa-clinic-medical"></i></span>
                <span class="doctor-service-content">
                    <div class="doctor-service-title">Clinic visit</div>
                    <div class="doctor-service-desc">Book an office with doctor</div>
                </span>
                <span class="doctor-service-price-new">100$</span>
            </div>
            <div class="doctor-service-item-new">
                <span class="doctor-service-icon-new"><i class="fa fa-car"></i></span>
                <span class="doctor-service-content">
                    <div class="doctor-service-title">Drive - to - visit</div>
                    <div class="doctor-service-desc">Book a date to visit your home</div>
                </span>
                <span class="doctor-service-price-new">100$</span>
            </div>
        </div>
    </div>
    <!-- Schedule -->
    <div class="doctor-section-title">Available time</div>
    <div class="doctor-schedule doctor-schedule-new">
        <div class="doctor-schedule-calendar">
            <div class="doctor-schedule-month-new">Sep, 2024</div>
            <div class="doctor-schedule-days-new">
                <span>Mon<br>30</span>
                <span>Tue<br>31</span>
                <span>Wed<br>01</span>
                <span class="doctor-schedule-today-new">Thu<br>12</span>
                <span>Fri<br>13</span>
                <span>Sat<br>14</span>
            </div>
            <div class="doctor-schedule-times-new">
                <button class="doctor-time-btn-new">12:00<br>29/5</button>
                <button class="doctor-time-btn-new doctor-time-btn-disabled-new" disabled>12:00<br>31/5</button>
                <button class="doctor-time-btn-new">12:00<br>31/5</button>
                <button class="doctor-time-btn-new doctor-time-btn-disabled-new" disabled>10:50<br>Wed</button>
                <button class="doctor-time-btn-new">11:00<br>Sun</button>
                <button class="doctor-time-btn-new doctor-time-btn-full-new">11:00<br>Full</button>
            </div>
            <button class="doctor-schedule-all-btn-new">All schedule available</button>
        </div>
    </div>
    <!-- Testimonials -->
    <div class="doctor-testimonials">
        <div class="doctor-section-title">Testimonials <a href="#" class="doctor-view-all">View all reviews.</a></div>
        <div class="doctor-rating-summary">
            <span class="doctor-rating-stars">★★★★★</span>
            <span class="doctor-rating-bar"></span> 20<br>
            <span class="doctor-rating-stars">★★★★</span>
            <span class="doctor-rating-bar"></span> 5<br>
            <span class="doctor-rating-stars">★★★</span>
            <span class="doctor-rating-bar"></span> 1<br>
            <span class="doctor-rating-stars">★★</span>
            <span class="doctor-rating-bar"></span> 1<br>
        </div>
        <div class="doctor-review-item">
            <div class="doctor-review-user">
                <img src="https://randomuser.me/api/portraits/thumb/women/75.jpg" class="doctor-review-avatar">
                <div>
                    <div class="doctor-review-name">Sophie</div>
                    <div class="doctor-review-date">2 days ago</div>
                </div>
            </div>
            <div class="doctor-review-content">Dr. Esther Howard was incredibly kind and professional. The consultation was clear and comforting. I felt truly cared for. Highly recommended!</div>
        </div>
    </div>
    <div class="text-center mt-6">
        <button class="doctor-book-btn">Book appointment</button>
    </div>
</div>
@endsection 