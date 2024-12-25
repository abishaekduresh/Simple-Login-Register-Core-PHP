# Simple Login Register Project

Simple Login Register is a web application that manages user registrations and logins. This project includes a MySQL database for storing user data and features a simple user registration and login system.

## Database Setup

To set up the MySQL database for the project, run the following SQL commands to create the database and the necessary `users` table.

### 1. Create Database and Table

Run this SQL script to create the `simple_login_register` database and the `users` table:

```sql
CREATE DATABASE IF NOT EXISTS `simple_login_register` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `simple_login_register`;

-- Dumping structure for table simple_login_register.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

### 2. Database Structure

The database `simple_login_register` contains a single table called `users` with the following columns:

- **user_id** (INT) – Primary key, auto-incremented for each user.
- **full_name** (VARCHAR) – The full name of the user.
- **email** (VARCHAR) – User’s email (must be unique).
- **password** (VARCHAR) – Hashed password of the user.

## Project Setup

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/abishaekduresh/Simple-Login-Register-Core-PHP.git
   ```

2. Make sure to configure your database connection in the `config/db.php` file. You need to set the correct database username, password, and hostname.

   Example:

   ```php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "simple_login_register";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);

   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   ```

3. Run the web server and visit the application through your browser.

   Example using PHP's built-in server:

   ```bash
   php -S localhost:8000
   ```

4. Visit the registration and login pages to test the system:
   - Registration: `/register.php`
   - Login: `/login.php`

## Features

- **User Registration**: Users can create an account with their full name, email, and password.
- **User Login**: Registered users can log in with their email and password.
- **Database**: User data is securely stored in a MySQL database, with password hashing.
