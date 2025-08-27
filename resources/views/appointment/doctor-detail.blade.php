@extends('layouts.app')

@push('styles')
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-card {
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        }

        .quick-stat:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Rating Progress Bars */
        .rating-bar {
            height: 8px;
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
            border-radius: 4px;
            overflow: hidden;
            position: relative;
        }

        .rating-progress {
            height: 100%;
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            border-radius: 4px;
            transition: width 0.6s ease;
        }

        /* Review Cards */
        .review-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(249, 250, 251, 0.8));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .review-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #ff6467, #DF1D32);
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background: linear-gradient(135deg, #ff6467, #DF1D32);
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(223, 29, 50, 0.4), 0 10px 10px -5px rgba(255, 100, 103, 0.1);
        }

        .service-item {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .service-item:hover {
            border-left-color: #DF1D32;
            background: linear-gradient(90deg, #f0f9ff 0%, #ffffff 100%);
            transform: translateX(8px);
        }

        /* Time slot styling */
        .time-slot {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .time-slot:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.15), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
        }

        .time-slot.selected {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8) !important;
            color: white !important;
            border-color: #1d4ed8 !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -3px rgba(59, 130, 246, 0.4), 0 4px 6px -2px rgba(59, 130, 246, 0.1);
        }

        .time-slot:disabled {
            cursor: not-allowed;
            opacity: 0.6;
        }

        .day-item {
            transition: all 0.2s ease;
        }

        .day-item:hover:not(.opacity-40) {
            transform: translateY(-2px);
        }

        .review-card {
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #fafafa 0%, #ffffff 100%);
        }

        .review-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        }

        .rating-bar {
            height: 8px;
            border-radius: 4px;
            background: #e5e7eb;
            overflow: hidden;
            position: relative;
        }

        .rating-progress {
            height: 100%;
            background: linear-gradient(90deg, #fbbf24, #f59e0b);
            border-radius: 4px;
            transition: width 0.8s ease;
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .floating-shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }
    </style>
@endpush

@section('content')
    <div class="relative min-h-screen overflow-hidden">

        <div class="relative z-10 mx-auto max-w-6xl p-4 md:p-8">
            <div class="glass-card animate-fade-in rounded-3xl p-6 shadow-2xl md:p-10">
                <div class="animate-slide-up mb-12 flex flex-col items-center gap-8 lg:flex-row">
                    <div class="relative">
                        <div class="h-32 w-32 overflow-hidden rounded-full shadow-2xl ring-4 ring-white ring-offset-4 ring-offset-transparent">
                            <img class="h-full w-full object-cover" src="{{ asset($doctorProfile->user->avatar) }}" alt="{{ $doctorProfile->user->name }}">
                        </div>
                        <div class="absolute -bottom-2 -right-2 flex h-10 w-10 items-center justify-center rounded-full border-4 border-white bg-green-500">
                            <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex-1 text-center lg:text-left">
                        <h1 class="mb-2 text-3xl font-bold text-gray-800 md:text-4xl">{{ $doctorProfile->user->name }}</h1>
                        <p class="mb-4 text-xl font-semibold text-[#DF1D32]">Bác Sĩ Khoa {{ $doctorProfile->medicalCategory->name }}</p>
                        @if ($doctorProfile->introduce)
                            <p class="max-w-3xl text-lg leading-relaxed text-gray-600">{{ $doctorProfile->introduce }}</p>
                        @endif

                        <div class="mt-6 flex flex-wrap justify-center gap-4 lg:justify-start">
                            <div class="flex items-center gap-2 rounded-full bg-red-50 px-4 py-2">
                                <svg class="h-5 w-5 text-[#DF1D32]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                                <span class="font-medium text-[#DF1D32]">{{ $doctorProfile->user->city }} - {{ $doctorProfile->user->country }}</span>
                            </div>

                            @php
                                $rate = $doctorProfile->reviews_avg_rate ?? 0;
                                $count = $doctorProfile->reviews_count ?? 0;
                                $roundedRate = $rate > 0 ? round($rate * 2) / 2 : 0;
                            @endphp

                            <div class="flex items-center gap-2 rounded-full bg-yellow-50 px-4 py-2">
                                <svg class="h-5 w-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="font-medium text-yellow-700">
                                    {{ $rate > 0 ? number_format($roundedRate, 1) : 'Not rated' }}
                                    <span class="text-gray-500">({{ $count }} Đánh Giá)</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Stats --}}
                @php
                    $isAvailable = \App\Models\WorkSchedule::isAvailable($doctorProfile->id) == 1;
                @endphp

                <div class="animate-slide-up mb-12 grid grid-cols-1 gap-6 sm:grid-cols-3" style="animation-delay: 0.2s;">
                    <div class="stat-card rounded-2xl p-6 text-center shadow-lg">
                        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-red-100">
                            <svg class="h-8 w-8 text-[#DF1D32]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                            </svg>
                        </div>
                        <h3 class="mb-2 text-2xl font-bold text-gray-800">{{ $count }}+</h3>
                        <p class="text-gray-600">Bệnh nhân hài lòng</p>
                    </div>

                    <div class="stat-card rounded-2xl p-6 text-center shadow-lg">
                        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
                            <svg class="h-8 w-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="mb-2 text-2xl font-bold text-gray-800">5+</h3>
                        <p class="text-gray-600">Kinh nghiệm</p>
                    </div>

                    <div class="stat-card rounded-2xl p-6 text-center shadow-lg">
                        <div class="{{ $isAvailable ? 'bg-green-100' : 'bg-red-100' }} mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full">
                            <svg class="{{ $isAvailable ? 'text-green-600' : 'text-[#DF1D32]' }} h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="{{ $isAvailable ? 'text-green-600' : 'text-[#DF1D32]' }} mb-2 text-lg font-bold">
                            {{ $isAvailable ? 'Available' : 'Busy' }}
                        </h3>
                        <p class="text-gray-600">Tình trạng hiện tại</p>
                    </div>
                </div>

                {{-- Services --}}
                <div class="animate-slide-up mb-12" style="animation-delay: 0.4s;">
                    <h2 class="mb-6 flex items-center gap-3 text-2xl font-bold text-gray-800">
                        <svg class="h-6 w-6 text-[#DF1D32]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Dịch vụ y tế
                    </h2>
                    <div class="rounded-2xl bg-white p-6 shadow-lg">
                        <div class="space-y-1">
                            @forelse ($doctorProfile->services as $item)
                                @if (!$item->is_active)
                                    @continue
                                @endif
                                <div class="service-item rounded-xl p-4">
                                    <div class="flex items-center gap-4">
                                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-gradient-to-br from-red-400 to-red-600 shadow-lg">
                                            <svg class="h-7 w-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm8 0a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1h-4a1 1 0 01-1-1V8z" clip-rule="evenodd" />
                                            </svg>
                                        </div>

                                        <div class="flex-1">
                                            <h3 class="mb-1 text-lg font-bold text-gray-800">{{ $item->name }}</h3>
                                            @if ($item->description)
                                                <p class="text-sm leading-relaxed text-gray-600">{{ $item->description }}</p>
                                            @endif
                                            <div class="mt-2 flex items-center gap-2">
                                                <svg class="h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-sm font-medium text-green-600">Khả dụng</span>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <div class="mb-1 text-2xl font-bold text-[#DF1D32]">
                                                {{ number_format($item->price, 0, ',', '.') }}đ
                                            </div>
                                            <p class="text-sm text-gray-500">mỗi phiên</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="py-12 text-center">
                                    <svg class="mx-auto mb-4 h-16 w-16 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    <h3 class="mb-2 text-lg font-semibold text-gray-500">Không có dịch vụ có sẵn</h3>
                                    <p class="text-gray-400">Bác sĩ này chưa thêm bất kỳ dịch vụ nào.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Available time --}}
                <div class="animate-slide-up mb-12" style="animation-delay: 0.5s;">
                    <h2 class="mb-6 flex items-center gap-3 text-2xl font-bold text-gray-800">
                        <svg class="h-6 w-6 text-[#DF1D32]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                        Lịch trình có sẵn
                    </h2>
                    <div class="rounded-2xl bg-white p-6 shadow-lg">
                        {{-- Calendar header with Prev/Next --}}
                        <div class="mb-6 flex items-center justify-between">
                            <div id="monthYear" class="text-xl font-bold text-gray-800"></div>
                            <div class="flex gap-2">
                                <button id="prevMonth" class="flex items-center gap-2 rounded-lg bg-gray-100 px-4 py-2 transition-colors hover:bg-gray-200" type="button">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    Trước
                                </button>
                                <button id="nextMonth" class="flex items-center gap-2 rounded-lg bg-gray-100 px-4 py-2 transition-colors hover:bg-gray-200" type="button">
                                    Sau
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Days row --}}
                        <div class="mb-6 border-b border-gray-200 pb-4">
                            <div id="calendarDays" class="grid grid-cols-7 gap-3"></div>
                        </div>

                        {{-- Time slots --}}
                        <div class="mb-4">
                            <h3 class="mb-6 flex items-center gap-2 text-lg font-semibold text-gray-700">
                                <svg class="h-5 w-5 text-[#DF1D32]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                Thời gian khả dụng
                            </h3>
                            <div id="timeSlots" class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6"></div>
                        </div>

                        <div id="noSlotsMessage" class="hidden py-8 text-center">
                            <div class="flex items-center rounded-xl border border-amber-200 bg-amber-50 p-6">
                                <svg class="mr-3 h-6 w-6 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                <div class="text-left">
                                    <h3 class="text-lg font-semibold text-amber-800">Không có thời gian có sẵn</h3>
                                    <p class="text-amber-700">Vui lòng chọn một ngày khác hoặc kiểm tra lại sau.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Reviews Section --}}
                <div class="animate-slide-up mb-12" style="animation-delay: 0.6s;">
                    <div class="mb-6 flex items-center justify-between">
                        <h2 class="flex items-center gap-3 text-2xl font-bold text-gray-800">
                            <svg class="h-6 w-6 text-[#DF1D32]" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            Đánh giá của bệnh nhân
                        </h2>
                        <button class="font-medium text-[#DF1D32] transition-colors hover:text-red-800">
                            Xem tất cả các đánh giá →
                        </button>
                    </div>

                    {{-- Rating Overview --}}
                    <div class="mb-6 rounded-2xl bg-white p-6 shadow-lg">
                        <div class="grid gap-8 md:grid-cols-2">
                            <div class="text-center">
                                <div class="mb-2 text-5xl font-bold text-[#DF1D32]">{{ $rate > 0 ? number_format($roundedRate, 1) : '0.0' }}</div>
                                <div class="mb-2 flex justify-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="{{ $i <= $roundedRate ? 'text-yellow-400' : 'text-gray-300' }} h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                                <p class="text-gray-600">Dựa trên {{ $count }} Đánh giá</p>
                            </div>

                            <div class="space-y-3">
                                @php
                                    $ratings = [];
                                    for ($i = 5; $i >= 1; $i--) {
                                        $ratings[$i] = $doctorProfile->testimonials[$i - 1]['total'];
                                    }

                                    $total = array_sum($ratings);
                                @endphp
                                @foreach ($ratings as $star => $count)
                                    <div class="flex items-center gap-3">
                                        <div class="flex w-16 items-center gap-1">
                                            <span class="text-sm font-medium">{{ $star }}</span>
                                            <svg class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                        <div class="rating-bar flex-1">
                                            <div class="rating-progress" style="width: {{ $total > 0 ? ($count / $total) * 100 : 0 }}%"></div>
                                        </div>
                                        <span class="w-8 text-sm font-medium text-gray-600">{{ $count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Recent Reviews --}}
                    @if ($doctorProfile->reviews && $doctorProfile->reviews->count() > 0)
                        <div class="space-y-4">
                            @foreach ($doctorProfile->reviews->take(3) as $review)
                                <div class="review-card rounded-xl p-6 shadow-md">
                                    <div class="flex gap-4">
                                        <img class="h-12 w-12 rounded-full border-2 border-gray-200 object-cover" src="{{ $review->patient->user->avatar }}" alt="patient avatar">
                                        <div class="flex-1">
                                            <div class="mb-2 flex items-center justify-between">
                                                <div>
                                                    <h4 class="font-semibold text-gray-800">{{ $review->patient->user->name ?? 'Anonymous' }}</h4>
                                                    <div class="flex items-center gap-2">
                                                        <div class="flex">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <svg class="{{ $i <= $review->rate ? 'text-yellow-400' : 'text-gray-300' }} h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path
                                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                                </svg>
                                                            @endfor
                                                        </div>
                                                        <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="leading-relaxed text-gray-600">{{ $review->review }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="review-card rounded-xl p-8 text-center">
                            <svg class="mx-auto mb-4 h-16 w-16 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" />
                            </svg>
                            <h3 class="mb-2 text-lg font-semibold text-gray-500">Chưa có đánh giá nào</h3>
                            <p class="text-gray-400">Hãy là người đầu tiên để lại đánh giá cho bác sĩ này!</p>
                        </div>
                    @endif
                </div>

                <div class="animate-slide-up text-center" style="animation-delay: 0.7s;">
                    <button class="btn-primary-custom inline-flex items-center gap-3 rounded-2xl px-8 py-4 text-lg font-semibold text-white shadow-xl" onclick="location.href='{{ route('appointment.step.one', ['doctor_profile_id' => $doctorProfile->id]) }}'">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        Đặt cuộc hẹn ngay bây giờ
                    </button>
                    <p class="mt-4 text-gray-500">Đảm bảo cuộc hẹn của bạn chỉ trong một vài cú nhấp chuột</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const workSchedules = @json($workSchedules);
        let currentDate = new Date();
        let selectedDateOffset = 0;

        function markDaySelected(btn, selected) {
            const name = btn.querySelector('.day-name');
            const num = btn.querySelector('.day-num');
            const underline = btn.querySelector('.day-underline');

            if (selected) {
                name.classList.add('text-red-700');
                num.classList.add('text-red-700');
                underline.classList.add('border-b-2', 'border-red-600', 'bg-transparent');
            } else {
                name.classList.remove('text-red-700');
                num.classList.remove('text-red-700');
                underline.classList.remove('border-b-2', 'border-red-600', 'bg-transparent');
            }
        }

        function markTimeSelected(btn, selected) {
            if (selected) {
                // filled red pill (selected)
                btn.classList.remove('btn-outline', 'border-base-300', 'text-base-content');
                btn.classList.add('btn-danger', 'text-error-content', 'border-error');
                btn.dataset.selected = '1';
            } else {
                // outlined pill (idle)
                btn.classList.add('btn-outline', 'border-base-300', 'text-base-content');
                btn.classList.remove('btn-danger', 'text-error-content', 'border-error');
                delete btn.dataset.selected;
            }
        }

        // Initialize calendar
        document.addEventListener('DOMContentLoaded', function() {
            initCalendar();
        });

        function initCalendar() {
            updateCalendar();
        }

        function updateCalendar() {
            const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

            // month/year
            const displayDate = new Date(currentDate);
            displayDate.setDate(displayDate.getDate() + selectedDateOffset);
            document.getElementById('monthYear').textContent =
                `${monthNames[displayDate.getMonth()]}, ${displayDate.getFullYear()}`;

            // generate 7 days
            const calendarDays = document.getElementById('calendarDays');
            calendarDays.innerHTML = '';
            let firstAvailableDay = -1;

            for (let i = 0; i < 7; i++) {
                const date = new Date(currentDate);
                date.setDate(date.getDate() + selectedDateOffset + i);

                const isAvailable = isDayAvailable(date);
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'day-item flex flex-col items-center gap-1 text-xs transition';

                if (!isAvailable) btn.classList.add('opacity-40', 'pointer-events-none');

                btn.innerHTML = `
                        <input type="radio" name="date" class="hidden day-radio">
                        <span class="day-name text-[11px] text-base-content/60 font-medium">${dayNames[date.getDay()]}</span>
                        <span class="day-num text-sm font-semibold">${date.getDate().toString().padStart(2, '0')}</span>
                        <span class="day-underline block h-0.5 w-8 rounded bg-transparent"></span>
                        `;

                // default select first available
                if (isAvailable && firstAvailableDay === -1) {
                    firstAvailableDay = i;
                    markDaySelected(btn, true);
                    btn.querySelector('.day-radio').checked = true;
                }

                if (isAvailable) {
                    btn.addEventListener('click', function() {
                        document.querySelectorAll('#calendarDays .day-item').forEach(d => markDaySelected(d,
                            false));
                        markDaySelected(this, true);
                        this.querySelector('.day-radio').checked = true;
                        updateTimeSlots(date);
                    });
                }

                calendarDays.appendChild(btn);
            }

            if (firstAvailableDay !== -1) {
                const firstDate = new Date(currentDate);
                firstDate.setDate(firstDate.getDate() + selectedDateOffset + firstAvailableDay);
                updateTimeSlots(firstDate);
            } else {
                updateTimeSlots(null);
            }
        }

        document.getElementById('prevMonth').addEventListener('click', function() {
            selectedDateOffset -= 7;
            updateCalendar();
        });
        document.getElementById('nextMonth').addEventListener('click', function() {
            selectedDateOffset += 7;
            updateCalendar();
        });

        function isDayAvailable(date) {
            const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const monthKey = monthNames[date.getMonth()];
            const dayKey = date.getDate().toString().padStart(2, '0');
            if (!workSchedules[monthKey] || !workSchedules[monthKey][dayKey]) return false;
            const daySchedule = workSchedules[monthKey][dayKey];
            return daySchedule.some(slot => slot.is_available && slot.time !== null);
        }

        function updateTimeSlots(selectedDate) {
            const timeSlotsContainer = document.getElementById('timeSlots');
            const noSlotsMessage = document.getElementById('noSlotsMessage');
            timeSlotsContainer.innerHTML = '';

            if (!selectedDate) {
                noSlotsMessage.classList.remove('hidden');
                return;
            }

            const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const monthKey = monthNames[selectedDate.getMonth()];
            const dayKey = selectedDate.getDate().toString().padStart(2, '0');

            if (!workSchedules[monthKey] || !workSchedules[monthKey][dayKey]) {
                noSlotsMessage.classList.remove('hidden');
                return;
            }

            // Show all slots (available, disabled, full) so UI can mimic the mock
            const slots = workSchedules[monthKey][dayKey]
                .filter(s => s.time !== null)
                .sort((a, b) => convertTo24Hour(a.time).localeCompare(convertTo24Hour(b.time)));

            if (!slots.length) {
                noSlotsMessage.classList.remove('hidden');
                return;
            }

            noSlotsMessage.classList.add('hidden');

            let firstSelectableBtn = null;

            slots.forEach((slot) => {
                const timeValue = convertTo24Hour(slot.time);

                // infer states
                const isFull = !!(slot.is_full || slot.status === 'full');
                const isAvailable = !!(slot.is_available && !isFull);
                const isDisabled = !isAvailable && !isFull;

                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = [
                    'time-slot', 'relative', 'overflow-hidden', 'rounded-xl', 'border-2', 'px-4', 'py-3',
                    'text-sm', 'font-medium', 'transition-all', 'duration-300', 'min-h-[3.5rem]',
                    'flex', 'flex-col', 'items-center', 'justify-center'
                ].join(' ');

                // Base label: time on first line; second line small note if "full"
                const timeDisplay = formatTime12Hour(timeValue);
                const secondary = isFull ? '<div class="text-xs opacity-90 mt-1">Full</div>' : '';
                btn.innerHTML = `
                    <input type="radio" name="time" value="${timeValue}" class="hidden time-radio" ${isAvailable ? '' : 'disabled'}>
                    <div class="text-center">
                        <div class="font-semibold">${timeDisplay}</div>
                        ${secondary}
                    </div>
                `;

                if (isAvailable) {
                    btn.classList.add('bg-white', 'text-gray-700', 'border-gray-200', 'hover:bg-gray-50', 'hover:border-red-500', 'hover:shadow-md');
                    btn.addEventListener('click', function() {
                        document.querySelectorAll('#timeSlots .time-slot').forEach(s => markTimeSelected(s, false));
                        markTimeSelected(this, true);
                        this.querySelector('.time-radio').checked = true;
                    });
                    if (!firstSelectableBtn) firstSelectableBtn = btn;
                } else if (isFull) {
                    // solid red pill, not selectable
                    btn.classList.add('bg-gradient-to-r', 'from-red-500', 'to-red-600', 'text-white', 'border-red-500', 'cursor-not-allowed');
                    btn.disabled = true;
                } else {
                    // disabled grey outline
                    btn.classList.add('bg-gray-100', 'text-gray-400', 'border-gray-200', 'cursor-not-allowed');
                    btn.disabled = true;
                }

                timeSlotsContainer.appendChild(btn);
            });

            // Auto-select the first available slot
            if (firstSelectableBtn) {
                markTimeSelected(firstSelectableBtn, true);
                firstSelectableBtn.querySelector('.time-radio').checked = true;
            }
        }

        function convertTo24Hour(timeStr) {
            const [time, period] = timeStr.split(' ');
            let [hours, minutes] = time.split(':');
            if (period === 'PM' && hours !== '12') hours = (parseInt(hours) + 12).toString();
            else if (period === 'AM' && hours === '12') hours = '00';
            return `${hours.padStart(2, '0')}:${minutes}`;
        }

        function formatTime12Hour(time24) {
            const [hours, minutes] = time24.split(':');
            const hour12 = hours === '00' ? '12' : hours > 12 ? (hours - 12).toString() : hours;
            const period = hours >= 12 ? 'PM' : 'AM';
            return `${hour12}:${minutes} ${period}`;
        }

        function formatTimeForDisplay(timeStr) {
            const [time, period] = timeStr.split(' ');
            return `${time}<br><span class="text-xs opacity-70">${period}</span>`;
        }
    </script>
@endpush
