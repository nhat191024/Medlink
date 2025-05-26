<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\DoctorProfile;
use Illuminate\Container\Attributes\Log;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    protected $seedDoctorsID = null;
    protected $seedPatientsID = null;

    public function withSeedData(array $doctorsID, array $patientsID)
    {
        $this->seedDoctorsID = $doctorsID;
        $this->seedPatientsID = $patientsID;
        return $this;
    }

    public function definition(): array
    {
        $doctorsID = $this->seedDoctorsID ?? DoctorProfile::pluck('user_id')->toArray();
        $patientsID = $this->seedPatientsID ?? User::where('user_type', 'patient')->pluck('id')->toArray();

        $doctorID = $this->faker->randomElement($doctorsID);
        $patientID = $this->faker->randomElement($patientsID);

        $serviceID = $this->faker->randomElement(
            DoctorProfile::find($doctorID)->services()->pluck('id')->toArray()
        );

        return [
            'patient_profile_id' => $patientID,
            'doctor_profile_id' => $doctorID,
            'service_id' => $serviceID,
            'status' => $this->faker->randomElement(['cancelled', 'rejected', 'pending', 'upcoming', 'Completed']),
            'medical_problem' => $this->faker->sentence(),
            'medical_problem_file' => 'documents/' . $this->faker->uuid() . '.pdf',
            'duration' => 30,
            'date' => $this->faker->dateTimeBetween('2025-05-01', '+2 years')->format('Y-m-d'),
            'day_of_week' => $this->faker->dayOfWeek(),
            'time' => function () {
                $startMinutes = $this->faker->randomElement([0, 30]);
                $startHour = $this->faker->numberBetween(7, 20); // ví dụ từ 7h đến 20h
                $startTime = sprintf('%02d:%02d', $startHour, $startMinutes);
                $endTime = date('H:i', strtotime($startTime . ' +30 minutes'));
                return date('h:i A', strtotime($startTime)) . ' - ' . date('h:i A', strtotime($endTime));
            },
            'reason' => $this->faker->sentence(),
            'link' => $this->faker->url(),
            'address' => str_replace("\n", " ", $this->faker->address()),
        ];
    }
}
