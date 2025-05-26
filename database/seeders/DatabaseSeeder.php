<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use App\Models\Language;
use App\Models\Appointment;
use App\Models\DoctorProfile;
use App\Models\MedicalCategory;

use App\Models\Bill;
use App\Models\Review;
use App\Models\Notification;

use Illuminate\Database\Seeder;
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

        //user factory
        User::factory()->count(env('DEMO_DOCTORS'))->doctor()->create();
        User::factory()->count(env('DEMO_PHARMACISTS'))->pharmacy()->create();
        User::factory()->count(env('DEMO_HOSPITALS'))->hospital()->create();
        User::factory()->count(env('DEMO_PATIENTS'))->patient()->create();

        //setting factory
        Setting::factory()->count(1)->create();

        //appointment factory
        $doctorsID = DoctorProfile::where('identity', '=', 'doctor')->pluck('user_id')->toArray();
        $patientsID = User::where('user_type', 'patient')->pluck('id')->toArray();
        Appointment::factory()->count(10)->withSeedData($doctorsID, $patientsID)->create();
    }
}
