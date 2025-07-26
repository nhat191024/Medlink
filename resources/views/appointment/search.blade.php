@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/appointment/search.css') }}?v=1" rel="stylesheet">
@endpush

@section('content')
    <div class="search-page-container">
        <!-- Search Section -->
        <div class="search-section">
            <form id="search-form">
                <div class="search-bar">
                    <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text" class="search-input" placeholder="Search..." name="q"
                        value="{{ request('q') }}">
                    <button type="submit" class="search-btn">
                        Search
                    </button>
                </div>

                <div class="filter-buttons">
                    @php
                        $identity = session('identity');
                    @endphp

                    <input type="hidden" name="identity" id="identity-input" value="{{ request('identity', 'doctor') }}">
                    <button class="filter-btn {{ request('identity', $identity) == 'doctor' ? 'active' : '' }}"
                        data-identity="doctor">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Doctors
                    </button>
                    <button type="button"
                        class="filter-btn {{ request('identity', $identity) == 'hospital' ? 'active' : '' }}"
                        data-identity="hospital">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                        </svg>
                        Hospital
                    </button>
                    <button type="button"
                        class="filter-btn {{ request('identity', $identity) == 'pharmacies' ? 'active' : '' }}"
                        data-identity="pharmacies">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                            <line x1="8" y1="21" x2="16" y2="21"></line>
                            <line x1="12" y1="17" x2="12" y2="21"></line>
                        </svg>
                        Pharmacy
                    </button>
                    <button type="button"
                        class="filter-btn {{ request('identity', $identity) == 'ambulance' ? 'active' : '' }}"
                        data-identity="ambulance">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M9 12l2 2 4-4"></path>
                            <path
                                d="M21 12c.552 0 1-.448 1-1V5c0-.552-.448-1-1-1H3c-.552 0-1 .448-1 1v6c0 .552.448 1 1 1h18z">
                            </path>
                        </svg>
                        Ambulance
                    </button>
                </div>
            </form>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h2 class="section-title">Browse doctors nearby</h2>
            <div class="doctors-grid">
                @forelse ($userProfiles as $item)
                    <!-- Doctor Card 1 -->
                    <div class="doctor-card">
                        <div class="profile-item" data-id="{{ $item->doctorProfile->id }}">
                            <button class="favorite-btn">♡</button>
                            <div class="card-header">
                                <img src="{{ $item->avatar ? Storage::url($item->avatar) . '?height=80&width=80' : asset('storage/upload/avatar/default.png') }}"
                                    alt="{{ $item->name }}"
                                    class="doctor-avatar"
                                    onerror="this.onerror=null;this.src='{{ asset('storage/upload/avatar/default.png') }}';">
                                <div class="doctor-info">
                                    <h3 class="doctor-name">{{ $item->name }}</h3>
                                    <p class="doctor-specialty">
                                        {{ $item->doctorProfile->medicalCategory ? $item->doctorProfile->medicalCategory->name : '' }}
                                    </p>
                                    <div class="rating">
                                        @php
                                            $rate = $item->doctorProfile->reviews->avg('rate');
                                            $roundedRate = round($rate * 2) / 2;
                                            $fullStars = floor($roundedRate);
                                            $hasHalfStar = $roundedRate - $fullStars > 0;
                                            $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                                        @endphp
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <span class="star filled">★</span>
                                        @endfor
                                        @if ($hasHalfStar)
                                            <span class="star half">★</span>
                                        @endif
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <span class="star empty">☆</span>
                                        @endfor
                                        <span class="rating-number">
                                            {{ $rate > 0 ? number_format($roundedRate, 1) : 'Not rated' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-details">
                                <div class="detail-item">
                                    <div class="detail-label">Location</div>
                                    <div class="detail-value">{{ $item->city }} - {{ $item->country }}</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Price from</div>
                                        @if ($item->doctorProfile->services->count() > 0)
                                            <div class="detail-value">
                                                {{ number_format($item->doctorProfile->services->min('price')) }}đ -
                                                {{ number_format($item->doctorProfile->services->max('price')) }}đ
                                            </div>
                                        @else
                                            <div class="detail-value">
                                                No service
                                            </div>
                                        @endif
                                    </div>
                                <div class="detail-item">
                                    <div class="detail-label">Schedule</div>
                                    @php
                                        $isAvailable = \App\Models\WorkSchedule::isAvailable($item->doctorProfile->id) == 1 ? 'Available' : 'Not Available';
                                    @endphp
                                    <div
                                        class="detail-value {{ $isAvailable ? 'available' : '' }}">
                                        {{ $isAvailable == 1 ? 'Available' : 'Not Available' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="book-btn"
                            onclick="location.href='{{ route('appointment.step.one', ['doctor_profile_id' => $item->doctorProfile->id]) }}'">
                            Book Appointment
                        </button>
                    </div>
                @empty
                    <div class="empty-text">
                        Không có kết quả phù hợp cho '{{ request('q', '') }}'.
                    </div>
                @endforelse
                {{ $userProfiles->appends(request()->except('page'))->links('vendor.pagination.default') }}
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded',
                function() {
                    const searchForm = document.getElementById('search-form');
                    const identityInput = document.getElementById('identity-input');
                    const identityButtons = document.querySelectorAll('.filter-btn');
                    identityButtons.forEach(button => {
                        button.addEventListener('click',
                            function() {
                                const selectedIdentity = this.dataset.identity;
                                identityInput.value = selectedIdentity;
                                searchForm.submit();
                            });
                    });
                });
            document.querySelectorAll('.favorite-btn').forEach(button => {
                button.addEventListener('click',
                    function() {
                        // alert('thinh gay');
                    });
            });
            document.querySelectorAll('.profile-item').forEach(element => {
                element.addEventListener('click',
                    function() {
                        location.href = "/appointment/info/" + element.dataset.id;
                    });
            });
        </script>
    @endpush
