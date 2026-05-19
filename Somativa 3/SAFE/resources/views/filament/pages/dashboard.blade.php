<x-filament-panels::page>
    <div style="margin-bottom: 30px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            <!-- Card Pendentes -->
            <div style="background: #fef3c7; border: 1px solid #fcd34d; border-radius: 8px; padding: 20px; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                <p style="font-size: 12px; font-weight: 600; color: #92400e; margin: 0;">Pendentes</p>
                <p style="font-size: 28px; font-weight: bold; color: #b45309; margin: 15px 0 0;">{{ $autorizacoesPendentes ?? 0 }}</p>
                <p style="font-size: 12px; color: #b45309; margin: 10px 0 0;">⏳ Aguardando análise</p>
            </div>

            <!-- Card Autorizadas -->
            <div style="background: #dcfce7; border: 1px solid #bbf7d0; border-radius: 8px; padding: 20px; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                <p style="font-size: 12px; font-weight: 600; color: #166534; margin: 0;">Autorizadas</p>
                <p style="font-size: 28px; font-weight: bold; color: #16a34a; margin: 15px 0 0;">{{ $autorizacoesAutorizadas ?? 0 }}</p>
                <p style="font-size: 12px; color: #16a34a; margin: 10px 0 0;">✓ Aprovadas</p>
            </div>
        </div>
    </div>

    <!-- Tabela -->
    <div style="background: white; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
        <div style="border-bottom: 1px solid #e5e7eb; padding: 20px; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="font-size: 16px; font-weight: 600; color: #1f2937; margin: 0;">Autorizações Recentes</h3>
            <a href="{{ route('filament.admin.resources.autorizacaos.index') }}" style="font-size: 13px; color: #2563eb; text-decoration: none;">Ver todas →</a>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                        <th style="padding: 12px 15px; text-align: left; font-size: 12px; font-weight: 600; color: #374151;">Aluno</th>
                        <th style="padding: 12px 15px; text-align: left; font-size: 12px; font-weight: 600; color: #374151;">Turma</th>
                        <th style="padding: 12px 15px; text-align: left; font-size: 12px; font-weight: 600; color: #374151;">Tipo</th>
                        <th style="padding: 12px 15px; text-align: left; font-size: 12px; font-weight: 600; color: #374151;">Horário</th>
                        <th style="padding: 12px 15px; text-align: left; font-size: 12px; font-weight: 600; color: #374151;">Status</th>
                        <th style="padding: 12px 15px; text-align: left; font-size: 12px; font-weight: 600; color: #374151;">Data</th>
                        <th style="padding: 12px 15px; text-align: center; font-size: 12px; font-weight: 600; color: #374151;">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($autorizacoes ?? [] as $autorizacao)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px 15px; font-size: 13px; color: #1f2937;">{{ $autorizacao->aluno->nome ?? 'N/A' }}</td>
                            <td style="padding: 12px 15px; font-size: 13px; color: #1f2937;">{{ $autorizacao->turma->nome ?? 'N/A' }}</td>
                            <td style="padding: 12px 15px; font-size: 13px;">
                                <span style="display: inline-block; background: #dbeafe; color: #1e40af; padding: 4px 8px; border-radius: 12px; font-size: 11px; font-weight: 600;">
                                    {{ ucfirst($autorizacao->tipo) }}
                                </span>
                            </td>
                            <td style="padding: 12px 15px; font-size: 13px; color: #1f2937;">
                                @if($autorizacao->horario)
                                    {{ \Carbon\Carbon::parse($autorizacao->horario)->format('H:i') }}
                                @else
                                    —
                                @endif
                            </td>
                            <td style="padding: 12px 15px; font-size: 13px;">
                                @switch($autorizacao->status)
                                    @case('pendente')
                                        <span style="display: inline-block; background: #fef3c7; color: #92400e; padding: 4px 8px; border-radius: 12px; font-size: 11px; font-weight: 600;">Pendente</span>
                                        @break
                                    @case('autorizado_professor')
                                        <span style="display: inline-block; background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 12px; font-size: 11px; font-weight: 600;">Autorizado</span>
                                        @break
                                @endswitch
                            </td>
                            <td style="padding: 12px 15px; font-size: 13px; color: #1f2937;">{{ $autorizacao->created_at->format('d/m/Y H:i') }}</td>
                            <td style="padding: 12px 15px; text-align: center;">
                                <a href="{{ route('filament.admin.resources.autorizacaos.edit', $autorizacao) }}" style="font-size: 12px; color: #2563eb; text-decoration: none;">Editar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="padding: 30px 15px; text-align: center; font-size: 13px; color: #9ca3af;">
                                Nenhuma autorização registrada
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-filament-panels::page>
