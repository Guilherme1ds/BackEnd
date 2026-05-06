@extends('layouts.app')

@section('title', 'Editar Pokémon')

@section('content')
    <div class="container" style="max-width: 600px;">
        <h1>✏️ Editar Pokémon</h1>
        <p style="text-align: center; color: #666; margin-bottom: 30px;">
            Atualize os dados de: <strong>{{ $pokemon->name }}</strong>
        </p>

        @if ($errors->any())
            <div class="alert alert-error">
                <strong>❌ Erro ao atualizar!</strong>
                <ul style="margin-top: 10px; margin-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pokemon.update', $pokemon) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">🎯 Nome do Pokémon *</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $pokemon->name) }}"
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
                        value="{{ old('type', $pokemon->type) }}"
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
                        value="{{ old('pokedex_number', $pokemon->pokedex_number) }}"
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
                    value="{{ old('abilities', $pokemon->abilities) }}"
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
                    style="resize: none; height: 120px;"
                >{{ old('description', $pokemon->description) }}</textarea>
                @error('description')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">🖼️ Imagem</label>
                
                @if ($pokemon->image)
                    <div style="margin-bottom: 15px; padding: 15px; background: #f5f5f5; border-radius: 8px;">
                        <p style="font-size: 0.9em; color: #666; margin-bottom: 10px;"><strong>Imagem Atual:</strong></p>
                        <img src="{{ asset('storage/' . $pokemon->image) }}" 
                             alt="{{ $pokemon->name }}" 
                             style="max-width: 200px; max-height: 200px; border-radius: 8px;">
                    </div>
                @endif

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
                    ✅ Atualizar Pokémon
                </button>
                <a href="{{ route('pokemon.list') }}" class="btn btn-secondary" style="flex: 1; text-align: center;">
                    ⬅️ Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection