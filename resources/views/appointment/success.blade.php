@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/appointment/success.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="success-bg">
        <div class="success-main">
            <div class="success-icon-top border-2 border-[#3bb54a]">
                <img class="info-icon-img" src="{{ asset('img/Partypopper.png') }}" alt="Party Icon">
            </div>
            <div class="success-title">Cảm ơn bạn</div>
            <div class="success-desc">Cuộc hẹn của bạn đã được đặt thành công!</div>
            <div class="success-note">Vui lòng kiểm tra lịch sử cuộc hẹn của bạn để nhận và xem chi tiết </div>
            <div class="info-card">
                <div class="info-row">
                    <div class="info-icon-bg">
                        <img class="info-icon-img" src="{{ asset('img/iconhome.png') }}" alt="Home Icon">
                    </div>
                    <div>{{ session('serviceName') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-icon-bg">
                        <img class="info-icon-img" src="{{ asset('img/iconclock.png') }}" alt="Clock Icon">
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
                    <img class="info-icon-img" src="{{ asset('img/iconmessage.png') }}" alt="Message Icon">
                    Nhắn tin
                </button>
                <a class="action-btn" href="{{ route('appointment.index') }}">
                    Quay lại
                </a>
            </div>
            {{-- <a href="#" class="see-details">See all details</a> --}}
            {{-- <a href="#" class="back-btn">Back</a> --}}
        </div>
    </div>
@endsection
