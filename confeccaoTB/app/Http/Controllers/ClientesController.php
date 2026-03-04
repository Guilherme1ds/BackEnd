<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientesController extends Controller
{ 
    public function index() {
    $Clientes = \App\Models\Clientes::all(); // Busca todos os clientes
    return view('clientes.index', compact('Clientes'));
    }
}
