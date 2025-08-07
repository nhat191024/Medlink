<?php

namespace App\Filament\Actions;

use Filament\Actions\Action;
use Illuminate\Http\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DownloadDoctorTemplate extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Download Template')
            ->icon('heroicon-o-document-arrow-down')
            ->color('info')
            ->action(fn() => $this->downloadTemplate());
    }

    protected function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $headers = [
            'A1' => 'Tên Bác Sĩ',
            'B1' => 'Email',
            'C1' => 'Số Điện Thoại',
            'D1' => 'Chuyên Khoa',
            'E1' => 'Số Chứng Chỉ',
            'F1' => 'Giới Thiệu'
        ];

        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // Set example row
        $examples = [
            'A2' => 'Dr. Nguyen Van A',
            'B2' => 'doctor1@example.com',
            'C2' => '0901234567',
            'D2' => 'Nội khoa',
            'E2' => 'PROF-12345',
            'F2' => 'Bác sĩ chuyên khoa nội với 10 năm kinh nghiệm'
        ];

        foreach ($examples as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // Add another example
        $examples2 = [
            'A3' => 'Dr. Tran Thi B',
            'B3' => 'doctor2@example.com',
            'C3' => '0907654321',
            'D3' => 'Ngoại khoa',
            'E3' => 'PROF-67890',
            'F3' => 'Bác sĩ chuyên khoa ngoại chỉnh hình'
        ];

        foreach ($examples2 as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // Style the header row
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $sheet->getStyle('A1:F1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('E3F2FD');

        // Auto-size columns
        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Create the writer
        $writer = new Xlsx($spreadsheet);

        // Set headers for download
        $filename = 'doctor_import_template_' . date('Y-m-d') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Save to output
        $writer->save('php://output');
        exit;
    }
}
