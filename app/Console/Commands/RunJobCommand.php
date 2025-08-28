<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\CheckAppointmentPending;
use App\Jobs\CheckAppointmentUpcoming;
use App\Jobs\ProcessDoctorPayment;
use App\Jobs\ImportDoctorsJob;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class RunJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:run 
                            {type : Type of job (check-pending, check-upcoming, doctor-payment, import-doctors)}
                            {--id= : Specific ID to process}
                            {--latest : Use latest record}
                            {--file= : File path for import jobs}
                            {--user-id= : User ID for import jobs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run specific jobs with ID or latest record';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');
        $id = $this->option('id');
        $useLatest = $this->option('latest');
        $filePath = $this->option('file');
        $userId = $this->option('user-id');

        if (!$id && !$useLatest) {
            $this->error('You must specify either --id or --latest option');
            return 1;
        }

        switch ($type) {
            case 'check-pending':
                return $this->runCheckAppointmentPending($id, $useLatest);
            
            case 'check-upcoming':
                return $this->runCheckAppointmentUpcoming($id, $useLatest);
            
            case 'doctor-payment':
                return $this->runProcessDoctorPayment($id, $useLatest);
            
            case 'import-doctors':
                return $this->runImportDoctors($filePath, $userId);
            
            default:
                $this->error('Invalid job type. Available types: check-pending, check-upcoming, doctor-payment, import-doctors');
                return 1;
        }
    }

    /**
     * Run CheckAppointmentPending job
     */
    private function runCheckAppointmentPending($id, $useLatest)
    {
        $appointmentId = $this->getAppointmentId($id, $useLatest, 'pending');
        
        if (!$appointmentId) {
            return 1;
        }

        $this->info("Dispatching CheckAppointmentPending job for appointment ID: {$appointmentId}");
        CheckAppointmentPending::dispatch($appointmentId);
        $this->info('Job dispatched successfully!');
        
        return 0;
    }

    /**
     * Run CheckAppointmentUpcoming job
     */
    private function runCheckAppointmentUpcoming($id, $useLatest)
    {
        $appointmentId = $this->getAppointmentId($id, $useLatest, 'upcoming');
        
        if (!$appointmentId) {
            return 1;
        }

        $this->info("Dispatching CheckAppointmentUpcoming job for appointment ID: {$appointmentId}");
        CheckAppointmentUpcoming::dispatch($appointmentId);
        $this->info('Job dispatched successfully!');
        
        return 0;
    }

    /**
     * Run ProcessDoctorPayment job
     */
    private function runProcessDoctorPayment($id, $useLatest)
    {
        $appointmentId = $this->getAppointmentId($id, $useLatest, 'completed');
        
        if (!$appointmentId) {
            return 1;
        }

        $this->info("Dispatching ProcessDoctorPayment job for appointment ID: {$appointmentId}");
        ProcessDoctorPayment::dispatch($appointmentId);
        $this->info('Job dispatched successfully!');
        
        return 0;
    }

    /**
     * Run ImportDoctorsJob
     */
    private function runImportDoctors($filePath, $userId)
    {
        if (!$filePath) {
            $this->error('File path is required for import-doctors job. Use --file option');
            return 1;
        }

        if (!$userId) {
            $this->error('User ID is required for import-doctors job. Use --user-id option');
            return 1;
        }

        // Check if file exists
        if (!Storage::exists($filePath) && !file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return 1;
        }

        // Check if user exists
        if (!User::find($userId)) {
            $this->error("User not found: {$userId}");
            return 1;
        }

        $this->info("Dispatching ImportDoctorsJob for file: {$filePath} and user ID: {$userId}");
        ImportDoctorsJob::dispatch($filePath, $userId);
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
