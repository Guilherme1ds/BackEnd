<?php

namespace App\Listeners;

use App\Events\AutorizacaoUpdated;
use App\Services\NotificationService;

class SendNotificationOnAutorizacaoUpdated
{
    public function __construct(private NotificationService $notificationService)
    {
    }

    public function handle(AutorizacaoUpdated $event): void
    {
        $autorizacao = $event->autorizacao;

        // Se o status foi alterado para concluído pela portaria, notifica
        if ($autorizacao->status === 'concluido_portaria') {
            $this->notificationService->notificarPortaria($autorizacao);
        }
    }
}
