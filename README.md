# StockFlow

> A role-aware inventory and point-of-sale management system built with Laravel 13, Livewire 4, and Tailwind CSS.

StockFlow centralises product management, supplier relationships, and sales operations under one roof — with real-time reactive UI and a granular three-role permission model that keeps every actor of the business limited to exactly what they need to see and do.

---

## Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Role Model](#role-model)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
  - [Development Server](#development-server)
- [Seeded Credentials](#seeded-credentials)
- [Project Structure](#project-structure)
- [Architecture Notes](#architecture-notes)
- [Available Scripts](#available-scripts)
- [License](#license)

---

## Features

**Inventory management**
- Full product CRUD with barcode support, purchase/sale price tracking, and per-product stock alert thresholds
- Category and supplier management
- Real-time low-stock widget on the admin dashboard — automatically surfaces any product at or below its alert threshold
- One-click PDF export of the low-stock report (barryvdh/laravel-dompdf)

**Point of Sale (Caisse)**
- Live cart built as a Livewire component — search products by name or barcode, add/remove items, adjust quantities
- Stock guard on every cart action: requests that exceed available stock are rejected before they reach the database
- Sale validation wrapped in a database transaction with pessimistic locking (`lockForUpdate`) to prevent race conditions under concurrent cashiers
- PDF receipt generation and download for every completed sale

**User & access management**
- Three roles — `admin`, `vendeur`, `fournisseur` — enforced at the route middleware level via Spatie Laravel Permission
- Admin-only user management table with live search and role filtering (Livewire), full CRUD
- Suppliers can be linked to a user account; linked suppliers see only their own products and the sales that contain them

**Audit trail**
- Every significant mutation (user created/updated/deleted, product created/updated/deleted, supplier/category changes, sale validated) is recorded in the `activity_logs` table via a shared `Loggable` trait
- Activity feed visible to admins on the dashboard and a dedicated activity log page

---

## Tech Stack

| Layer | Choice |
|---|---|
| Framework | Laravel 13 |
| PHP | ≥ 8.3 |
| Reactive UI | Livewire 4 |
| Frontend build | Vite 8 + Tailwind CSS 3 |
| JS interactivity | Alpine.js 3 |
| Roles & permissions | Spatie Laravel Permission 7 |
| PDF generation | barryvdh/laravel-dompdf 3 |
| Auth scaffolding | Laravel Breeze 2 |
| Default database | SQLite (zero-config) — MySQL/PostgreSQL ready |
| Queue / cache / session | Database driver (out of the box) |
| Testing | PHPUnit 12 |

---

## Role Model

| Capability | `admin` | `vendeur` | `fournisseur` |
|---|:---:|:---:|:---:|
| Admin dashboard & activity log | ✅ | — | — |
| User management (CRUD) | ✅ | — | — |
| Product CRUD | ✅ | — | — |
| View products | ✅ | — | Own only |
| Category & supplier management | ✅ | — | — |
| Point of sale (Caisse) | ✅ | ✅ | — |
| View all sales | ✅ | — | — |
| View own sales | ✅ | ✅ | — |
| View sales containing own products | ✅ | — | ✅ |
| Download PDF receipt | ✅ | Own only | — |
| Export low-stock PDF report | ✅ | — | — |

Route-level enforcement uses `middleware('role:admin')` and `middleware('role:admin|vendeur')` guards. Controller methods add a second layer of ownership checks where the route alone isn't granular enough (e.g. a `fournisseur` viewing a sale).

---

## Getting Started

### Prerequisites

- PHP 8.3+
- Composer 2
- Node.js 20+ and npm

SQLite is the default and requires no additional setup. To switch to MySQL or PostgreSQL, update `DB_CONNECTION` and the related variables in your `.env` before running migrations.

### Installation

```bash
# 1. Clone
git clone https://github.com/your-username/stockflow.git
cd stockflow

# 2. One-command setup (install deps, copy .env, generate key, migrate, build assets)
composer run setup
```

`composer run setup` runs the following steps in sequence:

```
composer install
cp .env.example .env          # skipped if .env already exists
php artisan key:generate
php artisan migrate --force
npm install
npm run build
```

**Seed demo data (optional)**

```bash
php artisan db:seed
```

This seeds the three roles, three default users (see [Seeded Credentials](#seeded-credentials)), and a set of demo products, categories, and suppliers.

### Development Server

```bash
composer run dev
```

Spins up four concurrent processes via `concurrently`:

| Process | Command |
|---|---|
| Laravel dev server | `php artisan serve` |
| Queue worker | `php artisan queue:listen` |
| Log tail (Pail) | `php artisan pail` |
| Vite HMR | `npm run dev` |

The app will be available at `http://localhost:8000`.

---

## Seeded Credentials

| Role | Email | Password |
|---|---|---|
| Admin | `admin@test.com` | `password` |
| Vendeur | `vendeur@test.com` | `password` |
| Fournisseur | `fournisseur@test.com` | `password` |

> **Note:** Change these before any non-local deployment.

---

## Project Structure

```
app/
├── Http/
│   └── Controllers/
│       ├── Admin/          # Dashboard, admin-scoped actions
│       ├── Auth/           # Breeze auth controllers
│       ├── ProductController.php
│       ├── SaleController.php     # Includes receipt PDF generation
│       ├── StockReportController.php
│       ├── SupplierController.php
│       ├── CategoryController.php
│       └── UserController.php
├── Livewire/
│   ├── Admin/UserTable.php        # Searchable, filterable user list
│   ├── Caisse/Cart.php            # Full POS cart logic
│   ├── Dashboard/LowStockWidget.php
│   └── Products/ProductSearch.php
├── Models/
│   ├── User.php                   # HasRoles, Loggable
│   ├── Product.php                # scopeLowStock, scopeOutOfStock
│   ├── Sale.php / SaleItem.php
│   ├── Category.php / Supplier.php
│   └── ActivityLog.php            # Polymorphic subject
└── Traits/
    └── Loggable.php               # Shared audit logging

database/
├── migrations/
└── seeders/
    ├── RoleSeeder.php
    ├── CoreUsersSeeder.php
    └── DemoDataSeeder.php
```

---

## Architecture Notes

**Livewire for reactive surfaces, Blade for the rest.** Heavy-interaction views (the POS cart, the user management table, product search) are Livewire components. Static views use plain Blade to keep the asset footprint minimal.

**Transactions with pessimistic locking in the cart.** `Cart::validateSale()` runs inside `DB::transaction()` and calls `lockForUpdate()` before decrementing stock, eliminating the TOCTOU window that would otherwise allow two simultaneous sales to overdraw the same product.

**`Loggable` trait.** A single static method `recordActivity(string $action, ?Model $subject, ?string $description)` is the one place any controller or Livewire component calls to write to the audit log. The `subject` relationship is polymorphic, so the log table can point at any Eloquent model without schema changes.

**Role-scoped data access.** Controllers re-check ownership after route middleware, not just before. A `fournisseur` hitting `/sales/{sale}` goes through the `auth` middleware, then through a controller ownership check that verifies the sale actually contains one of their products. The route guard is the first line; the controller check is the second.

**SQLite default, any driver ready.** `.env.example` ships with `DB_CONNECTION=sqlite`. Switching to MySQL or PostgreSQL only requires updating the four `DB_*` variables — no application code changes.

---

## Available Scripts

| Command | Description |
|---|---|
| `composer run setup` | Full first-time install (deps → env → key → migrate → npm → build) |
| `composer run dev` | Start all dev processes concurrently |
| `composer run test` | Clear config cache and run the PHPUnit suite |
| `php artisan db:seed` | Seed roles, default users, and demo data |
| `php artisan migrate:fresh --seed` | Wipe and reseed (dev only) |
| `npm run build` | Production asset build |
| `npm run dev` | Vite HMR only |

---

## License

MIT — see [LICENSE](LICENSE) for details.
