<?php

namespace App\Filament\Resources\Pedidos\Pages;

use App\Filament\Resources\Pedidos\PedidoResource;
use App\Mail\PedidoCriadoMail;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EditPedido extends EditRecord
{
    protected static string $resource = PedidoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    public function afterSave(): void
    {
        $pedido = $this->record;

        $total = $pedido->itens->sum(function ($item) {
            return $item->quantidade * $item->preco_unitario;
        });

        $pedido->update(['valor_total' => $total]);

        // Gravação da trilha de auditoria
        Log::info('Auditoria: Pedido Comercial Editado e Atualizado', [
            'pedido_id' => $pedido->id,
            'novo_valor_total' => $total,
            'operador' => Auth::user()?->email ?? 'Sistema'
        ]);

        // Envio de email de confirmação
        if ($pedido->cliente && $pedido->cliente->email) {
            Mail::to($pedido->cliente->email)->send(new PedidoCriadoMail($pedido));
        }
    }
}
