<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = ['produto', 'quantidade', 'localizacao', 'preco_custo', 'preco_venda', 'estoque_minimo',];

    protected $casts = [
        'quantidade' => 'integer',
        'preco_custo' => 'decimal:2',
        'preco_venda' => 'decimal:2',
        'estoque_minimo' => 'integer',
    ];
}
