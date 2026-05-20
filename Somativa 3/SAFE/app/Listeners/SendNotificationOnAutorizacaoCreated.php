<?php

namespace App\Listeners;

use App\Events\AutorizacaoCreated;
use App\Services\NotificationService;

class SendNotificationOnAutorizacaoCreated
{
    public function __construct(private NotificationService $notificationService)
    {
    }

    public function handle(AutorizacaoCreated $event): void
    {
        // Notificar responsável quando a autorização é criada
        $this->notificationService->notificarResponsavel($event->autorizacao);
    }
}
