@extends('layouts.app')

@push('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #f8f9fa;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .booking-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Progress Steps */
    .progress-steps {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 40px;
        gap: 20px;
    }

    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }

    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 16px;
        margin-bottom: 8px;
        border: 2px solid #ddd;
        background: white;
        color: #666;
    }

    .step.completed .step-number {
        background: #dc3545;
        color: white;
        border-color: #dc3545;
    }

    .step.active .step-number {
        background: #dc3545;
        color: white;
        border-color: #dc3545;
    }

    .step-label {
        font-size: 14px;
        color: #666;
        text-align: center;
        white-space: nowrap;
    }

    .step.completed .step-label,
    .step.active .step-label {
        color: #dc3545;
        font-weight: 500;
    }

    .step-connector {
        width: 60px;
        height: 2px;
        background: #ddd;
        margin: 0 10px;
        margin-top: -25px;
    }

    .step.completed + .step-connector {
        background: #dc3545;
    }

    /* Main Content */
    .booking-content {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .booking-title {
        font-size: 24px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 20px;
    }

    /* Doctor Info */
    .doctor-info {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 40px;
    }

    .doctor-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
    }

    .doctor-name {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
    }

    /* Form Section */
    .form-section {
        margin-bottom: 40px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        font-size: 16px;
        font-weight: 500;
        color: #1a1a1a;
        margin-bottom: 10px;
    }

    .required {
        color: #dc3545;
    }

    .form-textarea {
        width: 100%;
        min-height: 200px;
        padding: 15px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
        resize: vertical;
        transition: border-color 0.3s;
        background: #f8f9fa;
    }

    .form-textarea:focus {
        outline: none;
        border-color: #dc3545;
        background: white;
    }

    .form-textarea::placeholder {
        color: #adb5bd;
    }

    .attach-file-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        border: 2px solid #e9ecef;
        border-radius: 25px;
        background: white;
        color: #6c757d;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        margin-bottom: 25px;
    }

    .attach-file-btn:hover {
        border-color: #dc3545;
        color: #dc3545;
    }

    .attach-icon {
        font-size: 16px;
        transform: rotate(45deg);
    }

    .form-input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
        transition: border-color 0.3s;
        background: white;
    }

    .form-input:focus {
        outline: none;
        border-color: #dc3545;
    }

    .form-input::placeholder {
        color: #adb5bd;
    }

    /* Hidden file input */
    .file-input {
        display: none;
    }

    /* Bottom Section */
    .form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .back-btn {
        padding: 12px 30px;
        border: 2px solid #dc3545;
        border-radius: 25px;
        background: white;
        color: #dc3545;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .back-btn:hover {
        background: #dc3545;
        color: white;
    }

    .continue-btn {
        padding: 12px 30px;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 25px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .continue-btn:hover {
        background: #c82333;
    }

    .continue-btn:disabled {
        background: #ccc;
        cursor: not-allowed;
    }

    /* File upload feedback */
    .file-feedback {
        margin-top: 10px;
        font-size: 12px;
        color: #28a745;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .progress-steps {
            flex-direction: column;
            gap: 10px;
        }

        .step-connector {
            display: none;
        }

        .form-footer {
            flex-direction: column-reverse;
            gap: 15px;
        }

        .back-btn,
        .continue-btn {
            width: 100%;
            text-align: center;
        }

        .booking-content {
            padding: 20px;
        }
    }
</style>
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
            <img src="/placeholder.svg?height=60&width=60" alt="Dr. Esther Howard" class="doctor-avatar">
            <div class="doctor-name">Dr. Esther Howard</div>
        </div>

        <!-- Medical Information Form -->
        <form id="medicalForm" method="POST" action="{{ route('appointment.step.2.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-section">
                <!-- Medical Problem Summary -->
                <div class="form-group">
                    <label for="medical_problem" class="form-label">
                        Summarize your medical problem<span class="required">*</span>
                    </label>
                    <textarea
                        id="medical_problem"
                        name="medical_problem"
                        class="form-textarea"
                        placeholder="Tell your history medical"
                        required
                    ></textarea>
                </div>

                <!-- File Attachment -->
                <div class="form-group">
                    <label for="medical_files" class="attach-file-btn">
                        <span class="attach-icon">📎</span>
                        Attach file
                    </label>
                    <input
                        type="file"
                        id="medical_files"
                        name="medical_files[]"
                        class="file-input"
                        multiple
                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                    >
                    <div id="file-feedback" class="file-feedback"></div>
                </div>

                <!-- Note -->
                <div class="form-group">
                    <label for="note" class="form-label">Note</label>
                    <input
                        type="text"
                        id="note"
                        name="note"
                        class="form-input"
                        placeholder="Enter"
                    >
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
