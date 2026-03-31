<?php

namespace App\Filament\Resources\Fornecedors;

use App\Filament\Resources\Fornecedors\Pages\CreateFornecedor;
use App\Filament\Resources\Fornecedors\Pages\EditFornecedor;
use App\Filament\Resources\Fornecedors\Pages\ListFornecedors;
use App\Filament\Resources\Fornecedors\Pages\ViewFornecedor;
use App\Filament\Resources\Fornecedors\Schemas\FornecedorForm;
use App\Filament\Resources\Fornecedors\Schemas\FornecedorInfolist;
use App\Models\Fornecedor;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\RawJs;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;

class FornecedorResource extends Resource
{
    protected static ?string $model = Fornecedor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // Nome que vai aparecer no menu lateral
    protected static ?string $navigationLabel = 'Fornecedores';

    // Nome singular (ex: usado no botão "Criar Usuário")
    protected static ?string $modelLabel = 'Fornecedor';

    // Nome plural (ex: usado no título da tabela "Usuários)
    protected static ?string $pluralModelLabel = 'Fornecedores';

    protected static ?string $recordTitleAttribute = 'Fornecedor';

    public static function form(Schema $schema): Schema
    {
        return $schema
        ->schema([
            TextInput::make('nome')->required()->label('Nome'),
            TextInput::make('email')->email()->label('E-mail'),
            TextInput::make('telefone')->tel()->label('Telefone')->mask('(99) 99999-9999'),
            TextInput::make('cnpj')->label('CNPJ')->mask('99.999.999/9999-99'),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FornecedorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // return FornecedorsTable::configure($table);
        return $table
        ->columns([
            TextColumn::make('nome')->searchable(),
            TextColumn::make('email')->searchable(),
            TextColumn::make('telefone'),
            TextColumn::make('cnpj'),
        ])
        ->recordActions([
            ViewAction::make()->label('Visualizar'),
            EditAction::make()->label('Editar'),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFornecedors::route('/'),
            'create' => CreateFornecedor::route('/create'),
            'view' => ViewFornecedor::route('/{record}'),
            'edit' => EditFornecedor::route('/{record}/edit'),
        ];
    }
}
