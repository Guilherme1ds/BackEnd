<?php

namespace App\Services;

use App\Models\Autorizacao;
use App\Models\NotificationLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function notificarResponsavel(Autorizacao $autorizacao): void
    {
        try {
            $aluno = $autorizacao->aluno;
            $responsavel = $aluno ? $aluno->telefone_responsavel : null;
            $email = null;

            // Aqui você adicionaria a lógica para obter o email do responsável
            // Por enquanto, vamos apenas registrar um log

            $mensagem = $this->gerarMensagem($autorizacao);

            // Log para Email (usando Mailpit em desenvolvimento)
            Log::info("Email de autorização", [
                'autorizacao_id' => $autorizacao->id,
                'aluno' => $aluno->nome ?? 'N/A',
                'tipo' => $autorizacao->tipo,
                'status' => $autorizacao->status,
                'mensagem' => $mensagem,
            ]);

            // Registrar no log de notificações
            NotificationLog::create([
                'autorizacao_id' => $autorizacao->id,
                'tipo' => 'email',
                'destinatario' => $email ?? 'responsavel@example.com',
                'assunto' => "Autorização de {$autorizacao->tipo} - {$aluno->nome}",
                'conteudo' => $mensagem,
                'status' => 'enviado',
                'enviado_em' => now(),
            ]);

            // Log para WhatsApp simulado
            if ($responsavel) {
                Log::info("WhatsApp de autorização", [
                    'autorizacao_id' => $autorizacao->id,
                    'telefone' => $responsavel,
                    'aluno' => $aluno->nome ?? 'N/A',
                    'tipo' => $autorizacao->tipo,
                    'mensagem' => $mensagem,
                ]);

                NotificationLog::create([
                    'autorizacao_id' => $autorizacao->id,
                    'tipo' => 'whatsapp',
                    'destinatario' => $responsavel,
                    'conteudo' => $mensagem,
                    'status' => 'enviado',
                    'enviado_em' => now(),
                ]);
            }
        } catch (\Exception $e) {
            Log::error("Erro ao enviar notificação", [
                'autorizacao_id' => $autorizacao->id,
                'error' => $e->getMessage(),
            ]);

            NotificationLog::create([
                'autorizacao_id' => $autorizacao->id,
                'tipo' => 'email',
                'destinatario' => 'unknown',
                'conteudo' => 'Erro ao processar notificação',
                'status' => 'falha',
                'resposta_api' => $e->getMessage(),
            ]);
        }
    }

    public function notificarPortaria(Autorizacao $autorizacao): void
    {
        try {
            $aluno = $autorizacao->aluno;
            $mensagem = $this->gerarMensagemPortaria($autorizacao);

            Log::info("Notificação para Portaria", [
                'autorizacao_id' => $autorizacao->id,
                'aluno' => $aluno->nome ?? 'N/A',
                'tipo' => $autorizacao->tipo,
                'status' => $autorizacao->status,
                'mensagem' => $mensagem,
            ]);

            NotificationLog::create([
                'autorizacao_id' => $autorizacao->id,
                'tipo' => 'email',
                'destinatario' => 'portaria@escola.com',
                'assunto' => "Autorização Validação - {$aluno->nome}",
                'conteudo' => $mensagem,
                'status' => 'enviado',
                'enviado_em' => now(),
            ]);
        } catch (\Exception $e) {
            Log::error("Erro ao notificar portaria", [
                'autorizacao_id' => $autorizacao->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function gerarMensagem(Autorizacao $autorizacao): string
    {
        $aluno = $autorizacao->aluno;
        $turma = $autorizacao->turma;
        $tipo = match($autorizacao->tipo) {
            'entrar' => 'ENTRADA',
            'sair' => 'SAÍDA',
            default => strtoupper($autorizacao->tipo),
        };
        $horario = $autorizacao->horario ? $autorizacao->horario->format('H:i') : 'N/A';
        $data = $autorizacao->created_at->format('d/m/Y');

        return <<<MSG
        ╔════════════════════════════════════╗
        ║   AUTORIZAÇÃO DE {$tipo}   ║
        ╚════════════════════════════════════╝
        
        Aluno: {$aluno->nome}
        Turma: {$turma->nome}
        Data: {$data}
        Horário: {$horario}
        Status: {$autorizacao->status}
        
        ✓ Esta é uma autorização automática do sistema SAFE
        MSG;
    }

    private function gerarMensagemPortaria(Autorizacao $autorizacao): string
    {
        $aluno = $autorizacao->aluno;
        $turma = $autorizacao->turma;
        $tipo = match($autorizacao->tipo) {
            'entrar' => 'ENTRADA',
            'sair' => 'SAÍDA',
            default => strtoupper($autorizacao->tipo),
        };
        $horario = $autorizacao->horario ? $autorizacao->horario->format('H:i') : 'N/A';
        $data = $autorizacao->created_at->format('d/m/Y');
        $aulas = is_array($autorizacao->aulas_afetadas) ? implode(', ', $autorizacao->aulas_afetadas) : ($autorizacao->aulas_afetadas ?? 'N/A');

        return <<<MSG
        ╔════════════════════════════════════╗
        ║  AVISO PARA PORTARIA - {$tipo}   ║
        ╚════════════════════════════════════╝
        
        Aluno: {$aluno->nome}
        Turma: {$turma->nome}
        Data: {$data}
        Horário: {$horario}
        Aulas Afetadas: {$aulas}
        Status: {$autorizacao->status}
        
        ✓ Autorização já foi validada pelo professor
        ⚠ Aguarda validação final da portaria
        MSG;
    }
}
