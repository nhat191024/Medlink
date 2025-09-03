<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\CheckAppointmentPending;
use App\Jobs\CheckAppointmentUpcoming;
use App\Models\Appointment;

class RunAppointmentJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointment:run-job {type} {appointment_id?} {--latest : Run job for the latest appointment}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run appointment jobs (pending or upcoming) for a specific appointment ID';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');
        $appointmentId = $this->argument('appointment_id');

        // Check if --latest option is used
        if ($this->option('latest')) {
            $latestAppointment = Appointment::latest()->first();

            if (!$latestAppointment) {
                $this->error('No appointments found in the database');
                return 1;
            }

            $appointmentId = $latestAppointment->id;
            $this->info("Using latest appointment ID: {$appointmentId}");
        } elseif (!$appointmentId) {
            $this->error('Please provide an appointment ID or use the --latest option');
            $this->line('Usage: php artisan appointment:run-job {pending|upcoming} {appointment_id} or --latest');
            return 1;
        }

        if (!is_numeric($appointmentId)) {
            $this->error('Appointment ID must be a number');
            return 1;
        }

        switch (strtolower($type)) {
            case 'pending':
                $this->info("Dispatching CheckAppointmentPending job for appointment ID: {$appointmentId}");
                CheckAppointmentPending::dispatch($appointmentId);
                $this->info('Job dispatched successfully');
                break;

            case 'upcoming':
                $this->info("Dispatching CheckAppointmentUpcoming job for appointment ID: {$appointmentId}");
                CheckAppointmentUpcoming::dispatch($appointmentId);
                $this->info('Job dispatched successfully');
                break;

            default:
                $this->error('Invalid job type. Use "pending" or "upcoming"');
                $this->line('Usage: php artisan appointment:run-job {pending|upcoming} {appointment_id} or --latest');
                return 1;
        }

        return 0;
    }
}
