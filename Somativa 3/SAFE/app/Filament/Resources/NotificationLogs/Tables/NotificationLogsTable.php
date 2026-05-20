<?php

namespace App\Filament\Resources\NotificationLogs\Tables;

use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class NotificationLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('autorizacao.aluno.nome')
                    ->label('Aluno')
                    ->searchable(),
                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'email' => 'blue',
                        'whatsapp' => 'green',
                        'sms' => 'purple',
                        default => 'gray',
                    }),
                TextColumn::make('destinatario')
                    ->label('Destinatário')
                    ->searchable(),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->color(fn(string $state): string => match ($state) {
                        'enviado' => 'success',
                        'pendente' => 'warning',
                        'falha' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('enviado_em')
                    ->label('Enviado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('tipo')
                    ->label('Tipo de Notificação')
                    ->options([
                        'email' => 'Email',
                        'whatsapp' => 'WhatsApp',
                        'sms' => 'SMS',
                    ])
                    ->placeholder('Todos os tipos'),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'enviado' => 'Enviado',
                        'pendente' => 'Pendente',
                        'falha' => 'Falha',
                    ])
                    ->placeholder('Todos os status'),

                Filter::make('hoje')
                    ->label('Enviado Hoje')
                    ->query(fn(Builder $query) => $query->whereDate('enviado_em', now()->toDateString())),

                Filter::make('com_erro')
                    ->label('Com Erros')
                    ->query(fn(Builder $query) => $query->where('status', 'falha')),
            ]);
    }
}
