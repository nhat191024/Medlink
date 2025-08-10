@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-4 md:p-8">
        <div class="rounded-2xl shadow-sm bg-base-200/70 p-6 md:p-10">
            {{-- Profile --}}
            <div class="flex flex-col items-center text-center gap-3 mb-6">
                <div class="avatar">
                    <div class="w-24 rounded-full ring ring-base-100 ring-offset-2">
                        <img src="{{ asset($doctorProfile->user->avatar) }}" alt="{{ $doctorProfile->user->name }}">
                    </div>
                </div>

                <h1 class="text-xl font-bold">{{ $doctorProfile->user->name }}</h1>
                <p class="text-base-content/60">{{ $doctorProfile->medicalCategory->name }}</p>
                @if ($doctorProfile->introduce)
                    <p class="text-base-content/80 max-w-2xl">{{ $doctorProfile->introduce }}</p>
                @endif
            </div>

            {{-- Info row --}}
            @php
                $rate = $doctorProfile->reviews->avg('rate');
                $count = $doctorProfile->reviews->count('rate');
                $roundedRate = round($rate * 2) / 2;
                $isAvailable = \App\Models\WorkSchedule::isAvailable($doctorProfile->id) == 1;
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-4">
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body p-4 items-center text-center">
                        <span class="text-sm text-base-content/70">Location</span>
                        <div class="inline-flex items-center gap-2 text-base font-medium">
                            <x-bi-geo-alt class="w-4 h-4 opacity-60" />
                            {{ $doctorProfile->user->country }}
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body p-4 items-center text-center">
                        <span class="text-sm text-base-content/70">Rating</span>
                        <div class="inline-flex items-center gap-2 text-base font-medium">
                            <x-bi-star-fill class="w-4 h-4 text-warning" />
                            {{ $rate > 0 ? number_format($roundedRate, 1) : 'Not rated' }}
                            <span class="text-base-content/60">({{ $count }})</span>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body p-4 items-center text-center">
                        <span class="text-sm text-base-content/70">Schedule</span>
                        <div>
                            @if ($isAvailable)
                                <span class="badge badge-success badge-lg">Available</span>
                            @else
                                <span class="badge badge-warning badge-lg">Not available</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Languages --}}
            @if ($doctorProfile->user->languages->count())
                <div class="bg-base-100 rounded-2xl p-4 flex flex-wrap items-center gap-3 mb-8">
                    @foreach ($doctorProfile->user->languages as $item)
                        <span class="inline-flex items-center gap-2 px-3 py-2 rounded-full bg-base-200">
                            <img src="https://flagcdn.com/{{ $item->language->code }}.svg" class="w-6 h-6 rounded-full object-cover"
                                alt="{{ $item->language->name }}">
                            <span class="text-sm font-medium">{{ $item->language->name }}</span>
                        </span>
                    @endforeach
                </div>
            @endif

            {{-- Services --}}
            <h2 class="text-lg font-semibold mb-4">Services</h2>
            <div class="card bg-base-100 shadow-sm mb-8">
                <div class="card-body p-4 md:p-6">
                    <div class="flex flex-col divide-y divide-base-200">
                        @forelse ($doctorProfile->services as $item)
                            @if (!$item->is_active)
                                @continue
                            @endif
                            <div class="py-4 flex flex-col sm:flex-row sm:items-center gap-3">
                                <div
                                    class="flex items-center justify-center w-12 h-12 rounded-full bg-error/10 text-error shrink-0">
                                    <x-bi-hospital class="w-6 h-6" />
                                </div>

                                <div class="flex-1">
                                    <div class="font-medium">{{ $item->name }}</div>
                                    @if ($item->description)
                                        <div class="text-sm text-base-content/60">{{ $item->description }}</div>
                                    @endif
                                </div>

                                <div class="text-right sm:ml-3">
                                    <div class="font-semibold whitespace-nowrap">
                                        {{ number_format($item->price, 0, ',', '.') }}đ
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="py-6 flex items-center gap-3">
                                <div
                                    class="flex items-center justify-center w-12 h-12 rounded-full bg-base-200 text-base-content/60">
                                    <x-bi-journal-medical class="w-6 h-6" />
                                </div>
                                <div class="font-medium">Không dịch vụ</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Available time --}}
            <h2 class="text-lg font-semibold mb-3">Available time</h2>
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


            {{-- Testimonials header --}}
            <div class="flex items-start justify-between mb-4">
                <h2 class="text-lg font-semibold m-0">Testimonials</h2>
                <a href="#" class="link link-hover text-sm">View all reviews.</a>
            </div>

            {{-- Ratings summary (example static like yours) --}}
            <div class="space-y-2 mb-6">
                <div class="grid grid-cols-[80px_1fr_32px] items-center gap-3">
                    <span class="text-warning">★★★★★</span>
                    <progress class="progress w-full" value="90" max="100"></progress>
                    <span class="text-right text-sm">20</span>
                </div>
                <div class="grid grid-cols-[80px_1fr_32px] items-center gap-3">
                    <span class="text-warning">★★★★</span>
                    <progress class="progress w-full" value="65" max="100"></progress>
                    <span class="text-right text-sm">5</span>
                </div>
                <div class="grid grid-cols-[80px_1fr_32px] items-center gap-3">
                    <span class="text-warning">★★★</span>
                    <progress class="progress w-full" value="35" max="100"></progress>
                    <span class="text-right text-sm">1</span>
                </div>
                <div class="grid grid-cols-[80px_1fr_32px] items-center gap-3">
                    <span class="text-warning">★★</span>
                    <progress class="progress w-full" value="18" max="100"></progress>
                    <span class="text-right text-sm">1</span>
                </div>
            </div>

            {{-- One testimonial (like your sample) --}}
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body p-5">
                    <div class="flex gap-4">
                        <div class="avatar">
                            <div class="w-14 rounded-full">
                                <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Sophie">
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold">Sophie</span>
                                <span class="text-xs text-base-content/60">2 days ago</span>
                            </div>
                            <p class="text-base">
                                Dr. Esther Howard was incredibly kind and professional. The consultation was clear and
                                comforting.
                                I felt truly cared for. Highly recommended!
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CTA --}}
            <div class="text-center mt-[50px] mb-[18px]">
                <button
                    onclick="location.href='{{ route('appointment.step.one', ['doctor_profile_id' => $doctorProfile->id]) }}'"
                    class="doctor-book-btn block mx-auto rounded-[32px] bg-[#e53935] text-white border-none px-[48px] py-[16px] text-[1.15em] font-semibold text-center transition-colors duration-200 hover:bg-[#c62828] focus:outline-none focus:ring-2 focus:ring-[#e53935]">
                    Book appointment
                </button>
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
        document.addEventListener('DOMContentLoaded', function () {
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
                    btn.addEventListener('click', function () {
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

        document.getElementById('prevMonth').addEventListener('click', function () {
            selectedDateOffset -= 7;
            updateCalendar();
        });
        document.getElementById('nextMonth').addEventListener('click', function () {
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
                    btn.addEventListener('click', function () {
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
            return `${hours.padStart(2, '0')}:${minutes}`;
        }

        function formatTimeForDisplay(timeStr) {
            const [time, period] = timeStr.split(' ');
            return `${time}<br><span class="text-xs opacity-70">${period}</span>`;
        }
    </script>
@endpush