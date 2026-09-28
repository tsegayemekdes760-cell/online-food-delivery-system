<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>About Us - Online Food Delivery</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .navbar {
            background: #ff6600;
            color: white;
            padding: 18px 30px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 50px auto;
        }

        .about-box {
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 0 10px #ddd;
        }

        h1 {
            text-align: center;
            color: #ff6600;
            margin-bottom: 30px;
        }

        h2 {
            color: #333;
            margin-top: 25px;
        }

        p {
            color: #555;
            line-height: 1.8;
            font-size: 16px;
        }

        .student-info {
            background: #fff3e8;
            padding: 20px;
            border-left: 5px solid #ff6600;
            border-radius: 6px;
        }

        .student-info p {
            margin: 10px 0;
        }

        .student-info strong {
            color: #333;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 25px;
        }

        .feature {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .feature h3 {
            color: #ff6600;
        }

        @media (max-width: 700px) {

            .navbar {
                flex-direction: column;
                gap: 12px;
            }

            .navbar a {
                margin-left: 8px;
            }

            .features {
                grid-template-columns: 1fr;
            }

            .container {
                width: 95%;
            }

            .about-box {
                padding: 20px;
            }
        }

    </style>

</head>

<body>

<div class="navbar">

    <h2>Online Food Delivery</h2>

    <div>

        <a href="index.php">Home</a>

        <a href="menu.php">Menu</a>

        <a href="about.php">About</a>

        <a href="contact.php">Contact</a>

        <a href="cart.php">Cart</a>

        <a href="dashboard.php">Dashboard</a>

        <a href="logout.php">Logout</a>

    </div>

</div>


<div class="container">

    <div class="about-box">

        <h1>About Online Food Delivery</h1>


        <h2>Student Information</h2>

        <div class="student-info">

            <p>
                <strong>Full Name:</strong>
                Mekdes Tsegaye
            </p>

            <p>
                <strong>ID Number:</strong>
                MECS/045/16
            </p>

            <p>
                <strong>Department:</strong>
                Computer Science
            </p>

        </div>


        <h2>About Me</h2>

        <p>
            My name is Mekdes Tsegaye. I am a student interested
            in web development, programming, database systems,
            and modern technology. I enjoy learning how websites
            are designed and how different technologies work
            together to create useful applications.
        </p>

        <p>
            I chose this Online Food Delivery System project
            because food ordering is a common service that can
            benefit from an easy-to-use online platform. This
            project also gives me an opportunity to apply HTML,
            CSS, JavaScript, PHP, and MySQL skills in one complete
            web application.
        </p>


        <h2>About the System</h2>

        <p>
            The Online Food Delivery System is a web-based
            application that allows customers to browse available
            food items, add food to a shopping cart, place orders,
            and view their order history.
        </p>

        <p>
            The system also provides an administration function
            for managing customer orders and updating order
            statuses such as Pending, Preparing, and Delivered.
        </p>


        <h2>System Features</h2>

        <div class="features">

            <div class="feature">

                <h3>🍕 Food Menu</h3>

                <p>
                    Browse available food items and their prices.
                </p>

            </div>


            <div class="feature">

                <h3>🛒 Shopping Cart</h3>

                <p>
                    Add food items and review your order before
                    checkout.
                </p>

            </div>


            <div class="feature">

                <h3>📦 Order Tracking</h3>

                <p>
                    View orders and their current status.
                </p>

            </div>

        </div>

    </div>

</div>

</body>

</html>