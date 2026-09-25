<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$stmt = $conn->prepare(
    "SELECT id, total_amount, status, created_at
     FROM orders
     WHERE user_id = ?
     ORDER BY id DESC"
);

$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Orders - Online Food Delivery</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .navbar {
            background: #ff6600;
            padding: 18px 30px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-right: 18px;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 40px auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .order-card {
            background: white;
            padding: 25px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 0 8px #ccc;
        }

        .amount {
            color: #ff6600;
            font-size: 20px;
            font-weight: bold;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            background: #fff3cd;
            color: #856404;
            border-radius: 5px;
        }

        .empty {
            background: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="navbar">
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="menu.php">Menu</a>
    <a href="cart.php">Cart</a>
    <a href="orders.php">My Orders</a>
    <a href="dashboard.php">Dashboard</a>
    <a href="contact.php">Contact</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container">

    <h1>My Orders</h1>

    <?php if ($result->num_rows > 0): ?>

        <?php while ($order = $result->fetch_assoc()): ?>

            <div class="order-card">

                <p>
                    <strong>Order ID:</strong>
                    <?php echo (int)$order["id"]; ?>
                </p>

                <p class="amount">
                    Total:
                    <?php echo number_format($order["total_amount"], 2); ?>
                    Birr
                </p>

                <p>
                    <strong>Status:</strong>
                    <span class="status">
                        <?php echo htmlspecialchars($order["status"]); ?>
                    </span>
                </p>

                <p>
                    <strong>Date:</strong>
                    <?php echo htmlspecialchars($order["created_at"]); ?>
                </p>

            </div>

        <?php endwhile; ?>

    <?php else: ?>

        <div class="empty">
            <h2>No orders yet.</h2>
            <p>You have not placed any order.</p>
            <a href="menu.php">Order Food</a>
        </div>

    <?php endif; ?>

</div>

</body>
</html>