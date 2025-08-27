<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\UserSetting;
use App\Models\UserLanguage;
use App\Models\WorkSchedule;
use App\Models\DoctorProfile;
use App\Models\Hospital;
use App\Models\UserInsurance;
use App\Models\PatientProfile;
use App\Models\MedicalCategory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonFilePath = './database/seeders/data.json';
        $jsonContent = file_get_contents($jsonFilePath);
        $dataArray = json_decode($jsonContent, true);

        $usersData = $dataArray['users'];
        $medicalCategoryId = MedicalCategory::latest('id')->first()->id;
        $hospitalId = Hospital::latest('id')->first()->id;

        // User seeder
        foreach ($usersData as $userData) {
            $user = User::create([
                "user_type" => $userData['user_type'],
                "identity" => $userData['identity'],
                "hospital_id" => $userData['identity'] === 'doctor' ? random_int(1, $hospitalId) : null,
                "email" => $userData['email'],
                "password" => bcrypt($userData['password']),
                "avatar" => $userData['avatar'],
                "name" => $userData['name'],
                "gender" => $userData['gender'],
                "country_code" => $userData['country_code'],
                "phone" => $userData['phone'],
                "latitude" => $userData['latitude'],
                "longitude" => $userData['longitude'],
                "country" => $userData['country'],
                "city" => $userData['city'],
                "ward" => $userData['ward'],
                "address" => $userData['address'],
                "zip_code" => $userData['zip_code']
            ]);

            $defaultSettings = [
                'notification' => true,
                'promotion' => true,
                'sms' => true,
                'appNotification' => true,
                'message' => true,
                'customMessage' => true,
                'messagePrivacy' => true,
                'messageBackup' => true,
            ];

            foreach ($defaultSettings as $name => $value) {
                UserSetting::create([
                    'user_id' => $user->id,
                    'name' => $name,
                    'value' => $value,
                    'description' => null,
                ]);
            }

            UserLanguage::create([
                'user_id' => $user->id,
                'language_id' => 1,
            ]);

            if ($userData['identity'] === 'none') {
                $patientProfile = PatientProfile::create([
                    "user_id" => $user->id,
                    "birth_date" => $userData['patient']['birth_date'],
                    "age" => $userData['patient']['age'],
                    "height" => $userData['patient']['height'],
                    "weight" => $userData['patient']['weight'],
                    "blood_group" => $userData['patient']['blood_group'],
                    "medical_history" => $userData['patient']['medical_history']
                ]);

                UserInsurance::create([
                    "patient_profile_id" => $patientProfile->id,
                    "insurance_type" => $userData['patient']['insurances']['insurance_type'],
                    "insurance_number" => $userData['patient']['insurances']['insurance_number'],
                    "registry" => $userData['patient']['insurances']['registry'],
                    "registered_address" => $userData['patient']['insurances']['registered_address'],
                    "valid_from" => $userData['patient']['insurances']['vaild_from'],
                ]);
            } else if ($userData['identity'] === 'doctor') {
                $doctorProfile = DoctorProfile::create([
                    "user_id" => $user->id,
                    "medical_category_id" => random_int(1, $medicalCategoryId),
                    "id_card_path" => $userData['doctor']['id_card_path'],
                    "medical_degree_path" => $userData['doctor']['medical_degree_path'],
                    "professional_number" => $userData['doctor']['professional_number'],
                    "introduce" => $userData['doctor']['introduce'],
                    "office_address" => $userData['doctor']['office_address'],
                    "company_name" => $userData['doctor']['company_name'],
                ]);

                foreach ($userData['doctor']['work_schedules'] as $schedule) {
                    WorkSchedule::create([
                        'doctor_profile_id' => $doctorProfile->id,
                        'day_of_week' => $schedule['day_of_week'],
                        'start_time' => $schedule['start_time'] ?? null,
                        'end_time' => $schedule['end_time'] ?? null,
                        "all_day" => $schedule['all_day'],
                    ]);
                }

                foreach ($dataArray['services'] as $data) {
                    Service::create([
                        'icon' => $data['icon'],
                        'name' => $data['name'],
                        'description' => $data['description'],
                        'price' => $data['price'],
                        'duration' => $data['duration'],
                        'buffer_time' => $data['buffer_time'],
                        'seat' => $data['seat'],
                        'is_active' => $data['is_active'],
                        'doctor_profile_id' => $doctorProfile->id,
                    ]);
                }
            }
        }
    }
}
