<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
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

        // Admin account seeder
        foreach ($dataArray['admins'] as $data) {
            Admin::create([
                'name' => $data['name'],
                'password' => bcrypt($data['password']),
                'email' => $data['email'],
                'role' => $data['role'],
                'hospital_id' => $data['hospital_id'] ?? null,
            ]);
        }
    }
}
