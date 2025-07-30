<?php

namespace App\Filament\Admin\Resources\MedicalCategoryResource\Pages;

use App\Filament\Admin\Resources\MedicalCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMedicalCategory extends CreateRecord
{
    protected static string $resource = MedicalCategoryResource::class;
}
