<?php

namespace App\Filament\Resources\MantenimientoResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Maquina;

class MantenimientoChart extends ChartWidget
{
    protected static ?string $heading = 'Mantenimientos por Máquina';

    protected function getData(): array
    {
        $data = Maquina::withCount('mantenimientos') 
            ->get()
            ->map(function ($maquina) {
                return [
                    'label' => $maquina->propietario,
                    'value' => $maquina->mantenimientos_count,
                ];
            });
        return [
            'labels' => $data->pluck('label')->toArray(),
            'datasets' => [
                [
                    'label' => 'Número de Mantenimientos',
                    'data' => $data->pluck('value')->toArray(),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)', 
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ]
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Tipo de gráfico
    }
}
