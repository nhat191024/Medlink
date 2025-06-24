@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    <style>
        /* Custom Phone Input with Dropdown */
        .phone-input-group {
            margin-bottom: 24px;
            max-width: 400px;
            width: 100%;
        }

        .phone-input-group .static-label {
            display: block;
            font-size: 14px;
            color: #333;
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        .phone-input {
            display: flex;
            align-items: center;
        }

        .custom-select {
            position: relative;
            flex-shrink: 0;
        }

        .custom-select::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 28px;
            width: 1px;
            background-color: #e0e0e0;
        }

        .select-selected {
            display: flex;
            align-items: center;
            background-color: #fff;
            border: 1.5px solid #e0e0e0;
            border-right: none;
            border-radius: 16px 0 0 16px;
            cursor: pointer;
            padding: 16px;
            height: 54px;
            box-sizing: border-box;
        }
        
        .select-selected:hover,
        .phone-input input[type="text"]:focus {
            border-color: #DF1D32;
        }
        
        .select-selected .country-flag {
            font-size: 24px;
            margin-right: 8px;
        }

        .select-items {
            position: absolute;
            background-color: white;
            top: 105%;
            left: 0;
            right: 0;
            z-index: 99;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            max-height: 200px;
            overflow-y: auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .select-hide {
            display: none;
        }

        .select-items div {
            padding: 12px 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .select-items div:hover {
            background-color: #f5f5f5;
        }

        .select-items .country-flag {
            font-size: 20px;
            margin-right: 10px;
        }
        
        .select-items .country-name {
            flex-grow: 1;
        }

        .phone-input input[type="text"] {
            flex-grow: 1;
            border-radius: 0 16px 16px 0;
            margin-left: -1px;
            height: 54px;
            padding: 16px;
            border: 1.5px solid #e0e0e0;
            font-size: 16px;
            outline: none;
            box-sizing: border-box;
        }

        .note {
            font-size: 14px;
            color: #666;
            margin: 24px 0;
            text-align: center;
            max-width: 350px;
        }

        .submit-btn {
            display: block;
            width: 100%;
            max-width: 400px;
            background: #111;
            color: #fff;
            font-weight: 500;
            padding: 16px 0;
            border-radius: 16px;
            text-decoration: none;
            text-align: center;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="left">
            <img class="doctor-img" src="{{ asset('img/doctor.webp') }}" alt="Doctor">
        </div>

        <form class="right" method="POST" action="{{ route('forgot-password.send-otp') }}">
            @csrf

            <div class="back-btn-container">
                <a class="back-btn" href="{{ route('login') }}">
                    @svg('heroicon-o-arrow-left', 'back-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                </a>
            </div>

            <!-- Progress Indicator (Hidden for now) -->
            <div class="progress-indicator" id="progressIndicator" style="display: none; visibility: hidden;">
                <div class="progress-circle">
                    <svg viewBox="0 0 50 50">
                        <circle class="progress-bg" cx="25" cy="25" r="20"></circle>
                        <circle class="progress-fill" cx="25" cy="25" r="20" stroke-dasharray="0 125.6" id="progressCircle">
                        </circle>
                    </svg>
                    <div class="progress-number" id="progressNumber">0</div>
                </div>
            </div>

            <div class="icon" style="text-align: center; margin-bottom: 1rem;">
                <img src="{{ asset('img/lock.png') }}" alt="Lock Icon" style="width: 48px; height: auto;">
            </div>

            <h2 style="text-align: center; font-size: 1.5rem; margin-bottom: 0.5rem; font-weight: 600;">Forgot your password?</h2>
            <p class="note" style="margin-top: 0; margin-bottom: 2rem;">Please enter your phone number to receive a verification code</p>

            <div class="phone-input-group">
                <label for="phone" class="static-label">Phone number</label>
                <div class="phone-input">
                    <div class="custom-select">
                        <div class="select-selected" id="selectSelected">
                            <span class="country-flag">🇻🇳</span>
                            <span class="country-code">+84</span>
                        </div>
                        <div class="select-items select-hide" id="selectItems"></div>
                    </div>
                    <select id="country_code" name="country_code" style="display: none;"></select>
                    <input type="text" id="phone" name="phone" placeholder="">
                </div>
            </div>

            <p class="note">
                Don't worry. We won't text you or call you.
            </p>

            <button type="submit" class="submit-btn">Get verification code</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectSelected = document.getElementById('selectSelected');
            const selectItems = document.getElementById('selectItems');
            const hiddenSelect = document.getElementById('country_code');
            let countriesData = [];

            // Fetch countries data from REST Countries API
            fetch('https://restcountries.com/v3.1/all?fields=name,flag,idd')
                .then(response => response.json())
                .then(data => {
                    countriesData = data
                        .filter(country => country.idd && country.idd.root && country.flag)
                        .map(country => ({
                            name: country.name.common,
                            flag: country.flag,
                            code: country.idd.root + (country.idd.suffixes ? (country.idd.suffixes[0] || '') : '')
                        }))
                        .sort((a, b) => a.name.localeCompare(b.name));
                    populateDropdown(countriesData);
                })
                .catch(error => {
                    console.error('Error fetching countries:', error);
                    const fallbackCountries = [
                        { name: 'Vietnam', flag: '🇻🇳', code: '+84' },
                        { name: 'United States', flag: '🇺🇸', code: '+1' },
                    ];
                    populateDropdown(fallbackCountries);
                });

            function populateDropdown(countries) {
                selectItems.innerHTML = '';
                hiddenSelect.innerHTML = '';

                countries.forEach(country => {
                    const div = document.createElement('div');
                    div.innerHTML = `<span class="country-flag">${country.flag}</span> <span class="country-name">${country.name}</span> <span class="country-code">(${country.code})</span>`;
                    div.addEventListener('click', () => selectCountry(country));
                    selectItems.appendChild(div);

                    const option = document.createElement('option');
                    option.value = country.code;
                    option.text = `${country.flag} ${country.code}`;
                    hiddenSelect.appendChild(option);
                });
                const defaultCountry = countries.find(c => c.code === '+84') || countries[0];
                if (defaultCountry) selectCountry(defaultCountry);
            }

            function selectCountry(country) {
                if(selectSelected) {
                    selectSelected.innerHTML = `<span class="country-flag">${country.flag}</span><span class="country-code">${country.code}</span>`;
                }
                if(hiddenSelect) hiddenSelect.value = country.code;
                if(selectItems) selectItems.classList.add('select-hide');
                if(selectSelected) selectSelected.classList.remove('select-arrow-active');
            }

            if(selectSelected) {
                selectSelected.addEventListener('click', (e) => {
                    e.stopPropagation();
                    selectItems.classList.toggle('select-hide');
                    selectSelected.classList.toggle('select-arrow-active');
                });
            }

            document.addEventListener('click', () => {
                if(selectItems) selectItems.classList.add('select-hide');
                if(selectSelected) selectSelected.classList.remove('select-arrow-active');
            });
        });
    </script>
@endpush
