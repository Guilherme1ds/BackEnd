<?php

namespace App\Models;

use App\Events\AutorizacaoCreated;
use App\Events\AutorizacaoUpdated;
use Illuminate\Database\Eloquent\Model;

class Autorizacao extends Model
{
    protected $table = 'autorizacoes';
    
    protected $fillable = [
        'aluno_id', 'turma_id', 'tipo', 'horario', 'conta_falta', 
        'aulas_afetadas', 'status', 'criado_por_id', 'aprovado_por_id', 
        'validado_por_id', 'observacao'
    ];

    protected $casts = [
        'aulas_afetadas' => 'array',         
        'horario' => 'datetime',        
        'conta_falta' => 'boolean',         
    ];

    protected $dispatchesEvents = [
        'created' => AutorizacaoCreated::class,
        'updated' => AutorizacaoUpdated::class,
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function criadoPor()
    {
        return $this->belongsTo(User::class, 'criado_por_id');
    }

    public function aprovadoPor()
    {
        return $this->belongsTo(User::class, 'aprovado_por_id');
    }

    public function validadoPor()
    {
        return $this->belongsTo(User::class, 'validado_por_id');
    }
}