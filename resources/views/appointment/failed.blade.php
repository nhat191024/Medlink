@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/appointment/failed.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="failed-bg">
        <div class="failed-main">
            <div class="failed-icon-top">
                <img src="{{ asset('img/error-icon.png') }}" alt="Error Icon" class="info-icon-img">
            </div>
            <div class="failed-title">{{ session('error','Not Found') }}</div>
            <div class="failed-desc">Unfortunately, your payment could not be processed.</div>
            <div class="failed-note">Please try again or contact support if the problem persists</div>
            <div class="info-card">
                {{-- <div class="info-row">
                    <div class="info-icon-bg">
                        <img src="{{ asset('img/iconhome.png') }}" alt="Home Icon" class="info-icon-img">
                    </div>
                    <div>Home visit</div>
                </div>
                <div class="info-row">
                    <div class="info-icon-bg">
                        <img src="{{ asset('img/iconclock.png') }}" alt="Clock Icon" class="info-icon-img">
                    </div>
                    <div>
                        Thursday, 05 September 2025<br>
                        11:30 - 14:00 PM
                    </div>
                </div> --}}
                <div class="info-row">
                    <div class="info-icon-bg">
                        <img src="{{ asset('img/iconlocation.png') }}" alt="Location Icon" class="info-icon-img">
                    </div>
                    <div>Bill ID: {{ session('billId', 'Not found') }}</div>
                </div>
            </div>
            <div class="action-btns">
                <a href="{{ route('appointment.index') }}" class="action-btn">
                    <img src="{{ asset('img/iconrefresh.png') }}" alt="Retry Icon" class="info-icon-img"> Try Again
                </a>
                <button class="action-btn">
                    <img src="{{ asset('img/iconsupport.png') }}" alt="Support Icon" class="info-icon-img"> Contact Support
                </button>
            </div>
            {{-- <a href="#" class="see-details">See error details</a> --}}
            {{-- <a href="#" class="back-btn">Back</a> --}}
        </div>
    </div>
@endsection
