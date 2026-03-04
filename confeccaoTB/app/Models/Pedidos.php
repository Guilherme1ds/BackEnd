<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
use HasFactory;
protected $fillable = ['nome_cliente', 'produto_pedido', 'quantidade_pedido', 'data', 'preco_pedido'];
protected $casts = [
    'data' => 'date',
];
}
