@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="profile-main-content">
        <div class="profile-form-wrapper">
            <div class="profile-back-btn-container">
                <a class="profile-back-btn" href="{{ route('register.create-account') }}">
                    @svg('heroicon-o-arrow-left', 'back-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                </a>
            </div>

            <!-- Progress Indicator -->
            <div class="profile-progress-indicator" id="progressIndicator">
                <div class="profile-progress-circle">
                    <svg viewBox="0 0 50 50">
                        <circle class="profile-progress-bg" cx="25" cy="25" r="20"></circle>
                        <circle class="profile-progress-fill" cx="25" cy="25" r="20" stroke-dasharray="0 125.6"
                            id="progressCircle"></circle>
                    </svg>
                    <div class="profile-progress-number" id="progressNumber">0</div>
                </div>
            </div>

            <div class="profile-form-title">
                <img src="/img/Closed mailbox with raised flag.png" alt="mailbox icon" class="form-icon"
                    style="width:38px; height:38px; object-fit:contain; display:block; margin:0 auto 8px auto;">
                <h2>{{ __('client/auth.profile.title') }}</h2>
            </div>

            <form class="profile-form">
                <div class="profile-form-columns">
                    <div class="profile-form-left">
                        <label>
                            {{ __('client/auth.profile.full_name') }}*
                            <input type="text" placeholder="{{ __('client/auth.profile.full_name_placeholder') }}" required>
                        </label>
                        <label>
                            {{ __('client/auth.profile.age') }}*
                            <input type="range" min="0" max="150" value="18" class="profile-slider" id="age-slider">
                            <span class="profile-slider-value" id="age-value">
                                {{ __('client/auth.profile.age_prefix') }} 18
                            </span>
                        </label>
                        <label>
                            {{ __('client/auth.profile.gender') }}*
                            <div class="profile-custom-select" id="genderSelect">
                                <div class="profile-selected-option" id="selectedGender">
                                    {{ __('client/auth.profile.gender_choose') }}
                                </div>
                                <input type="hidden" name="gender" id="genderInput" value="">
                                <div class="profile-dropdown" id="genderDropdown" style="display:none;">
                                    <div class="profile-dropdown-header">
                                        <span>{{ __('client/auth.profile.gender') }}</span>
                                        <span class="profile-save-btn"
                                            id="genderSave">{{ __('client/auth.profile.save') }}</span>
                                    </div>
                                    <div class="profile-options">
                                        <div class="profile-option" data-value="Male">
                                            {{ __('client/auth.profile.gender_male') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                        <div class="profile-option" data-value="Female">
                                            {{ __('client/auth.profile.gender_female') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                        <div class="profile-option" data-value="Other">
                                            {{ __('client/auth.profile.gender_other') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <label>
                            {{ __('client/auth.profile.height') }}*
                            <input type="range" min="1.0" max="3.0" step="0.01" value="1.53" class="profile-slider"
                                id="height-slider">
                            <span class="profile-slider-value" id="height-value">
                                {{ __('client/auth.profile.height_prefix') }} 1.53
                                {{ __('client/auth.profile.height_unit') }}
                            </span>
                        </label>
                        <label>
                            {{ __('client/auth.profile.weight') }}*
                            <input type="range" min="30" max="500" value="46" class="profile-slider" id="weight-slider">
                            <span class="profile-slider-value" id="weight-value">
                                {{ __('client/auth.profile.weight_prefix') }} 46 {{ __('client/auth.profile.weight_unit') }}
                            </span>
                        </label>
                        <!-- Custom Blood group select -->
                        <label>
                            {{ __('client/auth.profile.blood_group') }}*
                            <div class="profile-custom-select" id="bloodSelect">
                                <div class="profile-selected-option" id="selectedBlood">
                                    {{ __('client/auth.profile.blood_group_choose') }}
                                </div>
                                <input type="hidden" name="blood_group" id="bloodGroupInput" value="">
                                <div class="profile-dropdown" id="bloodDropdown" style="display:none;">
                                    <div class="profile-dropdown-header">
                                        <span>{{ __('client/auth.profile.blood_group') }}</span>
                                        <span class="profile-save-btn" id="bloodSave">
                                            {{ __('client/auth.profile.save') }}
                                        </span>
                                    </div>
                                    <div class="profile-blood-options-grid">
                                        <div class="profile-blood-option-grid" data-value="A+">A+
                                            <span class="blood-drop">🩸</span>
                                        </div>
                                        <div class="profile-blood-option-grid" data-value="A-">A-
                                            <span class="blood-drop">🩸</span>
                                        </div>
                                        <div class="profile-blood-option-grid" data-value="B+">B+
                                            <span class="blood-drop">🩸</span>
                                        </div>
                                        <div class="profile-blood-option-grid" data-value="B-">B-
                                            <span class="blood-drop">🩸</span>
                                        </div>
                                        <div class="profile-blood-option-grid" data-value="O+">O+
                                            <span class="blood-drop">🩸</span>
                                        </div>
                                        <div class="profile-blood-option-grid" data-value="O-">O-
                                            <span class="blood-drop">🩸</span>
                                        </div>
                                        <div class="profile-blood-option-grid" data-value="AB+">AB+
                                            <span class="blood-drop">🩸</span>
                                        </div>
                                        <div class="profile-blood-option-grid" data-value="AB-">AB-
                                            <span class="blood-drop">🩸</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <label>
                            {{ __('client/auth.profile.medical_history') }}
                            <textarea placeholder="{{ __('client/auth.profile.medical_history_placeholder') }}"></textarea>
                        </label>
                    </div>
                    <div class="profile-form-right">
                        <!-- Custom Insurance Type Select -->
                        <label>
                            {{ __('client/auth.profile.insurance_type') }}
                            <div class="profile-custom-select" id="insuranceSelect">
                                <div class="profile-selected-option" id="selectedInsurance">
                                    {{ __('client/auth.profile.insurance_public') }}
                                </div>
                                <input type="hidden" name="insurance_type" id="insuranceTypeInput"
                                    value="{{ __('client/auth.profile.insurance_public') }}">
                                <div class="profile-dropdown" id="insuranceDropdown" style="display:none;">
                                    <div class="profile-dropdown-header">
                                        <span>{{ __('client/auth.profile.insurance_type') }}</span>
                                        <span class="profile-save-btn" id="insuranceSave">
                                            {{ __('client/auth.profile.save') }}
                                        </span>
                                    </div>
                                    <div class="profile-options">
                                        <div class="profile-option"
                                            data-value="{{ __('client/auth.profile.insurance_public') }}">
                                            {{ __('client/auth.profile.insurance_public') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                        <div class="profile-option"
                                            data-value="{{ __('client/auth.profile.insurance_private') }}">
                                            {{ __('client/auth.profile.insurance_private') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                        <div class="profile-option"
                                            data-value="{{ __('client/auth.profile.insurance_vietnam') }}">
                                            {{ __('client/auth.profile.insurance_vietnam') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <div id="vietnamInsuranceFields" style="display:none; margin-bottom: 16px;">
                            <label>
                                {{ __('client/auth.profile.card_number') }}
                                <input type="text" class="profile-input"
                                    placeholder="{{ __('client/auth.profile.card_number_placeholder') }}">
                            </label>
                            <label>
                                {{ __('client/auth.profile.valid_from') }}
                                <input type="date" class="profile-input">
                            </label>
                            <label>
                                {{ __('client/auth.profile.initial_medical_facility') }}
                                <input type="text" class="profile-input"
                                    placeholder="{{ __('client/auth.profile.facility_placeholder') }}">
                            </label>
                        </div>
                        <label>
                            {{ __('client/auth.profile.public_insurance') }}*
                            <input type="text" placeholder="{{ __('client/auth.profile.public_insurance_placeholder') }}">
                        </label>
                        <!-- Custom Assurance type select -->
                        <label>
                            {{ __('client/auth.profile.assurance_type') }}
                            <div class="profile-custom-select" id="assuranceSelect">
                                <div class="profile-selected-option" id="selectedAssurance">
                                    {{ __('client/auth.profile.assurance_choose') }}
                                </div>
                                <input type="hidden" name="assurance_type" id="assuranceTypeInput" value="">
                                <div class="profile-dropdown" id="assuranceDropdown" style="display:none;">
                                    <div class="profile-dropdown-header">
                                        <span>{{ __('client/auth.profile.assurance_type') }}</span>
                                        <span class="profile-save-btn" id="assuranceSave">
                                            {{ __('client/auth.profile.save') }}
                                        </span>
                                    </div>
                                    <div class="profile-options">
                                        <div class="profile-option"
                                            data-value="{{ __('client/auth.profile.assurance_type1') }}">
                                            {{ __('client/auth.profile.assurance_type1') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                        <div class="profile-option"
                                            data-value="{{ __('client/auth.profile.assurance_type2') }}">
                                            {{ __('client/auth.profile.assurance_type2') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <label id="mainInsuredGroup" style="display:none;">
                            {{ __('client/auth.profile.main_insured') }}
                            <input type="text" placeholder="{{ __('client/auth.profile.main_insured_placeholder') }}">
                        </label>
                        <label id="entitledInsuredGroup" style="display:none;">
                            {{ __('client/auth.profile.entitled_insured') }}
                            <input type="text" placeholder="{{ __('client/auth.profile.entitled_insured_placeholder') }}">
                        </label>
                        <label>
                            {{ __('client/auth.profile.address') }}*
                            <input type="text" placeholder="{{ __('client/auth.profile.address_placeholder') }}">
                        </label>
                    </div>
                </div>
                <button type="submit" class="profile-continue-btn" id="continueBtn">
                    {{ __('client/auth.profile.continue') }}
                </button>
            </form>

            <!-- Popup Overlay & Modal -->
            <div id="requiredFieldsOverlay" class="profile-modal-overlay"></div>
            <div id="requiredFieldsModal" class="profile-modal">
                <div class="profile-modal-icon">
                    <span class="profile-modal-warning">&#9888;</span>
                </div>
                <div class="profile-modal-title">
                    {{ __('client/auth.profile.missing_fields_title') }}
                </div>
                <div class="profile-modal-message">
                    {{ __('client/auth.profile.missing_fields_message') }}
                </div>
                <div class="profile-modal-buttons">
                    <button id="skipBtn" class="profile-modal-skip-btn">{{ __('client/auth.profile.skip') }}</button>
                    <button id="checkBtn" class="profile-modal-check-btn">{{ __('client/auth.profile.check') }}</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Truyền các prefix từ PHP sang JS để tránh lỗi HTML entity
            const agePrefix = @json(__('client/auth.profile.age_prefix'));
            const heightPrefix = @json(__('client/auth.profile.height_prefix'));
            const heightUnit = @json(__('client/auth.profile.height_unit'));
            const weightPrefix = @json(__('client/auth.profile.weight_prefix'));
            const weightUnit = @json(__('client/auth.profile.weight_unit'));
            const genderChoose = @json(__('client/auth.profile.gender_choose'));
            const bloodGroupChoose = @json(__('client/auth.profile.blood_group_choose'));
            const insurancePrivate = @json(__('client/auth.profile.insurance_private'));
            const insuranceVietnam = @json(__('client/auth.profile.insurance_vietnam'));

            // Progress Indicator function
            function initProgressIndicator(currentStep, totalSteps = 5) {
                const circle = document.getElementById('progressCircle');
                const numberEl = document.getElementById('progressNumber');
                const circumference = 2 * Math.PI * 20; // radius = 20

                // Calculate progress percentage
                const progress = (currentStep / totalSteps) * 100;
                const strokeDasharray = (progress / 100) * circumference;

                // Animate from previous step
                setTimeout(() => {
                    // Animate circle
                    circle.style.strokeDasharray = `${strokeDasharray} ${circumference}`;

                    // Animate number
                    numberEl.textContent = currentStep;
                    numberEl.classList.add('animate');

                    // Remove animation class after animation completes
                    setTimeout(() => {
                        numberEl.classList.remove('animate');
                    }, 600);
                }, 300);
            }

            function initCustomSelect(selectId, selectedId, dropdownId, optionClass, saveId, inputId) {
                const select = document.getElementById(selectId);
                const selected = document.getElementById(selectedId);
                const dropdown = document.getElementById(dropdownId);
                const save = document.getElementById(saveId);
                const input = inputId ? document.getElementById(inputId) : null;
                let savedValue = selected.textContent.trim();
                let currentValue = savedValue;

                // Event delegation cho options thay vì add listener cho từng option
                dropdown.addEventListener('click', function (e) {
                    const option = e.target.closest('.' + optionClass);
                    if (option) {
                        // Remove active/saved classes from all options
                        const options = dropdown.querySelectorAll('.' + optionClass);
                        options.forEach(opt => {
                            opt.classList.remove('active', 'saved');
                        });
                        // Add active class to clicked option
                        option.classList.add('active');
                        currentValue = option.getAttribute('data-value');
                    }
                });

                // Khi mở dropdown
                selected.addEventListener('click', function (e) {
                    dropdown.style.display = 'block';
                    const options = dropdown.querySelectorAll('.' + optionClass);
                    options.forEach(opt => {
                        opt.classList.remove('active', 'saved');
                        if (opt.getAttribute('data-value') === savedValue) {
                            opt.classList.add('saved');
                        }
                    });
                });

                // Khi Save
                save.addEventListener('click', function () {
                    savedValue = currentValue;
                    selected.textContent = savedValue;
                    if (input) input.value = savedValue;
                    dropdown.style.display = 'none';
                    const options = dropdown.querySelectorAll('.' + optionClass);
                    options.forEach(opt => {
                        opt.classList.remove('active', 'saved');
                        if (opt.getAttribute('data-value') === savedValue) {
                            opt.classList.add('saved');
                        }
                    });
                });

                // Store reference to avoid creating new functions each time
                select._closeHandler = function (e) {
                    if (!select.contains(e.target)) {
                        dropdown.style.display = 'none';
                        const options = dropdown.querySelectorAll('.' + optionClass);
                        options.forEach(opt => opt.classList.remove('active'));
                    }
                };
            }

            document.addEventListener('DOMContentLoaded', function () {
                // Initialize progress indicator
                initProgressIndicator(4); // Step 4 for profile page

                // Slider elements cache
                const sliders = {
                    age: {
                        slider: document.getElementById('age-slider'),
                        value: document.getElementById('age-value'),
                        update: function (val) {
                            this.value.textContent = agePrefix + ' ' + val;
                        }
                    },
                    height: {
                        slider: document.getElementById('height-slider'),
                        value: document.getElementById('height-value'),
                        update: function (val) {
                            this.value.textContent = heightPrefix + ' ' + parseFloat(val).toFixed(2) + ' ' + heightUnit;
                        }
                    },
                    weight: {
                        slider: document.getElementById('weight-slider'),
                        value: document.getElementById('weight-value'),
                        update: function (val) {
                            this.value.textContent = weightPrefix + ' ' + val + ' ' + weightUnit;
                        }
                    }
                };

                // Single event delegation for all sliders
                Object.keys(sliders).forEach(key => {
                    const slider = sliders[key];
                    if (slider.slider && slider.value) {
                        slider.slider.addEventListener('input', function () {
                            slider.update(this.value);
                        });
                    }
                });

                // Initialize custom selects
                const customSelects = [
                    ['genderSelect', 'selectedGender', 'genderDropdown', 'profile-option', 'genderSave', 'genderInput'],
                    ['insuranceSelect', 'selectedInsurance', 'insuranceDropdown', 'profile-option', 'insuranceSave', 'insuranceTypeInput'],
                    ['assuranceSelect', 'selectedAssurance', 'assuranceDropdown', 'profile-option', 'assuranceSave', 'assuranceTypeInput'],
                    ['bloodSelect', 'selectedBlood', 'bloodDropdown', 'profile-blood-option-grid', 'bloodSave', 'bloodGroupInput']
                ];

                customSelects.forEach(config => {
                    initCustomSelect(...config);
                });

                // Single global click handler for closing dropdowns
                document.addEventListener('mousedown', function (e) {
                    customSelects.forEach(config => {
                        const select = document.getElementById(config[0]);
                        const dropdown = document.getElementById(config[2]);
                        if (select && dropdown && !select.contains(e.target)) {
                            dropdown.style.display = 'none';
                            const options = dropdown.querySelectorAll('.' + config[3]);
                            options.forEach(opt => opt.classList.remove('active'));
                        }
                    });
                });

                // Insurance fields toggle logic - cached elements
                const insuranceElements = {
                    selectedInsurance: document.getElementById('selectedInsurance'),
                    mainInsuredGroup: document.getElementById('mainInsuredGroup'),
                    entitledInsuredGroup: document.getElementById('entitledInsuredGroup'),
                    vietnamInsuranceFields: document.getElementById('vietnamInsuranceFields'),
                    insuranceDropdown: document.getElementById('insuranceDropdown'),
                    insuranceSave: document.getElementById('insuranceSave')
                };

                function toggleInsuredFields() {
                    const isPrivate = insuranceElements.selectedInsurance.textContent.trim() === insurancePrivate;
                    const display = isPrivate ? '' : 'none';
                    insuranceElements.mainInsuredGroup.style.display = display;
                    insuranceElements.entitledInsuredGroup.style.display = display;
                }

                function toggleVietnamInsuranceFields() {
                    const isVietnam = insuranceElements.selectedInsurance.textContent.trim() === insuranceVietnam;
                    insuranceElements.vietnamInsuranceFields.style.display = isVietnam ? '' : 'none';
                }

                function updateInsuranceFields() {
                    toggleInsuredFields();
                    toggleVietnamInsuranceFields();
                }

                // Initialize insurance fields
                updateInsuranceFields();

                // Single handler for insurance changes
                [insuranceElements.insuranceDropdown, insuranceElements.insuranceSave].forEach(element => {
                    if (element) {
                        element.addEventListener('click', () => setTimeout(updateInsuranceFields, 10));
                    }
                });

                // Form validation popup logic - cached elements
                const formElements = {
                    continueBtn: document.getElementById('continueBtn'),
                    form: document.querySelector('.profile-form'),
                    overlay: document.getElementById('requiredFieldsOverlay'),
                    modal: document.getElementById('requiredFieldsModal'),
                    skipBtn: document.getElementById('skipBtn'),
                    checkBtn: document.getElementById('checkBtn')
                };

                function showRequiredFieldsModal() {
                    formElements.overlay.style.display = 'block';
                    formElements.modal.style.display = 'block';
                }

                function hideRequiredFieldsModal() {
                    formElements.overlay.style.display = 'none';
                    formElements.modal.style.display = 'none';
                }

                // Form validation
                if (formElements.continueBtn && formElements.form) {
                    formElements.continueBtn.addEventListener('click', function (e) {
                        // Cache DOM queries
                        const requiredInputs = formElements.form.querySelectorAll('input[required], textarea[required]');
                        const gender = document.getElementById('selectedGender');
                        const blood = document.getElementById('selectedBlood');

                        // Validate required fields
                        let valid = Array.from(requiredInputs).every(input =>
                            input.value && input.value.trim() !== ''
                        );

                        // Validate custom selects
                        if (gender && (gender.textContent.trim() === genderChoose || gender.textContent.trim() === '')) valid = false;
                        if (blood && (blood.textContent.trim() === bloodGroupChoose || blood.textContent.trim() === '')) valid = false;

                        if (!valid) {
                            e.preventDefault();
                            showRequiredFieldsModal();
                        }
                    });
                }

                // Modal button handlers
                if (formElements.skipBtn) {
                    formElements.skipBtn.addEventListener('click', function () {
                        hideRequiredFieldsModal();
                        window.location.href = '/register-flow/avatar';
                    });
                }

                if (formElements.checkBtn) {
                    formElements.checkBtn.addEventListener('click', hideRequiredFieldsModal);
                }

                if (formElements.overlay) {
                    formElements.overlay.addEventListener('click', hideRequiredFieldsModal);
                }
            });
        </script>
    @endpush
@endsection