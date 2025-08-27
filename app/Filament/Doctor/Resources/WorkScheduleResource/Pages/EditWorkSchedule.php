<?php

namespace App\Filament\Doctor\Resources\WorkScheduleResource\Pages;

use App\Filament\Doctor\Resources\WorkScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkSchedule extends EditRecord
{
    protected static string $resource = WorkScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
