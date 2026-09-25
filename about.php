<?php
session_start();

$isLoggedIn = isset($_SESSION["user_id"]);
$userName = $_SESSION["user_name"] ?? "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>About Us - Online Food Delivery</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #333;
        }

        .navbar {
            background: #ff6600;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 18px;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        .hero {
            background: #ff6600;
            color: white;
            text-align: center;
            padding: 60px 20px;
        }

        .hero h1 {
            font-size: 42px;
            margin: 0 0 15px;
        }

        .hero p {
            font-size: 18px;
        }

        .content {
            width: 90%;
            max-width: 1000px;
            margin: 40px auto;
        }

        .card {
            background: white;
            padding: 30px;
            margin-bottom: 25px;
            border-radius: 10px;
            box-shadow: 0 0 8px #ccc;
        }

        .card h2 {
            color: #ff6600;
            margin-top: 0;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(
                auto-fit,
                minmax(200px, 1fr)
            );
            gap: 20px;
        }

        .feature {
            background: white;
            padding: 25px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 8px #ccc;
        }

        .feature h3 {
            color: #ff6600;
        }

        .footer {
            background: #222;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }
    </style>
</head>

<body>

<div class="navbar">

    <div class="logo">
        Online Food Delivery
    </div>

    <div class="nav-links">

        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="menu.php">Menu</a>

        <?php if ($isLoggedIn): ?>

            <a href="cart.php">Cart</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>

        <?php else: ?>

            <a href="register.php">Register</a>
            <a href="login.php">Login</a>

        <?php endif; ?>

    </div>

</div>


<section class="hero">

    <h1>About Our Food Delivery</h1>

    <p>
        Delicious food, easy ordering, and convenient delivery.
    </p>

</section>


<div class="content">

    <div class="card">

        <h2>Who We Are</h2>

        <p>
            Online Food Delivery is a web-based food ordering system
            that allows customers to browse food items, add products
            to their cart, and place orders online.
        </p>

        <p>
            Our system makes food ordering simple, fast, and convenient.
            Customers can create an account, log in securely, select
            their favorite food, and complete their order.
        </p>

    </div>


    <div class="card">

        <h2>Our Mission</h2>

        <p>
            Our mission is to provide a simple and user-friendly
            online food ordering experience where customers can
            easily find and order their favorite meals.
        </p>

    </div>


    <div class="card">

        <h2>What We Provide</h2>

        <div class="features">

            <div class="feature">
                <h3>🍕 Food Menu</h3>
                <p>
                    Browse different food items and prices.
                </p>
            </div>

            <div class="feature">
                <h3>🛒 Shopping Cart</h3>
                <p>
                    Add your favorite food and manage quantities.
                </p>
            </div>

            <div class="feature">
                <h3>📦 Easy Ordering</h3>
                <p>
                    Place orders quickly through the checkout page.
                </p>
            </div>

            <div class="feature">
                <h3>🔐 Secure Login</h3>
                <p>
                    Register and log in using your personal account.
                </p>
            </div>

        </div>

    </div>

</div>


<div class="footer">

    <p>
        &copy; 2026 Online Food Delivery. All rights reserved.
    </p>

</div>

</body>
</html>