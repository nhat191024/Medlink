@extends('layouts.app')

@section('content')
    <div class="mx-auto my-3 max-w-5xl px-4 md:py-8">
        <!-- Progress Steps -->
        <div class="mb-8 flex justify-center">
            <ul class="steps steps-horizontal">
                <li class="step step-error">
                    <span class="text-xs">Chọn dịch vụ</span>
                </li>
                <li class="step step-error">
                    <span class="text-xs">Điền thông tin</span>
                </li>
                <li class="step">
                    <span class="text-xs">Thanh toán & xác nhận</span>
                </li>
            </ul>
        </div>

        <!-- Main Card -->
        <div class="card">
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

                <div class="card bg-[#F6F6F6] px-5 pb-3 pt-0 shadow-lg md:px-10 md:py-10">
                    <!-- Form -->
                    <form id="medicalForm" class="mt-6 space-y-6" method="POST" action="{{ route('appointment.step.two.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Medical Problem -->
                        <div>
                            <label class="label" for="medical_problem">
                                <span class="label-text mb-1 ml-2 text-wrap text-base md:font-medium">
                                    Tóm tắt vấn đề y tế của bạn
                                    <span class="text-error">*</span>
                                </span>
                            </label>
                            <textarea id="medical_problem" class="textarea bg-base-200 min-h-52 w-full p-3 px-5" name="medical_problem" required placeholder="Nhập lịch sử y tế của bạn...">{{ old('medical_problem') }}</textarea>

                            @error('medical_problem')
                                <div class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Attach files -->
                        <div class="space-y-3" x-data="filePicker()">
                            <label class="label">
                                <span class="label-text mb-1 ml-2 text-base md:font-medium">Đính kèm tệp</span>
                            </label>

                            <!-- Hidden input (the real one) -->
                            <input id="medical_files" class="file-input hidden" name="medical_files[]" type="file" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" x-ref="input" @change="addFiles($event)" />

                            <!-- Dropzone -->
                            <div class="rounded-box border-base-300 bg-base-200 cursor-pointer border-2 border-dashed p-6 text-center transition hover:bg-red-50" @click="$refs.input.click()" @dragover.prevent="dragging = true" @dragleave.prevent="dragging = false" @drop.prevent="handleDrop($event)"
                                :class="dragging ? 'border-error' : ''" :class="(files.length >= 10) ? 'pointer-events-none opacity-60' : ''">
                                <div class="flex flex-col items-center gap-2">
                                    <x-bi-cloud-arrow-up class="h-8 w-8 opacity-70" />
                                    <div class="text-sm opacity-80">
                                        Kéo và thả tệp tại đây hoặc <span class="link text-red-700">Duyệt</span>
                                    </div>
                                    <div class="text-xs opacity-60">PDF, JPG, JPEG, PNG. Tối Đa 5.48 MB với mỗi file.</div>
                                    <div class="mt-1 text-xs text-red-700" x-show="maxError" x-text="maxError"></div>
                                    <!-- Rejected summary alert -->
                                    <div class="alert alert-error mt-2 bg-red-100" x-show="rejected.length">
                                        <x-bi-exclamation-triangle class="h-5 w-5" />
                                        <div>
                                            <h3 class="text-sm font-semibold">Một số tệp đã bị loại bỏ</h3>
                                            <ul class="ml-5 mt-1 list-disc space-y-0.5 text-xs">
                                                <template x-for="r in rejected" :key="r.name + r.reason">
                                                    <li><span x-text="r.name"></span>: <span x-text="r.reason"></span></li>
                                                </template>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Toolbar -->
                            <div class="flex items-center justify-between">
                                <div class="text-xs opacity-70" x-show="files.length">
                                    <span x-text="`${files.length} file(s), ${human(totalBytes)}`"></span>
                                </div>
                                <div class="join" x-show="files.length">
                                    <button class="btn btn-ghost btn-xs join-item" type="button" @click="clearAll()">
                                        <x-bi-x-circle class="mr-1 h-4 w-4" />Rõ ràng tất cả
                                    </button>
                                </div>
                            </div>

                            <!-- File list -->
                            <div class="grid grid-cols-1 gap-3 md:grid-cols-2" x-show="files.length">
                                <template x-for="(f, idx) in files" :key="f._id">
                                    <div class="card bg-base-100 shadow-sm">
                                        <div class="card-body p-4">
                                            <div class="flex items-center gap-3">
                                                <!-- Preview/Icon -->
                                                <template x-if="f._isImage">
                                                    <div class="bg-base-200 grid h-12 w-12 place-content-center rounded">
                                                        <x-bi-file-earmark-image class="h-6 w-6 opacity-80" />
                                                    </div>
                                                    {{-- <div class="avatar">
                                                    </div> --}}
                                                </template>
                                                <template x-if="!f._isImage">
                                                    <div class="bg-base-200 grid h-12 w-12 place-content-center rounded">
                                                        <template x-if="f._ext === 'pdf'">
                                                            <x-bi-file-earmark-pdf class="h-6 w-6 opacity-80" />
                                                        </template>
                                                        <template x-if="['doc','docx'].includes(f._ext)">
                                                            <x-bi-file-earmark-word class="h-6 w-6 opacity-80" />
                                                        </template>
                                                        <template x-if="!['pdf','doc','docx'].includes(f._ext)">
                                                            <x-bi-file-earmark class="h-6 w-6 opacity-80" />
                                                        </template>
                                                    </div>
                                                </template>

                                                <!-- Meta -->
                                                <div class="min-w-0 flex-1">
                                                    <div class="truncate font-medium" x-text="f.name"></div>
                                                    <div class="text-xs opacity-60">
                                                        <span x-text="human(f.size)"></span>
                                                        <span class="mx-1">•</span>
                                                        <span class="uppercase" x-text="f._ext || f.type"></span>
                                                    </div>

                                                    <!-- Warnings -->
                                                    <div class="mt-1">
                                                        <span class="badge badge-error badge-sm" x-show="f._error" x-text="f._error"></span>
                                                    </div>
                                                </div>

                                                <!-- Remove -->
                                                <button class="btn btn-ghost btn-xs" type="button" @click="remove(idx)" :disabled="submitting">
                                                    <x-bi-trash class="h-4 w-4" />
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- Backend validation errors -->
                            @error('medical_files')
                                <div class="text-error mt-1 text-xs">{{ $message }}</div>
                            @enderror
                            @if ($errors->has('medical_files.*'))
                                @foreach ($errors->get('medical_files.*') as $messages)
                                    @foreach ($messages as $msg)
                                        <div class="text-error mt-1 text-xs">{{ $msg }}</div>
                                    @endforeach
                                @endforeach
                            @endif
                            <div class="mt-1 text-xs text-red-700" x-show="maxError" x-text="maxError"></div>
                        </div>

                        <!-- Note -->
                        <div>
                            <label class="label" for="note">
                                <span class="label-text mb-1 ml-2 text-base font-medium">Ghi chú</span>
                            </label>
                            <input id="note" class="input input-bordered w-full" name="note" type="text" value="{{ old('note') }}" placeholder="Nhập" />
                            @error('note')
                                <div class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Footer -->
                        <div class="card-actions mt-8 flex flex-col-reverse items-center gap-3 md:flex-row md:justify-between">
                            <a class="btn btn-outline btn-error rounded-full" onclick="history.back()">
                                <x-bi-arrow-left class="h-4 w-4" />
                                Mặt sau
                            </a>

                            <button class="btn continue-btn" type="submit" style="background-color: #DF1D32; color: #fff;">
                                <x-bi-arrow-right-circle class="mr-2 h-5 w-5" />
                                Tiếp tục
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                                reason: 'Loại file này không được phép'
                            });
                            continue;
                        }
                        if (file.size > MAX_BYTES) {
                            this.rejected.push({
                                name: file.name,
                                reason: `File quá nặng (phải nhỏ hơn ${this.human(MAX_BYTES)})`
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
                },

                handleDrop(e) {
                    this.addFiles(e);
                },

                remove(idx) {
                    this.files.splice(idx, 1);
                    this.syncInput();
                    this.maxError = null;
                },

                clearAll() {
                    this.files = [];
                    this.syncInput();
                    this.maxError = null;
                    this.rejected = [];
                },

                syncInput() {
                    const dt = new DataTransfer();
                    for (const f of this.files) dt.items.add(f.file);
                    this.$refs.input.files = dt.files;
                }
            };
        }
    </script>

    <script>
        // show selected file names
        // const fileInput = document.getElementById('medical_files');
        // const feedback = document.getElementById('file-feedback');
        // fileInput?.addEventListener('change', (e) => {
        //     const files = Array.from(e.target.files || []).map(f => f.name);
        //     if (files.length) {
        //         feedback.textContent = `Selected files: ${files.join(', ')}`;
        //         feedback.classList.remove('hidden');
        //     } else {
        //         feedback.classList.add('hidden');
        //     }
        // });

        // click label opens file input (for keyboard users it already works via 'for' attribute)
        // document.querySelector('label[for="medical_files"]')?.addEventListener('click', (e) => {
        //     e.preventDefault();
        //     fileInput.click();
        // });

        // minimal validation + submit state
        document.getElementById('medicalForm')?.addEventListener('submit', (e) => {
            const problem = document.getElementById('medical_problem').value.trim();
            if (!problem) {
                e.preventDefault();
                alert('Please describe your medical problem');
                return;
            }
            const btn = document.querySelector('.continue-btn');
            btn.disabled = true;
            btn.classList.add('btn-disabled');
            btn.innerText = 'Đang xử lý...';
        });

        // auto-resize textarea
        const ta = document.getElementById('medical_problem');
        const autoresize = () => {
            ta.style.height = 'auto';
            ta.style.height = Math.max(208, ta.scrollHeight) + 'px';
        };
        ta?.addEventListener('input', autoresize);
        window.addEventListener('load', autoresize);
    </script>
@endpush
