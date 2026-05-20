<?php

namespace App\Filament\Resources\Autorizacaos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AutorizacaoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Informações do Aluno
                TextEntry::make('aluno.nome')
                    ->label('Aluno')
                    ->badge()
                    ->color('blue'),

                TextEntry::make('turma.nome')
                    ->label('Turma'),

                TextEntry::make('aluno.telefone_responsavel')
                    ->label('Telefone do Responsável')
                    ->icon('heroicon-o-phone'),

                // Detalhes da Autorização
                TextEntry::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'entrar' => 'blue',
                        'sair' => 'orange',
                        default => 'gray',
                    }),

                TextEntry::make('horario')
                    ->label('Horário')
                    ->time('H:i'),

                TextEntry::make('conta_falta')
                    ->label('Conta como Falta')
                    ->badge()
                    ->formatStateUsing(fn(bool $state) => $state ? 'Sim' : 'Não')
                    ->color(fn(bool $state) => $state ? 'warning' : 'success'),

                TextEntry::make('aulas_afetadas')
                    ->label('Aulas Afetadas')
                    ->formatStateUsing(fn($state) => is_array($state) ? implode(', ', $state) : ($state ?? 'N/A')),

                // Fluxo de Aprovação
                TextEntry::make('status')
                    ->label('Status')
                    ->badge()
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

                TextEntry::make('aprovadoPor.name')
                    ->label('Autorizado por (Professor)')
                    ->icon('heroicon-o-user')
                    ->color('success'),

                TextEntry::make('validadoPor.name')
                    ->label('Validado por (Portaria)')
                    ->icon('heroicon-o-shield-check')
                    ->color('info'),

                TextEntry::make('criadoPor.name')
                    ->label('Criado por')
                    ->icon('heroicon-o-user-plus'),

                // Observações
                TextEntry::make('observacao')
                    ->label('Notas Adicionais')
                    ->markdown(),

                // Informações de Auditoria
                TextEntry::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i:s'),

                TextEntry::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i:s'),
            ]);
    }
}
