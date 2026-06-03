<?php

namespace App\Filament\Resources\Pedidos\Pages;

use App\Filament\Resources\Pedidos\PedidoResource;
use App\Mail\PedidoCriadoMail;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CreatePedido extends CreateRecord{
    protected static string $resource = PedidoResource::class;

    protected function afterCreate(): void{
        $pedido = $this->record;

        // Recálculo preventivo via Eloquent Collection
        $total = $pedido->itens->sum(fn ($item) => $item->quantidade * $item->preco_unitario);
        $pedido->update(['valor_total' => $total]);

        // Gravação da trilha de auditoria física no servidor
        Log::info('Auditoria: Novo Pedido Comercial Gerado', [
            'pedido_id' => $pedido->id,
            'valor_total' => $total,
            'operador' => Auth::user()?->email ?? 'Sistema'
        ]);

        // Disparo assíncrono para o Mailpit
        if ($pedido->cliente && $pedido->cliente->email) {
            Mail::to($pedido->cliente->email)->send(new PedidoCriadoMail($pedido));
        }
    }
}