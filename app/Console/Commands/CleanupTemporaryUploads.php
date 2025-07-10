<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CleanupTemporaryUploads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cleanup-temporary-uploads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $files = Storage::disk('tmp_uploads')->files();

        foreach ($files as $file) {
            $lastModified = Carbon::createFromTimestamp(Storage::disk('tmp_uploads')->lastModified($file));

            // Delete files older than 24 hours
            if ($lastModified->lt(now()->subHours(24))) {
                Storage::disk('tmp_uploads')->delete($file);
            }
        }

        $this->info('Temporary uploads cleaned up successfully.');
    }
}
