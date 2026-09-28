<?php
session_start();

$loggedIn = isset($_SESSION["user_id"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

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

        /* Navigation */

        .navbar {
            background: #ff6600;
            padding: 18px 30px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
            color: white;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        /* Hero */

        .hero {
            min-height: 520px;

            display: flex;
            justify-content: center;
            align-items: center;

            text-align: center;

            background:
                linear-gradient(
                    rgba(0,0,0,0.55),
                    rgba(0,0,0,0.55)
                ),
                url("image/pizza.jpg");

            background-size: cover;
            background-position: center;
        }

        .hero-content {
            color: white;
            max-width: 750px;
            padding: 30px;
        }

        .hero h1 {
            font-size: 50px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 20px;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;

            background: #ff6600;
            color: white;

            padding: 14px 28px;
            margin-top: 20px;

            border-radius: 6px;

            text-decoration: none;
            font-weight: bold;
        }

        .btn:hover {
            background: #e65c00;
        }

        /* Food Images */

        .food-section {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
        }

        .food-section h2 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 30px;
        }

        .food-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
        }

        .food-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
            box-shadow: 0 0 10px #ddd;
            transition: 0.3s;
        }

        .food-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px #ccc;
        }

        .food-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }

        .food-card h3 {
            color: #ff6600;
            font-size: 22px;
            margin: 15px 0 8px;
        }

        .food-card p {
            color: #666;
            padding: 0 10px;
            line-height: 1.4;
        }

        /* Features */

        .section {
            width: 90%;
            max-width: 1100px;
            margin: 50px auto;
        }

        .section h2 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 30px;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .feature {
            background: white;
            padding: 30px;
            text-align: center;

            border-radius: 10px;

            box-shadow: 0 0 10px #ddd;
        }

        .feature .icon {
            font-size: 45px;
        }

        .feature h3 {
            color: #ff6600;
        }

        .feature p {
            line-height: 1.6;
            color: #666;
        }

        /* CTA */

        .cta {
            background: white;
            text-align: center;

            padding: 45px 20px;
            margin-top: 40px;
        }

        .cta h2 {
            color: #ff6600;
        }

        /* Footer */

        footer {
            background: #222;
            color: white;

            text-align: center;

            padding: 25px;
            margin-top: 50px;
        }

        /* Mobile */

        @media (max-width: 900px) {

            .food-container {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 750px) {

            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .navbar a {
                margin-left: 8px;
                font-size: 14px;
            }

            .hero h1 {
                font-size: 35px;
            }

            .hero p {
                font-size: 17px;
            }

            .features {
                grid-template-columns: 1fr;
            }

            .food-container {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>

<body>


<!-- Navigation -->

<div class="navbar">

    <h2>🍴 Online Food Delivery</h2>

    <div>

        <a href="index.php">Home</a>

        <a href="menu.php">Menu</a>

        <a href="about.php">About</a>

        <a href="contact.php">Contact</a>

        <?php if ($loggedIn): ?>

            <a href="cart.php">Cart</a>

            <a href="dashboard.php">Dashboard</a>

            <a href="logout.php">Logout</a>

        <?php else: ?>

            <a href="login.php">Login</a>

            <a href="register.php">Register</a>

        <?php endif; ?>

    </div>

</div>


<!-- Hero Section -->

<section class="hero">

    <div class="hero-content">

        <h1>
            Delicious Food,
            <br>
            Delivered Fast!
        </h1>

        <p>
            Order your favorite meals online
            and enjoy fresh and delicious food
            delivered directly to you.
        </p>

        <a href="menu.php" class="btn">
            Order Now
        </a>

    </div>

</section>


<!-- Food Images Section -->

<section class="food-section">

    <h2>Popular Food</h2>

    <div class="food-container">


        <!-- Pizza -->

        <div class="food-card">

            <img src="image/pizza.jpg"
                 alt="Pizza">

            <h3>Pizza</h3>

            <p>
                Delicious cheese and tomato pizza.
            </p>

        </div>


        <!-- Burger -->

        <div class="food-card">

            <img src="image/burger.jpg"
                 alt="Burger">

            <h3>Burger</h3>

            <p>
                Beef burger with fresh cheese.
            </p>

        </div>


        <!-- Pasta -->

        <div class="food-card">

            <img src="image/pasta.jpg"
                 alt="Pasta">

            <h3>Pasta</h3>

            <p>
                Delicious Italian pasta.
            </p>

        </div>


        <!-- Chicken -->

        <div class="food-card">

            <img src="image/chicken.jpg"
                 alt="Chicken">

            <h3>Chicken</h3>

            <p>
                Fried chicken with delicious spices.
            </p>

        </div>


        <!-- French Fries -->

        <div class="food-card">

            <img src="image/fries.jpg"
                 alt="French Fries">

            <h3>French Fries</h3>

            <p>
                Crispy golden French fries.
            </p>

        </div>


    </div>

</section>


<!-- Features -->

<section class="section">

    <h2>Why Choose Us?</h2>

    <div class="features">

        <div class="feature">

            <div class="icon">🍕</div>

            <h3>Delicious Food</h3>

            <p>
                Enjoy a variety of delicious
                and freshly prepared meals.
            </p>

        </div>


        <div class="feature">

            <div class="icon">🛒</div>

            <h3>Easy Ordering</h3>

            <p>
                Browse our menu, add your
                favorite food to the cart,
                and place your order easily.
            </p>

        </div>


        <div class="feature">

            <div class="icon">🚚</div>

            <h3>Fast Delivery</h3>

            <p>
                Get your favorite food delivered
                quickly and conveniently.
            </p>

        </div>

    </div>

</section>


<!-- Call To Action -->

<section class="cta">

    <h2>Ready to Order?</h2>

    <p>
        Explore our menu and choose
        your favorite food today!
    </p>

    <a href="menu.php" class="btn">
        View Food Menu
    </a>

</section>


<!-- Footer -->

<footer>

    <p>
        &copy; 2026 Online Food Delivery System
    </p>

    <p>
        Developed by Mekdes Tsegaye
    </p>

</footer>


</body>

</html>