# Tour Explorer Tanzania 🗺️

A comprehensive travel exploration platform built with CodeIgniter 4 for discovering and booking tours in Tanzania.

## What is CodeIgniter 4?

CodeIgniter is a lightweight, fast, flexible, and secure PHP full-stack web framework. More information can be found on the [official site](https://codeigniter.com).

## Features

- **User Authentication**: Secure login and registration system
- **Tour Management**: Browse and book a variety of tours
- **Admin Dashboard**: Manage tours, users, and bookings
- **Responsive Design**: Accessible on all devices
- **Booking System**: Simple tour reservation process

## Prerequisites

### Server Requirements

- **PHP 8.1 or higher** (Required)
- **Composer** (PHP dependency manager)
- **MySQL 5.7 or higher** or **MariaDB**
- **Web server** (Apache/Nginx with mod_rewrite)

### Required PHP Extensions

Ensure the following extensions are enabled:
- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- json (enabled by default)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) for MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) for CURL requests

> ⚠️ **Warning**: 
> - PHP 7.4 reached end of life on November 28, 2022
> - PHP 8.0 reached end of life on November 26, 2023  
> - PHP 8.1 end of life: December 31, 2025
> 
> **Always use supported PHP versions for security.**

## Installation Guide

### Step 1: Clone and Install Dependencies

# Clone the repository
git clone <your-repository-url>
cd tour-web

# Install PHP dependencies
composer install
### Step 2: Environment Configuration
Copy the environment file:

'''bash'''
cp env .env
Edit the .env file with your configuration:

#ini

## App Configuration
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080'

## Database Configuration
database.default.hostname = localhost
database.default.database = tour_explorer_db
database.default.username = your_username
database.default.password = your_password
database.default.DBDriver = MySQLi
Step 3: Database Setup
Create your database:

sql

CREATE DATABASE tour_explorer_db;
Run database migrations:

bash

php spark migrate
Seed with initial data:

bash

php spark db:seed MythAuthSeeder

----------
### Step 4: Web Server Configuration
Important Security Note
index.php has been moved to the public folder for enhanced security. Configure your web server to point to the public folder, not the project root.

Apache Configuration (.htaccess)
The public/.htaccess file should contain:

------
apache

RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]
Virtual Host Example (Apache)
apache

-----
<VirtualHost *:80>
    ServerName tourexplorer.test
    DocumentRoot "/path/to/tour-web/public"
    <Directory "/path/to/tour-web/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

-----
Nginx Configuration
nginx

server {
    listen 80;
    server_name tourexplorer.test;
    root /path/to/tour-web/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
    }
}

------
### Step 5: Development Server
For quick testing, use PHP's built-in server:

bash

php spark serve
Visit: http://localhost:8080

Default Login Credentials
After seeding, use these credentials:

Admin Account
Email: admin@tourexplorer.com
Password: admin123
Access: Full administrative privileges
User Account
Email: user@tourexplorer.com
Password: user123
Access: Standard user features

-----
Project Structure
axapta

tour-web/
├── app/                    # Application code
│   ├── Controllers/       # Application controllers
│   ├── Models/            # Database models
│   ├── Views/             # Template files
│   ├── Database/          # Migrations and seeds
│   └── Config/            # Configuration files
├── public/                 # Web root (point server here)
│   ├── css/               # Stylesheets
│   ├── js/                # JavaScript files
│   ├── uploads/           # File uploads
│   └── index.php          # Front controller
├── writable/              # Logs, cache, sessions
└── vendor/                # Composer dependencies
Database Management
Migrations
bash

# Check migration status
php spark migrate:status

# Run migrations
php spark migrate

# Rollback last migration
php spark migrate:rollback

# Create new migration
php spark make:migration CreateToursTable
Seeding
bash

# Run main seeder
php spark db:seed MythAuthSeeder

# Run all seeders
php spark db:seed --all

# Create new seeder
php spark make:seeder TourSeeder
Common Commands
Development
bash

# Start development server
php spark serve

# Clear cache
php spark cache:clear

# List all routes
php spark routes

# Help with commands
php spark help
Maintenance
bash

# Set production environment
# Edit .env: CI_ENVIRONMENT = production

# Optimize for production
php spark optimize

# Install without dev dependencies
composer install --no-dev --optimize-autoloader
Troubleshooting
Common Issues
404 Errors

Ensure the web server points to the public folder
Check if mod_rewrite is enabled (Apache)
Verify the .htaccess file exists in the public folder
Database Connection Issues

Verify credentials in the .env file
Ensure the database server is running
Check if the database exists
Permission Errors

bash

chmod -R 755 writable/
chmod 755 public/uploads/
Seeder Errors

bash

# Reset and reseed
php spark db:seed MythAuthSeeder --force
Debug Mode
For development, enable debug mode in the .env file:

ini

CI_ENVIRONMENT = development
Check logs in writable/logs/ for detailed error information.

Production Deployment
Update environment:

ini

CI_ENVIRONMENT = production
app.baseURL = 'https://yourdomain.com'
Optimize performance:

bash

composer install --no-dev --optimize-autoloader
php spark optimize
Set secure permissions:

bash

chmod -R 755 writable/
chmod 644 .env
Configure your web server to point to the public directory.

Support
Documentation: CodeIgniter 4 User Guide
Forum: CodeIgniter Forum
Issues: Check GitHub issues for known bugs
Contributing
Fork the repository
Create a feature branch
Commit your changes
Push to the branch
Create a Pull Request\

------------
License
This project is licensed under the MIT License.

----------------------------------------
Happy Exploring Tanzania! 🎉🏔️
