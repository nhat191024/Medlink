@extends('layouts.app')

@push('styles')
    <style>
        .search-page-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        /* Search Section */
        .search-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .search-bar {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }

        .search-btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 8px 18px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .search-input {
            width: 400px;
            padding: 12px 20px 12px 45px;
            border: 2px solid #e5e7eb;
            border-radius: 25px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s;
        }

        .search-input:focus {
            border-color: #dc2626;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        /* Filter Buttons */
        .filter-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 8px 20px;
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            background: white;
            color: #6b7280;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-btn.active {
            background: #dc2626;
            color: white;
            border-color: #dc2626;
        }

        .filter-btn:hover:not(.active) {
            border-color: #dc2626;
            color: #dc2626;
        }

        /* Main Content */
        .main-content {
            margin-top: 40px;
        }

        .section-title {
            font-size: 24px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 30px;
        }

        /* Doctor Cards Grid */
        .doctors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .doctor-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .doctor-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .doctor-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }

        .doctor-info {
            flex: 1;
        }

        .doctor-name {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
            margin: 0 0 5px 0;
        }

        .doctor-specialty {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .star {
            color: #fbbf24;
            font-size: 16px;
        }

        .rating-number {
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
        }

        .favorite-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            cursor: pointer;
            color: #d1d5db;
            font-size: 20px;
            transition: color 0.3s;
        }

        .favorite-btn:hover,
        .favorite-btn.active {
            color: #dc2626;
        }

        .card-details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
            padding-top: 15px;
            border-top: 1px solid #f3f4f6;
        }

        .detail-item {
            text-align: center;
        }

        .detail-label {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .detail-value {
            font-size: 14px;
            font-weight: 500;
            color: #111827;
        }

        .detail-value.available {
            color: #059669;
        }

        .detail-value.not-available {
            color: #dc2626;
        }

        .book-btn {
            width: 100%;
            padding: 12px;
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .book-btn:hover {
            background: #b91c1c;
        }

        .book-btn:disabled {
            background: #d1d5db;
            cursor: not-allowed;
        }



        /* Responsive Design */
        @media (max-width: 768px) {
            .search-input {
                width: 300px;
            }

            .doctors-grid {
                grid-template-columns: 1fr;
            }

            .filter-buttons {
                justify-content: center;
            }

            .card-details {
                grid-template-columns: 1fr;
                gap: 10px;
            }
        }

        .empty-text {
            text-align: center;
            font-size: 18px;
            color: #6b7280;
            margin-top: 50px;
        }
    </style>
@endpush

@section('content')
    <div class="search-page-container">
        <!-- Search Section -->
        <div class="search-section">
            <form id="search-form">
                <div class="search-bar">
                    <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text" class="search-input" placeholder="Search..." name="q"
                        value="{{ request('q') }}">
                    <button type="submit" class="search-btn">
                        Search
                    </button>
                </div>


                <div class="filter-buttons">
                    <input type="hidden" name="identity" id="identity-input" value="{{ request('identity', 'doctor') }}">
                    <button class="filter-btn {{ request('identity', 'doctor') == 'doctor' ? 'active' : '' }}"
                        data-identity="doctor">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Doctors
                    </button>
                    <button type="button"
                        class="filter-btn {{ request('identity', 'hospital') == 'hospital' ? 'active' : '' }}"
                        data-identity="hospital">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                        </svg>
                        Hospital
                    </button>
                    <button type="button"
                        class="filter-btn {{ request('identity', 'pharmacies') == 'pharmacies' ? 'active' : '' }}"
                        data-identity="pharmacies">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                            <line x1="8" y1="21" x2="16" y2="21"></line>
                            <line x1="12" y1="17" x2="12" y2="21"></line>
                        </svg>
                        Pharmacy
                    </button>
                    <button type="button"
                        class="filter-btn {{ request('identity', 'ambulance') == 'ambulance' ? 'active' : '' }}"
                        data-identity="ambulance">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M9 12l2 2 4-4"></path>
                            <path
                                d="M21 12c.552 0 1-.448 1-1V5c0-.552-.448-1-1-1H3c-.552 0-1 .448-1 1v6c0 .552.448 1 1 1h18z">
                            </path>
                        </svg>
                        Ambulance
                    </button>
                </div>
            </form>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h2 class="section-title">Browse doctors nearby</h2>
            <div class="doctors-grid">
                @forelse ($doctorProfiles as $item)
                    <!-- Doctor Card 1 -->
                    <div class="doctor-card">
                        <button class="favorite-btn">♡</button>
                        <div class="card-header">
                            <img src="/placeholder.svg?height=80&width=80" alt="Dr. Esther Howard" class="doctor-avatar">
                            <div class="doctor-info">
                                <h3 class="doctor-name">{{ $item->name }}</h3>
                                <p class="doctor-specialty">{{ $item->doctorProfile->medicalCategory? $item->doctorProfile->medicalCategory->name : ''}}</p>
                                <div class="rating">
                                    <span class="star">★</span>
                                    <span
                                        class="rating-number">{{ $item->doctorProfile->reviews->avg('rate') ?? 'Not rated' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-details">
                            <div class="detail-item">
                                <div class="detail-label">Location</div>
                                <div class="detail-value">{{ $item->city }} - {{ $item->country }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Price from</div>
                                <div class="detail-value">${{ $item->doctorProfile->services->min('price') }} -
                                    ${{ $item->doctorProfile->services->max('price') }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Schedule</div>
                                <div
                                    class="detail-value {{ \App\Models\WorkSchedule::isAvailable($item->doctorProfile->id) == 1 ? 'available' : '' }}">
                                    {{ \App\Models\WorkSchedule::isAvailable($item->doctorProfile->id) == 1 ? 'Available' : 'Not Available' }}
                                </div>
                            </div>
                        </div>
                        <button class="book-btn" onclick="location.href='{{ route('appointment.step.1', ['user_id' => $item->id]) }}'">Book Appointment</button>
                    </div>
                @empty
                    <div class="empty-text">
                        Không có kết quả phù hợp cho '{{ request('q', '') }}'.
                    </div>
                @endforelse
                <!-- Doctor Card 2 -->
                {{-- <div class="doctor-card">
                    <button class="favorite-btn">♡</button>
                    <div class="card-header">
                        <img src="/placeholder.svg?height=80&width=80" alt="Dr. Esther Howard" class="doctor-avatar">
                        <div class="doctor-info">
                            <h3 class="doctor-name">Dr. Esther Howard</h3>
                            <p class="doctor-specialty">Cardiologist</p>
                            <div class="rating">
                                <span class="star">★</span>
                                <span class="rating-number">4.5</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-details">
                        <div class="detail-item">
                            <div class="detail-label">Location</div>
                            <div class="detail-value">5 Paris</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Price from</div>
                            <div class="detail-value">$50</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Schedule</div>
                            <div class="detail-value available">Available</div>
                        </div>
                    </div>
                    <button class="book-btn">Book Appointment</button>
                </div> --}}

                <!-- Doctor Card 3 -->
                {{-- <div class="doctor-card">
                    <button class="favorite-btn">♡</button>
                    <div class="card-header">
                        <img src="/placeholder.svg?height=80&width=80" alt="Dr. Esther Howard" class="doctor-avatar">
                        <div class="doctor-info">
                            <h3 class="doctor-name">Dr. Esther Howard</h3>
                            <p class="doctor-specialty">Cardiologist</p>
                            <div class="rating">
                                <span class="star">★</span>
                                <span class="rating-number">4.5</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-details">
                        <div class="detail-item">
                            <div class="detail-label">Location</div>
                            <div class="detail-value">5 Paris</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Price from</div>
                            <div class="detail-value">$50</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Schedule</div>
                            <div class="detail-value not-available">Not available</div>
                        </div>
                    </div>
                    <button class="book-btn" disabled>Book Appointment</button>
                </div> --}}

                <!-- Doctor Card 4 -->
                {{-- <div class="doctor-card">
                    <button class="favorite-btn active">♥</button>
                    <div class="card-header">
                        <img src="/placeholder.svg?height=80&width=80" alt="Dr. Esther Howard" class="doctor-avatar">
                        <div class="doctor-info">
                            <h3 class="doctor-name">Dr. Esther Howard</h3>
                            <p class="doctor-specialty">Cardiologist</p>
                            <div class="rating">
                                <span class="star">★</span>
                                <span class="rating-number">4.5</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-details">
                        <div class="detail-item">
                            <div class="detail-label">Location</div>
                            <div class="detail-value">5 Paris</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Price from</div>
                            <div class="detail-value">$50</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Schedule</div>
                            <div class="detail-value available">Available</div>
                        </div>
                    </div>
                    <button class="book-btn">Book Appointment</button>
                </div> --}}

                <!-- Doctor Card 5 -->
                {{-- <div class="doctor-card">
                    <button class="favorite-btn active">♥</button>
                    <div class="card-header">
                        <img src="/placeholder.svg?height=80&width=80" alt="Dr. Esther Howard" class="doctor-avatar">
                        <div class="doctor-info">
                            <h3 class="doctor-name">Dr. Esther Howard</h3>
                            <p class="doctor-specialty">Cardiologist</p>
                            <div class="rating">
                                <span class="star">★</span>
                                <span class="rating-number">4.5</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-details">
                        <div class="detail-item">
                            <div class="detail-label">Location</div>
                            <div class="detail-value">5 Paris</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Price from</div>
                            <div class="detail-value">$50</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Schedule</div>
                            <div class="detail-value available">Available</div>
                        </div>
                    </div>
                    <button class="book-btn">Book Appointment</button>
                </div> --}}

                <!-- Doctor Card 6 -->
                {{-- <div class="doctor-card">
                    <button class="favorite-btn">♡</button>
                    <div class="card-header">
                        <img src="/placeholder.svg?height=80&width=80" alt="Dr. Esther Howard" class="doctor-avatar">
                        <div class="doctor-info">
                            <h3 class="doctor-name">Dr. Esther Howard</h3>
                            <p class="doctor-specialty">Cardiologist</p>
                            <div class="rating">
                                <span class="star">★</span>
                                <span class="rating-number">4.5</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-details">
                        <div class="detail-item">
                            <div class="detail-label">Location</div>
                            <div class="detail-value">5 Paris</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Price from</div>
                            <div class="detail-value">$50</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Schedule</div>
                            <div class="detail-value available">Available</div>
                        </div>
                    </div>
                    <button class="book-btn">Book Appointment</button>
                </div> --}}
            </div>

            <!-- Pagination -->
            {{-- <div class="pagination">
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">4</button>
                <button class="page-btn">></button>
            </div> --}}
            {{ $doctorProfiles->appends(request()->except('page'))->links('vendor.pagination.default') }}
            {{-- <div class="pagination">
            </div> --}}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded',
            function() {
                const searchForm = document.getElementById('search-form');
                const identityInput = document.getElementById('identity-input');
                const identityButtons = document.querySelectorAll('.filter-btn');
                identityButtons.forEach(button => {
                    button.addEventListener('click',
                        function() {
                            const selectedIdentity = this.dataset.identity;
                            identityInput.value = selectedIdentity;
                            searchForm.submit();
                        });
                });
            });
    </script>
@endpush
