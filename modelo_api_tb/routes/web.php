<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

route::get('/usuarios', [UserController::class, 'index']);

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

    try {
        $idGerado = DB::table('usuarios')->insertGetId([
            'nome' => $dados['nome'],
            'genero' => $dados['genero'],
            'idade' => $dados['idade'],
        ]);

    return response()->json([
        'mensagem' => 'Usuario cadastrado com sucesso!',
        'id_gerado' => $idGerado,
        'dados_recebidos' => $dados
    ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'erro' => 'Falha ao salvar no banco de dados',
            'detalhe' => $e->getMessage()
        ], 500);
    }
});

Route::get('/', function () {
    return view('welcome');
});
