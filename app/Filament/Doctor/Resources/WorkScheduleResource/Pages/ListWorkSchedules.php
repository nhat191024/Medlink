<?php

namespace App\Filament\Doctor\Resources\WorkScheduleResource\Pages;

use App\Filament\Doctor\Resources\WorkScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkSchedules extends ListRecords
{
    protected static string $resource = WorkScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
