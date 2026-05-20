<?php

namespace App\Filament\Resources\Autorizacaos\Schemas;

use App\Models\Aluno;
use App\Models\Turma;
use App\Models\User;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AutorizacaoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Seção: Informações do Aluno
                Section::make('Informações do Aluno')
                    ->schema([
                        Select::make('aluno_id')
                            ->label('Aluno')
                            ->relationship('aluno', 'nome')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->validationMessages([
                                'required' => 'O aluno é obrigatório',
                            ])
                            ->columnSpanFull(),
                        
                        Select::make('turma_id')
                            ->label('Turma')
                            ->relationship('turma', 'nome')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->validationMessages([
                                'required' => 'A turma é obrigatória',
                            ])
                            ->columnSpanFull(),
                    ]),

                // Seção: Detalhes da Autorização
                Section::make('Detalhes da Autorização')
                    ->schema([
                        Select::make('tipo')
                            ->label('Tipo de Autorização')
                            ->options([
                                'entrar' => 'Entrada (Autorizo o Aluno a Entrar)',
                                'sair' => 'Saída (Autorizo o Aluno a Sair)',
                            ])
                            ->required()
                            ->validationMessages([
                                'required' => 'O tipo de autorização é obrigatório',
                            ])
                            ->columnSpanFull(),

                        TimePicker::make('horario')
                            ->label('Horário')
                            ->seconds(false)
                            ->required()
                            ->validationMessages([
                                'required' => 'O horário é obrigatório',
                            ])
                            ->columnSpan(1),

                        Toggle::make('conta_falta')
                            ->label('Conta como Falta?')
                            ->default(true)
                            ->columnSpan(1),
                    ])->columns(2),

                // Seção: Aulas Afetadas
                Section::make('Aulas Afetadas')
                    ->schema([
                        CheckboxList::make('aulas_afetadas')
                            ->label('Selecione as aulas afetadas:')
                            ->options([
                                '1ª' => '1ª Aula',
                                '2ª' => '2ª Aula',
                                '3ª' => '3ª Aula',
                                '4ª' => '4ª Aula',
                                '5ª' => '5ª Aula',
                            ])
                            ->columnSpanFull(),
                    ]),

                // Seção: Status e Aprovações
                Section::make('Status e Aprovações')
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pendente' => 'Pendente - Aguardando aprovação',
                                'autorizado_professor' => 'Autorizado pelo Professor',
                                'concluido_portaria' => 'Concluído pela Portaria',
                                'recusado' => 'Recusado',
                            ])
                            ->default('pendente')
                            ->required()
                            ->helperText('Fluxo: Pendente → Professor → Portaria → Concluído')
                            ->validationMessages([
                                'required' => 'O status é obrigatório',
                            ])
                            ->columnSpanFull(),

                        Select::make('aprovado_por_id')
                            ->label('Autorizado por (Professor)')
                            ->relationship('aprovadoPor', 'name')
                            ->searchable()
                            ->preload()
                            ->helperText('Selecione o professor que autorizou')
                            ->columnSpan(1),

                        Select::make('validado_por_id')
                            ->label('Validado por (Portaria)')
                            ->relationship('validadoPor', 'name')
                            ->searchable()
                            ->preload()
                            ->helperText('Selecione o responsável pela portaria')
                            ->columnSpan(1),
                    ])->columns(2),

                // Seção: Observações
                Section::make('Observações')
                    ->schema([
                        Textarea::make('observacao')
                            ->label('Observações Adicionais')
                            ->placeholder('Ex: Motivo da autorização, detalhes importantes, condições especiais, etc.')
                            ->rows(4)
                            ->maxLength(1000)
                            ->helperText('Máximo 1000 caracteres')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
