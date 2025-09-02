<?php

namespace App\Filament\Hospital\Resources\DoctorResource\Pages;

use App\Filament\Hospital\Resources\DoctorResource;
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
            $data['id_card_path'] = $doctorProfile->id_card_path;
            $data['medical_degree_path'] = $doctorProfile->medical_degree_path;
            $data['professional_card_path'] = $doctorProfile->professional_card_path;
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
                'id_card_path' => $data['id_card_path'] ?? $doctorProfile->id_card_path,
                'medical_degree_path' => $data['medical_degree_path'] ?? $doctorProfile->medical_degree_path,
                'professional_card_path' => $data['professional_card_path'] ?? $doctorProfile->professional_card_path,
            ]);
        }

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
