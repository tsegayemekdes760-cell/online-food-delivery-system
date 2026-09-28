<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

/* Get logged-in user */
$stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

/* Get user's orders */
$order_stmt = $conn->prepare("
    SELECT id, total_amount, status, created_at
    FROM orders
    WHERE user_id = ?
    ORDER BY id DESC
");

$order_stmt->bind_param("i", $user_id);
$order_stmt->execute();
$orders = $order_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Online Food Delivery</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
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
            margin: 40px auto;
        }

        .welcome {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 8px #ddd;
        }

        .orders {
            margin-top: 30px;
        }

        .order {
            background: white;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 8px #ddd;
        }

        .order h3 {
            color: #ff6600;
        }

        .status {
            font-weight: bold;
            color: #ff6600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #ff6600;
            color: white;
        }

        .total {
            text-align: right;
            font-size: 20px;
            font-weight: bold;
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <div class="navbar">

        <h2>Online Food Delivery</h2>

        <div>
            <a href="menu.php">Menu</a>
            <a href="cart.php">Cart</a>
            <a href="logout.php">Logout</a>
        </div>

    </div>

    <div class="container">

        <div class="welcome">

            <h1>
                Welcome,
                <?php echo htmlspecialchars($user["name"]); ?>!
            </h1>

            <p>You are successfully logged in.</p>

            <p>
                <strong>Email:</strong>
                <?php echo htmlspecialchars($user["email"]); ?>
            </p>

        </div>


        <div class="orders">

            <h2>My Orders</h2>

            <?php if ($orders->num_rows == 0): ?>

                <div class="order">
                    <p>You have no orders yet.</p>
                    <a href="menu.php">Order Food</a>
                </div>

            <?php else: ?>

                <?php while ($order = $orders->fetch_assoc()): ?>

                    <div class="order">

                        <h3>
                            Order #<?php echo $order["id"]; ?>
                        </h3>

                        <p>
                            <strong>Status:</strong>
                            <span class="status">
                                <?php echo htmlspecialchars($order["status"]); ?>
                            </span>
                        </p>

                        <p>
                            <strong>Date:</strong>
                            <?php echo $order["created_at"]; ?>
                        </p>


                        <?php

                        $item_stmt = $conn->prepare("
                            SELECT
                                foods.name,
                                order_items.quantity,
                                order_items.price
                            FROM order_items
                            INNER JOIN foods
                                ON order_items.food_id = foods.id
                            WHERE order_items.order_id = ?
                        ");

                        $item_stmt->bind_param("i", $order["id"]);
                        $item_stmt->execute();

                        $items = $item_stmt->get_result();

                        ?>

                        <table>

                            <tr>
                                <th>Food</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>

                            <?php while ($item = $items->fetch_assoc()): ?>

                                <tr>

                                    <td>
                                        <?php echo htmlspecialchars($item["name"]); ?>
                                    </td>

                                    <td>
                                        <?php echo $item["quantity"]; ?>
                                    </td>

                                    <td>
                                        <?php echo number_format($item["price"], 2); ?>
                                        Birr
                                    </td>

                                    <td>
                                        <?php
                                        echo number_format(
                                            $item["price"] * $item["quantity"],
                                            2
                                        );
                                        ?>
                                        Birr
                                    </td>

                                </tr>

                            <?php endwhile; ?>

                        </table>


                        <div class="total">

                            Total:
                            <?php echo number_format($order["total_amount"], 2); ?>
                            Birr

                        </div>

                    </div>

                <?php endwhile; ?>

            <?php endif; ?>

        </div>

    </div>

</body>

</html>