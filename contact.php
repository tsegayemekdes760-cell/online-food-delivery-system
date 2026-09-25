<?php
session_start();

$isLoggedIn = isset($_SESSION["user_id"]);

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $subject = trim($_POST["subject"] ?? "");
    $user_message = trim($_POST["message"] ?? "");

    if ($name === "" || $email === "" || $subject === "" || $user_message === "") {
        $message = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
    } else {
        $message = "Thank you, your message has been received!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Us - Online Food Delivery</title>

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
            padding: 55px 20px;
        }

        .hero h1 {
            margin: 0 0 10px;
            font-size: 42px;
        }

        .hero p {
            font-size: 18px;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 40px auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 8px #ccc;
        }

        .card h2 {
            color: #ff6600;
            margin-top: 0;
        }

        .info p {
            margin: 12px 0;
        }

        .info strong {
            color: #ff6600;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            margin: 8px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        textarea {
            min-height: 130px;
            resize: vertical;
        }

        button {
            width: 100%;
            padding: 13px;
            background: #ff6600;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 17px;
            cursor: pointer;
        }

        button:hover {
            background: #e65c00;
        }

        .message {
            padding: 12px;
            margin-bottom: 15px;
            background: #fff3cd;
            border: 1px solid #ffe08a;
            border-radius: 5px;
            text-align: center;
        }

        .footer {
            background: #222;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }

        @media (max-width: 700px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .container {
                grid-template-columns: 1fr;
            }

            .hero h1 {
                font-size: 34px;
            }
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

        <a href="contact.php">Contact</a>

    </div>

</div>

<section class="hero">

    <h1>Contact Us</h1>

    <p>
        We would love to hear from you.
    </p>

</section>

<div class="container">

    <div class="card info">

        <h2>Get In Touch</h2>

        <p>
            Have a question about our food delivery service?
            Send us a message.
        </p>

        <p>
            <strong>📍 Address:</strong><br>
            Addis Ababa, Ethiopia
        </p>

        <p>
            <strong>📞 Phone:</strong><br>
            +251 900 000 000
        </p>

        <p>
            <strong>📧 Email:</strong><br>
            info@onlinefooddelivery.com
        </p>

        <p>
            <strong>🕒 Opening Hours:</strong><br>
            Monday - Sunday: 8:00 AM - 10:00 PM
        </p>

    </div>

    <div class="card">

        <h2>Send Us a Message</h2>

        <?php if ($message !== ""): ?>

            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <label>Name</label>

            <input
                type="text"
                name="name"
                placeholder="Enter your name"
                required
            >

            <label>Email</label>

            <input
                type="email"
                name="email"
                placeholder="Enter your email"
                required
            >

            <label>Subject</label>

            <input
                type="text"
                name="subject"
                placeholder="Enter subject"
                required
            >

            <label>Message</label>

            <textarea
                name="message"
                placeholder="Write your message..."
                required
            ></textarea>

            <button type="submit">
                Send Message
            </button>

        </form>

    </div>

</div>

<div class="footer">

    <p>
        &copy; 2026 Online Food Delivery. All rights reserved.
    </p>

</div>

</body>
</html>