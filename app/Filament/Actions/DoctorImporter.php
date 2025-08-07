<?php

namespace App\Filament\Actions;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Actions\Concerns\HasForm;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Hospital;
use App\Jobs\ImportDoctorsJob;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Throwable;

class DoctorImporter extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->form([
            FileUpload::make('file')
                ->label('Excel File')
                ->acceptedFileTypes(['text/csv', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
                ->directory('uploads/excel')
                ->required(),
        ]);

        $this->action(fn(array $data) => $this->handle($data));
    }

    protected function handle(array $data): void
    {
        $filePath = storage_path('app/public/' . $data['file']);

        try {
            // Validate file exists
            if (!file_exists($filePath)) {
                Notification::make()
                    ->title('File not found')
                    ->body('Uploaded file could not be found.')
                    ->danger()
                    ->send();
                return;
            }

            // Get hospital ID
            $user = Auth::user();

            // Quick validation of Excel file
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            if (count($rows) < 3) {
                Notification::make()
                    ->title('Invalid file')
                    ->body('File must contain at least a header row and one data row.')
                    ->danger()
                    ->send();
                return;
            }

            // Dispatch job
            ImportDoctorsJob::dispatch($filePath, $user->id);

            Notification::make()
                ->title('Import started')
                ->body('Doctor import has been queued for processing. You will receive a notification when completed.')
                ->success()
                ->send();
        } catch (Throwable $e) {
            Notification::make()
                ->title('Import failed')
                ->body('An error occurred while starting the import: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
}
