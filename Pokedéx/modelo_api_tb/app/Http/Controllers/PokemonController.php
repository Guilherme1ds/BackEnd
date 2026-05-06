<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
    /**
     * Mapeamento de tipos para tradução
     */
    private function translateType($type)
    {
        $translations = [
            'normal' => 'Normal',
            'fire' => 'Fogo',
            'water' => 'Água',
            'grass' => 'Grama',
            'electric' => 'Elétrico',
            'ice' => 'Gelo',
            'fighting' => 'Lutador',
            'poison' => 'Venenoso',
            'ground' => 'Terra',
            'flying' => 'Voador',
            'psychic' => 'Psíquico',
            'bug' => 'Inseto',
            'rock' => 'Pedra',
            'ghost' => 'Fantasma',
            'dragon' => 'Dragão',
            'dark' => 'Sombrio',
            'steel' => 'Aço',
            'fairy' => 'Fada',
        ];

        return $translations[strtolower($type)] ?? $type;
    }

    public function home()
    {
        return view('home');
    }

    public function pokedex()
    {
        $id = rand(1, 1025);
        $response = Http::withoutVerifying()->get("https://pokeapi.co/api/v2/pokemon/{$id}");
        if ($response->successful()) {
            $pokemon = $response->json();
            
            // Traduzindo os tipos no JSON antes de enviar para a view
            foreach ($pokemon['types'] as &$t) {
                $t['type']['name'] = $this->translateType($t['type']['name']);
            }

            return view('pokedex', compact('pokemon'));
        }
        return "Erro ao buscar dados API";
    }

    public function index()
    {
        $id = rand(1, 1025);
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$id}");
        if ($response->successful()) {
            $pokemon = $response->json();

            // Traduzindo os tipos
            foreach ($pokemon['types'] as &$t) {
                $t['type']['name'] = $this->translateType($t['type']['name']);
            }

            return view('pokemon', compact('pokemon'));
        }
        return "Erro ao buscar dados API";
    }

    public function create()
    {
        return view('cadastrar_pokemon');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:pokemons|max:255',
            'type' => 'required|string|max:255',
            'abilities' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pokedex_number' => 'nullable|integer|unique:pokemons',
        ], [
            'name.required' => 'O nome do Pokémon é obrigatório',
            'name.unique' => 'Este Pokémon já foi cadastrado',
            'type.required' => 'O tipo é obrigatório',
            'abilities.required' => 'As habilidades são obrigatórias',
            'image.image' => 'O arquivo deve ser uma imagem',
            'image.mimes' => 'A imagem deve ser em formato JPEG, PNG, JPG ou GIF',
            'image.max' => 'A imagem não pode ser maior que 2MB',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pokemons', 'public');
        }

        Pokemon::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'abilities' => $validated['abilities'],
            'description' => $validated['description'] ?? null,
            'image' => $imagePath,
            'pokedex_number' => $validated['pokedex_number'] ?? null,
        ]);

        return redirect()->route('pokemon.create')->with('success', 'Pokémon cadastrado com sucesso!');
    }

    public function show(Pokemon $pokemon)
    {
        return view('pokemon_detail', compact('pokemon'));
    }

    public function listAll()
    {
        $pokemons = Pokemon::all();
        return view('pokemons_list', compact('pokemons'));
    }

    public function search()
    {
        return view('procurar_pokemon');
    }

    public function searchResult(Request $request)
    {
        $query = $request->query('q');
        
        if (!$query || strlen($query) < 2) {
            return redirect()->route('pokemon.search')->with('error', 'Digite pelo menos 2 caracteres');
        }

        $localResults = Pokemon::where('name', 'like', "%{$query}%")
            ->orWhere('type', 'like', "%{$query}%")
            ->get();

        $apiResults = [];
        $response = Http::withoutVerifying()->get("https://pokeapi.co/api/v2/pokemon/{$query}");
        
        if ($response->successful()) {
            $pokemon = $response->json();
            // Traduz tipos do resultado único
            foreach ($pokemon['types'] as &$t) {
                $t['type']['name'] = $this->translateType($t['type']['name']);
            }
            $apiResults[] = $pokemon;
        } else {
            $searchResponse = Http::withoutVerifying()->get("https://pokeapi.co/api/v2/pokemon?limit=100000");
            if ($searchResponse->successful()) {
                $allPokemons = $searchResponse->json()['results'];
                $query_lower = strtolower($query);
                $filtered = array_filter($allPokemons, function($p) use ($query_lower) {
                    return strpos(strtolower($p['name']), $query_lower) !== false;
                });
                $apiResults = array_slice(array_values($filtered), 0, 10);
            }
        }

        return view('resultado_busca', compact('localResults', 'apiResults', 'query'));
    }

    public function edit(Pokemon $pokemon)
    {
        return view('editar_pokemon', compact('pokemon'));
    }

    public function update(Request $request, Pokemon $pokemon)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:pokemons,name,' . $pokemon->id,
            'type' => 'required|string|max:255',
            'abilities' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pokedex_number' => 'nullable|integer|unique:pokemons,pokedex_number,' . $pokemon->id,
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pokemons', 'public');
            $validated['image'] = $imagePath;
        }

        $pokemon->update($validated);

        return redirect()->route('pokemon.list')->with('success', 'Pokémon atualizado com sucesso!');
    }

    public function destroy(Pokemon $pokemon)
    {
        $pokemon->delete();
        return redirect()->route('pokemon.list')->with('success', 'Pokémon deletado com sucesso!');
    }

    public function showApiPokemon($nameOrId)
    {
        $response = Http::withoutVerifying()->get("https://pokeapi.co/api/v2/pokemon/{$nameOrId}");
        
        if ($response->successful()) {
            $pokemon = $response->json();

            // Traduzindo os tipos antes de exibir o detalhe
            foreach ($pokemon['types'] as &$t) {
                $t['type']['name'] = $this->translateType($t['type']['name']);
            }

            return view('api_pokemon_detail', compact('pokemon'));
        }

        return abort(404, 'Pokémon não encontrado');
    }
}