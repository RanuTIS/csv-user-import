# Laravel CSV User Import

This project demonstrates how to import user data from a CSV file into a MySQL database using Laravel.  
It includes data validation, secure password hashing, and proper error handling.

---

## 🚀 Features

- Read users from a CSV file
- Validate email format
- Validate username (alphanumeric, 3–20 characters)
- Secure password hashing using bcrypt
- Store valid records in MySQL database
- Log invalid data and database errors
- Uses PDO via Laravel database layer

---

## 🛠️ Tech Stack

- Laravel12
- PHP 8+
- MySQL
- bcrypt (Laravel Hash)

---

## 📁 CSV File Format

The CSV file should have the following structure:

```csv
user_id,username,email,password
1,john123,john@example.com,secret123
2,alice01,alice@example.com,password456

```
------

## **Commands to Install and Run**
- Install the composer with 'composer install' command.
- Setup env file and database credentials.
- Then run 'php artisan migrate' command to migrate table schema.
- Add users.csv file at root path of laravel where app dir exist. 
- Then run the "php artisan import:users users.csv" command to import users from csv file.
- Check the log file for error and warning handling.

