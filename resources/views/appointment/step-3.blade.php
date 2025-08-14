@extends('layouts.app')

@section('content')
    <div class="mx-auto min-h-[95vh] max-w-5xl px-4 md:py-8">
        <!-- Progress Steps -->
        <div class="mb-8 flex justify-center">
            <ul class="steps steps-horizontal">
                <li class="step step-error">
                    <span class="text-xs">Chọn dịch vụ</span>
                </li>
                <li class="step step-error">
                    <span class="text-xs">Điền thông tin</span>
                </li>
                <li class="step step-error">
                    <span class="text-xs">Thanh toán & xác nhận</span>
                </li>
            </ul>
        </div>

        <!-- Main Card -->
        <div id="bookingContent" class="card">
            <div class="card-body px-0 py-0 md:px-5 md:py-5">
                <h1 class="card-title text-2xl font-bold">Đặt lịch hẹn</h1>

                <!-- Doctor Info -->
                <div class="mt-4 flex items-center gap-6">
                    <div class="avatar">
                        <div class="w-26 ring-error ring-offset-base-100 rounded-full ring ring-offset-2">
                            <img src="{{ asset($doctorProfile->user->avatar) }}" alt="{{ $doctorProfile->user->name }}">
                        </div>
                    </div>
                    <div class="text-xl">{{ $doctorProfile->user->name }}</div>
                </div>

                <form id="confirmationForm" class="mt-6" method="POST" action="{{ route('appointment.step.three.store') }}">
                    @csrf

                    <!-- Review schedule -->
                    <div class="card bg-base-200">
                        <div class="card-body">
                            <div class="flex items-center justify-between">
                                <h3 class="font-semibold">Xem xét lịch trình </h3>
                                <button class="btn btn-ghost btn-sm" type="button" onclick="editSchedule()">
                                    <x-bi-pencil class="size-4" />
                                    Chỉnh sửa
                                </button>
                            </div>
                            <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                                <div class="flex items-center gap-2 text-sm opacity-80">
                                    <x-bi-calendar-event class="size-4" />
                                    <span class="font-medium">Ngày:</span>
                                    <span>{{ $schedule['date'] }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm opacity-80">
                                    <x-bi-clock class="size-4" />
                                    <span class="font-medium">Thời gian:</span>
                                    <span>{{ $schedule['time'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detailed info -->
                    <div class="card bg-base-200 mt-4">
                        <div class="card-body">
                            <div class="flex items-center justify-between">
                                <h3 class="font-semibold">Thông tin chi tiết</h3>
                                <button class="btn btn-ghost btn-sm" type="button" onclick="editSchedule()">
                                    <x-bi-pencil class="size-4" />
                                    Chỉnh sửa
                                </button>
                            </div>

                            <div class="space-y-3 text-sm">
                                <div class="flex items-start gap-2">
                                    <x-bi-briefcase class="mt-0.5 size-4 opacity-70" />
                                    <div>
                                        <div class="font-bold">Dịch vụ</div>
                                        <div>{{ $bill['service']['name'] }}</div>
                                    </div>
                                </div>

                                <div class="flex items-start gap-2">
                                    <x-bi-journal-text class="mt-0.5 size-4 opacity-70" />
                                    <div>
                                        <div class="font-bold">Vấn đề y tế</div>
                                        <div class="whitespace-pre-wrap">{{ $summarize }}</div>
                                    </div>
                                </div>

                                <div class="flex items-start gap-2">
                                    <x-bi-stickies class="mt-0.5 size-4 opacity-70" />
                                    <div>
                                        <div class="font-bold">Ghi chú</div>
                                        <div class="whitespace-pre-wrap">{{ $note ?? 'Không có' }}</div>
                                    </div>
                                </div>

                                <div class="flex items-start gap-2">
                                    <x-bi-paperclip class="mt-0.5 size-4 opacity-70" />
                                    <div class="w-full">
                                        <div class="font-bold">File đính kèm</div>
                                        @php $files = session('appointment.temporary_files', []); @endphp
                                        @if (count($files))
                                            {{-- <h3 class="card-title text-base">Attached files</h3> --}}
                                            <ul class="space-y-2">
                                                @foreach ($files as $f)
                                                    @php $ext = strtolower(pathinfo($f['original_name'], PATHINFO_EXTENSION)); @endphp
                                                    <li class="flex items-center gap-2 text-sm">
                                                        @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                                            <x-bi-image class="size-4 opacity-70" />
                                                        @elseif ($ext === 'pdf')
                                                            <x-bi-file-earmark-pdf class="size-4 opacity-70" />
                                                        @else
                                                            <x-bi-file-earmark-word class="size-4 opacity-70" />
                                                        @endif
                                                        <span class="truncate">{{ $f['original_name'] }}</span>
                                                        <span class="badge badge-ghost ml-auto">{{ strtoupper($ext) }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            {{-- <div class="card mt-2">
                                            <div class="card-body p-4">
                                            </div>
                                        </div> --}}
                                        @else
                                            <div class="opacity-60">—</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment -->
                    <div class="card bg-base-200 mt-4">
                        <div class="card-body">
                            <h3 class="font-semibold">Phương thức thanh toán</h3>

                            <div class="card bg-base-100">
                                <div class="card-body p-4">
                                    <div class="mb-2 text-sm opacity-70">Thông tin hóa đơn</div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span>{{ $bill['service']['name'] }}</span>
                                        <span>{{ $bill['service']['price'] }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span>Tax VAT</span>
                                        <span>{{ $bill['vat'] }}</span>
                                    </div>
                                    <div class="divider my-2"></div>
                                    <div class="flex items-center justify-between font-semibold">
                                        <span>Tổng hóa đơn</span>
                                        <span class="text-red-700">{{ $bill['total'] }}</span>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-block mt-3 border border-dashed border-red-300 bg-white" type="button" onclick="document.getElementById('payment_modal').showModal()">
                                <x-bi-credit-card class="size-4" />
                                <span id="paymentPromptText">Vui lòng chọn phương thức thanh toán</span>
                            </button>

                            <input id="selectedPaymentMethod" name="payment_method" type="hidden" value="qr_transfer">
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="mt-6 flex items-center justify-between gap-3">
                        <a class="btn btn-outline btn-error rounded-full" href="#" onclick="history.back()">Back</a>
                        <button id="confirmBtn" class="btn continue-btn" type="submit" style="background-color: #DF1D32; color: #fff;">Tiếp tục</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Payment selection modal -->
    <dialog id="payment_modal" class="modal">
        <div class="modal-box bg-gray-50">
            <h3 class="text-lg font-bold">Chọn phương thức thanh toán</h3>

            <div class="mt-4 grid grid-cols-2 gap-4">

                {{-- Cash --}}
                <label class="border-base-200 bg-base-100 shadow-xs has-[input:checked]:border-error has-[input:checked]:text-error-content group relative flex aspect-square cursor-pointer flex-col justify-between rounded-3xl border p-5 transition hover:shadow-md has-[input:checked]:bg-[#DF1D32]">
                    <input class="peer sr-only" name="pm" type="radio" value="qr_transfer">
                    <!-- icon circle -->
                    <span class="h-13 w-13 text-error inline-flex items-center justify-center rounded-full bg-red-50">
                        <x-bi-cash class="h-8 w-8 fill-[#DF1D32]" />
                    </span>
                    <div>
                        <div class="font-semibold text-[#DF1D32] group-has-[input:checked]:text-white">QR code</div>
                        <div class="text-xs text-black/60 group-has-[input:checked]:text-white/80">Thanh toán qua mã QR</div>
                    </div>
                    <span class="peer-focus-visible:ring-error/60 pointer-events-none absolute inset-0 rounded-3xl ring-2 ring-transparent"></span>
                </label>

                {{-- Show more option (disabled tile) --}}
                <div class="shadow-xs border-base-200 bg-base-200/60 text-base-content/50 flex aspect-square flex-col items-center justify-center rounded-3xl border p-5 hover:shadow-md">
                    <span class="h-13 w-13 inline-flex items-center justify-center rounded-full border">
                        <x-bi-plus-lg class="h-8 w-8" />
                    </span>
                    <div class="mt-2 text-sm">Thêm phương thức thanh toán</div>
                </div>

            </div>

            <div class="modal-action">
                <button class="btn" onclick="document.getElementById('payment_modal').close()">Quay lại</button>
                <button id="applyPayment" class="btn" style="background-color: #DF1D32; color: #fff;">Đồng ý</button>
            </div>
        </div>
    </dialog>

    <!-- Final confirm modal -->
    <dialog id="confirm_modal" class="modal">
        <div class="modal-box bg-gray-100">
            <h3 class="text-center text-lg font-bold">Xác nhận thanh toán</h3>

            <div class="card mt-4 bg-white">
                <div class="card-body p-4">
                    <div class="flex items-center justify-between">
                        <span>{{ $bill['service']['name'] }}</span>
                        <span>{{ $bill['service']['price'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Tax VAT</span>
                        <span>{{ $bill['vat'] }}</span>
                    </div>
                    <div class="divider my-2"></div>
                    <div class="flex items-center justify-between font-semibold">
                        <span>Tổng thanh toán</span>
                        <span class="text-red-700">{{ $bill['total'] }}</span>
                    </div>
                </div>
            </div>

            <div class="alert mt-3">
                <x-bi-wallet2 class="fill-[#DF1D32]" />
                <div>
                    <h4 class="font-semibold">Phương thức thanh toán</h4>
                    <p id="confirmMethodText" class="text-sm opacity-100">QR — Bank Transfer</p>
                </div>
                <button class="btn btn-ghost btn-xs ml-auto" onclick="document.getElementById('payment_modal').showModal()">
                    <x-bi-pencil class="size-4" /> Sửa
                </button>
            </div>

            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Quay lại</button>
                </form>
                <button id="continuePayBtn" class="btn continue-btn" style="background-color: #DF1D32; color: #fff;">
                    <x-bi-arrow-right-circle class="mr-1 h-6 w-6" />
                    XÁC NHẬN
                </button>
            </div>
        </div>
    </dialog>
@endsection

@push('scripts')
    <script>
        let selectedPaymentMethod = 'qr_transfer';

        function editSchedule() {
            location.href = "{{ route('appointment.step.one', ['doctor_profile_id' => $doctorProfile->id]) }}";
        }

        // Update prompt + hidden input
        function updatePaymentPrompt() {
            const map = {
                qr_transfer: 'Đã chọn QR — Chuyển khoản ngân hàng',
                card: 'Đã chọn thanh toán bằng thẻ',
                bank: 'Đã chọn chuyển khoản ngân hàng',
                cash: 'Đã chọn thanh toán tiền mặt',
            };
            document.getElementById('paymentPromptText').textContent = map[selectedPaymentMethod] ||
                'Please select a payment method';
            document.getElementById('selectedPaymentMethod').value = selectedPaymentMethod;
            document.getElementById('confirmMethodText').textContent =
                (selectedPaymentMethod === 'qr_transfer') ? 'QR — Bank Transfer' : selectedPaymentMethod;
        }

        // Payment modal apply
        document.getElementById('applyPayment').addEventListener('click', () => {
            const checked = document.querySelector('input[name="pm"]:checked');
            selectedPaymentMethod = checked?.value || 'qr_transfer';
            updatePaymentPrompt();
            document.getElementById('payment_modal').close();
        });

        // Intercept submit -> open confirm modal
        document.getElementById('confirmationForm').addEventListener('submit', (e) => {
            e.preventDefault();
            updatePaymentPrompt();
            document.getElementById('confirm_modal').showModal();
        });

        // Final continue
        document.getElementById('continuePayBtn').addEventListener('click', () => {
            // optional: add loading state
            document.getElementById('confirmationForm').submit();
        });

        document.addEventListener('DOMContentLoaded', updatePaymentPrompt);
    </script>
@endpush
