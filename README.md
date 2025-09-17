# Sales Management Module

A simple, yet powerful sales management application built with the Laravel framework. This module allows for tracking sales, managing products, and viewing sales data with filtering capabilities.

## Overview

This project provides a web-based interface to handle common sales management tasks. It's designed to be a starting point for a more extensive CRM or ERP system. It features standard CRUD operations for products and sales, a soft-delete mechanism with a trash bin for data recovery, and a dynamic sales filtering system.

## Key Features

-   **Product Management:** Full CRUD (Create, Read, Update, Delete) functionality for products.
-   **Sales Tracking:** Create and view detailed sales records, including customer information, products sold, quantities, and totals.
-   **Dynamic Sales Filtering:** Filter sales records by customer name, product name, or a specific date range.
-   **Soft Deletes & Trash Bin:** Deleted products or sales are soft-deleted and can be viewed and restored from a trash bin.
-   **Notes:** Add notes to individual sales for additional context.
-   **AJAX Operations:** Deletions are handled smoothly using AJAX, preventing full page reloads.

## Technology Stack

This project is built using a standard and robust set of technologies:

-   **Backend:** PHP 8+ / Laravel 11
-   **Frontend:**
    -   HTML5 & CSS3
    -   Bootstrap 4
    -   JavaScript (ES6+)
    -   jQuery (for some Bootstrap components)
    -   Vite for asset compilation
-   **Database:** Compatible with MySQL, PostgreSQL, SQLite.

## Setup and Installation

Follow these steps to get the project running on your local machine.

**1. Clone the Repository**
```bash
git clone https://github.com/sagorsarker04/sales-management-module.git
cd sales-management-module
```

**2. Install Dependencies**
Install both PHP and JavaScript dependencies.
```bash
# Install Composer (PHP) dependencies
composer install

# Install NPM (JavaScript) dependencies
npm install
```

**3. Environment Configuration**
Create your environment file and generate the application key.
```bash
# Create a copy of the example .env file
cp .env.example .env

# Generate a new application key
php artisan key:generate
```

**4. Configure Database**
Open the `.env` file and update the `DB_*` variables with your database credentials.
```
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=sales
DB_USERNAME=postgres
DB_PASSWORD=123
```

**5. Run Database Migrations & Seeding**
Create the database schema and populate it with initial data.
```bash
# Run migrations to create tables
php artisan migrate:fresh --seed
```

**6. Build Frontend Assets**
Compile the JavaScript and CSS files.
```bash
# Run the development server and watch for changes
npm run dev

# Or, build for production
npm run build
```

**7. Serve the Application**
Start the local development server.
```bash
php artisan serve
```
The application will be available at `http://127.0.0.1:8000`.

## Usage

-   Navigate to `/products` to manage products.
-   Navigate to `/sales` to view and filter sales.
-   Click the "Create Sale" button to record a new sale.
-   Use the filter form on the sales index page to narrow down results.
-   Deleted items can be found in the `/trash` section.