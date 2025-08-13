<?php

namespace Database\Seeders;

use App\Models\Support;
use Illuminate\Database\Seeder;

class SupportSeeder extends Seeder
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

        $supports = $dataArray['supports'];

        // Support seeder
        foreach ($supports as $data) {
            Support::create($data);
        }
    }
}
