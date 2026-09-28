<div align="right">

🇺🇸 **English** · [🇧🇷 Português](README.pt-BR.md)

</div>

# 🧱 CRUD MVC PHP

A web application built on a **custom MVC architecture in pure PHP**, with no framework. It includes its own router, a middleware queue, sessions, a template engine, an admin area and a versioned REST API.

The goal was to understand what frameworks like Laravel and Slim do under the hood by building each piece from scratch.

![PHP](https://img.shields.io/badge/PHP_8-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)
![Composer](https://img.shields.io/badge/Composer_PSR--4-885630?style=flat&logo=composer&logoColor=white)

<!-- Add a screenshot of the site and the admin panel here -->
<!-- ![Screenshot](docs/screenshot.png) -->

## ✨ Features

- 🌐 **Public site** with home, about and testimonials pages
- 🔐 **Admin area** with login/logout and session control
- 📝 **Full CRUD** for testimonials and admin users
- 📄 **Pagination** in listings
- 🔌 **REST API v1** returning JSON
- 🚧 **Maintenance mode** toggled through an environment variable

## 🏗 Architecture

```
app/
├── Controller/      # Pages, Admin and Api controllers
├── Db/              # PDO database layer and pagination
├── Http/
│   ├── Router.php   # Router with URL params ({id}) and middlewares per route
│   ├── Request.php
│   ├── Response.php
│   └── Middleware/  # Queue, Maintenance, Api, RequireAdminLogin/Logout
├── Model/Entity/    # User, Testimony, Organization
├── Routes/          # pages.php, admin.php, api.php (api/v1/*)
├── Session/         # Admin session handling
└── Utils/           # View (template engine), Environment (.env), Uri
resources/view/      # HTML templates
sql/                 # Database dump
```

**Request flow:** `index.php` → `Router` → middleware queue → controller → `View` renders the template → `Response`.

## 🔌 API

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/api/v1/testimonies` | List testimonials (paginated) |
| `GET` | `/api/v1/testimony/{id}` | Get one testimonial |
| `POST` | `/api/v1/testimony` | Create a testimonial |

## 🚀 Running locally

Requirements: PHP 8+, Composer and MySQL/MariaDB.

```bash
git clone https://github.com/Marlon-Paulo-da-Silva/CRUD-MVC-PHP.git
cd CRUD-MVC-PHP
composer install
cp .env.example .env
```

1. Create a database named `lojaapi` and import `sql/lojaapi.sql`.
2. Adjust the credentials in `.env`.
3. Start the server:

```bash
php -S localhost:8000
```

Open http://localhost:8000. The admin area is at `/admin`.

## 👨‍💻 Author

**Marlon Paulo** · [LinkedIn](https://www.linkedin.com/in/marlon-paulo/) · [GitHub](https://github.com/Marlon-Paulo-da-Silva)
