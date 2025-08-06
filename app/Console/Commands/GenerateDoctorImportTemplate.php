<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\DoctorImportController;

class GenerateDoctorImportTemplate extends Command
{
    protected $signature = 'doctor:generate-import-template';
    protected $description = 'Generate Excel template for doctor import';

    public function handle()
    {
        $controller = new DoctorImportController();

        try {
            $controller->generateTemplate();
            $this->info('Doctor import template generated successfully at: ' . storage_path('app/templates/doctor_import_template.csv'));
            return 0;
        } catch (\Exception $e) {
            $this->error('Failed to generate template: ' . $e->getMessage());
            return 1;
        }
    }
}
