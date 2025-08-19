<div class="space-y-4">
    @foreach ($files as $file)
        <div class="rounded-lg border border-gray-200 bg-white p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        @if (in_array(strtolower(pathinfo($file->name, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        @elseif(strtolower(pathinfo($file->name, PATHINFO_EXTENSION)) === 'pdf')
                            <svg class="h-8 w-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        @else
                            <svg class="h-8 w-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">{{ $file->name }}</h4>
                        <p class="text-sm text-gray-500">
                            {{ number_format($file->size / 1024, 1) }} KB
                            @if ($file->created_at)
                                • {{ $file->created_at->format('d/m/Y H:i') }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    @if (in_array(strtolower(pathinfo($file->name, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                        <button class="inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-1 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" type="button"
                            onclick="showImageModal('{{ asset('storage/' . $file->path) }}', '{{ $file->name }}')">
                            <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Xem
                        </button>
                    @endif
                    <a class="inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-1 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" href="{{ asset('storage/' . $file->path) }}" download="{{ $file->name }}">
                        <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Tải xuống
                    </a>
                </div>
            </div>

            @if (in_array(strtolower(pathinfo($file->name, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                <div class="mt-3">
                    <img class="h-auto max-w-full cursor-pointer rounded-md border border-gray-200 transition-opacity hover:opacity-90" src="{{ asset('storage/' . $file->path) }}" alt="{{ $file->name }}" onclick="showImageModal('{{ asset('storage/' . $file->path) }}', '{{ $file->name }}')" style="max-height: 200px;">
                </div>
            @endif
        </div>
    @endforeach
</div>

<!-- Modal xem ảnh -->
<div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 p-4" style="display: none;">
    <div class="flex min-h-full items-center justify-center">
        <div class="relative max-h-full max-w-4xl">
            <button class="absolute right-4 top-4 z-10 text-white hover:text-gray-300" onclick="hideImageModal()">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <img id="modalImage" class="max-h-full max-w-full object-contain" src="" alt="">
            <div class="absolute bottom-4 left-4 rounded bg-black bg-opacity-50 px-3 py-1 text-white">
                <span id="modalImageName"></span>
            </div>
        </div>
    </div>
</div>

<script>
    function showImageModal(imageSrc, imageName) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('modalImageName').textContent = imageName;
        const modal = document.getElementById('imageModal');
        modal.style.display = 'flex';
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function hideImageModal() {
        const modal = document.getElementById('imageModal');
        modal.style.display = 'none';
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Đóng modal khi click bên ngoài ảnh
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this || e.target.closest('.flex.items-center.justify-center.min-h-full') === e.target) {
            hideImageModal();
        }
    });

    // Đóng modal khi nhấn ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideImageModal();
        }
    });
</script>
