<div>
    {{-- Hiển thị hình ảnh --}}
    @if ($record->doctorProfile)
        @if ($record->identity == 'doctor')
            <div class="flex justify-center gap-8 space-x-8">
                <div class="flex flex-col items-center">
                    <p class="mb-2 text-center text-gray-600">{{ __('doctor.admin.id_card') }}</p>
                    <img class="h-48 w-48 object-cover" src="{{ asset($record->doctorProfile->id_card_path) }}" alt="ID Card Image">
                </div>
                <div class="flex flex-col items-center">
                    <p class="mb-2 text-center text-gray-600">{{ __('doctor.admin.medical_degree') }}</p>
                    <img class="h-48 w-48 object-cover" src="{{ asset($record->doctorProfile->medical_degree_path) }}" alt="Medical Degree Image">
                </div>
            </div>
        @elseif ($record->identity == 'pharmacies')
            <div class="flex justify-center gap-8 space-x-8">
                <div class="flex flex-col items-center">
                    <p class="mb-2 text-center text-gray-600">{{ __('doctor.admin.professional_card') }}</p>
                    <img class="h-48 w-48 object-cover" src="{{ asset($record->doctorProfile->professional_card_path) }}" alt="ID Card Image">
                </div>
                <div class="flex flex-col items-center">
                    <p class="mb-2 text-center text-gray-600">{{ __('doctor.admin.exploitation_license') }}</p>
                    <img class="h-48 w-48 object-cover" src="{{ asset($record->doctorProfile->exploitation_license_path) }}" alt="Medical Degree Image">
                </div>
            </div>
        @elseif($record->identity == 'hospital')
            <div class="flex justify-center gap-8 space-x-8">
                <div class="flex flex-col items-center">
                    <p class="mb-2 text-center text-gray-600">{{ __('doctor.admin.exploitation_license') }}</p>
                    <img class="h-48 w-48 object-cover" src="{{ asset($record->doctorProfile->exploitation_license_path) }}" alt="ID Card Image">
                </div>
            </div>
        @endif
    @else
        <p class="text-center text-gray-500">{{ __('common.no_image') }}</p>
    @endif
</div>
