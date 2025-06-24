@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="medlink">
        <div class="medlink_banner_wrapper">
            <div class="medlink_banner_container">
                <div class="medlink_banner_search">
                    <input type="text" class="medlink_banner_input" placeholder="Bác sĩ, bệnh viện, nhà thuốc" />
                </div>

                <div class="medlink_banner_text">
                    <p class="medlink_banner_title">Đặt khám tại <br><span class="medlink_banner_highlight">Medlink
                            Website</span>
                    </p>
                    <p class="medlink_banner_subtitle">Với hơn 1000 bác sĩ, bệnh viện, nhà thuốc</p>
                </div>
            </div>

            <div class="medlink_banner_image">
                <img src="{{ asset('img/medlink_banner_image.png') }}" alt="" />
            </div>
        </div>
        <div class="medlink_content">
            <div>
                <h1 class="medlink_content_title">Đặt lịch khám trực tuyến</h1>
                <p class="medlink_content_desc">Tìm bác sĩ chính xác - Đặt lịch khám dễ dàng</p>
            </div>
            <div class="medlink_content_doctors">
                <h2 class="medlink_content_doctors_title">Danh sách bác sĩ</h2>
                <div class="medlink_content_doctors_list">
                    <div class="medlink_content_doctors_list_prev"><svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                        </svg></div>
                    <div class="medlink_content_doctors_list_items">
                        @foreach ($doctors as $doctor)
                            <div class="medlink_content_doctors_item">
                                <div class="medlink_content_doctors_item_specialty">Cartilaginologist</div>
                                <div class="medlink_content_doctors_item_name">{{ $doctor->name }}</div>

                                <div class="medlink_content_doctors_item_rating">
                                    <span class="medlink_content_doctors_item_star">★</span>
                                    <span>4.5</span>
                                </div>

                                <div class="medlink_content_doctors_item_image">
                                    <img src="{{ asset($doctor->getFilamentAvatarUrl() ?? 'storage/upload/avatar/default.png') }}" alt="{{ $doctor->name }}">
                                </div>

                                <div class="medlink_content_doctors_item_action">
                                    <button class="medlink_content_doctors_item_button">Đặt lịch</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="medlink_content_doctors_list_next"><svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                        </svg></div>
                </div>
            </div>
            <div class="medlink_content_pharmacy_section">
                <h2 class="medlink_content_pharmacy_title">Danh sách nhà thuốc</h2>

                <div class="medlink_content_pharmacy_wrapper">
                    <div class="medlink_content_pharmacy_nav medlink_content_pharmacy_nav_prev">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path
                                d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                        </svg>
                    </div>

                    <div class="medlink_content_pharmacy_list">
                        @foreach ($pharmacies as $pharmacy)
                            <div class="medlink_content_pharmacy_card">
                                <div class="medlink_content_pharmacy_image">
                                    <img src="{{ asset($pharmacy->getFilamentAvatarUrl() ?? 'storage/upload/avatar/default.png') }}" alt="{{ $pharmacy->name }}" />
                                </div>
                                <div class="medlink_content_pharmacy_content">
                                    <div class="medlink_content_pharmacy_logo">
                                        <img src="{{ asset($pharmacy->getFilamentAvatarUrl() ?? 'storage/upload/avatar/default.png') }}" alt="Logo" />
                                    </div>
                                    <div class="medlink_content_pharmacy_name">{{ $pharmacy->name }}</div>
                                    <div class="medlink_content_pharmacy_address">{{ $pharmacy->address }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="medlink_content_pharmacy_nav medlink_content_pharmacy_nav_next">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
@endpush