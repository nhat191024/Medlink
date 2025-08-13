@extends('layouts.app')
@section('content')
    <section class="py-22 relative mb-10 overflow-visible bg-red-800">
        <div class="pointer-events-none absolute inset-y-0 right-0 z-0 flex w-1/2 select-none items-center justify-end" aria-hidden="true">
            <img class="h-full w-auto object-contain" src="{{ asset('img/banner.png') }}" alt="" />
        </div>

        <div class="pointer-events-none absolute inset-y-0 left-0 z-0 flex w-1/2 select-none items-center justify-start" aria-hidden="true">
            <img class="ml-10 h-full w-auto object-contain" src="{{ asset('img/banner-2.png') }}" alt="" />
        </div>

        <div class="relative z-10 flex flex-col items-center text-center text-white">
            <h2 class="text-2xl font-bold lg:text-4xl">{{ __('client/home.banner.title') }}</h2>
            <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-slate-400 md:text-xl">
                {{ __('client/home.banner.description') }}
            </p>
            <a class="mt-8 rounded-md bg-white px-5 py-2.5 text-base font-semibold leading-7 text-black transition hover:bg-gray-200 focus:border-blue-300 focus:outline-none focus:ring" href="#">
                {{ __('client/home.banner.button') }}
            </a>
        </div>
    </section>

    {{-- Medical Categories --}}
    <section class="py-16">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="mb-12 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 md:text-4xl">{{ __('client/home.categories.title') }}</h2>
                <p class="mx-auto max-w-2xl text-lg text-gray-600">
                    {{ __('client/home.categories.description') }}
                </p>
            </div>

            <div class="relative">
                <div id="category-slider" class="swiper overflow-visible">
                    <div class="swiper-wrapper py-4">
                        @foreach ($categories as $index => $category)
                            <div class="swiper-slide overflow-visible">
                                <div class="group relative">
                                    <a class="block transform transition-all duration-300 hover:scale-105" href="#">
                                        <div class="relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 text-center shadow-lg transition-all duration-300 hover:border-red-200 hover:shadow-2xl">
                                            <!-- Background Pattern -->
                                            <div class="absolute inset-0 bg-gradient-to-br from-red-50 to-orange-50 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>

                                            <!-- Icon Container -->
                                            <div class="relative mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br from-red-100 to-red-200 transition-all duration-300 group-hover:scale-110 group-hover:from-red-500 group-hover:to-red-600">
                                                @php
                                                    $iconMap = [
                                                        'Tim mạch' => 'healthicons-f-heart-cardiogram',
                                                        'Nhi' => 'bi-emoji-smile',
                                                        'Da liễu' => 'bi-droplet',
                                                        'Mắt' => 'bi-eye',
                                                        'Tai mũi họng' => 'bi-ear',
                                                        'Thần kinh' => 'bi-lightning',
                                                        'Xương khớp' => 'bi-person-walking',
                                                        'Nội khoa' => 'bi-hospital',
                                                        'Ngoại khoa' => 'bi-scissors',
                                                        'Phụ sản' => 'bi-gender-female',
                                                        'Tiêu hóa' => 'healthicons-f-stomach',
                                                        'Hô hấp' => 'bi-lungs',
                                                    ];
                                                    $iconClass = $iconMap[trim($category->name)] ?? 'bi-plus-circle';
                                                @endphp
                                                @svg($iconClass, 'h-10 w-10 text-red-600 group-hover:text-white transition-colors duration-300')
                                            </div>

                                            <!-- Category Info -->
                                            <div class="relative">
                                                <h3 class="mb-2 text-lg font-bold text-gray-900 transition-colors duration-300 group-hover:text-red-600">
                                                    {{ $category->name }}
                                                </h3>

                                                <p class="mb-4 text-sm text-gray-600 transition-colors duration-300 group-hover:text-gray-700">
                                                    Chuyên khoa {{ strtolower($category->name) }}
                                                </p>

                                                <!-- Doctor Count (if available) -->
                                                @if (isset($category->users_count))
                                                    <div class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600 transition-colors duration-300 group-hover:bg-red-100 group-hover:text-red-700">
                                                        @svg('bi-person', 'w-3 h-3 mr-1')
                                                        {{ $category->users_count }} bác sĩ
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Hover Arrow -->
                                            <div class="absolute bottom-4 right-4 translate-x-2 transform opacity-0 transition-all duration-300 group-hover:translate-x-0 group-hover:opacity-100">
                                                @svg('bi-arrow-right', 'w-5 h-5 text-red-600')
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="swiper-button-next !right-4 !top-1/2 !mt-0 !h-10 !w-10 !rounded-full !border !border-gray-200 !bg-white !text-red-600 !shadow-lg transition-all duration-300 after:!text-lg after:!font-bold hover:!bg-red-50"></div>
                    <div class="swiper-button-prev !left-4 !top-1/2 !mt-0 !h-10 !w-10 !rounded-full !border !border-gray-200 !bg-white !text-red-600 !shadow-lg transition-all duration-300 after:!text-lg after:!font-bold hover:!bg-red-50"></div>

                    <!-- Pagination -->
                    <div class="swiper-pagination !relative !bottom-0 !mt-8"></div>
                </div>
            </div>

            <!-- View All Categories Button -->
            <div class="mt-12 text-center">
                <a class="inline-flex items-center rounded-lg bg-red-600 px-6 py-3 font-semibold text-white transition-colors duration-200 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" href="#">
                    @svg('bi-grid-3x3-gap', 'w-5 h-5 mr-2')
                    {{ __('client/home.categories.view_all') }}
                </a>
            </div>
        </div>
    </section>

    {{-- Partner Hospitals --}}
    <section class="py-16">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="mb-12 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 md:text-4xl">{{ __('client/home.partners.title') }}</h2>
                <p class="mx-auto max-w-2xl text-lg text-gray-600">
                    {{ __('client/home.partners.description') }}
                </p>
            </div>

            <!-- Hospital Slider -->
            <div class="relative">
                <div id="hospital-slider" class="swiper overflow-visible">
                    <div class="swiper-wrapper py-6">
                        @foreach ($hospitals as $index => $hospital)
                            <div class="swiper-slide overflow-visible">
                                <div class="group relative">
                                    <a class="block transform transition-all duration-300 hover:scale-105" href="{{ $hospital->website ?? '#' }}" target="_blank">
                                        <div class="relative overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-lg transition-all duration-300 hover:shadow-2xl">
                                            <!-- Hospital Logo Section -->
                                            <div class="relative bg-gradient-to-br from-white to-gray-50 p-8 text-center transition-all duration-300 group-hover:from-blue-50 group-hover:to-blue-100">
                                                <div class="mx-auto mb-6 flex h-24 w-24 items-center justify-center rounded-full border-2 border-gray-100 bg-white shadow-lg transition-all duration-300 group-hover:border-blue-200">
                                                    @if ($hospital->logo)
                                                        <img class="h-20 w-20 rounded-full object-contain" src="{{ asset($hospital->logo) }}" alt="{{ $hospital->name }}" />
                                                    @else
                                                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-gray-100">
                                                            @svg('bi-hospital', 'w-10 h-10 text-gray-400')
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Hospital Info -->
                                                <div class="space-y-3">
                                                    <h3 class="line-clamp-2 text-lg font-bold text-gray-900 transition-colors duration-300 group-hover:text-blue-700">
                                                        {{ $hospital->name }}
                                                    </h3>

                                                    @if ($hospital->city)
                                                        <div class="flex items-center justify-center text-sm text-gray-600 transition-colors duration-300 group-hover:text-blue-600">
                                                            @svg('ionicon-location-outline', 'w-4 h-4 mr-1')
                                                            {{ $hospital->city }}
                                                        </div>
                                                    @endif

                                                    @if ($hospital->description)
                                                        <p class="line-clamp-2 text-sm text-gray-500 transition-colors duration-300 group-hover:text-gray-600">
                                                            {{ Str::limit($hospital->description, 100) }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Hospital Stats -->
                                            <div class="border-t border-gray-100 bg-white px-6 py-4">
                                                <div class="grid grid-cols-2 gap-4 text-center">
                                                    <!-- Doctor Count -->
                                                    <div class="group/stat">
                                                        <div class="mb-1 flex items-center justify-center">
                                                            @svg('bi-person-check', 'w-4 h-4 text-green-600 mr-1')
                                                            <span class="text-sm font-semibold text-gray-900">
                                                                {{ $hospital->doctor_count ?? 0 }}
                                                            </span>
                                                        </div>
                                                        <p class="text-xs text-gray-500">Bác sĩ</p>
                                                    </div>

                                                    <!-- Partnership Status -->
                                                    <div class="group/stat">
                                                        @php
                                                            $isActivePartner = $hospital->contract_end_date ? $hospital->contract_end_date->isFuture() : true;
                                                        @endphp
                                                        <p class="text-xs text-gray-500">Trạng thái</p>
                                                        <div class="mt-1 flex items-center justify-center">
                                                            @if ($isActivePartner)
                                                                @svg('bi-check-circle-fill', 'w-4 h-4 text-green-500 mr-1')
                                                                <span class="text-xs font-medium text-green-700">Đối tác</span>
                                                            @else
                                                                @svg('bi-clock', 'w-4 h-4 text-orange-500 mr-1')
                                                                <span class="text-xs font-medium text-orange-700">Hết hạn</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Contact Actions -->
                                            <div class="border-t border-gray-100 bg-gray-50 px-6 py-4">
                                                <div class="flex items-center justify-center space-x-4">
                                                    @if ($hospital->phone)
                                                        <a class="flex items-center text-xs text-gray-600 transition-colors duration-200 hover:text-blue-600" href="tel:{{ $hospital->phone }}">
                                                            @svg('bi-telephone', 'w-3 h-3 mr-1')
                                                            Gọi
                                                        </a>
                                                    @endif

                                                    @if ($hospital->website)
                                                        <a class="flex items-center text-xs text-gray-600 transition-colors duration-200 hover:text-blue-600" href="{{ $hospital->website }}" target="_blank">
                                                            @svg('bi-globe', 'w-3 h-3 mr-1')
                                                            Website
                                                        </a>
                                                    @endif

                                                    @if ($hospital->email)
                                                        <a class="flex items-center text-xs text-gray-600 transition-colors duration-200 hover:text-blue-600" href="mailto:{{ $hospital->email }}">
                                                            @svg('bi-envelope', 'w-3 h-3 mr-1')
                                                            Email
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Premium Badge -->
                                            @if ($isActivePartner && $hospital->contract_end_date)
                                                <div class="absolute right-4 top-4">
                                                    <span class="bg-gold-100 text-gold-800 border-gold-200 inline-flex items-center rounded-full border px-2 py-1 text-xs font-medium">
                                                        @svg('bi-star-fill', 'w-3 h-3 mr-1')
                                                        Premium
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Favorite Doctors --}}
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="mb-12 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 md:text-4xl">{{ __('client/home.favorite_doctors.title') }}</h2>
                <p class="mx-auto max-w-2xl text-lg text-gray-600">{{ __('client/home.favorite_doctors.description') }}</p>
            </div>
            <div id="doctor-slider" class="swiper overflow-visible">
                <div class="swiper-wrapper">
                    @foreach ($favoriteDoctors as $index => $doctor)
                        <div class="swiper-slide overflow-visible">
                            <div class="relative h-full overflow-visible rounded-2xl border border-gray-100 bg-white p-6 shadow-lg transition-all duration-300 hover:shadow-xl">
                                <!-- Doctor Info Section -->
                                <div class="mb-6 flex items-start gap-4">
                                    <a class="block flex-shrink-0" href="{{ route('appointment.info', ['doctor_profile_id' => $doctor['id']]) }}">
                                        <div class="h-20 w-20 overflow-hidden rounded-full border-2 border-red-100 transition-colors hover:border-red-300">
                                            <img class="h-full w-full object-cover" src="{{ asset($doctor['avatar']) }}" alt="{{ $doctor['name'] }}">
                                        </div>
                                    </a>

                                    <div class="min-w-0 flex-grow">
                                        <a class="group" href="{{ route('appointment.info', ['doctor_profile_id' => $doctor['id']]) }}">
                                            <div class="mb-1 flex items-center gap-2">
                                                <h3 class="truncate text-lg font-semibold text-gray-900 transition-colors group-hover:text-red-600">{{ $doctor['name'] }}</h3>
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
                                                Khoa {{ $doctor['medical_category'] }}
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
                                                {{ Str::limit($doctor['city'] . ' - ' . $doctor['country'], 30, '...') }}
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
                                                {{ number_format($doctor['service_price']) }}đ
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
                                                $isAvailable = \App\Models\WorkSchedule::isAvailable($doctor['id']) == 1;
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
                                        onclick="location.href='{{ route('appointment.step.one', ['doctor_profile_id' => $doctor['id']]) }}'">
                                        Đặt lịch khám
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Customer Reviews & Testimonials --}}
    <section class="py-16">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="mb-12 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 md:text-4xl">
                    {{ __('client/home.reviews.title') }}
                </h2>
                <p class="mx-auto max-w-2xl text-lg text-gray-600">
                    {{ __('client/home.reviews.description') }}
                </p>
            </div>

            <div class="relative">
                <div id="review-slider" class="swiper overflow-visible">
                    <div class="swiper-wrapper py-6">
                        @foreach ($reviews as $index => $review)
                            <div class="swiper-slide overflow-visible">
                                <div class="group relative">
                                    <div class="h-full rounded-2xl border border-gray-100 bg-white p-8 shadow-lg transition-all duration-300 hover:border-blue-200 hover:shadow-2xl">
                                        <!-- Quote Icon -->
                                        <div class="absolute right-6 top-6 opacity-20 transition-opacity duration-300 group-hover:opacity-30">
                                            @svg('bi-quote', 'w-8 h-8 text-blue-600')
                                        </div>

                                        <!-- Rating Stars - Review Categories/Tags -->
                                        <div class="mb-6 flex items-center">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review['rate'])
                                                    @svg('bi-star-fill', 'w-5 h-5 text-yellow-400 drop-shadow-sm')
                                                @else
                                                    @svg('bi-star', 'w-5 h-5 text-gray-300')
                                                @endif
                                            @endfor
                                            <span class="ml-3 text-lg font-semibold text-gray-700">{{ number_format($review['rate'], 1) }}/5</span>

                                            @php
                                                $reviewTags = [
                                                    5 => ['Xuất sắc', 'bg-green-100', 'text-green-800', 'border-green-200'],
                                                    4 => ['Tốt', 'bg-blue-100', 'text-blue-800', 'border-blue-200'],
                                                    3 => ['Trung bình', 'bg-yellow-100', 'text-yellow-800', 'border-yellow-200'],
                                                    2 => ['Khá', 'bg-orange-100', 'text-orange-800', 'border-orange-200'],
                                                    1 => ['Cần cải thiện', 'bg-red-100', 'text-red-800', 'border-red-200'],
                                                ];
                                                $tag = $reviewTags[round($review['rate'])] ?? $reviewTags[3];
                                            @endphp
                                            <!-- Badge positioned at bottom right to avoid overlap -->
                                            <div class="ml-4">
                                                <span class="{{ $tag[1] }} {{ $tag[2] }} {{ $tag[3] }} inline-flex items-center rounded-full border px-3 py-1 text-xs font-medium">
                                                    {{ $tag[0] }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Review Content -->
                                        <div class="mb-8">
                                            <p class="text-lg italic leading-relaxed text-gray-700">
                                                "{{ Str::limit($review['review'], 150) }}"
                                            </p>
                                            @if (strlen($review['review']) > 150)
                                                <button class="mt-2 text-sm font-medium text-blue-600 transition-colors duration-200 hover:text-blue-700">
                                                    {{ __('client/home.reviews.read_more') }}
                                                </button>
                                            @endif
                                        </div>

                                        <!-- Customer Info -->
                                        <div class="flex items-center justify-between border-t border-gray-100 pt-6">
                                            <div class="flex items-center space-x-4">
                                                <div class="relative">
                                                    @if ($review['avatar'])
                                                        <img class="h-12 w-12 rounded-full border-2 border-gray-200 object-cover" src="{{ $review['avatar'] }}" alt="{{ $review['name'] }}">
                                                    @else
                                                        <div class="flex h-12 w-12 items-center justify-center rounded-full border-2 border-gray-200 bg-gradient-to-br from-blue-400 to-blue-600 text-lg font-semibold text-white">
                                                            {{ strtoupper(substr($review['name'], 0, 1)) }}
                                                        </div>
                                                    @endif
                                                    <!-- Verified Badge -->
                                                    <div class="absolute -bottom-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full border-2 border-white bg-green-500">
                                                        @svg('bi-check', 'w-3 h-3 text-white font-bold')
                                                    </div>
                                                </div>

                                                <h4 class="font-semibold text-gray-900">{{ $review['name'] }}</h4>

                                            </div>

                                            <!-- Review Date -->
                                            <div class="text-right">
                                                <p class="text-sm text-gray-500">
                                                    {{ $review['created_at']->diffForHumans() }}
                                                </p>
                                                <div class="mt-1 flex items-center justify-end">
                                                    @svg('bi-calendar3', 'w-3 h-3 text-gray-400 mr-1')
                                                    <span class="text-xs text-gray-400">
                                                        {{ $review['created_at']->format('d/m/Y') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="swiper-pagination !relative !bottom-0 !mt-8"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Platform Statistics --}}
    <section class="relative overflow-hidden py-20">
        <div class="container relative z-10 mx-auto px-4">
            <!-- Section Header -->
            <div class="mb-16 text-center">
                <h2 class="mb-6 text-4xl font-bold text-black md:text-5xl">
                    {{ __('client/home.statistics.platform_statistics') }}
                </h2>
                <p class="mx-auto max-w-2xl text-lg text-gray-600">
                    {{ __('client/home.statistics.description') }}
                </p>
            </div>

            <!-- Statistics Grid -->
            <div class="mb-16 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
                <!-- Total Doctors -->
                <div class="group relative">
                    <div class="h-full rounded-2xl border border-white border-opacity-20 bg-white bg-opacity-10 p-8 text-center backdrop-blur-lg transition-all duration-300 hover:scale-105 hover:bg-opacity-20">
                        <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-blue-400 to-blue-600 shadow-lg">
                            @svg('bi-person-hearts', 'w-8 h-8 text-white')
                        </div>
                        <div class="counter mb-3 text-4xl font-bold text-black md:text-5xl" data-target="{{ $statistics['total_doctors'] }}">
                            0
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-black">{{ __('client/home.statistics.total_doctors') }}</h3>
                        <p class="text-sm text-gray-600">
                            {{ __('client/home.statistics.total_doctors_description') }}
                        </p>
                    </div>
                </div>

                <!-- Total Hospitals -->
                <div class="group relative">
                    <div class="h-full rounded-2xl border border-white border-opacity-20 bg-white bg-opacity-10 p-8 text-center backdrop-blur-lg transition-all duration-300 hover:scale-105 hover:bg-opacity-20">
                        <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-green-400 to-green-600 shadow-lg">
                            @svg('bi-hospital', 'w-8 h-8 text-white')
                        </div>
                        <div class="counter mb-3 text-4xl font-bold text-black md:text-5xl" data-target="{{ $statistics['total_hospitals'] }}">
                            0
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-black">{{ __('client/home.statistics.total_hospitals') }}</h3>
                        <p class="text-sm text-gray-600">{{ __('client/home.statistics.total_doctors_description') }}</p>
                    </div>
                </div>

                <!-- Total Appointments -->
                <div class="group relative">
                    <div class="h-full rounded-2xl border border-white border-opacity-20 bg-white bg-opacity-10 p-8 text-center backdrop-blur-lg transition-all duration-300 hover:scale-105 hover:bg-opacity-20">
                        <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-purple-400 to-purple-600 shadow-lg">
                            @svg('bi-calendar-check', 'w-8 h-8 text-white')
                        </div>
                        <div class="counter mb-3 text-4xl font-bold text-black md:text-5xl" data-target="{{ $statistics['total_appointments'] }}">
                            0
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-black">{{ __('client/home.statistics.total_appointments') }}</h3>
                        <p class="text-sm text-gray-600">{{ __('client/home.statistics.total_appointments_description') }}</p>
                    </div>
                </div>

                <!-- Satisfied Patients -->
                <div class="group relative">
                    <div class="h-full rounded-2xl border border-white border-opacity-20 bg-white bg-opacity-10 p-8 text-center backdrop-blur-lg transition-all duration-300 hover:scale-105 hover:bg-opacity-20">
                        <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 shadow-lg">
                            @svg('bi-emoji-smile', 'w-8 h-8 text-white')
                        </div>
                        <div class="counter mb-3 text-4xl font-bold text-black md:text-5xl" data-target="{{ $statistics['satisfied_patients'] }}">
                            0
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-black">{{ __('client/home.statistics.total_satisfied_patients') }}</h3>
                        <p class="text-sm text-gray-600">{{ __('client/home.statistics.total_appointments_description') }}</p>
                    </div>
                </div>
            </div>

            <!-- Additional Statistics Row -->
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <!-- Average Rating -->
                <div class="rounded-2xl border border-white border-opacity-20 bg-white bg-opacity-10 p-8 text-center backdrop-blur-lg">
                    <div class="mb-4 flex items-center justify-center">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= round($statistics['average_rating']))
                                @svg('bi-star-fill', 'w-6 h-6 text-yellow-400 mx-1')
                            @else
                                @svg('bi-star', 'w-6 h-6 text-gray-400 mx-1')
                            @endif
                        @endfor
                    </div>
                    <div class="mb-2 text-3xl font-bold text-black">
                        {{ number_format($statistics['average_rating'], 1) }}/5
                    </div>
                    <h3 class="mb-1 text-lg font-semibold text-black">{{ __('client/home.statistics.avarage_rating') }}</h3>
                    <p class="text-sm text-gray-600">
                        {{ __('client/home.statistics.avarage_rating_description', ['number' => number_format($statistics['total_reviews'])]) }}
                    </p>
                </div>

                <!-- Medical Categories -->
                <div class="rounded-2xl border border-white border-opacity-20 bg-white bg-opacity-10 p-8 text-center backdrop-blur-lg">
                    <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-red-400 to-pink-500">
                        @svg('bi-grid-3x3-gap', 'w-6 h-6 text-white')
                    </div>
                    <div class="counter mb-2 text-3xl font-bold text-black" data-target="{{ $statistics['total_categories'] }}">
                        0
                    </div>
                    <h3 class="mb-1 text-lg font-semibold text-black">{{ __('client/home.statistics.medical_categories') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('client/home.statistics.medical_categories_description') }}</p>
                </div>

                <!-- Active Partnerships -->
                <div class="rounded-2xl border border-white border-opacity-20 bg-white bg-opacity-10 p-8 text-center backdrop-blur-lg">
                    <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-teal-400 to-cyan-500">
                        @svg('bi-check-circle', 'w-6 h-6 text-white')
                    </div>
                    <div class="counter mb-2 text-3xl font-bold text-black" data-target="{{ $statistics['active_hospitals'] }}">
                        0
                    </div>
                    <h3 class="mb-1 text-lg font-semibold text-black">{{ __('client/home.statistics.active_partners') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('client/home.statistics.active_partners_description') }}</p>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="mt-16 text-center">
                <div class="inline-flex flex-col items-center gap-6 md:flex-row">
                    <div class="text-center md:text-left">
                        <h3 class="mb-2 text-2xl font-bold text-black">{{ __('client/home.statistics.call_to_action_title') }}</h3>
                        <p class="text-gray-600">{{ __('client/home.statistics.call_to_action_description') }}</p>
                    </div>
                    <div class="flex flex-col gap-4 sm:flex-row">
                        <a class="inline-flex items-center rounded-xl bg-red-600 px-8 py-4 font-semibold text-white shadow-lg transition-colors duration-200 hover:bg-red-400" href="#">
                            @svg('bi-building', 'w-5 h-5 mr-2')
                            {{ __('client/home.statistics.call_to_action_button') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Category Slider
            const categorySwiper = new Swiper('#category-slider', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 30,
                    },
                    1280: {
                        slidesPerView: 5,
                        spaceBetween: 30,
                    },
                }
            });

            // Hospital/Partner Slider
            const hospitalSwiper = new Swiper('#hospital-slider', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 30,
                    },
                    1280: {
                        slidesPerView: 4,
                        spaceBetween: 30,
                    },
                }
            });

            // Doctor Slider
            const doctorSwiper = new Swiper('#doctor-slider', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 30,
                    },
                    1280: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                }
            });

            // Review Slider
            const reviewSwiper = new Swiper('#review-slider', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 4500,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    1280: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                }
            });

            // Counter Animation for Statistics
            function animateCounters() {
                const counters = document.querySelectorAll('.counter');
                const speed = 2000; // Animation duration in ms

                counters.forEach(counter => {
                    const target = parseInt(counter.getAttribute('data-target'));
                    const increment = target / (speed / 16); // 60fps
                    let current = 0;

                    const updateCounter = () => {
                        if (current < target) {
                            current += increment;
                            counter.textContent = Math.floor(current).toLocaleString();
                            requestAnimationFrame(updateCounter);
                        } else {
                            counter.textContent = target.toLocaleString();
                        }
                    };

                    updateCounter();
                });
            }

            // Intersection Observer for triggering counter animation
            const statisticsSection = document.querySelector('section:has(.counter)');
            if (statisticsSection) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            animateCounters();
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.5
                });

                observer.observe(statisticsSection);
            }
        });
    </script>
@endpush
