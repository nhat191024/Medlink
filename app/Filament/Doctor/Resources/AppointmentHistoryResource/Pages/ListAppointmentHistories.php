<?php

namespace App\Filament\Doctor\Resources\AppointmentHistoryResource\Pages;

use App\Filament\Doctor\Resources\AppointmentHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAppointmentHistories extends ListRecords
{
    protected static string $resource = AppointmentHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
