@php
    $traducoes = [
        'Chief Executive Officer' => 'Diretor(a) Executivo(a) (CEO)',
        'Chief Technology Officer' => 'Diretor(a) de Tecnologia (CTO)',
        'Chief Marketing Officer' => 'Diretor(a) de Marketing (CMO)',
        'Business Development Manager' => 'Gerente de Desenv. de Negócios',
        'Product Management' => 'Gestão de Produto',
        'Product Manager' => 'Gerente de Produto',
        'Project Manager' => 'Gerente de Projetos',
        'Marketing Manager' => 'Gerente de Marketing',
        'Account Executive' => 'Executivo(a) de Contas',
        'Human Resources' => 'Recursos Humanos',
        'Software Engineer' => 'Engenheiro(a) de Software',
        'Data Scientist' => 'Cientista de Dados',
        'Full Stack Developer' => 'Desenvolvedor(a) Full Stack',
        'Frontend Developer' => 'Desenvolvedor(a) Frontend',
        'Backend Developer' => 'Desenvolvedor(a) Backend',
        'Web Developer' => 'Desenvolvedor(a) Web',
        'Systems Administrator' => 'Administrador(a) de Sistemas',
        'Database Administrator' => 'Administrador(a) de Banco de Dados',
        'Graphic Designer' => 'Designer Gráfico',
        'Engineering' => 'Engenharia',
        'Marketing' => 'Marketing',
        'Services' => 'Serviços',
        'Sales' => 'Vendas',
        'Support' => 'Suporte',
        'Accounting' => 'Contabilidade',
        'Legal' => 'Jurídico',
        'Finance' => 'Finanças',
        'Operations' => 'Operações',
        'IT' => 'Tecnologia (TI)',
        'Manager' => 'Gerente',
        'Developer' => 'Desenvolvedor(a)',
        'Associate' => 'Associado(a)',
        'Coordinator' => 'Coordenador(a)',
        'Consultant' => 'Consultor(a)',
        'Representative' => 'Representante',
        'Analyst' => 'Analista',
        'Director' => 'Diretor(a)',
        'Executive' => 'Executivo(a)',
        'Specialist' => 'Especialista',
        'Administrator' => 'Administrador(a)',
        'Architect' => 'Arquiteto(a)',
        'Technician' => 'Técnico(a)',
        'Supervisor' => 'Supervisor(a)',
        'Lead' => 'Líder',
        'Senior' => 'Sênior',
        'Junior' => 'Júnior',
        'Assistant' => 'Assistente',
        'Engineer' => 'Engenheiro(a)',
        'Officer' => 'Oficial',
        'MAC Address' => 'Endereço MAC'
    ];

    $cargoOriginal = $user['company']['title'] ?? 'Colaborador';
    $deptoOriginal = $user['company']['department'] ?? 'Geral';

    $cargo = str_ireplace(array_keys($traducoes), array_values($traducoes), $cargoOriginal);
    $depto = str_ireplace(array_keys($traducoes), array_values($traducoes), $deptoOriginal);
