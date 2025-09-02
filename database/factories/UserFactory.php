<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Service;
use App\Models\DoctorProfile;
use App\Models\PatientProfile;
use App\Models\WorkSchedule;
use App\Models\UserInsurance;
use App\Models\Notification;
use App\Models\UserSetting;

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

            'avatar' => 'storage/uploads/avatar/default.png',
            'name' => $this->faker->unique()->firstName() . ' ' . $this->faker->unique()->lastName(),
            'country_code' => '+84',
            'phone' => $this->faker->phoneNumber(),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),

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
     * State for a admin user.
     */
    public function admin(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'user_type' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('Password1$'),
                'name' => 'Admin',
            ];
        })->afterCreating(function (User $user) {
            // Create 4 notifications for admin (2 unread, 2 read)
            $this->createNotificationsForUser($user);

            // Create user settings
            $this->createUserSettings($user);
        });
    }

    /**
     * State for a doctor user.
     */
    public function doctor(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'user_type' => 'healthcare',
                'identity' => 'doctor',
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

            // Create 4 notifications for each doctor (2 unread, 2 read)
            $this->createNotificationsForUser($user);

            // Create user settings
            $this->createUserSettings($user);
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
                'identity' => 'pharmacies',
            ];
        })->afterCreating(function (User $user) {
            $user->doctorProfile()->save(
                DoctorProfile::factory()->pharmacy()->make()
            );

            // Create 4 notifications for each pharmacy (2 unread, 2 read)
            $this->createNotificationsForUser($user);

            // Create user settings
            $this->createUserSettings($user);
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
                'identity' => 'hospital',
            ];
        })->afterCreating(function (User $user) {
            $user->doctorProfile()->save(
                DoctorProfile::factory()->hospital()->make()
            );

            // Create 4 notifications for each hospital (2 unread, 2 read)
            $this->createNotificationsForUser($user);

            // Create user settings
            $this->createUserSettings($user);
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

            $user->languages()->create([
                'user_id' => $user->id,
                'language_id' => $this->faker->randomElement([1, 2]),
            ]);

            if ($patientProfile->exists) {
                $patientProfile->insurance()->save(
                    UserInsurance::factory()->vietnameseInsurance()->make()
                );
            }

            // Create 4 notifications for each patient (2 unread, 2 read)
            $this->createNotificationsForUser($user);

            // Create user settings
            $this->createUserSettings($user);
        });
    }

    /**
     * Create 4 notifications for a user (2 unread, 2 read)
     */
    private function createNotificationsForUser(User $user)
    {
        // Create 2 unread notifications
        Notification::factory()->count(2)->unread()->create([
            'user_id' => $user->id,
            'appointment_id' => null, // You can set this to a random appointment if needed
        ]);

        // Create 2 read notifications
        Notification::factory()->count(2)->read()->create([
            'user_id' => $user->id,
            'appointment_id' => null, // You can set this to a random appointment if needed
        ]);
    }

    /**
     * Create user settings with default values
     */
    private function createUserSettings(User $user)
    {
        $defaultSettings = [
            'notification' => true,
            'promotion' => true,
            'sms' => true,
            'appNotification' => true,
            'message' => true,
            'customMessage' => true,
            'messagePrivacy' => true,
            'messageBackup' => true,
        ];

        foreach ($defaultSettings as $name => $value) {
            UserSetting::create([
                'user_id' => $user->id,
                'name' => $name,
                'value' => $value,
                'description' => null,
            ]);
        }
    }
}
