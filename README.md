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

## Instalação e Execução

### 1. Obtenha o projeto

Clone o repositório ou faça o download do arquivo `.zip`.

Caso utilize um servidor como Laragon, XAMPP ou WampServer, coloque a pasta do projeto no diretório público do servidor (por exemplo, `www` ou `htdocs`).

---

### 2. Importe o banco de dados

Importe o arquivo:

```text
database/setup_database.sql
```

O script criará automaticamente o banco de dados `semit_lotes`, a tabela `lotes` e alguns registros de exemplo para facilitar os testes.

---

### 3. Configure a conexão

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

### 4. Execute a aplicação

A aplicação pode ser executada utilizando qualquer servidor PHP compatível, como:

- Laragon
- XAMPP
- WampServer
- Servidor embutido do PHP

Caso utilize o servidor embutido do PHP, execute o comando na raiz do projeto:

```bash
php -S localhost:8000
```

---

### 5. Acesse a aplicação

Se estiver utilizando Apache, acesse a URL correspondente ao diretório em que o projeto foi colocado.

Exemplo:

```text
http://localhost/sistema-gestao-lotes-main/
```

Caso utilize o servidor embutido do PHP:

```text
http://localhost:8000/
```

---

## Endpoints da API

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| GET | `/api/lote/read.php` | Lista todos os lotes |
| GET | `/api/lote/read.php?id={id}` | Consulta um lote específico |
| POST | `/api/lote/create.php` | Cadastra um lote |
| PUT | `/api/lote/update.php` | Atualiza um lote |
| DELETE | `/api/lote/delete.php` | Remove um lote |

> **Observação:** a consulta por ID foi mantida como funcionalidade adicional da API, embora não fosse um requisito do escopo inicial.

---

## Observações

- O projeto foi desenvolvido priorizando simplicidade, organização e facilidade de execução.
- Não utiliza dependências de build ou gerenciamento de pacotes, permitindo sua execução apenas com PHP e MySQL após a importação do banco de dados.
- O front-end consome a API utilizando `fetch`, realizando as operações de cadastro, consulta, atualização e remoção de registros.
