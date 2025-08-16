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
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#DF1D32] text-white shadow-lg">
                        <span class="text-sm font-semibold">2</span>
                    </div>
                    <span class="ml-3 text-sm font-medium text-[#DF1D32]">Điền thông tin</span>
                </div>
                <div class="h-0.5 w-16 bg-gray-300 md:w-24"></div>
                <div class="flex items-center">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-200 text-gray-500">
                        <span class="text-sm font-semibold">3</span>
                    </div>
                    <span class="ml-3 text-sm font-medium text-gray-500">Thanh toán & xác nhận</span>
                </div>
            </div>
        </div>

        <!-- Main Card -->
        <div class="overflow-hidden rounded-3xl bg-white shadow-2xl">
            <div class="bg-gradient-to-r from-[#DF1D32] to-[#B91C3C] px-6 py-8 md:px-10">
                <h1 class="text-3xl font-bold text-white md:text-4xl">Thông tin y tế</h1>

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
                <!-- Form -->
                <form id="medicalForm" class="space-y-8" method="POST" action="{{ route('appointment.step.two.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Medical Problem Section -->
                    <div class="rounded-2xl border border-gray-200 bg-gradient-to-br from-gray-50 to-white p-6 shadow-lg md:p-8">
                        <div class="mb-6 flex items-center">
                            <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-full bg-[#DF1D32] text-white">
                                <x-bi-file-medical class="h-4 w-4" />
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Thông tin y tế</h2>
                        </div>

                        <div>
                            <label class="mb-3 block text-base font-semibold text-gray-700" for="medical_problem">
                                Tóm tắt vấn đề y tế của bạn
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <textarea id="medical_problem" class="min-h-[200px] w-full resize-none rounded-xl border-2 border-gray-200 bg-white p-4 text-gray-900 placeholder-gray-400 transition-all duration-300 focus:border-[#DF1D32] focus:outline-none focus:ring-4 focus:ring-[#DF1D32]/10" name="medical_problem" required
                                    placeholder="Vui lòng mô tả chi tiết về triệu chứng, thời gian xuất hiện, mức độ nghiêm trọng và các yếu tố liên quan khác...">{{ old('medical_problem') }}</textarea>
                                <div class="absolute bottom-3 right-3 text-xs text-gray-400">
                                    <span id="charCount">0</span> ký tự
                                </div>
                            </div>
                            @error('medical_problem')
                                <div class="mt-2 flex items-center text-red-500">
                                    <x-bi-exclamation-circle class="mr-1 h-4 w-4" />
                                    <span class="text-sm">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- File Upload Section -->
                    <div class="rounded-2xl border border-gray-200 bg-gradient-to-br from-gray-50 to-white p-6 shadow-lg md:p-8" x-data="filePicker()">
                        <div class="mb-6 flex items-center">
                            <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-full bg-[#DF1D32] text-white">
                                <x-bi-paperclip class="h-4 w-4" />
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Đính kèm tài liệu</h2>
                        </div>

                        <!-- Hidden input -->
                        <input id="medical_files" class="hidden" name="medical_files[]" type="file" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" x-ref="input" @change="addFiles($event)" />

                        <!-- Enhanced Dropzone -->
                        <div class="group relative cursor-pointer overflow-hidden rounded-xl border-2 border-dashed border-gray-300 bg-gradient-to-br from-gray-50 to-white p-8 text-center transition-all duration-300 hover:border-[#DF1D32] hover:bg-gradient-to-br hover:from-red-50 hover:to-red-50/30" @click="$refs.input.click()"
                            @dragover.prevent="dragging = true" @dragleave.prevent="dragging = false" @drop.prevent="handleDrop($event)" :class="dragging ? 'border-[#DF1D32] bg-red-50' : ''" :class="(files.length >= 10) ? 'pointer-events-none opacity-60' : ''">

                            <div class="flex flex-col items-center space-y-4">
                                <div class="relative">
                                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-[#DF1D32] to-[#B91C3C] text-white shadow-lg transition-transform group-hover:scale-110">
                                        <x-bi-cloud-arrow-up class="h-8 w-8" />
                                    </div>
                                    <div class="absolute -inset-1 rounded-full bg-gradient-to-br from-[#DF1D32] to-[#B91C3C] opacity-20 blur-sm"></div>
                                </div>

                                <div class="space-y-2">
                                    <div class="text-lg font-semibold text-gray-900">
                                        Kéo và thả tệp tại đây hoặc
                                        <span class="text-[#DF1D32] underline decoration-2 underline-offset-2">duyệt tệp</span>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        Hỗ trợ: PDF, DOC, DOCX, JPG, JPEG, PNG
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        Tối đa 10 tệp, mỗi tệp không quá 5MB
                                    </div>
                                </div>
                            </div>

                            <!-- Error message -->
                            <div class="mt-4" x-show="maxError">
                                <div class="inline-flex items-center rounded-lg bg-red-100 px-3 py-2 text-sm text-red-700">
                                    <x-bi-exclamation-triangle class="mr-2 h-4 w-4" />
                                    <span x-text="maxError"></span>
                                </div>
                            </div>

                            <!-- Rejected files alert -->
                            <div class="mt-4" x-show="rejected.length">
                                <div class="rounded-lg border border-red-200 bg-red-50 p-4">
                                    <div class="flex items-start">
                                        <x-bi-exclamation-triangle class="mr-3 mt-0.5 h-5 w-5 text-red-500" />
                                        <div class="text-left">
                                            <h3 class="text-sm font-semibold text-red-800">Một số tệp không thể tải lên</h3>
                                            <ul class="mt-2 space-y-1 text-xs text-red-700">
                                                <template x-for="r in rejected" :key="r.name + r.reason">
                                                    <li class="flex items-start">
                                                        <span class="mr-1">•</span>
                                                        <span><strong x-text="r.name"></strong>: <span x-text="r.reason"></span></span>
                                                    </li>
                                                </template>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- File Management Toolbar -->
                        <div class="mt-6 flex items-center justify-between" x-show="files.length">
                            <div class="flex items-center space-x-2">
                                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                                    <x-bi-files class="h-4 w-4" />
                                </div>
                                <div class="text-sm text-gray-600">
                                    <span class="font-medium" x-text="`${files.length} tệp`"></span>
                                    <span class="mx-1">•</span>
                                    <span x-text="human(totalBytes)"></span>
                                </div>
                            </div>
                            <button class="flex items-center space-x-2 rounded-lg bg-gray-100 px-3 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-200" type="button" @click="clearAll()">
                                <x-bi-trash class="h-4 w-4" />
                                <span>Xóa tất cả</span>
                            </button>
                        </div>

                        <!-- File List with Enhanced Design -->
                        <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2" x-show="files.length">
                            <template x-for="(f, idx) in files" :key="f._id">
                                <div class="group relative overflow-hidden rounded-xl border border-gray-200 bg-white p-4 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                                    <div class="flex items-center space-x-4">
                                        <!-- File Icon/Preview -->
                                        <div class="relative">
                                            <template x-if="f._isImage">
                                                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gradient-to-br from-green-100 to-green-200 text-green-600">
                                                    <x-bi-file-earmark-image class="h-6 w-6" />
                                                </div>
                                            </template>
                                            <template x-if="!f._isImage">
                                                <div class="flex h-12 w-12 items-center justify-center rounded-lg text-gray-600"
                                                    :class="{
                                                        'bg-gradient-to-br from-red-100 to-red-200 text-red-600': f._ext === 'pdf',
                                                        'bg-gradient-to-br from-blue-100 to-blue-200 text-blue-600': ['doc', 'docx'].includes(f._ext),
                                                        'bg-gradient-to-br from-gray-100 to-gray-200': !['pdf', 'doc', 'docx'].includes(f._ext)
                                                    }">
                                                    <template x-if="f._ext === 'pdf'">
                                                        <x-bi-file-earmark-pdf class="h-6 w-6" />
                                                    </template>
                                                    <template x-if="['doc','docx'].includes(f._ext)">
                                                        <x-bi-file-earmark-word class="h-6 w-6" />
                                                    </template>
                                                    <template x-if="!['pdf','doc','docx'].includes(f._ext)">
                                                        <x-bi-file-earmark class="h-6 w-6" />
                                                    </template>
                                                </div>
                                            </template>
                                        </div>

                                        <!-- File Details -->
                                        <div class="min-w-0 flex-1">
                                            <div class="truncate font-medium text-gray-900" x-text="f.name"></div>
                                            <div class="mt-1 flex items-center space-x-2 text-xs text-gray-500">
                                                <span x-text="human(f.size)"></span>
                                                <span>•</span>
                                                <span class="uppercase" x-text="f._ext || 'unknown'"></span>
                                            </div>

                                            <!-- Error badge -->
                                            <div class="mt-2" x-show="f._error">
                                                <span class="inline-flex items-center rounded-full bg-red-100 px-2 py-1 text-xs font-medium text-red-700">
                                                    <x-bi-exclamation-triangle class="mr-1 h-3 w-3" />
                                                    <span x-text="f._error"></span>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Remove Button -->
                                        <button class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-gray-500 opacity-0 transition-all duration-300 hover:bg-red-100 hover:text-red-600 group-hover:opacity-100" type="button" @click="remove(idx)" :disabled="submitting">
                                            <x-bi-x class="h-4 w-4" />
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Backend validation errors -->
                        @error('medical_files')
                            <div class="mt-4 flex items-center rounded-lg border border-red-200 bg-red-50 p-3 text-red-700">
                                <x-bi-exclamation-circle class="mr-2 h-4 w-4" />
                                <span class="text-sm">{{ $message }}</span>
                            </div>
                        @enderror
                        @if ($errors->has('medical_files.*'))
                            <div class="mt-4 space-y-2">
                                @foreach ($errors->get('medical_files.*') as $messages)
                                    @foreach ($messages as $msg)
                                        <div class="flex items-center rounded-lg border border-red-200 bg-red-50 p-3 text-red-700">
                                            <x-bi-exclamation-circle class="mr-2 h-4 w-4" />
                                            <span class="text-sm">{{ $msg }}</span>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Note Section -->
                    <div class="rounded-2xl border border-gray-200 bg-gradient-to-br from-gray-50 to-white p-6 shadow-lg md:p-8">
                        <div class="mb-6 flex items-center">
                            <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-full bg-[#DF1D32] text-white">
                                <x-bi-chat-text class="h-4 w-4" />
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Ghi chú thêm</h2>
                        </div>

                        <div>
                            <label class="mb-3 block text-base font-semibold text-gray-700" for="note">
                                Thông tin bổ sung (tùy chọn)
                            </label>
                            <input id="note" class="w-full rounded-xl border-2 border-gray-200 bg-white p-4 text-gray-900 placeholder-gray-400 transition-all duration-300 focus:border-[#DF1D32] focus:outline-none focus:ring-4 focus:ring-[#DF1D32]/10" name="note" type="text" value="{{ old('note') }}"
                                placeholder="Ví dụ: Thuốc đang sử dụng, tiền sử gia đình, mức độ cấp thiết..." />
                            @error('note')
                                <div class="mt-2 flex items-center text-red-500">
                                    <x-bi-exclamation-circle class="mr-1 h-4 w-4" />
                                    <span class="text-sm">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col gap-6 rounded-2xl border border-gray-200 bg-gradient-to-r from-gray-50 to-white p-6 md:flex-row md:items-center md:justify-between">
                        <button class="group flex items-center justify-center gap-3 rounded-xl border-2 border-gray-300 bg-white px-6 py-3 text-gray-700 transition-all duration-300 hover:-translate-y-1 hover:border-gray-400 hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-gray-200" type="button"
                            onclick="history.back()">
                            <x-bi-arrow-left class="h-5 w-5 transition-transform group-hover:-translate-x-1" />
                            <span class="font-semibold">Quay lại</span>
                        </button>

                        <button class="continue-btn group flex items-center justify-center gap-3 rounded-xl bg-gradient-to-r from-[#DF1D32] to-[#B91C3C] px-8 py-4 text-white shadow-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-[#DF1D32]/25" type="submit">
                            <span class="font-semibold">Tiếp tục thanh toán</span>
                            <x-bi-arrow-right-circle class="h-5 w-5 transition-transform group-hover:translate-x-1" />
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Custom animations and transitions */
        .form-section {
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

        .file-item:hover {
            transform: translateY(-2px);
        }

        /* Smooth focus effects */
        .focus-ring:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(223, 29, 50, 0.1);
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

        /* Character counter animation */
        .char-counter {
            transition: all 0.3s ease;
        }

        .char-counter.warning {
            color: #f59e0b;
        }

        .char-counter.danger {
            color: #ef4444;
        }
    </style>
@endpush

@push('scripts')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function filePicker() {
            const MAX_FILES = 10;
            const MAX_BYTES = 5 * 1024 * 1024; // 5 MiB strict
            const ALLOWED_EXT = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];

            return {
                files: [], // only valid files live here
                rejected: [], // { name, reason }
                dragging: false,
                submitting: false,
                maxError: null,

                get totalBytes() {
                    return this.files.reduce((a, f) => a + f.size, 0);
                },

                human(bytes) {
                    if (bytes < 1024) return `${bytes} B`;
                    if (bytes < 1024 * 1024) return `${(bytes/1024).toFixed(1)} KB`;
                    return `${(bytes/1024/1024).toFixed(2)} MB`;
                },

                addFiles(e) {
                    const incoming = e.target?.files ? [...e.target.files] : [...e.dataTransfer.files];

                    // Limit check (combined)
                    if (this.files.length + incoming.length > MAX_FILES) {
                        this.maxError = `Chỉ được tải lên tối đa ${MAX_FILES} tệp.`;
                        this.showErrorNotification(this.maxError);
                        return;
                    }
                    this.maxError = null;
                    this.rejected = [];

                    for (const file of incoming) {
                        const ext = (file.name.split('.').pop() || '').toLowerCase();

                        // Reject early: type + size
                        if (!ALLOWED_EXT.includes(ext)) {
                            this.rejected.push({
                                name: file.name,
                                reason: 'Loại tệp không được hỗ trợ'
                            });
                            continue;
                        }
                        if (file.size > MAX_BYTES) {
                            this.rejected.push({
                                name: file.name,
                                reason: `Tệp quá lớn (tối đa ${this.human(MAX_BYTES)})`
                            });
                            continue;
                        }

                        // Valid → wrap and add
                        const wrapped = {
                            _id: crypto.randomUUID(),
                            file,
                            name: file.name,
                            size: file.size,
                            type: file.type,
                            _ext: ext,
                            _isImage: ['jpg', 'jpeg', 'png'].includes(ext),
                            _preview: null,
                        };

                        if (wrapped._isImage) {
                            const reader = new FileReader();
                            reader.onload = ev => {
                                wrapped._preview = ev.target.result;
                                this.$nextTick(() => {});
                            };
                            reader.readAsDataURL(file);
                        }

                        this.files.push(wrapped);
                    }

                    this.syncInput();
                    this.dragging = false;

                    // Show success notification if files were added
                    if (incoming.length > this.rejected.length) {
                        this.showSuccessNotification(`Đã thêm ${incoming.length - this.rejected.length} tệp thành công`);
                    }
                },

                handleDrop(e) {
                    this.addFiles(e);
                },

                remove(idx) {
                    const fileName = this.files[idx].name;
                    this.files.splice(idx, 1);
                    this.syncInput();
                    this.maxError = null;
                    this.showInfoNotification(`Đã xóa "${fileName}"`);
                },

                clearAll() {
                    const count = this.files.length;
                    this.files = [];
                    this.syncInput();
                    this.maxError = null;
                    this.rejected = [];
                    this.showInfoNotification(`Đã xóa ${count} tệp`);
                },

                syncInput() {
                    const dt = new DataTransfer();
                    for (const f of this.files) dt.items.add(f.file);
                    this.$refs.input.files = dt.files;
                },

                showSuccessNotification(message) {
                    this.showNotification(message, 'success');
                },

                showErrorNotification(message) {
                    this.showNotification(message, 'error');
                },

                showInfoNotification(message) {
                    this.showNotification(message, 'info');
                },

                showNotification(message, type = 'info') {
                    const notification = document.createElement('div');
                    const colors = {
                        success: 'bg-green-500',
                        error: 'bg-red-500',
                        info: 'bg-blue-500'
                    };

                    notification.className = `fixed top-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-xl shadow-lg transform translate-x-full transition-transform duration-300 z-50`;
                    notification.textContent = message;
                    document.body.appendChild(notification);

                    setTimeout(() => notification.classList.remove('translate-x-full'), 100);
                    setTimeout(() => {
                        notification.classList.add('translate-x-full');
                        setTimeout(() => notification.remove(), 300);
                    }, 3000);
                }
            };
        }
    </script>

    <script>
        // Enhanced form validation and submission
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('medicalForm');
            const textarea = document.getElementById('medical_problem');
            const charCount = document.getElementById('charCount');
            const continueBtn = document.querySelector('.continue-btn');

            // Character counter with visual feedback
            function updateCharCount() {
                const count = textarea.value.length;
                charCount.textContent = count;

                // Add visual feedback based on length
                charCount.className = 'char-counter';
                if (count > 1000) {
                    charCount.classList.add('danger');
                } else if (count > 500) {
                    charCount.classList.add('warning');
                }
            }

            // Auto-resize textarea with smooth animation
            function autoResize() {
                textarea.style.height = 'auto';
                const newHeight = Math.max(200, textarea.scrollHeight);
                textarea.style.height = newHeight + 'px';
            }

            // Initialize features
            if (textarea && charCount) {
                textarea.addEventListener('input', function() {
                    updateCharCount();
                    autoResize();
                });

                // Initial setup
                updateCharCount();
                autoResize();
            }

            // Enhanced form submission
            if (form) {
                form.addEventListener('submit', function(e) {
                    const problem = textarea.value.trim();

                    if (!problem) {
                        e.preventDefault();
                        showErrorNotification('Vui lòng mô tả vấn đề y tế của bạn');
                        textarea.focus();
                        textarea.classList.add('border-red-500');
                        setTimeout(() => textarea.classList.remove('border-red-500'), 3000);
                        return;
                    }

                    if (problem.length < 50) {
                        e.preventDefault();
                        showErrorNotification('Vui lòng mô tả chi tiết hơn (ít nhất 50 ký tự)');
                        textarea.focus();
                        return;
                    }

                    // Show loading state
                    if (continueBtn) {
                        continueBtn.disabled = true;
                        continueBtn.innerHTML = `
                            <div class="flex items-center gap-3">
                                <div class="h-5 w-5 animate-spin rounded-full border-2 border-white/30 border-t-white"></div>
                                <span>Đang xử lý...</span>
                            </div>
                        `;
                    }
                });
            }

            // Add smooth scroll to form sections
            const formSections = document.querySelectorAll('.rounded-2xl');
            formSections.forEach((section, index) => {
                section.style.animationDelay = `${index * 0.1}s`;
                section.classList.add('form-section');
            });
        });

        // Notification helper function
        function showErrorNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg transform translate-x-full transition-transform duration-300 z-50 flex items-center';
            notification.innerHTML = `
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                ${message}
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
