<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex - {{ $pokemon['name'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #87CEEB 0%, #E0F6FF 100%);
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .pokedex-wrapper {
            perspective: 1000px;
        }

        .pokedex-container {
            width: 100%;
            max-width: 500px;
            background: linear-gradient(135deg, #EE1515 0%, #CC0000 50%, #AA0000 100%);
            border-radius: 40px;
            padding: 25px;
            box-shadow: 
                0 30px 60px rgba(0, 0, 0, 0.4),
                inset -5px -5px 15px rgba(0, 0, 0, 0.2),
                inset 5px 5px 15px rgba(255, 255, 255, 0.1);
            position: relative;
            transform: rotateX(2deg) rotateY(-2deg);
        }

        /* Luzes RGB no topo */
        .led-lights {
            display: flex;
            justify-content: flex-start;
            gap: 25px;
            margin-bottom: 25px;
            padding-left: 15px;
        }

        .led {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3), inset 0 -2px 5px rgba(0, 0, 0, 0.3);
            border: 3px solid rgba(0, 0, 0, 0.2);
        }

        .led-blue {
            background: radial-gradient(circle at 35% 35%, #00D9FF, #0088CC);
            box-shadow: 0 0 30px #0088CC, inset 0 -2px 5px rgba(0, 0, 0, 0.3);
        }

        .led-yellow {
            background: radial-gradient(circle at 35% 35%, #FFFF00, #CCCC00);
            box-shadow: 0 0 30px #CCCC00, inset 0 -2px 5px rgba(0, 0, 0, 0.3);
        }

        .led-green {
            background: radial-gradient(circle at 35% 35%, #00FF00, #00BB00);
            box-shadow: 0 0 30px #00BB00, inset 0 -2px 5px rgba(0, 0, 0, 0.3);
        }

        /* Tela */
        .screen-section {
            background: linear-gradient(145deg, #E8E8E8, #F5F5F5);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 
                inset 0 2px 5px rgba(0, 0, 0, 0.1),
                inset 0 -2px 5px rgba(255, 255, 255, 0.8),
                0 8px 15px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
        }

        .screen-display {
            background: linear-gradient(135deg, #90EE90, #98FB98);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 15px;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            min-height: 280px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .screen-display::before {
            content: '';
            position: absolute;
            top: 8px;
            left: 8px;
            width: 8px;
            height: 8px;
            background: #CC0000;
            border-radius: 50%;
            box-shadow: 30px 0 0 #CC0000;
        }

        .pokemon-image-display {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .pokemon-image-display img {
            max-width: 180px;
            height: auto;
            filter: drop-shadow(0 3px 5px rgba(0, 0, 0, 0.2));
        }

        .pokemon-float {
            animation: float-slow 3s ease-in-out infinite;
        }

        @keyframes float-slow {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        .pokemon-info-display {
            text-align: center;
            color: #333;
            font-weight: bold;
        }

        .pokemon-id-display {
            font-size: 16px;
            color: #666;
            margin-bottom: 5px;
        }

        .pokemon-name-display {
            font-size: 24px;
            font-family: 'Arial Black', sans-serif;
            color: #000;
        }

        /* Input ID */
        .id-input-section {
            background: linear-gradient(145deg, #FFFFFF, #F0F0F0);
            border-radius: 12px;
            padding: 12px 15px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .id-input-section input {
            flex: 1;
            background: #FFFFFF;
            border: 2px solid #CCCCCC;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 14px;
            font-weight: bold;
            color: #333;
            text-align: center;
        }

        .id-input-section input:focus {
            outline: none;
            border-color: #EE1515;
            box-shadow: 0 0 8px rgba(238, 21, 21, 0.3);
        }

        .id-clear-btn {
            background: #EE1515;
            border: none;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .id-clear-btn:hover {
            background: #CC0000;
            transform: scale(1.1);
        }

        /* Botões */
        .buttons-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .btn-pokemon {
            background: linear-gradient(145deg, #333333, #1a1a1a);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 15px 20px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            box-shadow: 
                0 6px 12px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-pokemon:hover {
            background: linear-gradient(145deg, #444444, #222222);
            transform: translateY(-2px);
            box-shadow: 
                0 8px 16px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        .btn-pokemon:active {
            transform: translateY(0px);
            box-shadow: 
                0 4px 8px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        .type-badges {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }

        .type-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .type-normal { background-color: #A8A878; border-color: #6d6d4d; color: white; }
        .type-fire { background-color: #F08030; border-color: #9c531f; color: white; }
        .type-water { background-color: #6890F0; border-color: #445e9c; color: white; }
        .type-grass { background-color: #78C850; border-color: #4a7c59; color: white; }
        .type-electric { background-color: #F8D030; border-color: #caa600; color: #333; }
        .type-ice { background-color: #98D8D8; border-color: #638d8d; color: #333; }
        .type-fighting { background-color: #C03028; border-color: #7d1f1a; color: white; }
        .type-poison { background-color: #A040A0; border-color: #682a68; color: white; }
        .type-ground { background-color: #E0C068; border-color: #927d44; color: #333; }
        .type-flying { background-color: #A890F0; border-color: #6d5b7f; color: white; }
        .type-psychic { background-color: #F85888; border-color: #a13959; color: white; }
        .type-bug { background-color: #A8B820; border-color: #6d7815; color: white; }
        .type-rock { background-color: #B8A038; border-color: #786824; color: white; }
        .type-ghost { background-color: #705898; border-color: #493a59; color: white; }
        .type-dragon { background-color: #7038F8; border-color: #493a94; color: white; }
        .type-dark { background-color: #705848; border-color: #49392f; color: white; }
        .type-steel { background-color: #B8B8D0; border-color: #787887; color: #333; }
        .type-fairy { background-color: #EE99AC; border-color: #9b6470; color: white; }

        .info-section {
            background: linear-gradient(145deg, #FFFFFF, #F0F0F0);
            border-radius: 12px;
            padding: 15px;
            margin-top: 15px;
            font-size: 12px;
            color: #333;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            border-bottom: 1px dotted #CCCCCC;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: bold;
            color: #000;
        }

        /* Seções adicionais */
        .details-tabs {
            display: flex;
            gap: 8px;
            margin-top: 15px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .tab-btn {
            padding: 6px 12px;
            background: #CCCCCC;
            border: 2px solid #999;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 11px;
            transition: all 0.2s;
        }

        .tab-btn.active {
            background: #EE1515;
            color: white;
            border-color: #AA0000;
        }

        .tab-btn:hover:not(.active) {
            background: #DDDDDD;
        }

        .tab-content {
            display: none;
            margin-top: 12px;
            height: 150px;
            overflow-y: auto;
        }

        .tab-content.active {
            display: block;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .stat-box {
            background: #F0F0F0;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #DDD;
            font-size: 11px;
        }

        .stat-name {
            font-weight: bold;
            color: #333;
            margin-bottom: 4px;
        }

        .stat-bar-container {
            width: 100%;
            height: 12px;
            background: #DDD;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #999;
        }

        .stat-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #FF6B6B, #FFD93D);
            transition: width 0.3s;
        }

        .stat-value {
            font-size: 10px;
            color: #666;
            margin-top: 2px;
        }

        .abilities-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .ability-item {
            background: #F0F0F0;
            padding: 8px 12px;
            border-radius: 8px;
            border-left: 4px solid #EE1515;
            font-size: 11px;
            color: #333;
        }

        .ability-name {
            font-weight: bold;
            color: #000;
            text-transform: capitalize;
        }

        .ability-hidden {
            color: #EE1515;
            font-size: 9px;
            margin-top: 2px;
        }

        .moves-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .move-item {
            background: #F0F0F0;
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #DDD;
            font-size: 10px;
            text-align: center;
            text-transform: capitalize;
            color: #333;
            font-weight: bold;
        }

        .moves-note {
            font-size: 10px;
            color: #666;
            padding: 8px;
            background: #F9F9F9;
            border-radius: 6px;
            margin-top: 8px;
            border-left: 3px solid #EE1515;
        }

    </style>
</head>
<body>
    <div class="pokedex-wrapper">
        <div class="pokedex-container">
            <!-- LEDs -->
            <div class="led-lights">
                <div class="led led-blue"></div>
                <div class="led led-yellow"></div>
                <div class="led led-green"></div>
            </div>

            <!-- Tela de Exibição -->
            <div class="screen-section">
                <div class="screen-display">
                    <div class="pokemon-image-display">
                        <img src="{{ $pokemon['sprites']['other']['official-artwork']['front_default'] ?? $pokemon['sprites']['front_default'] }}" 
                             alt="{{ $pokemon['name'] }}" class="pokemon-float">
                    </div>
                    <div class="pokemon-info-display">
                        <div class="pokemon-id-display">#{{ str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT) }}</div>
                        <div class="pokemon-name-display">{{ strtoupper($pokemon['name']) }}</div>
                    </div>
                </div>

                <!-- Tipos -->
                <div class="type-badges">
                    @foreach($pokemon['types'] as $tipo)
                        @php
                            $typeName = strtolower($tipo['type']['name']);
                            $typeClass = 'type-' . $typeName;
                            
                            $tiposTraducao = [
                                'normal' => 'Normal',
                                'fire' => 'Fogo',
                                'water' => 'Água',
                                'grass' => 'Grama',
                                'electric' => 'Elétrico',
                                'ice' => 'Gelo',
                                'fighting' => 'Luta',
                                'poison' => 'Veneno',
                                'ground' => 'Terra',
                                'flying' => 'Voador',
                                'psychic' => 'Psíquico',
                                'bug' => 'Inseto',
                                'rock' => 'Pedra',
                                'ghost' => 'Fantasma',
                                'dragon' => 'Dragão',
                                'dark' => 'Sombrio',
                                'steel' => 'Aço',
                                'fairy' => 'Fada'
                            ];
                            
                            $tipoExibicao = $tiposTraducao[$typeName] ?? ucfirst($typeName);
                        @endphp
                        <span class="type-badge {{ $typeClass }}">{{ $tipoExibicao }}</span>
                    @endforeach
                </div>

                <!-- Informações -->
                <div class="info-section">
                    <div class="info-row">
                        <span class="info-label">Altura:</span>
                        <span>{{ $pokemon['height'] / 10 }} m</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Peso:</span>
                        <span>{{ $pokemon['weight'] / 10 }} kg</span>
                    </div>

                    <!-- Abas de Detalhes -->
                    <div class="details-tabs">
                        <button class="tab-btn active" onclick="switchTab('habilidades', this)">Habilidades</button>
                        <button class="tab-btn" onclick="switchTab('movimentos', this)">Movimentos</button>
                    </div>

                    <!-- Tab: Habilidades -->
                    <div id="habilidades" class="tab-content active">
                        @if(isset($pokemon['abilities']) && count($pokemon['abilities']) > 0)
                            <div class="abilities-list">
                                @foreach($pokemon['abilities'] as $ability)
                                    <div class="ability-item">
                                        <div class="ability-name">{{ $ability['ability']['name'] }}</div>
                                        @if($ability['is_hidden'])
                                            <div class="ability-hidden">🔒 Habilidade Oculta</div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div style="padding: 10px; text-align: center; color: #999; font-size: 12px;">
                                Informações não disponíveis
                            </div>
                        @endif
                    </div>

                    <!-- Tab: Movimentos -->
                    <div id="movimentos" class="tab-content">
                        @if(isset($pokemon['moves']) && count($pokemon['moves']) > 0)
                            <div class="moves-list">
                                @foreach($pokemon['moves'] as $move)
                                    @if($loop->index < 4)
                                        <div class="move-item">{{ $move['move']['name'] }}</div>
                                    @endif
                                @endforeach
                            </div>
                            @if(count($pokemon['moves']) > 4)
                                <div class="moves-note">
                                    + {{ count($pokemon['moves']) - 4 }} movimentos adicionais disponíveis
                                </div>
                            @endif
                        @else
                            <div style="padding: 10px; text-align: center; color: #999; font-size: 12px;">
                                Informações não disponíveis
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Botões -->
            <div class="buttons-section">
                <button class="btn-pokemon" onclick="previousPokemon()">
                    ◀ Anterior
                </button>
                <button class="btn-pokemon" onclick="nextPokemon()">
                    Próximo ▶
                </button>
            </div>
        </div>
    </div>

    <script>
        function nextPokemon() {
            window.location.reload();
        }

        function previousPokemon() {
            window.location.reload();
        }

        function switchTab(tabName, button) {
            // Esconde todos os tabs
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => tab.classList.remove('active'));

            // Remove active de todos os botões
            const buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(btn => btn.classList.remove('active'));

            // Mostra o tab selecionado
            document.getElementById(tabName).classList.add('active');
            button.classList.add('active');
        }
    </script>
</body>
</html>