<?php

namespace Database\Seeders;

use App\Models\MedicalCategory;
use Illuminate\Database\Seeder;

class MedicalCategorySeeder extends Seeder
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

        // Medical category seeder
        foreach ($dataArray['medical_categories'] as $data) {
            MedicalCategory::create($data);
        }
    }
}
