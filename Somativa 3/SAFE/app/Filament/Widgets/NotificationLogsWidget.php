<?php

namespace App\Filament\Widgets;

use App\Models\NotificationLog;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class NotificationLogsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(NotificationLog::query()->latest()->limit(10))
            ->columns([
                TextColumn::make('autorizacao.aluno.nome')
                    ->label('Aluno')
                    ->sortable(),
                BadgeColumn::make('tipo')
                    ->label('Tipo')
                    ->color(fn(string $state): string => match ($state) {
                        'email' => 'blue',
                        'whatsapp' => 'green',
                        default => 'gray',
                    }),
                TextColumn::make('destinatario')
                    ->label('Para'),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->color(fn(string $state): string => match ($state) {
                        'enviado' => 'success',
                        'falha' => 'danger',
                        'pendente' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('enviado_em')
                    ->label('Enviado em')
                    ->dateTime('H:i'),
            ])
            ->paginated(false);
    }
}
