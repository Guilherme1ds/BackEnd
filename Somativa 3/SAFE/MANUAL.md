# SAFE - Sistema de Autorização e Fluxo Escolar

## 📋 Documentação Técnica e Operacional

### 1. Visão Geral do Sistema

O **SAFE** é um sistema web que digitaliza o processo de autorização e saída de alunos da portaria escolar. O fluxo é:

1. **AQV/Responsável** autoriza a entrada ou saída do aluno
2. **Professor** valida a autorização em sala de aula
3. **Portaria** faz a validação final e libera o aluno

O sistema envia notificações automáticas por **Email** e **WhatsApp** em cada etapa, com logs completos.

---

### 2. Arquitetura e Tecnologias

**Stack Tecnológico:**
- **Backend:** Laravel 11
- **Frontend:** Filament Admin + Vite
- **Banco de Dados:** MySQL
- **Notificações:** Email (Mailpit), Logs do Laravel
- **Autenticação:** Laravel Sanctum + Spatie Permission

**Estrutura de Pastas:**
```
SAFE/
├── app/
│   ├── Events/              # Eventos (AutorizacaoCreated, AutorizacaoUpdated)
│   ├── Listeners/           # Listeners de eventos
│   ├── Models/              # Modelos (User, Aluno, Turma, Autorizacao, NotificationLog)
│   ├── Services/            # NotificationService
│   ├── Filament/
│   │   ├── Resources/       # Recursos do Filament (Turmas, Alunos, Autorizacaos, Users, NotificationLogs)
│   │   ├── Pages/           # Dashboard
│   │   └── Widgets/         # Widgets (NotificationLogsWidget)
│   └── Providers/           # EventServiceProvider
├── database/
│   ├── migrations/          # Migrações (roles, permissions, notifications)
│   └── seeders/             # RoleSeeder
├── resources/
│   └── views/filament/      # Views do Filament
└── routes/                  # Rotas
```

---

### 3. Configuração de Roles e Permissões

O sistema utiliza **Spatie Permission** para gerenciar roles e permissões:

#### Roles Disponíveis:
- **Admin:** Acesso total ao sistema
- **Professor:** Pode criar e editar autorizações
- **Portaria:** Apenas visualiza autorizações aprovadas no dashboard

#### Restrições de Acesso:
- Portaria **NÃO pode** acessar: Turmas, Alunos, Usuários
- Portaria **NÃO pode** criar ou editar autorizações
- Portaria **PODE** visualizar apenas autorizações com status "autorizado_professor" ou "concluído_portaria"

---

### 4. Fluxo de Notificações

#### 4.1 Quando uma Autorização é Criada
1. **Evento disparado:** `AutorizacaoCreated`
2. **Listener:** `SendNotificationOnAutorizacaoCreated`
3. **Ações:**
   - Envia email para responsável
   - Envia WhatsApp para responsável
   - Registra no `NotificationLog` com status "enviado"
   - Logs em `storage/logs/laravel.log`

#### 4.2 Quando uma Autorização é Atualizada
1. **Evento disparado:** `AutorizacaoUpdated`
2. **Listener:** `SendNotificationOnAutorizacaoUpdated`
3. **Se status = "concluido_portaria":**
   - Notifica portaria
   - Registra no log de notificações

#### 4.3 Estrutura de Notificação
**Email:**
```
Assunto: "Autorização de [entrada/saída] - [Nome do Aluno]"
Corpo: "Autorização de [tipo] para [Aluno] da turma [Turma] às [Horário]. Status: [Status]"
```

**WhatsApp (Simulado):**
```
"Autorização de [tipo] para [Aluno] da turma [Turma] às [Horário]"
```

---

### 5. Guia Operacional

#### 5.1 Cadastrando Usuários (Admin)

1. Acesse **Usuários** no menu
2. Clique em **Novo usuário**
3. Preencha os dados:
   - Nome
   - Email
   - Senha
   - Cargo (Admin, Professor, Portaria)
4. Clique em **Salvar**

#### 5.2 Criando uma Autorização (Professor)

1. Acesse **Autorizações**
2. Clique em **Nova autorização**
3. Preencha os dados:
   - Aluno
   - Turma
   - Tipo (Entrada/Saída)
   - Horário
   - Aulas afetadas (1ª, 2ª, 3ª, etc)
   - Status (deixar como "Pendente")
