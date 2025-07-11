@extends('layouts.app')
@push('styles')
    <link href="{{ asset('css/appointment/step1.css') }}" rel="stylesheet">
@endpush


@section('content')
<div class="booking-center-outer">
    <div class="booking-header">
        <div class="booking-title">Book appointment</div>
        <div class="booking-doctor">
            <img src="{{ asset('img/image.png') }}" alt="Doctor">
            <span>Dr. Esther Howard</span>
        </div>
    </div>
    <div class="booking-card">
        <div class="booking-section">
            <div class="booking-section-title">Review schedule</div>
            <div class="booking-box">
                <div class="booking-box-col">
                    <div class="booking-label">Time & Date</div>
                    <div class="booking-box-row">
                    <img src="{{ asset('img/dateicon.png') }}" > 
                        <span>Thu, 05 Sep 2025</span>
                    </div>
                </div>
                <div class="booking-box-col" style="align-items: flex-end;">
                    <div class="booking-label">&nbsp;</div>
                    <div class="booking-box-row">
                    <img src="{{ asset('img/timeicon.png') }}" >
                        <span>11:30 - 14:00 pm</span>
                    </div>
                </div>
                <div class="booking-edit-icon">
                <img src="{{ asset('img/butchiicon.png') }}" >
                </div>
            </div>
        </div>
        <div class="booking-section">
            <div class="booking-section-title">Home visit</div>
            <div class="booking-box" style="flex-direction: column; align-items: flex-start; gap: 12px;">
                <div class="booking-box-row">
                <img src="{{ asset('img/Iconlocation - Copy.png') }}" >
                    Address
                </div>
                <div class="booking-box-row">
                <img src="{{ asset('img/Iconlocation - Copy.png') }}" >
                    GPS location
                </div>
                <div class="booking-edit-icon" style="top: 14px; right: 18px;">
                <img src="{{ asset('img/butchiicon.png') }}" >
                </div>
            </div>
        </div>
        <div class="booking-section">
            <div class="booking-section-title">Payment method</div>
   <div class="booking-bill-box">
    <div class="booking-bill-title">Bill details</div>
    <hr class="booking-bill-hr">
    <div class="booking-bill-row">
        <span>Home visit</span>
        <span>150$</span>
    </div>
    <div class="booking-bill-row">
        <span>Tax VAT</span>
        <span>4$</span>
    </div>
    <hr class="booking-bill-hr">
    <div class="booking-bill-row total">
        <span>Total pay</span>
        <span>154$</span>
    </div>
</div>
            <div class="booking-payment-method">
                <img src="{{ asset('img/iconcard.png') }}" >
                Please select a payment method
            </div>
        </div>
    </div>
    <div class="booking-footer">
        <button class="booking-btn-back">Back</button>
        <button class="booking-btn-confirm">Confirm</button>
    </div>
</div>
@endsection