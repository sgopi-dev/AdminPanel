# Deployment Guide

Follow the steps below to deploy the **Admin Panel – Company & Employee Management** project.


# 1. Clone the Repository

```bash
git clone https://github.com/sgopi-dev/AdminPanel.git
cd AdminPanel
````

# 2. Install Backend Dependencies

Make sure **PHP, Composer, and Node.js** are installed.

```bash
composer install
```

# 3. Environment Configuration

Copy the environment file:

```bash
cp .env.example .env
```

Update the `.env` file.

Example configuration:

```env
APP_NAME=AdminPanel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite
```

# 4. Generate Application Key

```bash
php artisan key:generate
```

# 5. Database Setup (SQLite)

This project uses **SQLite** for simplicity.

Create the SQLite database file inside the **database folder**.

### Linux / Mac

```bash
touch database/database.sqlite
```

### Windows (PowerShell)

```powershell
New-Item database/database.sqlite
```

# 6. Install Frontend Dependencies

Install Node modules and build assets.

```bash
npm install
npm run build
```

# 7. Create Storage Link

This allows uploaded images (company logos) to be accessible from the browser.

```bash
php artisan storage:link
```

# 8. Run Migrations

Create the database tables.

```bash
php artisan migrate
```

# 9. Seed the Database

Seed the database with admin user and employee data.

```bash
php artisan db:seed
```

This will create the **Admin User**.

Email

```
admin@example.com
```

Password

```
Monopoly@3455
```

# 10. Start the Application

Run the development server.

```bash
php artisan serve
```

Application will run at:

```
http://127.0.0.1:8000
```

# Production Deployment Notes

For production environments:

* Set `APP_ENV=production`
* Set `APP_DEBUG=false`
* Run:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

* Use **Apache or Nginx**
* Set the web root to the **public/** directory
* Enable **HTTPS (SSL)** for secure access