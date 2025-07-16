@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/appointment/step-2.css') }}?v=1" rel="stylesheet">
@endpush

@section('content')
<div class="booking-container">
    <!-- Progress Steps -->
    <div class="progress-steps">
        <div class="step completed">
            <div class="step-number">1</div>
            <div class="step-label">Chọn dịch vụ</div>
        </div>
        <div class="step-connector"></div>
        <div class="step active">
            <div class="step-number">2</div>
            <div class="step-label">Điền thông tin</div>
        </div>
        <div class="step-connector"></div>
        <div class="step">
            <div class="step-number">3</div>
            <div class="step-label">Thanh toán & xác nhận</div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="booking-content">
        <h1 class="booking-title">Book appointment</h1>

        <!-- Doctor Info -->
        <div class="doctor-info">
            <img src="/{{ $doctorProfile->user->avatar }}?height=60&width=60" alt="{{ $doctorProfile->user->name }}" class="doctor-avatar">
            <div class="doctor-name">{{ $doctorProfile->user->name }}</div>
        </div>

        <!-- Medical Information Form -->
        <form id="medicalForm" method="POST" action="{{ route('appointment.step.two.store') }}"
            enctype="multipart/form-data">
            @csrf

            <div class="form-section">
                <!-- Medical Problem Summary -->
                <div class="form-group">
                    <label for="medical_problem" class="form-label">
                        Summarize your medical problem<span class="required">*</span>
                    </label>
                    <textarea id="medical_problem" name="medical_problem" class="form-textarea" placeholder="Tell your history medical"
                        required>{{ old('medical_problem') }}</textarea>
                    @error('medical_problem')
                        <div class="text-danger" style="color: #dc3545; font-size: 13px; margin-top: 5px;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- File Attachment -->
                <div class="form-group">
                    <label for="medical_files" class="attach-file-btn">
                        <span class="attach-icon">📎</span>
                        Attach file
                    </label>
                    <input type="file" id="medical_files" name="medical_files[]" class="file-input" multiple
                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    <div id="file-feedback" class="file-feedback"></div>
                    @error('medical_files')
                        <div class="text-danger" style="color: #dc3545; font-size: 13px; margin-top: 5px;">
                            {{ $message }}
                        </div>
                    @enderror
                    @if ($errors->has('medical_files.*'))
                        @foreach ($errors->get('medical_files.*') as $messages)
                            @foreach ($messages as $msg)
                                <div class="text-danger" style="color: #dc3545; font-size: 13px; margin-top: 5px;">
                                    {{ $msg }}
                                </div>
                            @endforeach
                        @endforeach
                    @endif
                </div>

                <!-- Note -->
                <div class="form-group">
                    <label for="note" class="form-label">Note</label>
                    <input type="text" id="note" name="note" class="form-input" placeholder="Enter"
                        value="{{ old('note') }}">
                    @error('note')
                        <div class="text-danger" style="color: #dc3545; font-size: 13px; margin-top: 5px;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Form Footer -->
            <div class="form-footer">
                <a onclick="history.back()" class="back-btn">Back</a>
                <button type="submit" class="continue-btn">Continue</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // File upload handling
    document.getElementById('medical_files').addEventListener('change', function(e) {
        const files = e.target.files;
        const feedback = document.getElementById('file-feedback');

        if (files.length > 0) {
            let fileNames = [];
            for (let i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            feedback.textContent = `Selected files: ${fileNames.join(', ')}`;
            feedback.style.display = 'block';
        } else {
            feedback.style.display = 'none';
        }
    });

    // File attachment button click
    document.querySelector('.attach-file-btn').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('medical_files').click();
    });

    // Form validation
    document.getElementById('medicalForm').addEventListener('submit', function(e) {
        const medicalProblem = document.getElementById('medical_problem').value.trim();

        if (!medicalProblem) {
            e.preventDefault();
            alert('Please describe your medical problem');
            document.getElementById('medical_problem').focus();
            return false;
        }

        // Show loading state
        const submitBtn = document.querySelector('.continue-btn');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Processing...';

        // You can add more validation here
        console.log('Form data:', {
            medical_problem: medicalProblem,
            note: document.getElementById('note').value,
            files: document.getElementById('medical_files').files.length
        });
    });

    // Auto-resize textarea
    document.getElementById('medical_problem').addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.max(200, this.scrollHeight) + 'px';
    });

    // Character counter (optional)
    document.getElementById('medical_problem').addEventListener('input', function() {
        const maxLength = 1000;
        const currentLength = this.value.length;

        // You can add a character counter here if needed
        if (currentLength > maxLength) {
            this.value = this.value.substring(0, maxLength);
        }
    });
</script>
@endpush
