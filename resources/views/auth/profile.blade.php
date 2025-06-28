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
                        <label>Gender*
                            <div class="custom-select-gender" id="genderSelect">
                                <div class="selected-gender" id="selectedGender">Choose</div>
                                <input type="hidden" name="gender" id="genderInput" value="">
                                <div class="gender-dropdown" id="genderDropdown" style="display:none;">
                                    <div class="gender-dropdown-header">
                                        <span>Gender</span>
                                        <span class="gender-save" id="genderSave">Save</span>
                                    </div>
                                    <div class="gender-options">
                                        <div class="gender-option" data-value="Male">Male <span class="gender-tick">&#10003;</span></div>
                                        <div class="gender-option" data-value="Female">Female <span class="gender-tick">&#10003;</span></div>
                                        <div class="gender-option" data-value="Other">Other <span class="gender-tick">&#10003;</span></div>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <label>Height*
                            <input type="range" min="1.0" max="3.0" step="0.01" value="1.53" class="slider" id="height-slider">
                            <span class="slider-value" id="height-value">I'm 1.53 m</span>
                        </label>
                        <label>Weight*
                            <input type="range" min="30" max="500" value="46" class="slider" id="weight-slider">
                            <span class="slider-value" id="weight-value">I'm 46 kg</span>
                        </label>
                        <!-- Custom Blood group select -->
                        <label>Blood group*
                            <div class="custom-select-blood" id="bloodSelect">
                                <div class="selected-blood" id="selectedBlood">Choose</div>
                                <input type="hidden" name="blood_group" id="bloodGroupInput" value="">
                                <div class="blood-dropdown" id="bloodDropdown" style="display:none;">
                                    <div class="blood-dropdown-header">
                                        <span>Blood group</span>
                                        <span class="blood-save" id="bloodSave">Save</span>
                                    </div>
                                    <div class="blood-options-grid">
                                        <div class="blood-option-grid" data-value="A+">A+ <span class="blood-drop">🩸</span></div>
                                        <div class="blood-option-grid" data-value="A-">A- <span class="blood-drop">🩸</span></div>
                                        <div class="blood-option-grid" data-value="B+">B+ <span class="blood-drop">🩸</span></div>
                                        <div class="blood-option-grid" data-value="B-">B- <span class="blood-drop">🩸</span></div>
                                        <div class="blood-option-grid" data-value="O+">O+ <span class="blood-drop">🩸</span></div>
                                        <div class="blood-option-grid" data-value="O-">O- <span class="blood-drop">🩸</span></div>
                                        <div class="blood-option-grid" data-value="AB+">AB+ <span class="blood-drop">🩸</span></div>
                                        <div class="blood-option-grid" data-value="AB-">AB- <span class="blood-drop">🩸</span></div>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <label>Medical history<textarea placeholder="Enter your history medical"></textarea></label>
                    </div>
                    <div class="form-right">
                        <!-- Custom Insurance Type Select (chuẩn mẫu) -->
                        <label>Insurance type
                            <div class="custom-select-insurance" id="insuranceSelect">
                                <div class="selected-insurance" id="selectedInsurance">Public insurance</div>
                                <input type="hidden" name="insurance_type" id="insuranceTypeInput" value="Public insurance">
                                <div class="insurance-dropdown" id="insuranceDropdown" style="display:none;">
                                    <div class="insurance-dropdown-header">
                                        <span>Insurance type</span>
                                        <span class="insurance-save" id="insuranceSave">Save</span>
                                    </div>
                                    <div class="insurance-options">
                                        <div class="insurance-option" data-value="Public insurance">Public insurance <span class="insurance-tick">&#10003;</span></div>
                                        <div class="insurance-option" data-value="Private insurance">Private insurance <span class="insurance-tick">&#10003;</span></div>
                                        <div class="insurance-option" data-value="Vietnam insurance">Vietnam insurance <span class="insurance-tick">&#10003;</span></div>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <label>Public insurance*<input type="text" placeholder="Enter number"></label>
                        <!-- Custom Assurance type select -->
                        <label>Assurance type
                            <div class="custom-select-assurance" id="assuranceSelect">
                                <div class="selected-assurance" id="selectedAssurance">Choose</div>
                                <input type="hidden" name="assurance_type" id="assuranceTypeInput" value="">
                                <div class="assurance-dropdown" id="assuranceDropdown" style="display:none;">
                                    <div class="assurance-dropdown-header">
                                        <span>Assurance type</span>
                                        <span class="assurance-save" id="assuranceSave">Save</span>
                                    </div>
                                    <div class="assurance-options">
                                        <div class="assurance-option" data-value="Type 1">Type 1 <span class="assurance-tick">&#10003;</span></div>
                                        <div class="assurance-option" data-value="Type 2">Type 2 <span class="assurance-tick">&#10003;</span></div>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <label>Address*<input type="text" placeholder="Enter"></label>
                    </div>
                </div>
                <button type="submit" class="continue-btn">Continue</button>
            </form>
        </div>
    </div>

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
            // Khôi phục lại Blood group select dạng grid
            const bloodSelect = document.getElementById('bloodSelect');
            const selectedBlood = document.getElementById('selectedBlood');
            const bloodDropdown = document.getElementById('bloodDropdown');
            const bloodOptions = bloodDropdown.querySelectorAll('.blood-option-grid');
            const bloodSave = document.getElementById('bloodSave');
            const bloodGroupInput = document.getElementById('bloodGroupInput');
            let bloodCurrent = selectedBlood.textContent.trim();
            let bloodActive = null;

            selectedBlood.addEventListener('click', function(e) {
                bloodDropdown.style.display = 'block';
            });
            bloodOptions.forEach(option => {
                option.addEventListener('click', function() {
                    bloodOptions.forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');
                    bloodCurrent = this.getAttribute('data-value');
                    bloodActive = this;
                });
            });
            bloodSave.addEventListener('click', function() {
                selectedBlood.textContent = bloodCurrent;
                bloodGroupInput.value = bloodCurrent;
                bloodDropdown.style.display = 'none';
                bloodOptions.forEach(opt => opt.classList.remove('saved'));
                if (bloodActive) bloodActive.classList.add('saved');
            });
            document.addEventListener('mousedown', function(e) {
                if (!bloodSelect.contains(e.target)) {
                    bloodDropdown.style.display = 'none';
                    bloodOptions.forEach(opt => opt.classList.remove('active'));
                    const saved = document.querySelector('.blood-option-grid.saved');
                    if (saved) saved.classList.add('active');
                }
            });
        });
    </script>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function initCustomSelect(selectId, selectedId, dropdownId, optionClass, saveId, inputId) {
            const select = document.getElementById(selectId);
            const selected = document.getElementById(selectedId);
            const dropdown = document.getElementById(dropdownId);
            const options = dropdown.querySelectorAll('.' + optionClass);
            const save = document.getElementById(saveId);
            const input = inputId ? document.getElementById(inputId) : null;
            let currentValue = selected.textContent.trim();
            let activeOption = null;

            options.forEach((option) => {
                option.addEventListener('click', function() {
                    options.forEach(opt => {
                        opt.classList.remove('active');
                        opt.classList.remove('saved');
                    });
                    this.classList.add('active');
                    currentValue = this.getAttribute('data-value');
                    activeOption = this;
                });
            });
            selected.addEventListener('click', function(e) {
                dropdown.style.display = 'block';
                options.forEach(opt => opt.classList.remove('active'));
                const saved = dropdown.querySelector('.' + optionClass + '.saved');
                if (saved) saved.classList.add('active');
            });
            save.addEventListener('click', function() {
                selected.textContent = currentValue;
                if (input) input.value = currentValue;
                dropdown.style.display = 'none';
                options.forEach(opt => {
                    opt.classList.remove('saved');
                    opt.classList.remove('active');
                });
                if (activeOption) activeOption.classList.add('saved');
            });
            document.addEventListener('mousedown', function(e) {
                if (!select.contains(e.target)) {
                    dropdown.style.display = 'none';
                    options.forEach(opt => opt.classList.remove('active'));
                }
            });
        }

        // Gender
        initCustomSelect('genderSelect', 'selectedGender', 'genderDropdown', 'gender-option', 'genderSave', 'genderInput');
        // Insurance type
        initCustomSelect('insuranceSelect', 'selectedInsurance', 'insuranceDropdown', 'insurance-option', 'insuranceSave', 'insuranceTypeInput');
        // Assurance type
        initCustomSelect('assuranceSelect', 'selectedAssurance', 'assuranceDropdown', 'assurance-option', 'assuranceSave', 'assuranceTypeInput');
    });
    </script>
    @endpush
@endsection 

