# 📘 Laravel X/Twitter Clone - REST API & Frontend

A complete full-stack Twitter/X-style microblogging application built using **Laravel API with Sanctum** and a simple **Blade + JavaScript frontend**. The application lets users register, log in, update profiles (with pictures) and create short posts (like tweets).

This project is beginner-friendly, thoroughly documented and designed with best practices including API testing, repository pattern and proper validation.

---

## ✨ Core Features

- 🛡️ API authentication using Laravel Sanctum
- 📝 User registration and login (via API)
- 👤 View and update user profile with image upload
- 🧵 Post tweets (up to 280 characters)
- 📄 Public profile and feed viewing
- 📦 Repository pattern for cleaner architecture
- ✅ Full feature tests for all API endpoints

---

## 🧰 Tech Stack

| Layer       | Technology                        |
|-------------|------------------------------------|
| Backend     | Laravel 10                        |
| Auth        | Sanctum (token-based)             |
| Frontend    | Blade, Bootstrap 5, Vanilla JS    |
| Storage     | Laravel Filesystem (public disk)  |
| Testing     | PHPUnit (Feature Tests)           |

---

## 🚀 Getting Started (Step-by-Step)

> 📌 **Note**: These instructions assume you're using [XAMPP](https://www.apachefriends.org/) or any PHP server with Composer.

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/x-twitter-clone.git
cd x-twitter-clone
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Set Up Environment Variables
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database
In your `.env` file, update:
```env
DB_DATABASE=twitter_clone
DB_USERNAME=root
DB_PASSWORD=
```
Create the database manually or via CLI.

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Link Storage
```bash
php artisan storage:link
```
This will make uploaded profile images accessible.

### 7. Start Development Server
```bash
php artisan serve --port=8001
```
Visit `http://localhost:8001` to view the app.

> ✅ You’re now ready to use the app!

---

## 🔌 API Endpoints (Sanctum)

| Method | Endpoint                    | Auth  | Description                          |
|--------|-----------------------------|-------|--------------------------------------|
| POST   | `/api/register`             | ❌    | Register a new user                  |
| POST   | `/api/login`                | ❌    | Log in and get token                 |
| POST   | `/api/logout`               | ✅    | Log out and invalidate token         |
| GET    | `/api/profile`              | ✅    | Fetch authenticated user's profile   |
| POST   | `/api/profile/update`       | ✅    | Update name, email, avatar           |
| POST   | `/api/posts`                | ✅    | Create a post (max 280 chars)        |
| GET    | `/api/users/posts`          | ✅    | List current user's posts            |
| GET    | `/api/users/{id}/profile`   | ❌    | Public profile info by ID            |              |

> 🔐 Authenticated routes require `Authorization: Bearer <token>` header.

---

## 🧪 Running Tests

We’ve included a full suite of **feature tests** for authentication and profile handling.

### ✔️ Enable GD Extension (for image tests)
- Open `php.ini`
- Find: `;extension=gd`
- Remove semicolon: `extension=gd`
- Restart Apache

### Run Tests
```bash
php artisan test
```

### Covered
- Login + logout via token
- Registration (valid + invalid)
- Profile fetch + update (with picture)
- Public profile access

---

## 📁 Project Structure

```
resources/views/
  ├── auth/              # Login/Register views
  ├── dashboard.blade.php
  ├── profile/index.blade.php
  ├── profile/show.blade.php
public/js/
  ├── login.js
  ├── register.js
  ├── dashboard.js
  ├── profile.js
app/Repositories/        # Interfaces + implementations
routes/api.php           # All API endpoints
routes/web.php           # Blade frontend routes
```

---

## 🙋 FAQ

**Q: How do I update my profile picture?**  
Visit `/profile`, select an image and click update. It'll upload and save the image to `/storage/profile_pictures`.

**Q: Where are the posts stored?**  
Posts are saved in the `posts` table. They are user-specific and appear in `/dashboard` and `/profile/{id}`.

**Q: Why does image upload fail during tests?**  
You need to enable the GD extension in your PHP config to allow fake image generation for test assertions.

---

## 👨‍💻 Author

**Luqman Ud Din**  
📧 luqmanuddin734@gmail.com  

