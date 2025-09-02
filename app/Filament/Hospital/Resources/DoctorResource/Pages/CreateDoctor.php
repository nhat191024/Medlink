<?php

namespace App\Filament\Hospital\Resources\DoctorResource\Pages;

use App\Filament\Hospital\Resources\DoctorResource;
use App\Models\DoctorProfile;
use App\Models\Service;
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
        $doctorProfile = DoctorProfile::create([
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

        $services = [
            [
                "icon" => "assets/icons/home_2.svg",
                "name" => "Khám tại nhà",
                "description" => "Bác sĩ sẽ đến tận nhà để khám bệnh cho bạn",
                "price" => 100000,
                "duration" => 30,
                "buffer_time" => 10,
                "seat" => 1,
                "is_active" => true
            ],
            [
                "icon" => "assets/icons/video_on.svg",
                "name" => "Tư vấn qua video",
                "description" => "Nhận lời khuyên và tư vấn từ bác sĩ qua video call",
                "price" => 50000,
                "duration" => 30,
                "buffer_time" => 10,
                "seat" => 2,
                "is_active" => true
            ],
            [
                "icon" => "assets/icons/first_aid_kit.svg",
                "name" => "Khám tại phòng khám",
                "description" => "Khám bệnh tại cơ sở y tế trực tiếp với bác sĩ",
                "price" => 100000,
                "duration" => 30,
                "buffer_time" => 10,
                "seat" => 3,
                "is_active" => true
            ],
            [
                "icon" => "assets/icons/online.svg",
                "name" => "Tư vấn cuộc gọi",
                "description" => "Nhận tư vấn qua cuộc gọi điện thoại với bác sĩ",
                "price" => 50000,
                "duration" => 30,
                "buffer_time" => 10,
                "seat" => 3,
                "is_active" => true
            ]
        ];

        foreach ($services as $service) {
            Service::create([
                'icon' => $service['icon'],
                'name' => $service['name'],
                'description' => $service['description'],
                'price' => $service['price'],
                'duration' => $service['duration'],
                'buffer_time' => $service['buffer_time'],
                'seat' => $service['seat'],
                'is_active' => $service['is_active'],
                'doctor_profile_id' => $doctorProfile->id,
            ]);
        }

        return $user;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
