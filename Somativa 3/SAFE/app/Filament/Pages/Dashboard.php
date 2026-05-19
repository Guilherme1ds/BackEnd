<?php

namespace App\Filament\Pages;

use App\Models\Autorizacao;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class Dashboard extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected string $view = 'filament.pages.dashboard';

    protected static ?int $navigationSort = -2;

    protected static bool $shouldRegisterNavigation = true;

    public function getTitle(): string
    {
        return 'Dashboard';
    }

    protected function getViewData(): array
    {
        return [
            'autorizacoesTotal' => Autorizacao::count(),
            'autorizacoesPendentes' => Autorizacao::where('status', 'pendente')->count(),
            'autorizacoesAutorizadas' => Autorizacao::where('status', 'autorizado_professor')->count(),
            'autorizacoesRecusadas' => Autorizacao::where('status', 'recusado')->count(),
            'autorizacoes' => Autorizacao::with(['aluno', 'turma'])
                ->latest()
                ->limit(10)
                ->get(),
        ];
    }
}
