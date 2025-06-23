@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <div class="left">
            <img class="doctor-img" src="{{ asset('img/doctor.webp') }}" alt="Doctor">
        </div>

        <form class="right" method="POST" action="#">
            @csrf

            <div class="back-btn-container">
                <a class="back-btn" href="{{ route('splash') }}">
                    @svg('heroicon-o-arrow-left', 'back-icon', ['style' => 'width: 24px; height: 24px; color: #888;'])
                </a>
            </div>

            <div class="icon">
                <img src="{{ asset('img/dienthoai.png') }}" alt="Điện thoại">
            </div>

            <h2>Enter your phone number</h2>

            <div class="form-group">
                <label for="phone">Phone number</label>
                <div class="phone-input">
                    <div class="custom-select">
                        <div class="select-selected" id="selectSelected">
                            <span class="country-flag">🇻🇳</span>
                            <span class="country-code">+84</span>
                        </div>
                        <div class="select-items select-hide" id="selectItems"></div>
                    </div>
                    <select id="country_code" name="country_code" style="display: none;">
                        <option value="+84">🇻🇳 +84</option>
                        <option value="+228">🇹🇬 +228</option>
                        <option value="+1">🇺🇸 +1</option>
                    </select>
                    <input type="text" id="phone" name="phone" placeholder="456 789 00">
                </div>
            </div>

            <p class="note">
                Don't worry. We won't text you or call you. We'll send you a 4-digit code to confirm your account.
            </p>

            <button type="submit" class="submit-btn">Continue</button>
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
                    // Filter countries that have phone codes and sort by name
                    countriesData = data
                        .filter(country => country.idd && country.idd.root)
                        .map(country => ({
                            name: country.name.common,
                            flag: country.flag,
                            code: country.idd.root + (country.idd.suffixes ? country.idd.suffixes[0] || '' : '')
                        }))
                        .sort((a, b) => a.name.localeCompare(b.name));

                    // Add popular countries first
                    const popularCountries = [
                        { name: 'Vietnam', flag: '🇻🇳', code: '+84' },
                        { name: 'United States', flag: '🇺🇸', code: '+1' },
                        { name: 'United Kingdom', flag: '🇬🇧', code: '+44' },
                        { name: 'China', flag: '🇨🇳', code: '+86' },
                        { name: 'Japan', flag: '🇯🇵', code: '+81' },
                        { name: 'South Korea', flag: '🇰🇷', code: '+82' }
                    ];

                    // Remove duplicates and merge with popular countries
                    const uniqueCountries = popularCountries.concat(
                        countriesData.filter(country =>
                            !popularCountries.some(popular => popular.code === country.code)
                        )
                    );

                    // Populate dropdown
                    populateDropdown(uniqueCountries);
                })
                .catch(error => {
                    console.error('Error fetching countries:', error);
                    // Fallback to basic countries
                    const fallbackCountries = [
                        { name: 'Vietnam', flag: '🇻🇳', code: '+84' },
                        { name: 'United States', flag: '🇺🇸', code: '+1' },
                        { name: 'United Kingdom', flag: '🇬🇧', code: '+44' },
                        { name: 'Togo', flag: '🇹🇬', code: '+228' }
                    ];
                    populateDropdown(fallbackCountries);
                });

            function populateDropdown(countries) {
                selectItems.innerHTML = '';

                countries.forEach(country => {
                    const div = document.createElement('div');
                    div.innerHTML = `
                            <span class="country-flag">${country.flag}</span>
                            <span class="country-name">${country.name}</span>
                            <span class="country-code">${country.code}</span>
                        `;
                    div.addEventListener('click', function () {
                        selectCountry(country);
                    });
                    selectItems.appendChild(div);
                });
            }

            function selectCountry(country) {
                selectSelected.innerHTML = `
                        <span class="country-flag">${country.flag}</span>
                        <span class="country-code">${country.code}</span>
                    `;
                hiddenSelect.value = country.code;
                selectItems.classList.add('select-hide');
                selectSelected.classList.remove('select-arrow-active');
            }

            // Toggle dropdown
            selectSelected.addEventListener('click', function (e) {
                console.log('Dropdown clicked');
                e.stopPropagation();
                selectItems.classList.toggle('select-hide');
                selectSelected.classList.toggle('select-arrow-active');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function () {
                selectItems.classList.add('select-hide');
                selectSelected.classList.remove('select-arrow-active');
            });
        });
    </script>
@endpush
