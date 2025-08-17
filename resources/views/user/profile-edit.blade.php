@extends('layouts.app')

@push('styles')
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: #DF1D32;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            background: white;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }

        .form-select:focus {
            outline: none;
            border-color: #DF1D32;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            background: white;
            resize: vertical;
            min-height: 120px;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #DF1D32;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .error-text {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .success-alert {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .error-alert {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-up {
            animation: slideInUp 0.6s ease-out;
        }

        .avatar-upload {
            position: relative;
            display: inline-block;
        }

        .avatar-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .avatar-preview:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .avatar-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 50%;
        }

        .avatar-preview:hover .avatar-overlay {
            opacity: 1;
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen py-8">
        <div class="container mx-auto px-4">
            <div class="mx-auto max-w-4xl">
                <!-- Tiêu đề -->
                <div class="animate-slide-up mb-8">
                    <div class="mb-6 flex items-center gap-4">
                        <a class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-red-400 to-red-700 shadow-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-xl" href="{{ route('profile') }}">
                            <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <div>
                            <h1 class="mb-2 text-3xl font-bold text-[#DF1D32]">Chỉnh sửa hồ sơ</h1>
                            <p class="text-[#DF1D32]">Cập nhật thông tin cá nhân và y tế</p>
                        </div>
                    </div>
                </div>

                <!-- Thông báo -->
                @if (session('success'))
                    <div class="success-alert animate-slide-up mb-6">
                        <div class="flex items-center gap-3">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-semibold">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="error-alert animate-slide-up mb-6">
                        <div class="flex items-center gap-3">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-semibold">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Edit Form -->
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Avatar Section -->
                    <div class="glass-card animate-slide-up mb-8 rounded-3xl p-8 shadow-2xl" style="animation-delay: 0.1s;">
                        <h2 class="mb-6 flex items-center gap-3 text-2xl font-bold text-gray-800">
                            <svg class="h-7 w-7 text-[#DF1D32]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            Ảnh đại diện
                        </h2>

                        <div class="flex flex-col items-center gap-6 md:flex-row">
                            <div class="avatar-upload">
                                <div class="avatar-preview" onclick="document.getElementById('avatar').click()">
                                    @if ($user->avatar && $user->avatar !== '/upload/avatar/default.png')
                                        <img id="avatarPreview" class="h-full w-full object-cover" src="{{ asset($user->avatar) }}" alt="{{ $user->name }}">
                                    @else
                                        <div id="avatarPreview" class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-500 to-purple-600 text-3xl font-bold text-white">
                                            {{ substr($user->name ?? 'U', 0, 1) }}
                                        </div>
                                    @endif
                                    <div class="avatar-overlay">
                                        <svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <input id="avatar" class="hidden" name="avatar" type="file" accept="image/*" onchange="previewAvatar(this)">
                            </div>
                            <div class="text-center md:text-left">
                                <h3 class="mb-2 text-lg font-semibold text-gray-800">Cập nhật ảnh của bạn</h3>
                                <p class="mb-4 text-gray-600">Nhấp vào ảnh để tải lên ảnh đại diện mới</p>
                                <div class="flex gap-3">
                                    <button class="rounded-lg bg-[#DF1D32] px-4 py-2 text-white transition-colors hover:bg-blue-700" type="button" onclick="document.getElementById('avatar').click()">
                                        Chọn ảnh
                                    </button>
                                    <label class="flex items-center gap-2">
                                        <input name="useDefaultAvatar" type="hidden" value="0">
                                        <input class="rounded border-gray-300" name="useDefaultAvatar" type="checkbox" value="1" @checked(old('useDefaultAvatar') == 1)>
                                        <span class="text-sm text-gray-600">Sử dụng ảnh mặc định</span>
                                    </label>
                                </div>
                                @error('avatar')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="glass-card animate-slide-up mb-8 rounded-3xl p-8 shadow-2xl" style="animation-delay: 0.2s;">
                        <h2 class="mb-6 flex items-center gap-3 text-2xl font-bold text-gray-800">
                            <svg class="h-7 w-7 text-[#DF1D32]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            Thông tin cá nhân
                        </h2>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="form-group">
                                <label class="form-label" for="name">Họ và tên</label>
                                <input id="name" class="form-input" name="name" type="text" required value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="email">Địa chỉ email</label>
                                <input id="email" class="form-input" name="email" type="email" required value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="phone">Số điện thoại</label>
                                <div class="flex items-center gap-2">
                                    <input class="form-input" name="country_code" type="text" value="{{ old('country_code', $user->country_code) }}" disabled placeholder="+84">
                                    <input id="phone" class="form-input w-20" name="phone" type="text" required value="{{ old('phone', $user->phone) }}">
                                </div>
                                @error('phone')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                                @error('country_code')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="gender">Giới tính</label>
                                <select id="gender" class="form-select" name="gender" required>
                                    <option value="">Chọn giới tính</option>
                                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Nam</option>
                                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Nữ</option>
                                    <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Khác</option>
                                </select>
                                @error('gender')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group md:col-span-2">
                                <label class="form-label" for="address">Địa chỉ</label>
                                <textarea id="address" class="form-textarea" name="address" placeholder="Nhập địa chỉ đầy đủ của bạn">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="city">Thành phố</label>
                                <input id="city" class="form-input" name="city" type="text" value="{{ old('city', $user->city) }}">
                                @error('city')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="country">Quốc gia</label>
                                <input id="country" class="form-input" name="country" type="text" value="{{ old('country', $user->country) }}">
                                @error('country')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Medical Information -->
                    <div class="glass-card animate-slide-up mb-8 rounded-3xl p-8 shadow-2xl" style="animation-delay: 0.3s;">
                        <h2 class="mb-6 flex items-center gap-3 text-2xl font-bold text-gray-800">
                            <svg class="h-7 w-7 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h12a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm2 2a1 1 0 000 2h8a1 1 0 100-2H5z" clip-rule="evenodd" />
                            </svg>
                            Thông tin y tế
                        </h2>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="form-group">
                                <label class="form-label" for="birth_date">Ngày sinh</label>
                                <input id="birth_date" class="form-input" name="birth_date" type="date" value="{{ old('birth_date', $user->patientProfile?->birth_date) }}">
                                @error('birth_date')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="age">Tuổi</label>
                                <input id="age" class="form-input" name="age" type="number" value="{{ old('age', $user->patientProfile?->age) }}" min="1" max="150">
                                @error('age')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="height">Chiều cao (cm)</label>
                                <input id="height" class="form-input" name="height" type="number" value="{{ old('height', $user->patientProfile?->height) }}" min="50" max="300">
                                @error('height')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="weight">Cân nặng (kg)</label>
                                <input id="weight" class="form-input" name="weight" type="number" value="{{ old('weight', $user->patientProfile?->weight) }}" min="1" max="500" step="0.1">
                                @error('weight')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="blood_group">Nhóm máu</label>
                                <select id="blood_group" class="form-select" name="blood_group">
                                    <option value="">Chọn nhóm máu</option>
                                    <option value="A+" {{ old('blood_group', $user->patientProfile?->blood_group) == 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ old('blood_group', $user->patientProfile?->blood_group) == 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ old('blood_group', $user->patientProfile?->blood_group) == 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B-" {{ old('blood_group', $user->patientProfile?->blood_group) == 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="AB+" {{ old('blood_group', $user->patientProfile?->blood_group) == 'AB+' ? 'selected' : '' }}>AB+</option>
                                    <option value="AB-" {{ old('blood_group', $user->patientProfile?->blood_group) == 'AB-' ? 'selected' : '' }}>AB-</option>
                                    <option value="O+" {{ old('blood_group', $user->patientProfile?->blood_group) == 'O+' ? 'selected' : '' }}>O+</option>
                                    <option value="O-" {{ old('blood_group', $user->patientProfile?->blood_group) == 'O-' ? 'selected' : '' }}>O-</option>
                                </select>
                                @error('blood_group')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group md:col-span-2">
                                <label class="form-label" for="medical_history">Tiền sử bệnh</label>
                                <textarea id="medical_history" class="form-textarea" name="medical_history" placeholder="Nhập tiền sử bệnh, dị ứng hoặc các tình trạng liên quan">{{ old('medical_history', $user->patientProfile?->medical_history) }}</textarea>
                                @error('medical_history')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Insurance Information -->
                    <div class="glass-card animate-slide-up mb-8 rounded-3xl p-8 shadow-2xl" style="animation-delay: 0.4s;">
                        <h2 class="mb-6 flex items-center gap-3 text-2xl font-bold text-gray-800">
                            <svg class="h-7 w-7 text-[#DF1D32]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2L3 7v11a1 1 0 001 1h12a1 1 0 001-1V7l-7-5zM9 9a1 1 0 012 0v4a1 1 0 11-2 0V9z" clip-rule="evenodd" />
                            </svg>
                            Thông tin bảo hiểm
                        </h2>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="form-group">
                                <label class="form-label" for="insurance_type">Loại bảo hiểm</label>
                                <select id="insurance_type" class="form-select" name="insurance_type">
                                    <option value="">Chọn loại bảo hiểm</option>
                                    <option value="public" {{ old('insurance_type', $user->patientProfile?->insurance?->insurance_type) == 'public' ? 'selected' : '' }}>Công cộng</option>
                                    <option value="private" {{ old('insurance_type', $user->patientProfile?->insurance?->insurance_type) == 'private' ? 'selected' : '' }}>Tư nhân</option>
                                </select>
                                @error('insurance_type')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="insurance_number">Số bảo hiểm</label>
                                <input id="insurance_number" class="form-input" name="insurance_number" type="text" value="{{ old('insurance_number', $user->patientProfile?->insurance?->insurance_number) }}">
                                @error('insurance_number')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="animate-slide-up rounded-3xl p-8" style="animation-delay: 0.5s;">
                        <div class="flex flex-col justify-end gap-4 sm:flex-row">
                            <a class="rounded-xl bg-gray-500 px-8 py-3 text-center font-semibold text-white transition-all duration-300 hover:bg-gray-600" href="{{ route('profile') }}">
                                Hủy
                            </a>
                            <button class="flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-red-500 to-red-700 px-8 py-3 font-semibold text-white transition-all duration-300 hover:from-red-700 hover:to-red-800" type="submit">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Cập nhật hồ sơ
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('avatarPreview');
                    preview.innerHTML = `<img src="${e.target.result}" alt="Xem trước ảnh đại diện" class="w-full h-full object-cover">`;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Tự động tính tuổi từ ngày sinh
        document.getElementById('birth_date').addEventListener('change', function() {
            const birthDate = new Date(this.value);
            const today = new Date();
            const age = Math.floor((today - birthDate) / (365.25 * 24 * 60 * 60 * 1000));
            if (age > 0 && age < 150) {
                document.getElementById('age').value = age;
            }
        });
    </script>
@endsection
