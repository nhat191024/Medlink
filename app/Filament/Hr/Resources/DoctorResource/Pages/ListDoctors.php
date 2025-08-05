<?php

namespace App\Filament\Hr\Resources\DoctorResource\Pages;

use App\Filament\Hr\Resources\DoctorResource;
use App\Filament\Hr\Imports\DoctorImporter;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use HayderHatem\FilamentExcelImport\Actions\FullImportAction;

class ListDoctors extends ListRecords
{
    protected static string $resource = DoctorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('download_template')
                ->label('Download Template')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('info')
                ->action(function () {
                    $templatePath = storage_path('app/public/templates/doctors_import_template.csv');
                    return response()->download($templatePath, 'doctors_import_template.csv');
                }),
            FullImportAction::make()
                ->importer(DoctorImporter::class)
                ->label('Import Doctors')
                ->color('success')
                ->icon('heroicon-o-arrow-up-tray'),
            Actions\CreateAction::make(),
        ];
    }
}
