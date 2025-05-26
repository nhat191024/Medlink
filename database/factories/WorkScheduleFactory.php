<?php

namespace Database\Factories;

use App\Models\WorkSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkSchedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $startTime = $this->faker->time('H:i:s');
        $endTime = date("H:i:s", strtotime("+" . rand(1, 4) . " hours", strtotime($startTime)));

        return [
            'day_of_week' => $this->faker->randomElement($days),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'all_day' => $this->faker->boolean(),
        ];
    }
}
