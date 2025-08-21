<div class="space-y-6">
    <style>
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

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200px 0;
            }

            100% {
                background-position: calc(200px + 100%) 0;
            }
        }

        .file-card {
            animation: slideInUp 0.6s ease-out both;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .file-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .file-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .file-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .file-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .file-card:nth-child(5) {
            animation-delay: 0.5s;
        }

        .file-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -200px;
            width: 200px;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .file-card:hover::before {
            left: 100%;
        }

        .file-card:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.15);
            border-color: #e11d48;
        }

        .file-icon {
            transition: all 0.3s ease;
        }

        .file-card:hover .file-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .btn-action {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-action::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.4s;
        }

        .btn-action:hover::before {
            left: 100%;
        }

        .btn-action:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, #e11d48, #be185d);
            border-color: #e11d48;
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #be185d, #9d174d);
            border-color: #be185d;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6b7280, #4b5563);
            border-color: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #4b5563, #374151);
            border-color: #4b5563;
        }

        .file-preview {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
        }

        .file-preview:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .modal-content {
            animation: scaleIn 0.3s ease-out;
        }

        .modal-overlay {
            animation: fadeIn 0.3s ease-out;
            backdrop-filter: blur(10px);
        }

        .file-size-badge {
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
            border-radius: 20px;
            padding: 2px 8px;
            font-size: 11px;
            font-weight: 600;
            color: #6b7280;
        }

        .empty-state {
            animation: fadeIn 0.8s ease-out;
        }
    </style>

    @if (count($files) > 0)
        @foreach ($files as $index => $file)
            @php
                if (is_string($file)) {
                    $fileData = json_decode($file, false);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $file = $fileData;
                    }
                }

                if (is_array($file)) {
                    $file = (object) $file;
                }

                $fileName = $file->original_name ?? ($file->name ?? ($file->filename ?? 'Unknown File'));
                $filePath = $file->path ?? ($file->file_path ?? '');
                $fileSize = $file->size ?? ($file->file_size ?? 0);

                // Xử lý created_at
                $fileCreatedAt = null;
                if (isset($file->created_at)) {
                    try {
                        if (is_string($file->created_at)) {
                            $fileCreatedAt = \Carbon\Carbon::parse($file->created_at);
                        } elseif ($file->created_at instanceof \Carbon\Carbon) {
                            $fileCreatedAt = $file->created_at;
                        }
                    } catch (\Exception $e) {
                        $fileCreatedAt = null;
                    }
                }

                $fileExtension = '';
                if ($fileName) {
                    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                }

                $mimeType = $file->mime_type ?? ($file->type ?? '');

                if (empty($fileExtension) && !empty($mimeType)) {
                    $mimeToExt = [
                        'image/jpeg' => 'jpg',
                        'image/jpg' => 'jpg',
                        'image/png' => 'png',
                        'image/gif' => 'gif',
                        'image/webp' => 'webp',
                        'application/pdf' => 'pdf',
                        'text/plain' => 'txt',
                        'application/msword' => 'doc',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
                    ];
                    $fileExtension = $mimeToExt[$mimeType] ?? 'file';
                }
            @endphp
            <div class="file-card rounded-xl border-2 border-gray-200 bg-gradient-to-br from-white to-gray-50 p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                <div class="file-icon flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 text-white shadow-lg">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @elseif($fileExtension === 'pdf')
                                <div class="file-icon flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-red-400 to-red-600 text-white shadow-lg">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @else
                                <div class="file-icon flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-gray-400 to-gray-600 text-white shadow-lg">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h4 class="mb-1 text-lg font-bold text-gray-900" title="{{ $fileName }}">
                                {{ \Illuminate\Support\Str::limit($fileName, 40, '...') }}
                            </h4>
                            <div class="flex items-center space-x-3">
                                <span class="file-size-badge">
                                    {{ number_format($fileSize / 1024, 1) }} KB
                                </span>
                                @if ($fileCreatedAt)
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $fileCreatedAt->format('d/m/Y H:i') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a class="btn-action btn-secondary inline-flex items-center rounded-lg px-4 py-2 text-sm font-semibold shadow-md" href="{{ asset('storage/' . $filePath) }}" download="{{ $fileName }}">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Tải xuống
                        </a>
                    </div>
                </div>

                @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                    <div class="mt-6">
                        <div class="file-preview relative flex items-center justify-center overflow-hidden rounded-xl border-2 border-gray-200 bg-white p-2 shadow-lg">
                            <img class="block max-h-60 max-w-full object-contain" src="{{ asset('storage/' . $filePath) }}" alt="{{ $fileName }}">
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <div class="empty-state flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 py-16 text-center">
            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-200">
                <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="mb-2 text-lg font-semibold text-gray-900">Chưa có tệp tin nào</h3>
            <p class="text-gray-500">Các tệp tin đính kèm sẽ được hiển thị tại đây</p>
        </div>
    @endif
</div>
<script>
    // Đóng modal khi click bên ngoài ảnh
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            hideImageModal();
        }
    });

    // Đóng modal khi nhấn ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideImageModal();
        }
    });

    // Ripple effect cho buttons
    function createRipple(event) {
        const button = event.currentTarget;
        const circle = document.createElement("span");
        const diameter = Math.max(button.clientWidth, button.clientHeight);
        const radius = diameter / 2;

        circle.style.width = circle.style.height = `${diameter}px`;
        circle.style.left = `${event.clientX - button.offsetLeft - radius}px`;
        circle.style.top = `${event.clientY - button.offsetTop - radius}px`;
        circle.classList.add("ripple");

        const ripple = button.getElementsByClassName("ripple")[0];
        if (ripple) {
            ripple.remove();
        }

        button.appendChild(circle);
    }

    // Add ripple effect to all buttons
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.btn-action');
        buttons.forEach(button => {
            button.addEventListener('click', createRipple);
        });
    });

    // Add CSS for ripple effect
    const style = document.createElement('style');
    style.textContent = `
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        .modal-content {
            transform: scale(0.9);
            opacity: 0;
            transition: all 0.2s ease-out;
        }
    `;
    document.head.appendChild(style);
</script>
