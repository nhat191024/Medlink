<?php

namespace App\Filament\Resources\MedicalCategoryResource\Pages;

use App\Filament\Resources\MedicalCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedicalCategories extends ListRecords
{
    protected static string $resource = MedicalCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
