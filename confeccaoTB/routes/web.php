<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\FornecedoresController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\ProdutosController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rotas para estrutura de clientes para cadastro, edição e exclusão
// Rota para mostrar o formulário
Route::get('/clientes/create', [ClientesController::class, 'create'])->name('clientes.create');

// Rotas RESTful para edição, atualização e exclusão
Route::get('/clientes/{cliente}/edit', [ClientesController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/{cliente}', [ClientesController::class, 'destroy'])->name('clientes.destroy');

// Rota para RECEBER os dados e salvar (POST)
Route::post('/clientes', [ClientesController::class,'store'])->name('clientes.store');

Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index')->middleware('auth');

// Rotas para estrutura de pedidos
Route::get('/pedidos/create', [PedidosController::class, 'create'])->name('pedidos.create');
Route::post('/pedidos', [PedidosController::class, 'store'])->name('pedidos.store');
Route::get('/pedidos', [PedidosController::class, 'index'])->name('pedidos.index')->middleware('auth');
Route::get('/pedidos/{pedido}/edit', [PedidosController::class, 'edit'])->name('pedidos.edit');
Route::put('/pedidos/{pedido}', [PedidosController::class, 'update'])->name('pedidos.update');
Route::delete('/pedidos/{pedido}', [PedidosController::class, 'destroy'])->name('pedidos.destroy');

// Rotas para estrutura de fornecedores
Route::get('/fornecedores/create', [FornecedoresController::class, 'create'])->name('fornecedores.create');
Route::post('/fornecedores', [FornecedoresController::class, 'store'])->name('fornecedores.store');
Route::get('/fornecedores', [FornecedoresController::class, 'index'])->name('fornecedores.index')->middleware('auth');
Route::get('/fornecedores/{fornecedor}/edit', [FornecedoresController::class, 'edit'])->name('fornecedores.edit');
Route::put('/fornecedores/{fornecedor}', [FornecedoresController::class, 'update'])->name('fornecedores.update');
Route::delete('/fornecedores/{fornecedor}', [FornecedoresController::class, 'destroy'])->name('fornecedores.destroy');

// Rotas para estrutura de estoque
Route::get('/estoque/create', [EstoqueController::class, 'create'])->name('estoque.create');
Route::post('/estoque', [EstoqueController::class, 'store'])->name('estoque.store');
Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque.index')->middleware('auth');
Route::get('/estoque/{estoque}/edit', [EstoqueController::class, 'edit'])->name('estoque.edit');
Route::put('/estoque/{estoque}', [EstoqueController::class, 'update'])->name('estoque.update');
Route::delete('/estoque/{estoque}', [EstoqueController::class, 'destroy'])->name('estoque.destroy');

// Rotas para estrutura de produtos
Route::get('/produtos/create', [ProdutosController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [ProdutosController::class, 'store'])->name('produtos.store');
Route::get('/produtos', [ProdutosController::class, 'index'])->name('produtos.index')->middleware('auth');
Route::get('/produtos/{produto}/edit', [ProdutosController::class, 'edit'])->name('produtos.edit');
Route::put('/produtos/{produto}', [ProdutosController::class, 'update'])->name('produtos.update');
Route::delete('/produtos/{produto}', [ProdutosController::class, 'destroy'])->name('produtos.destroy');

use App\Models\Clientes;
use App\Models\Produtos;
use App\Models\Estoque;
use App\Models\Fornecedores;
use App\Models\Pedidos;

Route::get('/dashboard', function () {
    $clientesCount = Clientes::count();
    $produtosCount = Produtos::count();
    $estoqueCount = Estoque::count();
    $fornecedoresCount = Fornecedores::count();
    $pedidosCount = Pedidos::count();
    return view('dashboard', compact('clientesCount', 'produtosCount', 'estoqueCount', 'fornecedoresCount', 'pedidosCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
