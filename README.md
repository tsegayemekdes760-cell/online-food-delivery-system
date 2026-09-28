Online Food Delivery System

Project Overview

The Online Food Delivery System is a PHP/MySQL web application
developed as an individual Web Programming assignment. It allows
customers to register, sign in, browse food, add items to a shopping
cart, place orders, and view order history. An administrative order page
allows orders to be monitored and their status to be changed.

Main Features

Home/landing page

About page with student information

Food menu with food images and prices

User registration

Secure user login using PHP sessions

Logout/session handling

Shopping cart

Checkout and order placement

Customer order history/dashboard

Admin order management

Order status updates: Pending, Preparing, Delivered

Contact form

MySQL/MariaDB database

Responsive CSS layout

Client-side and server-side validation

Git/GitHub version control

Technologies

HTML5

CSS3

JavaScript

PHP 8+

MySQL/MariaDB

XAMPP

Git/GitHub

Project Structure

online-food-delivery/
├── index.php
├── about.php
├── menu.php
├── cart.php
├── checkout.php
├── contact.php
├── register.php
├── login.php
├── dashboard.php
├── logout.php
├── admin_orders.php
├── update_order.php
├── db.php
├── online_food_delivery.sql
├── README.md
└── image/
    ├── pizza.jpg
    ├── burger.jpg
    ├── pasta.jpg
    ├── chicken.jpg
    └── fries.jpg

Database

Database name: online_food_delivery

The database supports users, food products, orders, order items, and
contact-message functionality used by the application.

The SQL export is included as online_food_delivery.sql.

Local Installation with XAMPP

1. Start XAMPP

Start: - Apache - MySQL

2. Copy the project

Place the project folder in:

C:\xampp\htdocs\online-food-delivery

3. Create/import the database

Open:

http://localhost:8080/phpmyadmin

Create a database named:

online_food_delivery

Import:

online_food_delivery.sql

4. Database connection

The connection is configured in db.php.

Default XAMPP configuration: - Host: localhost - Username: root -
Password: empty - Database: online_food_delivery

5. Run the project

Open:

http://localhost:8080/online-food-delivery/

System Workflow

Customer registers through Register.

Customer signs in through Login.

Customer opens Menu and selects food.

Selected food is stored in the session cart.

Customer reviews the cart and opens Checkout.

Checkout creates an order and its order items in MySQL.

The cart is cleared after successful order placement.

Customer views the order from Dashboard → My Orders.

Admin updates the order from Pending to Preparing or
Delivered.

The updated status appears in the customer's dashboard.

Security and Validation

Passwords are handled using PHP password hashing in the
authentication workflow.

PHP sessions are used to maintain logged-in users.

Prepared statements are used for database queries where applicable.

Server-side validation is used for important form processing.

Client-side validation can improve form usability.

Database credentials are kept in db.php.

GitHub

Repository:
https://github.com/tsegayemekdes760-cell/online-food-delivery-system

Student Information

Full Name: Mekdes Tsegaye

ID Number: MECS/045/16
Department: Cs

Assignment

Course: CoSc3091 -- Web Programming
Project: Online Food Delivery System
Type: Individual Assignment I

Test Account

For evaluation, create a test account using the Register page. Do not
publish a real personal password in this README.