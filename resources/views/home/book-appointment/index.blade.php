@extends('layouts.app')

@push('styles')
    
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
    
@endpush
