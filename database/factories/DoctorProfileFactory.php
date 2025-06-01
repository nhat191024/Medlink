<?php

namespace Database\Factories;

use App\Models\MedicalCategory;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DoctorProfile>
 */
class DoctorProfileFactory extends Factory
{
    protected static $dataArray = null;

    protected static function getDataArray()
    {
        if (is_null(self::$dataArray)) {
            $jsonFilePath = base_path('./database/seeders/data.json');
            $jsonContent = file_get_contents($jsonFilePath);
            self::$dataArray = json_decode($jsonContent, true);
        }
        return self::$dataArray;
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id' => User::factory(), // Sẽ được tự động điền khi dùng $user->doctorProfile()->save()
        ];
    }

    /**
     * Indicate that the doctor profile is for a doctor.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function doctor(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'id_card_path' => 'storage/upload/doctor_assets/id-card.png',
                'medical_degree_path' => 'storage/upload/doctor_assets/medical-degree.png',
                'professional_number' => $this->faker->unique()->numerify('PROF-#####'),

                'medical_category_id' => MedicalCategory::inRandomOrder()->first()->id,
            ];
        });
    }

    /**
     * Indicate that the doctor profile is for a pharmacy.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function pharmacy(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'id_card_path' => 'storage/upload/doctor_assets/id-card.png',
                'medical_license_path' => 'storage/upload/doctor_assets/medical-degree.png',
                'professional_number' => $this->faker->unique()->numerify('PHARM-#####'),
            ];
        });
    }

    /**
     * Indicate that the doctor profile is for a hospital.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function hospital(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'medical_license_path' =>  'storage/upload/doctor_assets/medical-degree.png',
            ];
        });
    }
}
