# Deployment Guide

Follow the steps below to deploy the **Admin Panel – Company & Employee Management** project.

## 1. Clone the Repository

```bash
git clone <repository-url>
cd <project-folder>
```

## 2. Install Dependencies

Make sure **PHP, Composer, and MySQL** are installed.

```bash
composer install
```

## 3. Environment Configuration

Copy the environment file.

```bash
cp .env.example .env
```

Update the `.env` file with your database credentials.

Example:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY= KEY
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=admin_panel
# DB_USERNAME=root
# DB_PASSWORD=your_password
```

## 4. Generate Application Key

```bash
php artisan key:generate
```
## 5. Run Migrations

Create the required database tables.

```bash
php artisan migrate
```

## 6. Seed the Database

Seed the database with the admin user and employee records.

```bash
php artisan db:seed
```

This will create:

**Admin User**

Email:

```
admin@example.com
```

Password:

```
Monopoly@3455
```

## 8. Start the Application

For local deployment:

```bash
php artisan serve
```

Application will run at:

```
http://127.0.0.1:8000
```

## Production Deployment Notes

For production servers:

* Set `APP_DEBUG=false`
* Use **Apache or Nginx**
* Point the server root to the **public/** directory
* Configure **SSL (HTTPS)** for secure access