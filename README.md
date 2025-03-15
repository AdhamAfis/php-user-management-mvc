# User Management System

A simple user management system built with PHP and SQLite, following the MVC architecture.

## Features

- User Registration
- Login & Authentication
- Session-based Access Control
- User Management (CRUD operations)
- RESTful API structure
- SQLite Database
- Bootstrap UI

## Requirements

- PHP 7.4 or higher
- SQLite3 extension for PHP
- Web server (Apache/Nginx)

## Installation

1. Clone the repository to your web server's document root:
```bash
git clone https://github.com/adhamafis/php-user-management-mvc.git
cd php-user-management-mvc
```

2. Make sure the SQLite database directory is writable:
```bash
chmod 777 database
```

3. Configure your web server to point to the `public` directory as the document root.

4. If using Apache, ensure the `.htaccess` file is properly configured:
```apache
RewriteEngine On
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.+)$ index.php [QSA,L]
```

## Project Structure

```
├── app/
│   ├── config/
│   │   └── Database.php
│   ├── controllers/
│   │   ├── AuthController.php
│   │   └── UserController.php
│   ├── middleware/
│   │   └── AuthMiddleware.php
│   ├── models/
│   │   └── User.php
│   └── views/
│       ├── dashboard.php
│       ├── login.php
│       ├── logout.php
│       └── register.php
├── public/
│   └── index.php
└── database/
    └── users.sqlite
```

## Usage

1. Access the application through your web browser
2. Register a new account
3. Log in with your credentials
4. Manage users through the dashboard

## Security Features

- Password hashing using PHP's built-in password_hash()
- Session-based authentication
- SQL injection prevention using prepared statements
- XSS prevention using htmlspecialchars()
- CSRF protection for forms

## License

MIT License


