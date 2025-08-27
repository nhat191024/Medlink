<?php

namespace App\Filament\Doctor\Resources\CancelledAppointmentResource\Pages;

use App\Filament\Doctor\Resources\CancelledAppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCancelledAppointments extends ListRecords
{
    protected static string $resource = CancelledAppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
