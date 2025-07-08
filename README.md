# 📚 Book Searching and Bookmarking App

A full-stack web application for discovering, bookmarking, and reviewing books. Built with **Laravel** (backend) and **Vue.js** (frontend).

---

## 🔍 Features

- ✅ User authentication and registration
- 🔎 Search books by title or author
- ❤️ Bookmark favorite books
- 🌟 Leave ratings and reviews
- 🧑 Admin management for users and books
- 🎨 Clean and modern UI with Vue.js

---

## 📊 Project Statistics

| Metric                        | Count         |
|------------------------------|---------------|
| Total files                  | 117           |
| Total lines of code          | 7,755         |
| PHP files                    | 85            |
| Controllers                  | 11            |
| Models                       | 0             |
| Migrations                   | 0             |
| Route files                  | 0             |

> 📌 *Note: The app uses Laravel controllers extensively. Models and routes may be inlined or not present in the current code snapshot.*

---

## 🧰 Technologies Used

### Backend:
- [Laravel](https://laravel.com/) (PHP framework)
- Composer for dependency management

### Frontend:
- [Vue.js](https://vuejs.org/)
- Vite as the build tool
- TailwindCSS or custom styles (check project files)

### Other:
- MySQL or SQLite (assumed for Laravel DB)
- PHPUnit for backend testing

---

## 🛠️ Installation

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js and npm
- MySQL or SQLite

### Backend Setup

```bash
cd booksearch
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

### Frontend Setup

```bash
npm install
npm run dev
```

### 📁 Folder Structure (Simplified)
```
booksearch/
├── app/
│   └── Http/
│       └── Controllers/
├── public/
├── resources/
│   └── views/
├── routes/
├── package.json
├── composer.json
└── vite.config.js
```
---

### ✅ Usage
- Register and login to the app.
- Browse and search for books.
- Bookmark or rate your favorite ones.
- Admin users can manage users and book entries.

--- 

### 📜 License
This project is for educational use. Please refer to your institution’s licensing policies before redistribution.
