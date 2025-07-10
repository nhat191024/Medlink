@extends('layouts.app')

@push('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #f8f9fa;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .booking-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Progress Steps */
    .progress-steps {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 40px;
        gap: 20px;
    }

    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }

    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 16px;
        margin-bottom: 8px;
        border: 2px solid #ddd;
        background: white;
        color: #666;
    }

    .step.active .step-number {
        background: #dc3545;
        color: white;
        border-color: #dc3545;
    }

    .step-label {
        font-size: 14px;
        color: #666;
        text-align: center;
        white-space: nowrap;
    }

    .step.active .step-label {
        color: #dc3545;
        font-weight: 500;
    }

    .step-connector {
        width: 60px;
        height: 2px;
        background: #ddd;
        margin: 0 10px;
        margin-top: -25px;
    }

    /* Main Content */
    .booking-content {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .booking-title {
        font-size: 24px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 20px;
    }

    /* Doctor Info */
    .doctor-info {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 30px;
    }

    .doctor-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
    }

    .doctor-name {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
    }

    /* Services Section */
    .services-section {
        margin-bottom: 40px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 20px;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .service-card {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        background: white;
        position: relative;
    }

    .service-card:hover {
        border-color: #dc3545;
    }

    .service-card.selected {
        border-color: #dc3545;
        background: #dc3545;
        color: white;
    }

    .service-radio {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .service-icon {
        width: 40px;
        height: 40px;
        margin: 0 auto 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        border-radius: 8px;
    }

    .service-card:not(.selected) .service-icon {
        background: #f8f9fa;
        color: #dc3545;
    }

    .service-card.selected .service-icon {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .service-name {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .service-description {
        font-size: 12px;
        opacity: 0.8;
        margin-bottom: 10px;
    }

    .service-price {
        font-size: 16px;
        font-weight: 600;
    }

    /* Time Section */
    .time-section {
        margin-bottom: 30px;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .month-year {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
    }

    .nav-buttons {
        display: flex;
        gap: 10px;
    }

    .nav-btn {
        width: 32px;
        height: 32px;
        border: 1px solid #ddd;
        border-radius: 50%;
        background: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }

    .nav-btn:hover {
        border-color: #dc3545;
        color: #dc3545;
    }

    .calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .day-item {
        text-align: center;
        padding: 10px 5px;
        cursor: pointer;
        border-radius: 8px;
        transition: all 0.3s;
        position: relative;
    }

    .day-item:hover {
        background: #f8f9fa;
    }

    .day-item.selected {
        background: #dc3545;
        color: white;
    }

    .day-radio {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .day-name {
        font-size: 12px;
        color: #666;
        margin-bottom: 5px;
    }

    .day-item.selected .day-name {
        color: rgba(255, 255, 255, 0.8);
    }

    .day-number {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
    }

    .day-item.selected .day-number {
        color: white;
    }

    /* Time Slots */
    .time-slots {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 30px;
    }

    .time-slot {
        padding: 10px 16px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: white;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 14px;
        font-weight: 500;
        position: relative;
    }

    .time-slot:hover {
        border-color: #dc3545;
        color: #dc3545;
    }

    .time-slot.selected {
        background: #dc3545;
        color: white;
        border-color: #dc3545;
    }

    .time-radio {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    /* Bottom Section */
    .booking-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .continue-btn {
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .continue-btn:hover {
        background: #c82333;
    }

    .continue-btn:disabled {
        background: #ccc;
        cursor: not-allowed;
    }

    .total-price {
        font-size: 24px;
        font-weight: 600;
        color: #1a1a1a;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .progress-steps {
            flex-direction: column;
            gap: 10px;
        }

        .step-connector {
            display: none;
        }

        .services-grid {
            grid-template-columns: 1fr;
        }

        .calendar-days {
            grid-template-columns: repeat(3, 1fr);
        }

        .time-slots {
            justify-content: center;
        }

        .booking-footer {
            flex-direction: column;
            gap: 20px;
        }
    }
</style>
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
            <img src="/placeholder.svg?height=60&width=60" alt="{{ $doctorProfile->user->name }}" class="doctor-avatar">
            <div class="doctor-name">{{ $doctorProfile->user->name }}</div>
        </div>

        <!-- Booking Form -->
        <form id="bookingForm" method="POST" action="{{ route('appointment.step.1.store') }}">
            @csrf

            <!-- Services Section -->
            <div class="services-section">
                <h2 class="section-title">Choose services</h2>
                <div class="services-grid">
                    @foreach ($doctorProfile->services as $service)
                        <div class="service-card {{ $loop->first ? 'first-service' : '' }} {{ $loop->first ? 'selected' : '' }}" data-price="{{ $service->price }}">
                            <input type="radio" name="service" value="{{ $service->id }}" class="service-radio" data-price="{{ $service->price }}" {{ $loop->first ? 'checked' : '' }}>
                            <div class="service-icon">{{ $service->icon }}</div>
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
