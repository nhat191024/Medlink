@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/appointment/search.css') }}?v=1.2" rel="stylesheet">
@endpush

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="container mx-auto px-4 py-10 max-w-7xl">
            <!-- Search Section -->
            <div class="search-section">
                <form id="search-form">
                    <div class="search-bar">
                        <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                        <input type="text" class="search-input bg-white" placeholder="Search..." name="q"
                            value="{{ request('q') }}">
                        <button type="submit" class="search-btn">
                            Search
                        </button>
                    </div>

                    <div class="filter-buttons">
                        @php
                            $identity = session('identity');
                        @endphp

                        <input type="hidden" name="identity" id="identity-input"
                            value="{{ request('identity', 'doctor') }}">
                        <button type="button"
                            class="filter-btn {{ request('identity', $identity) == 'doctor' ? 'active' : '' }}"
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
            <div class="mt-20 rounded-[20px] p-10 bg-white">
                <h2 class="section-title">Browse doctors nearby!</h2>
                <div
                    class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-10 mb-10 justify-self-center-safe">
                    @forelse ($userProfiles as $item)
                        <!-- Doctor Card -->
                        <div
                            class="card bg-base-100 w-full shadow-xl border-1 rounded-4xl px-5 py-6 border-gray-100 gap-3 md:w-100 lg:w-90 xl:w-80">
                            <div id="info-section" class="flex grow items-start gap-4">
                                <a href="{{ route('appointment.info', ['doctor_profile_id' => $item->doctorProfile->id]) }}" class="doctor-profile-item cursor-pointer w-20 h-20 shrink-0 rounded-full border border-gray-300 block">
                                    <img src="{{ $item->avatar ? Storage::url($item->avatar) . '?height=80&width=80' : asset('storage/upload/avatar/1753441532_688364fc1e3ca.png') }}"
                                        alt="{{ $item->name }}" class="flex grow rounded-full object-cover"
                                        onerror="this.onerror=null;this.src='{{ asset('storage/upload/avatar/1753441532_688364fc1e3ca.png') }}';">
                                </a>
                                <a href="{{ route('appointment.info', ['doctor_profile_id' => $item->doctorProfile->id]) }}" class="doctor-profile-item cursor-pointer flex flex-col grow">
                                    <h3 class="doctor-name">{{ $item->name }}</h3>
                                    <p class="doctor-specialty">
                                        {{ $item->doctorProfile->medicalCategory ? $item->doctorProfile->medicalCategory->name : '' }}
                                    </p>
                                    <div class="flex items-center space-x-1">
                                        @php
                                            $rate = $item->doctorProfile->reviews->avg('rate');
                                            $roundedRate = round($rate * 2) / 2;
                                            $fullStars = floor($roundedRate);
                                            $hasHalfStar = $roundedRate - $fullStars > 0;
                                        @endphp
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            @svg('bi-star-fill', 'text-yellow-400 w-4 h-4')
                                        @endfor
                                        @if ($hasHalfStar)
                                            @svg('bi-star-half', 'text-yellow-400 w-4 h-4')
                                        @else
                                            @svg('bi-star', 'text-gray-600 w-4 h-4')
                                        @endif
                                        <span class="ml-1 text-sm text-gray-600">
                                            {{ $rate > 0 ? number_format($roundedRate, 1) : 'Not rated' }}
                                        </span>
                                    </div>
                                </a>
                                <button type="button"
                                    class="mt-2 mr-2 w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 hover:bg-red-100 transition-colors"
                                    aria-label="Add to favorites">
                                    @svg('bi-heart', 'pt-[3px] w-5 h-5 text-red-500')
                                </button>
                            </div>
                            <div class="flex grow gap-3 justify-evenly">
                                <div>
                                    <div class="text-[0.8em] text-gray-600 flex items-center">
                                        @svg('ionicon-location-outline', 'text-gray-600 w-4 h-4 mr-1')
                                        Location
                                    </div>
                                    <div class="text-sm text-gray-900">
                                        <span>{{ Str::limit($item->city . ' - ' . $item->country, 50, '...') }}</span>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="text-[0.8em] text-gray-600 flex items-center">
                                        @svg('bi-currency-dollar', 'text-gray-600 w-4 h-4 mr-1')
                                        Price from
                                    </div>
                                    @if ($item->doctorProfile->services->count() > 0)
                                        <div class="text-sm">
                                            {{ number_format($item->doctorProfile->services->min('price')) }}đ -
                                            {{ number_format($item->doctorProfile->services->max('price')) }}đ
                                        </div>
                                    @else
                                        <div class="text-sm">
                                            No service
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-[0.8em] text-gray-600 flex items-center">
                                        @svg('ionicon-calendar-number-sharp', 'text-gray-600 w-4 h-4 mr-1')
                                        Schedule
                                    </div>
                                    @php
                                        $isAvailable =
                                            \App\Models\WorkSchedule::isAvailable($item->doctorProfile->id) == 1
                                                ? 'Available'
                                                : 'Not Available';
                                    @endphp
                                    <div class="text-sm {{ $isAvailable ? 'text-green-700' : 'text-red-700' }}">
                                        {{ $isAvailable == 1 ? 'Available' : 'Not Available' }}
                                    </div>
                                </div>
                            </div>
                            <div id="btn-section" class="flex items-center space-x-2">
                                <button class="book-btn"
                                    onclick="location.href='{{ route('appointment.step.one', ['doctor_profile_id' => $item->doctorProfile->id]) }}'">
                                    Book Appointment
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="empty-text">
                            Không có kết quả phù hợp cho '{{ request('q', '') }}'.
                        </div>
                    @endforelse
                    {{ $userProfiles->appends(request()->except('page'))->links('vendor.pagination.default') }}
                </div>
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
        </script>
    @endpush
