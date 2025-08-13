<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\User;
use App\Models\Review;
use App\Models\Appointment;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
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

        $appointments = $dataArray['appointments'];

        // Appointment seeder
        foreach ($appointments as $data) {
            $appointment = Appointment::create([
                'patient_profile_id' => 1,
                'doctor_profile_id' => 1,
                'service_id' => $data['service_id'],
                'hospital_id' => 1,
                'status' => $data['status'],
                'medical_problem' => $data['medical_problem'],
                'duration' => $data['duration'],
                'date' => $data['date'],
                'day_of_week' => $data['day_of_week'],
                'time' => $data['time'],
                'reason' => $data['reason'],
                'link' => $data['link'],
                'address' => $data['address'],
            ]);

            Bill::create([
                'id' => now()->timestamp . rand(1000, 9999),
                'hospital_id' => 1,
                'appointment_id' => $appointment->id,
                'payment_method' => $data['bill']['payment_method'],
                'taxVAT' => $data['bill']['taxVAT'],
                'total' => $data['bill']['total'],
                'status' => $data['bill']['status'],
            ]);

            if (isset($data['review'])) {
                Review::create([
                    'patient_profile_id' => 1,
                    'doctor_profile_id' => 1,
                    'appointment_id' => $appointment->id,
                    'rate' => $data['review']['rate'],
                    'review' => $data['review']['content'],
                    'recommend' => $data['review']['recommend'] ?? false,
                ]);
            }
        }
    }
}
