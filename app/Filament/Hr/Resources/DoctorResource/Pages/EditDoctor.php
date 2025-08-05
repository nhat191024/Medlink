<?php

namespace App\Filament\Hr\Resources\DoctorResource\Pages;

use App\Filament\Hr\Resources\DoctorResource;
use App\Models\DoctorProfile;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditDoctor extends EditRecord
{
    protected static string $resource = DoctorResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load doctor profile data
        $doctorProfile = DoctorProfile::where('user_id', $data['id'])->first();

        if ($doctorProfile) {
            $data['professional_number'] = $doctorProfile->professional_number;
            $data['introduce'] = $doctorProfile->introduce;
            $data['medical_category_id'] = $doctorProfile->medical_category_id;
            $data['office_address'] = $doctorProfile->office_address;
            $data['company_name'] = $doctorProfile->company_name;
        }

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // Update user
        $record->update($data);

        // Update or create doctor profile
        $doctorProfile = DoctorProfile::where('user_id', $record->id)->first();

        if ($doctorProfile) {
            $doctorProfile->update([
                'professional_number' => $data['professional_number'] ?? $doctorProfile->professional_number,
                'introduce' => $data['introduce'] ?? $doctorProfile->introduce,
                'medical_category_id' => $data['medical_category_id'] ?? $doctorProfile->medical_category_id,
                'office_address' => $data['office_address'] ?? $doctorProfile->office_address,
                'company_name' => $data['company_name'] ?? $doctorProfile->company_name,
            ]);
        }

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
