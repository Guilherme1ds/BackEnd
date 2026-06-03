<?php

namespace App\Filament\Widgets;

use App\Models\ItemPedido;
use Filament\Widgets\ChartWidget;

class ProdutosTopChart extends ChartWidget
{
    protected static ?int $sort = 4;

    public static function getTitle(): string
    {
        return 'Top 10 Produtos Mais Vendidos';
    }

    protected function getData(): array
    {
        $dados = ItemPedido::selectRaw('produto_id, produtos.nome, SUM(quantidade) as total_quantidade')
            ->join('produtos', 'item_pedidos.produto_id', '=', 'produtos.id')
            ->groupBy('produto_id', 'produtos.nome')
            ->orderByDesc('total_quantidade')
            ->limit(10)
            ->get();

        $labels = $dados->pluck('nome')->toArray();
        $values = $dados->pluck('total_quantidade')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Quantidade Vendida',
                    'data' => $values,
                    'backgroundColor' => 'rgba(0, 102, 204, 0.8)',
                    'borderColor' => '#0066cc',
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
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}
