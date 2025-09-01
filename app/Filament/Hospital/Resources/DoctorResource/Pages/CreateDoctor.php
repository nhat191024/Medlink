<?php

namespace App\Filament\Hospital\Resources\DoctorResource\Pages;

use App\Filament\Hospital\Resources\DoctorResource;
use App\Models\DoctorProfile;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class CreateDoctor extends CreateRecord
{
    protected static string $resource = DoctorResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // Set default values for doctor
        $data['user_type'] = 'healthcare';
        $data['identity'] = 'doctor';
        $data['status'] = 'active';
        $data['hospital_id'] = Auth::user()->id;

        // Create user
        $user = static::getModel()::create($data);

        // Create doctor profile
        DoctorProfile::create([
            'user_id' => $user->id,
            'professional_number' => $data['professional_number'],
            'introduce' => $data['introduce'] ?? '',
            'medical_category_id' => $data['medical_category_id'],
            'office_address' => $data['office_address'] ?? '',
            'company_name' => $data['company_name'] ?? '',
            'id_card_path' => $data['id_card_path'] ?? null,
            'medical_degree_path' => $data['medical_degree_path'] ?? null,
            'professional_card_path' => $data['professional_card_path'] ?? null,
        ]);

        return $user;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
