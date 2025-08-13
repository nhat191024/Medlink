<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Bill;

use App\Models\User;
use App\Models\Review;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Language;
use App\Models\Appointment;
use App\Models\UserSetting;
use App\Models\Notification;
use App\Models\UserLanguage;
use App\Models\WorkSchedule;
use App\Models\DoctorProfile;
use App\Models\Hospital;
use App\Models\Support;
use App\Models\UserInsurance;
use App\Models\PatientProfile;
use App\Models\MedicalCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Testing\Fakes\Fake;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $jsonFilePath = './database/seeders/data.json';
        $jsonContent = file_get_contents($jsonFilePath);
        $dataArray = json_decode($jsonContent, true);

        foreach ($dataArray['medical_categories'] as $data) {
            MedicalCategory::create($data);
        }

        foreach ($dataArray['languages'] as $data) {
            Language::create($data);
        }

        foreach ($dataArray['hospitals'] as $data) {
            Hospital::create($data);
        }

        foreach ($dataArray['admins'] as $data) {
            Admin::create([
                'name' => $data['name'],
                'password' => bcrypt($data['password']),
                'email' => $data['email'],
                'role' => $data['role'],
                'hospital_id' => $data['hospital_id'] ?? null,
            ]);
        }

        $usersData = $dataArray['users'];
        $medicalCategoryIds = MedicalCategory::pluck('id')->toArray();
        $appointments = $dataArray['appointments'];
        $supports = $dataArray['supports'];

        foreach ($usersData as $userData) {
            $user = User::create([
                "user_type" => $userData['user_type'],
                "identity" => $userData['identity'],
                "hospital_id" => $userData['hospital_id'],
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
                PatientProfile::create([
                    "user_id" => $user->id,
                    "birth_date" => $userData['patient']['birth_date'],
                    "age" => $userData['patient']['age'],
                    "height" => $userData['patient']['height'],
                    "weight" => $userData['patient']['weight'],
                    "blood_group" => $userData['patient']['blood_group'],
                    "medical_history" => $userData['patient']['medical_history']
                ]);

                UserInsurance::create([
                    "patient_profile_id" => 1,
                    "insurance_type" => $userData['patient']['insurances']['insurance_type'],
                    "insurance_number" => $userData['patient']['insurances']['insurance_number'],
                    "registry" => $userData['patient']['insurances']['registry'],
                    "registered_address" => $userData['patient']['insurances']['registered_address'],
                    "valid_from" => $userData['patient']['insurances']['vaild_from'],
                ]);
            } else if ($userData['identity'] === 'doctor') {
                $doctorProfile = DoctorProfile::create([
                    "user_id" => $user->id,
                    "medical_category_id" => random_int(1, count($medicalCategoryIds)),
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

        foreach ($appointments as $data) {
            $appointment = Appointment::create([
                'patient_profile_id' => 1,
                'doctor_profile_id' => 1,
                'service_id' => $data['service_id'],
                'hospital_id' => 1,
                'status' => $data['status'],
                'medical_problem' => $data['medical_problem'],
                'duration' => $data['duration'],
                'date' => $data['date'],
                'day_of_week' => $data['day_of_week'],
                'time' => $data['time'],
                'reason' => $data['reason'],
                'link' => $data['link'],
                'address' => $data['address'],
            ]);

            Bill::create([
                'id' => now()->timestamp . rand(1000, 9999),
                'hospital_id' => 1,
                'appointment_id' => $appointment->id,
                'payment_method' => $data['bill']['payment_method'],
                'taxVAT' => $data['bill']['taxVAT'],
                'total' => $data['bill']['total'],
                'status' => $data['bill']['status'],
            ]);

            if (isset($data['review'])) {
                Review::create([
                    'patient_profile_id' => 1,
                    'doctor_profile_id' => 1,
                    'appointment_id' => $appointment->id,
                    'rate' => $data['review']['rate'],
                    'review' => $data['review']['content'],
                    'recommend' => $data['review']['recommend'] ?? false,
                ]);
            }
        }

        foreach ($supports as $data) {
            Support::create($data);
        }

        //user factory
        // User::factory()->count(10)->doctor()->create();
        // User::factory()->count(4)->pharmacy()->create();
        // User::factory()->count(5)->hospital()->create();
        // User::factory()->count(20)->patient()->create();

        // $users = User::all();
        // foreach ($users as $user) {
        //     $username = $user->name;
        //     $usernameFirstLetter = mb_substr($username, 0, 1);
        //     $user->avatar = "https://ui-avatars.com/api/?name=" . urlencode($usernameFirstLetter) . "&background=random&size=512";
        //     $user->save();
        // }

        // //appointment factory
        // $doctorsID = DoctorProfile::whereIn('user_id', User::where('identity', 'doctor')->pluck('id'))->pluck('id')->toArray();
        // $patientsID = PatientProfile::whereIn('user_id', User::where('user_type', '=', 'patient')->pluck('id'))->pluck('id')->toArray();
        // Appointment::factory()->count(20)->withSeedData($doctorsID, $patientsID)->create();

        DB::table('app_settings')->insert([
            [
                'id' => '1',
                'tab' => 'app',
                'key' => 'app_logo',
                'value' => 'assets/site_logo.png',
            ],
            [
                'id' => '2',
                'tab' => 'app',
                'key' => 'app_dark_logo',
                'value' => 'assets/site_dark_logo.png',
            ],
            [
                'id' => '3',
                'tab' => 'app',
                'key' => 'app_favicon',
                'value' => 'assets/site_favicon.ico',
            ],
            [
                'id' => '4',
                'tab' => 'app',
                'key' => 'app_name',
                'value' => 'MedLink',
            ],
            [
                'id' => '5',
                'tab' => 'app',
                'key' => 'support_email',
                'value' => 'medlink@gmail.com',
            ],
            [
                'id' => '6',
                'tab' => 'app',
                'key' => 'support_phone_1',
                'value' => '+84793732392',
            ],
            [
                'id' => '7',
                'tab' => 'app',
                'key' => 'support_phone_2',
                'value' => '+84793732392',
            ],
        ]);
    }
}
