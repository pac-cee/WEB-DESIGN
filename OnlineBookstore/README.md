# OnlineBookstore Web Application

## Overview
A full-featured online bookstore for students, teachers, admins, and individual users. Features registration, login, catalog browsing, book ordering, audio books, quizzes, school integration, user dashboards, and professional UI.

## Features
- User registration & login (secure, hashed passwords)
- Book catalog with ordering and audio options
- User dashboard with navigation
- Quizzes: take, submit, and review results
- Track reading progress and orders
- School dashboard for teachers/admins
- Admin/teacher features (student management, quiz results)
- Professional, responsive UI

## Directory Structure
- `config/` – Database connection
- `controllers/` – App logic (MVC)
- `models/` – Data models (Book, User, Order, etc.)
- `views/` – All user-facing pages (PHP)
- `assets/` – CSS, images, audio
- `setup.sql` – MySQL schema for all features

## Setup
1. Import `setup.sql` into your MySQL database (use DB name `bookapp`).
2. Update `config/db.php` with your DB credentials.
3. Place project in your web server's root (e.g., `htdocs` for XAMPP).
4. Access `index.php` to begin using the app.

## Security
- Passwords are hashed
- SQL injection is prevented via prepared statements
- Sessions are used for authentication

## Credits
Developed with ❤️ by [Your Name]
