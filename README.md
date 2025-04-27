# Cart-Service Setup

## Prerequisites

Before starting, ensure that you have the following installed on your system:

- **PHP 8.2** or later
- **MySQL 8.0** or later
- **Composer** (PHP dependency manager)

### Steps for setting up the project:

### 1. **Clone the Project**
- git clone https://github.com/mehedihasanahad/cart-service.git

### 1. **Create DB**
- CREATE DATABASE cart_service;

### 2. **Run the Project**
- composer install
- cp .env.example .env
- php artisan migrate
- php artisan db:seed
- php artisan serve

### 2. **Access the Application**
- http://localhost:8000

### 2. **User Credentials**
- admin user: admin@gmail.com
- customer user: customer@gmail.com
- password: 123456