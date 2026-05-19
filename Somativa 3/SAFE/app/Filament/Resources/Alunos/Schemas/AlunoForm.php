<?php

namespace App\Filament\Resources\Alunos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AlunoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->label('Nome do Aluno')
                    ->required()
                    ->columnSpanFull(),

                Select::make('turma_id')
                    ->label('Selecione a Turma')
                    ->relationship('turma', 'nome')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('nome_responsavel')
                    ->label('Nome do Responsável')
                    ->columnSpan(1),

                TextInput::make('telefone_responsavel')
                    ->label('Telefone do Responsável')
                    ->tel()
                    ->placeholder('(11) 99999-9999')
                    ->columnSpan(1),
            ])->columns(2);
    }
}
