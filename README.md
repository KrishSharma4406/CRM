# CRM — Laravel Admin Panel with Roles & Permissions

A Laravel-based CRM application with a **Super Admin panel** for managing **roles**, **permissions**, and **users**. Built using **Laravel Breeze** (Blade stack) for clean, simple authentication UI.

## Features

- **Super Admin Authentication** — Database-backed super admin login
- **Role Management** — Create, edit, and delete roles with assigned permissions
- **Permission Management** — Full CRUD for granular permissions
- **User Management** — View all users and assign roles
- **Middleware Protection** — All admin routes protected by `superadmin` middleware
- **Simple UI** — Clean Laravel Breeze Blade templates (Tailwind CSS)

## Tech Stack

| Technology | Version |
|------------|---------|
| PHP | 8.2+ |
| Laravel | 13.x |
| Laravel Breeze | 2.x |
| MySQL | 5.7+ |
| Tailwind CSS | 4.x |
| Vite | 8.x |

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/KrishSharma4406/CRM.git
cd CRM
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Environment setup

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your MySQL credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crm
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Create the database

Create a MySQL database named `crm`:

```sql
CREATE DATABASE crm;
```

### 5. Run migrations and seed

```bash
php artisan migrate --seed
```

This will create all tables and seed a **Super Admin** user.

### 6. Start the development server

```bash
php artisan serve
npm run dev
```

> **Note**: On Windows, run `php artisan serve` and `npm run dev` in separate terminals instead of `composer run dev` (the `pcntl` extension required by Pail is not available on Windows).

## Default Super Admin Credentials

| Field | Value |
|-------|-------|
| Email | `admin@admin.com` |
| Password | `password` |

> ⚠️ **Change these credentials in production!**

## Database Schema

### Tables

- **users** — User accounts with optional `role_id` foreign key
- **roles** — Role definitions (e.g., `super-admin`, `editor`)
- **permissions** — Permission definitions (e.g., `manage-roles`, `manage-users`)
- **permission_role** — Pivot table linking roles to permissions

### Default Seeded Data

- **Role**: `super-admin`
- **Permissions**: `manage-roles`, `manage-permissions`, `manage-users`
- **User**: Super Admin (`admin@admin.com`)

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── Admin/
│   │       ├── RoleController.php
│   │       ├── PermissionController.php
│   │       └── UserController.php
│   └── Middleware/
│       └── SuperAdmin.php
├── Models/
│   ├── User.php
│   ├── Role.php
│   └── Permission.php
resources/views/
├── admin/
│   ├── roles/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   ├── permissions/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   └── users/
│       ├── index.blade.php
│       └── edit.blade.php
```

## Admin Routes

All admin routes are prefixed with `/admin` and protected by `auth` + `superadmin` middleware:

| Method | URI | Action |
|--------|-----|--------|
| GET | `/admin/roles` | List all roles |
| GET | `/admin/roles/create` | Create role form |
| POST | `/admin/roles` | Store new role |
| GET | `/admin/roles/{role}/edit` | Edit role form |
| PUT | `/admin/roles/{role}` | Update role |
| DELETE | `/admin/roles/{role}` | Delete role |
| GET | `/admin/permissions` | List all permissions |
| GET | `/admin/permissions/create` | Create permission form |
| POST | `/admin/permissions` | Store new permission |
| GET | `/admin/permissions/{permission}/edit` | Edit permission form |
| PUT | `/admin/permissions/{permission}` | Update permission |
| DELETE | `/admin/permissions/{permission}` | Delete permission |
| GET | `/admin/users` | List all users |
| GET | `/admin/users/{user}/edit` | Edit user role |
| PUT | `/admin/users/{user}` | Update user role |

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
