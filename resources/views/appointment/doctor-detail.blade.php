@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/appointment/doctor-detail.css') }}?v=1.1" rel="stylesheet">
@endpush

@section('content')
    <div class="doctor-detail-container">
        <!-- Profile section -->
        <div class="doctor-profile-section">
            <img src="https://randomuser.me/api/portraits/med/women/75.jpg" class="doctor-profile-img" alt="Doctor">
            <div class="doctor-name">{{ $doctorProfile->user->name }}</div>
            <div class="doctor-specialty">{{ $doctorProfile->medicalCategory->name }}</div>
            <div class="doctor-desc">{{ $doctorProfile->introduce }}</div>
        </div>

        <!-- Info row -->
        <div class="doctor-info-row box">
            <div class="doctor-info-col">
                <div class="doctor-info-label">Location</div>
                <span class="doctor-info-value">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle; margin-right:4px;">
                        <path d="M12 21c-4.418 0-8-5.373-8-10A8 8 0 0 1 20 11c0 4.627-3.582 10-8 10z" />
                        <circle cx="12" cy="11" r="3" />
                    </svg>
                    {{ $doctorProfile->user->country }}
                </span>
            </div>
            @php
                $rate = $doctorProfile->reviews->avg('rate');
                $count = $doctorProfile->reviews->count('rate');
                $roundedRate = round($rate * 2) / 2;
            @endphp
            <div class="doctor-info-col">
                <div class="doctor-info-label">Rating</div>
                <div class="doctor-info-value">
                    <span class="doctor-star">★</span>
                    {{ $rate > 0 ? number_format($roundedRate, 1) : 'Not rated' }}
                    <span
                        class="doctor-rating-count">
                        ({{ $count }})
                    </span>
                </div>
            </div>
            <div class="doctor-info-col">
                <div class="doctor-info-label">Schedule</div>
                @php
                    $isAvailable = \App\Models\WorkSchedule::isAvailable($doctorProfile->id) == 1;
                @endphp
                <div class="doctor-info-value doctor-schedule-{{ $isAvailable ? 'available' : 'unavailable' }}">{{ $isAvailable ? 'Available' : 'Not Available' }}</div>
            </div>
        </div>

        <div class="doctor-languages">
            @foreach ($doctorProfile->user->languages as $item)
                <span class="doctor-lang">
                    <img src="https://flagcdn.com/{{ $item->language->code }}.svg" class="doctor-flag doctor-flag-round">
                    {{ $item->language->name }} <br>
                </span>
            @endforeach
        </div>

        <div class="doctor-section-title">Services</div>
        <div class="doctor-services doctor-services-new">
            <div class="doctor-service-list">
                @forelse ($doctorProfile->services as $item)
                @if (!$item->is_active) @break @endif
                <div class="doctor-service-item-new">
                    <span class="doctor-service-icon-new">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ff6b6b"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 10.5L12 4l9 6.5" />
                            <path d="M4 10.5V20a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V10.5" />
                            <rect x="9" y="14" width="6" height="7" rx="1" />
                        </svg>
                    </span>
                    <span class="doctor-service-content">
                        <div class="doctor-service-title">{{ $item->name }}</div>
                        <div class="doctor-service-desc">{{ $item->description }}</div>
                    </span>
                    <span class="doctor-service-price-new">{{ $item->price }}$</span>
                </div>
                @empty
                <div class="doctor-service-item-new">
                    <span class="doctor-service-icon-new">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 21h18" />
                            <path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16" />
                            <path d="M9 21v-4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v4" />
                            <path d="M10 9h4" />
                            <path d="M12 7v4" />
                        </svg>
                    </span>
                    <span class="doctor-service-content">
                        <div class="doctor-service-title">Không dịch vụ</div>
                    </span>
                </div>
                @endforelse
                {{-- <div class="doctor-service-item-new">
                    <span class="doctor-service-icon-new">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ff6b6b"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 10.5L12 4l9 6.5" />
                            <path d="M4 10.5V20a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V10.5" />
                            <rect x="9" y="14" width="6" height="7" rx="1" />
                        </svg>
                    </span>
                    <span class="doctor-service-content">
                        <div class="doctor-service-title">Home visit</div>
                        <div class="doctor-service-desc">Book a date to visit your home</div>
                    </span>
                    <span class="doctor-service-price-new">50$</span>
                </div>
                <div class="doctor-service-item-new">
                    <span class="doctor-service-icon-new">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ff6b6b"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="15" height="10" rx="2" />
                            <path d="M17 9l4-2v10l-4-2" />
                        </svg>
                    </span>
                    <span class="doctor-service-content">
                        <div class="doctor-service-title">Video appointment</div>
                        <div class="doctor-service-desc">Make a video call with doctor</div>
                    </span>
                    <span class="doctor-service-price-new">50$</span>
                </div>
                <div class="doctor-service-item-new">
                    <span class="doctor-service-icon-new">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ff6b6b"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="7" width="18" height="13" rx="2" />
                            <path d="M8 7V4h8v3" />
                            <path d="M12 12v3" />
                            <path d="M10.5 13.5h3" />
                        </svg>
                    </span>
                    <span class="doctor-service-content">
                        <div class="doctor-service-title">Clinic visit</div>
                        <div class="doctor-service-desc">Book an office with doctor</div>
                    </span>
                    <span class="doctor-service-price-new">100$</span>
                </div>
                <div class="doctor-service-item-new">
                    <span class="doctor-service-icon-new">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ff6b6b"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="5" rx="2" />
                            <path d="M5 16v2a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-2" />
                            <circle cx="7.5" cy="18.5" r="1.5" />
                            <circle cx="16.5" cy="18.5" r="1.5" />
                            <path d="M7 11V7a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v4" />
                        </svg>
                    </span>
                    <span class="doctor-service-content">
                        <div class="doctor-service-title">Drive - to - visit</div>
                        <div class="doctor-service-desc">Book a date to visit your home</div>
                    </span>
                    <span class="doctor-service-price-new">100$</span>
                </div> --}}
            </div>
        </div>

        <div class="doctor-section-title">Available time</div>
        <div class="doctor-schedule doctor-schedule-new">
            <div class="doctor-schedule-calendar">
                <div class="doctor-schedule-month-new"></div>
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

        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 18px;">
            <div class="doctor-section-title" style="margin-bottom: 0;">Testimonials</div>
            <a href="#" class="doctor-view-all">View all reviews.</a>
        </div>

        <div class="doctor-rating-summary">
            <div class="doctor-rating-row">
                <span class="doctor-rating-stars">★★★★★</span>
                <div class="doctor-rating-bar-wrap">
                    <div class="doctor-rating-bar" style="width: 90%;"></div>
                </div>
                <span class="doctor-rating-count">20</span>
            </div>
            <div class="doctor-rating-row">
                <span class="doctor-rating-stars">★★★★</span>
                <div class="doctor-rating-bar-wrap">
                    <div class="doctor-rating-bar" style="width: 65%;"></div>
                </div>
                <span class="doctor-rating-count">5</span>
            </div>
            <div class="doctor-rating-row">
                <span class="doctor-rating-stars">★★★</span>
                <div class="doctor-rating-bar-wrap">
                    <div class="doctor-rating-bar" style="width: 35%;"></div>
                </div>
                <span class="doctor-rating-count">1</span>
            </div>
            <div class="doctor-rating-row">
                <span class="doctor-rating-stars">★★</span>
                <div class="doctor-rating-bar-wrap">
                    <div class="doctor-rating-bar" style="width: 18%;"></div>
                </div>
                <span class="doctor-rating-count">1</span>
            </div>
        </div>

        <div class="doctor-testimonials">
            <div class="doctor-review-item" style="margin-top: 32px;">
                <img src="https://randomuser.me/api/portraits/women/65.jpg" class="doctor-review-avatar">
                <div>
                    <div class="doctor-review-user">
                        <span class="doctor-review-name">Sophie</span>
                        <span class="doctor-review-date">2 days ago</span>
                    </div>
                    <div class="doctor-review-content">Dr. Esther Howard was incredibly kind and professional. The
                        consultation was clear and comforting. I felt truly cared for. Highly recommended!</div>
                </div>
            </div>
        </div>

        <div class="text-center mt-6">
            <button class="doctor-book-btn">Book appointment</button>
        </div>
    </div>
@endsection