@endphp

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal do Colaborador - {{ $user['firstName'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Libre+Barcode+128&display=swap');
        
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        
        body {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            min-height: 100vh; padding: 20px;
        }

        /* --- Barra de Pesquisa --- */
        .search-container {
            width: 100%;
            max-width: 420px;
            margin-bottom: 25px;
        }

        .search-form {
            display: flex;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            overflow: hidden;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .search-form input {
            flex: 1;
            padding: 14px 16px;
            background: transparent;
            border: none;
            color: #ffffff;
            font-size: 14px;
            outline: none;
        }

        .search-form input::placeholder { color: rgba(255, 255, 255, 0.5); }

        .search-form button {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 0 20px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .search-form button:hover { background: #2563eb; }

        .error-message {
            margin-top: 10px;
            color: #fca5a5;
            font-size: 13px;
            text-align: center;
            font-weight: 600;
            background: rgba(220, 38, 38, 0.2);
            padding: 8px;
            border-radius: 8px;
            border: 1px solid rgba(220, 38, 38, 0.3);
        }

        /* --- O Crachá --- */
        .badge-wrapper { perspective: 1000px; width: 100%; max-width: 420px; }

        .corporate-badge {
            width: 100%; background: #ffffff; border-radius: 20px; padding: 25px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4); position: relative;
        }

        .badge-header {
            text-align: center; margin-bottom: 20px; border-bottom: 2px solid #f1f5f9; padding-bottom: 15px;
        }

        .lanyard-hole {
            width: 60px; height: 10px; background: #e2e8f0; border-radius: 10px;
            margin: 0 auto 15px auto; box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
        }

        .company-logo {
            font-size: 16px; font-weight: 800; color: #0f172a; text-transform: uppercase; letter-spacing: 2px;
        }

        .profile-section { display: flex; flex-direction: column; align-items: center; margin-bottom: 20px; }

        .avatar {
            width: 110px; height: 110px; border-radius: 50%; border: 4px solid #3b82f6;
            padding: 3px; background: #fff; margin-bottom: 15px;
        }

        .avatar img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; }

        .emp-name { font-size: 20px; font-weight: 700; color: #0f172a; text-align: center; }

        .emp-role { font-size: 13px; font-weight: 600; color: #3b82f6; text-transform: uppercase; text-align: center; }

        .tabs-nav {
            display: flex; gap: 5px; margin-bottom: 15px; background: #f1f5f9; padding: 5px; border-radius: 10px;
        }

        .tab-btn {
            flex: 1; padding: 8px; font-size: 12px; font-weight: 600;
            color: #64748b; border-radius: 6px; cursor: pointer; transition: 0.2s;
        }

        .tab-btn.active { background: #fff; color: #0f172a; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }

        .tab-content { display: none; min-height: 110px; }
        .tab-content.active { display: block; animation: fadeIn 0.3s ease; }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

        .info-row {
            display: flex; justify-content: space-between; padding: 8px 0;
            border-bottom: 1px solid #f1f5f9; align-items: center;
        }

        .info-row:last-child { border-bottom: none; }
        .info-label { font-size: 11px; font-weight: 600; color: #64748b; text-transform: uppercase; }
        .info-value { font-size: 13px; font-weight: 500; color: #0f172a; text-align: right; }

        .barcode-section { text-align: center; margin-top: 20px; padding-top: 15px; border-top: 2px dashed #e2e8f0; }
        .barcode-font { font-family: 'Libre Barcode 128', cursive; font-size: 45px; color: #0f172a; }
        .employee-id { font-size: 12px; font-weight: 700; color: #64748b; }

        .desk-controls { display: flex; justify-content: space-between; margin-top: 20px; gap: 15px; }
        .btn-control {
            flex: 1; background: rgba(255, 255, 255, 0.1); color: white; border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 12px; border-radius: 10px; font-weight: 600; cursor: pointer; transition: 0.3s;
        }
        .btn-control:hover { background: rgba(255, 255, 255, 0.2); }
    </style>
</head>
<body>

    <div class="search-container">
        <form action="{{ url()->current() }}" method="GET" class="search-form">
            <input type="text" name="q" placeholder="Buscar colaborador pelo nome..." value="{{ request('q') }}" required>
            <button type="submit">Buscar</button>
        </form>
        
        @if(isset($error) && $error)
            <div class="error-message">
                {{ $error }}
            </div>
        @endif
    </div>

    <div class="badge-wrapper">
        <div class="corporate-badge">
            
            <div class="badge-header">
                <div class="lanyard-hole"></div>
                <div class="company-logo">CORPORATE INC.</div>
            </div>

            <div class="profile-section">
                <div class="avatar">
                    <img src="{{ $user['image'] }}" alt="Avatar">
                </div>
                <div class="emp-name">{{ $user['firstName'] }} {{ $user['lastName'] }}</div>
                <div class="emp-role">{{ $cargo }}</div>
            </div>

            <div class="tabs-nav">
                <button class="tab-btn active" onclick="switchTab('contato', this)">Contato</button>
                <button class="tab-btn" onclick="switchTab('pessoal', this)">Pessoal</button>
                <button class="tab-btn" onclick="switchTab('sistema', this)">Sistema</button>
            </div>

            <div id="contato" class="tab-content active">
                <div class="info-row">
                    <span class="info-label">Departamento</span>
                    <span class="info-value">{{ $depto }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">E-mail</span>
                    <span class="info-value" style="font-size: 11px;">{{ $user['email'] }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Telefone</span>
                    <span class="info-value">{{ $user['phone'] }}</span>
                </div>
            </div>

            <div id="pessoal" class="tab-content">
                <div class="info-row">
                    <span class="info-label">Idade / Gênero</span>
                    <span class="info-value">
                        {{ $user['age'] }} anos / {{ $user['gender'] == 'male' ? 'Masculino' : 'Feminino' }}
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Sanguíneo</span>
                    <span class="info-value">{{ $user['bloodGroup'] }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Cidade</span>
                    <span class="info-value">{{ $user['address']['city'] }}</span>
                </div>
            </div>

            <div id="sistema" class="tab-content">
                <div class="info-row">
                    <span class="info-label">Usuário</span>
                    <span class="info-value">{{ $user['username'] ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Endereço IP</span>
                    <span class="info-value">{{ $user['ip'] ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Endereço MAC</span>
                    <span class="info-value">{{ $user['macAddress'] ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="barcode-section">
                <div class="barcode-font">123456789</div>
                <div class="employee-id">EMP-{{ str_pad($user['id'], 5, '0', STR_PAD_LEFT) }}</div>
            </div>

        </div>

        <div class="desk-controls">
            <button class="btn-control" onclick="window.location.href='{{ url()->current() }}'">◀ Anterior</button>
            <button class="btn-control" onclick="window.location.href='{{ url()->current() }}'">Próximo ▶</button>
        </div>
    </div>

    <script>
        function switchTab(tabName, button) {
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.getElementById(tabName).classList.add('active');
            button.classList.add('active');
        }
    </script>
</body>
</html>