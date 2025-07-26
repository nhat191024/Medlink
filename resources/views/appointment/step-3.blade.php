@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/appointment/step-3.css') }}?v=1" rel="stylesheet">
@endpush

@section('content')
<div class="booking-container">
    <!-- Progress Steps -->
    <div class="progress-steps">
        <div class="step completed">
            <div class="step-number">1</div>
            <div class="step-label">Chọn dịch vụ</div>
        </div>
        <div class="step-connector"></div>
        <div class="step completed">
            <div class="step-number">2</div>
            <div class="step-label">Điền thông tin</div>
        </div>
        <div class="step-connector"></div>
        <div class="step active">
            <div class="step-number">3</div>
            <div class="step-label">Thanh toán & xác nhận</div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="booking-content" id="bookingContent">
        <h1 class="booking-title">Book appointment</h1>

        <!-- Doctor Info -->
        <div class="doctor-info">
            <img src="/{{ $doctorProfile->user->avatar }}?height=60&width=60" alt="{{ $doctorProfile->user->name }}" class="doctor-avatar" onerror="this.onerror=null;this.src='{{ asset('storage/upload/avatar/default.png') }}';">
            <div class="doctor-name">{{ $doctorProfile->user->name }}</div>
        </div>

        <form id="confirmationForm" method="POST" action="{{ route('appointment.step.three.store') }}">
            @csrf

            <!-- Review Schedule -->
            <div class="review-section">
                <h3 class="section-title">Review schedule</h3>
                <div class="info-row">
                    <div>
                        <div class="info-label">📅 Date</div>
                        <div class="info-value">{{ $schedule['date'] }}</div>
                    </div>
                    <div>
                        <div class="info-label">🕐 Time</div>
                        <div class="info-value">{{ $schedule['time'] }}</div>
                    </div>
                    <button type="button" class="edit-btn" onclick="editSchedule()">✏️</button>
                </div>
            </div>

            <!-- Home Visit -->
            <div class="review-section">
                <h3 class="section-title">Detailed info</h3>
                {{-- <div class="info-row">
                    <div>
                        <div class="info-label">📍 Address</div>
                        <div class="info-value">{{ $address }}</div>
                    </div>
                </div> --}}
                <div class="info-row">
                    <div>
                        <div class="info-label">💼 Service</div>
                        <div class="info-value">{{ $bill['service']['name'] }}</div>
                    </div>
                    <button type="button" class="edit-btn" onclick="editSchedule()">✏️</button>
                </div>
                <div class="info-row">
                    <div>
                        <div class="info-label">📝 Summary</div>
                        <div class="info-value">{{ $summarize }}</div>
                    </div>
                </div>
                <div class="info-row">
                    <div>
                        <div class="info-label">🗒️ Note</div>
                        <div class="info-value">{{ $note }}</div>
                    </div>
                </div>
                <div class="info-row">
                    <div>
                        <div class="info-label">📎 File uploaded</div>
                        <div class="info-value">{{ $fileName }}</div>
                    </div>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="payment-section">
                <h3 class="section-title">Payment method</h3>

                <div class="bill-details">
                    <div class="info-label" style="margin-bottom: 10px;">Bill details</div>
                    <div class="bill-row">
                        <span class="bill-label">{{ $bill['service']['name'] }}</span>
                        <span class="bill-value">{{ $bill['service']['price'] }}</span>
                    </div>
                    <div class="bill-row">
                        <span class="bill-label">Tax VAT</span>
                        <span class="bill-value">{{ $bill['vat'] }}</span>
                    </div>
                    <div class="bill-row">
                        <span class="bill-label">Total pay</span>
                        <span class="bill-value total">{{ $bill['total'] }}</span>
                    </div>
                </div>

                <div class="payment-prompt" onclick="openPaymentModal()">
                    <span>💳</span>
                    <span>Please select a payment method</span>
                </div>

                <input type="hidden" name="payment_method" id="selectedPaymentMethod">
            </div>

            <!-- Form Footer -->
            <div class="form-footer">
                <a onclick="history.back()" href="#"  class="back-btn">Back</a>
                <button type="submit" class="confirm-btn" id="confirmBtn" disabled>Confirm</button>
            </div>
        </form>
    </div>
</div>

<!-- Payment Confirmation Overlay -->
<div class="confirmation-overlay" id="confirmationOverlay">
    <div class="payment-confirmation" id="paymentConfirmation">
        <h3 class="confirmation-title">Confirm payment</h3>

        <div class="confirmation-bill">
            <div class="bill-row">
                <span class="bill-label">{{ $bill['service']['name'] }}</span>
                <span class="bill-value">{{ $bill['service']['price'] }}</span>
            </div>
            <div class="bill-row">
                <span class="bill-label">Tax VAT</span>
                <span class="bill-value">{{ $bill['vat'] }}</span>
            </div>
            <div class="bill-row">
                <span class="bill-label">Total pay</span>
                <span class="bill-value total">{{ $bill['total'] }}</span>
            </div>
        </div>

        <div class="selected-payment-method">
            <div class="payment-method-info">
                <div class="payment-method-icon">💵</div>
                <div class="payment-method-details">
                    <h4>QR</h4>
                    <p>Pay with Bank Transfer</p>
                    <p>Selected</p>
                </div>
            </div>
            <button type="button" class="edit-btn" onclick="editPaymentMethod()">✏️</button>
        </div>

        <button type="button" class="confirmation-continue-btn" id="confirmationContinueBtn" onclick="proceedPayment()">
            <span class="btn-text">Continue</span>
        </button>
        <p class="confirmation-note">Please select a payment method</p>
    </div>
