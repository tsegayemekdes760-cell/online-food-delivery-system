# 🍔 Online Food Delivery System

A complete web-based **Online Food Delivery System** developed as an individual web development course project using **HTML, CSS, JavaScript, PHP, and MySQL**.

The system allows users to register, log in, browse available foods, add items to a shopping cart, place orders, and view their order history.

---

## 📌 Project Overview

The **Online Food Delivery System** is designed to provide a simple and user-friendly platform for ordering food online.

Users can create an account, securely log in, browse the food menu, add food items to their cart, review their order, place an order, and view previously placed orders.

This project demonstrates the integration of:

* Front-end web development
* Client-side scripting
* Server-side programming
* Database management
* User authentication
* Session management
* Shopping cart functionality
* Order management
* Git and GitHub version control

---

## 🎯 Project Objectives

The main objectives of this project are to:

1. Develop a complete multi-page functional website.
2. Apply HTML for semantic webpage structure.
3. Use CSS to create a clean and responsive user interface.
4. Use JavaScript for client-side interaction and form validation.
5. Use PHP for server-side processing.
6. Connect PHP with a MySQL relational database.
7. Implement user registration and login authentication.
8. Use PHP sessions to manage logged-in users and shopping carts.
9. Implement a functional food ordering system.
10. Store customer orders and order items in a relational database.
11. Practice Git and GitHub for source-code version control.

---

## 🛠️ Technologies Used

| Technology | Purpose                                        |
| ---------- | ---------------------------------------------- |
| HTML5      | Webpage structure and semantic markup          |
| CSS3       | Styling, layout, and responsive design         |
| JavaScript | Client-side interaction and validation         |
| PHP        | Server-side programming and business logic     |
| MySQL      | Relational database management                 |
| XAMPP      | Local Apache and MySQL development environment |
| Git        | Version control                                |
| GitHub     | Source-code hosting and project repository     |

---

## ✨ Main Features

### 👤 User Authentication

* User registration
* User login
* User logout
* Session-based authentication
* Protected user dashboard
* User-specific order history

### 🍕 Food Menu

Users can browse available food items, including:

* Pizza
* Burger
* Pasta
* Chicken
* French Fries

Each food item contains:

* Food name
* Description
* Price
* Food image
* Add to Cart option

### 🛒 Shopping Cart

The shopping cart allows users to:

* Add food items
* View selected items
* View quantity
* Calculate item subtotal
* Calculate total order amount
* Remove items from the cart

### 📦 Order Management

Users can:

* Review their order before checkout
* Place an order
* Store order information in the database
* View previous orders
* View order total
* View order status
* View order date

### 📞 Contact Page

The website provides contact information and a contact form where users can send messages.

### ℹ️ About Page

The About page provides information about the system, its purpose, mission, and services.

---

## 📄 Website Pages

The project contains the following main pages:

| Page            | Description                  |
| --------------- | ---------------------------- |
| `index.php`     | Home page                    |
| `about.php`     | About the system             |
| `menu.php`      | Food menu                    |
| `cart.php`      | Shopping cart                |
| `checkout.php`  | Checkout and order placement |
| `contact.php`   | Contact page                 |
| `register.php`  | User registration            |
| `login.php`     | User login                   |
| `dashboard.php` | User dashboard               |
| `orders.php`    | User order history           |
| `logout.php`    | Logout functionality         |

---

## 🗂️ Project Structure

```text
online-food-delivery/
│
├── image/
│
├── about.php
├── add_to_cart.php
├── cart.php
├── checkout.php
├── contact.php
├── dashboard.php
├── db.php
├── index.php
├── login.php
├── logout.php
├── menu.php
├── orders.php
├── register.php
├── remove_from_cart.php
├── README.md
│
└── ...
```

---

## 🗄️ Database

The project uses a MySQL database named:

```text
online_food_delivery
```

### Main Database Tables

#### `users`

Stores registered user information.

Example fields:

```text
id
name
email
password
created_at
```

#### `foods`

Stores available food products.

Example fields:

```text
id
name
description
price
image
created_at
```

#### `orders`

Stores customer order information.

Example fields:

```text
id
user_id
total_amount
status
created_at
```

#### `order_items`

Stores individual food items belonging to each order.

Example fields:

```text
id
order_id
food_id
quantity
price
```

### Database Relationships

```text
users
  │
  │ 1
  │
  │
  │ many
orders
  │
  │ 1
  │
  │
  │ many
order_items
  │
  │ many
  │
  │ 1
foods
```

