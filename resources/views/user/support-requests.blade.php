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

        /* Status badge colors */
        .status-open {
            @apply bg-blue-100 text-blue-800 border border-blue-200;
        }

        .status-closed {
            @apply bg-gray-100 text-gray-800 border border-gray-200;
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
                            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500 to-red-600">
                                <x-heroicon-s-question-mark-circle class="h-8 w-8 text-white" />
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-gray-800">Yêu cầu hỗ trợ</h1>
                                <p class="text-gray-600">Theo dõi các yêu cầu hỗ trợ đã gửi</p>
                            </div>
                        </div>

                        <!-- Nút điều hướng -->
                        <div class="animate-slide-down flex gap-3">
                            <a class="btn btn-outline rounded-xl border-2 border-gray-300 bg-white px-6 py-3 font-semibold text-gray-700 transition-all duration-300 hover:border-gray-400 hover:bg-gray-50 hover:shadow-lg" href="{{ route('profile.appointment-history') }}">
                                <x-heroicon-m-arrow-left class="h-5 w-5" />
                                Lịch sử khám
                            </a>
                            <a class="btn btn-primary rounded-xl bg-gradient-to-r from-red-500 to-red-600 px-6 py-3 font-semibold text-white transition-all duration-300 hover:from-red-600 hover:to-red-700 hover:shadow-lg" href="{{ route('appointment.index') }}">
                                <x-heroicon-s-plus class="h-5 w-5" />
                                Đặt lịch mới
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thống kê tổng quan -->
            <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <!-- Tổng số yêu cầu -->
                <div class="stat-card animate-slide-up-delay-1 rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Tổng yêu cầu</p>
                            <p class="text-2xl font-bold text-blue-600">{{ $statistics['total'] }}</p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100">
                            <x-heroicon-m-clipboard-document-list class="h-5 w-5 text-blue-600" />
                        </div>
                    </div>
                </div>

                <!-- Đang mở -->
                <div class="stat-card animate-slide-up-delay-2 rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Đang mở</p>
                            <p class="text-2xl font-bold text-orange-600">{{ $statistics['open'] }}</p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-100">
                            <x-heroicon-m-clock class="h-5 w-5 text-orange-600" />
                        </div>
                    </div>
                </div>

                <!-- Đã đóng -->
                <div class="stat-card animate-slide-up-delay-4 rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Đã đóng</p>
                            <p class="text-2xl font-bold text-gray-600">{{ $statistics['closed'] }}</p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100">
                            <x-heroicon-m-x-circle class="h-5 w-5 text-gray-600" />
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
                        <a class="filter-btn btn btn-outline {{ !request('status') ? 'active' : '' }}" href="{{ route('profile.support-requests') }}">
                            <x-heroicon-m-squares-2x2 class="h-4 w-4" />
                            Tất cả
                        </a>

                        <a class="filter-btn btn btn-outline {{ request('status') === 'open' ? 'active' : '' }}" href="{{ route('profile.support-requests', ['status' => 'open']) }}">
                            <x-heroicon-m-clock class="h-4 w-4" />
                            Đang mở
                        </a>

                        <a class="filter-btn btn btn-outline {{ request('status') === 'closed' ? 'active' : '' }}" href="{{ route('profile.support-requests', ['status' => 'closed']) }}">
                            <x-heroicon-m-x-circle class="h-4 w-4" />
                            Đã đóng
                        </a>
                    </div>
                </div>
            </div>

            <!-- Danh sách yêu cầu hỗ trợ -->
            <div class="glass-card animate-slide-up-delay-3 rounded-3xl p-8 shadow-2xl">
                <div class="animate-fade-in-left mb-6 flex items-center gap-3">
                    <x-heroicon-s-clipboard-document-list class="h-7 w-7 text-red-600" />
                    <h2 class="text-2xl font-bold text-gray-800">Danh sách yêu cầu hỗ trợ</h2>
                </div>

                @if ($supportRequests->count() > 0)
                    <div class="space-y-4">
                        @foreach ($supportRequests as $index => $support)
                            <div class="support-card stagger-item rounded-2xl p-6 shadow-lg" style="animation-delay: {{ 0.1 * ($index + 1) }}s">
                                <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                                    <!-- Thông tin yêu cầu -->
                                    <div class="flex-1">
                                        <div class="mb-3 flex items-start gap-3">
                                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-100">
                                                <x-heroicon-m-question-mark-circle class="h-6 w-6 text-orange-600" />
                                            </div>
                                            <div class="flex-1">
                                                <h3 class="text-lg font-bold text-gray-800">
                                                    Yêu cầu hỗ trợ #{{ $support->id }}
                                                </h3>
                                                @if ($support->appointment)
                                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                                        <x-heroicon-m-calendar-days class="h-4 w-4" />
                                                        <span>
                                                            Liên quan đến cuộc hẹn ngày {{ \Carbon\Carbon::parse($support->appointment->date)->format('d/m/Y') }}
                                                        </span>
                                                    </div>
                                                    @if ($support->appointment->service)
                                                        <div class="flex items-center gap-2 text-sm text-red-600">
                                                            <x-heroicon-m-beaker class="h-4 w-4" />
                                                            <span>{{ $support->appointment->service->name }}</span>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Nội dung yêu cầu -->
                                        <div class="mb-3 rounded-lg bg-gray-50 p-4">
                                            <p class="text-sm text-gray-700">{{ $support->message }}</p>
                                        </div>

                                        <!-- Thông tin bác sĩ -->
                                        @if ($support->doctor)
                                            <div class="flex items-center gap-3 rounded-lg bg-blue-50 p-3">
                                                <div class="h-10 w-10 overflow-hidden rounded-full">
                                                    <img class="h-full w-full object-cover" src="{{ asset($support->doctor->user->avatar ?? 'default-avatar.png') }}" alt="{{ $support->doctor->user->name }}">
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-800">{{ $support->doctor->user->name }}</p>
                                                    <p class="text-xs text-gray-600">{{ $support->doctor->medicalCategory->name ?? 'Bác sĩ' }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Trạng thái và thời gian -->
                                    <div class="flex flex-col items-start gap-3 lg:items-end lg:text-right">
                                        <div class="status-badge status-{{ strtolower($support->status) }}">
                                            @switch($support->status)
                                                @case('open')
                                                    Đang mở
                                                @break

                                                @case('closed')
                                                    Đã đóng
                                                @break

                                                @default
                                                    {{ ucfirst($support->status) }}
                                            @endswitch
                                        </div>

                                        <div class="text-sm text-gray-500">
                                            <div class="flex items-center gap-1">
                                                <x-heroicon-m-clock class="h-4 w-4" />
                                                <span>{{ $support->created_at->format('d/m/Y H:i') }}</span>
                                            </div>
                                            @if ($support->updated_at != $support->created_at)
                                                <div class="mt-1 flex items-center gap-1">
                                                    <x-heroicon-m-arrow-path class="h-4 w-4" />
                                                    <span>Cập nhật: {{ $support->updated_at->format('d/m/Y H:i') }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Actions -->
                                        <div class="flex flex-col gap-2">
                                            <button class="flex items-center gap-1 rounded-lg bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700 transition-all duration-300 hover:scale-105 hover:bg-blue-200 hover:shadow-lg" onclick="openSupportDetailModal('{{ $support->id }}')">
                                                <x-heroicon-m-eye class="h-3 w-3" />
                                                Xem chi tiết
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Phân trang -->
                    @if ($supportRequests->hasPages())
                        <div class="pagination-wrapper mt-8 flex flex-col items-center gap-4">
                            <div class="join">
                                {{-- Nút Previous --}}
                                @if ($supportRequests->onFirstPage())
                                    <button class="join-item btn btn-disabled">
                                        <x-heroicon-m-chevron-left class="h-4 w-4" />
                                    </button>
                                @else
                                    <a class="join-item btn hover:border-red-600 hover:bg-red-600 hover:text-white" href="{{ $supportRequests->previousPageUrl() }}">
                                        <x-heroicon-m-chevron-left class="h-4 w-4" />
                                    </a>
                                @endif

                                {{-- Các số trang --}}
                                @php
                                    $start = max($supportRequests->currentPage() - 2, 1);
                                    $end = min($start + 4, $supportRequests->lastPage());
                                    $start = max($end - 4, 1);
                                @endphp

                                @if ($start > 1)
                                    <a class="join-item btn hover:border-red-600 hover:bg-red-600 hover:text-white" href="{{ $supportRequests->url(1) }}">1</a>
                                    @if ($start > 2)
                                        <button class="join-item btn btn-disabled">...</button>
                                    @endif
                                @endif

                                @for ($page = $start; $page <= $end; $page++)
                                    @if ($page == $supportRequests->currentPage())
                                        <button class="join-item btn btn-active bg-red-600 text-white">{{ $page }}</button>
                                    @else
                                        <a class="join-item btn hover:border-red-600 hover:bg-red-600 hover:text-white" href="{{ $supportRequests->url($page) }}">{{ $page }}</a>
                                    @endif
                                @endfor

                                @if ($end < $supportRequests->lastPage())
                                    @if ($end < $supportRequests->lastPage() - 1)
                                        <button class="join-item btn btn-disabled">...</button>
                                    @endif
                                    <a class="join-item btn hover:border-red-600 hover:bg-red-600 hover:text-white" href="{{ $supportRequests->url($supportRequests->lastPage()) }}">{{ $supportRequests->lastPage() }}</a>
                                @endif

                                {{-- Nút Next --}}
                                @if ($supportRequests->hasMorePages())
                                    <a class="join-item btn hover:border-red-600 hover:bg-red-600 hover:text-white" href="{{ $supportRequests->nextPageUrl() }}">
                                        <x-heroicon-m-chevron-right class="h-4 w-4" />
                                    </a>
                                @else
                                    <button class="join-item btn btn-disabled">
                                        <x-heroicon-m-chevron-right class="h-4 w-4" />
                                    </button>
                                @endif
                            </div>

                            <p class="text-sm text-gray-600">
                                Hiển thị {{ $supportRequests->firstItem() }} - {{ $supportRequests->lastItem() }} trong tổng số {{ $supportRequests->total() }} yêu cầu
                            </p>
                        </div>
                    @endif
                @else
                    <!-- Trạng thái trống -->
                    <div class="animate-scale-in py-16 text-center">
                        <div class="animate-pulse-slow mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-gray-100">
                            <x-heroicon-m-question-mark-circle class="h-10 w-10 text-gray-400" />
                        </div>
                        <h3 class="animate-fade-in-left mb-2 text-lg font-semibold text-gray-800">Chưa có yêu cầu hỗ trợ nào</h3>
                        <p class="animate-fade-in-right mb-6 text-gray-600">Bạn chưa gửi yêu cầu hỗ trợ nào. Khi cần hỗ trợ, hãy gửi yêu cầu từ lịch sử khám bệnh.</p>
                        <a class="animate-bounce-subtle inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-red-500 to-red-600 px-6 py-3 font-semibold text-white transition-all duration-300 hover:scale-105 hover:from-red-600 hover:to-red-700 hover:shadow-lg" href="{{ route('profile.appointment-history') }}">
                            <x-heroicon-s-clipboard-document-list class="h-5 w-5" />
                            Xem lịch sử khám
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Chi tiết yêu cầu hỗ trợ -->
    <div id="supportDetailModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="animate-scale-in max-h-[90vh] w-full max-w-4xl overflow-hidden rounded-3xl bg-white shadow-2xl">
            <!-- Modal Header -->
            <div class="flex items-center justify-between border-b bg-gradient-to-r from-orange-500 to-red-600 p-6 text-white">
                <div class="flex items-center gap-3">
                    <x-heroicon-s-question-mark-circle class="h-6 w-6" />
                    <h2 class="text-xl font-bold">Chi tiết yêu cầu hỗ trợ</h2>
                </div>
                <button class="flex h-8 w-8 items-center justify-center rounded-full text-white transition-all duration-300 hover:bg-white hover:bg-opacity-20" onclick="closeSupportDetailModal()">
                    <x-heroicon-s-x-mark class="h-5 w-5" />
                </button>
            </div>

            <!-- Modal Content -->
            <div class="max-h-[calc(90vh-5rem)] overflow-y-auto p-6">
                <div id="supportDetailContent">
                    <!-- Nội dung sẽ được load bằng JavaScript -->
                    <div class="flex items-center justify-center py-8">
                        <div class="h-8 w-8 animate-spin rounded-full border-b-2 border-red-600"></div>
                        <span class="ml-3 text-gray-600">Đang tải...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Global variables
        let supportRequests = @json($supportRequests->items());
        let currentSupportId = null;

        // Modal functions
        function openSupportDetailModal(supportId) {
            currentSupportId = supportId;
            const modal = document.getElementById('supportDetailModal');
            const content = document.getElementById('supportDetailContent');

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

            // Load support detail data
            loadSupportDetail(supportId);
        }

        function closeSupportDetailModal() {
            const modal = document.getElementById('supportDetailModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            currentSupportId = null;
        }

        function loadSupportDetail(supportId) {
            // Find support data
            const support = supportRequests.find(s => s.id == supportId);

            console.log('Loading support detail for:', supportId);
            console.log('Support data:', support);

            if (!support) {
                document.getElementById('supportDetailContent').innerHTML = `
                <div class="text-center py-8">
                    <div class="mx-auto h-12 w-12 text-gray-400 mb-4">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.96-.833-2.73 0L3.084 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Không tìm thấy yêu cầu</h3>
                    <p class="text-gray-600">Yêu cầu hỗ trợ không tồn tại hoặc đã bị xóa.</p>
                </div>
            `;
                return;
            }

            renderSupportDetail(support);
        }

        function renderSupportDetail(support) {
            const doctor = support.doctor;
            const appointment = support.appointment;

            // Format dates
            const createdAt = new Date(support.created_at).toLocaleDateString('vi-VN', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit'
            });

            const updatedAt = support.updated_at !== support.created_at ?
                new Date(support.updated_at).toLocaleDateString('vi-VN', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit'
                }) : null;

            const appointmentDate = appointment ?
                new Date(appointment.date).toLocaleDateString('vi-VN') : null;

            // Status mapping
            const statusText = {
                'pending': 'Đang chờ xử lý',
                'resolved': 'Đã giải quyết',
                'closed': 'Đã đóng'
            };

            const statusColors = {
                'pending': 'bg-orange-100 text-orange-800 border-orange-200',
                'resolved': 'bg-green-100 text-green-800 border-green-200',
                'closed': 'bg-gray-100 text-gray-800 border-gray-200'
            };

            const content = `
                <div class="space-y-6">
                    <!-- Support Header -->
                    <div class="border-b pb-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-2xl font-bold text-gray-800">Yêu cầu hỗ trợ #${support.id}</h3>
                            <span class="px-3 py-1 text-sm font-medium rounded-full border ${statusColors[support.status] || statusColors.pending}">
                                ${statusText[support.status] || support.status}
                            </span>
                        </div>
                        <div class="text-sm text-gray-500">
                            <div class="flex items-center gap-2">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Tạo lúc: ${createdAt}</span>
                            </div>
                            ${updatedAt ? `
                                                    <div class="flex items-center gap-2 mt-1">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                        </svg>
                                                        <span>Cập nhật: ${updatedAt}</span>
                                                    </div>
                                                ` : ''}
                        </div>
                    </div>

                    <!-- Appointment Info -->
                    ${appointment ? `
                                            <div class="bg-blue-50 rounded-xl p-4">
                                                <h4 class="font-bold text-lg text-gray-800 mb-3 flex items-center gap-2">
                                                    <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 4v6m-4-4h8m-4-4a4 4 0 11-8 0m4 4v6" />
                                                    </svg>
                                                    Thông tin cuộc hẹn liên quan
                                                </h4>
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-600">Ngày khám:</p>
                                                        <p class="text-sm text-gray-800">${appointmentDate}</p>
                                                    </div>
                                                    ${appointment.service ? `
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Dịch vụ:</p>
                                        <p class="text-sm text-gray-800">${appointment.service.name}</p>
                                    </div>
                                ` : ''}
                                                </div>
                                            </div>
                                        ` : ''}

                    <!-- Doctor Info -->
                    ${doctor ? `
                                            <div class="bg-green-50 rounded-xl p-4">
                                                <h4 class="font-bold text-lg text-gray-800 mb-3 flex items-center gap-2">
                                                    <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                    Bác sĩ phụ trách
                                                </h4>
                                                <div class="flex items-center gap-4">
                                                    <div class="h-12 w-12 overflow-hidden rounded-full">
                                                        <img class="h-full w-full object-cover" src="${doctor.user.avatar || '/default-avatar.png'}" alt="${doctor.user.name}">
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-gray-800">${doctor.user.name}</p>
                                                        <p class="text-sm text-gray-600">${doctor.medical_category?.name || 'Bác sĩ'}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        ` : ''}

                    <!-- Support Message -->
                    <div class="bg-gray-50 rounded-xl p-4">
                        <h4 class="font-bold text-lg text-gray-800 mb-3 flex items-center gap-2">
                            <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Nội dung yêu cầu
                        </h4>
                        <div class="prose max-w-none">
                            <p class="text-gray-700 whitespace-pre-wrap">${support.message}</p>
                        </div>
                    </div>

                    <!-- Actions (for future use) -->
                    <div class="border-t pt-4">
                        <div class="text-center text-sm text-gray-500">
                            Để cập nhật trạng thái hoặc phản hồi, vui lòng liên hệ trực tiếp với bác sĩ hoặc bộ phận hỗ trợ.
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('supportDetailContent').innerHTML = content;
        }

        // Close modal when clicking outside
        document.getElementById('supportDetailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeSupportDetailModal();
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && currentSupportId) {
                closeSupportDetailModal();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Intersection Observer cho stagger animation
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    }
                });
            }, observerOptions);

            // Quan sát các phần tử cần animation
            const animateElements = document.querySelectorAll('.stagger-item, .stat-card, .filter-btn');
            animateElements.forEach(el => {
                observer.observe(el);
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
                        transform: scale(0);
                        animation: ripple 600ms linear;
                        background-color: rgba(255,255,255,0.6);
                        left: ${x}px;
                        top: ${y}px;
                        width: ${size}px;
                        height: ${size}px;
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
        });
    </script>
@endpush
