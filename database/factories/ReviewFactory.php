<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "doctor_id" => 1,
            "patient_id" => $this->faker->numberBetween(6, 10),
            "appointment_id" => $this->faker->numberBetween(1, 5),
            "review" => $this->faker->paragraph(),
            "recommend" => true,
        ];
    }

    public function underFiveStar()
    {
        return $this->state(function (array $attributes) {
            return [
                'rate' => $this->faker->randomFloat(1, 1, 4.9),
            ];
        });
    }

    public function fiveStar()
    {
        return $this->state(function (array $attributes) {
            return [
                'rate' => 5,
            ];
        });
    }
}
