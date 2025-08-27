<div class="p-6">
    <div class="mb-4 flex items-center space-x-4">
        <img class="h-10 w-10 rounded-full object-cover pr-2" src="{{ asset($review->patient->user->avatar) }}" alt="{{ $review->patient->user->name }}">
        <div>
            <h3 class="text-lg font-semibold">{{ $review->patient->user->name }}</h3>
            <p class="text-gray-600">{{ $review->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="mb-4">
        <div class="mb-2 flex items-center space-x-2">
            <span class="text-yellow-500">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $review->rate)
                        ⭐
                    @else
                        ☆
                    @endif
                @endfor
            </span>
            <span class="font-semibold">{{ $review->rate }}/5</span>
        </div>

        @if ($review->recommend)
            <div class="inline-flex items-center rounded-full bg-green-100 px-2 py-1 text-xs text-green-800">
                ✓ Khuyến nghị bác sĩ này
            </div>
        @else
            <div class="inline-flex items-center rounded-full bg-red-100 px-2 py-1 text-xs text-red-800">
                ✗ Không khuyến nghị
            </div>
        @endif
    </div>

    @if ($review->review)
        <div class="mb-4">
            <h4 class="mb-2 font-semibold">Nội dung đánh giá:</h4>
            <p class="rounded-lg bg-gray-50 p-3 text-gray-700">{{ $review->review }}</p>
        </div>
    @endif

    @if ($review->appointment)
        <div class="border-t pt-4">
            <h4 class="mb-2 font-semibold">Thông tin lịch hẹn:</h4>
            <div class="text-sm text-gray-600">
                <p><strong>Ngày khám:</strong> {{ $review->appointment->date }}</p>
                <p><strong>Giờ khám:</strong> {{ $review->appointment->time }}</p>
                @if ($review->appointment->service)
                    <p><strong>Dịch vụ:</strong> {{ $review->appointment->service->name }}</p>
                @endif
            </div>
        </div>
    @endif
</div>
