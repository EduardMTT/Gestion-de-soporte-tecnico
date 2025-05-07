<?php

namespace App\Filament\Resources\MantenimientosResource\Widgets;

use App\Models\Mantenimiento;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class Duracionchart extends ChartWidget
{
    protected static ?string $heading = 'Duración de Mantenimientos (en horas)';

    protected function getData(): array
    {
        $mantenimientos = Mantenimiento::select('id', 'duracion')->get();

        $labels = [];
        $data = [];

        foreach ($mantenimientos as $mantenimiento) {
            $labels[] = 'Mant. #' . $mantenimiento->id;

            // Convertimos TIME a horas (HH:MM:SS)
            $duracion = explode(':', $mantenimiento->duracion);
            $horas = isset($duracion[0]) ? (int)$duracion[0] : 0;
            $minutos = isset($duracion[1]) ? (int)$duracion[1] : 0;

            // Convertimos la duración a horas (con minutos como fracción de hora)
            $total_horas = $horas + ($minutos / 60);
            $data[] = $total_horas;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Duración (horas)', // Cambiado a horas
                    'data' => $data,
                    'backgroundColor' => '#3b82f6', // azul
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
