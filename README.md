# 🏦 Peso Bank — Laravel Banking System

A full-featured web-based banking system built with **Laravel 12** and **Laravel Breeze**, featuring role-based access, account management, fund transfers, transaction history, and an admin panel.

---

## ✨ Features

### Customer
- Register and log in securely
- Open savings or checking accounts
- Deposit and withdraw funds
- Transfer funds to other accounts (with confirmation modal)
- View transaction history with type and date range filters
- Download transaction history as a PDF
- View individual transaction receipts
- Edit profile and update password

### Admin
- Dashboard with key stats (customers, accounts, transactions, total balance)
- View and search all customers
- Suspend or activate customer accounts
- Activate or deactivate individual bank accounts
- View all transactions with type filtering
- View a specific customer's transaction history

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 12 |
| Auth & UI | Laravel Breeze (Blade) |
| Styling | Tailwind CSS |
| Database | MySQL |
| PDF Export | barryvdh/laravel-dompdf v3.1.2 |
| Frontend | Alpine.js, Vite |

---

## ⚙️ Installation

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm
- MySQL

### Steps

**1. Clone the repository**
```bash
git clone https://github.com/Vinco2025/Peso_banking.git
cd banking-system
```

**2. Install dependencies**
```bash
composer install
npm install
```

**3. Set up environment**
```bash
cp .env.example .env
php artisan key:generate
```

**4. Configure your database in `.env`**
```env
DB_DATABASE=peso_bank
DB_USERNAME=root
DB_PASSWORD=your_password
```

**5. Run migrations**
```bash
php artisan migrate
```

**6. Seed the admin account**
```bash
php artisan db:seed
```

**7. Start the development servers**

In two separate terminals:
```bash
npm run dev
```
```bash
php artisan serve
```

Then visit: [http://localhost:8000](http://localhost:8000)

---

## 🔐 Default Credentials

| Role | Email | Password |
|---|---|---|
| Admin | admin@bank.com | password |
| Customer | Register via `/register` | — |

---

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AccountController.php
│   │   ├── TransactionController.php
│   │   └── AdminController.php
│   └── Middleware/
│       ├── EnsureUserRole.php
│       └── CheckUserStatus.php
resources/
└── views/
    ├── customer/
    │   ├── dashboard.blade.php
    │   ├── deposit.blade.php
    │   ├── withdraw.blade.php
    │   ├── transfer.blade.php
    │   ├── accounts/
    │   │   ├── index.blade.php
    │   │   └── create.blade.php
    │   └── transactions/
    │       ├── history.blade.php
    │       ├── receipt.blade.php
    │       └── pdf.blade.php
    ├── admin/
    │   ├── dashboard.blade.php
    │   ├── users.blade.php
    │   ├── transactions.blade.php
    │   └── user_transactions.blade.php
    └── layouts/
        ├── app.blade.php
        └── navigation.blade.php
```

---

## 📸 Screenshots

> _Add screenshots of your app here_

| Page | Preview |
|---|---|
| Landing Page | _(screenshot)_ |
| Customer Dashboard | _(screenshot)_ |
| Transaction History | _(screenshot)_ |
| Admin Dashboard | _(screenshot)_ |

---

## 🗄️ Database Schema

### `users`
| Column | Type | Notes |
|---|---|---|
| id | bigint | Primary key |
| name | string | |
| email | string | Unique |
| password | string | Hashed |
| role | string | `admin` or `customer` |
| status | string | `active` or `suspended` |

### `accounts`
| Column | Type | Notes |
|---|---|---|
| id | bigint | Primary key |
| user_id | bigint | Foreign key |
| account_number | string | e.g. `ACC-XXXXXXXX` |
| type | string | `savings` or `checking` |
| balance | decimal | |
| status | string | `active` or `inactive` |

### `transactions`
| Column | Type | Notes |
|---|---|---|
| id | bigint | Primary key |
| from_account_id | bigint | Nullable foreign key |
| to_account_id | bigint | Nullable foreign key |
| type | string | `deposit`, `withdrawal`, `transfer` |
| amount | decimal | |
| description | string | Nullable |

---

## 🚀 Key Learnings

This project was built as a hands-on learning exercise in Laravel. Key concepts practiced:

- Role-based middleware (`EnsureUserRole`, `CheckUserStatus`)
- Database transactions with `DB::transaction()` for safe fund transfers
- Eloquent relationships (`hasMany`, `belongsTo`)
- Query scoping and filtering with `whereIn`, `orWhere`, date ranges
- PDF generation with `barryvdh/laravel-dompdf`
- Git branching workflow (`feature/` branches, merging to `main`)
- Alpine.js for interactive modals and dropdowns

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

---

<p align="center">Built with ❤️ using Laravel 12 & Tailwind CSS</p>