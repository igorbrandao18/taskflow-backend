# 🚀 TaskFlow Backend

API REST para gerenciamento de tarefas desenvolvida com **CodeIgniter 4** e **MySQL**, seguindo as melhores práticas de desenvolvimento.

## 📋 Sobre o Desafio

Este projeto foi desenvolvido como parte de um **desafio técnico** para demonstrar habilidades em:

### 🎯 Objetivos
- **Backend robusto**: API REST completa com CodeIgniter 4
- **CRUD de tarefas**: Operações completas de criação, leitura, atualização e exclusão
- **Arquitetura limpa**: Seguindo princípios SOLID e Clean Architecture
- **Documentação**: README completo e endpoints bem documentados
- **Testes**: Cobertura de testes unitários e de integração
- **Docker**: Containerização para facilitar desenvolvimento e deploy

### 🏆 Funcionalidades Implementadas
- ✅ **GET /api/tasks** - Listar todas as tarefas
- ✅ **POST /api/tasks** - Criar nova tarefa
- ✅ **PUT /api/tasks/{id}** - Atualizar tarefa existente
- ✅ **DELETE /api/tasks/{id}** - Remover tarefa
- ✅ **GET /api/tasks/{id}** - Obter tarefa específica
- ✅ **CORS configurado** - Para integração com frontend
- ✅ **Validação de dados** - Proteção contra dados inválidos
- ✅ **Logs de auditoria** - Rastreamento de operações
- ✅ **Status das tarefas** - Enum com valores: pending, in_progress, completed

### 🔧 Tecnologias Utilizadas
- **CodeIgniter 4**: Framework PHP moderno e robusto
- **MySQL 8.0**: Banco de dados relacional
- **Docker**: Containerização para desenvolvimento
- **PHP 8.1+**: Linguagem de programação
- **Composer**: Gerenciador de dependências

## 🏗️ Arquitetura

O projeto segue a arquitetura **MVC (Model-View-Controller)** do CodeIgniter:

```
app/
├── Config/           # ⚙️ Configurações da aplicação
├── Controllers/      # 🎮 Controladores (lógica de requisições)
├── Models/          # 📊 Modelos (lógica de negócio e dados)
├── Database/        # 🗄️ Migrações e seeds
└── Tests/           # 🧪 Testes automatizados
```

### Estrutura Detalhada

#### **Controllers** (`app/Controllers/`)
- **`TasksController.php`**: Controlador principal para operações CRUD de tarefas
  - `index()`: Listar todas as tarefas
  - `create()`: Criar nova tarefa
  - `update()`: Atualizar tarefa existente
  - `delete()`: Remover tarefa
  - `show()`: Exibir tarefa específica

#### **Models** (`app/Models/`)
- **`TaskModel.php`**: Modelo de dados para tarefas
  - Validação de campos
  - Relacionamentos (se necessário)
  - Campos permitidos para mass assignment

#### **Database** (`app/Database/`)
- **`Migrations/`**: Migrações para criação/alteração de tabelas
- **`Seeds/`**: Dados iniciais para desenvolvimento

## 🚀 Funcionalidades

### ✅ CRUD Completo de Tarefas
- **GET /api/tasks**: Listar todas as tarefas
- **POST /api/tasks**: Criar nova tarefa
- **PUT /api/tasks/{id}**: Atualizar tarefa existente
- **DELETE /api/tasks/{id}**: Remover tarefa
- **GET /api/tasks/{id}**: Obter tarefa específica

### 🔒 Segurança e Validação
- **CORS**: Configurado para permitir requisições do frontend
- **Validação**: Campos obrigatórios e tipos de dados
- **Sanitização**: Proteção contra injeção de dados maliciosos
- **Logs**: Registro de operações para auditoria

### 📊 Banco de Dados
- **MySQL**: Banco de dados relacional
- **Migrations**: Controle de versão do schema
- **Enum**: Status das tarefas com valores predefinidos
- **Índices**: Otimização de consultas

## 🛠️ Tecnologias

- **CodeIgniter 4**: Framework PHP moderno
- **MySQL 8.0**: Banco de dados relacional
- **Docker**: Containerização para desenvolvimento
- **PHP 8.1+**: Linguagem de programação
- **Composer**: Gerenciador de dependências

## 📦 Instalação e Execução

### Pré-requisitos
- Docker e Docker Compose
- Git
- Porta 8080 disponível

### Instalação com Docker
```bash
# Clonar o repositório
git clone <repository-url>
cd taskflow-backend

# Iniciar containers
docker-compose up -d

# Executar migrações
docker-compose exec app php spark migrate

# Verificar se está funcionando
curl http://localhost:8080/api/tasks
```

### Instalação Local (sem Docker)
```bash
# Instalar dependências
composer install

# Configurar banco de dados
cp env .env
# Editar .env com suas configurações

# Executar migrações
php spark migrate

# Iniciar servidor
php spark serve
```

### Scripts Disponíveis
```bash
# Desenvolvimento
docker-compose up -d          # Iniciar containers
docker-compose down           # Parar containers
docker-compose restart app    # Reiniciar apenas a aplicação

# Banco de dados
docker-compose exec app php spark migrate    # Executar migrações
docker-compose exec app php spark db:seed    # Executar seeds

# Testes
docker-compose exec app php spark test       # Executar testes
```

## 🔧 Configuração

### Variáveis de Ambiente
Crie um arquivo `.env` baseado no `env`:
```env
# Database
database.default.hostname = localhost
database.default.database = taskflow
database.default.username = root
database.default.password = root
database.default.DBDriver = MySQLi

# App
app.baseURL = 'http://localhost:8080/'
app.indexPage = ''

# CORS
app.cors = true
app.cors.origin = ['http://localhost:8100', 'http://localhost:4200']
```

