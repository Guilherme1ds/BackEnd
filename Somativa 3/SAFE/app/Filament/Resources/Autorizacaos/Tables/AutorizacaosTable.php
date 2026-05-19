<?php

namespace App\Filament\Resources\Autorizacaos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AutorizacaosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('aluno_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('turma_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tipo')
                    ->badge(),
                TextColumn::make('horario')
                    ->time()
                    ->sortable(),
                IconColumn::make('conta_falta')
                    ->boolean(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('criado_por_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('aprovado_por_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('validado_por_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
