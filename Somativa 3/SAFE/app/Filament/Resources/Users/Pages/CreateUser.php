<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = bcrypt($data['password']);

        return $data;
    }

    protected function afterCreate(): void
    {
        if (isset($this->data['roles'])) {
            $this->record->syncRoles($this->data['roles']);
        }
    }
}
