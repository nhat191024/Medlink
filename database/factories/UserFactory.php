<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Service;
use App\Models\DoctorProfile;
use App\Models\PatientProfile;
use App\Models\WorkSchedule;
use App\Models\UserInsurance;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
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
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('Password1$'),

            'avatar' => 'upload/avatar/default.png',
            'full_name' => $this->faker->name(),
            'country_code' => '+84',
            'phone' => $this->faker->phoneNumber(),

            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),

            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'address' => str_replace("\n", " ", $this->faker->address()),
            'zip_code' => $this->faker->postcode(),
        ];
    }

    /**
     * State for a doctor user.
     */
    public function doctor(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'user_type' => 'healthcare',
            ];
        })->afterCreating(function (User $user) {
            $doctorProfile = DoctorProfile::factory()->doctor()->make();
            $user->doctorProfile()->save($doctorProfile);

            $user->languages()->create([
                'user_id' => $user->id,
                'language_id' => $this->faker->randomElement([1, 2]),
            ]);

            $dataArray = self::getDataArray();
            foreach ($dataArray['services'] as $data) {
                Service::create([
                    'icon' => $data['icon'],
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'duration' => $data['duration'],
                    'buffer_time' => $data['buffer_time'],
                    'seat' => $data['seat'],
                    'is_active' => $data['is_active'],
                    'doctor_profile_id' => $doctorProfile->id,
                ]);
            }


            $numberOfWorkSchedules = rand(1, 7);
            if ($doctorProfile->exists) {
                $doctorProfile->workSchedules()->createMany(
                    WorkSchedule::factory()->count($numberOfWorkSchedules)->make()->toArray()
                );
            }
        });
    }

    /**
     * State for a pharmacy user.
     */
    public function pharmacy(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'user_type' => 'healthcare',
            ];
        })->afterCreating(function (User $user) {
            $user->doctorProfile()->save(
                DoctorProfile::factory()->pharmacy()->make()
            );
        });
    }

    /**
     * State for a hospital user.
     */
    public function hospital(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'user_type' => 'healthcare',
            ];
        })->afterCreating(function (User $user) {
            $user->doctorProfile()->save(
                DoctorProfile::factory()->hospital()->make()
            );
        });
    }

    /**
     * State for a patient user.
     */
    public function patient(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'user_type' => 'patient',
            ];
        })->afterCreating(function (User $user) {
            $patientProfile = PatientProfile::factory()->make();
            $user->patientProfile()->save($patientProfile);

            if ($patientProfile->exists) {
                $patientProfile->insurance()->save(
                    UserInsurance::factory()->vietnameseInsurance()->make()
                );
            }
        });
    }
}
