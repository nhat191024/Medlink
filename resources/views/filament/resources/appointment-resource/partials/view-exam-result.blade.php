<div class="space-y-4">
    <div class="rounded-lg bg-white dark:bg-gray-900 p-4">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <div class="text-sm text-gray-600 dark:text-gray-300">
                <div>
                    <span class="font-medium">Bệnh nhân:</span>
                    {{ optional($record->patient->user)->name ?? '—' }}
                </div>
                <div>
                    <span class="font-medium">Bác sĩ:</span>
                    {{ optional($record->doctor->user)->name ?? '—' }}
                </div>
                <div>
                    <span class="font-medium">Dịch vụ:</span>
                    {{ optional($record->service)->name ?? '—' }}
                </div>
                <div class="flex flex-wrap gap-4">
                    <div>
                        <span class="font-medium">Ngày:</span>
                        {{ $record->date ? \Carbon\Carbon::parse($record->date)->format('d/m/Y') : '—' }}
                    </div>
                    <div>
                        <span class="font-medium">Giờ:</span>
                        {{ $record->time ?? '—' }}
                    </div>
                </div>
            </div>
            <div class="text-xs text-gray-500">
                Cập nhật: {{ optional(optional($examResult)->updated_at)->format('d/m/Y H:i') }}
            </div>
        </div>

        <div class="mt-4">
            <div class="text-sm font-semibold mb-2">Kết quả khám</div>
            <div class="prose max-w-none dark:prose-invert">
                {!! optional($examResult)->result ?? '<span class="text-gray-500">Không có</span>' !!}
            </div>
        </div>

        <div class="mt-4">
            <div class="text-sm font-semibold mb-2">Thông tin thuốc</div>
            @if(!empty(optional($examResult)->medication))
                <div class="rounded-md border p-3 text-sm whitespace-pre-wrap">{{ $examResult->medication }}</div>
            @else
                <div class="text-sm text-gray-500">Không có</div>
            @endif
        </div>

        <div class="mt-4">
            <div class="text-sm font-semibold mb-2">Tệp đính kèm</div>
            @php($files = optional($examResult)->files ?? collect())
            @if($files->count())
            <ul class="list-disc pl-5 space-y-1 text-sm">
                @foreach($files as $file)
                @php($url = asset('storage/' . ltrim($file->path, '/')))
                        <li>
                            <a href="{{ $url }}" target="_blank" class="text-primary-600 hover:underline">
                                {{ $file->original_name ?? basename($file->path) }}
                            </a>
                            <span class="ml-2 text-xs text-gray-500">{{ $file->mime_type }}</span>
                        </li>
                        @endforeach
                    </ul>
                @else
            <div class="text-sm text-gray-500">Không có</div>
            @endif
        </div>
    </div>
</div>