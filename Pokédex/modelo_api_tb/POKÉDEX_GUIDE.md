# Pokédex - Guia de Navegação

## 🎮 Bem-vindo à Pokédex Digital!

Este projeto é uma aplicação Laravel para gerenciar e explorar Pokémons. Agora com uma navegação melhorada e uma interface unificada.

---

## 📍 Páginas Disponíveis

### 1. **Home** (`/`)
- Página inicial com boas-vindas
- Links rápidos para todas as funcionalidades
- Informações sobre como usar a aplicação

### 2. **Pokedex** (`/pokedex`)
- 🎲 Descobre Pokémons aleatórios da PokeAPI
- Clique em "Próximo Pokémon Aleatório" para explorar
- Veja informações completas: tipos, habilidades, altura, peso
- Dados em tempo real da [PokeAPI](https://pokeapi.co/)

### 3. **Meus Pokémons** (`/pokemons`)
- 📚 Lista todos os Pokémons que você criou
- Veja detalhes, imagens, tipos e habilidades
- ✏️ Edite qualquer Pokémon
- 🗑️ Delete Pokémons da sua coleção
- Estatísticas: total de Pokémons cadastrados

### 4. **Criar Pokémon** (`/criar`)
- ➕ Formulário para criar novos Pokémons
- Campos obrigatórios: Nome, Tipo e Habilidades
- Campos opcionais: Descrição, Número Pokédex, Imagem
- Upload de imagem (JPEG, PNG, JPG, GIF - máx 2MB)

### 5. **Procurar Pokémon** (`/procurar`)
- 🔍 Busca em dois lugares:
  - **Banco Local**: Pokémons que você criou
  - **PokeAPI**: Banco de dados oficial de Pokémons
- Busque por nome ou tipo
- Resultados combinados de ambas as fontes

---

## 🧭 Navegação

Todas as páginas possuem um **header sticky** com links para:
- 🏠 Home - Página inicial
- 🎲 Pokedex - Pokémon aleatório
- 📚 Meus Pokémons - Lista criada
- ➕ Criar - Novo Pokémon
- 🔍 Procurar - Busca de Pokémons

---

## 🎯 Características Principais

✅ **Responsivo** - Funciona em desktop, tablet e mobile
✅ **Design Moderno** - Interface colorida e intuitiva
✅ **Integração com PokeAPI** - Dados reais de Pokémons
✅ **Banco de Dados Local** - Crie seus próprios Pokémons
✅ **Upload de Imagens** - Adicione fotos aos Pokémons
✅ **Validações** - Formulários com validações completas
✅ **Mensagens Flash** - Feedback de sucesso e erro

---

## 🔗 Rotas

```
GET    /                      → Home
GET    /pokedex              → Pokémon aleatório
GET    /pokemons             → Lista de Pokémons criados
GET    /criar                → Formulário de criação
POST   /pokemon              → Salvar novo Pokémon
GET    /procurar             → Página de busca
GET    /procurar/resultado   → Resultados da busca
GET    /pokemon/{id}/editar  → Formulário de edição
PUT    /pokemon/{id}         → Atualizar Pokémon
DELETE /pokemon/{id}         → Deletar Pokémon
```

---

## 🛠️ Tecnologias Utilizadas

- **Laravel** - Framework PHP
- **Blade** - Motor de templates
- **PokeAPI** - API de Pokémons
- **MySQL** - Banco de dados
- **CSS3** - Estilos modernos
- **Responsive Design** - Mobile-first

---

## 📝 Modelo de Dados - Pokémon

```php
{
    id: Integer,
    name: String (255),
    type: String (255),
    abilities: String,
    description: Text (nullable),
    image: String (nullable),
    pokedex_number: Integer (nullable, unique),
    created_at: Timestamp,
    updated_at: Timestamp
}
```

---

## 🚀 Como Usar

1. **Acesse a Home** - Conheça a aplicação
2. **Explore a Pokedex** - Descubra Pokémons aleatórios
3. **Crie seus Pokémons** - Use a página de criação
4. **Gerencie sua Coleção** - Veja, edite ou delete
5. **Procure Pokémons** - Busque no banco local ou na API

---

## 💡 Dicas

- Clique várias vezes em "Próximo Pokémon Aleatório" para explorar
- Use a busca para encontrar Pokémons por tipo (ex: "fire", "water")
- Suas criações são salvas no banco de dados
- As imagens são armazenadas em `/storage/app/public`
- Todos os dados de PokeAPI são oficiais

---

## ✨ Layout Consistente

Todas as páginas utilizam:
- **Header com navegação** - Links para todas as páginas
- **Container centralizado** - Máx 1200px de largura
- **Cards responsivos** - Grid automático
- **Botões interativos** - Com hover effects
- **Alertas visuais** - Sucesso, erro e informações
- **Footer** - Com informações do projeto

---

Desenvolvido com ❤️ usando Laravel e PokeAPI
