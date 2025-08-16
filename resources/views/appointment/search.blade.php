@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/appointment/search.css') }}?v=1.2" rel="stylesheet">
@endpush

@section('content')

    <div class="mx-20 flex min-h-[95vh] flex-col py-10">
        <!-- Search Section -->
        <div class="search-section">
            <form id="search-form">
                <div class="search-bar">
                    <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input class="search-input bg-white" name="q" type="text" value="{{ request('q') }}" placeholder="Search...">
                    <button class="search-btn" type="submit">
                        Tìm kiếm
                    </button>
                </div>

                <div class="filter-buttons">
                    @php
                        $identity = session('identity');
                    @endphp

                    <input id="identity-input" name="identity" type="hidden" value="{{ request('identity', 'doctor') }}">
                    <button class="filter-btn {{ request('identity', $identity) == 'doctor' ? 'active' : '' }}" data-identity="doctor" type="button">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Bác sĩ
                    </button>
                    <button class="filter-btn {{ request('identity', $identity) == 'hospital' ? 'active' : '' }}" data-identity="hospital" type="button">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                        </svg>
                        Bệnh viện
                    </button>
                    <button class="filter-btn {{ request('identity', $identity) == 'pharmacies' ? 'active' : '' }}" data-identity="pharmacies" type="button">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                            <line x1="8" y1="21" x2="16" y2="21"></line>
                            <line x1="12" y1="17" x2="12" y2="21"></line>
                        </svg>
                        Nhà thuốc
                    </button>
                    <button class="filter-btn {{ request('identity', $identity) == 'ambulance' ? 'active' : '' }}" data-identity="ambulance" type="button">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 12l2 2 4-4"></path>
                            <path d="M21 12c.552 0 1-.448 1-1V5c0-.552-.448-1-1-1H3c-.552 0-1 .448-1 1v6c0 .552.448 1 1 1h18z">
                            </path>
                        </svg>
                        Xe cấp cứu
                    </button>
                </div>
            </form>
        </div>

        <!-- Main Content -->
        <div class="rounded-3xl bg-white p-10">
            <h2 class="section-title">Tìm bác sĩ ở gần</h2>
            <div class="justify-self-center-safe mb-10 grid grid-cols-1 gap-10 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                @forelse ($userProfiles as $doctor)
                    <!-- Doctor Card -->
                    <div class="relative h-full overflow-visible rounded-2xl border border-gray-100 bg-white p-6 shadow-lg transition-all duration-300 hover:shadow-xl">
                        <!-- Doctor Info Section -->
                        <div class="mb-6 flex items-start gap-4">
                            <a class="block flex-shrink-0" href="{{ route('appointment.info', ['doctor_profile_id' => $doctor->doctor_profile_id ?? $doctor->doctorProfile->id]) }}">
                                <div class="h-20 w-20 overflow-hidden rounded-full border-2 border-red-100 transition-colors hover:border-red-300">
                                    <img class="h-full w-full object-cover" src="{{ asset($doctor->avatar) }}" alt="{{ $doctor->name }}">
                                </div>
                            </a>

                            <div class="min-w-0 flex-grow">
                                <a class="group" href="{{ route('appointment.info', ['doctor_profile_id' => $doctor->doctor_profile_id ?? $doctor->doctorProfile->id]) }}">
                                    <div class="mb-1 flex items-center gap-2">
                                        <h3 class="truncate text-lg font-semibold text-gray-900 transition-colors group-hover:text-red-600">{{ $doctor->name }}</h3>
                                        <!-- Verified Doctor Badge -->
                                        <div class="tooltip" data-tip="Bác sĩ đã được chứng nhận">
                                            <div class="group/badge relative flex-shrink-0">
                                                <div class="flex h-5 w-5 items-center justify-center rounded-full bg-blue-600">
                                                    @svg('bi-check-lg', 'w-3 h-3 text-white font-bold')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-2 truncate text-sm text-gray-600">
                                        Khoa {{ $doctor->doctorProfile->medicalCategory->name ?? 'Chưa phân loại' }}
                                    </p>

                                    <!-- Rating Section -->
                                    <div class="mt-2 flex items-center gap-2">
                                        @php
                                            $rate = $doctor['average_rating'] ?? 0;
                                            $totalReviews = $doctor['total_reviews'] ?? 0;
                                            $roundedRate = $rate > 0 ? round($rate * 2) / 2 : 0;
                                            $fullStars = floor($roundedRate);
                                            $hasHalfStar = $roundedRate - $fullStars > 0;
                                        @endphp

                                        @if ($rate > 0)
                                            <!-- Stars Container -->
                                            <div class="flex items-center gap-0.5" title="Đánh giá {{ number_format($roundedRate, 1) }}/5 sao từ {{ $totalReviews }} người">
                                                @for ($i = 0; $i < $fullStars; $i++)
                                                    @svg('bi-star-fill', 'text-amber-400 w-4 h-4 drop-shadow-sm')
                                                @endfor
                                                @if ($hasHalfStar)
                                                    @svg('bi-star-half', 'text-amber-400 w-4 h-4 drop-shadow-sm')
                                                @endif
                                                @for ($i = $fullStars + ($hasHalfStar ? 1 : 0); $i < 5; $i++)
                                                    @svg('bi-star', 'text-gray-300 w-4 h-4')
                                                @endfor
                                            </div>

                                            <!-- Rating Score -->
                                            <span class="rounded-md border border-amber-200 bg-amber-50 px-2 py-0.5 text-sm font-semibold text-gray-700">
                                                {{ number_format($roundedRate, 1) }}
                                            </span>

                                            <!-- Review Count -->
                                            <span class="text-xs font-medium text-gray-500">
                                                ({{ $totalReviews }} đánh giá)
                                            </span>
                                        @else
                                            <!-- No Rating State -->
                                            <div class="flex items-center gap-2">
                                                <div class="flex items-center gap-0.5">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @svg('bi-star', 'text-gray-200 w-4 h-4')
                                                    @endfor
                                                </div>
                                                <span class="rounded-md border border-gray-200 bg-gray-50 px-2 py-0.5 text-xs font-medium text-gray-400">
                                                    Chưa có đánh giá
                                                </span>
                                            </div>
                                        @endif

                                        @if ($rate >= 4.5)
                                            <span class="inline-flex items-center rounded-full border border-green-200 bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">
                                                @svg('bi-award', 'w-3 h-3 mr-1')
                                                Xuất sắc
                                            </span>
                                        @elseif($rate >= 4.0)
                                            <span class="inline-flex items-center rounded-full border border-blue-200 bg-blue-100 px-2 py-0.5 text-xs font-medium text-blue-800">
                                                @svg('bi-hand-thumbs-up', 'w-3 h-3 mr-1')
                                                Tốt
                                            </span>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Doctor Details Grid -->
                        <div class="mb-6 grid grid-cols-1 gap-4">
                            <div class="flex items-start gap-3">
                                <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-blue-100">
                                    @svg('ionicon-location-outline', 'text-blue-600 w-4 h-4')
                                </div>
                                <div class="min-w-0 flex-grow">
                                    <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-500">Địa điểm</p>
                                    <p class="truncate text-sm font-medium text-gray-900">
                                        @if ($doctor->city && $doctor->country)
                                            {{ Str::limit($doctor->city . ' - ' . $doctor->country, 30, '...') }}
                                        @else
                                            {{ $doctor->doctorProfile->office_address ? Str::limit($doctor->doctorProfile->office_address, 30, '...') : 'Chưa cập nhật' }}
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-green-100">
                                    @svg('bi-currency-dollar', 'text-green-600 w-4 h-4')
                                </div>
                                <div class="min-w-0 flex-grow">
                                    <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-500">Giá khám</p>
                                    <p class="text-sm font-medium text-gray-900">
                                        @if ($doctor->service_price > 0)
                                            {{ number_format($doctor->service_price) }}đ
                                        @else
                                            Liên hệ
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-purple-100">
                                    @svg('ionicon-calendar-number-sharp', 'text-purple-600 w-4 h-4')
                                </div>
                                <div class="min-w-0 flex-grow">
                                    <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-500">Trạng thái</p>
                                    @php
                                        $isAvailable = \App\Models\WorkSchedule::isAvailable($doctor->doctor_profile_id ?? $doctor->doctorProfile->id) == 1;
                                    @endphp
                                    <div class="flex items-center gap-2">
                                        <div class="{{ $isAvailable ? 'bg-green-500' : 'bg-red-500' }} h-2 w-2 rounded-full"></div>
                                        <span class="{{ $isAvailable ? 'text-green-700' : 'text-red-700' }} text-sm font-medium">
                                            {{ $isAvailable ? 'Đang rảnh' : 'Đang bận' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="border-t border-gray-100 pt-4">
                            <button class="w-full rounded-lg bg-red-600 px-4 py-3 font-semibold text-white transition-colors duration-200 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                onclick="location.href='{{ route('appointment.step.one', ['doctor_profile_id' => $doctor->doctor_profile_id ?? $doctor->doctorProfile->id]) }}'">
                                Đặt lịch khám
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
