<?php

namespace App\Filament\Pages;

use App\Models\Autorizacao;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

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
        /** @phpstan-ignore-next-line */
        $isPortaria = Auth::user()->hasRole('portaria');

        if ($isPortaria) {
            $query = Autorizacao::whereIn('status', ['autorizado_professor', 'concluido_portaria']);
        } else {
            $query = Autorizacao::query();
        }

        return [
            'autorizacoesTotal' => $isPortaria ? Autorizacao::whereIn('status', ['autorizado_professor', 'concluido_portaria'])->count() : Autorizacao::count(),
            'autorizacoesPendentes' => $isPortaria ? 0 : Autorizacao::where('status', 'pendente')->count(),
            'autorizacoesAutorizadas' => $query->where('status', 'autorizado_professor')->count(),
            'autorizacoesRecusadas' => $isPortaria ? 0 : Autorizacao::where('status', 'recusado')->count(),
            'autorizacoes' => $query->with(['aluno', 'turma'])
                ->latest()
                ->limit(10)
                ->get(),
            'isPortaria' => $isPortaria,
        ];
    }
}
