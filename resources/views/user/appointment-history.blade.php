@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/appointment-history.css') }}">
    <style>
        /* Modal animations */
        .animate-scale-in {
            animation: scaleIn 0.3s ease-out;
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Star rating styles */
        .star {
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .star:hover {
            transform: scale(1.1);
        }

        /* Ripple animation for buttons */
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Modal backdrop blur */
        .modal-backdrop {
            backdrop-filter: blur(4px);
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen py-8">
        <div class="container mx-auto px-4">
            <!-- Phần tiêu đề -->
            <div class="animate-fade-in-left mb-8">
                <div class="glass-card rounded-3xl p-8 shadow-2xl">
                    <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                        <!-- Thông tin tiêu đề -->
                        <div class="flex items-center gap-6">
                            <div class="animate-scale-in relative">
                                <div class="h-16 w-16 overflow-hidden rounded-full bg-gradient-to-br from-red-200 to-red-700 p-1">
                                    <div class="h-full w-full overflow-hidden rounded-full">
                                        <img class="h-full w-full object-cover" src="{{ asset($user->avatar) }}" alt="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="animate-pulse-slow absolute -bottom-1 -right-1 flex h-6 w-6 items-center justify-center rounded-full border-2 border-white bg-green-500">
                                    <x-heroicon-s-clock class="h-3 w-3 text-white" />
                                </div>
                            </div>
                            <div class="animate-fade-in-right">
                                <h1 class="mb-2 text-3xl font-bold text-red-500">Lịch sử đặt khám</h1>
                                <p class="mb-1 text-gray-600">
                                    Xem lại tất cả các cuộc hẹn của bạn
                                </p>
                                <p class="flex items-center gap-2 text-sm text-gray-500">
                                    <x-heroicon-o-user class="h-4 w-4" />
                                    {{ $user->name }}
                                </p>
                            </div>
                        </div>

                        <!-- Nút điều hướng -->
                        <div class="animate-slide-down flex gap-3">
                            <a class="flex items-center gap-2 rounded-xl bg-gradient-to-r from-gray-500 to-gray-600 px-4 py-2 text-sm font-semibold text-white transition-all duration-300 hover:scale-105 hover:from-gray-600 hover:to-gray-700 hover:shadow-lg" href="{{ route('profile.index') }}">
                                <x-heroicon-s-arrow-left class="h-4 w-4" />
                                Quay lại hồ sơ
                            </a>
                            <a class="animate-bounce-subtle flex items-center gap-2 rounded-xl bg-gradient-to-r from-red-500 to-red-600 px-4 py-2 text-sm font-semibold text-white transition-all duration-300 hover:scale-105 hover:from-red-600 hover:to-red-700 hover:shadow-lg" href="{{ route('appointment.index') }}">
                                <x-heroicon-s-plus class="h-4 w-4" />
                                Đặt lịch mới
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thống kê tổng quan -->
            <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3 lg:grid-cols-5">
                <!-- Tổng số cuộc hẹn -->
                <div class="stat-card animate-slide-up-delay-1 rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Tổng số</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $statistics['total'] }}</p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100">
                            <x-heroicon-m-calendar-days class="h-5 w-5 text-blue-600" />
                        </div>
                    </div>
                </div>

                <!-- Hoàn thành -->
                <div class="stat-card animate-slide-up-delay-2 rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Hoàn thành</p>
                            <p class="text-2xl font-bold text-green-600">{{ $statistics['completed'] }}</p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-100">
                            <x-heroicon-m-check-circle class="h-5 w-5 text-green-600" />
                        </div>
                    </div>
                </div>

                <!-- Sắp tới -->
                <div class="stat-card animate-slide-up-delay-3 rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Sắp tới</p>
                            <p class="text-2xl font-bold text-blue-600">{{ $statistics['upcoming'] }}</p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100">
                            <x-heroicon-m-clock class="h-5 w-5 text-blue-600" />
                        </div>
                    </div>
                </div>

                <!-- Chờ xác nhận -->
                <div class="stat-card animate-slide-up-delay-4 rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Chờ xác nhận</p>
                            <p class="text-2xl font-bold text-orange-600">{{ $statistics['pending'] }}</p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-100">
                            <x-heroicon-m-clock class="h-5 w-5 text-orange-600" />
                        </div>
                    </div>
                </div>

                <!-- Đã hủy -->
                <div class="stat-card animate-slide-up-delay-5 rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Đã hủy</p>
                            <p class="text-2xl font-bold text-red-600">{{ $statistics['cancelled'] }}</p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-100">
                            <x-heroicon-m-x-circle class="h-5 w-5 text-red-600" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bộ lọc trạng thái -->
            <div class="animate-slide-up-delay-2 mb-8">
                <div class="glass-card rounded-3xl p-6 shadow-2xl">
                    <div class="animate-fade-in-left mb-4 flex items-center gap-3">
                        <x-heroicon-s-funnel class="h-6 w-6 text-red-600" />
                        <h3 class="text-lg font-bold text-gray-800">Lọc theo trạng thái</h3>
                    </div>

                    <div class="animate-fade-in-right flex flex-wrap gap-3">
                        <a class="filter-btn btn btn-outline {{ !request('status') ? 'active' : '' }}" href="{{ route('profile.appointment-history') }}">
                            <x-heroicon-m-squares-2x2 class="h-4 w-4" />
                            Tất cả
                        </a>

                        <a class="filter-btn btn btn-outline {{ request('status') === 'completed' ? 'active' : '' }}" href="{{ route('profile.appointment-history', ['status' => 'completed']) }}">
                            <x-heroicon-m-check-circle class="h-4 w-4" />
                            Hoàn thành
                        </a>

                        <a class="filter-btn btn btn-outline {{ in_array(request('status'), ['upcoming', 'confirmed']) ? 'active' : '' }}" href="{{ route('profile.appointment-history', ['status' => 'upcoming']) }}">
                            <x-heroicon-m-clock class="h-4 w-4" />
                            Sắp tới
                        </a>

                        <a class="filter-btn btn btn-outline {{ request('status') === 'pending' ? 'active' : '' }}" href="{{ route('profile.appointment-history', ['status' => 'pending']) }}">
                            <x-heroicon-m-exclamation-triangle class="h-4 w-4" />
                            Chờ xác nhận
                        </a>

                        <a class="filter-btn btn btn-outline {{ request('status') === 'cancelled' ? 'active' : '' }}" href="{{ route('profile.appointment-history', ['status' => 'cancelled']) }}">
                            <x-heroicon-m-x-circle class="h-4 w-4" />
                            Đã hủy
                        </a>

                        <a class="filter-btn btn btn-outline {{ request('status') === 'rejected' ? 'active' : '' }}" href="{{ route('profile.appointment-history', ['status' => 'rejected']) }}">
                            <x-heroicon-m-no-symbol class="h-4 w-4" />
                            Từ chối
                        </a>
                    </div>
                </div>
            </div>

            <!-- Danh sách cuộc hẹn -->
            <div class="glass-card animate-slide-up-delay-3 rounded-3xl p-8 shadow-2xl">
                <div class="animate-fade-in-left mb-6 flex items-center gap-3">
                    <x-heroicon-s-clipboard-document-list class="h-7 w-7 text-red-600" />
                    <h2 class="text-2xl font-bold text-gray-800">Danh sách cuộc hẹn</h2>
                </div>

                @if ($appointments->count() > 0)
                    <div class="space-y-4">
                        @foreach ($appointments as $index => $appointment)
                            <div class="appointment-card stagger-item rounded-2xl p-6 shadow-lg" style="animation-delay: {{ 0.1 * ($index + 1) }}s">
                                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                                    <!-- Thông tin bác sĩ và dịch vụ -->
                                    <div class="flex items-center gap-4">
                                        <div class="doctor-avatar h-16 w-16 overflow-hidden rounded-full p-1">
                                            <div class="h-full w-full overflow-hidden rounded-full">
                                                <img class="h-full w-full object-cover" src="{{ asset($appointment->doctor->user->avatar ?? 'default-avatar.png') }}" alt="{{ $appointment->doctor->user->name }}">
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-lg font-bold text-gray-800">
                                                {{ $appointment->doctor->user->name }}
                                            </h3>
                                            <p class="text-sm text-gray-600">
                                                {{ $appointment->doctor->medicalCategory->name ?? 'Khoa khám' }}
                                            </p>
                                            <p class="text-sm font-medium text-red-600">
                                                {{ $appointment->service->name }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Thông tin lịch hẹn -->
                                    <div class="flex flex-col gap-2 text-center lg:text-right">
                                        <div class="flex items-center gap-2 lg:justify-end">
                                            <x-heroicon-m-calendar-days class="h-4 w-4 text-gray-500" />
                                            <span class="text-sm font-medium text-gray-700">
                                                {{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}
                                            </span>
                                        </div>
                                        <div class="flex items-center gap-2 lg:justify-end">
                                            <x-heroicon-m-clock class="h-4 w-4 text-gray-500" />
                                            <span class="text-sm font-medium text-gray-700">
                                                {{ $appointment->time }}
                                            </span>
                                        </div>
                                        @if ($appointment->bill)
                                            <div class="flex items-center gap-2 lg:justify-end">
                                                <x-heroicon-m-banknotes class="h-4 w-4 text-gray-500" />
                                                <span class="text-sm font-medium text-gray-700">
                                                    {{ number_format($appointment->bill->total) }}đ
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Trạng thái và hành động -->
                                    <div class="flex flex-col items-start gap-3 lg:items-end">
                                        <div class="status-badge status-{{ strtolower($appointment->status) }}">
                                            @switch($appointment->status)
                                                @case('completed')
                                                    Hoàn thành
                                                @break

                                                @case('upcoming')
                                                @case('confirmed')
                                                    Sắp tới
                                                @break

                                                @case('pending')
                                                    Chờ xác nhận
                                                @break

                                                @case('cancelled')
                                                    Đã hủy
                                                @break

                                                @case('rejected')
                                                    Từ chối
                                                @break

                                                @default
                                                    {{ ucfirst($appointment->status) }}
                                            @endswitch
                                        </div>

                                        <div class="flex flex-col gap-2">
                                            @if ($appointment->status === 'completed' && $appointment->examResult)
                                                <button class="flex items-center gap-1 rounded-lg bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700 transition-all duration-300 hover:scale-105 hover:bg-blue-200 hover:shadow-lg" onclick="openExamResultModal('{{ $appointment->id }}')">
                                                    <x-heroicon-m-document-text class="h-3 w-3" />
                                                    Xem kết quả
                                                </button>
                                            @endif

                                            @if ($appointment->status === 'completed' && !$appointment->review)
                                                <button class="flex items-center gap-1 rounded-lg bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-700 transition-all duration-300 hover:scale-105 hover:bg-yellow-200 hover:shadow-lg" onclick="openReviewModal('{{ $appointment->id }}')">
                                                    <x-heroicon-m-star class="h-3 w-3" />
                                                    Đánh giá
                                                </button>
                                            @elseif($appointment->review)
                                                <div class="flex items-center gap-1 text-xs text-green-600">
                                                    <x-heroicon-s-star class="h-3 w-3" />
                                                    Đã đánh giá
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if ($appointment->medical_problem)
                                    <div class="mt-4 rounded-lg bg-gray-50 p-3 transition-all duration-300 hover:bg-gray-100">
                                        <p class="mb-1 text-sm font-medium text-gray-600">Vấn đề y tế:</p>
                                        <p class="text-sm text-gray-700">{{ $appointment->medical_problem }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Phân trang DaisyUI -->
                    @if ($appointments->hasPages())
                        <div class="pagination-wrapper mt-8 flex flex-col items-center gap-4">
                            <div class="join">
                                {{-- Nút Previous --}}
                                @if ($appointments->onFirstPage())
                                    <button class="join-item btn btn-disabled">
                                        <x-heroicon-m-chevron-left class="h-4 w-4" />
                                    </button>
                                @else
                                    <a class="join-item btn hover:border-red-600 hover:bg-red-600 hover:text-white" href="{{ $appointments->previousPageUrl() }}">
                                        <x-heroicon-m-chevron-left class="h-4 w-4" />
                                    </a>
                                @endif

                                {{-- Các số trang --}}
                                @php
                                    $start = max($appointments->currentPage() - 2, 1);
                                    $end = min($start + 4, $appointments->lastPage());
                                    $start = max($end - 4, 1);
                                @endphp

                                @if ($start > 1)
                                    <a class="join-item btn hover:border-red-600 hover:bg-red-600 hover:text-white" href="{{ $appointments->url(1) }}">1</a>
                                    @if ($start > 2)
                                        <button class="join-item btn btn-disabled">...</button>
                                    @endif
                                @endif

                                @for ($i = $start; $i <= $end; $i++)
                                    @if ($i == $appointments->currentPage())
                                        <button class="join-item btn border-red-600 bg-red-600 text-white hover:border-red-700 hover:bg-red-700">{{ $i }}</button>
                                    @else
                                        <a class="join-item btn hover:border-red-600 hover:bg-red-600 hover:text-white" href="{{ $appointments->url($i) }}">{{ $i }}</a>
                                    @endif
                                @endfor

                                @if ($end < $appointments->lastPage())
                                    @if ($end < $appointments->lastPage() - 1)
                                        <button class="join-item btn btn-disabled">...</button>
                                    @endif
                                    <a class="join-item btn hover:border-red-600 hover:bg-red-600 hover:text-white" href="{{ $appointments->url($appointments->lastPage()) }}">{{ $appointments->lastPage() }}</a>
                                @endif

                                {{-- Nút Next --}}
                                @if ($appointments->hasMorePages())
                                    <a class="join-item btn hover:border-red-600 hover:bg-red-600 hover:text-white" href="{{ $appointments->nextPageUrl() }}">
                                        <x-heroicon-m-chevron-right class="h-4 w-4" />
                                    </a>
                                @else
                                    <button class="join-item btn btn-disabled">
                                        <x-heroicon-m-chevron-right class="h-4 w-4" />
                                    </button>
                                @endif
                            </div>

                            {{-- Thông tin trang --}}
                            <div class="text-center text-sm text-gray-600">
                                Hiển thị {{ $appointments->firstItem() }} - {{ $appointments->lastItem() }} trong tổng số {{ $appointments->total() }} kết quả
                            </div>
                        </div>
                    @endif
                @else
                    <!-- Trạng thái trống -->
                    <div class="animate-scale-in py-16 text-center">
                        <div class="animate-pulse-slow mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-gray-100">
                            <x-heroicon-o-calendar class="h-10 w-10 text-gray-400" />
                        </div>
                        <h3 class="animate-fade-in-left mb-2 text-lg font-semibold text-gray-800">Chưa có cuộc hẹn nào</h3>
                        <p class="animate-fade-in-right mb-6 text-gray-600">Bạn chưa có lịch hẹn khám nào. Hãy đặt lịch khám với bác sĩ để được tư vấn sức khỏe.</p>
                        <a class="animate-bounce-subtle inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-red-500 to-red-600 px-6 py-3 font-semibold text-white transition-all duration-300 hover:scale-105 hover:from-red-600 hover:to-red-700 hover:shadow-lg" href="{{ route('appointment.index') }}">
                            <x-heroicon-s-plus class="h-5 w-5" />
                            Đặt lịch khám ngay
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Kết quả khám -->
    <div id="examResultModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="animate-scale-in max-h-[90vh] w-full max-w-4xl overflow-hidden rounded-3xl bg-white shadow-2xl">
            <!-- Modal Header -->
            <div class="flex items-center justify-between border-b bg-gradient-to-r from-red-500 to-red-600 p-6 text-white">
                <div class="flex items-center gap-3">
                    <x-heroicon-s-document-text class="h-6 w-6" />
                    <h2 class="text-xl font-bold">Kết quả khám bệnh</h2>
                </div>
                <button class="flex h-8 w-8 items-center justify-center rounded-full text-white transition-all duration-300 hover:bg-white hover:bg-opacity-20" onclick="closeExamResultModal()">
                    <x-heroicon-s-x-mark class="h-5 w-5" />
                </button>
            </div>

            <!-- Modal Content -->
            <div class="max-h-[calc(90vh-5rem)] overflow-y-auto p-6">
                <div id="examResultContent">
                    <!-- Nội dung sẽ được load bằng JavaScript -->
                    <div class="flex items-center justify-center py-8">
                        <div class="h-8 w-8 animate-spin rounded-full border-b-2 border-red-600"></div>
                        <span class="ml-3 text-gray-600">Đang tải...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Đánh giá -->
    <div id="reviewModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="animate-scale-in max-h-[90vh] w-full max-w-2xl overflow-hidden rounded-3xl bg-white shadow-2xl">
            <!-- Modal Header -->
            <div class="flex items-center justify-between border-b bg-gradient-to-r from-yellow-500 to-orange-600 p-6 text-white">
                <div class="flex items-center gap-3">
                    <x-heroicon-s-star class="h-6 w-6" />
                    <h2 class="text-xl font-bold">Đánh giá cuộc hẹn</h2>
                </div>
                <button class="flex h-8 w-8 items-center justify-center rounded-full text-white transition-all duration-300 hover:bg-white hover:bg-opacity-20" onclick="closeReviewModal()">
                    <x-heroicon-s-x-mark class="h-5 w-5" />
                </button>
            </div>

            <!-- Modal Content -->
            <div class="max-h-[calc(90vh-5rem)] overflow-y-auto p-6">
                <form id="reviewForm">
                    <div class="space-y-6">
                        <div id="doctorInfo" class="rounded-xl bg-gray-50 p-4">
                        </div>
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-gray-700">
                                Đánh giá chất lượng dịch vụ <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center gap-2">
                                <div id="starRating" class="flex items-center gap-1">
                                    <button class="star text-3xl text-gray-300 transition-colors hover:text-yellow-400" data-rating="1" type="button">★</button>
                                    <button class="star text-3xl text-gray-300 transition-colors hover:text-yellow-400" data-rating="2" type="button">★</button>
                                    <button class="star text-3xl text-gray-300 transition-colors hover:text-yellow-400" data-rating="3" type="button">★</button>
                                    <button class="star text-3xl text-gray-300 transition-colors hover:text-yellow-400" data-rating="4" type="button">★</button>
                                    <button class="star text-3xl text-gray-300 transition-colors hover:text-yellow-400" data-rating="5" type="button">★</button>
                                </div>
                                <span id="ratingText" class="text-sm text-gray-600"></span>
                            </div>
                            <input id="rate" name="rate" type="hidden" required>
                        </div>

                        <!-- Comment -->
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-gray-700" for="review">
                                Nhận xét của bạn
                            </label>
                            <textarea id="review" class="w-full resize-none rounded-xl border border-gray-300 p-3 focus:border-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-200" name="comment" rows="4" placeholder="Chia sẻ trải nghiệm của bạn về cuộc hẹn này..."></textarea>
                        </div>

                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-gray-700">
                                Bạn có giới thiệu bác sĩ này cho người khác không? <span class="text-red-500">*</span>
                            </label>
                            <div class="flex gap-6">
                                <label class="group flex cursor-pointer items-center gap-2">
                                    <input class="h-4 w-4 border-gray-300 text-green-600 focus:ring-2 focus:ring-green-500" name="recommend" type="radio" required value="1">
                                    <span class="text-sm font-medium text-gray-700 transition-colors group-hover:text-green-600">
                                        <span class="flex items-center gap-2">
                                            <x-heroicon-s-hand-thumb-up class="h-4 w-4 text-green-600" />
                                            Có, tôi sẽ giới thiệu
                                        </span>
                                    </span>
                                </label>
                                <label class="group flex cursor-pointer items-center gap-2">
                                    <input class="h-4 w-4 border-gray-300 text-red-600 focus:ring-2 focus:ring-red-500" name="recommend" type="radio" required value="0">
                                    <span class="text-sm font-medium text-gray-700 transition-colors group-hover:text-red-600">
                                        <span class="flex items-center gap-2">
                                            <x-heroicon-s-hand-thumb-down class="h-4 w-4 text-red-600" />
                                            Không giới thiệu
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex gap-3 pt-4">
                            <button class="flex-1 rounded-xl border border-gray-300 py-3 text-sm font-semibold text-gray-700 transition-all duration-300 hover:bg-gray-50" type="button" onclick="closeReviewModal()">
                                Hủy bỏ
                            </button>
                            <button id="submitReview" class="flex-1 rounded-xl bg-gradient-to-r from-yellow-500 to-orange-600 py-3 text-sm font-semibold text-white transition-all duration-300 hover:from-yellow-600 hover:to-orange-700 hover:shadow-lg disabled:cursor-not-allowed disabled:opacity-50" type="submit">
                                <span class="flex items-center justify-center gap-2">
                                    <x-heroicon-s-paper-airplane class="h-4 w-4" />
                                    Gửi đánh giá
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Global variables
        let appointments = @json($appointments->items());
        let currentAppointmentId = null;

        // Modal functions
        function openExamResultModal(appointmentId) {
            currentAppointmentId = appointmentId;
            const modal = document.getElementById('examResultModal');
            const content = document.getElementById('examResultContent');

            // Show modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // Show loading
            content.innerHTML = `
                <div class="flex items-center justify-center py-8">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-red-600"></div>
                    <span class="ml-3 text-gray-600">Đang tải...</span>
                </div>
            `;

            // Load exam result data
            loadExamResult(appointmentId);
        }

        function closeExamResultModal() {
            const modal = document.getElementById('examResultModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            currentAppointmentId = null;
        }

        function loadExamResult(appointmentId) {
            // Find appointment data
            const appointment = appointments.find(app => app.id == appointmentId);

            console.log('Loading exam result for appointment:', appointmentId);
            console.log('Appointment data:', appointment);

            if (!appointment || !appointment.exam_result) {
                document.getElementById('examResultContent').innerHTML = `
                <div class="text-center py-8">
                    <div class="mx-auto h-12 w-12 text-gray-400 mb-4">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.96-.833-2.73 0L3.084 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Không tìm thấy kết quả</h3>
                    <p class="text-gray-600">Kết quả khám chưa có hoặc đã bị xóa.</p>
                </div>
            `;
                return;
            }

            renderExamResult(appointment);
        }

        function renderExamResult(appointment) {
            const examResult = appointment.exam_result;
            const doctor = appointment.doctor;
            const service = appointment.service;

            // Format date
            const appointmentDate = new Date(appointment.date).toLocaleDateString('vi-VN');
            const updatedAt = examResult.updated_at ?
                new Date(examResult.updated_at).toLocaleDateString('vi-VN', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit'
                }) : '';

            let filesHtml = '';
            if (examResult.files && examResult.files.length > 0) {
                filesHtml = examResult.files.map(file => `
                    <li class="flex items-center gap-2 p-2 border rounded-lg hover:bg-gray-50">
                        <svg class="h-4 w-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <a href="/storage/${file.path}" target="_blank"
                            class="text-blue-600 hover:underline flex-1 text-sm">
                            ${file.original_name || file.path.split('/').pop()}
                        </a>
                        <span class="text-xs text-gray-500">${file.mime_type || ''}</span>
                    </li>
                `).join('');
            } else {
                filesHtml = '<p class="text-sm text-gray-500 italic">Không có tệp đính kèm</p>';
            }

            const content = `
                <div class="space-y-6">
                    <!-- Patient and Doctor Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-gray-50 rounded-xl">
                        <div class="space-y-2">
                            <h4 class="font-semibold text-gray-800 flex items-center gap-2">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Thông tin bệnh nhân
                            </h4>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Họ tên:</span> {{ $user->name }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Ngày khám:</span> ${appointmentDate}
                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Thời gian:</span> ${appointment.time}
                            </p>
                        </div>
                        <div class="space-y-2">
                            <h4 class="font-semibold text-gray-800 flex items-center gap-2">
                                <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Thông tin khám
                            </h4>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Bác sĩ:</span> ${doctor.user.name}
                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Dịch vụ:</span> ${service.name}
                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Khoa:</span> ${doctor.medical_category?.name || 'Không xác định'}
                            </p>
                        </div>
                    </div>

                    <!-- Exam Result -->
                    <div class="space-y-4">
                        <h4 class="font-bold text-lg text-gray-800 flex items-center gap-2 border-b pb-2">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Kết quả khám bệnh
                        </h4>
                        <div class="prose max-w-none p-4 border rounded-xl bg-white">
                            ${examResult.result || '<span class="text-gray-500 italic">Chưa có kết quả</span>'}
                        </div>
                    </div>

                    <!-- Medical Information -->
                    ${examResult.medication ? `
                                                                                                                                                <div class="space-y-4">
                                                                                                                                                    <h4 class="font-bold text-lg text-gray-800 flex items-center gap-2 border-b pb-2">
                                                                                                                                                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                                                                                                                                        </svg>
                                                                                                                                                        Thông tin thuốc và điều trị
                                                                                                                                                    </h4>
                                                                                                                                                    <div class="prose max-w-none p-4 border rounded-xl bg-white">
                                                                                                                                                        ${examResult.medication}
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                            ` : ''}

                    <!-- Attachments -->
                    <div class="space-y-4">
                        <h4 class="font-bold text-lg text-gray-800 flex items-center gap-2 border-b pb-2">
                            <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                            </svg>
                            Tệp đính kèm (${examResult.files ? examResult.files.length : 0})
                        </h4>
                        <div class="p-4 border rounded-xl bg-white">
                            ${examResult.files && examResult.files.length > 0 ?
                                `<ul class="space-y-2">${filesHtml}</ul>` :
                                '<p class="text-sm text-gray-500 italic">Không có tệp đính kèm</p>'
                            }
                        </div>
                    </div>

                    <!-- Update Info -->
                    ${updatedAt ? `
                                                                                                                                            <div class="text-xs text-gray-500 text-right border-t pt-4">
                                                                                                                                                Cập nhật lần cuối: ${updatedAt}
                                                                                                                                            </div>
                                                                                                                                        ` : ''}
                </div>
            `;

            document.getElementById('examResultContent').innerHTML = content;
        }

        document.getElementById('examResultModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeExamResultModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && currentAppointmentId) {
                closeExamResultModal();
            }
            if (e.key === 'Escape' && currentReviewAppointmentId) {
                closeReviewModal();
            }
        });

        let currentReviewAppointmentId = null;

        function openReviewModal(appointmentId) {
            currentReviewAppointmentId = appointmentId;
            const modal = document.getElementById('reviewModal');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            loadReviewData(appointmentId);
        }

        function closeReviewModal() {
            const modal = document.getElementById('reviewModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            currentReviewAppointmentId = null;

            // Reset form
            document.getElementById('reviewForm').reset();
            document.getElementById('rate').value = '';
            document.getElementById('review').value = '';
            updateStarRating(0);

            // Reset radio buttons
            const radioButtons = document.querySelectorAll('input[name="recommend"]');
            radioButtons.forEach(radio => radio.checked = false);
        }

        function loadReviewData(appointmentId) {
            const appointment = appointments.find(app => app.id == appointmentId);

            if (!appointment) {
                console.error('Appointment not found:', appointmentId);
                return;
            }

            const doctor = appointment.doctor;
            const service = appointment.service;
            const appointmentDate = new Date(appointment.date).toLocaleDateString('vi-VN');

            document.getElementById('doctorInfo').innerHTML = `
                <div class="flex items-center gap-4">
                    <div class="h-16 w-16 overflow-hidden rounded-full">
                        <img class="h-full w-full object-cover" src="${doctor.user.avatar || '/default-avatar.png'}" alt="${doctor.user.name}">
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-gray-800">${doctor.user.name}</h3>
                        <p class="text-sm text-gray-600">${doctor.medical_category?.name || 'Khoa khám'}</p>
                        <p class="text-sm font-medium text-red-600">${service.name}</p>
                        <p class="text-xs text-gray-500">Ngày khám: ${appointmentDate}</p>
                    </div>
                </div>
            `;
        }

        function updateStarRating(rating) {
            const stars = document.querySelectorAll('.star');
            const ratingText = document.getElementById('ratingText');

            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });

            // Update rating text
            const ratingTexts = {
                1: 'Rất không hài lòng',
                2: 'Không hài lòng',
                3: 'Bình thường',
                4: 'Hài lòng',
                5: 'Rất hài lòng'
            };

            ratingText.textContent = rating > 0 ? ratingTexts[rating] : '';
            document.getElementById('rate').value = rating;
        }

        // Close review modal when clicking outside
        document.getElementById('reviewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeReviewModal();
            }
        });

        // Submit review function
        function submitReview(appointmentId, rating, comment, recommend) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            fetch(`/appointment/${appointmentId}/review`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        rate: rating,
                        review: comment,
                        recommend: recommend
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showSuccessNotification('Đánh giá đã được gửi thành công!', 'Cảm ơn bạn đã chia sẻ trải nghiệm với chúng tôi.');
                        closeReviewModal();
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    } else {
                        console.error('Error submitting review:', data);
                        throw new Error(data.message || 'Có lỗi xảy ra');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showErrorNotification('Lỗi gửi đánh giá', 'Có lỗi xảy ra khi gửi đánh giá. Vui lòng thử lại!');

                    const submitBtn = document.getElementById('submitReview');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = `
                    <span class="flex items-center justify-center gap-2">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Gửi đánh giá
                    </span>
                `;
                });
        }

        function showSuccessNotification(title, message) {
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 z-[60] max-w-sm w-full bg-white rounded-xl shadow-2xl border border-green-200 transform translate-x-full transition-transform duration-300 ease-out';
            notification.innerHTML = `
                <div class="p-4">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                                <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm font-semibold text-gray-900 mb-1">${title}</h3>
                            <p class="text-sm text-gray-600">${message}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.parentElement.remove()" class="flex-shrink-0 text-gray-400 hover:text-gray-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 5000);
        }

        function showErrorNotification(title, message) {
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 z-[60] max-w-sm w-full bg-white rounded-xl shadow-2xl border border-red-200 transform translate-x-full transition-transform duration-300 ease-out';
            notification.innerHTML = `
                <div class="p-4">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-red-100 flex items-center justify-center">
                                <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm font-semibold text-gray-900 mb-1">${title}</h3>
                            <p class="text-sm text-gray-600">${message}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.parentElement.remove()" class="flex-shrink-0 text-gray-400 hover:text-gray-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            `;

            document.body.appendChild(notification);

            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 5000);
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Star rating event handlers
            const stars = document.querySelectorAll('.star');
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = parseInt(this.dataset.rating);
                    updateStarRating(rating);
                });

                star.addEventListener('mouseenter', function() {
                    const rating = parseInt(this.dataset.rating);
                    const allStars = document.querySelectorAll('.star');
                    allStars.forEach((s, index) => {
                        if (index < rating) {
                            s.classList.remove('text-gray-300');
                            s.classList.add('text-yellow-400');
                        } else {
                            s.classList.remove('text-yellow-400');
                            s.classList.add('text-gray-300');
                        }
                    });
                });

                star.addEventListener('mouseleave', function() {
                    const currentRating = parseInt(document.getElementById('rate').value) || 0;
                    updateStarRating(currentRating);
                });
            });

            // Review form submission
            document.getElementById('reviewForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const rating = document.getElementById('rate').value;
                const comment = document.getElementById('review').value;
                const recommend = document.querySelector('input[name="recommend"]:checked')?.value;

                if (!rating) {
                    showErrorNotification('Thiếu thông tin', 'Vui lòng chọn đánh giá sao!');
                    return;
                }

                if (!recommend) {
                    showErrorNotification('Thiếu thông tin', 'Vui lòng chọn có giới thiệu bác sĩ hay không!');
                    return;
                }

                // Disable submit button
                const submitBtn = document.getElementById('submitReview');
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <span class="flex items-center justify-center gap-2">
                        <div class="animate-spin h-4 w-4 border-2 border-white border-t-transparent rounded-full"></div>
                        Đang gửi...
                    </span>
                `;

                // Submit review via fetch
                submitReview(currentReviewAppointmentId, rating, comment, recommend);
            });

            // Intersection Observer cho stagger animation
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Quan sát các phần tử cần animation
            const animateElements = document.querySelectorAll('.stagger-item, .stat-card, .filter-btn');
            animateElements.forEach(el => {
                observer.observe(el);
            });

            // Smooth hover effects cho doctor avatars
            const doctorAvatars = document.querySelectorAll('.doctor-avatar');
            doctorAvatars.forEach(avatar => {
                avatar.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.1) rotate(5deg)';
                });

                avatar.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1) rotate(0deg)';
                });
            });

            // Click effects cho các nút
            const buttons = document.querySelectorAll('.filter-btn, .btn');
            buttons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    // Tạo ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.cssText = `
                        position: absolute;
                        border-radius: 50%;
                        background: rgba(255, 255, 255, 0.6);
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        pointer-events: none;
                    `;

                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Parallax effect cho background
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const parallax = document.querySelector('.min-h-screen');
                const speed = scrolled * 0.5;

                if (parallax) {
                    parallax.style.backgroundPositionY = speed + 'px';
                }
            });

            // Lazy loading cho images
            const images = document.querySelectorAll('img[data-src]');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                });
            });

            images.forEach(img => imageObserver.observe(img));

            // Status badge animation on scroll
            const statusBadges = document.querySelectorAll('.status-badge');
            const badgeObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'pulse 0.8s ease-in-out';
                        setTimeout(() => {
                            entry.target.style.animation = '';
                        }, 800);
                    }
                });
            }, {
                threshold: 0.5
            });

            statusBadges.forEach(badge => badgeObserver.observe(badge));
        });
    </script>
@endpush