---

## 🔐 User Authentication Flow

The authentication process works as follows:

```text
Register
   ↓
Login
   ↓
Session Created
   ↓
Dashboard
   ↓
Browse Menu
   ↓
Add Food to Cart
   ↓
Checkout
   ↓
Place Order
   ↓
Order Saved in Database
   ↓
View Orders
```

---

## 🛒 Food Ordering Flow

```text
User
 │
 ├── Register / Login
 │
 ├── Browse Food Menu
 │
 ├── Add Food to Cart
 │
 ├── View Cart
 │
 ├── Checkout
 │
 ├── Place Order
 │
 └── View Order History
```

---

## 💻 Requirements

To run this project locally, you need:

* Windows, Linux, or macOS
* XAMPP
* Apache
* MySQL
* PHP
* Web browser
* Git (optional, for version control)

---

## ⚙️ Installation and Setup

### Step 1: Install XAMPP

Download and install XAMPP.

Start:

```text
Apache
MySQL
```

from the XAMPP Control Panel.

---

### Step 2: Copy the Project

Place the project folder inside the XAMPP `htdocs` directory.

Example:

```text
C:\xampp\htdocs\online-food-delivery
```

---

### Step 3: Create the Database

Open phpMyAdmin:

```text
http://localhost:8080/phpmyadmin/
```

Create a database named:

```text
online_food_delivery
```

Then create/import the required tables:

```text
users
foods
orders
order_items
```

---

### Step 4: Configure Database Connection

Open:

```text
db.php
```

Configure the database connection according to your local MySQL settings.

Example:

```php
<?php

$conn = new mysqli(
    "localhost",
    "root",
    "",
    "online_food_delivery"
);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
```

---

### Step 5: Run the Project

Open the browser and visit:

```text
http://localhost:8080/online-food-delivery/
```

The home page should appear.

---

## 🧪 Testing

The following functionality has been implemented and tested:

* [x] User registration
* [x] User login
* [x] User logout
* [x] Dashboard
* [x] Food menu
* [x] Add to cart
* [x] View cart
* [x] Remove from cart
* [x] Checkout
* [x] Place order
* [x] Save order to database
* [x] Save order items to database
* [x] View order history
* [x] About page
* [x] Contact page

---

## 🔒 Security Considerations

The project applies several basic web security practices, including:

* PHP sessions for authentication
* Prepared SQL statements
* Server-side validation
* Client-side form validation
* Password hashing for user passwords
* Protection of authenticated pages
* HTML output escaping where appropriate

---

## 📱 Responsive Design

The website is designed to provide a user-friendly interface across different screen sizes, including:

* Desktop computers
* Laptops
* Tablets
* Mobile devices

CSS media queries can be used to adjust layouts for different screen sizes.

---

## 🔄 Git and GitHub

Git is used for version control and GitHub is used to host the project source code.

Repository:

**Online Food Delivery System**

```text
https://github.com/tsegayemekdes760-cell/online-food-delivery-system
```

Basic Git workflow:

```bash
git add .
git commit -m "Update project"
git push
```

---

## 🎓 Course Learning Outcomes

This project demonstrates the following learning outcomes:

### HTML

* Semantic HTML structure
* Multi-page website development
* Forms
* Navigation
* Tables and content organization

### CSS

* Page styling
* Layout design
* Responsive design
* Navigation styling
* Form and button styling

### JavaScript

* Client-side interaction
* DOM manipulation
* Form validation
* User interface behavior

### PHP

* Server-side processing
* Sessions
* Authentication
* Form processing
* Database connectivity
* CRUD-related operations

### MySQL

* Relational database design
* Tables
* Primary keys
* Foreign keys
* Relationships
* SQL queries

### Git/GitHub

* Repository initialization
* Commits
* Branch management
* Remote repository
* GitHub push and version control

---

## 🚀 Future Improvements

Possible future improvements include:

* Admin dashboard
* Admin food management
* Order status management
* Online payment integration
* Food search functionality
* Food categories
* User profile management
* Email notifications
* Restaurant management
* Delivery tracking
* Improved responsive mobile interface

---

## 👩‍💻 Author

**Mekdes Tsegaye**

Individual Web Development Course Project

---

## 📜 License

This project was developed for educational and academic purposes.

---

## 🙏 Acknowledgment

This project was developed as part of a web development course to demonstrate practical knowledge of:

**HTML + CSS + JavaScript + PHP + MySQL + Git/GitHub**

Thank you for reviewing this project.
