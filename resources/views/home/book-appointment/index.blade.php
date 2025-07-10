@extends('layouts.app')

@push('styles')
    <style>
        .medlink_home_book-appointment_container {
            min-height: 100vh;
            padding: 1rem;
            background-color: #f9fafb;
        }

        .medlink_home_book-appointment_wrapper {
            max-width: 52rem;
            margin: 0 auto;
        }

        .medlink_home_book-appointment_header {
            margin-bottom: 2rem;
        }

        .medlink_home_book-appointment_title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .medlink_home_book-appointment_doctor-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .medlink_home_book-appointment_doctor-avatar {
            width: 3rem;
            height: 3rem;
            border-radius: 9999px;
            background: linear-gradient(to bottom right, #60a5fa, #a78bfa);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .medlink_home_book-appointment_input:focus {
            border-color: #3b82f6;
            background-color: #fff;
        }

        .medlink_home_book-appointment_doctor-name {
            color: #374151;
            font-weight: 500;
        }

        .medlink_home_book-appointment_main-card {
            background-color: white;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .medlink_home_book-appointment_section-title {
            font-size: 1.125rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 1rem;
        }

        .medlink_home_book-appointment_time-date-section,
        .medlink_home_book-appointment_bill-details,
        .medlink_home_book-appointment_payment-selection {
            background-color: #f9fafb;
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .medlink_home_book-appointment_time-date-header,
        .medlink_home_book-appointment_home-visit-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .medlink_home_book-appointment_time-date-title,
        .medlink_home_book-appointment_home-visit-title,
        .medlink_home_book-appointment_bill-title {
            color: #1f2937;
            font-weight: 500;
        }

        .medlink_home_book-appointment_edit-btn {
            padding: 0.25rem;
            border-radius: 0.5rem;
            cursor: pointer;
            background-color: transparent;
            border: none;
        }

        .medlink_home_book-appointment_edit-btn:has(input[type="checkbox"]:checked)~input {
            pointer-events: auto;
            opacity: 1;
        }

        .medlink_home_book-appointment_time-date-content {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .medlink_home_book-appointment_date-label,
        .medlink_home_book-appointment_time-label,
        .medlink_home_book-appointment_address-label,
        .medlink_home_book-appointment_gps-label {
            display: flex;
            align-items: center;
            color: #6b7280;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .medlink_home_book-appointment_input {
            width: 100%;
            padding: 0.5rem;
            font-size: 0.875rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            color: #1f2937;
            background-color: #f3f4f6;
            opacity: 0.5;
            pointer-events: none;
        }

        .medlink_home_book-appointment_edit-btn:has(input[type="checkbox"]:checked)+.medlink_home_book-appointment_input {
            opacity: 1;
            pointer-events: auto;
        }

        .medlink_home_book-appointment_address-placeholder,
        .medlink_home_book-appointment_gps-placeholder {
            color: #9ca3af;
            font-size: 0.875rem;
        }

        .medlink_home_book-appointment_bill-items {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .medlink_home_book-appointment_bill-item,
        .medlink_home_book-appointment_bill-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .medlink_home_book-appointment_bill-item-label,
        .medlink_home_book-appointment_bill-item-value {
            color: #4b5563;
        }

        .medlink_home_book-appointment_bill-total-label {
            color: #1f2937;
            font-weight: 500;
        }

        .medlink_home_book-appointment_bill-total-value {
            color: #ef4444;
            font-weight: 600;
        }

        .medlink_home_book-appointment_bill-divider {
            border-top: 1px solid #e5e7eb;
            margin: 0.5rem 0;
        }

        .medlink_home_book-appointment_payment-prompt {
            display: flex;
            align-items: center;
            color: #6b7280;
        }

        .medlink_home_book-appointment_payment-prompt::before {
            content: '\1F4B3';
            margin-right: 0.5rem;
        }

        .medlink_home_book-appointment_actions {
            display: flex;
            gap: 1rem;
        }

        .medlink_home_book-appointment_back-btn,
        .medlink_home_book-appointment_confirm-btn {
            flex: 1;
            padding: 1rem 1.5rem;
            border-radius: 1rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: background-color 0.2s;
        }

        .medlink_home_book-appointment_back-btn {
            background-color: #ffffff;
            border: 2px solid #ef4444;
            color: #ef4444;
        }

        .medlink_home_book-appointment_back-btn:hover {
            background-color: #fef2f2;
        }

        .medlink_home_book-appointment_confirm-btn {
            background-color: #ef4444;
            color: white;
        }

        .medlink_home_book-appointment_confirm-btn:hover {
            background-color: #dc2626;
        }
    </style>
@endpush

@section('content')
    <div class="medlink_home_book-appointment_container">
        <form action="" method="get">
            <div class="medlink_home_book-appointment_wrapper">
                <div class="medlink_home_book-appointment_header">
                    <h1 class="medlink_home_book-appointment_title">Book appointment</h1>
                    <div class="medlink_home_book-appointment_doctor-profile">
                        <div class="medlink_home_book-appointment_doctor-avatar">👤</div>
                        <span class="medlink_home_book-appointment_doctor-name">Dr. Esther Howard</span>
                    </div>
                </div>
                <div class="medlink_home_book-appointment_main-card">
                    <div class="medlink_home_book-appointment_review-section">
                        <h2 class="medlink_home_book-appointment_section-title">Review schedule</h2>
                        <div class="medlink_home_book-appointment_time-date-section">
                            <div class="medlink_home_book-appointment_time-date-header">
                                <h3 class="medlink_home_book-appointment_time-date-title">Time & Date</h3>
                                <label class="medlink_home_book-appointment_edit-btn"
                                    data-edit-target=".medlink_home_book-appointment_time-date-content">
                                    ✏️
                                </label>
                            </div>
                            <div class="medlink_home_book-appointment_time-date-content">
                                <div class="medlink_home_book-appointment_date-info">
                                    <label class="medlink_home_book-appointment_date-label">📅 Date</label>
                                    <input type="text" class="medlink_home_book-appointment_input"
                                        value="Thu, 05 Sep 2025" disabled />
                                </div>
                                <div class="medlink_home_book-appointment_time-info">
                                    <label class="medlink_home_book-appointment_time-label">⏰ Time</label>
                                    <input type="text" class="medlink_home_book-appointment_input"
                                        value="11:30 - 14:00 pm" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="medlink_home_book-appointment_home-visit-section">
                            <div class="medlink_home_book-appointment_home-visit-header">
                                <h3 class="medlink_home_book-appointment_home-visit-title">Home visit</h3>
                                <label class="medlink_home_book-appointment_edit-btn"
                                    data-edit-target=".medlink_home_book-appointment_location-fields">
                                    ✏️
                                </label>
                            </div>
                            <div class="medlink_home_book-appointment_location-fields">
                                <div class="medlink_home_book-appointment_address-field">
                                    <label class="medlink_home_book-appointment_address-label">📍 Address</label>
                                    <input type="text" class="medlink_home_book-appointment_input"
                                        placeholder="Enter address..." disabled />
                                </div>
                                <div class="medlink_home_book-appointment_gps-field">
                                    <label class="medlink_home_book-appointment_gps-label">🧭 GPS location</label>
                                    <input type="text" class="medlink_home_book-appointment_input"
                                        placeholder="Enter GPS..." disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="medlink_home_book-appointment_payment-section">
                        <h2 class="medlink_home_book-appointment_section-title">Payment method</h2>
                        <div class="medlink_home_book-appointment_bill-details">
                            <h3 class="medlink_home_book-appointment_bill-title">Bill details</h3>
                            <div class="medlink_home_book-appointment_bill-items">
                                <div class="medlink_home_book-appointment_bill-item">
                                    <span class="medlink_home_book-appointment_bill-item-label">Home visit</span>
                                    <span class="medlink_home_book-appointment_bill-item-value">150$</span>
                                </div>
                                <div class="medlink_home_book-appointment_bill-item">
                                    <span class="medlink_home_book-appointment_bill-item-label">Tax VAT</span>
                                    <span class="medlink_home_book-appointment_bill-item-value">4$</span>
                                </div>
                                <div class="medlink_home_book-appointment_bill-divider"></div>
                                <div class="medlink_home_book-appointment_bill-total">
                                    <span class="medlink_home_book-appointment_bill-total-label">Total pay</span>
                                    <span class="medlink_home_book-appointment_bill-total-value">154$</span>
                                </div>
                            </div>
                        </div>
                        <div class="medlink_home_book-appointment_payment-selection">
                            <div class="medlink_home_book-appointment_payment-prompt">
                                <span class="medlink_home_book-appointment_payment-text">Please select a payment
                                    method</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="medlink_home_book-appointment_actions">
                    <button class="medlink_home_book-appointment_back-btn">Back</button>
                    <button class="medlink_home_book-appointment_confirm-btn">Confirm</button>
                </div>
            </div>
        </form>
    </div>
@endsection


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll(".medlink_home_book-appointment_edit-btn");

            editButtons.forEach((btn) => {
                btn.addEventListener("click", function() {
                    const targetSelector = btn.getAttribute("data-edit-target");
                    if (!targetSelector) return;

                    const target = document.querySelector(targetSelector);
                    if (!target) return;

                    const inputs = target.querySelectorAll(
                        "input.medlink_home_book-appointment_input");

                    // Toggle trạng thái nhập liệu
                    const isDisabled = inputs[0]?.disabled;
                    inputs.forEach((input) => {
                        input.disabled = !isDisabled;
                        input.style.opacity = isDisabled ? "1" : "0.5";
                        input.style.pointerEvents = isDisabled ? "auto" : "none";
                    });
                });
            });
        });
    </script>
@endpush
