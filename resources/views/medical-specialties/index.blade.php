@extends('layouts.app')

@push('styles')
    <style>
        .specialty-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(249, 250, 251, 0.9));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .specialty-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s;
        }

        .specialty-card:hover::before {
            left: 100%;
        }

        .specialty-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
        }

        .specialty-icon {
            font-size: 3rem;
            display: block;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .specialty-card:hover .specialty-icon {
            transform: scale(1.1);
        }

        .doctor-count-badge {
            background: linear-gradient(135deg, #ff6467, #DF1D32);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
        }

        .search-container {
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #ff6467;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-up {
            animation: slideInUp 0.8s ease-out both;
        }

        .animate-slide-up-delay-1 {
            animation: slideInUp 0.8s ease-out both;
            animation-delay: 0.1s;
        }

        .animate-slide-up-delay-2 {
            animation: slideInUp 0.8s ease-out both;
            animation-delay: 0.2s;
        }

        .animate-slide-up-delay-3 {
            animation: slideInUp 0.8s ease-out both;
            animation-delay: 0.3s;
        }

        .animate-slide-up-delay-4 {
            animation: slideInUp 0.8s ease-out both;
            animation-delay: 0.4s;
        }

        .animate-slide-up-delay-5 {
            animation: slideInUp 0.8s ease-out both;
            animation-delay: 0.5s;
        }

        .animate-slide-up-delay-6 {
            animation: slideInUp 0.8s ease-out both;
            animation-delay: 0.6s;
        }

        .animate-slide-up-delay-7 {
            animation: slideInUp 0.8s ease-out both;
            animation-delay: 0.7s;
        }

        .animate-slide-up-delay-8 {
            animation: slideInUp 0.8s ease-out both;
            animation-delay: 0.8s;
        }

        .animate-slide-up-delay-9 {
            animation: slideInUp 0.8s ease-out both;
            animation-delay: 0.9s;
        }

        .animate-slide-up-delay-10 {
            animation: slideInUp 0.8s ease-out both;
            animation-delay: 1.0s;
        }

        .stats-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(249, 250, 251, 0.8));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .specialty-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
        }

        @media (max-width: 640px) {
            .specialty-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6b7280;
        }

        .hero-section {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 2rem;
            padding: 3rem 2rem;
            text-align: center;
            margin-bottom: 3rem;
        }
    </style>
@endpush

@section('content')
    <div class="gradient-bg mb-4 min-h-screen">
        <div class="container mx-auto px-4">
            <!-- Hero Section -->
            <div class="hero-section animate-slide-up">
                <h1 class="mb-4 text-4xl font-bold text-[#DF1D32] md:text-5xl">
                    Chuyên khoa y tế
                </h1>
                <p class="mx-auto mb-6 max-w-2xl text-xl text-gray-600">
                    Khám phá phạm vi chuyên môn y tế toàn diện của chúng tôi và tìm chuyên gia chăm sóc sức khỏe phù hợp cho nhu cầu của bạn
                </p>

                <!-- Search Bar -->
                <div class="search-container mx-auto max-w-md">
                    <div class="search-icon">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input id="searchInput" class="search-input" type="text" placeholder="Tìm kiếm chuyên khoa y tế...">
                </div>
            </div>

            <!-- Specialties Grid -->
            <div id="specialtiesGrid" class="specialty-grid animate-slide-up-delay-1">
                @foreach ($specialties as $index => $specialty)
                    @php
                        $delayClass = 'animate-slide-up-delay-' . min(10, $index + 2);
                    @endphp
                    <div class="specialty-card {{ $delayClass }} specialty-item rounded-2xl p-6 shadow-lg" data-name="{{ strtolower($specialty['name']) }}" onclick="viewSpecialty('{{ $specialty['id'] }}', '{{ $specialty['slug'] }}')">

                        <!-- Icon -->
                        <div class="mb-4 flex items-center justify-center">
                            @svg($specialty['icon'], 'h-10 w-10 text-red-600 group-hover:text-white transition-colors duration-300 specialty-icon')
                        </div>

                        <!-- Content -->
                        <div class="text-center">
                            <h3 class="mb-2 text-xl font-bold text-gray-800">{{ $specialty['name'] }}</h3>

                            <!-- Doctor Count -->
                            <div class="mb-4 flex items-center justify-center gap-2">
                                <span class="doctor-count-badge">
                                    {{ $specialty['doctors_count'] }} Bác sĩ
                                </span>
                            </div>

                            <!-- Action Button -->
                            <div class="flex items-center justify-center font-semibold text-red-600">
                                <span class="mr-2">Xem bác sĩ</span>
                                <svg class="h-5 w-5 transition-transform group-hover:translate-x-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- No Results Message -->
            <div id="noResults" class="empty-state animate-slide-up-delay-2 hidden">
                <svg class="mx-auto mb-4 h-16 w-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
                <h3 class="mb-2 text-xl font-semibold text-gray-500">Không tìm thấy danh mục</h3>
                <p class="text-gray-400">Hãy thử điều chỉnh tìm kiếm của bạn</p>
            </div>

            <!-- Back to Home Button -->
            @if ($specialties->count() > 0)
                <div class="animate-slide-up-delay-3 mt-12 text-center">
                    <a class="inline-flex items-center gap-2 rounded-xl bg-white px-8 py-4 font-semibold text-red-600 shadow-lg transition-colors hover:bg-gray-50" href="{{ route('home') }}">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Quay lại trang chủ
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const specialtyItems = document.querySelectorAll('.specialty-item');
            const noResults = document.getElementById('noResults');
            let visibleCount = 0;

            specialtyItems.forEach(item => {
                const name = item.getAttribute('data-name');
                if (name.includes(searchTerm)) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            if (visibleCount === 0 && searchTerm !== '') {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        });

        // View specialty function
        function viewSpecialty(id, slug) {
            // Navigate to specialty detail page
            window.location.href = `{{ url('/medical-specialties') }}/${slug}`;
        }

        // Add keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.getElementById('searchInput').value = '';
                document.getElementById('searchInput').dispatchEvent(new Event('input'));
            }
        });
    </script>
@endsection
