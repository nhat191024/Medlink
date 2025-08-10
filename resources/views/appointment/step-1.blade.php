@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-5xl px-4 my-3 md:py-8">
        <!-- Progress Steps -->
        <div class="mb-8 flex justify-center">
            <ul class="steps steps-horizontal">
                <li class="step step-error">
                    <span class="text-xs">Chọn dịch vụ</span>
                </li>
                <li class="step">
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
                <h1 class="card-title text-2xl font-bold">Book appointment</h1>

                <!-- Doctor Info -->
                <div class="mt-4 flex items-center gap-6">
                    <div class="avatar">
                        <div class="w-26 rounded-full ring ring-error ring-offset-base-100 ring-offset-2">
                            <img src="/{{ $doctorProfile->user->avatar }}?height=80&width=80"
                                alt="{{ $doctorProfile->user->name }}"
                                onerror="this.onerror=null;this.src='{{ asset('storage/upload/avatar/default.png') }}';">
                        </div>
                    </div>
                    <div class="text-xl">{{ $doctorProfile->user->name }}</div>
                </div>

                <div class="card bg-[#F6F6F6] px-5 pb-3 pt-0 md:px-10 md:py-10 shadow-lg">
                    <!-- Booking Form -->
                    <form id="bookingForm" method="POST" action="{{ route('appointment.step.one.store') }}" class="mt-6">
                        @csrf
                        <!-- Services Section -->
                        <div class="mb-8">
                            <h2 class="mb-4 text-xl">Choose services</h2>

                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                @foreach ($doctorProfile->services as $service)
                                    <label
                                        class="group relative cursor-pointer rounded-3xl border border-base-200 bg-base-100
                                            p-4 sm:p-6 transition hover:shadow-md
                                            has-[input:checked]:border-error has-[input:checked]:bg-[#DF1D32] has-[input:checked]:text-error-content">

                                        <input type="radio" name="service" value="{{ $service->id }}"
                                            class="peer sr-only" data-price="{{ $service->price }}"
                                            {{ $loop->first ? 'checked' : '' }} />

                                        <!-- Icon bubble -->
                                        <div
                                            class="mb-3 sm:mb-4 inline-flex h-8 w-8 sm:h-10 sm:w-10 items-center justify-center rounded-full
                                                bg-error/10 text-error
                                                group-has-[input:checked]:bg-white group-has-[input:checked]:text-error">
                                            <x-bi-camera-video class="h-4 w-4 sm:h-5 sm:w-5 font-bold"
                                                style="stroke-width:2; color:#DF1D32;" />
                                        </div>

                                        <!-- Title -->
                                        <div class="text-base sm:text-lg font-semibold leading-5 sm:leading-6
                                                    text-black group-has-[input:checked]:text-white">
                                            {{ $service->name }}
                                        </div>

                                        <!-- Description -->
                                        @if ($service->description)
                                            <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-black/60 group-has-[input:checked]:text-white">
                                                {{ $service->description }}
                                            </p>
                                        @endif

                                        <!-- Price -->
                                        <div class="mt-3 sm:mt-4 text-sm sm:text-base font-semibold
                                                    text-black group-has-[input:checked]:text-white">
                                            {{ number_format($service->price) }}đ
                                        </div>

                                        <!-- Focus ring for keyboard users -->
                                        <span class="pointer-events-none absolute inset-0 rounded-3xl ring-2 ring-transparent
                                                    peer-focus-visible:ring-error/60"></span>
                                    </label>
                                @endforeach
                            </div>
                        </div>



                        {{-- Available time --}}
                        <h2 class="text-xl mb-3">Available time</h2>
                        <div class="bg-base-100 rounded-2xl p-4 md:p-6 mb-8">
                            {{-- Calendar header with Prev/Next --}}
                            <div class="mb-3 flex items-center justify-between">
                                <div id="monthYear" class="text-lg font-semibold"></div>
                                <div class="flex gap-2">
                                    <button type="button" id="prevMonth" class="btn btn-sm btn-ghost">
                                        <x-bi-chevron-left class="w-4 h-4" />
                                        Prev
                                    </button>
                                    <button type="button" id="nextMonth" class="btn btn-sm btn-ghost">
                                        Next
                                        <x-bi-chevron-right class="w-4 h-4" />
                                    </button>
                                </div>
                            </div>

                            {{-- Days row like the mock (labels + red underline on active) --}}
                            <div class="mb-4 border-b border-base-200 pb-2">
                                <div id="calendarDays" class="grid grid-cols-7 gap-2 items-end"></div>
                            </div>

                            {{-- Time pills --}}
                            <div id="timeSlots" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3"></div>

                            <div id="noSlotsMessage" class="hidden mt-4">
                                <div class="alert">
                                    <x-bi-info-circle class="w-5 h-5" />
                                    <span>No available time slots for this date.</span>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="mt-6 flex items-center justify-between gap-4">
                            <div class="text-sm opacity-70">
                                <span>Total:</span>
                                <span class="font-semibold" id="totalPrice">
                                    {{-- If you want it to show first service price by default: --}}
                                    {{ number_format(optional($doctorProfile->services->first())->price) }}đ
                                </span>
                            </div>

                            <button type="submit" class="btn" style="background-color: #DF1D32; color: #fff;">
                                <x-bi-arrow-right-circle class="mr-2 h-5 w-5" />
                                Continue
                            </button>
                        </div>
                    </form>
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
            btn.className = 'day-item flex flex-col items-center gap-1 text-xs transition';
            if (!isAvailable) btn.classList.add('opacity-40', 'pointer-events-none');

            btn.innerHTML = `
                <input type="radio" name="date" class="hidden day-radio">
                <span class="day-name text-[11px] text-base-content/60 font-medium">${dayNames[date.getDay()]}</span>
                <span class="day-num text-sm font-semibold">${date.getDate().toString().padStart(2,'0')}</span>
                <span class="day-underline block h-0.5 w-8 rounded bg-transparent"></span>
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
                btn.addEventListener('click', function () {
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
                    'time-slot', 'btn', 'btn-sm', 'rounded-2xl', 'px-5', 'py-3', 'leading-tight',
                    'border-2', 'min-w-[96px]', 'justify-center', 'text-center'
                ].join(' ');

                // Base label: time on first line; second line small note if "full"
                const secondary = isFull ? '<br><span class="text-xs opacity-90">Full</span>' : '';
                btn.innerHTML = `
            <input type="radio" name="time" value="${timeValue}" class="hidden time-radio" ${isAvailable ? '' : 'disabled'}>
            <span class="inline-block">${timeValue}${secondary}</span>
            `;

                if (isAvailable) {
                    btn.classList.add('btn-outline', 'border-base-300', 'text-base-content');
                    btn.addEventListener('click', function() {
                        document.querySelectorAll('#timeSlots .time-slot').forEach(s => markTimeSelected(s,
                            false));
                        markTimeSelected(this, true);
                        this.querySelector('.time-radio').checked = true;
                    });
                    if (!firstSelectableBtn) firstSelectableBtn = btn;
                } else if (isFull) {
                    // solid red pill, not selectable
                    btn.classList.add('bg-danger', 'text-error-content', 'border-error', 'cursor-not-allowed');
                    btn.disabled = true;
                } else {
                    // disabled grey outline
                    btn.classList.add('btn-outline', 'border-base-300', 'opacity-40', 'cursor-not-allowed');
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
            return `${hours.padStart(2,'0')}:${minutes}`;
        }

        function formatTimeForDisplay(timeStr) {
            const [time, period] = timeStr.split(' ');
            return `${time}<br><span class="text-xs opacity-70">${period}</span>`;
        }

        document.addEventListener('DOMContentLoaded', () => {
            initCalendar();
            const form = document.getElementById('bookingForm');
            const totalEl = document.getElementById('totalPrice') || document.querySelector('.total-price');
            const radios = [...document.querySelectorAll('input[name="service"]')];

            function updateTotalFrom(radio) {
                if (!radio || !totalEl) return;
                const price = Number(radio.dataset.price || 0);
                totalEl.textContent = price.toLocaleString('vi-VN') + 'đ';
            }

            // Update when a service is selected
            radios.forEach(radio => {
                radio.addEventListener('change', () => updateTotalFrom(radio));
            });

            // Init default selection & price
            const checked = radios.find(r => r.checked) || radios[0];
            if (checked && !checked.checked) checked.checked = true;
            updateTotalFrom(checked);

            // Form submission (keep your validation)
            form?.addEventListener('submit', (e) => {
                // e.preventDefault(); // <- leave commented if you want normal submit
                const fd = new FormData(form);
                const selectedService = fd.get('service');
                const selectedDate = fd.get('date');
                const selectedTime = fd.get('time');

                if (!(selectedService && selectedDate && selectedTime)) {
                    e.preventDefault();
                    alert('Please select service, date and time');
                    return;
                }

                console.log('Booking Data:', {
                    service: selectedService,
                    date: selectedDate,
                    time: selectedTime
                });
            });
        });
    </script>
@endpush
