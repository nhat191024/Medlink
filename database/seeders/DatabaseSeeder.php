<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MedicalCategorySeeder::class,
            LanguageSeeder::class,
            HospitalSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            AppointmentSeeder::class,
            SupportSeeder::class,
            AppSettingSeeder::class,
        ]);
    }
}
