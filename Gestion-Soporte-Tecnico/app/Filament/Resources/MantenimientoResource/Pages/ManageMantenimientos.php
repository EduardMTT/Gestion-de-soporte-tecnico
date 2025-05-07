<?php

namespace App\Filament\Resources\MantenimientoResource\Pages;

use App\Filament\Resources\MantenimientoResource;
use App\Filament\Resources\MantenimientoResource\Widgets\MantenimientoChart;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMantenimientos extends ManageRecords
{
    protected static string $resource = MantenimientoResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
