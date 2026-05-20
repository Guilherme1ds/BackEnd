<?php

namespace App\Filament\Resources\Autorizacaos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AutorizacaosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('aluno.nome')
                    ->label('Aluno')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('turma.nome')
                    ->label('Turma')
                    ->searchable()
                    ->sortable(),
                BadgeColumn::make('tipo')
                    ->label('Tipo')
                    ->color(fn(string $state): string => match ($state) {
                        'entrar' => 'blue',
                        'sair' => 'orange',
                        default => 'gray',
                    }),
                TextColumn::make('horario')
                    ->label('Horário')
                    ->time('H:i')
                    ->sortable(),
                TextColumn::make('aulas_afetadas')
                    ->label('Aulas')
                    ->formatStateUsing(fn($state) => is_array($state) ? implode(', ', $state) : $state),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->color(fn(string $state): string => match ($state) {
                        'pendente' => 'warning',
                        'autorizado_professor' => 'success',
                        'concluido_portaria' => 'info',
                        'recusado' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pendente' => 'Pendente',
                        'autorizado_professor' => 'Autorizado',
                        'concluido_portaria' => 'Concluído',
                        'recusado' => 'Recusado',
                        default => $state,
                    }),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pendente' => 'Pendente',
                        'autorizado_professor' => 'Autorizado',
                        'concluido_portaria' => 'Concluído',
                        'recusado' => 'Recusado',
                    ])
                    ->placeholder('Todos os Status'),

                SelectFilter::make('tipo')
                    ->label('Tipo')
                    ->options([
                        'entrar' => 'Entrada',
                        'sair' => 'Saída',
                    ])
                    ->placeholder('Todos os Tipos'),

                Filter::make('hoje')
                    ->label('Criado Hoje')
                    ->query(fn(Builder $query) => $query->whereDate('created_at', now()->toDateString())),

                Filter::make('com_aulas')
                    ->label('Conta como Falta')
                    ->query(fn(Builder $query) => $query->where('conta_falta', true)),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
