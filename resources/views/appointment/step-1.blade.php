@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/appointment/step-1.css') }}?v=1.1" rel="stylesheet">
    <link href="{{ asset('css/appointment/time-selector.css') }}?v=1.1" rel="stylesheet">
@endpush

@section('content')
    <div class="booking-container">
        <!-- Progress Steps -->
        <div class="progress-steps">
            <div class="step active">
                <div class="step-number">1</div>
                <div class="step-label">Chọn dịch vụ</div>
            </div>
            <div class="step-connector"></div>
            <div class="step">
                <div class="step-number">2</div>
                <div class="step-label">Điền thông tin</div>
            </div>
            <div class="step-connector"></div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-label">Thanh toán & xác nhận</div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="booking-content">
            <h1 class="booking-title">Book appointment</h1>

            <!-- Doctor Info -->
            <div class="doctor-info">
                <img src="/{{ $doctorProfile->user->avatar }}?height=80&width=80" alt="{{ $doctorProfile->user->name }}"
                    onerror="this.onerror=null;this.src='{{ asset('storage/upload/avatar/default.png') }}';"
                    class="doctor-avatar">
                <div class="doctor-name">{{ $doctorProfile->user->name }}</div>
            </div>

            <!-- Booking Form -->
            <form id="bookingForm" method="POST" action="{{ route('appointment.step.one.store') }}">
                @csrf

                <!-- Services Section -->
                <div class="services-section">
                    <h2 class="section-title">Choose services</h2>
                    <div class="services-grid">
                        @foreach ($doctorProfile->services as $service)
                            <div class="service-card {{ $loop->first ? 'first-service' : '' }} {{ $loop->first ? 'selected' : '' }}"
                                data-price="{{ $service->price }}">
                                <input type="radio" name="service" value="{{ $service->id }}" class="service-radio"
                                    data-price="{{ $service->price }}" {{ $loop->first ? 'checked' : '' }}>
                                <div class="service-icon">🏥</div>
                                <div class="service-name">{{ $service->name }}</div>
                                <div class="service-description">{{ $service->description }}</div>
                                <div class="service-price">{{ number_format($service->price) }}đ</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Time Section -->
                <div class="time-section">
                    <h2 class="section-title">Choose time</h2>

                    <div class="calendar-header">
                        <div class="month-year" id="monthYear"></div>
                        <div class="nav-buttons">
                            <button type="button" class="nav-btn" id="prevMonth">‹</button>
                            <button type="button" class="nav-btn" id="nextMonth">›</button>
                        </div>
                    </div>

                    <div class="calendar-days" id="calendarDays">
                        <!-- Days will be generated here -->
                    </div>

                    <div class="time-slots" id="timeSlots">
                        <!-- Time slots will be generated here -->
                    </div>

                    <div class="no-slots-message" id="noSlotsMessage" style="display: none;">
                        No available time slots for this date.
                    </div>
                </div>

                <!-- Footer -->
                <div class="booking-footer">
                    <button type="submit" class="continue-btn">Continue</button>
                    <div class="total-price"></div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const workSchedules = @json($workSchedules);
        let currentDate = new Date();
        let selectedDateOffset = 0; // Days from today

        // Initialize calendar
        function initCalendar() {
            updateCalendar();
        }

        function updateCalendar() {
            const monthNames = [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
            ];

            const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

            // Update month/year display
            const displayDate = new Date(currentDate);
            displayDate.setDate(displayDate.getDate() + selectedDateOffset);
            document.getElementById('monthYear').textContent =
                `${monthNames[displayDate.getMonth()]}, ${displayDate.getFullYear()}`;

            // Generate 7 days starting from current date + offset
            const calendarDays = document.getElementById('calendarDays');
            calendarDays.innerHTML = '';

            let firstAvailableDay = -1;

            for (let i = 0; i < 7; i++) {
                const date = new Date(currentDate);
                date.setDate(date.getDate() + selectedDateOffset + i);

                const dayItem = document.createElement('div');
                const isAvailable = isDayAvailable(date);

                dayItem.className = 'day-item';
                if (!isAvailable) {
                    dayItem.classList.add('unavailable');
                }

                // Set first available day as selected
                if (isAvailable && firstAvailableDay === -1) {
                    firstAvailableDay = i;
                    dayItem.classList.add('selected');
                }

                const formatLocalDate = (date) => {
                    const year = date.getFullYear();
                    const month = (date.getMonth() + 1).toString().padStart(2, '0');
                    const day = date.getDate().toString().padStart(2, '0');
                    return `${year}-${month}-${day}`;
                };

                dayItem.innerHTML = `
                    <input type="radio" name="date" value="${formatLocalDate(date)}" class="day-radio" ${firstAvailableDay === i ? 'checked' : ''}>
                    <div class="day-name">${dayNames[date.getDay()]}</div>
                    <div class="day-number">${date.getDate().toString().padStart(2, '0')}</div>
                `;

                if (isAvailable) {
                    dayItem.addEventListener('click', function() {
                        document.querySelectorAll('.day-item').forEach(d => d.classList.remove('selected'));
                        this.classList.add('selected');
                        this.querySelector('.day-radio').checked = true;
                        updateTimeSlots(date);
                    });
                }

                calendarDays.appendChild(dayItem);
            }

            // Update time slots for the first available day
            if (firstAvailableDay !== -1) {
                const firstDate = new Date(currentDate);
                firstDate.setDate(firstDate.getDate() + selectedDateOffset + firstAvailableDay);
                updateTimeSlots(firstDate);
            } else {
                updateTimeSlots(null);
            }
        }

        // Service selection
        document.querySelectorAll('.service-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('.service-card').forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');

                // Check the radio button
                this.querySelector('.service-radio').checked = true;

                // Update price with formatting
                const price = this.getAttribute('data-price');
                document.querySelector('.total-price').textContent = Number(price).toLocaleString('vi-VN') + 'đ';
            });
        });

        // Time slot selection
        document.querySelectorAll('.time-slot').forEach(slot => {
            slot.addEventListener('click', function() {
                document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('.time-radio').checked = true;
            });
        });

        // Month navigation
        document.getElementById('prevMonth').addEventListener('click', function() {
            selectedDateOffset -= 7; // Go back 7 days
            updateCalendar();
        });

        document.getElementById('nextMonth').addEventListener('click', function() {
            selectedDateOffset += 7; // Go forward 7 days
            updateCalendar();
        });

        // Form submission
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const selectedService = formData.get('service');
            const selectedDate = formData.get('date');
            const selectedTime = formData.get('time');

            if (selectedService && selectedDate && selectedTime) {
                console.log('Booking Data:', {
                    service: selectedService,
                    date: selectedDate,
                    time: selectedTime
                });

                // You can submit the form or make an AJAX request here
                // alert(`Booking: ${selectedService} on ${selectedDate} at ${selectedTime}`);
                this.submit(); // Uncomment to actually submit the form
            } else {
                alert('Please select service, date and time');
            }
        });

        function isDayAvailable(date) {
            const monthNames = [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
            ];

            const monthKey = monthNames[date.getMonth()];
            const dayKey = date.getDate().toString().padStart(2, '0');

            if (!workSchedules[monthKey] || !workSchedules[monthKey][dayKey]) {
                return false;
            }

            const daySchedule = workSchedules[monthKey][dayKey];

            // Check if day has available slots
            return daySchedule.some(slot => slot.is_available && slot.time !== null);
        }

        function updateTimeSlots(selectedDate) {
            const timeSlotsContainer = document.getElementById('timeSlots');
            const noSlotsMessage = document.getElementById('noSlotsMessage');

            timeSlotsContainer.innerHTML = '';

            if (!selectedDate) {
                noSlotsMessage.style.display = 'block';
                return;
            }

            const monthNames = [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
            ];

            const monthKey = monthNames[selectedDate.getMonth()];
            const dayKey = selectedDate.getDate().toString().padStart(2, '0');

            if (!workSchedules[monthKey] || !workSchedules[monthKey][dayKey]) {
                noSlotsMessage.style.display = 'block';
                return;
            }

            const daySchedule = workSchedules[monthKey][dayKey];
            const availableSlots = daySchedule.filter(slot => slot.is_available && slot.time !== null);

            if (availableSlots.length === 0) {
                noSlotsMessage.style.display = 'block';
                return;
            }

            noSlotsMessage.style.display = 'none';

            // Sort slots by time
            availableSlots.sort((a, b) => {
                const timeA = convertTo24Hour(a.time);
                const timeB = convertTo24Hour(b.time);
                return timeA.localeCompare(timeB);
            });

            availableSlots.forEach((slot, index) => {
                const timeSlot = document.createElement('div');
                timeSlot.className = 'time-slot';

                // Select first slot by default
                if (index === 0) {
                    timeSlot.classList.add('selected');
                }

                const timeValue = convertTo24Hour(slot.time);
                const displayTime = formatTimeForDisplay(slot.time);

                timeSlot.innerHTML = `
                    <input type="radio" name="time" value="${timeValue}" class="time-radio" ${index === 0 ? 'checked' : ''}>
                    ${displayTime}
                `;

                timeSlot.addEventListener('click', function() {
                    document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                    this.classList.add('selected');
                    this.querySelector('.time-radio').checked = true;
                });

                timeSlotsContainer.appendChild(timeSlot);
            });
        }

        function convertTo24Hour(timeStr) {
            // Convert "07:00 AM" to "07:00"
            const [time, period] = timeStr.split(' ');
            let [hours, minutes] = time.split(':');

            if (period === 'PM' && hours !== '12') {
                hours = (parseInt(hours) + 12).toString();
            } else if (period === 'AM' && hours === '12') {
                hours = '00';
            }

            return `${hours.padStart(2, '0')}:${minutes}`;
        }

        function formatTimeForDisplay(timeStr) {
            // Format for display with line break
            const [time, period] = timeStr.split(' ');
            return `${time}<br>${period}`;
        }

        // Initialize calendar on page load
        document.addEventListener('DOMContentLoaded', function() {
            initCalendar();
            document.querySelector('.first-service').click();
        });

    </script>
@endpush
