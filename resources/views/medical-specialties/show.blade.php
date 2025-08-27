@extends('layouts.app')

@push('styles')
    <style>
        .doctor-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            border: 1px solid #e5e7eb;
        }

        .doctor-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: #ef4444;
        }

        .animate-fade-in {
            opacity: 0;
            animation: fadeIn 0.6s ease forwards;
        }

        .animate-slide-up {
            opacity: 0;
            transform: translateY(30px);
            animation: slideUp 0.8s ease forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Search input */
        .search-input {
            transition: all 0.3s ease;
        }

        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
            border-color: #ef4444;
        }

        /* Filter buttons */
        .filter-btn {
            transition: all 0.3s ease;
            background: white;
            border: 1px solid #d1d5db;
            color: #6b7280;
        }

        .filter-btn:hover {
            background: #f9fafb;
            border-color: #ef4444;
            color: #ef4444;
        }

        .filter-btn.active {
            background: #ef4444;
            border-color: #ef4444;
            color: white;
        }

        /* Specialty cards in related section */
        .specialty-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e5e7eb;
        }

        .specialty-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1);
            border-color: #ef4444;
        }

        /* Empty state */
        .empty-state {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="relative mx-auto max-w-7xl sm:py-10">
                <div class="animate-fade-in text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-[#DF1D32] sm:text-6xl">
                        Khoa {{ $medicalCategory->name }}
                    </h1>

                    <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-gray-600">
                        Tìm kiếm và đặt lịch khám với các bác sĩ hàng đầu chuyên khoa {{ $medicalCategory->name }}.
                        Chúng tôi có {{ $doctors->count() }} bác sĩ giàu kinh nghiệm sẵn sàng phục vụ bạn.
                    </p>

                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <div class="glass-card rounded-xl px-6 py-3">
                            <div class="flex items-center gap-4 text-black">
                                <div class="flex items-center gap-2">
                                    @svg('bi-people-fill', 'w-5 h-5')
                                    <span class="font-semibold">{{ $doctors->count() }}</span>
                                    <span class="text-black">Bác sĩ</span>
                                </div>
                                <div class="h-6 w-px bg-red-600"></div>
                                <div class="flex items-center gap-2">
                                    @svg('bi-star-fill', 'w-5 h-5 text-yellow-300')
                                    <span class="font-semibold">{{ $doctors->avg('average_rating') ? number_format($doctors->avg('average_rating'), 1) : '0.0' }}</span>
                                    <span class="text-black">Đánh giá TB</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex max-w-full flex-col items-center justify-center px-6 py-12 lg:px-8">
            <!-- Search and Filter Section -->
            <div class="animate-slide-up w-6xl mb-12" style="animation-delay: 0.2s;">
                <div class="rounded-2xl bg-white p-8 shadow-lg">
                    <div class="flex gap-6">
                        <!-- Search Input -->
                        <div class="w-1/2">
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    @svg('bi-search', 'w-5 h-5 text-gray-400')
                                </div>
                                <input id="doctorSearch" class="search-input block w-full rounded-xl border border-gray-300 bg-white py-3 pl-10 pr-3 leading-5 placeholder-gray-500 focus:border-red-500 focus:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-red-500" type="text"
                                    placeholder="Tìm kiếm bác sĩ theo tên, địa điểm...">
                            </div>
                        </div>

                        <!-- Sort Filter -->
                        <div class="flex gap-3">
                            <button class="filter-btn active flex items-center justify-center rounded-xl px-6 py-3 font-medium transition-all" data-sort="rating">
                                @svg('bi-star-fill', 'w-4 h-4 mr-2')
                                Đánh giá cao
                            </button>
                            <button class="filter-btn flex items-center justify-center rounded-xl px-6 py-3 font-medium transition-all" data-sort="availability">
                                @svg('bi-clock', 'w-4 h-4 mr-2')
                                Đang rảnh
                            </button>
                            <button class="filter-btn flex items-center justify-center rounded-xl px-6 py-3 font-medium transition-all" data-sort="price">
                                @svg('bi-currency-dollar', 'w-4 h-4 mr-2')
                                Giá thấp
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Doctors Grid -->
            <div class="mb-16">
                <h2 class="animate-slide-up mb-8 text-2xl font-bold text-gray-900" style="animation-delay: 0.3s;">
                    Danh sách bác sĩ khoa {{ $medicalCategory->name }}
                </h2>

                <div id="doctorsGrid" class="grid grid-cols-1 gap-8 lg:grid-cols-2 xl:grid-cols-3">
                    @forelse ($doctors as $index => $doctor)
                        <div class="doctor-card animate-slide-up overflow-hidden rounded-2xl shadow-lg"
                            data-doctor-info="{{ json_encode([
                                'name' => $doctor['user']['name'],
                                'location' => $doctor['user']['city'] . ' - ' . $doctor['user']['country'],
                                'rating' => $doctor['average_rating'],
                                'available' => $doctor['is_available'],
                                'price' => $doctor['service_price'],
                            ]) }}"
                            style="animation-delay: {{ 0.1 * ($index % 6) }}s;">
                            <!-- Doctor Info Section -->
                            <div class="p-6">
                                <div class="mb-6 flex items-start gap-4">
                                    <a class="block flex-shrink-0" href="{{ route('appointment.info', ['doctor_profile_id' => $doctor['id']]) }}">
                                        <div class="h-20 w-20 overflow-hidden rounded-full border-2 border-red-100 transition-colors hover:border-red-300">
                                            <img class="h-full w-full object-cover" src="{{ asset($doctor['user']['avatar']) }}" alt="{{ $doctor['user']['name'] }}">
                                        </div>
                                    </a>

                                    <div class="min-w-0 flex-1">
                                        <a class="group" href="{{ route('appointment.info', ['doctor_profile_id' => $doctor['id']]) }}">
                                            <div class="mb-1 flex items-center gap-2">
                                                <h3 class="truncate text-lg font-semibold text-gray-900 transition-colors group-hover:text-red-600">
                                                    {{ $doctor['user']['name'] }}
                                                </h3>
                                                <!-- Verified Badge -->
                                                <div class="flex-shrink-0">
                                                    <div class="flex h-5 w-5 items-center justify-center rounded-full bg-blue-600">
                                                        @svg('bi-check-lg', 'w-3 h-3 text-white font-bold')
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mb-2 truncate text-sm text-gray-600">
                                                Khoa {{ $doctor['medical_category']['name'] }}
                                            </p>
                                        </a>

                                        <!-- Rating Section -->
                                        <div class="flex items-center gap-2">
                                            @php
                                                $rate = $doctor['average_rating'];
                                                $totalReviews = $doctor['total_reviews'];
                                                $roundedRate = $rate > 0 ? round($rate * 2) / 2 : 0;
                                                $fullStars = floor($roundedRate);
                                                $hasHalfStar = $roundedRate - $fullStars > 0;
                                            @endphp

                                            @if ($rate > 0)
                                                <div class="flex items-center gap-0.5">
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

                                                <span class="rounded-md border border-amber-200 bg-amber-50 px-2 py-0.5 text-sm font-semibold text-gray-700">
                                                    {{ number_format($roundedRate, 1) }}
                                                </span>

                                                <span class="text-xs font-medium text-gray-500">
                                                    ({{ $totalReviews }} đánh giá)
                                                </span>
                                            @else
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
                                    </div>
                                </div>

                                <!-- Doctor Details Grid -->
                                <div class="mb-6 grid grid-cols-1 gap-4">
                                    <div class="flex items-start gap-3">
                                        <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-blue-100">
                                            @svg('ionicon-location-outline', 'text-blue-600 w-4 h-4')
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-500">Địa điểm</p>
                                            <p class="truncate text-sm font-medium text-gray-900">
                                                @if ($doctor['user']['city'] && $doctor['user']['country'])
                                                    {{ Str::limit($doctor['user']['city'] . ' - ' . $doctor['user']['country'], 30, '...') }}
                                                @else
                                                    {{ $doctor['office_address'] ? Str::limit($doctor['office_address'], 30, '...') : 'Chưa cập nhật' }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3">
                                        <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-green-100">
                                            @svg('bi-currency-dollar', 'text-green-600 w-4 h-4')
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-500">Giá khám</p>
                                            <p class="text-sm font-medium text-gray-900">
                                                @if ($doctor['service_price'] > 0)
                                                    {{ number_format($doctor['service_price']) }}đ
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
                                        <div class="min-w-0 flex-1">
                                            <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-500">Trạng thái</p>
                                            <div class="flex items-center gap-2">
                                                <div class="{{ $doctor['is_available'] ? 'bg-green-500' : 'bg-red-500' }} h-2 w-2 rounded-full"></div>
                                                <span class="{{ $doctor['is_available'] ? 'text-green-700' : 'text-red-700' }} text-sm font-medium">
                                                    {{ $doctor['is_available'] ? 'Đang rảnh' : 'Đang bận' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="border-t border-gray-100 p-4">
                                <button class="w-full rounded-lg bg-red-600 px-4 py-3 font-semibold text-white transition-colors duration-200 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" onclick="location.href='{{ route('appointment.step.one', ['doctor_profile_id' => $doctor['id']]) }}'">
                                    Đặt lịch khám
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="empty-state rounded-2xl p-12 text-center">
                                <div class="mb-6">
                                    @svg('bi-person-x', 'w-16 h-16 text-gray-400 mx-auto')
                                </div>
                                <h3 class="mb-2 text-lg font-semibold text-gray-900">Chưa có bác sĩ</h3>
                                <p class="mb-6 text-gray-600">Hiện tại chưa có bác sĩ nào trong chuyên khoa {{ $medicalCategory->name }}.</p>
                                <a class="inline-flex items-center rounded-lg bg-red-600 px-6 py-3 font-semibold text-white transition-colors hover:bg-red-700" href="{{ route('medical-specialties.index') }}">
                                    @svg('bi-arrow-left', 'w-4 h-4 mr-2')
                                    Xem tất cả chuyên khoa
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- No Search Results -->
                <div id="noResults" class="col-span-full hidden">
                    <div class="empty-state rounded-2xl p-12 text-center">
                        <div class="mb-6">
                            @svg('bi-search', 'w-16 h-16 text-gray-400 mx-auto')
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-gray-900">Không tìm thấy kết quả</h3>
                        <p class="mb-6 text-gray-600">Không có bác sĩ nào phù hợp với từ khóa tìm kiếm của bạn.</p>
                        <button class="inline-flex items-center rounded-lg bg-red-600 px-6 py-3 font-semibold text-white transition-colors hover:bg-red-700" onclick="clearSearch()">
                            @svg('bi-arrow-clockwise', 'w-4 h-4 mr-2')
                            Xóa bộ lọc
                        </button>
                    </div>
                </div>
            </div>

            <!-- Related Specialties -->
            @if ($relatedSpecialties->count() > 0)
                <div class="animate-slide-up" style="animation-delay: 0.5s;">
                    <h2 class="mb-8 text-2xl font-bold text-gray-900">Chuyên khoa liên quan</h2>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach ($relatedSpecialties as $specialty)
                            <a class="specialty-card group rounded-xl p-6 hover:no-underline" href="{{ route('medical-specialties.show', $specialty->slug) }}">
                                <div class="flex items-center gap-4">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-red-100 transition-colors group-hover:bg-red-200">
                                        @svg($specialty->icon, 'w-6 h-6 text-red-600')
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-900 transition-colors group-hover:text-red-600">
                                            {{ $specialty->name }}
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            {{ $specialty->doctors_count }} bác sĩ
                                        </p>
                                    </div>
                                    <div class="text-gray-400 transition-colors group-hover:text-red-600">
                                        @svg('bi-arrow-right', 'w-5 h-5')
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('doctorSearch');
            const doctorsGrid = document.getElementById('doctorsGrid');
            const noResults = document.getElementById('noResults');
            const filterButtons = document.querySelectorAll('.filter-btn');
            const doctorCards = document.querySelectorAll('.doctor-card');

            let allDoctors = Array.from(doctorCards);
            let currentFilter = 'rating';

            // Search functionality
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();
                filterAndSort(searchTerm, currentFilter);
            });

            // Filter button functionality
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Update active button
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    currentFilter = this.dataset.sort;
                    const searchTerm = searchInput.value.toLowerCase().trim();
                    filterAndSort(searchTerm, currentFilter);
                });
            });

            function filterAndSort(searchTerm = '', sortBy = 'rating') {
                let filteredDoctors = allDoctors;

                // Filter by search term
                if (searchTerm) {
                    filteredDoctors = allDoctors.filter(card => {
                        const doctorInfo = JSON.parse(card.dataset.doctorInfo);
                        return doctorInfo.name.toLowerCase().includes(searchTerm) ||
                            doctorInfo.location.toLowerCase().includes(searchTerm);
                    });
                }

                // Sort doctors
                filteredDoctors.sort((a, b) => {
                    const aInfo = JSON.parse(a.dataset.doctorInfo);
                    const bInfo = JSON.parse(b.dataset.doctorInfo);

                    console.log(sortBy);

                    switch (sortBy) {
                        case 'rating':
                            return bInfo.rating - aInfo.rating;
                        case 'availability':
                            if (aInfo.available === bInfo.available) {
                                return bInfo.rating - aInfo.rating;
                            }
                            return bInfo.available ? true : false ? 1 : -1;
                        case 'price':
                            if (aInfo.price === 0 && bInfo.price === 0) {
                                return bInfo.rating - aInfo.rating;
                            }
                            if (aInfo.price === 0) return 1;
                            if (bInfo.price === 0) return -1;
                            return aInfo.price - bInfo.price;
                        default:
                            return bInfo.rating - aInfo.rating;
                    }
                });

                // Hide all cards first
                allDoctors.forEach(card => {
                    card.style.display = 'none';
                });

                // Show filtered and sorted cards
                if (filteredDoctors.length > 0) {
                    filteredDoctors.forEach((card, index) => {
                        card.style.display = 'block';
                        card.style.animationDelay = `${0.1 * (index % 6)}s`;
                        doctorsGrid.appendChild(card);
                    });
                    noResults.classList.add('hidden');
                } else {
                    noResults.classList.remove('hidden');
                }
            }

            // Clear search function
            window.clearSearch = function() {
                searchInput.value = '';
                filterButtons.forEach(btn => btn.classList.remove('active'));
                filterButtons[0].classList.add('active');
                currentFilter = 'rating';
                filterAndSort('', 'rating');
            };
        });
    </script>
@endpush
