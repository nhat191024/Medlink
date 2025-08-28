<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\DB;

class JobManagerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:manage 
                            {action : Action to perform (list, clear, stats)}
                            {--queue= : Specific queue name}
                            {--limit=10 : Limit for listing}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manage job queues - list, clear, and show statistics';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');
        $queue = $this->option('queue');
        $limit = $this->option('limit');

        switch ($action) {
            case 'list':
                return $this->listJobs($queue, $limit);
            
            case 'clear':
                return $this->clearQueue($queue);
            
            case 'stats':
                return $this->showStats();
            
            default:
                $this->error('Invalid action. Available actions: list, clear, stats');
                return 1;
        }
    }

    /**
     * List jobs in queue
     */
    private function listJobs($queue, $limit)
    {
        $this->info('Available Jobs Information:');
        $this->info('========================');
        
        // Show recent appointments that can be used with jobs
        $this->info('Recent Appointments (for job reference):');
        $appointments = Appointment::with(['patient', 'doctor'])
            ->latest()
            ->limit($limit)
            ->get();

        if ($appointments->isEmpty()) {
            $this->warn('No appointments found');
        } else {
            $headers = ['ID', 'Status', 'Patient', 'Doctor', 'Created'];
            $rows = [];

            foreach ($appointments as $appointment) {
                $rows[] = [
                    $appointment->id,
                    $appointment->status,
                    $appointment->patient->name ?? 'N/A',
                    $appointment->doctor->user->name ?? 'N/A',
                    $appointment->created_at->format('Y-m-d H:i:s')
                ];
            }

            $this->table($headers, $rows);
        }

        // Show failed jobs if any
        $this->info("\nFailed Jobs:");
        try {
            $failedJobs = DB::table('failed_jobs')->latest()->limit($limit)->get();
            
            if ($failedJobs->isEmpty()) {
                $this->info('No failed jobs found');
            } else {
                $headers = ['ID', 'Queue', 'Payload', 'Failed At'];
                $rows = [];

                foreach ($failedJobs as $job) {
                    $payload = json_decode($job->payload, true);
                    $jobClass = $payload['displayName'] ?? 'Unknown';
                    
                    $rows[] = [
                        $job->id,
                        $job->queue,
                        $jobClass,
                        $job->failed_at
                    ];
                }

                $this->table($headers, $rows);
            }
        } catch (\Exception $e) {
            $this->warn('Could not fetch failed jobs: ' . $e->getMessage());
        }

        return 0;
    }

    /**
     * Clear queue
     */
    private function clearQueue($queue)
    {
        try {
            if ($queue) {
                $this->info("Clearing failed jobs from queue: {$queue}");
                $this->call('queue:clear', ['--queue' => $queue]);
            } else {
                $this->info("Clearing failed jobs from default queue");
                $this->call('queue:clear');
            }
            
            $this->info('Queue cleared successfully!');
        } catch (\Exception $e) {
            $this->error('Failed to clear queue: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }

    /**
     * Show queue statistics
     */
    private function showStats()
    {
        $this->info('Job Queue Statistics:');
        $this->info('====================');

        // Appointment statistics
        $appointmentStats = [
            'Total Appointments' => Appointment::count(),
            'Pending Appointments' => Appointment::where('status', 'pending')->count(),
            'Upcoming Appointments' => Appointment::where('status', 'upcoming')->count(),
            'Completed Appointments' => Appointment::where('status', 'completed')->count(),
        ];

        foreach ($appointmentStats as $label => $count) {
            $this->info("{$label}: {$count}");
        }

        // Failed jobs count
        try {
            $failedJobsCount = DB::table('failed_jobs')->count();
            $this->info("Failed Jobs: {$failedJobsCount}");
        } catch (\Exception $e) {
            $this->warn('Could not fetch failed jobs count');
        }

        // Available job types
        $this->info("\nAvailable Job Types:");
        $this->info("- CheckAppointmentPending");
        $this->info("- CheckAppointmentUpcoming"); 
        $this->info("- ProcessDoctorPayment");
        $this->info("- ImportDoctorsJob");

        return 0;
    }
}
