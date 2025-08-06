<?php

namespace App\Filament\Doctor\Resources\UpcomingAppointmentResource\Pages;

use App\Filament\Doctor\Resources\UpcomingAppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUpcomingAppointments extends ListRecords
{
    protected static string $resource = UpcomingAppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
