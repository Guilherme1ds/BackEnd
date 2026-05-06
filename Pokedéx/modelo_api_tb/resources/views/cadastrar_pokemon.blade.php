@extends('layouts.app')

@section('title', 'Criar Pokémon')

@section('content')
    <div class="container" style="max-width: 600px;">
        <h1>➕ Criar Novo Pokémon</h1>
        <p style="text-align: center; color: #666; margin-bottom: 30px;">
            Preencha os campos abaixo para criar um novo Pokémon na sua coleção!
        </p>

        @if ($errors->any())
            <div class="alert alert-error">
                <strong>❌ Erro ao cadastrar!</strong>
                <ul style="margin-top: 10px; margin-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('pokemon.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="form-group">
                <label for="name">🎯 Nome do Pokémon *</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    placeholder="Ex: Pikachu" 
                    value="{{ old('name') }}"
                    required
                >
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="type">⚡ Tipo *</label>
                    <input 
                        type="text" 
                        id="type" 
                        name="type" 
                        placeholder="Ex: Elétrico" 
                        value="{{ old('type') }}"
                        required
                    >
                    @error('type')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pokedex_number">🔢 Número Pokédex</label>
                    <input 
                        type="number" 
                        id="pokedex_number" 
                        name="pokedex_number" 
                        placeholder="Ex: 25"
                        value="{{ old('pokedex_number') }}"
                    >
                    @error('pokedex_number')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="abilities">🔥 Habilidades *</label>
                <input 
                    type="text" 
                    id="abilities" 
                    name="abilities" 
                    placeholder="Ex: Estática, Paciência" 
                    value="{{ old('abilities') }}"
                    required
                >
                @error('abilities')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">📝 Descrição</label>
                <textarea 
                    id="description" 
                    name="description" 
                    placeholder="Descreva o Pokémon..."
                    style="resize: none; height: 120px;"
                >{{ old('description') }}</textarea>
                @error('description')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">🖼️ Imagem</label>
                <input 
                    type="file" 
                    id="image" 
                    name="image" 
                    accept="image/*"
                >
                <p style="font-size: 0.9em; color: #666; margin-top: 8px;">
                    Formatos aceitos: JPEG, PNG, JPG, GIF (máx: 2MB)
                </p>
                @error('image')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn btn-success" style="flex: 1;">
                    ✅ Criar Pokémon
                </button>
                <button type="reset" class="btn btn-secondary" style="flex: 1;">
                    ↻ Limpar
                </button>
                <a href="{{ route('pokemon.list') }}" class="btn btn-secondary" style="flex: 1; text-align: center;">
                    ⬅️ Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection