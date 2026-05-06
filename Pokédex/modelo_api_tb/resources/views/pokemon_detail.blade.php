@extends('layouts.app')

@section('title', $pokemon->name . ' - Detalhes')

@section('content')
    <div class="container">
        <h1>📊 {{ ucfirst($pokemon->name) }}</h1>

        @if(isset($pokemon))
            <div style="display: flex; justify-content: center; margin-bottom: 30px;">
                <div class="card" style="max-width: 400px; width: 100%;">
                    <div style="text-align: center; margin-bottom: 20px;">
                        @if ($pokemon->image)
                            <img src="{{ asset('storage/' . $pokemon->image) }}" 
                                 alt="{{ $pokemon->name }}" 
                                 style="width: 200px; height: 200px; object-fit: contain;">
                        @else
                            <div style="width: 200px; height: 200px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; margin: 0 auto; border-radius: 8px;">
                                <span style="color: #999; font-size: 4em;">🎯</span>
                            </div>
                        @endif
                    </div>

                    <div style="text-align: center;">
                        <h2 style="margin: 0 0 10px; text-transform: capitalize;">
                            #{{ $pokemon->pokedex_number ?? 'N/A' }} - {{ ucfirst($pokemon->name) }}
                        </h2>

                        <div style="margin: 15px 0;">
                            <strong>Tipo:</strong>
                            <div>
                                <span style="display: inline-block; background: #DC143C; color: white; padding: 8px 15px; border-radius: 5px; margin: 5px 5px 5px 0; text-transform: capitalize; font-weight: bold;">
                                    {{ ucfirst($pokemon->type) }}
                                </span>
                            </div>
                        </div>

                        <div style="margin: 15px 0;">
                            <strong>Habilidades:</strong>
                            <div>
                                @foreach(explode(',', $pokemon->abilities) as $ability)
                                    <span style="display: inline-block; background: #4CAF50; color: white; padding: 8px 15px; border-radius: 5px; margin: 5px 5px 5px 0; text-transform: capitalize;">
                                        {{ trim($ability) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        @if ($pokemon->description)
                            <div style="margin: 15px 0; text-align: left; background: #f5f5f5; padding: 15px; border-radius: 8px;">
                                <strong>Descrição:</strong>
                                <p style="margin: 10px 0 0 0; color: #666; line-height: 1.6;">
                                    {{ $pokemon->description }}
                                </p>
                            </div>
                        @endif

                        <div style="margin: 15px 0; text-align: left; background: #f5f5f5; padding: 15px; border-radius: 8px;">
                            <p style="margin: 5px 0;"><strong>Criado em:</strong> {{ $pokemon->created_at->format('d/m/Y H:i') }}</p>
                            @if ($pokemon->updated_at && $pokemon->updated_at != $pokemon->created_at)
                                <p style="margin: 5px 0;"><strong>Atualizado em:</strong> {{ $pokemon->updated_at->format('d/m/Y H:i') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div style="text-align: center;">
                <a href="{{ route('pokemon.edit', $pokemon) }}" class="btn btn-secondary" style="margin-right: 10px;">
                    ✏️ Editar
                </a>
                <form method="POST" action="{{ route('pokemon.destroy', $pokemon) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="margin-right: 10px;" onclick="return confirm('Tem certeza que deseja deletar este Pokémon?')">
                        🗑️ Deletar
                    </button>
                </form>
                <a href="{{ route('pokemon.list') }}" class="btn btn-primary">
                    ⬅️ Voltar aos Meus Pokémons
                </a>
            </div>
        @else
            <div style="text-align: center; padding: 40px;">
                <p style="font-size: 1.2em; color: #E53935;">
                    ⚠️ Erro ao carregar o Pokémon. Tente novamente!
                </p>
                <a href="{{ route('pokemon.list') }}" class="btn btn-primary" style="margin-top: 20px;">
                    ⬅️ Voltar
                </a>
            </div>
        @endif
    </div>
@endsection
