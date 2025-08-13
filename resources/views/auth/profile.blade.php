@extends('layouts.app-no-layout')

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

            <div id="progressIndicator" class="progress-indicator">
                <div class="progress-circle">
                    <svg viewBox="0 0 50 50">
                        <circle class="progress-bg" cx="25" cy="25" r="20"></circle>
                        <circle id="progressCircle" class="progress-fill" cx="25" cy="25" r="20" stroke-dasharray="0 125.6">
                        </circle>
                    </svg>
                    <div id="progressNumber" class="progress-number">1</div>
                </div>
            </div>

            <div class="profile-form-title">
                <img class="form-icon" src="/img/Closed mailbox with raised flag.png" alt="mailbox icon" style="width:38px; height:38px; object-fit:contain; display:block; margin:0 auto 8px auto;">
                <h2>{{ __('client/auth.profile.title') }}</h2>
            </div>

            <form class="profile-form" action="{{ route('register.profile.submit') }}" method="POST">
                @csrf
                <div class="profile-form-columns">
                    <div class="profile-form-left">
                        <label>
                            {{ __('client/auth.profile.full_name') }}*
                            <input name="full_name" type="text" required placeholder="{{ __('client/auth.profile.full_name_placeholder') }}">
                        </label>
                        <label>
                            {{ __('client/auth.profile.age') }}*
                            <input id="age-slider" class="profile-slider" name="age" type="range" value="18" min="0" max="150">
                            <span id="age-value" class="profile-slider-value">
                                {{ __('client/auth.profile.age_prefix') }} 18
                            </span>
                        </label>
                        <label>
                            {{ __('client/auth.profile.gender') }}*
                            <div id="genderSelect" class="profile-custom-select">
                                <div id="selectedGender" class="profile-selected-option">
                                    {{ __('client/auth.profile.gender_choose') }}
                                </div>
                                <input id="genderInput" name="gender" type="hidden" value="">
                                <div id="genderDropdown" class="profile-dropdown" style="display:none;">
                                    <div class="profile-dropdown-header">
                                        <span>{{ __('client/auth.profile.gender') }}</span>
                                        <span id="genderSave" class="profile-save-btn">{{ __('client/auth.profile.save') }}</span>
                                    </div>
                                    <div class="profile-options">
                                        <div class="profile-option" data-value="male">
                                            {{ __('client/auth.profile.gender_male') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                        <div class="profile-option" data-value="female">
                                            {{ __('client/auth.profile.gender_female') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                        <div class="profile-option" data-value="other">
                                            {{ __('client/auth.profile.gender_other') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <label>
                            {{ __('client/auth.profile.height') }}*
                            <input id="height-slider" class="profile-slider" name="height" type="range" value="1.53" min="1.0" max="3.0" step="0.01">
                            <span id="height-value" class="profile-slider-value">
                                {{ __('client/auth.profile.height_prefix') }} 1.53
                                {{ __('client/auth.profile.height_unit') }}
                            </span>
                        </label>
                        <label>
                            {{ __('client/auth.profile.weight') }}*
                            <input id="weight-slider" class="profile-slider" name="weight" type="range" value="46" min="30" max="500">
                            <span id="weight-value" class="profile-slider-value">
                                {{ __('client/auth.profile.weight_prefix') }} 46 {{ __('client/auth.profile.weight_unit') }}
                            </span>
                        </label>
                        <!-- Custom Blood group select -->
                        <label>
                            {{ __('client/auth.profile.blood_group') }}*
                            <div id="bloodSelect" class="profile-custom-select">
                                <div id="selectedBlood" class="profile-selected-option">
                                    {{ __('client/auth.profile.blood_group_choose') }}
                                </div>
                                <input id="bloodGroupInput" name="blood_group" type="hidden" value="">
                                <div id="bloodDropdown" class="profile-dropdown" style="display:none;">
                                    <div class="profile-dropdown-header">
                                        <span>{{ __('client/auth.profile.blood_group') }}</span>
                                        <span id="bloodSave" class="profile-save-btn">
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
                            <textarea name="medical_history" placeholder="{{ __('client/auth.profile.medical_history_placeholder') }}"></textarea>
                        </label>
                    </div>
                    <div class="profile-form-right">
                        <!-- Custom Insurance Type Select -->
                        <label>
                            {{ __('client/auth.profile.insurance_type') }}
                            <div id="insuranceSelect" class="profile-custom-select">
                                <div id="selectedInsurance" class="profile-selected-option">
                                    {{ __('client/auth.profile.insurance_public') }}
                                </div>
                                <input id="insuranceTypeInput" name="insurance_type" type="hidden" value="public">
                                <div id="insuranceDropdown" class="profile-dropdown" style="display:none;">
                                    <div class="profile-dropdown-header">
                                        <span>{{ __('client/auth.profile.insurance_type') }}</span>
                                        <span id="insuranceSave" class="profile-save-btn">
                                            {{ __('client/auth.profile.save') }}
                                        </span>
                                    </div>
                                    <div class="profile-options">
                                        <div class="profile-option" data-value="public">
                                            {{ __('client/auth.profile.insurance_public') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                        <div class="profile-option" data-value="private">
                                            {{ __('client/auth.profile.insurance_private') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                        <div class="profile-option" data-value="vietnamese">
                                            {{ __('client/auth.profile.insurance_vietnam') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <label>
                            {{ __('client/auth.profile.insurance_number') }}*
                            <input class="profile-input" name="insurance_number" type="text" required placeholder="{{ __('client/auth.profile.insurance_number_placeholder') }}">
                        </label>
                        <div id="vietnamInsuranceFields" style="display:none; margin-bottom: 16px;">
                            <label>
                                {{ __('client/auth.profile.valid_from') }}
                                <input class="profile-input" name="valid_from" type="date">
                            </label>
                            <label>
                                {{ __('client/auth.profile.registry') }}
                                <input class="profile-input" name="registry" type="text" placeholder="{{ __('client/auth.profile.registry_placeholder') }}">
                            </label>
                            <label>
                                {{ __('client/auth.profile.registered_address') }}
                                <input class="profile-input" name="registered_address" type="text" placeholder="{{ __('client/auth.profile.registered_address_placeholder') }}">
                            </label>
                        </div>
                        <!-- Custom Assurance type select -->
                        <label id="assuranceTypeGroup">
                            {{ __('client/auth.profile.assurance_type') }}
                            <div id="assuranceSelect" class="profile-custom-select">
                                <div id="selectedAssurance" class="profile-selected-option">
                                    {{ __('client/auth.profile.assurance_choose') }}
                                </div>
                                <input id="assuranceTypeInput" name="assurance_type" type="hidden" value="">
                                <div id="assuranceDropdown" class="profile-dropdown" style="display:none;">
                                    <div class="profile-dropdown-header">
                                        <span>{{ __('client/auth.profile.assurance_type') }}</span>
                                        <span id="assuranceSave" class="profile-save-btn">
                                            {{ __('client/auth.profile.save') }}
                                        </span>
                                    </div>
                                    <div class="profile-options">
                                        <div class="profile-option" data-value="life_basic">
                                            {{ __('client/auth.profile.assurances_type_option_1') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                        <div class="profile-option" data-value="life_premium">
                                            {{ __('client/auth.profile.assurances_type_option_2') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                        <div class="profile-option" data-value="togo_c12_basic">
                                            {{ __('client/auth.profile.assurances_type_option_3') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                        <div class="profile-option" data-value="togo_b18_premium">
                                            {{ __('client/auth.profile.assurances_type_option_4') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                        <div class="profile-option" data-value="senior_a1">
                                            {{ __('client/auth.profile.assurances_type_option_5') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                        <div class="profile-option" data-value="senior_b2">
                                            {{ __('client/auth.profile.assurances_type_option_6') }}
                                            <span class="profile-tick">&#10003;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <label id="mainInsuredGroup" style="display:none;">
                            {{ __('client/auth.profile.main_insured') }}
                            <input name="main_insured" type="text" placeholder="{{ __('client/auth.profile.main_insured_placeholder') }}">
                        </label>
                        <label id="entitledInsuredGroup" style="display:none;">
                            {{ __('client/auth.profile.entitled_insured') }}
                            <input name="entitled_insured" type="text" placeholder="{{ __('client/auth.profile.entitled_insured_placeholder') }}">
                        </label>
                        <label>
                            {{ __('client/auth.profile.address') }}*
                            <input name="address" type="text" required placeholder="{{ __('client/auth.profile.address_placeholder') }}">
                        </label>
                    </div>
                </div>
                <button id="continueBtn" class="profile-continue-btn" type="submit">
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
            // Configuration object for better maintainability
            const ProfileConfig = {
                translations: {
                    agePrefix: @json(__('client/auth.profile.age_prefix')),
                    heightPrefix: @json(__('client/auth.profile.height_prefix')),
                    heightUnit: @json(__('client/auth.profile.height_unit')),
                    weightPrefix: @json(__('client/auth.profile.weight_prefix')),
                    weightUnit: @json(__('client/auth.profile.weight_unit')),
                    genderChoose: @json(__('client/auth.profile.gender_choose')),
                    bloodGroupChoose: @json(__('client/auth.profile.blood_group_choose')),
                    insurancePublic: @json(__('client/auth.profile.insurance_public')),
                    insurancePrivate: @json(__('client/auth.profile.insurance_private')),
                    insuranceVietnam: @json(__('client/auth.profile.insurance_vietnam'))
                },
                genderMapping: {
                    'male': @json(__('client/auth.profile.gender_male')),
                    'female': @json(__('client/auth.profile.gender_female')),
                    'other': @json(__('client/auth.profile.gender_other'))
                },
                insuranceMapping: {
                    'public': @json(__('client/auth.profile.insurance_public')),
                    'private': @json(__('client/auth.profile.insurance_private')),
                    'vietnamese': @json(__('client/auth.profile.insurance_vietnam'))
                },
                assuranceMapping: {
                    'life_basic': @json(__('client/auth.profile.assurances_type_option_1')),
                    'life_premium': @json(__('client/auth.profile.assurances_type_option_2')),
                    'togo_c12_basic': @json(__('client/auth.profile.assurances_type_option_3')),
                    'togo_b18_premium': @json(__('client/auth.profile.assurances_type_option_4')),
                    'senior_a1': @json(__('client/auth.profile.assurances_type_option_5')),
                    'senior_b2': @json(__('client/auth.profile.assurances_type_option_6'))
                },
                elements: {},
                customSelects: [],
                initialized: false
            };

            // Cache DOM elements for better performance
            function cacheElements() {
                ProfileConfig.elements = {
                    // Progress elements
                    progressCircle: document.getElementById('progressCircle'),
                    progressNumber: document.getElementById('progressNumber'),

                    // Slider elements
                    ageSlider: document.getElementById('age-slider'),
                    ageValue: document.getElementById('age-value'),
                    heightSlider: document.getElementById('height-slider'),
                    heightValue: document.getElementById('height-value'),
                    weightSlider: document.getElementById('weight-slider'),
                    weightValue: document.getElementById('weight-value'),

                    // Insurance elements
                    selectedInsurance: document.getElementById('selectedInsurance'),
                    mainInsuredGroup: document.getElementById('mainInsuredGroup'),
                    entitledInsuredGroup: document.getElementById('entitledInsuredGroup'),
                    vietnamInsuranceFields: document.getElementById('vietnamInsuranceFields'),
                    assuranceTypeGroup: document.getElementById('assuranceTypeGroup'),
                    insuranceDropdown: document.getElementById('insuranceDropdown'),
                    insuranceSave: document.getElementById('insuranceSave'),

                    // Form validation elements
                    continueBtn: document.getElementById('continueBtn'),
                    form: document.querySelector('.profile-form'),
                    overlay: document.getElementById('requiredFieldsOverlay'),
                    modal: document.getElementById('requiredFieldsModal'),
                    skipBtn: document.getElementById('skipBtn'),
                    checkBtn: document.getElementById('checkBtn'),

                    // Custom select elements
                    selectedGender: document.getElementById('selectedGender'),
                    selectedBlood: document.getElementById('selectedBlood')
                };
            }

            // Optimized progress indicator
            function initProgressIndicator(currentStep, totalSteps = 5) {
                const {
                    progressCircle,
                    progressNumber
                } = ProfileConfig.elements;
                if (!progressCircle || !progressNumber) return;

                const circumference = 125.6; // 2 * Math.PI * 20
                const progress = (currentStep / totalSteps) * 100;
                const strokeDasharray = (progress / 100) * circumference;

                // Use requestAnimationFrame for smooth animation
                requestAnimationFrame(() => {
                    progressCircle.style.strokeDasharray = `${strokeDasharray} ${circumference}`;
                    progressNumber.textContent = currentStep;
                    progressNumber.classList.add('animate');

                    setTimeout(() => progressNumber.classList.remove('animate'), 600);
                });
            }

            // Optimized slider handlers
            function initSliders() {
                const sliders = [{
                        element: ProfileConfig.elements.ageSlider,
                        display: ProfileConfig.elements.ageValue,
                        update: (val) => `${ProfileConfig.translations.agePrefix} ${val}`
                    },
                    {
                        element: ProfileConfig.elements.heightSlider,
                        display: ProfileConfig.elements.heightValue,
                        update: (val) => `${ProfileConfig.translations.heightPrefix} ${parseFloat(val).toFixed(2)} ${ProfileConfig.translations.heightUnit}`
                    },
                    {
                        element: ProfileConfig.elements.weightSlider,
                        display: ProfileConfig.elements.weightValue,
                        update: (val) => `${ProfileConfig.translations.weightPrefix} ${val} ${ProfileConfig.translations.weightUnit}`
                    }
                ];

                sliders.forEach(({
                    element,
                    display,
                    update
                }) => {
                    if (element && display) {
                        element.addEventListener('input', (e) => {
                            display.textContent = update(e.target.value);
                        });
                    }
                });
            }

            // Optimized custom select implementation
            function initCustomSelect(config) {
                const {
                    selectId,
                    selectedId,
                    dropdownId,
                    optionClass,
                    saveId,
                    inputId
                } = config;

                const elements = {
                    select: document.getElementById(selectId),
                    selected: document.getElementById(selectedId),
                    dropdown: document.getElementById(dropdownId),
                    save: document.getElementById(saveId),
                    input: inputId ? document.getElementById(inputId) : null
                };

                if (!elements.select || !elements.selected || !elements.dropdown) return null;

                let savedValue = elements.selected.textContent.trim();
                let currentValue = savedValue;

                // Special handling for mapped selects
                const isInsuranceSelect = selectId === 'insuranceSelect';
                const isGenderSelect = selectId === 'genderSelect';
                const isAssuranceSelect = selectId === 'assuranceSelect';
                const isMappedSelect = isInsuranceSelect || isGenderSelect || isAssuranceSelect;

                // Use event delegation for better performance
                elements.dropdown.addEventListener('click', (e) => {
                    const option = e.target.closest(`.${optionClass}`);
                    if (!option) return;

                    // Remove active/saved classes efficiently
                    elements.dropdown.querySelectorAll(`.${optionClass}`).forEach(opt => {
                        opt.classList.remove('active', 'saved');
                    });

                    option.classList.add('active');
                    currentValue = option.getAttribute('data-value');
                });

                elements.selected.addEventListener('click', () => {
                    elements.dropdown.style.display = 'block';
                    elements.dropdown.querySelectorAll(`.${optionClass}`).forEach(opt => {
                        opt.classList.remove('active', 'saved');
                        if (isMappedSelect) {
                            // For mapped selects, compare with mapped value
                            const optionValue = opt.getAttribute('data-value');
                            let mappedValue;
                            if (isInsuranceSelect) {
                                mappedValue = ProfileConfig.insuranceMapping[optionValue];
                            } else if (isGenderSelect) {
                                mappedValue = ProfileConfig.genderMapping[optionValue];
                            } else if (isAssuranceSelect) {
                                mappedValue = ProfileConfig.assuranceMapping[optionValue];
                            }
                            if (mappedValue === savedValue) {
                                opt.classList.add('saved');
                            }
                        } else {
                            if (opt.getAttribute('data-value') === savedValue) {
                                opt.classList.add('saved');
                            }
                        }
                    });
                });

                if (elements.save) {
                    elements.save.addEventListener('click', () => {
                        if (isMappedSelect) {
                            // For mapped selects, show translated text but save the key
                            let mappedValue;
                            if (isInsuranceSelect) {
                                mappedValue = ProfileConfig.insuranceMapping[currentValue];
                            } else if (isGenderSelect) {
                                mappedValue = ProfileConfig.genderMapping[currentValue];
                            } else if (isAssuranceSelect) {
                                mappedValue = ProfileConfig.assuranceMapping[currentValue];
                            }

                            if (mappedValue) {
                                savedValue = mappedValue;
                                elements.selected.textContent = savedValue;
                                if (elements.input) elements.input.value = currentValue; // Save the key
                            }
                        } else {
                            savedValue = currentValue;
                            elements.selected.textContent = savedValue;
                            if (elements.input) elements.input.value = savedValue;
                        }

                        elements.dropdown.style.display = 'none';

                        elements.dropdown.querySelectorAll(`.${optionClass}`).forEach(opt => {
                            opt.classList.remove('active', 'saved');
                            if (isMappedSelect) {
                                const optionValue = opt.getAttribute('data-value');
                                if (optionValue === currentValue) {
                                    opt.classList.add('saved');
                                }
                            } else {
                                if (opt.getAttribute('data-value') === savedValue) {
                                    opt.classList.add('saved');
                                }
                            }
                        });
                    });
                }

                return {
                    elements,
                    savedValue,
                    currentValue
                };
            }

            // Optimized insurance field management
            function initInsuranceFields() {
                const {
                    selectedInsurance,
                    mainInsuredGroup,
                    entitledInsuredGroup,
                    vietnamInsuranceFields,
                    assuranceTypeGroup
                } = ProfileConfig.elements;
                if (!selectedInsurance) return;

                function updateInsuranceFields() {
                    const selectedText = selectedInsurance.textContent.trim();
                    const isPrivate = selectedText === ProfileConfig.translations.insurancePrivate;
                    const isVietnam = selectedText === ProfileConfig.translations.insuranceVietnam;

                    // Batch DOM updates
                    if (mainInsuredGroup) mainInsuredGroup.style.display = isPrivate ? '' : 'none';
                    if (entitledInsuredGroup) entitledInsuredGroup.style.display = isPrivate ? '' : 'none';
                    if (vietnamInsuranceFields) vietnamInsuranceFields.style.display = isVietnam ? '' : 'none';
                    if (assuranceTypeGroup) assuranceTypeGroup.style.display = isVietnam ? 'none' : '';
                }

                // Use debounced updates
                let updateTimeout;

                function debouncedUpdate() {
                    clearTimeout(updateTimeout);
                    updateTimeout = setTimeout(updateInsuranceFields, 10);
                }

                // Initial setup
                updateInsuranceFields();

                // Attach listeners
                [ProfileConfig.elements.insuranceDropdown, ProfileConfig.elements.insuranceSave].forEach(element => {
                    if (element) element.addEventListener('click', debouncedUpdate);
                });
            }

            // Optimized form validation
            function initFormValidation() {
                const {
                    continueBtn,
                    form,
                    overlay,
                    modal,
                    skipBtn,
                    checkBtn,
                    selectedGender,
                    selectedBlood
                } = ProfileConfig.elements;
                if (!continueBtn || !form) return;

                function showModal() {
                    if (overlay) overlay.style.display = 'block';
                    if (modal) modal.style.display = 'block';
                }

                function hideModal() {
                    if (overlay) overlay.style.display = 'none';
                    if (modal) modal.style.display = 'none';
                }

                function validateForm() {
                    const requiredInputs = form.querySelectorAll('input[required], textarea[required]');

                    // Check required fields
                    const isValidInputs = Array.from(requiredInputs).every(input =>
                        input.value && input.value.trim() !== ''
                    );

                    // Check custom selects
                    const isValidGender = !selectedGender ||
                        (selectedGender.textContent.trim() !== ProfileConfig.translations.genderChoose &&
                            selectedGender.textContent.trim() !== '');

                    const isValidBlood = !selectedBlood ||
                        (selectedBlood.textContent.trim() !== ProfileConfig.translations.bloodGroupChoose &&
                            selectedBlood.textContent.trim() !== '');

                    return isValidInputs && isValidGender && isValidBlood;
                }

                continueBtn.addEventListener('click', (e) => {
                    if (!validateForm()) {
                        e.preventDefault();
                        showModal();
                    }
                });

                // Modal event listeners
                if (skipBtn) {
                    skipBtn.addEventListener('click', () => {
                        hideModal();
                        window.location.href = '/register-flow/avatar';
                    });
                }

                if (checkBtn) checkBtn.addEventListener('click', hideModal);
                if (overlay) overlay.addEventListener('click', hideModal);
            }

            // Global click handler for dropdown closing
            function initGlobalClickHandler() {
                document.addEventListener('mousedown', (e) => {
                    ProfileConfig.customSelects.forEach(selectConfig => {
                        if (!selectConfig || !selectConfig.elements) return;

                        const {
                            select,
                            dropdown
                        } = selectConfig.elements;
                        if (select && dropdown && !select.contains(e.target)) {
                            dropdown.style.display = 'none';
                            dropdown.querySelectorAll('.profile-option, .profile-blood-option-grid').forEach(opt => {
                                opt.classList.remove('active');
                            });
                        }
                    });
                });
            }

            // Main initialization function
            function initProfile() {
                if (ProfileConfig.initialized) return;

                cacheElements();
                initProgressIndicator(4);
                initSliders();

                // Initialize custom selects
                const selectConfigs = [{
                        selectId: 'genderSelect',
                        selectedId: 'selectedGender',
                        dropdownId: 'genderDropdown',
                        optionClass: 'profile-option',
                        saveId: 'genderSave',
                        inputId: 'genderInput'
                    },
                    {
                        selectId: 'insuranceSelect',
                        selectedId: 'selectedInsurance',
                        dropdownId: 'insuranceDropdown',
                        optionClass: 'profile-option',
                        saveId: 'insuranceSave',
                        inputId: 'insuranceTypeInput'
                    },
                    {
                        selectId: 'assuranceSelect',
                        selectedId: 'selectedAssurance',
                        dropdownId: 'assuranceDropdown',
                        optionClass: 'profile-option',
                        saveId: 'assuranceSave',
                        inputId: 'assuranceTypeInput'
                    },
                    {
                        selectId: 'bloodSelect',
                        selectedId: 'selectedBlood',
                        dropdownId: 'bloodDropdown',
                        optionClass: 'profile-blood-option-grid',
                        saveId: 'bloodSave',
                        inputId: 'bloodGroupInput'
                    }
                ];

                ProfileConfig.customSelects = selectConfigs.map(initCustomSelect).filter(Boolean);

                initInsuranceFields();
                initFormValidation();
                initGlobalClickHandler();

                ProfileConfig.initialized = true;
            }

            // Initialize when DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initProfile);
            } else {
                initProfile();
            }
        </script>
    @endpush
@endsection
