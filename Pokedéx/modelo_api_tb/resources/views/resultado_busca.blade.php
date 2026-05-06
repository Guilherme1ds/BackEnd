@extends('layouts.app')

@section('title', 'Resultados da Busca')

@section('content')
    <div class="container">
        <h1>🔍 Resultados da Busca: "{{ $query }}"</h1>

        @if($localResults->isEmpty() && empty($apiResults))
            <div style="text-align: center; padding: 40px; background: #fff3cd; border-radius: 8px; border-left: 4px solid #FFC107;">
                <p style="font-size: 1.2em; color: #856404; margin-bottom: 20px;">
                    😕 Nenhum Pokémon encontrado com "{{ $query }}"
                </p>
                <a href="{{ route('pokemon.search') }}" class="btn btn-secondary">
                    ← Voltar e Procurar Novamente
                </a>
            </div>
        @else
            @if(!$localResults->isEmpty())
                <div style="margin-bottom: 40px;">
                    <h2 style="color: #FF6B6B; margin-bottom: 20px;">📚 Pokémons Criados ({{ $localResults->count() }})</h2>
                    <div class="grid">
                        @foreach($localResults as $pokemon)
                            <a href="{{ route('pokemon.show', $pokemon) }}" style="text-decoration: none; color: inherit;">
                                <div class="card" style="cursor: pointer; height: 100%;">
                                    @if($pokemon->image)
                                        <img src="{{ asset('storage/' . $pokemon->image) }}" alt="{{ $pokemon->name }}" style="height: 120px;">
                                    @else
                                        <div style="width: 100%; height: 120px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; border-radius: 8px;">
                                            <span style="color: #999; font-size: 2em;">🎯</span>
                                        </div>
                                    @endif
                                    <div class="card-title">{{ $pokemon->name }}</div>
                                    <div class="card-id">#{{ $pokemon->pokedex_number ?? 'N/A' }}</div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(!empty($apiResults))
                <div>
                    <h2 style="color: #FFC107; margin-bottom: 20px;">🌐 Resultados da Pokeapi ({{ count($apiResults) }})</h2>
                    <div class="grid">
                        @foreach($apiResults as $pokemon)
                            @php
                                $pokemonName = $pokemon['name'] ?? $pokemon->name ?? 'Unknown';
                                $pokemonUrl = $pokemon['url'] ?? '#';
                                $pokemonId = null;
                                if(isset($pokemon['url'])) {
                                    preg_match('/\/(\d+)\/$/', $pokemon['url'], $matches);
                                    $pokemonId = $matches[1] ?? null;
                                } elseif(isset($pokemon['id'])) {
                                    $pokemonId = $pokemon['id'];
                                }
                                $imageUrl = $pokemonId ? "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{$pokemonId}.png" : 'https://via.placeholder.com/200';
                            @endphp
                            <a href="{{ route('api.pokemon.show', $pokemonName) }}" style="text-decoration: none; color: inherit;">
                                <div class="card" style="cursor: pointer; height: 100%;">
                                    <img src="{{ $imageUrl }}" alt="{{ $pokemonName }}" onerror="this.src='https://via.placeholder.com/200'">
                                    <div class="card-title" style="text-transform: capitalize;">{{ $pokemonName }}</div>
                                    @if($pokemonId)
                                        <p class="card-text"><strong>#{{ $pokemonId }}</strong></p>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('pokemon.search') }}" class="btn btn-secondary">
                    ← Procurar Novamente
                </a>
                <a href="{{ route('home') }}" class="btn btn-primary">
                    🏠 Ir para Home
                </a>
            </div>
        @endif
    </div>
@endsection
