@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/appointment/success.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="success-bg">
        <div class="success-main">
            <div class="success-icon-top border-[#3bb54a] border-2">
                <img src="{{ asset('img/Partypopper.png') }}" alt="Party Icon" class="info-icon-img">
            </div>
            <div class="success-title">Thank you</div>
            <div class="success-desc">Your appointment has been booked successfully!</div>
            <div class="success-note">Please check your appointment history for receipt and looking details</div>
            <div class="info-card">
                <div class="info-row">
                    <div class="info-icon-bg">
                        <img src="{{ asset('img/iconhome.png') }}" alt="Home Icon" class="info-icon-img">
                    </div>
                    <div>{{ session('serviceName') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-icon-bg">
                        <img src="{{ asset('img/iconclock.png') }}" alt="Clock Icon" class="info-icon-img">
                    </div>
                    <div>
                        {{ session('date') }}<br>
                        {{ session('time') }}
                    </div>
                </div>
                {{-- <div class="info-row">
                    <div class="info-icon-bg">
                        <img src="{{ asset('img/iconlocation.png') }}" alt="Location Icon" class="info-icon-img">
                    </div>
                    <div>Location</div>
                </div> --}}
            </div>
            <div class="action-btns">
                <button class="action-btn">
                    <img src="{{ asset('img/iconphone.png') }}" alt="Call Icon" class="info-icon-img"> Call
                </button>
                <button class="action-btn">
                    <img src="{{ asset('img/iconmessage.png') }}" alt="Message Icon" class="info-icon-img"> Message
                </button>
                <a href="{{ route('appointment.index') }}" class="action-btn">
                    Back
                </a>
            </div>
            {{-- <a href="#" class="see-details">See all details</a> --}}
            {{-- <a href="#" class="back-btn">Back</a> --}}
        </div>
    </div>
@endsection
