<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $table = 'alunos';
    
    protected $fillable = ['nome', 'turma_id', 'nome_responsavel', 'telefone_responsavel'];

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }
}
