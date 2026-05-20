<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->columnSpanFull(),

                TextInput::make('password')
                    ->label('Senha')
                    ->password()
                    ->required(fn(string $operation) => $operation === 'create')
                    ->columnSpanFull(),

                Select::make('roles')
                    ->label('Cargo')
                    ->relationship('roles', 'name')
                    ->preload()
                    ->searchable()
                    ->columnSpanFull(),
            ])->columns(2);
    }
}
