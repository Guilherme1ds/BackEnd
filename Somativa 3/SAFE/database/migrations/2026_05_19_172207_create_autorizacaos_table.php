<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('autorizacoes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('aluno_id')->constrained('alunos')->onDelete('cascade');
        $table->foreignId('turma_id')->constrained('turmas')->onDelete('cascade');
        $table->enum('tipo', ['entrar', 'sair']);
        $table->time('horario')->nullable(); 
        $table->boolean('conta_falta')->default(false); 
        $table->json('aulas_afetadas')->nullable(); // Guardará as aulas: 1ª, 2ª...
        
        $table->enum('status', ['pendente', 'autorizado_professor', 'concluido_portaria', 'recusado'])
              ->default('pendente');

        // Auditoria: Quem operou em cada etapa (usamos 'users' pois é o padrão nativo do Laravel de usuários)
        $table->foreignId('criado_por_id')->constrained('users'); 
        $table->foreignId('aprovado_por_id')->nullable()->constrained('users'); 
        $table->foreignId('validado_por_id')->nullable()->constrained('users'); 
        
        $table->text('observacao')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autorizacaos');
    }
};
