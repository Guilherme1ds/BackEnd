<?php

namespace App\Filament\Resources\Autorizacaos\Pages;

use App\Filament\Resources\Autorizacaos\AutorizacaoResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Auth;

class ViewAutorizacao extends ViewRecord
{
    protected static string $resource = AutorizacaoResource::class;

    protected function getHeaderActions(): array
    {
        /**
         * @var \App\Models\User|null $user
         * @phpstan-ignore-next-line
         */
        $user = Auth::user();
        $isPortaria = $user !== null && $user->hasRole('portaria');
        
        return [
            Action::make('edit')
                ->label('Editar')
                ->icon('heroicon-o-pencil-square')
                ->url($this->getResource()::getUrl('edit', ['record' => $this->getRecord()]))
                ->hidden(fn() => $isPortaria),

            Action::make('delete')
                ->label('Deletar')
                ->icon('heroicon-o-trash')
                ->action('delete')
                ->requiresConfirmation()
                ->hidden(fn() => $isPortaria),
        ];
    }

    public function delete(): void
    {
        /**
         * @var \App\Models\User|null $user
         * @phpstan-ignore-next-line
         */
        $user = Auth::user();
        abort_if($user !== null && $user->hasRole('portaria'), 403);
        parent::delete();
    }
}
