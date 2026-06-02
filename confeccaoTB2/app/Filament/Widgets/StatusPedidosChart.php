<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use Filament\Widgets\ChartWidget;

class StatusPedidosChart extends ChartWidget
{
    protected static ?int $sort = 3;

    public static function getTitle(): string
    {
        return 'Status dos Pedidos';
    }

    protected function getData(): array
    {
        $dados = Pedido::selectRaw('status, COUNT(*) as quantidade')
            ->groupBy('status')
            ->get();

        $labels = $dados->pluck('status')->toArray();
        $values = $dados->pluck('quantidade')->toArray();

        // Array com cores bonitas para cada status
        $paleta = [
            '#3b82f6', // Azul
            '#10b981', // Verde
            '#f59e0b', // Âmbar
            '#ef4444', // Vermelho
            '#8b5cf6', // Roxo
            '#06b6d4', // Cyan
            '#ec4899', // Rosa
            '#6366f1', // Índigo
        ];

        $backgroundColor = [];
        foreach ($dados as $index => $item) {
            $backgroundColor[] = $paleta[$index % count($paleta)];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Quantidade de Pedidos',
                    'data' => $values,
                    'backgroundColor' => $backgroundColor,
                    'borderColor' => '#fff',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                ],
            ],
        ];
    }
}