4. Clique em **Salvar**

**Notificações Enviadas:**
- Email para responsável com os detalhes

#### 5.3 Validando na Portaria (Portaria)

1. Faça login com usuário Portaria
2. Acesse o **Dashboard**
3. Visualize as **Autorizações Recentes** (apenas aprovadas)
4. Clique em **Editar** para validar

#### 5.4 Visualizando Logs de Notificações (Todos)

1. Acesse **Log de Notificações** no menu
2. Visualize:
   - Aluno
   - Tipo (Email/WhatsApp)
   - Destinatário
   - Status (Enviado/Falha)
   - Data/Hora

---

### 6. Configuração de Email (Mailpit)

**Mailpit** é um servidor SMTP local para capturar emails em desenvolvimento.

#### Instalação e Uso:

1. **Baixar Mailpit:** https://github.com/axllent/mailpit
2. **Executar:** `mailpit.exe`
3. **Acessar:** http://localhost:1025 (Web UI)

#### Configurar Laravel (`.env`):
```
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=sistema@safe.local
MAIL_FROM_NAME="SAFE Sistema"
```

---

### 7. Monitorando Logs

#### Logs de Notificações:
```
tail -f storage/logs/laravel.log
```

**Exemplos de Logs:**
```
[2026-05-20 15:30:45] local.INFO: Email de autorização {"autorizacao_id":1,"aluno":"João Silva","tipo":"entrar","status":"pendente","mensagem":"Autorização de entrar para João Silva da turma DEV 1º ao às 15:30. Status: pendente"}

[2026-05-20 15:30:46] local.INFO: WhatsApp de autorização {"autorizacao_id":1,"telefone":"11999999999","aluno":"João Silva","tipo":"entrar","mensagem":"Autorização de entrar para João Silva da turma DEV 1º ao às 15:30. Status: pendente"}
```

---

### 8. Estrutura de Banco de Dados

#### Tabela: `autorizacoes`
| Campo | Tipo | Descrição |
|-------|------|-----------|
| id | ID | PK |
| aluno_id | FK | Aluno |
| turma_id | FK | Turma |
| tipo | string | 'entrar' ou 'sair' |
| horario | time | Horário da autorização |
| conta_falta | boolean | Conta como falta? |
| aulas_afetadas | json | Aulas afetadas |
| status | string | 'pendente', 'autorizado_professor', 'concluido_portaria', 'recusado' |
| criado_por_id | FK | User que criou |
| aprovado_por_id | FK | User que aprovou |
| validado_por_id | FK | User que validou |
| observacao | text | Observações |

#### Tabela: `notification_logs`
| Campo | Tipo | Descrição |
|-------|------|-----------|
| id | ID | PK |
| autorizacao_id | FK | Autorização |
| tipo | string | 'email', 'whatsapp', 'sms' |
| destinatario | string | Email ou telefone |
| assunto | string | Assunto (para email) |
| conteudo | text | Conteúdo da notificação |
| status | string | 'pendente', 'enviado', 'falha' |
| resposta_api | text | Resposta da API |
| enviado_em | timestamp | Quando foi enviado |

---

### 9. Troubleshooting

#### Erro: "Table roles doesn't exist"
**Solução:**
```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
php artisan db:seed --class=RoleSeeder
```

#### Portaria não vê autorizações
**Verificar:**
1. Usuário tem role "portaria"? → Acesse Usuários e verifique
2. Autorizações têm status "autorizado_professor"? → Edite e altere status

#### Emails não chegam
**Verificar:**
1. Mailpit está rodando? → Acesse http://localhost:1025
2. Configuração `.env` está correta?
3. Verifique logs em `storage/logs/laravel.log`

---

### 10. Próximas Melhorias

- [ ] Integração real com WhatsApp (Twilio)
- [ ] Integração com SMS (Nexmo)
- [ ] QR Code para validação rápida na portaria
- [ ] Relatórios avançados
- [ ] App mobile para responsáveis
- [ ] Autenticação com face/biometria

---

### 11. Contato e Suporte

Para dúvidas ou sugestões, contacte o desenvolvedor.

---

**Versão:** 1.0  
**Atualizado em:** 20/05/2026
