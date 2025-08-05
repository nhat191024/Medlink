<?php

namespace App\Filament\Hr\Resources\DoctorResource\Pages;

use App\Filament\Hr\Resources\DoctorResource;
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
        $data['status'] = 'waiting-approval';
        $data['hospital_id'] = Auth::guard('admin')->user()->hospital_id;

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
        ]);

        return $user;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
