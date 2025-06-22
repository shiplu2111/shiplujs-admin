# 🚀 ShipluJS Admin Panel

![Laravel](https://img.shields.io/badge/Laravel-10.x-red)
![License](https://img.shields.io/badge/license-MIT-blue.svg)
![Status](https://img.shields.io/badge/status-active-brightgreen)

A powerful and customizable Laravel Admin Panel built for internal dashboards and content management. This project includes user authentication, database seeding, and an organized structure to jumpstart your next admin solution.

---

## 📑 Table of Contents

- [Features](#✨-features)
- [Tech Stack](#🛠-tech-stack)
- [Installation](#📦-installation)
- [Usage](#▶️-usage)
- [Login Credentials](#🔐-login-credentials)
- [Screenshots](#🖼️-screenshots)
- [Contact](#📩-contact)
- [License](#📝-license)

---

## ✨ Features

- Laravel 10+
- Admin authentication
- Role-based access control *(optional)*
- Responsive UI with Filament
- Database migration & seeders
- Secure environment config
- File storage symlink
- Easy local setup

---

## 🛠 Tech Stack

- Laravel 10.x (PHP 8.1+)
- Filament PHP 3.x

---

## 📦 Installation

> Follow these steps to run the project locally:

### Step 1: Clone the Repository
```bash
git clone https://github.com/shiplu2111/shiplujs-admin.git
```

### Step 2: Navigate to the Project
```bash
cd shiplujs-admin
```
### Step 3: Copy Environment File
```bash
cp .env.example .env
```

### Step 4: Configure .env File
```ini
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Step 5: Install Dependencies
```bash
composer install
```

### Step 6: Generate Application Key
```bash
php artisan key:generate
```

### Step 7: Run Migrations and Seeders
```bash
php artisan migrate:fresh --seed
```

### Step 8: Create Storage Symlink
```bash
php artisan storage:link
```


### Step 9: Serve the Application
```bash
php artisan serve
```

### Step 10: Open in Browser
```arduino
http://127.0.0.1:8000/admin
```

🔐 Login Credentials
Use the following credentials to log into the admin panel:

Email: me@shiplujs.com

Password: password


📩 Contact
For support, customization, or business inquiries, feel free to reach out:

Email: me@shiplujs.com

GitHub: @shiplu2111
