<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PedidosOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalPedidos = Pedido::count();
        $pedidosHoje = Pedido::whereDate('created_at', today())->count();
        $vendaTotal = Pedido::sum('valor_total');
        $ticketMedio = $totalPedidos > 0 ? $vendaTotal / $totalPedidos : 0;

        return [
            Stat::make('Total de Pedidos', $totalPedidos)
                ->description('Todos os pedidos do sistema')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('primary')
                ->icon('heroicon-o-shopping-cart'),

            Stat::make('Pedidos Hoje', $pedidosHoje)
                ->description('Pedidos criados hoje')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info')
                ->icon('heroicon-o-calendar'),

            Stat::make('Venda Total', 'R$ ' . number_format($vendaTotal, 2, ',', '.'))
                ->description('Valor total de vendas')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success')
                ->icon('heroicon-o-banknotes'),

            Stat::make('Ticket Médio', 'R$ ' . number_format($ticketMedio, 2, ',', '.'))
                ->description('Valor médio por pedido')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('warning')
                ->icon('heroicon-o-chart-bar'),
        ];
    }
}