</div>

<!-- Payment Modal -->
<div class="modal-overlay" id="paymentModal">
    <div class="payment-modal">
        <h3 class="modal-title">Select Payment Method</h3>

        <div class="payment-options">
            <div class="payment-option selected" data-method="qr_transfer">
                <div class="payment-icon">💵</div>
                <div class="payment-info">
                    <h4>QR</h4>
                    <p>Pay with Bank Transfer</p>
                </div>
            </div>
        </div>

        <div class="payment-options">
            <div class="payment-option" data-method="qr_transfer">
                <div class="payment-icon">💵</div>
                <div class="payment-info">
                    <h4>QR</h4>
                    <p>Pay with Bank Transfer</p>
                </div>
            </div>
        </div>

        <button type="button" class="add-payment-btn" onclick="addPaymentMethod()">
            Add a payment method
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let selectedPaymentMethod = 'qr_transfer'; // Default selection

    // Open payment modal
    function openPaymentModal() {
        document.getElementById('paymentModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Close payment modal
    function closePaymentModal() {
        document.getElementById('paymentModal').classList.remove('active');
        document.body.style.overflow = 'auto';

        // Update the payment prompt text
        updatePaymentPrompt();

        // Enable confirm button if payment method is selected
        document.getElementById('confirmBtn').disabled = false;
    }

    // Show payment confirmation with blur effect
    function showPaymentConfirmation() {
        const overlay = document.getElementById('confirmationOverlay');
        const content = document.getElementById('bookingContent');

        // Add blur effect to background content
        content.classList.add('blurred');

        // Show confirmation overlay with animation
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Hide payment confirmation
    function hidePaymentConfirmation() {
        const overlay = document.getElementById('confirmationOverlay');
        const content = document.getElementById('bookingContent');

        // Remove blur effect
        content.classList.remove('blurred');

        // Hide confirmation overlay
        overlay.classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    // Update payment prompt text
    function updatePaymentPrompt() {
        const prompt = document.querySelector('.payment-prompt span:last-child');
        const methods = {
            'cash': 'Cash payment selected',
            'bank': 'Bank transfer selected',
            'card': 'Card payment selected',
            'qr_transfer': 'QR Bank Transfer selected'
        };
        prompt.textContent = methods[selectedPaymentMethod] || 'Please select a payment method';

        // Update hidden input
        document.getElementById('selectedPaymentMethod').value = selectedPaymentMethod;
    }

    // Payment option selection
    document.querySelectorAll('.payment-option').forEach(option => {
        option.addEventListener('click', function() {
            // Remove selected class from all options
            document.querySelectorAll('.payment-option').forEach(opt => {
                opt.classList.remove('selected');
            });

            // Add selected class to clicked option
            this.classList.add('selected');
            selectedPaymentMethod = this.getAttribute('data-method');
        });
    });

    // Close modal when clicking outside
    document.getElementById('paymentModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closePaymentModal();
        }
    });

    // Close confirmation when clicking outside
    document.getElementById('confirmationOverlay').addEventListener('click', function(e) {
        if (e.target === this) {
            hidePaymentConfirmation();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (document.getElementById('paymentModal').classList.contains('active')) {
                closePaymentModal();
            } else if (document.getElementById('confirmationOverlay').classList.contains('active')) {
                hidePaymentConfirmation();
            }
        }
    });

    // Edit functions
    function editSchedule() {
        location.href="{{ route('appointment.step.one', ['doctor_profile_id' => $doctorProfile->id]) }}";
    }

    function editAddress() {
        location.href="{{ route('appointment.step.two') }}";
    }

    function editLocation() {
        // alert('Open GPS location picker');
    }

    function addPaymentMethod() {
        // alert('Redirect to add payment method page');
    }

    function editPaymentMethod() {
        hidePaymentConfirmation();
        openPaymentModal();
    }

    // Proceed with payment and submit form
    function proceedPayment() {
        const continueBtn = document.getElementById('confirmationContinueBtn');
        const btnText = continueBtn.querySelector('.btn-text');

        // Show loading state
        continueBtn.classList.add('loading');
        btnText.textContent = 'Processing...';
        continueBtn.disabled = true;

        // Simulate processing time and submit form
        setTimeout(() => {
            // Submit the form
            document.getElementById('confirmationForm').submit();
        }, 1500);
    }

    // Form submission
    document.getElementById('confirmationForm').addEventListener('submit', function(e) {
        e.preventDefault();

        if (!selectedPaymentMethod) {
            alert('Please select a payment method');
            return false;
        }

        // Show payment confirmation instead of submitting immediately
        showPaymentConfirmation();
    });

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updatePaymentPrompt();

        // Enable confirm button since we have default payment method
        document.getElementById('confirmBtn').disabled = false;
    });
</script>
@endpush
