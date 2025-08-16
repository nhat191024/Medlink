@extends('layouts.app')

@section('content')
    <div class="mx-auto min-h-[95vh] max-w-6xl px-4 py-6 md:py-10">
        <!-- Progress Steps -->
        <div class="mb-10 flex justify-center">
            <div class="flex items-center space-x-4 md:space-x-8">
                <div class="flex items-center">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#DF1D32] text-white shadow-lg">
                        <span class="text-sm font-semibold">1</span>
                    </div>
                    <span class="ml-3 text-sm font-medium text-[#DF1D32]">Chọn dịch vụ</span>
                </div>
                <div class="h-0.5 w-16 bg-gray-300 md:w-24"></div>
                <div class="flex items-center">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-200 text-gray-500">
                        <span class="text-sm font-semibold">2</span>
                    </div>
                    <span class="ml-3 text-sm font-medium text-gray-500">Điền thông tin</span>
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
                <h1 class="text-3xl font-bold text-white md:text-4xl">Đặt lịch hẹn</h1>

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
                <form id="bookingForm" method="POST" action="{{ route('appointment.step.one.store') }}">
                    @csrf
                    <!-- Services Section -->
                    <div class="mb-10">
                        <div class="mb-6 flex items-center">
                            <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-full bg-[#DF1D32] text-white">
                                <x-bi-gear class="h-4 w-4" />
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Chọn dịch vụ</h2>
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($doctorProfile->services as $service)
                                <label
                                    class="group relative cursor-pointer overflow-hidden rounded-2xl border-2 border-gray-200 bg-white p-6 transition-all duration-300 hover:-translate-y-1 hover:border-[#DF1D32] hover:shadow-lg has-[input:checked]:border-[#DF1D32] has-[input:checked]:bg-gradient-to-br has-[input:checked]:from-[#DF1D32] has-[input:checked]:to-[#B91C3C] has-[input:checked]:shadow-xl">

                                    <input class="peer sr-only" name="service" data-price="{{ $service->price }}" type="radio" value="{{ $service->id }}" {{ $loop->first ? 'checked' : '' }} />

                                    <!-- Selection indicator -->
                                    <div class="absolute right-4 top-4 h-5 w-5 rounded-full border-2 border-gray-300 bg-white transition-all group-has-[input:checked]:border-white group-has-[input:checked]:bg-white">
                                        <div class="absolute inset-1 rounded-full bg-[#DF1D32] opacity-0 transition-opacity group-has-[input:checked]:opacity-100"></div>
                                    </div>

                                    <!-- Icon bubble -->
                                    <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-[#DF1D32]/10 text-[#DF1D32] transition-all group-has-[input:checked]:bg-white/20 group-has-[input:checked]:text-white">
                                        <x-bi-camera-video class="h-6 w-6" />
                                    </div>

                                    <!-- Title -->
                                    <div class="mb-2 text-lg font-bold leading-tight text-gray-900 group-has-[input:checked]:text-white">
                                        {{ $service->name }}
                                    </div>

                                    <!-- Description -->
                                    @if ($service->description)
                                        <p class="mb-4 text-sm text-gray-600 group-has-[input:checked]:text-white/90">
                                            {{ $service->description }}
                                        </p>
                                    @endif

                                    <!-- Price -->
                                    <div class="flex items-center justify-between">
                                        <div class="text-xl font-bold text-[#DF1D32] group-has-[input:checked]:text-white">
                                            {{ number_format($service->price) }}đ
                                        </div>
                                        <div class="text-sm text-gray-500 group-has-[input:checked]:text-white/80">
                                            ~{{ round($service->price / 1000) }}k
                                        </div>
                                    </div>

                                    <!-- Hover effect overlay -->
                                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-[#DF1D32]/5 to-[#B91C3C]/5 opacity-0 transition-opacity group-hover:opacity-100 group-has-[input:checked]:opacity-0"></div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Available time --}}
                    <div class="mb-10">
                        <div class="mb-6 flex items-center">
                            <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-full bg-[#DF1D32] text-white">
                                <x-bi-clock class="h-4 w-4" />
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Chọn thời gian</h2>
                        </div>

                        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-gradient-to-br from-gray-50 to-white shadow-lg">
                            <div class="p-6 md:p-8">
                                {{-- Calendar header with Prev/Next --}}
                                <div class="mb-6 flex items-center justify-between">
                                    <div id="monthYear" class="text-xl font-bold text-gray-900"></div>
                                    <div class="flex gap-3">
                                        <button id="prevMonth" class="flex items-center gap-2 rounded-xl bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-md transition-all hover:bg-gray-50 hover:shadow-lg" type="button">
                                            <x-bi-chevron-left class="h-4 w-4" />
                                            Trước
                                        </button>
                                        <button id="nextMonth" class="flex items-center gap-2 rounded-xl bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-md transition-all hover:bg-gray-50 hover:shadow-lg" type="button">
                                            Sau
                                            <x-bi-chevron-right class="h-4 w-4" />
                                        </button>
                                    </div>
                                </div>

                                {{-- Days row like the mock (labels + red underline on active) --}}
                                <div class="mb-6 border-b border-gray-200 pb-4">
                                    <div id="calendarDays" class="grid grid-cols-7 gap-3"></div>
                                </div>

                                {{-- Time slots header --}}
                                <div class="mb-4 flex items-center">
                                    <x-bi-clock class="mr-2 h-5 w-5 text-[#DF1D32]" />
                                    <span class="text-lg font-semibold text-gray-900">Thời gian khả dụng</span>
                                </div>

                                {{-- Time pills --}}
                                <div id="timeSlots" class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6"></div>

                                <div id="noSlotsMessage" class="mt-6 hidden">
                                    <div class="flex items-center rounded-xl border border-amber-200 bg-amber-50 p-4">
                                        <x-bi-info-circle class="mr-3 h-5 w-5 text-amber-500" />
                                        <span class="text-amber-800">Không có thời gian có sẵn cho ngày này.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="flex flex-col gap-6 rounded-2xl border border-gray-200 bg-gradient-to-r from-gray-50 to-white p-6 md:flex-row md:items-center md:justify-between">
                        <div class="flex items-center">
                            <div class="mr-4 flex h-12 w-12 items-center justify-center rounded-xl bg-[#DF1D32] text-white">
                                <x-bi-currency-dollar class="h-6 w-6" />
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Tổng chi phí</div>
                                <div id="totalPrice" class="text-2xl font-bold text-[#DF1D32]">
                                    {{ number_format(optional($doctorProfile->services->first())->price) }}đ
                                </div>
                            </div>
                        </div>

                        <button class="group flex items-center justify-center gap-3 rounded-xl bg-gradient-to-r from-[#DF1D32] to-[#B91C3C] px-8 py-4 text-white shadow-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-[#DF1D32]/25" type="submit">
                            <span class="font-semibold">Tiếp tục đặt lịch</span>
                            <x-bi-arrow-right-circle class="h-5 w-5 transition-transform group-hover:translate-x-1" />
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('style')
    <style>
        /* Custom animations and transitions */
        .day-item:hover .day-container {
            transform: translateY(-2px);
        }

        .time-slot:hover:not(:disabled) {
            transform: translateY(-2px);
        }

        .service-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .service-card:hover {
            transform: translateY(-4px);
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-in-up {
            animation: slideInUp 0.6s ease-out;
        }

        /* Ripple effect */
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        .ripple {
            animation: ripple 0.6s linear;
        }

        /* Gradient text effect */
        .gradient-text {
            background: linear-gradient(135deg, #DF1D32, #B91C3C);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Smooth focus ring */
        .focus-ring:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(223, 29, 50, 0.1);
        }
    </style>
@endpush

@push('scripts')
    <script>
        const workSchedules = @json($workSchedules);
        let currentDate = new Date();
        let selectedDateOffset = 0;

        function markDaySelected(btn, selected) {
            const name = btn.querySelector('.day-name');
            const num = btn.querySelector('.day-num');
            const underline = btn.querySelector('.day-underline');
            const container = btn.querySelector('.day-container');

            if (selected) {
                name.classList.add('text-white');
                num.classList.add('text-white');
                underline.classList.add('bg-[#DF1D32]');
                container.classList.add('bg-[#DF1D32]', 'shadow-lg', 'scale-105');
                container.classList.remove('bg-white', 'hover:bg-gray-50');
            } else {
                name.classList.remove('text-white');
                num.classList.remove('text-white');
                underline.classList.remove('bg-[#DF1D32]');
                container.classList.remove('bg-[#DF1D32]', 'shadow-lg', 'scale-105');
                container.classList.add('bg-white', 'hover:bg-gray-50');
            }
        }

        function markTimeSelected(btn, selected) {
            if (selected) {
                btn.classList.remove('bg-white', 'text-gray-700', 'border-gray-200', 'hover:bg-gray-50');
                btn.classList.add('bg-gradient-to-r', 'from-[#DF1D32]', 'to-[#B91C3C]', 'text-white', 'shadow-lg', 'scale-105', 'border-[#DF1D32]');
                btn.dataset.selected = '1';
            } else {
                btn.classList.add('bg-white', 'text-gray-700', 'border-gray-200', 'hover:bg-gray-50');
                btn.classList.remove('bg-gradient-to-r', 'from-[#DF1D32]', 'to-[#B91C3C]', 'text-white', 'shadow-lg', 'scale-105', 'border-[#DF1D32]');
                delete btn.dataset.selected;
            }
        }

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

            // generate 7 days
            for (let i = 0; i < 7; i++) {
                const date = new Date(currentDate);
                date.setDate(date.getDate() + selectedDateOffset + i);

                const isAvailable = isDayAvailable(date);
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'day-item flex flex-col items-center transition-all duration-300';
                if (!isAvailable) btn.classList.add('opacity-40', 'pointer-events-none');

                btn.innerHTML = `
                    <input type="radio" name="date" class="hidden day-radio">
                    <div class="day-container w-full rounded-xl border-2 border-gray-200 bg-white p-3 transition-all duration-300 hover:bg-gray-50 hover:shadow-md">
                        <span class="day-name block text-xs font-medium text-gray-500 mb-1">${dayNames[date.getDay()]}</span>
                        <span class="day-num block text-lg font-bold text-gray-900">${date.getDate().toString().padStart(2, '0')}</span>
                        <span class="day-underline block h-1 w-6 mx-auto mt-2 rounded bg-transparent transition-all duration-300"></span>
                    </div>
                `;

                const yyyy = date.getFullYear();
                const mm = String(date.getMonth() + 1).padStart(2, '0');
                const dd = String(date.getDate()).padStart(2, '0');
                const isoLocal = `${yyyy}-${mm}-${dd}`;
                btn.querySelector('.day-radio').value = isoLocal;

                // default select first available
                if (isAvailable && firstAvailableDay === -1) {
                    firstAvailableDay = i;
                    markDaySelected(btn, true);
                    btn.querySelector('.day-radio').checked = true;
                }

                if (isAvailable) {
                    btn.addEventListener('click', function() {
                        document.querySelectorAll('#calendarDays .day-item').forEach(d => markDaySelected(d, false));
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


        // Time slot selection
        document.querySelectorAll('.time-slot').forEach(slot => {
            slot.addEventListener('click', function() {
                document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('.time-radio').checked = true;
            });
        });

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
                const secondary = isFull ? '<div class="text-xs opacity-90 mt-1">Đã đầy</div>' : '';
                btn.innerHTML = `
                    <input type="radio" name="time" value="${timeValue}" class="hidden time-radio" ${isAvailable ? '' : 'disabled'}>
                    <div class="text-center">
                        <div class="font-semibold">${timeDisplay}</div>
                        ${secondary}
                    </div>
                `;

                if (isAvailable) {
                    btn.classList.add('bg-white', 'text-gray-700', 'border-gray-200', 'hover:bg-gray-50', 'hover:border-[#DF1D32]', 'hover:shadow-md');
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

        document.addEventListener('DOMContentLoaded', () => {
            initCalendar();
            const form = document.getElementById('bookingForm');
            const totalEl = document.getElementById('totalPrice');
            const radios = [...document.querySelectorAll('input[name="service"]')];

            function updateTotalFrom(radio) {
                if (!radio || !totalEl) return;
                const price = Number(radio.dataset.price || 0);
                totalEl.innerHTML = `
                    <span class="text-2xl font-bold text-[#DF1D32]">${price.toLocaleString('vi-VN')}đ</span>
                `;
            }

            // Add smooth transitions and animations
            function addServiceSelectionEffects() {
                radios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        updateTotalFrom(this);

                        // Add ripple effect
                        const label = this.closest('label');
                        const ripple = document.createElement('div');
                        ripple.className = 'absolute inset-0 rounded-2xl bg-white/20 scale-0 animate-ping';
                        label.appendChild(ripple);

                        setTimeout(() => ripple.remove(), 600);
                    });
                });
            }

            // Initialize effects
            addServiceSelectionEffects();

            // Init default selection & price
            const checked = radios.find(r => r.checked) || radios[0];
            if (checked && !checked.checked) checked.checked = true;
            updateTotalFrom(checked);

            // Enhanced form submission with loading state
            form?.addEventListener('submit', (e) => {
                const submitBtn = form.querySelector('button[type="submit"]');
                const fd = new FormData(form);
                const selectedService = fd.get('service');
                const selectedDate = fd.get('date');
                const selectedTime = fd.get('time');

                if (!(selectedService && selectedDate && selectedTime)) {
                    e.preventDefault();

                    // Show error message with animation
                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg transform translate-x-full transition-transform duration-300 z-50';
                    errorMsg.textContent = 'Vui lòng chọn đầy đủ dịch vụ, ngày và giờ';
                    document.body.appendChild(errorMsg);

                    setTimeout(() => errorMsg.classList.remove('translate-x-full'), 100);
                    setTimeout(() => {
                        errorMsg.classList.add('translate-x-full');
                        setTimeout(() => errorMsg.remove(), 300);
                    }, 3000);

                    return;
                }

                // Add loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <div class="flex items-center gap-3">
                        <div class="h-5 w-5 animate-spin rounded-full border-2 border-white/30 border-t-white"></div>
                        <span>Đang xử lý...</span>
                    </div>
                `;

                console.log('Booking Data:', {
                    service: selectedService,
                    date: selectedDate,
                    time: selectedTime
                });
            });
        });
    </script>
@endpush
