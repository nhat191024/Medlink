@extends('layouts.app')
@push('styles')
    <link href="{{ asset('css/appointments.css') }}" rel="stylesheet">
@endpush


@section('content')
<div class="success-bg">
    <div class="success-main">
       <div class="success-icon-top">
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
            </div>
            <div class="info-row">
            <div class="info-icon-bg">
             <img src="{{ asset('img/iconlocation.png') }}" alt="Location Icon" class="info-icon-img">
                </div>
                <div>Location</div>
            </div>
        </div>
        <div class="action-btns">
        <button class="action-btn">
        <img src="{{ asset('img/iconphone.png') }}" alt="Call Icon" class="info-icon-img"> Call
            </button>
            <button class="action-btn">
          <img src="{{ asset('img/iconmessage.png') }}" alt="Message Icon" class="info-icon-img"> Message
        </button>
        </div>
        <a href="#" class="see-details">See all details</a>
        <a href="#" class="back-btn">Back</a>
    </div>
</div>
@endsection