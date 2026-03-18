<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Estoque;

class EstoqueController extends Controller
{
    public function index() {
        $estoque = Estoque::all();
        return view('estoque.index', compact('estoque'));
    }

    public function create() 
    {
        return view('estoque.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'produto' => 'required|string|max:255',
            'quantidade' => 'required|integer',
            'preco_custo' => 'required|numeric',
            'preco_venda' => 'required|numeric',
            'estoque_minimo' => 'required|integer',
        ]);

        $data = $request->only(['produto', 'quantidade', 'preco_custo', 'preco_venda', 'estoque_minimo']);
        Estoque::create($data);

        return redirect()->route('estoque.index')->with('success', 'Estoque atualizado com sucesso!');
    }

    public function edit(Estoque $estoque)
    {
        return view('estoque.edit', compact('estoque'));
    }

    public function update(Request $request, Estoque $estoque)
    {
        $request->validate([
            'produto' => 'required|string|max:255',
            'quantidade' => 'required|integer',
            'preco_custo' => 'required|numeric',
            'preco_venda' => 'required|numeric',
            'estoque_minimo' => 'required|integer',
        ]);

        $data = $request->only(['produto', 'quantidade', 'preco_custo', 'preco_venda', 'estoque_minimo']);
        $estoque->update($data);
        return redirect()->route('estoque.index')->with('success', 'Estoque atualizado!');
    }

    public function destroy(Estoque $estoque)
    {
        $estoque->delete();
        return redirect()->route('estoque.index')->with('success', 'Produto removido do estoque!');
    }
}
