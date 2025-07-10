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

    .step.completed .step-number {
        background: #dc3545;
        color: white;
        border-color: #dc3545;
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

    .step.completed .step-label,
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

    .step.completed + .step-connector {
        background: #dc3545;
    }

    /* Main Content */
    .booking-content {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: relative;
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
        margin-bottom: 40px;
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

    /* Review Sections */
    .review-section {
        margin-bottom: 30px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .info-row:last-child {
        margin-bottom: 0;
    }

    .info-label {
        font-size: 14px;
        color: #666;
        font-weight: 500;
    }

    .info-value {
        font-size: 14px;
        color: #1a1a1a;
        font-weight: 500;
    }

    .edit-btn {
        background: none;
        border: none;
        cursor: pointer;
        color: #666;
        font-size: 16px;
        padding: 5px;
        transition: color 0.3s;
    }

    .edit-btn:hover {
        color: #dc3545;
    }

    /* Payment Section */
    .payment-section {
        margin-bottom: 30px;
    }

    .bill-details {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .bill-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .bill-row:last-child {
        margin-bottom: 0;
        padding-top: 8px;
        border-top: 1px solid #dee2e6;
        font-weight: 600;
    }

    .bill-label {
        font-size: 14px;
        color: #666;
    }

    .bill-value {
        font-size: 14px;
        color: #1a1a1a;
    }

    .bill-value.total {
        color: #dc3545;
        font-weight: 600;
    }

    .payment-prompt {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        color: #666;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .payment-prompt:hover {
        background: #e9ecef;
    }

    /* Form Footer */
    .form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .back-btn {
        padding: 12px 30px;
        border: 2px solid #dc3545;
        border-radius: 25px;
        background: white;
        color: #dc3545;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .back-btn:hover {
        background: #dc3545;
        color: white;
    }

    .confirm-btn {
        padding: 12px 30px;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 25px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .confirm-btn:hover {
        background: #c82333;
    }

    .confirm-btn:disabled {
        background: #ccc;
        cursor: not-allowed;
    }

    /* Payment Modal */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
    }

    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .payment-modal {
        background: white;
        border-radius: 12px;
        padding: 30px;
        max-width: 400px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
        transform: translateY(-20px);
        transition: transform 0.3s;
    }

    .modal-overlay.active .payment-modal {
        transform: translateY(0);
    }

    .modal-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 20px;
        text-align: center;
    }

    .payment-options {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-bottom: 20px;
    }

    .payment-option {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .payment-option:hover {
        border-color: #dc3545;
    }

    .payment-option.selected {
        border-color: #dc3545;
        background: #dc3545;
        color: white;
    }

    .payment-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        background: #f8f9fa;
        color: #dc3545;
    }

    .payment-option.selected .payment-icon {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .payment-info h4 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 3px;
    }

    .payment-info p {
        font-size: 12px;
        opacity: 0.8;
    }

    .add-payment-btn {
        width: 100%;
        padding: 12px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        background: white;
        color: #666;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .add-payment-btn:hover {
        border-color: #dc3545;
        color: #dc3545;
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

        .form-footer {
            flex-direction: column-reverse;
            gap: 15px;
        }

        .back-btn,
        .confirm-btn {
            width: 100%;
            text-align: center;
        }

        .booking-content {
            padding: 20px;
        }

        .payment-modal {
            padding: 20px;
        }
    }
</style>
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
        <div class="step active">
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
            <img src="/placeholder.svg?height=60&width=60" alt="Dr. Esther Howard" class="doctor-avatar">
            <div class="doctor-name">Dr. Esther Howard</div>
        </div>

        <form id="confirmationForm" method="POST" action="{{ route('appointment.step.3.store') }}">
            @csrf

            <!-- Review Schedule -->
            <div class="review-section">
                <h3 class="section-title">Review schedule</h3>
                <div class="info-row">
                    <div>
                        <div class="info-label">📅 Date</div>
                        <div class="info-value">Thu, 05 Sep 2025</div>
                    </div>
                    <div>
                        <div class="info-label">🕐 Time</div>
                        <div class="info-value">11:30 - 14:00 pm</div>
                    </div>
                    <button type="button" class="edit-btn" onclick="editSchedule()">✏️</button>
                </div>
            </div>

            <!-- Home Visit -->
            <div class="review-section">
                <h3 class="section-title">Home visit</h3>
                <div class="info-row">
                    <div>
                        <div class="info-label">📍 Address</div>
                        <div class="info-value">---</div>
                    </div>
                    <button type="button" class="edit-btn" onclick="editAddress()">✏️</button>
                </div>
                <div class="info-row">
                    <div>
                        <div class="info-label">🗺️ GPS location</div>
                        <div class="info-value">---</div>
                    </div>
                    <button type="button" class="edit-btn" onclick="editLocation()">✏️</button>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="payment-section">
                <h3 class="section-title">Payment method</h3>

                <div class="bill-details">
                    <div class="info-label" style="margin-bottom: 10px;">Bill details</div>
                    <div class="bill-row">
                        <span class="bill-label">Home visit</span>
                        <span class="bill-value">150$</span>
                    </div>
                    <div class="bill-row">
                        <span class="bill-label">Tax VAT</span>
                        <span class="bill-value">-1$</span>
                    </div>
                    <div class="bill-row">
                        <span class="bill-label">Total pay</span>
                        <span class="bill-value total">154$</span>
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
                <a href="#" class="back-btn">Back</a>
                <button type="submit" class="confirm-btn" id="confirmBtn" disabled>Confirm</button>
            </div>
        </form>
    </div>
</div>

<!-- Payment Modal -->
<div class="modal-overlay" id="paymentModal">
    <div class="payment-modal">
        <h3 class="modal-title">Select Payment Method</h3>

        <div class="payment-options">
            <div class="payment-option selected" data-method="cash">
                <div class="payment-icon">💵</div>
                <div class="payment-info">
                    <h4>Cash</h4>
                    <p>Pay with cash</p>
                </div>
            </div>

            <div class="payment-option" data-method="bank">
                <div class="payment-icon">🏦</div>
                <div class="payment-info">
                    <h4>Bank</h4>
                    <p>Pay with bank transfer</p>
                </div>
            </div>

            <div class="payment-option" data-method="card">
                <div class="payment-icon">💳</div>
                <div class="payment-info">
                    <h4>Card</h4>
                    <p>Pay with credit/debit card</p>
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
    let selectedPaymentMethod = 'cash'; // Default selection

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

    // Update payment prompt text
    function updatePaymentPrompt() {
        const prompt = document.querySelector('.payment-prompt span:last-child');
        const methods = {
            'cash': 'Cash payment selected',
            'bank': 'Bank transfer selected',
            'card': 'Card payment selected'
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

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePaymentModal();
        }
    });

    // Edit functions
    function editSchedule() {
        alert('Redirect to schedule editing page');
    }

    function editAddress() {
        alert('Open address editing modal');
        // You can implement address editing functionality here
    }

    function editLocation() {
        alert('Open GPS location picker');
        // You can implement location picker functionality here
    }

    function addPaymentMethod() {
        alert('Redirect to add payment method page');
        // You can implement add payment method functionality here
    }

    // Form submission
    document.getElementById('confirmationForm').addEventListener('submit', function(e) {
        if (!selectedPaymentMethod) {
            e.preventDefault();
            alert('Please select a payment method');
            return false;
        }

        // Show loading state
        const submitBtn = document.getElementById('confirmBtn');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Processing...';

        console.log('Booking confirmed with payment method:', selectedPaymentMethod);
    });

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updatePaymentPrompt();
    });
</script>
@endpush
