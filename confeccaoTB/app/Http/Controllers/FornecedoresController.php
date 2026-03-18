<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fornecedores;

class FornecedoresController extends Controller
{
    public function index() {
        $fornecedores = Fornecedores::all();
        return view('fornecedores.index', compact('fornecedores'));
    }

     public function create() 
    {
        return view('fornecedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'     => 'required|string|max:255',
            'cnpj'     => 'required|string|unique:fornecedores',
            'email'    => 'required|email|unique:fornecedores',
            'telefone' => 'required|string',
            'endereco' => 'nullable|string',
        ]);

        Fornecedores::create($request->all());

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    public function edit(Fornecedores $fornecedor)
    {
        return view('fornecedores.edit', compact('fornecedor'));
    }

    public function update(Request $request, Fornecedores $fornecedor)
    {
        $request->validate([
            'nome'     => 'required|string|max:255',
            'cnpj'     => 'required|string|unique:fornecedores,cnpj,' . $fornecedor->id,
            'email'    => 'required|email|unique:fornecedores,email,' . $fornecedor->id,
            'telefone' => 'required|string',
            'endereco' => 'nullable|string',
        ]);

        $fornecedor->update($request->all());
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado!');
    }

    public function destroy(Fornecedores $fornecedor)
    {
        $fornecedor->delete();
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor removido!');
    }
}
