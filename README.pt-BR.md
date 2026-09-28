<div align="right">

[🇺🇸 English](README.md) · 🇧🇷 **Português**

</div>

# 🧱 CRUD MVC PHP

Aplicação web construída sobre uma **arquitetura MVC própria em PHP puro**, sem framework. Tem roteador próprio, fila de middlewares, sessões, template engine, área administrativa e API REST versionada.

O objetivo foi entender o que frameworks como Laravel e Slim fazem por baixo dos panos, construindo cada peça do zero.

![PHP](https://img.shields.io/badge/PHP_8-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)
![Composer](https://img.shields.io/badge/Composer_PSR--4-885630?style=flat&logo=composer&logoColor=white)

<!-- Coloque aqui um print do site e do painel administrativo -->
<!-- ![Screenshot](docs/screenshot.png) -->

## ✨ Funcionalidades

- 🌐 **Site público** com páginas de home, sobre e depoimentos
- 🔐 **Área administrativa** com login/logout e controle de sessão
- 📝 **CRUD completo** de depoimentos e usuários administradores
- 📄 **Paginação** nas listagens
- 🔌 **API REST v1** retornando JSON
- 🚧 **Modo manutenção** ativado por variável de ambiente

## 🏗 Arquitetura

```
app/
├── Controller/      # Controllers de Pages, Admin e Api
├── Db/              # Camada de banco com PDO e paginação
├── Http/
│   ├── Router.php   # Roteador com parâmetros na URL ({id}) e middlewares por rota
│   ├── Request.php
│   ├── Response.php
│   └── Middleware/  # Queue, Maintenance, Api, RequireAdminLogin/Logout
├── Model/Entity/    # User, Testimony, Organization
├── Routes/          # pages.php, admin.php, api.php (api/v1/*)
├── Session/         # Sessão do administrador
└── Utils/           # View (template engine), Environment (.env), Uri
resources/view/      # Templates HTML
sql/                 # Dump do banco de dados
```

**Fluxo da requisição:** `index.php` → `Router` → fila de middlewares → controller → `View` renderiza o template → `Response`.

## 🔌 API

| Método | Endpoint | Descrição |
|---|---|---|
| `GET` | `/api/v1/testimonies` | Lista os depoimentos (paginado) |
| `GET` | `/api/v1/testimony/{id}` | Consulta um depoimento |
| `POST` | `/api/v1/testimony` | Cadastra um depoimento |

## 🚀 Rodando localmente

Requisitos: PHP 8+, Composer e MySQL/MariaDB.

```bash
git clone https://github.com/Marlon-Paulo-da-Silva/CRUD-MVC-PHP.git
cd CRUD-MVC-PHP
composer install
cp .env.example .env
```

1. Crie um banco chamado `lojaapi` e importe o `sql/lojaapi.sql`.
2. Ajuste as credenciais no `.env`.
3. Suba o servidor:

```bash
php -S localhost:8000
```

Acesse http://localhost:8000. A área administrativa fica em `/admin`.

## 👨‍💻 Autor

**Marlon Paulo** · [LinkedIn](https://www.linkedin.com/in/marlon-paulo/) · [GitHub](https://github.com/Marlon-Paulo-da-Silva)
