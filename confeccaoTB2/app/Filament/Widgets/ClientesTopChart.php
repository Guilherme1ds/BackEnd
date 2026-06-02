<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use Filament\Widgets\ChartWidget;

class ClientesTopChart extends ChartWidget
{
    protected static ?int $sort = 5;

    public static function getTitle(): string
    {
        return 'Top 10 Clientes';
    }

    protected function getData(): array
    {
        $dados = Pedido::selectRaw('cliente_id, clientes.nome, SUM(valor_total) as total_valor, COUNT(*) as total_pedidos')
            ->join('clientes', 'pedidos.cliente_id', '=', 'clientes.id')
            ->groupBy('cliente_id', 'clientes.nome')
            ->orderByDesc('total_valor')
            ->limit(10)
            ->get();

        $labels = $dados->pluck('nome')->toArray();
        $values = $dados->pluck('total_valor')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Valor Total de Compras (R$)',
                    'data' => $values,
                    'backgroundColor' => 'rgba(16, 185, 129, 0.8)',
                    'borderColor' => '#10b981',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'indexAxis' => 'y',
            'scales' => [
                'x' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'callback' => 'function(value) { return "R$ " + value.toLocaleString("pt-BR", {maximumFractionDigits: 0}); }',
                    ],
                ],
            ],
        ];
    }
}
