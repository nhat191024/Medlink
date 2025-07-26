<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use App\Jobs\UpdateAppointmentStatus;
use Carbon\Carbon;

class CheckAppointmentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointments:check-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update appointment status from upcoming to waiting when appointment time arrives';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking appointment status...');

        // Find all upcoming appointments
        $upcomingAppointments = Appointment::where('status', 'upcoming')
            ->where('date', '<=', now()->addHours(1)->toDateString()) // Check appointments within next hour
            ->get();

        if ($upcomingAppointments->isEmpty()) {
            $this->info('No upcoming appointments found to check.');
            return;
        }

        $this->info("Found {$upcomingAppointments->count()} upcoming appointments to check.");

        $updatedCount = 0;

        foreach ($upcomingAppointments as $appointment) {
            try {
                // Parse appointment datetime
                $appointmentDateTime = $this->parseAppointmentDateTime($appointment->date, $appointment->time);

                if (!$appointmentDateTime) {
                    $this->warn("Could not parse datetime for appointment {$appointment->id}");
                    continue;
                }

                $now = Carbon::now();

                // Check if appointment time has arrived (allow 5 minutes early)
                if ($now->gte($appointmentDateTime->subMinutes(5))) {
                    $appointment->update(['status' => 'waiting']);
                    $updatedCount++;
                    $this->info("Updated appointment {$appointment->id} to waiting status");
                } else {
                    // Schedule job for future processing if not already scheduled
                    $jobDelay = $appointmentDateTime->subMinutes(5);
                    if ($jobDelay->gt($now)) {
                        UpdateAppointmentStatus::dispatch($appointment->id)->delay($jobDelay);
                        $this->info("Scheduled job for appointment {$appointment->id} at {$jobDelay}");
                    }
                }
            } catch (\Exception $e) {
                $this->error("Error processing appointment {$appointment->id}: " . $e->getMessage());
            }
        }

        $this->info("Command completed. Updated {$updatedCount} appointments to waiting status.");
    }

    /**
     * Parse appointment date and time to Carbon instance
     *
     * @param string $date Format: 2026-06-25
     * @param string $time Format: 01:00 PM - 01:30 PM
     * @return Carbon|null
     */
    private function parseAppointmentDateTime($date, $time)
    {
        try {
            // Extract start time from time range (01:00 PM - 01:30 PM -> 01:00 PM)
            $timeRange = explode(' - ', $time);
            $startTime = trim($timeRange[0]);

            // Combine date and start time
            $dateTimeString = $date . ' ' . $startTime;

            // Parse using Carbon
            return Carbon::createFromFormat('Y-m-d h:i A', $dateTimeString);
        } catch (\Exception $e) {
            return null;
        }
    }
}
