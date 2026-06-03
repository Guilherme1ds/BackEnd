<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class VendasMensaisChart extends ChartWidget
{
    protected static ?int $sort = 2;

    public static function getTitle(): string
    {
        return 'Vendas Mensais';
    }

    protected function getData(): array
    {
        $dados = Pedido::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as mes, SUM(valor_total) as total')
            ->whereDate('created_at', '>=', now()->subMonths(6))
            ->groupByRaw('DATE_FORMAT(created_at, "%Y-%m")')
            ->orderByRaw('DATE_FORMAT(created_at, "%Y-%m")')
            ->get();

        $labels = $dados->map(fn($item) => \Carbon\Carbon::parse($item->mes . '-01')->format('M/Y'))->toArray();
        $values = $dados->pluck('total')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Faturamento (R$)',
                    'data' => $values,
                    'borderColor' => '#0066cc',
                    'backgroundColor' => 'rgba(0, 102, 204, 0.1)',
                    'borderWidth' => 2,
                    'fill' => true,
                    'tension' => 0.4,
                    'pointBackgroundColor' => '#0066cc',
                    'pointBorderColor' => '#fff',
                    'pointBorderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'callback' => 'function(value) { return "R$ " + value.toLocaleString("pt-BR", {maximumFractionDigits: 0}); }',
                    ],
                ],
            ],
        ];
    }
}
