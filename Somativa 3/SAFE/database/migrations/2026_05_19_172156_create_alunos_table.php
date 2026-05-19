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
    Schema::create('alunos', function (Blueprint $table) {
        $table->id();
        $table->string('nome'); // Nome do aluno
        $table->foreignId('turma_id')->constrained('turmas')->onDelete('cascade'); 
        $table->string('nome_responsavel')->nullable(); 
        $table->string('telefone_responsavel')->nullable(); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
