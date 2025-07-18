<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use App\Models\Bill;
use App\Models\User;
use App\Models\Review;
use App\Models\Setting;
use App\Models\Language;

use App\Models\Appointment;
use App\Models\Notification;
use App\Models\DoctorProfile;

use App\Models\MedicalCategory;
use App\Models\PatientProfile;
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
        User::factory()->count(1)->admin()->create();
        User::factory()->count(10)->doctor()->create();
        User::factory()->count(4)->pharmacy()->create();
        User::factory()->count(5)->hospital()->create();
        User::factory()->count(20)->patient()->create();

        $users = User::all();
        foreach ($users as $user) {
            $username = $user->name;
            $usernameFirstLetter = mb_substr($username, 0, 1);
            $user->avatar = "https://ui-avatars.com/api/?name=" . urlencode($usernameFirstLetter) . "&background=random&size=512";
            $user->save();
        }

        //appointment factory
        $doctorsID = DoctorProfile::whereIn('user_id', User::where('identity', 'doctor')->pluck('id'))->pluck('id')->toArray();
        $patientsID = PatientProfile::whereIn('user_id', User::where('user_type', '=', 'patient')->pluck('id'))->pluck('id')->toArray();
        Appointment::factory()->count(10)->withSeedData($doctorsID, $patientsID)->create();

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
