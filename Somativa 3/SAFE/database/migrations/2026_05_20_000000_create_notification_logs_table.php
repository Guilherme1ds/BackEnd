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
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('autorizacao_id')->index();
            $table->string('tipo'); // 'email', 'whatsapp', 'sms'
            $table->string('destinatario'); // email ou telefone
            $table->string('assunto')->nullable();
            $table->text('conteudo');
            $table->string('status'); // 'pendente', 'enviado', 'falha'
            $table->text('resposta_api')->nullable();
            $table->timestamp('enviado_em')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_logs');
    }
};
