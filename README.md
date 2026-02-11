# 📧 Avolio Squad – Email Application (Laravel)

This project is a simple application built with **Laravel** that collects basic user information, sends an email to that user, and logs both the user data and the sent emails into a database.

The main goal is to demonstrate backend development best practices with PHP, usage of a relational database, email sending, logging, and clean code organization following industry standards.

---

## 🧰 Main technologies and tools used

### 🔹 Laravel

PHP framework used to speed up development while enforcing the MVC pattern, security, and maintainability.

Key Laravel features used in this project:

* MVC (Model–View–Controller)
* Eloquent ORM
* Database Migrations
* Request validation
* Logging system
* Mail system

---

### 🔹 MySQL

Relational database used to persist:

* User profile data (name and email)
* History of sent emails

MySQL was chosen to better represent a real-world production environment, as it is widely used in PHP applications.

---

### 🔹 Laravel Mail (Email Sending)

Laravel provides a built-in mail system that abstracts SMTP and third-party providers.

For this project, the **`log` mail driver** is used, which:

* Does not send real emails
* Writes the full email content to a log file
* Avoids external service dependencies

📁 Log file location:

```
storage/logs/laravel.log
```

This approach is ideal for **technical challenges and local development**.

---

### 🔹 Logging System

Laravel uses **Monolog** internally to handle application logs.

In this project, logging is used to:

* Record sent emails (via the `log` mail driver)
* Assist with debugging and validation of the email flow

---

## 🗄️ Database structure

### `users` table

Stores basic user profile information.

Main fields:

* `id`
* `name`
* `email`
* `created_at`

### `email_logs` table

Stores the history of sent emails.

Main fields:

* `id`
* `user_id`
* `content`
* `sent_at`

Relationship:

* One user can have many sent emails

---

## ⚙️ Step-by-step setup

### 1️⃣ Clone the repository

```bash
git clone <repository-url>
cd avolio-email-app
```

---

### 2️⃣ Install dependencies

```bash
composer install
```

---

### 3️⃣ Environment configuration

Copy the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

---

### 4️⃣ Database configuration (MySQL)

Create the database:

```sql
CREATE DATABASE avolio_email_app
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
```

Update the `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=avolio_email_app
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

---

### 5️⃣ Email configuration (log mode)

In the `.env` file:

```env
MAIL_MAILER=log
MAIL_FROM_ADDRESS=test@example.com
MAIL_FROM_NAME="Avolio Email App"
```

---

### 6️⃣ Run migrations

```bash
php artisan migrate
```

---

### 7️⃣ Start the development server

```bash
php artisan serve
```

Access the application in your browser:

```
http://127.0.0.1:8000
```

---

## 🧪 How to use the application

1. Fill in the form with:

   * Name
   * Email
   * Phone number (optional)
   * Email content

2. Click **Send**

3. The system will:

   * Save the user in the database
   * Log the sent email in the database
   * Write the email content to the log file

4. The list of sent emails will be displayed below the form

---

## 📄 How to verify sent emails

Open the following file:

```
storage/logs/laravel.log
```

You will find the full email content, including:

* Recipient address
* Subject
* Email body

---

## 🎯 Final notes

* Using the `log` mail driver allows email testing without external dependencies
* The same codebase can easily be adapted to SMTP or third-party providers such as Mailtrap, Amazon SES, or SendGrid
* The project follows clean code principles and keeps the implementation simple and clear

---

## 🚀 Possible future improvements

* Use of `Mailable` classes
* Advanced validations
* Automated tests
* Pagination for the email list
* Dockerized development environment

---

Developed for the **Avolio Squad Technical Challenge**.
