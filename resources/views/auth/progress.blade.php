@extends('layouts.app-no-layout')

@push('styles')
    <link rel="stylesheet" href="/css/auth.css">
@endpush

@section('content')
    <div class="progress-page-container">
        <div class="progress-main-wrapper">
            <div class="progress-content">
                <div class="progress-circle-container">
                    <svg id="progressSvg" class="progress-svg" viewBox="0 0 140 140">
                        <circle class="progress-bg-circle" cx="70" cy="70" r="60" />
                        <circle id="progressCircle" class="progress-fill-circle" cx="70" cy="70" r="60" />
                    </svg>
                    <div class="progress-logo-container">
                        <div class="progress-logo-bg">
                            <img class="progress-logo" src="{{ asset('img/logo.svg') }}" alt="Logo">
                        </div>
                    </div>
                </div>
                <div id="progressPercent" class="progress-percentage">0%</div>
                <div class="progress-title">
                    {{ __('client/auth.register_flow.progress.assembling_information') }}
                </div>
                <div class="progress-description">
                    {{ __('client/auth.register_flow.progress.account_creating') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cache DOM elements
            const elements = {
                percentEl: document.getElementById('progressPercent'),
                circle: document.getElementById('progressCircle')
            };

            let percent = 0;
            const total = 377;
            const increment = 1;
            const intervalTime = 22;

            function animateProgress() {
                if (percent <= 100) {
                    elements.percentEl.textContent = percent + '%';
                    elements.circle.style.strokeDashoffset = total - (percent / 100) * total;
                    percent += increment;
                    setTimeout(animateProgress, intervalTime);
                } else {
                    console.log('Progress complete');
                    // Optional: Add completion callback here
                    onProgressComplete();
                }
            }

            function onProgressComplete() {
                // Handle completion - e.g., redirect to next page
                window.location.href = "{{ route('register.complete') }}";
            }

            // Start animation with slight delay for better UX
            setTimeout(animateProgress, 300);
        });
    </script>
@endpush
