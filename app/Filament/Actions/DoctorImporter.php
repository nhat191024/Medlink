<?php

namespace App\Filament\Actions;

use App\Jobs\ImportDoctorsJob;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;

use PhpOffice\PhpSpreadsheet\IOFactory;

use Illuminate\Support\Facades\Auth;

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
                    ->title('Không tìm thấy tập tin')
                    ->body('Không thể tìm thấy tập tin đã tải lên.')
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
                    ->title('Tập tin không hợp lệ')
                    ->body('Tập tin phải có ít nhất một dòng tiêu đề và một dòng dữ liệu.')
                    ->danger()
                    ->send();
                return;
            }

            // Dispatch job
            ImportDoctorsJob::dispatch($filePath, $user->id);

            Notification::make()
                ->title('Đã bắt đầu nhập')
                ->body('Quá trình nhập bác sĩ đã được đưa vào hàng đợi xử lý. Bạn sẽ nhận được thông báo khi hoàn tất.')
                ->success()
                ->send();
        } catch (Throwable $e) {
            Notification::make()
                ->title('Nhập thất bại')
                ->body('Đã xảy ra lỗi khi bắt đầu nhập: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
}
