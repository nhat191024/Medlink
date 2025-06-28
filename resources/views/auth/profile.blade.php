@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="/css/auth.css">
@endpush

@section('content')
    <div class="main-content">
        <div class="form-wrapper">
            <div class="back-btn-container">
                <a class="back-btn" href="{{ route('splash') }}">
                    @svg('heroicon-o-arrow-left', 'back-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                </a>
            </div>

            <!-- Progress Indicator -->
            <div class="progress-indicator" id="progressIndicator">
                <div class="progress-circle">
                    <svg viewBox="0 0 50 50">
                        <circle class="progress-bg" cx="25" cy="25" r="20"></circle>
                        <circle class="progress-fill" cx="25" cy="25" r="20" stroke-dasharray="0 125.6" id="progressCircle">
                        </circle>
                    </svg>
                    <div class="progress-number" id="progressNumber">0</div>
                </div>
            </div>

            <div class="form-title">
                <img src="https://cdn-icons-png.flaticon.com/512/565/565547.png" alt="icon" class="form-icon">
                <h2>Complete your profile</h2>
            </div>
            <form class="profile-form">
                <div class="form-columns">
                    <div class="form-left">
                        <label>Full name*<input type="text" placeholder="Your full name" required></label>
                        <label>Age*
                            <input type="range" min="0" max="150" value="18" class="slider" id="age-slider">
                            <span class="slider-value" id="age-value">I'm 18</span>
                        </label>
                        <label>Gender*<select class="profile-select" required><option>Choose</option><option>Male</option><option>Female</option><option>Other</option></select></label>
                        <label>Height*
                            <input type="range" min="1.0" max="3.0" step="0.01" value="1.53" class="slider" id="height-slider">
                            <span class="slider-value" id="height-value">I'm 1.53 m</span>
                        </label>
                        <label>Weight*
                            <input type="range" min="30" max="500" value="46" class="slider" id="weight-slider">
                            <span class="slider-value" id="weight-value">I'm 46 kg</span>
                        </label>
                        <label>Blood group*<select class="profile-select" required><option>Choose</option><option>A</option><option>B</option><option>AB</option><option>O</option></select></label>
                        <label>Medical history<textarea placeholder="Enter your history medical"></textarea></label>
                    </div>
                    <div class="form-right">
                        <label>Insurance type
                            <select class="profile-select">
                                <option>Public insurance</option>
                                <option>Private insurance</option>
                            </select>
                        </label>
                        <label>Public insurance*<input type="text" placeholder="Enter number"></label>
                        <label>Assurance type<select class="profile-select"><option>Choose</option><option>Type 1</option><option>Type 2</option></select></label>
                        <label>Address*<input type="text" placeholder="Enter"></label>
                    </div>
                </div>
                <button type="submit" class="continue-btn">Continue</button>
            </form>
        </div>
    </div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Age
    const ageSlider = document.getElementById('age-slider');
    const ageValue = document.getElementById('age-value');
    if (ageSlider && ageValue) {
        ageSlider.addEventListener('input', function() {
            ageValue.textContent = "I'm " + ageSlider.value;
        });
    }
    // Height
    const heightSlider = document.getElementById('height-slider');
    const heightValue = document.getElementById('height-value');
    if (heightSlider && heightValue) {
        heightSlider.addEventListener('input', function() {
            heightValue.textContent = "I'm " + parseFloat(heightSlider.value).toFixed(2) + " m";
        });
    }
    // Weight
    const weightSlider = document.getElementById('weight-slider');
    const weightValue = document.getElementById('weight-value');
    if (weightSlider && weightValue) {
        weightSlider.addEventListener('input', function() {
            weightValue.textContent = "I'm " + weightSlider.value + " kg";
        });
    }
});
</script> 
