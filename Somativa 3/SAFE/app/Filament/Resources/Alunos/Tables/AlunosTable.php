<?php

namespace App\Filament\Resources\Alunos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AlunosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->icon('heroicon-o-user')
                    ->sortable(),

                TextColumn::make('turma.nome')
                    ->label('Turma')
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nome_responsavel')
                    ->label('Responsável')
                    ->searchable()
                    ->icon('heroicon-o-user-group')
                    ->sortable(),

                TextColumn::make('telefone_responsavel')
                    ->label('Telefone')
                    ->icon('heroicon-o-phone')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Cadastrado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('turma')
                    ->label('Filtrar por Turma')
                    ->relationship('turma', 'nome')
                    ->placeholder('Todas as turmas'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
