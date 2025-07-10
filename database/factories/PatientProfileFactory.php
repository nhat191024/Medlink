<?php

namespace Database\Factories;

use App\Models\PatientProfile;
use App\Models\UserInsurance;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientProfile>
 */
class PatientProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id' => User::factory(), // Sẽ được tự động điền khi dùng $user->doctorProfile()->save()
            'birth_date' => $this->faker->date(),
            'age' => $this->faker->numberBetween(1, 100),
            'height' => $this->faker->numberBetween(140, 200), // Chiều cao từ 140cm đến 200cm
            'weight' => $this->faker->numberBetween(40, 120), // Cân nặng từ 40kg đến 120kg
            'blood_group' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
            'medical_history' => $this->faker->paragraph(),
        ];
    }
}
