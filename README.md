# Sistema de Gestão de Lotes

Aplicação Full Stack desenvolvida como solução para um teste técnico, permitindo o cadastro, consulta, atualização e remoção de lotes por meio de uma API REST em PHP e uma interface web construída com Vue.js.

---

## Tecnologias Utilizadas

- **Front-end:** HTML5, Tailwind CSS (CDN) e Vue.js 3 (CDN)
- **Back-end:** PHP 7.0+
- **Banco de Dados:** MySQL
- **Comunicação:** API REST utilizando JSON

---

## Funcionalidades

- Cadastro de lotes
- Consulta de todos os lotes
- Consulta de lote por ID
- Atualização de registros
- Remoção de registros
- Validação dos dados enviados pela API
- Visualização dos detalhes dos lotes pela interface

---

## Estrutura do Projeto

```text
teste-semit-lotes/
│
├── api/
│   ├── config/
│   │   ├── Database.php
│   │   └── Headers.php
│   │
│   ├── lote/
│   │   ├── create.php
│   │   ├── read.php
│   │   ├── update.php
│   │   └── delete.php
│   │
│   └── models/
│       └── Lote.php
│
├── database/
│   └── setup_database.sql
│
├── index.html
└── README.md
```

---

## Decisões de Implementação

Durante o desenvolvimento foram adotadas algumas decisões para manter a aplicação simples, organizada e de fácil manutenção:

- Utilização de **PDO** para acesso ao banco de dados.
- Queries parametrizadas para auxiliar na prevenção de SQL Injection.
- Separação entre configurações, classe **Model** e endpoints da API.
- Centralização dos cabeçalhos HTTP para evitar repetição de código.
- Utilização dos métodos HTTP apropriados (`GET`, `POST`, `PUT` e `DELETE`) para cada operação da API.
- Interface construída apenas com HTML, Tailwind CSS e Vue.js via CDN, sem dependências de build e apenas com os campos obrigatórios para o cadastro de lotes (exceto status).
- Embora o escopo inicial contemplasse apenas o cadastro e a consulta de lotes, foi implementado um CRUD completo para tornar a aplicação mais consistente.
- A configuração do banco de dados foi mantida diretamente na classe `Database.php`, sem utilização de arquivo `.env`, priorizando uma execução simples e imediata da aplicação.

---

## Banco de Dados

O arquivo `database/setup_database.sql`:

- cria o banco de dados;
- cria a tabela `lotes`;
- adiciona um índice para otimizar consultas;
- insere registros de exemplo para facilitar os testes.

O script utiliza `utf8mb4`, garantindo compatibilidade com caracteres acentuados.

---

## Como Executar

### 1. Importe o banco de dados

Execute o arquivo:

```text
database/setup_database.sql
```

---

### 2. Configure a conexão

Caso seja necessário alterar as credenciais do banco de dados, edite o arquivo:

```text
api/config/Database.php
```

```php
private $host = "127.0.0.1";
private $db_name = "semit_lotes";
private $username = "root";
private $password = "";
```

---

### 3. Execute o projeto

A aplicação pode ser executada utilizando qualquer servidor PHP compatível, como:

- XAMPP
- Laragon
- WampServer
- Servidor embutido do PHP

Exemplo utilizando o servidor nativo:

```bash
php -S localhost:8000
```

---

### 4. Acesse a aplicação

Abra o navegador em:

```text
http://localhost:8000/
```

ou no endereço correspondente ao servidor utilizado.

---

## Endpoints da API

| Método | Endpoint                     | Descrição                   |
| ------ | ---------------------------- | --------------------------- |
| GET    | `/api/lote/read.php`         | Lista todos os lotes        |
| GET    | `/api/lote/read.php?id={id}` | Consulta um lote específico |
| POST   | `/api/lote/create.php`       | Cadastra um lote            |
| PUT    | `/api/lote/update.php`       | Atualiza um lote            |
| DELETE | `/api/lote/delete.php`       | Remove um lote              |

> **Observação:** a consulta por ID foi mantida como funcionalidade adicional da API, embora não fosse um requisito do escopo inicial.

---

## Observações

- O projeto foi desenvolvido priorizando simplicidade, organização e facilidade de execução.
- Não utiliza dependências externas de build ou gerenciamento de pacotes, permitindo sua execução apenas com PHP e MySQL após a importação do banco de dados.
- O front-end consome a API utilizando `fetch`, realizando as operações de cadastro, consulta, atualização e remoção de registros.
