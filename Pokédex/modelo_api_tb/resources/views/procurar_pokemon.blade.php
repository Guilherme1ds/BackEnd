@extends('layouts.app')

@section('title', 'Procurar Pokémon')

@section('content')
    <div class="container">
        <h1>🔍 Procurar Pokémon</h1>
        <p style="text-align: center; color: #666; margin-bottom: 30px;">
            Busque pelo nome do Pokémon. Procuramos em nosso banco de dados e na PokeAPI!
        </p>

        <div style="max-width: 600px; margin: 0 auto 30px;">
            <form method="GET" action="{{ route('pokemon.search.result') }}" class="search-bar">
                <input 
                    type="text" 
                    name="q" 
                    placeholder="Digite o nome do Pokémon..." 
                    required
                    minlength="2"
                    style="padding: 15px; font-size: 1.1em; width: 100%;"
                >
                <button type="submit" class="btn btn-primary" style="white-space: nowrap;">
                    🔍 Procurar
                </button>
            </form>
        </div>

        <div style="background: #f9f9f9; padding: 20px; border-radius: 8px; border-left: 4px solid #FFC107;">
            <h3>💡 Dicas de Busca</h3>
            <ul style="margin-left: 20px; color: #666; padding-top: 10px;">
                <li style="margin-bottom: 8px;">Procure por nomes como: "Pikachu", "Charmander" ou "Lucario".</li>
                <li style="margin-bottom: 8px;">A busca funciona tanto para Pokémons da PokeAPI quanto para os que você cadastrou.</li>
                <li>Certifique-se de digitar pelo menos 2 caracteres para obter resultados melhores.</li>
            </ul>
        </div>
    </div>
@endsection