# 📋 Confecção TB - Documentação do Projeto

## 🎯 Visão Geral

**Confecção TB** é um sistema ERP (Enterprise Resource Planning) desenvolvido com **Laravel 13.1.1** e **Filament Admin Panel**, especializado em gestão de pedidos, estoque e produção para empresas de confecção.

O sistema oferece uma interface moderna e intuitiva para gerenciar clientes, pedidos, produtos, insumos, fornecedores e controle de estoque com automações de email e auditoria.

---

## 📦 Stack Tecnológico

### Backend
- **Framework**: Laravel 13.1.1
- **Linguagem**: PHP 8.5.2
- **Banco de Dados**: MySQL 8.0
- **Admin Panel**: Filament CMS
- **Queue System**: Database (Laravel Queue)

### Frontend
- **CSS Framework**: Tailwind CSS v4.0
- **Templating**: Blade Templates
- **JavaScript**: Alpine.js v3
- **Build Tool**: Vite

### Ferramentas de Desenvolvimento
- **Package Manager**: Composer (PHP)
- **Local Development**: Laragon
- **Email Testing**: Mailpit (SMTP)
- **Testing**: PHPUnit

---

## 📁 Estrutura do Projeto

```
confeccaoTB2/
├── app/
│   ├── Filament/
│   │   ├── Resources/          # Recursos CRUD (Pedidos, Clientes, Produtos, etc)
│   │   ├── Widgets/            # Gráficos e Cards do Dashboard
│   │   └── Pages/              # Páginas customizadas
│   ├── Http/
│   │   └── Controllers/        # Controllers (quando não usa Filament)
│   ├── Models/                 # Modelos Eloquent (8 modelos principais)
│   ├── Mail/                   # Classes de email
│   ├── Observers/              # Event listeners para modelos
│   ├── Services/               # Serviços de lógica de negócio
│   ├── Console/                # Comandos artisan customizados
│   └── Providers/
│       ├── AppServiceProvider.php
│       └── Filament/
│           └── AdminPanelProvider.php  # Configuração principal do Filament
├── database/
│   ├── migrations/             # Schemas das tabelas
│   ├── factories/              # Factories para testes
│   └── seeders/                # Dados iniciais
├── resources/
│   ├── css/                    # Stylesheets (Tailwind, animações)
│   ├── js/                     # Scripts frontend
│   └── views/                  # Templates Blade
│       └── emails/             # Templates de email
├── routes/
│   ├── web.php                 # Rotas web
│   └── console.php             # Comandos console
├── config/                     # Arquivos de configuração
├── public/                     # Assets públicos
│   ├── images/                 # Imagens/logos
│   ├── css/                    # CSS compilado
│   ├── js/                     # JS compilado
│   └── fonts/                  # Fonts
├── storage/                    # Logs, cache, uploads
├── tests/                      # Testes unitários e de feature
└── vendor/                     # Dependências Composer
```

---

## 🗄️ Modelos de Dados

### Principais Entidades

#### 1. **Cliente**
Armazena informações dos clientes que fazem pedidos.
- `id`, `nome`, `email`, `telefone`, `endereco`, `cidade`, `estado`, `cep`

#### 2. **Pedido**
Registro de pedidos de confecção.
- `id`, `cliente_id`, `valor_total`, `status`, `created_at`, `updated_at`
- **Status**: pendente, processando, pronto, entregue, cancelado

#### 3. **ItemPedido**
Itens individuais dentro de um pedido.
- `id`, `pedido_id`, `produto_id`, `quantidade`, `preco_unitario`

#### 4. **Produto**
Produtos oferecidos pela confecção.
- `id`, `nome`, `descricao`, `preco_base`, `tempo_producao`

#### 5. **Insumo**
Matérias-primas necessárias para produção.
- `id`, `nome`, `descricao`, `unidade`, `preco_unitario`

#### 6. **Fornecedor**
Fornecedores de insumos.
- `id`, `nome`, `email`, `telefone`, `endereco`, `especialidade`

#### 7. **Estoque**
Controle de inventário.
- `id`, `produto_id`, `insumo_id`, `quantidade`, `quantidade_minima`, `localizacao`

#### 8. **User**
Usuários do sistema com roles e permissões.
- `id`, `name`, `email`, `password`, `role`

---

## 🔐 Autenticação e Autorização

- **Autenticação**: Laravel Auth com Filament integration
- **Autorização**: Spatie Permission (roles e permissões)
- **Middleware**: Filament auth middleware para proteção do admin panel

---

## 🎨 Interface de Administração (Filament)

### Configuração Principal
**Arquivo**: `app/Providers/Filament/AdminPanelProvider.php`

