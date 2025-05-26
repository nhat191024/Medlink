<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserInsurance>
 */
class UserInsuranceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'patient_profile_id' => User::factory(), // Sẽ được tự động điền khi dùng $user->insurance()->save()
        ];
    }

    /**
     * Indicate that the insurance is for a patient with Vietnamese insurance.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function vietnameseInsurance(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'insurance_type' => 'Vietnamese',
                'insurance_number' => $this->faker->unique()->numerify('VN-INS-#####'),
                'registry' => $this->faker->city(),
                'registered_address' => $this->faker->address(),
                'valid_from' => $this->faker->dateTimeBetween('-1 year', 'now'),
            ];
        });
    }

    /**
     * Indicate that the insurance is for a patient with international insurance.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function internationalInsurance(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'insurance_type' => 'public',
                'insurance_number' => $this->faker->unique()->numerify('INT-INS-#####'),
                'assurance_type' => $this->faker->randomElement(['basic', 'premium', 'gold']),
            ];
        });
    }
}
