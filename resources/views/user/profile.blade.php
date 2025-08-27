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

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .progress-ring {
            transition: stroke-dasharray 0.8s ease;
        }

        .appointment-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(249, 250, 251, 0.8));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .appointment-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-up {
            animation: slideInUp 0.8s ease-out both;
        }

        .animate-slide-up-delay-1 {
            animation: slideInUp 0.8s ease-out both;
            animation-delay: 0.1s;
        }

        .animate-slide-up-delay-2 {
            animation: slideInUp 0.8s ease-out both;
            animation-delay: 0.2s;
        }

        .animate-slide-up-delay-3 {
            animation: slideInUp 0.8s ease-out both;
            animation-delay: 0.3s;
        }

        .animate-slide-up-delay-4 {
            animation: slideInUp 0.8s ease-out both;
            animation-delay: 0.4s;
        }

        .animate-slide-up-delay-5 {
            animation: slideInUp 0.8s ease-out both;
            animation-delay: 0.5s;
        }

        .animate-slide-up-delay-6 {
            animation: slideInUp 0.8s ease-out both;
            animation-delay: 0.6s;
        }

        .animate-slide-up-delay-7 {
            animation: slideInUp 0.8s ease-out both;
            animation-delay: 0.7s;
        }

        .animate-slide-up-delay-8 {
            animation: slideInUp 0.8s ease-out both;
            animation-delay: 0.8s;
        }

        .blood-type-badge {
            d background: linear-gradient(135deg, #dc2626, #991b1b);
            color: white;
            font-weight: bold;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .bmi-normal {
            color: #10b981;
        }

        .bmi-underweight {
            color: #3b82f6;
        }

        .bmi-overweight {
            color: #f59e0b;
        }

        .bmi-obese {
            color: #ef4444;
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen py-8">
        <div class="container mx-auto px-4">
            <!-- Phần tiêu đề -->
            <div class="animate-slide-up mb-8">
                <div class="glass-card rounded-3xl p-8 shadow-2xl">
                    <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                        <!-- Thông tin hồ sơ -->
                        <div class="flex items-center gap-6">
                            <div class="relative">
                                <div class="h-24 w-24 overflow-hidden rounded-full bg-gradient-to-br from-red-200 to-red-700 p-1">
                                    <div class="h-full w-full overflow-hidden rounded-full">
                                        <img class="h-full w-full object-cover" src="{{ asset($user->avatar) }}" alt="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="absolute -bottom-1 -right-1 flex h-8 w-8 items-center justify-center rounded-full border-4 border-white bg-green-500">
                                    <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h1 class="mb-2 text-3xl font-bold text-red-500">{{ $user->name ?? 'Bệnh nhân' }}</h1>
                                <p class="mb-1 flex items-center gap-2 text-gray-600">
                                    <x-heroicon-o-envelope class="h-5 w-5" />
                                    {{ $user->email }}
                                </p>
                                <p class="flex items-center gap-2 text-gray-600">
                                    <x-heroicon-o-phone class="h-5 w-5" />
                                    {{ $user->country_code }} {{ $user->phone }}
                                </p>
                            </div>
                        </div>

                        <!-- Mức độ hoàn tất hồ sơ -->
                        <div class="text-center">
                            <div class="relative mx-auto mb-4 h-24 w-24">
                                <svg class="h-24 w-24 -rotate-90 transform" viewBox="0 0 100 100">
                                    <circle cx="50" cy="50" r="40" stroke="#e5e7eb" stroke-width="8" fill="none" />
                                    <circle class="progress-ring" cx="50" cy="50" r="40" stroke="url(#gradient)" stroke-width="8" fill="none" stroke-dasharray="{{ $completionPercentage * 2.51 }} 251" />
                                    <defs>
                                        <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#ef4444" />
                                            <stop offset="100%" style="stop-color:#991b1b" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-2xl font-bold text-gray-800">{{ $completionPercentage }}%</span>
                                </div>
                            </div>
                            <p class="text-sm font-medium text-gray-600">Hồ sơ hoàn tất</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thống kê -->
            <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                <!-- Tổng số cuộc hẹn -->
                <div class="stat-card animate-slide-up-delay-1 rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Tổng số cuộc hẹn</p>
                            <p class="text-3xl font-bold text-[#DF1D32]">{{ $profileData['statistics']['total_appointments'] ?? 0 }}</p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-100">
                            <x-heroicon-m-calendar-days class="h-6 w-6 text-red-600" />
                        </div>
                    </div>
                </div>

                <!-- Cuộc hẹn đã hoàn thành -->
                <div class="stat-card animate-slide-up-delay-2 rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Đã hoàn thành</p>
                            <p class="text-3xl font-bold text-green-600">{{ $profileData['statistics']['completed_appointments'] ?? 0 }}</p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-100">
                            <svg class="h-6 w-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Cuộc hẹn sắp tới -->
                <div class="stat-card animate-slide-up-delay-3 rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Sắp tới</p>
                            <p class="text-3xl font-bold text-orange-600">{{ $profileData['statistics']['upcoming_appointments'] ?? 0 }}</p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-100">
                            <svg class="h-6 w-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Bác sĩ yêu thích -->
                <div class="stat-card animate-slide-up-delay-4 rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Bác sĩ yêu thích</p>
                            <p class="text-3xl font-bold text-purple-600">{{ $profileData['statistics']['favorite_doctors_count'] ?? 0 }}</p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-100">
                            <svg class="h-6 w-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <!-- Thông tin y tế -->
                <div class="lg:col-span-2">
                    <div class="glass-card animate-slide-up-delay-5 rounded-3xl p-8 shadow-2xl">
                        <div class="mb-6 flex items-center gap-3">
                            <x-heroicon-s-sun class="h-7 w-7 text-red-600" />
                            <h2 class="text-2xl font-bold text-gray-800">Thông tin y tế</h2>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Thông tin cơ bản -->
                            <div class="space-y-4">
                                <div class="flex items-center justify-between rounded-xl bg-gray-50 p-4">
                                    <span class="font-medium text-gray-600">Tuổi</span>
                                    <span class="font-bold text-gray-800">{{ $user->patientProfile?->age ?? 'Chưa có' }}</span>
                                </div>

                                <div class="flex items-center justify-between rounded-xl bg-gray-50 p-4">
                                    <span class="font-medium text-gray-600">Giới tính</span>
                                    <span class="font-bold capitalize text-gray-800">{{ $user->gender ?? 'Chưa có' }}</span>
                                </div>

                                <div class="flex items-center justify-between rounded-xl bg-gray-50 p-4">
                                    <span class="font-medium text-gray-600">Chiều cao</span>
                                    <span class="font-bold text-gray-800">{{ $user->patientProfile?->height ? $user->patientProfile->height . ' cm' : 'Chưa có' }}</span>
                                </div>

                                <div class="flex items-center justify-between rounded-xl bg-gray-50 p-4">
                                    <span class="font-medium text-gray-600">Cân nặng</span>
                                    <span class="font-bold text-gray-800">{{ $user->patientProfile?->weight ? $user->patientProfile->weight . ' kg' : 'Chưa có' }}</span>
                                </div>
                            </div>

                            <!-- Chỉ số sức khỏe -->
                            <div class="space-y-4">
                                <div class="flex items-center justify-between rounded-xl bg-gray-50 p-4">
                                    <span class="font-medium text-gray-600">Nhóm máu</span>
                                    @if ($user->patientProfile?->blood_group)
                                        <span class="blood-type-badge rounded-full px-3 py-1 text-sm">{{ $user->patientProfile->blood_group }}</span>
                                    @else
                                        <span class="font-bold text-gray-800">Chưa có</span>
                                    @endif
                                </div>

                                @php
                                    $bmiInfo = \App\Http\Controllers\PatientProfileController::getBMIInfo($user->patientProfile?->height, $user->patientProfile?->weight);
                                    $bmiStatusMap = [
                                        'Normal' => 'Bình thường',
                                        'Underweight' => 'Thiếu cân',
                                        'Overweight' => 'Thừa cân',
                                        'Obese' => 'Béo phì',
                                    ];
                                    $bmiStatusVi = $bmiStatusMap[$bmiInfo['status'] ?? ''] ?? ($bmiInfo['status'] ?? '');
                                @endphp
                                <div class="flex items-center justify-between rounded-xl bg-gray-50 p-4">
                                    <span class="font-medium text-gray-600">BMI</span>
                                    <div class="text-right">
                                        <div class="font-bold text-gray-800">{{ $bim['value'] }}</div>
                                        <div class="text-{{ $bim['color'] }}-600 text-sm">{{ $bim['status'] }}</div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between rounded-xl bg-gray-50 p-4">
                                    <span class="font-medium text-gray-600">Ngày sinh</span>
                                    <span class="font-bold text-gray-800">{{ $user->patientProfile?->birth_date ? \Carbon\Carbon::parse($user->patientProfile->birth_date)->format('d/m/Y') : 'Chưa có' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tiền sử bệnh -->
                        @if ($user->patientProfile?->medical_history)
                            <div class="mt-6 rounded-xl bg-red-50 p-4">
                                <h3 class="mb-2 flex items-center gap-2 font-semibold text-gray-800">
                                    <x-heroicon-s-identification class="h-5 w-5 text-red-600" />
                                    Tiền sử bệnh
                                </h3>
                                <p class="leading-relaxed text-gray-700">{{ $user->patientProfile->medical_history }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Thanh bên -->
                <div class="space-y-8">
                    <!-- Thông tin bảo hiểm -->
                    <div class="glass-card animate-slide-up-delay-6 rounded-3xl p-6 shadow-2xl">
                        <div class="mb-4 flex items-center gap-3">
                            <svg class="h-6 w-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2L3 7v11a1 1 0 001 1h12a1 1 0 001-1V7l-7-5zM9 9a1 1 0 012 0v4a1 1 0 11-2 0V9z" clip-rule="evenodd" />
                            </svg>
                            <h3 class="text-lg font-bold text-gray-800">Bảo hiểm</h3>
                        </div>

                        @if ($user->patientProfile?->insurance)
                            <div class="space-y-3">
                                <div>
                                    <span class="text-sm text-gray-600">Loại</span>
                                    <p class="font-semibold capitalize text-gray-800">{{ $user->patientProfile->insurance->insurance_type ?? 'Không xác định' }}</p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-600">Số</span>
                                    <p class="font-semibold text-gray-800">{{ $user->patientProfile->insurance->insurance_number ?? 'Không cung cấp' }}</p>
                                </div>
                            </div>
                        @else
                            <p class="py-4 text-center text-gray-500">Chưa có thông tin bảo hiểm</p>
                        @endif
                    </div>

                    <!-- Tác vụ nhanh -->
                    <div class="glass-card animate-slide-up-delay-7 rounded-3xl p-6 shadow-2xl">
                        <h3 class="mb-4 text-lg font-bold text-gray-800">Tác vụ nhanh</h3>
                        <div class="space-y-3">
                            <a class="flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-red-500 to-red-600 px-4 py-3 font-semibold text-white transition-all duration-300 hover:from-red-600 hover:to-red-700" href="{{ route('appointment.index') }}">
                                <x-heroicon-s-calendar-days class="h-5 w-5" />
                                Đặt lịch hẹn
                            </a>
                            <a class="flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 px-4 py-3 font-semibold text-white transition-all duration-300 hover:from-blue-600 hover:to-blue-700" href="{{ route('profile.appointment-history') }}">
                                <x-heroicon-s-clipboard-document-list class="h-5 w-5" />
                                Lịch sử đặt khám
                            </a>
                            <a class="flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-red-600 px-4 py-3 font-semibold text-white transition-all duration-300 hover:from-orange-600 hover:to-red-700" href="{{ route('profile.support-requests') }}">
                                <x-heroicon-s-question-mark-circle class="h-5 w-5" />
                                Yêu cầu hỗ trợ
                            </a>
                            <a class="flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-green-500 to-green-600 px-4 py-3 font-semibold text-white transition-all duration-300 hover:from-green-600 hover:to-green-700" href="{{ route('profile.edit') }}">
                                <x-heroicon-s-cog-6-tooth class="h-5 w-5" />
                                Chỉnh sửa hồ sơ
                            </a>
                            <a class="flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-gray-500 to-gray-600 px-4 py-3 font-semibold text-white transition-all duration-300 hover:from-gray-600 hover:to-gray-700" href="/">
                                <x-heroicon-s-arrow-uturn-left class="h-5 w-5" />
                                Về trang chủ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
