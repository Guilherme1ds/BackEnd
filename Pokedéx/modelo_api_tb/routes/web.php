<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', [PokemonController::class, 'home'])->name('home');

// Pokedex - Pokemon aleatório
Route::get('/pokedex', [PokemonController::class, 'pokedex'])->name('pokedex');

// Pokémons criados
Route::get('/pokemons', [PokemonController::class, 'listAll'])->name('pokemon.list');

// Procurar Pokemon
Route::get('/procurar', [PokemonController::class, 'search'])->name('pokemon.search');
Route::get('/procurar/resultado', [PokemonController::class, 'searchResult'])->name('pokemon.search.result');

// Criar Pokemon (DEVE VIR ANTES DA ROTA PARAMETRIZADA!)
Route::get('/criar', [PokemonController::class, 'create'])->name('pokemon.create');
Route::post('/criar', [PokemonController::class, 'store'])->name('pokemon.store');

// Pokemon da API
Route::get('/api-pokemon/{nameOrId}', [PokemonController::class, 'showApiPokemon'])->name('api.pokemon.show');

// Rotas parametrizadas (VEM POR ÚLTIMO!)
Route::get('/pokemon/{pokemon}/editar', [PokemonController::class, 'edit'])->name('pokemon.edit');
Route::put('/pokemon/{pokemon}', [PokemonController::class, 'update'])->name('pokemon.update');
Route::delete('/pokemon/{pokemon}', [PokemonController::class, 'destroy'])->name('pokemon.destroy');
Route::get('/pokemon/{pokemon}', [PokemonController::class, 'show'])->name('pokemon.show');
