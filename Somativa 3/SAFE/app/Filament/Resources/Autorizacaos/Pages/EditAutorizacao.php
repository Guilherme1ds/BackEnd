<?php

namespace App\Filament\Resources\Autorizacaos\Pages;

use App\Filament\Resources\Autorizacaos\AutorizacaoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditAutorizacao extends EditRecord
{
    protected static string $resource = AutorizacaoResource::class;

    public function mount(string|int $record): void
    {
        abort_if(Auth::user()->hasRole('portaria'), 403);
        parent::mount($record);
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
