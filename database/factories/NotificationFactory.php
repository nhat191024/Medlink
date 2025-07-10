<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = [
            'Appointment Confirmed',
            'Appointment Reminder',
            'Payment Received',
            'Prescription Ready',
            'Test Results Available',
            'Appointment Cancelled',
            'New Message Received',
            'Schedule Updated'
        ];

        return [
            'title' => $this->faker->randomElement($titles),
            'status' => $this->faker->randomElement(['read', 'unread']),
        ];
    }

    /**
     * State for unread notification.
     */
    public function unread(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'unread',
            ];
        });
    }

    /**
     * State for read notification.
     */
    public function read(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'read',
            ];
        });
    }
}
