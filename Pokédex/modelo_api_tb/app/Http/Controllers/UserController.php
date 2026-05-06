<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        $error = null;

        // Se o usuário digitou algo na barra de pesquisa
        if ($search) {
            $response = Http::get("https://dummyjson.com/users/search?q={$search}");
            
            if ($response->successful() && count($response->json()['users']) > 0) {
                // Pega o primeiro usuário que corresponder à pesquisa
                $user = $response->json()['users'][0];
                return view('user', compact('user', 'error'));
            } else {
                $error = "Nenhum colaborador encontrado com o nome '{$search}'. Exibindo perfil aleatório.";
            }
        }

        $id = rand(1, 200); 
        $response = Http::get("https://dummyjson.com/users/{$id}");
        
        if ($response->successful()) {
            $user = $response->json();
            return view('user', compact('user', 'error'));
        }

        return "Erro ao buscar dados API";
    }
}