<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pedidos;
class PedidosController extends Controller
{
    public function index() {
        $pedidos = Pedidos::all();
        return view('pedidos.index', compact('pedidos'));
    }

     public function create() 
    {
        return view('pedidos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_cliente' => 'required|string|max:255',
            'produto_pedido' => 'required|string|max:255',
            'quantidade_pedido' => 'required|integer',
            'data' => 'required|date',
            'preco_pedido' => 'required|numeric',
        ]);

        Pedidos::create($request->all());

        return redirect()->route('pedidos.index')->with('success', 'Pedido cadastrado com sucesso!');
    }

     public function edit(Pedidos $pedido)
    {
        return view('pedidos.edit', compact('pedido'));
    }

    public function update(Request $request, Pedidos $pedido)
    {
        $request->validate([
            'nome_cliente' => 'required|string|max:255',
            'produto_pedido' => 'required|string|max:255',
            'quantidade_pedido' => 'required|integer',
            'data' => 'required|date',
            'preco_pedido' => 'required|numeric',
        ]);

        $pedido->update($request->all());
        return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado!');
    }

    public function destroy(Pedidos $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedidos.index')->with('success', 'Pedido removido!');
    }
}
