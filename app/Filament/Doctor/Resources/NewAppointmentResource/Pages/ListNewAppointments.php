<?php

namespace App\Filament\Doctor\Resources\NewAppointmentResource\Pages;

use App\Filament\Doctor\Resources\NewAppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNewAppointments extends ListRecords
{
    protected static string $resource = NewAppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
