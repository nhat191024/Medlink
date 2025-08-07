<?php

namespace App\Filament\Hr\Resources\DoctorResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use App\Filament\Hr\Resources\DoctorResource;

use App\Filament\Actions\DoctorImporter;

class ListDoctors extends ListRecords
{
    protected static string $resource = DoctorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Thêm bác sĩ'),
            Actions\Action::make('download_template')
                ->label('Tải mẫu CSV')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('info')
                ->action(function () {
                    $templatePath = storage_path('app/templates/doctor_import_template.csv');
                    if (file_exists($templatePath)) {
                        return response()->download($templatePath, 'mau_import_bac_si.csv');
                    } else {
                        // Generate template nếu chưa có
                        return redirect()->route('admin.doctor.download-template');
                    }
                }),
            DoctorImporter::make('import_doctors')
                ->label('Nhập bác sĩ từ Excel')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('primary')
        ];
    }
}
