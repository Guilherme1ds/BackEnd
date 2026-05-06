@extends('layouts.app')

@section('title', 'Meus Pokémons')

@section('content')
    <div class="container">
        <h1>📚 Meus Pokémons</h1>
        <p style="text-align: center; color: #666; margin-bottom: 30px;">
            Clique em um Pokémon para ver os detalhes
        </p>

        @if ($pokemons->count() > 0)
            <p style="margin-bottom: 20px; text-align: center; font-weight: bold; color: #DC143C;">
                Total: {{ $pokemons->count() }} Pokémons
            </p>

            <div class="grid">
                @foreach ($pokemons as $pokemon)
                    <a href="{{ route('pokemon.show', $pokemon) }}" style="text-decoration: none; color: inherit;">
                        <div class="card" style="cursor: pointer; height: 100%;">
                            @if ($pokemon->image)
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

            <div style="margin-top: 30px; text-align: center;">
                <a href="{{ route('pokemon.create') }}" class="btn btn-primary">
                    ➕ Criar Novo Pokémon
                </a>
            </div>
        @else
            <div style="text-align: center; padding: 60px 20px; background: #f9f9f9; border-radius: 12px; border: 2px dashed #ddd;">
                <p style="font-size: 3em; margin-bottom: 20px;">🔍</p>
                <h2 style="color: #666; margin-bottom: 15px;">Nenhum Pokémon Cadastrado</h2>
                <p style="color: #999; margin-bottom: 30px;">Sua coleção está vazia! Comece a criar seus Pokémons.</p>
                <a href="{{ route('pokemon.create') }}" class="btn btn-success">
                    ➕ Criar Primeiro Pokémon
                </a>
            </div>
        @endif
    </div>
@endsection
