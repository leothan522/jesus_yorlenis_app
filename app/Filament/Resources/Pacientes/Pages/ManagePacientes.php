<?php

namespace App\Filament\Resources\Pacientes\Pages;

use App\Filament\Resources\Pacientes\PacienteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePacientes extends ManageRecords
{
    protected static string $resource = PacienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->createAnother(false),
        ];
    }
}
