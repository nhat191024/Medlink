<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ImportDoctorsJob;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class RunImportDoctorsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'doctors:import 
                            {file : Path to the Excel file}
                            {--user-id= : User ID who is performing the import}
                            {--latest-user : Use the latest admin user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import doctors from Excel file using ImportDoctorsJob';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = $this->argument('file');
        $userId = $this->option('user-id');
        $useLatestUser = $this->option('latest-user');

        // Validate file
        if (!Storage::exists($filePath) && !file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            $this->info("Please make sure the file exists in the storage or provide full path.");
            return 1;
        }

        // Get user ID
        if (!$userId && !$useLatestUser) {
            $this->error('You must specify either --user-id or --latest-user option');
            return 1;
        }

        if ($useLatestUser) {
            $user = User::where('role', 'admin')->latest()->first();
            if (!$user) {
                $this->error('No admin user found');
                return 1;
            }
            $userId = $user->id;
            $this->info("Using latest admin user: {$user->name} (ID: {$userId})");
        } else {
            $user = User::find($userId);
            if (!$user) {
                $this->error("User not found with ID: {$userId}");
                return 1;
            }
            $this->info("Using user: {$user->name} (ID: {$userId})");
        }

        // Show file info
        if (Storage::exists($filePath)) {
            $fileSize = Storage::size($filePath);
            $this->info("File: {$filePath} (Size: " . number_format($fileSize / 1024, 2) . " KB)");
        } else {
            $fileSize = filesize($filePath);
            $this->info("File: {$filePath} (Size: " . number_format($fileSize / 1024, 2) . " KB)");
        }

        // Confirm before processing
        if (!$this->confirm('Do you want to proceed with the import?', true)) {
            $this->info('Import cancelled.');
            return 0;
        }

        // Dispatch the job
        $this->info("Dispatching ImportDoctorsJob...");
        ImportDoctorsJob::dispatch($filePath, $userId);
        
        $this->info('✓ Import job has been dispatched successfully!');
        $this->info('You can monitor the progress in your notifications or logs.');
        
        return 0;
    }
}
