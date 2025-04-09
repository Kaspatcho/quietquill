# 🪶 Quiet Quill

A private Laravel-powered diary for logging your thoughts, feelings, and ideas — just for you.

No likes, no followers, no noise. Just a place to write.

---

## ✨ Features

- 📓 Personal diary – Only you can view and edit entries.
- 🔒 Secure – Auth-protected with Laravel's built-in authentication.
- 🕰️ Timestamped entries – See your journey over time.
- 🌙 Dark mode friendly (because some thoughts come at night).
- 🔍 Search your past thoughts (comming soon).
- 🏷️ Tag support for better organization (coming soon).

---

## 🚀 Getting Started

1. **Clone the repo:**

```bash
git clone https://github.com/Kaspatcho/quietquill
cd quietquill
```

2. **Install dependencies:**

```bash
composer install
npm install && npm run dev
```

3. Set up environment:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure your database and run migrations:

```bash
php artisan migrate
```

5. tart the server:

```bash
php artisan serve
```

---

## 📦 Tech Stack
- Laravel 11
- Livewire
- SQLite
- TailwindCSS

## 💡 Inspiration
Built as a minimalist space to reflect. Sometimes the world is too loud.
Quiet Quill is for quiet minds with loud thoughts.

## 📜 License
The Quiet Quill is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
