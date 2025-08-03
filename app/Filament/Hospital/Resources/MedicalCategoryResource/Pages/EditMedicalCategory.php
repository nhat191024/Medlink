<?php

namespace App\Filament\Hospital\Resources\MedicalCategoryResource\Pages;

use App\Filament\Hospital\Resources\MedicalCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedicalCategory extends EditRecord
{
    protected static string $resource = MedicalCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
