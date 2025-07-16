@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/appointment/step-1.css') }}?v=1" rel="stylesheet">
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
            <img src="/{{ $doctorProfile->user->avatar }}?height=80&width=80" alt="{{ $doctorProfile->user->name }}" class="doctor-avatar">
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
                        <div class="service-card {{ $loop->first ? 'first-service' : '' }} {{ $loop->first ? 'selected' : '' }}" data-price="{{ $service->price }}">
                            <input type="radio" name="service" value="{{ $service->id }}" class="service-radio" data-price="{{ $service->price }}" {{ $loop->first ? 'checked' : '' }}>
                            <div class="service-icon">🏥</div>
                            <div class="service-name">{{ $service->name }}</div>
                            <div class="service-description">{{ $service->description }}</div>
                            <div class="service-price">{{ $service->price }}$</div>
                        </div>
                    @endforeach
                    {{-- Example service cards (uncomment to use) --}}
                    {{-- <div class="service-card" data-price="150">
                        <input type="radio" name="service" value="home" class="service-radio" data-price="150">
                        <div class="service-icon">🏠</div>
                        <div class="service-name">Home</div>
                        <div class="service-description">Book a visit at home</div>
                        <div class="service-price">150$</div>
                    {{-- <div class="service-card" data-price="150">
                        <input type="radio" name="service" value="home" class="service-radio" data-price="150">
                        <div class="service-icon">🏠</div>
                        <div class="service-name">Home</div>
                        <div class="service-description">Book a visit at home</div>
                        <div class="service-price">150$</div>
                    </div>
                    <div class="service-card selected" data-price="50">
                        <input type="radio" name="service" value="online" class="service-radio" data-price="50" checked>
                        <div class="service-icon">💻</div>
                        <div class="service-name">Online</div>
                        <div class="service-description">Make a video call with doctor</div>
                        <div class="service-price">50$</div>
                    </div>
                    <div class="service-card" data-price="100">
                        <input type="radio" name="service" value="clinic" class="service-radio" data-price="100">
                        <div class="service-icon">🏥</div>
                        <div class="service-name">Clinic</div>
                        <div class="service-description">Book an office visit doctor</div>
                        <div class="service-price">100$</div>
                    </div> --}}
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
                    <!-- Days will be generated by JavaScript -->
                </div>

                <div class="time-slots">
                    <div class="time-slot">
                        <input type="radio" name="time" value="07:00" class="time-radio">
                        7:00<br>AM
                    </div>
                    <div class="time-slot">
                        <input type="radio" name="time" value="07:50" class="time-radio">
                        7:50<br>AM
                    </div>
                    <div class="time-slot">
                        <input type="radio" name="time" value="08:30" class="time-radio">
                        8:30<br>AM
                    </div>
                    <div class="time-slot">
                        <input type="radio" name="time" value="09:30" class="time-radio">
                        9:30<br>AM
                    </div>
                    <div class="time-slot selected">
                        <input type="radio" name="time" value="15:00" class="time-radio" checked>
                        15:00<br>PM
                    </div>
                    <div class="time-slot">
                        <input type="radio" name="time" value="16:00" class="time-radio">
                        16:00<br>PM
                    </div>
                    <div class="time-slot">
                        <input type="radio" name="time" value="17:00" class="time-radio">
                        17:00<br>PM
                    </div>
                    <div class="time-slot">
                        <input type="radio" name="time" value="18:00" class="time-radio">
                        18:00<br>PM
                    </div>
                    <div class="time-slot">
                        <input type="radio" name="time" value="19:00" class="time-radio">
                        19:00<br>PM
                    </div>
                    <div class="time-slot">
                        <input type="radio" name="time" value="20:00" class="time-radio">
                        20:00<br>PM
                    </div>

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
    let currentDate = new Date();
    let selectedDateOffset = 0; // Days from today

    // Initialize calendar
    function initCalendar() {
        updateCalendar();
    }

    // Update calendar display
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

        for (let i = 0; i < 7; i++) {
            const date = new Date(currentDate);
            date.setDate(date.getDate() + selectedDateOffset + i);

            const dayItem = document.createElement('div');
            dayItem.className = 'day-item';
            if (i === 0) dayItem.classList.add('selected'); // First day selected by default

            dayItem.innerHTML = `
                <input type="radio" name="date" value="${date.toISOString().split('T')[0]}" class="day-radio" ${i === 0 ? 'checked' : ''}>
                <div class="day-name">${dayNames[date.getDay()]}</div>
                <div class="day-number">${date.getDate().toString().padStart(2, '0')}</div>
            `;

            dayItem.addEventListener('click', function() {
                document.querySelectorAll('.day-item').forEach(d => d.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('.day-radio').checked = true;
            });

            calendarDays.appendChild(dayItem);
        }
    }

    // Service selection
    document.querySelectorAll('.service-card').forEach(card => {
        card.addEventListener('click', function() {
            document.querySelectorAll('.service-card').forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');

            // Check the radio button
            this.querySelector('.service-radio').checked = true;

            // Update price
            const price = this.getAttribute('data-price');
            document.querySelector('.total-price').textContent = price + '$';
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

    // Initialize calendar on page load
    document.addEventListener('DOMContentLoaded', function() {
        initCalendar();
        document.querySelector('.first-service').click();
    });
</script>
@endpush
