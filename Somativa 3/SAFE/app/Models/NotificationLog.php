<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationLog extends Model
{
    protected $fillable = [
        'autorizacao_id',
        'tipo',
        'destinatario',
        'assunto',
        'conteudo',
        'status',
        'resposta_api',
        'enviado_em',
    ];

    protected function casts(): array
    {
        return [
            'enviado_em' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function autorizacao(): BelongsTo
    {
        return $this->belongsTo(Autorizacao::class);
    }
}
