@extends('layouts.app')

@section('content')
    <div class="mx-auto min-h-[95vh] max-w-6xl px-4 py-6 md:py-10">
        <!-- Progress Steps -->
        <div class="mb-10 flex justify-center">
            <div class="flex items-center space-x-4 md:space-x-8">
                <div class="flex items-center">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-500 text-white shadow-lg">
                        <x-bi-check class="h-5 w-5 font-bold" />
                    </div>
                    <span class="ml-3 text-sm font-medium text-green-600">Chọn dịch vụ</span>
                </div>
                <div class="h-0.5 w-16 bg-green-300 md:w-24"></div>
                <div class="flex items-center">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-500 text-white shadow-lg">
                        <x-bi-check class="h-5 w-5 font-bold" />
                    </div>
                    <span class="ml-3 text-sm font-medium text-green-600">Điền thông tin</span>
                </div>
                <div class="h-0.5 w-16 bg-green-300 md:w-24"></div>
                <div class="flex items-center">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#DF1D32] text-white shadow-lg">
                        <span class="text-sm font-semibold">3</span>
                    </div>
                    <span class="ml-3 text-sm font-medium text-[#DF1D32]">Thanh toán & xác nhận</span>
                </div>
            </div>
        </div>

        <!-- Main Card -->
        <div id="bookingContent" class="overflow-hidden rounded-3xl bg-white shadow-2xl">
            <div class="bg-gradient-to-r from-[#DF1D32] to-[#B91C3C] px-6 py-8 md:px-10">
                <h1 class="text-3xl font-bold text-white md:text-4xl">Xác nhận đặt lịch</h1>

                <!-- Doctor Profile Section -->
                <div class="mt-6 flex items-center gap-6">
                    <div class="relative">
                        <div class="h-20 w-20 overflow-hidden rounded-full border-4 border-white/30 shadow-xl md:h-24 md:w-24">
                            <img class="h-full w-full object-cover" src="{{ asset($doctorProfile->user->avatar) }}" alt="{{ $doctorProfile->user->name }}">
                        </div>
                        <div class="absolute -bottom-1 -right-1 h-6 w-6 rounded-full border-2 border-white bg-green-400"></div>
                    </div>
                    <div>
                        <div class="text-xl font-semibold text-white md:text-2xl">{{ $doctorProfile->user->name }}</div>
                        <div class="text-white/80">Bác Sĩ Khoa {{ $doctorProfile->medicalCategory->name }}</div>
                        <div class="mt-2 flex items-center text-white/80">
                            <x-bi-star-fill class="mr-1 h-4 w-4 text-yellow-300" />
                            <span class="text-sm">
                                {{ $doctorProfile->reviews_avg_rate ? number_format($doctorProfile->reviews_avg_rate, 1) : '0.0' }}
                                ({{ $doctorProfile->reviews_count ?? 0 }} đánh giá)
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-8 md:px-10 md:py-12">

                <form id="confirmationForm" method="POST" action="{{ route('appointment.step.three.store') }}">
                    @csrf

                    <!-- Review Schedule Section -->
                    <div class="mb-8 rounded-2xl border border-blue-200 bg-gradient-to-br from-blue-50 to-indigo-50 p-6 shadow-lg md:p-8">
                        <div class="mb-6 flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-full bg-blue-500 text-white">
                                    <x-bi-calendar-check class="h-4 w-4" />
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Lịch hẹn của bạn</h3>
                            </div>
                            <button class="flex items-center gap-2 rounded-lg bg-blue-100 px-3 py-2 text-sm font-medium text-blue-700 transition-colors hover:bg-blue-200" type="button" onclick="editSchedule()">
                                <x-bi-pencil class="h-4 w-4" />
                                Chỉnh sửa
                            </button>
                        </div>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="flex items-center gap-4 rounded-xl bg-white p-4 shadow-sm">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                                    <x-bi-calendar-event class="h-6 w-6" />
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Ngày hẹn</div>
                                    <div class="text-lg font-bold text-gray-900">{{ $schedule['date'] }}</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 rounded-xl bg-white p-4 shadow-sm">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100 text-green-600">
                                    <x-bi-clock class="h-6 w-6" />
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Thời gian</div>
                                    <div class="text-lg font-bold text-gray-900">{{ $schedule['time'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detailed Information Section -->
                    <div class="mb-8 rounded-2xl border border-gray-200 bg-gradient-to-br from-gray-50 to-white p-6 shadow-lg md:p-8">
                        <div class="mb-6 flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-full bg-[#DF1D32] text-white">
                                    <x-bi-file-medical class="h-4 w-4" />
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Thông tin chi tiết</h3>
                            </div>
                            <button class="flex items-center gap-2 rounded-lg bg-gray-100 px-3 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-200" type="button" onclick="editSchedule()">
                                <x-bi-pencil class="h-4 w-4" />
                                Chỉnh sửa
                            </button>
                        </div>

                        <div class="space-y-6">
                            <!-- Service -->
                            <div class="flex items-start gap-4 rounded-xl border border-gray-100 bg-white p-4 shadow-sm">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-purple-100 text-purple-600">
                                    <x-bi-briefcase class="h-5 w-5" />
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-gray-500">Dịch vụ đã chọn</div>
                                    <div class="text-lg font-semibold text-gray-900">{{ $bill['service']['name'] }}</div>
                                </div>
                            </div>

                            <!-- Medical Problem -->
                            <div class="flex items-start gap-4 rounded-xl border border-gray-100 bg-white p-4 shadow-sm">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-red-100 text-red-600">
                                    <x-bi-journal-text class="h-5 w-5" />
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-gray-500">Vấn đề y tế</div>
                                    <div class="mt-1 whitespace-pre-wrap leading-relaxed text-gray-900">{{ $summarize }}</div>
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="flex items-start gap-4 rounded-xl border border-gray-100 bg-white p-4 shadow-sm">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-yellow-100 text-yellow-600">
                                    <x-bi-chat-text class="h-5 w-5" />
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-gray-500">Ghi chú</div>
                                    <div class="mt-1 text-gray-900">{{ $note ?? 'Không có ghi chú thêm' }}</div>
                                </div>
                            </div>

                            <!-- Attached Files -->
                            <div class="flex items-start gap-4 rounded-xl border border-gray-100 bg-white p-4 shadow-sm">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 text-green-600">
                                    <x-bi-paperclip class="h-5 w-5" />
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-gray-500">Tài liệu đính kèm</div>
                                    @php $files = session('appointment.temporary_files', []); @endphp
                                    @if (count($files))
                                        <div class="mt-3 space-y-2">
                                            @foreach ($files as $f)
                                                @php $ext = strtolower(pathinfo($f['original_name'], PATHINFO_EXTENSION)); @endphp
                                                <div class="flex items-center gap-3 rounded-lg bg-gray-50 p-3">
                                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg text-gray-600"
                                                        style="background: {{ in_array($ext, ['jpg', 'jpeg', 'png']) ? 'linear-gradient(135deg, #10b981, #059669)' : ($ext === 'pdf' ? 'linear-gradient(135deg, #ef4444, #dc2626)' : 'linear-gradient(135deg, #3b82f6, #2563eb)') }}; color: white;">
                                                        @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                                            <x-bi-file-earmark-image class="h-4 w-4" />
                                                        @elseif ($ext === 'pdf')
                                                            <x-bi-file-earmark-pdf class="h-4 w-4" />
                                                        @else
                                                            <x-bi-file-earmark-word class="h-4 w-4" />
                                                        @endif
                                                    </div>
                                                    <span class="flex-1 truncate text-sm font-medium text-gray-900">{{ $f['original_name'] }}</span>
                                                    <span class="rounded-full bg-gray-200 px-2 py-1 text-xs font-medium text-gray-600">{{ strtoupper($ext) }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="mt-1 text-gray-500">Không có tài liệu đính kèm</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Section -->
                    <div class="mb-8 rounded-2xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-teal-50 p-6 shadow-lg md:p-8">
                        <div class="mb-6 flex items-center">
                            <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500 text-white">
                                <x-bi-credit-card class="h-4 w-4" />
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Thông tin thanh toán</h3>
                        </div>

                        <!-- Bill Summary -->
                        <div class="mb-6 rounded-xl border border-emerald-100 bg-white p-6 shadow-sm">
                            <div class="mb-4 text-lg font-semibold text-gray-900">Hóa đơn chi tiết</div>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between py-2">
                                    <span class="text-gray-600">{{ $bill['service']['name'] }}</span>
                                    <span class="font-medium text-gray-900">{{ $bill['service']['price'] }}</span>
                                </div>
                                <div class="flex items-center justify-between py-2">
                                    <span class="text-gray-600">Thuế VAT (10%)</span>
                                    <span class="font-medium text-gray-900">{{ $bill['vat'] }}</span>
                                </div>
                                <div class="border-t border-gray-200 pt-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-lg font-bold text-gray-900">Tổng thanh toán</span>
                                        <span class="text-2xl font-bold text-[#DF1D32]">{{ $bill['total'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method Selection -->
                        <div class="rounded-xl border border-emerald-100 bg-white p-6 shadow-sm">
                            <div class="mb-4 text-lg font-semibold text-gray-900">Phương thức thanh toán</div>
                            <button class="group relative w-full overflow-hidden rounded-xl border-2 border-dashed border-emerald-300 bg-gradient-to-r from-emerald-50 to-teal-50 p-6 text-center transition-all duration-300 hover:border-emerald-400 hover:shadow-md" type="button"
                                onclick="document.getElementById('payment_modal').showModal()">
                                <div class="flex items-center justify-center space-x-3">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 group-hover:bg-emerald-200">
                                        <x-bi-wallet2 class="h-6 w-6" />
                                    </div>
                                    <div class="text-left">
                                        <div id="paymentPromptText" class="font-semibold text-gray-900">Vui lòng chọn phương thức thanh toán</div>
                                        <div class="text-sm text-gray-500">Nhấn để thay đổi</div>
                                    </div>
                                </div>
                            </button>
                            <input id="selectedPaymentMethod" name="payment_method" type="hidden" value="qr_transfer">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col gap-6 rounded-2xl border border-gray-200 bg-gradient-to-r from-gray-50 to-white p-6 md:flex-row md:items-center md:justify-between">
                        <button class="group flex items-center justify-center gap-3 rounded-xl border-2 border-gray-300 bg-white px-6 py-3 text-gray-700 transition-all duration-300 hover:-translate-y-1 hover:border-gray-400 hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-gray-200" type="button"
                            onclick="history.back()">
                            <x-bi-arrow-left class="h-5 w-5 transition-transform group-hover:-translate-x-1" />
                            <span class="font-semibold">Quay lại</span>
                        </button>

                        <button id="confirmBtn" class="continue-btn group flex items-center justify-center gap-3 rounded-xl bg-gradient-to-r from-[#DF1D32] to-[#B91C3C] px-8 py-4 text-white shadow-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-[#DF1D32]/25"
                            type="submit">
                            <span class="font-semibold">Xác nhận và thanh toán</span>
                            <x-bi-check-circle class="h-5 w-5 transition-transform group-hover:scale-110" />
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Payment Selection Modal -->
    <dialog id="payment_modal" class="modal">
        <div class="modal-box max-w-2xl bg-white">
            <div class="mb-6 flex items-center">
                <div class="mr-3 flex h-10 w-10 items-center justify-center rounded-full bg-[#DF1D32] text-white">
                    <x-bi-credit-card class="h-5 w-5" />
                </div>
                <h3 class="text-2xl font-bold text-gray-900">Chọn phương thức thanh toán</h3>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- QR Transfer -->
                <label
                    class="group relative cursor-pointer overflow-hidden rounded-2xl border-2 border-gray-200 bg-white p-6 transition-all duration-300 hover:-translate-y-1 hover:border-[#DF1D32] hover:shadow-lg has-[input:checked]:border-[#DF1D32] has-[input:checked]:bg-gradient-to-br has-[input:checked]:from-[#DF1D32] has-[input:checked]:to-[#B91C3C] has-[input:checked]:shadow-xl">
                    <input class="peer sr-only" name="pm" type="radio" value="qr_transfer" checked>

                    <!-- Selection indicator -->
                    <div class="absolute right-4 top-4 h-5 w-5 rounded-full border-2 border-gray-300 bg-white transition-all group-has-[input:checked]:border-white group-has-[input:checked]:bg-white">
                        <div class="absolute inset-1 rounded-full bg-[#DF1D32] opacity-0 transition-opacity group-has-[input:checked]:opacity-100"></div>
                    </div>

                    <!-- Icon -->
                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-xl bg-gradient-to-br from-[#DF1D32]/10 to-[#B91C3C]/10 text-[#DF1D32] transition-all group-has-[input:checked]:bg-white/20 group-has-[input:checked]:text-white">
                        <x-bi-qr-code class="h-8 w-8" />
                    </div>

                    <div>
                        <div class="text-lg font-bold text-gray-900 group-has-[input:checked]:text-white">Mã QR</div>
                        <div class="mt-1 text-sm text-gray-600 group-has-[input:checked]:text-white/90">Thanh toán qua mã QR</div>
                        <div class="mt-3 flex items-center text-xs text-gray-500 group-has-[input:checked]:text-white/80">
                            <x-bi-shield-check class="mr-1 h-3 w-3" />
                            Bảo mật cao
                        </div>
                    </div>
                </label>

                <!-- More Options (Disabled) -->
                <div class="flex cursor-not-allowed flex-col items-center justify-center rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 p-6 text-gray-400 transition-all duration-300">
                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-xl border border-gray-300">
                        <x-bi-plus-lg class="h-8 w-8" />
                    </div>
                    <div class="text-center">
                        <div class="font-semibold">Thêm phương thức</div>
                        <div class="mt-1 text-sm">Sắp có thêm</div>
                    </div>
                </div>
            </div>

            <div class="modal-action mt-8 flex justify-end gap-4">
                <button class="rounded-xl border-2 border-gray-300 bg-white px-6 py-3 font-medium text-gray-700 transition-all hover:bg-gray-50" onclick="document.getElementById('payment_modal').close()">
                    Hủy
                </button>
                <button id="applyPayment" class="rounded-xl bg-gradient-to-r from-[#DF1D32] to-[#B91C3C] px-6 py-3 font-medium text-white shadow-lg transition-all hover:shadow-xl">
                    Xác nhận
                </button>
            </div>
        </div>
    </dialog>

    <!-- Final Confirmation Modal -->
    <dialog id="confirm_modal" class="modal">
        <div class="modal-box max-w-xl bg-white">
            <div class="mb-6 text-center">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-green-100 to-emerald-100">
                    <x-bi-check-circle class="h-8 w-8 text-green-600" />
                </div>
                <h3 class="text-2xl font-bold text-gray-900">Xác nhận thanh toán</h3>
                <p class="mt-2 text-gray-600">Vui lòng kiểm tra thông tin cuối cùng trước khi thanh toán</p>
            </div>

            <!-- Payment Summary -->
            <div class="mb-6 rounded-xl border border-gray-200 bg-gradient-to-br from-gray-50 to-white p-6">
                <div class="mb-4 text-lg font-semibold text-gray-900">Tóm tắt thanh toán</div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">{{ $bill['service']['name'] }}</span>
                        <span class="font-medium text-gray-900">{{ $bill['service']['price'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Thuế VAT</span>
                        <span class="font-medium text-gray-900">{{ $bill['vat'] }}</span>
                    </div>
                    <div class="border-t border-gray-200 pt-3">
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold text-gray-900">Tổng thanh toán</span>
                            <span class="text-2xl font-bold text-[#DF1D32]">{{ $bill['total'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Method Info -->
            <div class="mb-6 rounded-xl border border-blue-200 bg-blue-50 p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-full bg-blue-500 text-white">
                            <x-bi-wallet2 class="h-4 w-4" />
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Phương thức thanh toán</div>
                            <div id="confirmMethodText" class="text-sm text-gray-600">QR — Bank Transfer</div>
                        </div>
                    </div>
                    <button class="flex items-center rounded-lg bg-blue-100 px-3 py-2 text-sm font-medium text-blue-700 transition-colors hover:bg-blue-200" onclick="document.getElementById('payment_modal').showModal()">
                        <x-bi-pencil class="mr-1 h-3 w-3" />
                        Thay đổi
                    </button>
                </div>
            </div>

            <div class="modal-action flex justify-end gap-4">
                <button class="rounded-xl border-2 border-gray-300 bg-white px-6 py-3 font-medium text-gray-700 transition-all hover:bg-gray-50" onclick="document.getElementById('confirm_modal').close()">
                    Quay lại
                </button>
                <button id="continuePayBtn" class="group flex items-center gap-2 rounded-xl bg-gradient-to-r from-[#DF1D32] to-[#B91C3C] px-6 py-3 font-medium text-white shadow-lg transition-all hover:shadow-xl">
                    <span>XÁC NHẬN THANH TOÁN</span>
                    <x-bi-arrow-right-circle class="h-5 w-5 transition-transform group-hover:translate-x-1" />
                </button>
            </div>
        </div>
    </dialog>
@endsection

@push('scripts')
    <style>
        /* Custom animations and transitions */
        .section-animate {
            animation: slideInUp 0.6s ease-out;
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

        .payment-card:hover {
            transform: translateY(-4px);
        }

        /* Modal backdrop blur */
        .modal[open] {
            backdrop-filter: blur(8px);
        }

        /* Loading animation */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        /* Success pulse animation */
        @keyframes pulse-success {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(34, 197, 94, 0);
            }
        }

        .pulse-success {
            animation: pulse-success 2s infinite;
        }

        /* File badge hover effect */
        .file-badge:hover {
            transform: scale(1.05);
        }
    </style>
    <script>
        let selectedPaymentMethod = 'qr_transfer';

        function editSchedule() {
            location.href = "{{ route('appointment.step.one', ['doctor_profile_id' => $doctorProfile->id]) }}";
        }

        // Enhanced payment prompt update with better UX
        function updatePaymentPrompt() {
            const map = {
                qr_transfer: {
                    text: 'Đã chọn: Thanh toán qua mã QR',
                    icon: '🏦',
                    description: 'Quét mã QR để thanh toán'
                },
                card: {
                    text: 'Đã chọn: Thanh toán bằng thẻ',
                    icon: '💳',
                    description: 'Thanh toán bằng thẻ tín dụng/ghi nợ'
                },
                bank: {
                    text: 'Đã chọn: Chuyển khoản ngân hàng',
                    icon: '🏦',
                    description: 'Chuyển khoản trực tiếp'
                },
                cash: {
                    text: 'Đã chọn: Thanh toán tiền mặt',
                    icon: '💵',
                    description: 'Thanh toán bằng tiền mặt'
                }
            };

            const method = map[selectedPaymentMethod];
            const promptElement = document.getElementById('paymentPromptText');

            if (method && promptElement) {
                promptElement.innerHTML = `
                    <div class="font-semibold text-gray-900">${method.text}</div>
                    <div class="text-sm text-gray-500">${method.description}</div>
                `;

                // Add success animation
                promptElement.parentElement.classList.add('border-emerald-400', 'bg-emerald-50');
                setTimeout(() => {
                    promptElement.parentElement.classList.remove('border-emerald-400', 'bg-emerald-50');
                }, 2000);
            }

            document.getElementById('selectedPaymentMethod').value = selectedPaymentMethod;
            document.getElementById('confirmMethodText').textContent =
                selectedPaymentMethod === 'qr_transfer' ? 'QR — Chuyển khoản ngân hàng' : selectedPaymentMethod;
        }

        // Enhanced payment modal apply with validation
        document.getElementById('applyPayment').addEventListener('click', () => {
            const checked = document.querySelector('input[name="pm"]:checked');

            if (!checked) {
                showNotification('Vui lòng chọn phương thức thanh toán', 'error');
                return;
            }

            selectedPaymentMethod = checked.value;
            updatePaymentPrompt();
            document.getElementById('payment_modal').close();
            showNotification('Đã cập nhật phương thức thanh toán', 'success');
        });

        // Enhanced form submission with loading states
        document.getElementById('confirmationForm').addEventListener('submit', (e) => {
            e.preventDefault();

            // Validation
            if (!selectedPaymentMethod) {
                showNotification('Vui lòng chọn phương thức thanh toán', 'error');
                return;
            }

            updatePaymentPrompt();
            document.getElementById('confirm_modal').showModal();
        });

        // Final payment processing
        document.getElementById('continuePayBtn').addEventListener('click', () => {
            const button = document.getElementById('continuePayBtn');
            const form = document.getElementById('confirmationForm');

            // Show loading state
            button.disabled = true;
            button.innerHTML = `
                <div class="flex items-center gap-2">
                    <div class="h-5 w-5 animate-spin rounded-full border-2 border-white/30 border-t-white"></div>
                    <span>Đang xử lý thanh toán...</span>
                </div>
            `;

            // Add processing delay for better UX
            setTimeout(() => {
                form.submit();
            }, 1500);
        });

        // Initialize and add animations
        document.addEventListener('DOMContentLoaded', () => {
            updatePaymentPrompt();

            // Add staggered animations to sections
            const sections = document.querySelectorAll('.rounded-2xl');
            sections.forEach((section, index) => {
                section.style.animationDelay = `${index * 0.1}s`;
                section.classList.add('section-animate');
            });
        });

        // Notification system
        function showNotification(message, type = 'info') {
            const colors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                info: 'bg-blue-500',
                warning: 'bg-yellow-500'
            };

            const icons = {
                success: '✅',
                error: '❌',
                info: 'ℹ️',
                warning: '⚠️'
            };

            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-xl shadow-lg transform translate-x-full transition-transform duration-300 z-50 flex items-center max-w-sm`;
            notification.innerHTML = `
                <span class="mr-2">${icons[type]}</span>
                <span>${message}</span>
            `;

            document.body.appendChild(notification);

            setTimeout(() => notification.classList.remove('translate-x-full'), 100);
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => notification.remove(), 300);
            }, 4000);
        }
    </script>
@endpush
