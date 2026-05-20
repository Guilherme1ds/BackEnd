<?php

namespace App\Filament\Resources\Autorizacaos\Pages;

use App\Filament\Resources\Autorizacaos\AutorizacaoResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;


class CreateAutorizacao extends CreateRecord
{
    protected static string $resource = AutorizacaoResource::class;

    public function mount(): void
    {
        abort_if(Auth::user()->hasRole('portaria'), 403);
        parent::mount();
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['criado_por_id'] = Auth::id();

        return $data;
    }
}
