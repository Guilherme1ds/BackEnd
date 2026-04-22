<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

// Exemplo 1: GET
Route::get('user/{username}', function ($username) {
    $response = Http::get("https://dummyjson.com/user/{$username}");

    if ($response->successful()) {
        $dados = $response->json();
        return response()->json([
            'status' => 'Conectado com sucesso!',
            'resultado' => [
                'identificador' => $dados['id'],
                'nome' => ucfirst($dados['username']),
                'genero' => $dados['gender'],
                'idade' => $dados['age']
            ]
        ], 200);
    }
    return response()->json(['erro' => 'Usuario não encontrado'], 404);
});

// Exemplo 2: POST

Route::post('user/novo', function(Request $request) {
    $dados = $request->validate([
        'nome' => 'required|string|min:3',
        'genero' => 'required|string',
        'idade' => 'required|integer'
    ]);

    return response()->json([
        'mensagem' => 'Usuario cadastrado com sucesso!',
        'id_gerado' => rand(1000,9999),
        'dados_recebidos' => $dados
    ], 201);
});

Route::get('/', function () {
    return view('welcome');
});
