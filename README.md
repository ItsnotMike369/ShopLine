# 🛍️ ShopLine — E-Commerce Web Application

ShopLine is a full-featured e-commerce web application built with **Laravel 12**. It provides a seamless shopping experience for customers and a powerful management dashboard for administrators. From product browsing and cart management to order placement and Cloudinary-powered image storage, ShopLine is designed to be clean, scalable, and easy to deploy.

---

## 📋 Table of Contents

- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Installation Guide](#-installation-guide)
- [Usage](#-usage)
- [Environment Variables](#-environment-variables)
- [Folder Structure](#-folder-structure)
- [Contributing](#-contributing)
- [License](#-license)

---

## ✨ Features

### 🛒 Customer Features
- **User Authentication** — Register, login, logout, email verification, and password reset
- **Social Login** — Sign in with Google or Facebook via Laravel Socialite
- **Product Browsing** — Browse products by category with search and filtering
- **Product Details** — View detailed product pages with images and descriptions
- **Shopping Cart** — Add, update, and remove items from the cart
- **Wishlist** — Save favourite products for later
- **Checkout** — Place orders with a streamlined checkout flow
- **Order History** — View past orders and their status from the account dashboard
- **Profile Management** — Update personal info, profile photo, and password

### 🔧 Admin Features
- **Admin Dashboard** — Overview of store activity and key metrics
- **Product Management** — Create, update, and delete products with Cloudinary image uploads
- **Order Management** — View and manage all customer orders
- **Customer Management** — Browse registered customer accounts
- **Payment Methods** — Configure available payment options
- **Store Settings** — Manage global store configuration

---

## 🧰 Tech Stack

| Layer | Technology |
|---|---|
| **Backend** | [Laravel 12](https://laravel.com) (PHP 8.2+) |
| **Frontend** | [Tailwind CSS v4](https://tailwindcss.com), [Alpine.js v3](https://alpinejs.dev) |
| **Templating** | Blade (Laravel) |
| **Database** | PostgreSQL |
| **Image Storage** | [Cloudinary](https://cloudinary.com) |
| **Authentication** | Laravel Breeze + [Laravel Socialite](https://laravel.com/docs/socialite) |
| **Build Tool** | [Vite](https://vitejs.dev) |
| **Testing** | [Pest PHP](https://pestphp.com) |
| **Deployment** | [Railway](https://railway.app) (Nixpacks) |

---

## 🚀 Installation Guide

### Prerequisites

Make sure you have the following installed on your machine:

- **PHP** >= 8.2
- **Composer** >= 2.x
- **Node.js** >= 18.x & **npm**
- **PostgreSQL** (running locally or a remote connection string)
- A **Cloudinary** account ([sign up free](https://cloudinary.com/users/register/free))

---

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/shopline.git
cd shopline
```

---

### 2. Install PHP Dependencies

```bash
composer install
```

---

### 3. Install Node Dependencies

```bash
npm install
```

---

### 4. Set Up the Environment File

Copy the example environment file and open it for editing:

```bash
cp .env.example .env
```

Then update the required values (see [Environment Variables](#-environment-variables) below).

---

### 5. Generate the Application Key

```bash
php artisan key:generate
```

---

### 6. Configure the Database

Ensure your PostgreSQL database is running, then create a new database (e.g. `shopline`) and update the `DB_*` values in your `.env` file. Once configured, run migrations and seed sample data:

```bash
php artisan migrate
php artisan db:seed
```

---

### 7. Link Storage

```bash
php artisan storage:link
```

---

### 8. Build Frontend Assets

For development (with hot reload):

```bash
npm run dev
```

For production:

```bash
npm run build
```

---

### 9. Start the Development Server

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser. 🎉

> **Tip:** You can run all services at once using the Composer dev script:
> ```bash
> composer run dev
> ```
> This concurrently starts the PHP server, queue worker, log watcher, and Vite dev server.

---

## 🖥️ Usage

### As a Customer

1. Navigate to the homepage and **browse products** or use the search bar.
2. Click on a product to view its detail page.
3. **Register** or **log in** (including via Google or Facebook) to proceed.
4. Add items to your **cart** or **wishlist**.
5. Go to **Checkout**, confirm your order details, and place your order.
6. View your order history and manage your profile from the **Account** page.

### As an Admin

1. Log in with an account that has `is_admin = true` in the database.
2. Access the **Admin Dashboard** at `/admin/dashboard`.
3. Manage **Products**, **Orders**, **Customers**, and **Payment Methods** from the sidebar.
4. Upload product images directly — they are stored and served via **Cloudinary**.

> **Creating an Admin Account:** After seeding the database, you can promote a user to admin via Tinker:
> ```bash
> php artisan tinker
> \App\Models\User::where('email', 'your@email.com')->update(['is_admin' => true]);
> ```

---

## 🔑 Environment Variables

The following variables must be set in your `.env` file before running the application:

### Application
```env
APP_NAME=ShopLine
APP_ENV=local          # local | production
APP_KEY=               # Generated by php artisan key:generate
APP_DEBUG=true         # Set to false in production
APP_URL=http://localhost
```

### Database (PostgreSQL)
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=shopline
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

### Cloudinary (Image Storage)
```env
CLOUDINARY_URL=cloudinary://API_KEY:API_SECRET@CLOUD_NAME
CLOUDINARY_CLOUD_NAME=your_cloud_name
CLOUDINARY_API_KEY=your_api_key
CLOUDINARY_API_SECRET=your_api_secret
CLOUDINARY_UPLOAD_PRESET=           # Optional
```

### Social Authentication (Optional)
```env
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"

FACEBOOK_APP_ID=your_facebook_app_id
FACEBOOK_APP_SECRET=your_facebook_app_secret
FACEBOOK_REDIRECT_URI="${APP_URL}/auth/facebook/callback"
```

### Mail
```env
MAIL_MAILER=log        # Use smtp in production
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@shopline.com"
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 📁 Folder Structure

```
shopline/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/              # Admin dashboard controllers
│   │   │   │   └── AdminController.php
│   │   │   ├── Auth/               # Authentication controllers
│   │   │   │   ├── RegisteredUserController.php
│   │   │   │   ├── AuthenticatedSessionController.php
│   │   │   │   ├── SocialAuthController.php
│   │   │   │   └── ...
│   │   │   ├── CartController.php
│   │   │   ├── CheckoutController.php
│   │   │   ├── ProductController.php
│   │   │   ├── ProfileController.php
│   │   │   ├── WishlistController.php
│   │   │   └── PaymentMethodController.php
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Product.php
│   │   ├── Category.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   └── PaymentMethod.php
│   └── Providers/
├── database/
│   ├── migrations/                 # All database schema migrations
│   ├── seeders/                    # Sample data seeders
│   └── factories/
├── public/                         # Web root (index.php, assets)
├── resources/
│   ├── views/
│   │   ├── admin/                  # Admin dashboard Blade views
│   │   ├── auth/                   # Login, register, password reset views
│   │   ├── components/             # Reusable Blade components
│   │   ├── layouts/                # App and guest layout files
│   │   ├── profile/                # Profile edit views
│   │   ├── shop.blade.php          # Product listing page
│   │   ├── product.blade.php       # Product detail page
│   │   ├── cart.blade.php          # Shopping cart
│   │   ├── checkout.blade.php      # Checkout page
│   │   └── welcome.blade.php       # Landing page
│   └── css / js                    # Frontend source files
├── routes/
│   ├── web.php                     # Web routes
│   └── auth.php                    # Authentication routes
├── storage/
├── tests/
├── .env.example                    # Environment variable template
├── composer.json
├── package.json
├── railway.toml                    # Railway deployment config
└── vite.config.js
```

---

## 🤝 Contributing

Contributions are welcome! To get started:

1. **Fork** the repository
2. **Create** a new feature branch:
   ```bash
   git checkout -b feature/your-feature-name
   ```
3. **Commit** your changes with a descriptive message:
   ```bash
   git commit -m "feat: add your feature description"
   ```
4. **Push** to your branch:
   ```bash
   git push origin feature/your-feature-name
   ```
5. **Open a Pull Request** and describe what you've changed

### Guidelines

- Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards for PHP
- Run the test suite before submitting:
  ```bash
  composer run test
  ```
- Use [Laravel Pint](https://laravel.com/docs/pint) for code formatting:
  ```bash
  ./vendor/bin/pint
  ```
- Keep PRs focused — one feature or fix per PR

---

## 📄 License

This project is open-sourced under the [MIT License](https://opensource.org/licenses/MIT).

---

<p align="center">Built with ❤️ using Laravel &amp; Tailwind CSS</p>