#### Temas e Cores
- **Tema Padrão**: Dark Mode
- **Cor Primária**: Azul (#0066cc)
- **Cores Complementares**:
  - Sucesso: Verde
  - Perigo: Vermelho
  - Info: Cyan
  - Aviso: Âmbar

#### Recursos (CRUD)
1. **Pedidos** - Criar, listar, editar, visualizar e deletar pedidos
2. **Clientes** - Gerenciar base de clientes
3. **Produtos** - Catálogo de produtos
4. **Insumos** - Matérias-primas
5. **Fornecedores** - Gerenciamento de suppliers
6. **Estoques** - Controle de inventário
7. **Usuários** - Gerenciamento de acesso
8. **Permissões** - Roles e permissões

---

## 📊 Dashboard e Gráficos

### Widgets Disponíveis

#### 1. **Stats Overview** (Cards de KPI)
- Total de Pedidos
- Pedidos Criados Hoje
- Venda Total (R$)
- Ticket Médio

#### 2. **Gráfico de Vendas Mensais**
- Tipo: Gráfico de linha
- Período: Últimos 6 meses
- Dados: Faturamento mensal em R$

#### 3. **Status dos Pedidos**
- Tipo: Gráfico de rosca (doughnut)
- Dados: Distribuição de pedidos por status
- Cores: Diferentes cores para cada status

#### 4. **Top 10 Produtos Mais Vendidos**
- Tipo: Gráfico de barras horizontal
- Dados: Produtos com maior quantidade de vendas

#### 5. **Top 10 Clientes**
- Tipo: Gráfico de barras horizontal
- Dados: Clientes com maior valor total de compras

---

## 📧 Sistema de Email

### Configuração

**Arquivo**: `.env`
```env
MAIL_MAILER=smtp
MAIL_HOST=localhost
MAIL_PORT=1025
MAIL_FROM_ADDRESS=noreply@confeccao.local
MAIL_FROM_NAME="Confecção TB"
```

### Emails Implementados

#### **PedidoCriadoMail**
- **Trigger**: Quando um novo pedido é criado
- **Destinatário**: Email do cliente
- **Template**: `resources/views/emails/pedido-criado.blade.php`
- **Conteúdo**:
  - Número do pedido
  - Data e hora
  - Lista de itens
  - Valor total
  - Status atual
  - Link para acompanhamento

### Ferramentas

**Mailpit** (Email Testing)
- **URL**: http://localhost:8025
- **SMTP**: localhost:1025
- **Função**: Capturar e visualizar emails em desenvolvimento

---

## 🚀 Instalação e Setup

### Pré-requisitos
- PHP 8.5.2 ou superior
- MySQL 8.0
- Composer
- Node.js & npm
- Laragon (recomendado para Windows)

### Passo 1: Clonar Repositório
```bash
git clone <seu-repo-url>
cd confeccaoTB2
```

### Passo 2: Instalar Dependências
```bash
composer install
npm install
```

### Passo 3: Configurar Environment
```bash
cp .env.example .env
php artisan key:generate
```

### Passo 4: Configurar Banco de Dados
Editar `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=confeccaotb2
DB_USERNAME=root
DB_PASSWORD=senaisp
```

### Passo 5: Executar Migrações
```bash
php artisan migrate --seed
```

### Passo 6: Build Assets
```bash
npm run build
```

### Passo 7: Iniciar Servidor
```bash
php artisan serve
```

**Acessar**: http://localhost:8000/admin

---

## 🔄 Fluxos Principais

### Criar Novo Pedido
1. Usuário acessa **Filament Admin > Pedidos > Criar**
2. Seleciona **cliente** existente
3. Adiciona **itens** (produto + quantidade + preço)
4. Sistema calcula automaticamente **valor total**
5. **Email de confirmação** é enviado ao cliente
6. **Log de auditoria** é registrado

### Editar Pedido
1. Usuário acessa **Filament > Pedidos > Editar**
2. Modifica dados conforme necessário
3. Sistema **recalcula o valor total**
4. **Email de atualização** é enviado
5. **Auditoria** registra a modificação

### Acompanhamento de Estoque
1. Sistema monitora **quantidade em estoque**
2. Alerta quando **quantidade mínima** é atingida
3. Facilita **reposição junto aos fornecedores**

---

## 🛠️ Funcionalidades Implementadas

### ✅ Completadas

- [x] Autenticação e autorização de usuários
- [x] CRUD completo de pedidos (Create, Read, Update, Delete)
- [x] Gerenciamento de clientes
- [x] Catálogo de produtos
- [x] Controle de estoque
- [x] Gestão de fornecedores e insumos
- [x] Sistema de emails automatizado
- [x] Dashboard com gráficos e estatísticas
- [x] Interface moderna com Filament
- [x] Dark mode padrão
- [x] Auditoria de operações
- [x] Cálculo automático de totais de pedidos
- [x] Validações de dados

### 🔄 Em Desenvolvimento

- [ ] Relatórios avançados (PDF)
- [ ] Integração com sistemas de pagamento
- [ ] Agendamento automático de produção
- [ ] Notificações em tempo real (WebSocket)
- [ ] Mobile app

---

## 📋 Checklist de Deploy

- [ ] Configurar variáveis de ambiente (`.env`)
- [ ] Executar `composer install --no-dev`
- [ ] Executar `npm run build` (não `npm run dev`)
- [ ] Executar `php artisan migrate --force`
- [ ] Configurar CORS se necessário
- [ ] Configurar HTTPS/SSL
- [ ] Backup de banco de dados
- [ ] Testar envio de emails em produção
- [ ] Configurar logs
- [ ] Monitorar performance

---

## 🐛 Troubleshooting

### Email não envia
**Solução**:
1. Verificar configuração em `.env`
2. Garantir que Mailpit está rodando em produção
3. Verificar logs: `storage/logs/`

### Gráficos não aparecem
**Solução**:
1. Rodar: `php artisan config:cache`
2. Verificar se há dados no banco (criar alguns pedidos)
3. Limpar cache: `php artisan cache:clear`

### Erro de permissão
**Solução**:
1. Verificar role do usuário no banco
2. Garantir que user_roles está populada
3. Executar: `php artisan permissions:cache-reset`

---

## 📞 Contato e Suporte

- **Desenvolvedor**: [Seu Nome]
- **Email**: [seu.email@confeccao.local]
- **Período**: Junho 2026

---

## 📄 Licença

Proprietário - Confecção TB 2026

---

## 📚 Referências

- [Documentação Laravel](https://laravel.com/docs)
- [Documentação Filament](https://filamentphp.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Spatie Permission](https://spatie.be/docs/laravel-permission)

---

**Última atualização**: Junho 2, 2026
