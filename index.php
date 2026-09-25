```php
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

    <title>Online Food Delivery</title>

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
            flex-wrap: wrap;
        }

        .logo {
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        .hero {
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 50px 20px;

            background:
                linear-gradient(
                    rgba(255, 102, 0, 0.82),
                    rgba(255, 102, 0, 0.82)
                ),
                url("images/pizza.jpg") center/cover no-repeat;
        }

        .hero-content {
            color: white;
            max-width: 700px;
        }

        .hero h1 {
            font-size: 48px;
            margin: 0 0 15px;
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            background: white;
            color: #ff6600;
            padding: 13px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 5px;
        }

        .btn:hover {
            background: #f0f0f0;
        }

        .section {
            padding: 50px 20px;
            text-align: center;
        }

        .section h2 {
            font-size: 32px;
            margin-bottom: 30px;
        }

        .features {
            width: 90%;
            max-width: 1000px;
            margin: auto;

            display: grid;
            grid-template-columns:
                repeat(auto-fit, minmax(220px, 1fr));

            gap: 20px;
        }

        .feature-card {
            background: white;
            padding: 30px 20px;
            border-radius: 10px;
            box-shadow: 0 0 8px #ccc;
        }

        .feature-card h3 {
            color: #ff6600;
        }

        .footer {
            background: #222;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
        }

        @media (max-width: 700px) {

            .navbar {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .nav-links {
                justify-content: center;
            }

            .hero h1 {
                font-size: 35px;
            }

            .hero p {
                font-size: 17px;
            }
        }
    </style>
</head>

<body>

<!-- Navigation -->
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
            <a href="orders.php">My Orders</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="contact.php">Contact</a>
            <a href="logout.php">Logout</a>

        <?php else: ?>

            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
            <a href="contact.php">Contact</a>

        <?php endif; ?>

    </div>

</div>


<!-- Hero Section -->
<section class="hero">

    <div class="hero-content">

        <?php if ($isLoggedIn): ?>

            <h1>
                Welcome,
                <?php echo htmlspecialchars($userName); ?>!
            </h1>

        <?php else: ?>

            <h1>
                Delicious Food Delivered To You
            </h1>

        <?php endif; ?>

        <p>
            Order your favorite food quickly and easily.
        </p>

        <a href="menu.php" class="btn">
            Order Now
        </a>

        <?php if (!$isLoggedIn): ?>

            <a href="register.php" class="btn">
                Create Account
            </a>

        <?php endif; ?>

    </div>

</section>


<!-- Features -->
<section class="section">

    <h2>Why Choose Us?</h2>

    <div class="features">

        <div class="feature-card">
            <h3>🍕 Fresh Food</h3>

            <p>
                Enjoy delicious and freshly prepared food.
            </p>
        </div>

        <div class="feature-card">
            <h3>🚚 Fast Delivery</h3>

            <p>
                Get your favorite meals delivered quickly.
            </p>
        </div>

        <div class="feature-card">
            <h3>🛒 Easy Ordering</h3>

            <p>
                Choose your food, add it to cart, and order easily.
            </p>
        </div>

        <div class="feature-card">
            <h3>🔒 Secure Account</h3>

            <p>
                Your registration and login are securely managed.
            </p>
        </div>

    </div>

</section>


<!-- Footer -->
<div class="footer">

    <p>
        &copy; 2026 Online Food Delivery. All rights reserved.
    </p>

</div>

</body>
</html>
```
