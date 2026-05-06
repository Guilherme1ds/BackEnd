@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="hero">
        <h1>🎮 Bem-vindo à Pokédex Digital! 🎮</h1>
        <p>Explore, crie e gerencie seus Pokémons favoritos em um só lugar!</p>
        <div class="hero-buttons">
            <a href="{{ route('pokedex') }}" class="btn btn-primary">🎲 Descobrir Pokémon Aleatório</a>
            <a href="{{ route('pokemon.list') }}" class="btn btn-secondary">📚 Ver Meus Pokémons</a>
            <a href="{{ route('pokemon.create') }}" class="btn btn-success">➕ Criar Novo Pokémon</a>
            <a href="{{ route('pokemon.search') }}" class="btn btn-primary">🔍 Procurar Pokémon</a>
        </div>
    </div>

    <div class="container">
        <h2>📖 Como Funciona?</h2>
        <div class="grid">
            <div class="card">
                <h3>🎲 Pokedex Aleatória</h3>
                <p>Descubra novos Pokémons aleatoriamente! Cada clique mostra um Pokémon diferente com todas as suas informações e habilidades.</p>
            </div>
            <div class="card">
                <h3>🎯 Meus Pokémons</h3>
                <p>Visualize todos os Pokémons que você criou e cadastrou. Edite, delete ou veja os detalhes de cada um.</p>
            </div>
            <div class="card">
                <h3>✨ Criar Pokémon</h3>
                <p>Use sua criatividade! Crie novos Pokémons com nomes, tipos, habilidades e descrições personalizadas.</p>
            </div>
            <div class="card">
                <h3>🔍 Procurar</h3>
                <p>Busque Pokémons pelo nome ou tipo. Encontre rápido o Pokémon que você está procurando!</p>
            </div>
        </div>
    </div>
@endsection
