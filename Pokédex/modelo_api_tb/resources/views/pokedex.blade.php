@extends('layouts.app')

@section('title', 'Pokedex - Pokémon Aleatório')

@section('content')
    <div class="container">
        <h1>🎲 Pokedex - Pokémon Aleatório</h1>
        <p style="text-align: center; color: #666; margin-bottom: 30px;">Clique no botão abaixo para descobrir um novo Pokémon!</p>

        @if(isset($pokemon))
            <div style="display: flex; justify-content: center; margin-bottom: 30px;">
                <div class="card" style="max-width: 400px; width: 100%;">
                    <div style="text-align: center; margin-bottom: 20px;">
                        <img src="{{ $pokemon['sprites']['front_default'] ?? 'https://via.placeholder.com/200' }}" 
                             alt="{{ $pokemon['name'] }}" 
                             style="width: 200px; height: 200px; object-fit: contain;">
                    </div>

                    <div style="text-align: center;">
                        <h2 style="margin: 0 0 10px; text-transform: capitalize;">
                            #{{ $pokemon['id'] ?? 'N/A' }} - {{ ucfirst($pokemon['name']) }}
                        </h2>

                        <div style="margin: 15px 0;">
                            <strong>Tipos:</strong>
                            <div>
                                @foreach($pokemon['types'] as $type)
                                    <span style="display: inline-block; background: #FFC107; color: white; padding: 5px 10px; border-radius: 5px; margin: 5px 5px 5px 0; text-transform: capitalize;">
                                        {{ $type['type']['name'] }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div style="margin: 15px 0;">
                            <strong>Habilidades:</strong>
                            <div>
                                @foreach($pokemon['abilities'] as $ability)
                                    <span style="display: inline-block; background: #4CAF50; color: white; padding: 5px 10px; border-radius: 5px; margin: 5px 5px 5px 0; text-transform: capitalize;">
                                        {{ str_replace('-', ' ', $ability['ability']['name']) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div style="margin: 15px 0; text-align: left; background: #f5f5f5; padding: 15px; border-radius: 8px;">
                            <p style="margin: 5px 0;"><strong>Altura:</strong> {{ ($pokemon['height'] / 10) ?? 'N/A' }} m</p>
                            <p style="margin: 5px 0;"><strong>Peso:</strong> {{ ($pokemon['weight'] / 10) ?? 'N/A' }} kg</p>
                            <p style="margin: 5px 0;"><strong>Experiência Base:</strong> {{ $pokemon['base_experience'] ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div style="text-align: center;">
                <a href="{{ route('pokedex') }}" class="btn btn-primary" style="margin-right: 10px;">
                    🎲 Próximo Pokémon Aleatório
                </a>
                <a href="{{ route('home') }}" class="btn btn-secondary">
                    ⬅️ Voltar ao Home
                </a>
            </div>
        @else
            <div style="text-align: center; padding: 40px;">
                <p style="font-size: 1.2em; color: #E53935;">
                    ⚠️ Erro ao carregar o Pokémon. Tente novamente!
                </p>
                <a href="{{ route('pokedex') }}" class="btn btn-primary" style="margin-top: 20px;">
                    🔄 Tentar Novamente
                </a>
            </div>
        @endif
    </div>
@endsection