### Docker Compose
```yaml
version: '3.8'
services:
  app:
    build: .
    ports:
      - "8080:80"
    volumes:
      - .:/var/www/html
    depends_on:
      - db
    environment:
      - CI_ENVIRONMENT=development

  db:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: taskflow
    ports:
      - "3306:3306"
    volumes:
      - mysql_data:/var/lib/mysql

volumes:
  mysql_data:
```

## 📊 Estrutura do Banco de Dados

### Tabela `tasks`
```sql
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `status` enum('pending','in_progress','completed') NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Status das Tarefas
| Status | Descrição | Valor Padrão |
|--------|-----------|--------------|
| `pending` | Tarefa aguardando início | ✅ |
| `in_progress` | Tarefa sendo executada | ❌ |
| `completed` | Tarefa finalizada | ❌ |

## 🎯 Endpoints da API

### Base URL
```
http://localhost:8080/api
```

### Endpoints Disponíveis

#### **GET /tasks**
Lista todas as tarefas
```bash
curl http://localhost:8080/api/tasks
```

**Resposta:**
```json
{
  "status": 200,
  "data": [
    {
      "id": 1,
      "title": "Implementar login",
      "description": "Criar sistema de autenticação",
      "status": "pending",
      "created_at": "2024-01-15 10:30:00",
      "updated_at": "2024-01-15 10:30:00"
    }
  ]
}
```

#### **POST /tasks**
Cria uma nova tarefa
```bash
curl -X POST http://localhost:8080/api/tasks \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Nova tarefa",
    "description": "Descrição da tarefa",
    "status": "pending"
  }'
```

#### **PUT /tasks/{id}**
Atualiza uma tarefa existente
```bash
curl -X PUT http://localhost:8080/api/tasks/1 \
  -H "Content-Type: application/json" \
  -d '{
    "status": "in_progress"
  }'
```

#### **DELETE /tasks/{id}**
Remove uma tarefa
```bash
curl -X DELETE http://localhost:8080/api/tasks/1
```

#### **GET /tasks/{id}**
Obtém uma tarefa específica
```bash
curl http://localhost:8080/api/tasks/1
```

## 🔍 Debug e Troubleshooting

### Problemas Comuns

#### 1. CORS Errors
```bash
# Verificar configuração CORS
docker-compose exec app cat app/Config/Cors.php

# Testar CORS
curl -H "Origin: http://localhost:8100" \
  -H "Access-Control-Request-Method: GET" \
  -H "Access-Control-Request-Headers: X-Requested-With" \
  -X OPTIONS http://localhost:8080/api/tasks
```

#### 2. Status "Desconhecido"
```bash
# Verificar enum no banco
docker-compose exec db mysql -u root -proot taskflow -e "DESCRIBE tasks;"

# Atualizar enum se necessário
docker-compose exec db mysql -u root -proot taskflow -e "ALTER TABLE tasks MODIFY COLUMN status ENUM('pending','in_progress','completed') NOT NULL DEFAULT 'pending';"
```

#### 3. Erro 500 - Logs
```bash
# Ver logs da aplicação
docker-compose logs app

# Ver logs do CodeIgniter
docker-compose exec app tail -f /var/www/html/writable/logs/log-$(date +%Y-%m-%d).log
```

### Logs de Desenvolvimento
```bash
# Logs em tempo real
docker-compose logs -f app

# Logs do banco
docker-compose logs -f db

# Acessar container
docker-compose exec app bash
```

## 🧪 Testes

### Testes Unitários
```bash
# Executar todos os testes
docker-compose exec app php spark test

# Executar teste específico
docker-compose exec app php spark test --filter TasksTest
```

### Testes de Integração
```bash
# Testar endpoints via curl
curl -X GET http://localhost:8080/api/tasks
curl -X POST http://localhost:8080/api/tasks -H "Content-Type: application/json" -d '{"title":"Teste","description":"Descrição"}'
curl -X PUT http://localhost:8080/api/tasks/1 -H "Content-Type: application/json" -d '{"status":"in_progress"}'
curl -X DELETE http://localhost:8080/api/tasks/1
```

## 📚 Documentação da API

### Endpoints Testáveis
- **curl**: Comandos prontos para teste
- **Postman**: Collection disponível
- **Testes de integração**: Scripts automatizados

## 🚀 Deploy

### Produção com Docker
```bash
# Build da imagem de produção
docker build -t taskflow-backend:prod .

# Executar em produção
docker run -d \
  -p 8080:80 \
  -e CI_ENVIRONMENT=production \
  -e database.default.hostname=your-db-host \
  taskflow-backend:prod
```

### Configuração de Produção
```env
# Produção
CI_ENVIRONMENT = production
app.baseURL = 'https://your-domain.com/'

# Banco de dados
database.default.hostname = your-db-host
database.default.database = taskflow_prod
database.default.username = your-user
database.default.password = your-password
```

## 🔒 Segurança

### CORS
- Configurado para permitir apenas origens específicas
- Headers de segurança habilitados
- Métodos HTTP restritos

### Validação
- Sanitização de entrada
- Validação de tipos de dados
- Proteção contra SQL Injection

### Logs
- Registro de todas as operações
- Logs de erro detalhados
- Auditoria de acesso

## 🤝 Contribuição

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

## 👥 Autores

- **Igor Brandão** - Desenvolvimento inicial

## 🙏 Agradecimentos

- CodeIgniter Team pelo framework robusto
- Docker pela containerização
- Comunidade PHP pelos recursos

---

**Desenvolvido com ❤️ usando CodeIgniter 4 + MySQL**
