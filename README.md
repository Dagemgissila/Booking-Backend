# 🏨 Booking System – Laravel Project

A modern, clean, and fully functional Room/Hotel Booking System built with **Laravel 11**, **MySQL**, and optional **Tailwind/Bootstrap**.
Perfect for hotels, guest houses, hostels, apartments, or any reservation-based business.

---

## ✨ Features

* User registration & authentication
* Browse rooms with images, price, and details
* Real-time room availability
* Secure booking process
* Admin dashboard to manage:

  * Rooms
  * Bookings
  * Pricing
* Upload room image
* Database seeders included
* API-ready structure with Laravel Sanctum
* Role & permission system (Admin / User)

---

---

## 🛠️ Tech Stack

* **Laravel 10**
* **PHP 8.2+**
* **MySQL**
* **Composer & NPM**
* **Laravel Sanctum (API ready)**

---

# 🚀 Installation Guide

Follow these steps to set up the project locally.

---

## 1. Clone the Repository

```bash
git clone https://github.com/Dagemgissila/Booking-Backend.git
cd Booking-Backend
```

---

## 2. Install Dependencies

```bash
composer install

```

---

## 3. Environment Configuration

Copy the environment file:

```bash
cp .env.example .env
```

Update your `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=booking
DB_USERNAME=root
DB_PASSWORD=
```

---

## 4. Generate App Key & Run Migrations

```bash
php artisan key:generate
php artisan migrate:fresh --seed
```

### Default Admin Credentials

```
Email: admin@example.com
Password: password
```

---

## 5. Storage Link (for image uploads)

```bash
php artisan storage:link
```

---

## 6. Run the Application

```bash
php artisan serve
```

Api url:

```
http://127.0.0.1:8000/api
```

---


