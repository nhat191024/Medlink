<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\CheckAppointmentPending;
use App\Jobs\CheckAppointmentUpcoming;
use App\Jobs\ProcessDoctorPayment;
use App\Models\Appointment;

class RunAppointmentJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointment:job 
                            {action : Action to perform (check-pending, check-upcoming, process-payment)}
                            {--id= : Appointment ID}
                            {--latest : Use latest appointment}
                            {--status= : Filter by appointment status when using --latest}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run appointment-related jobs by ID or latest record';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');
        $id = $this->option('id');
        $useLatest = $this->option('latest');
        $status = $this->option('status');

        if (!$id && !$useLatest) {
            $this->error('You must specify either --id or --latest option');
            return 1;
        }

        $appointmentId = $this->getAppointmentId($id, $useLatest, $status);
        
        if (!$appointmentId) {
            return 1;
        }

        switch ($action) {
            case 'check-pending':
                $this->info("Dispatching CheckAppointmentPending job for appointment ID: {$appointmentId}");
                CheckAppointmentPending::dispatch($appointmentId);
                break;
            
            case 'check-upcoming':
                $this->info("Dispatching CheckAppointmentUpcoming job for appointment ID: {$appointmentId}");
                CheckAppointmentUpcoming::dispatch($appointmentId);
                break;
            
            case 'process-payment':
                $this->info("Dispatching ProcessDoctorPayment job for appointment ID: {$appointmentId}");
                ProcessDoctorPayment::dispatch($appointmentId);
                break;
            
            default:
                $this->error('Invalid action. Available actions: check-pending, check-upcoming, process-payment');
                return 1;
        }

        $this->info('Job dispatched successfully!');
        return 0;
    }

    /**
     * Get appointment ID based on options
     */
    private function getAppointmentId($id, $useLatest, $status = null)
    {
        if ($id) {
            $appointment = Appointment::find($id);
            if (!$appointment) {
                $this->error("Appointment not found with ID: {$id}");
                return null;
            }
            $this->info("Using appointment ID: {$appointment->id} (Status: {$appointment->status})");
            return $id;
        }

        if ($useLatest) {
            $query = Appointment::query();
            
            if ($status) {
                $query->where('status', $status);
            }
            
            $appointment = $query->latest()->first();
            
            if (!$appointment) {
                $this->error("No appointments found" . ($status ? " with status: {$status}" : ""));
                return null;
            }
            
            $this->info("Using latest appointment ID: {$appointment->id} (Status: {$appointment->status})");
            return $appointment->id;
        }

        return null;
    }
}
