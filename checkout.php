<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$cart = $_SESSION["cart"] ?? [];

if (empty($cart)) {
    header("Location: cart.php");
    exit();
}

$total = 0;
$items = [];

foreach ($cart as $food_id => $quantity) {

    $stmt = $conn->prepare(
        "SELECT id, name, price FROM foods WHERE id = ?"
    );

    $stmt->bind_param("i", $food_id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        continue;
    }

    $food = $result->fetch_assoc();

    $subtotal = $food["price"] * $quantity;
    $total += $subtotal;

    $items[] = [
        "food_id" => $food["id"],
        "quantity" => $quantity,
        "price" => $food["price"]
    ];
}

/* Place Order */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $user_id = $_SESSION["user_id"];

    /* Create order */
    $stmt = $conn->prepare(
        "INSERT INTO orders (user_id, total_amount, status)
         VALUES (?, ?, 'Pending')"
    );

    $stmt->bind_param("id", $user_id, $total);
    $stmt->execute();

    $order_id = $stmt->insert_id;

    /* Create order items */
    $item_stmt = $conn->prepare(
        "INSERT INTO order_items
        (order_id, food_id, quantity, price)
        VALUES (?, ?, ?, ?)"
    );

    foreach ($items as $item) {

        $item_stmt->bind_param(
            "iiid",
            $order_id,
            $item["food_id"],
            $item["quantity"],
            $item["price"]
        );

        $item_stmt->execute();
    }

    /* Clear cart */
    $_SESSION["cart"] = [];

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkout - Online Food Delivery</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
        }

        .container {
            width: 450px;
            margin: 80px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        .total {
            font-size: 24px;
            font-weight: bold;
            color: #ff6600;
            margin: 20px 0;
        }

        button {
            width: 100%;
            padding: 13px;
            background: #ff6600;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        button:hover {
            background: #e65c00;
        }

        .back {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #555;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Checkout</h1>

    <p>Your order total is:</p>

    <div class="total">
        <?php echo number_format($total, 2); ?> Birr
    </div>

    <form method="POST">
        <button type="submit">
            Place Order
        </button>
    </form>

    <a href="cart.php" class="back">
        Back to Cart
    </a>

</div>

</body>

</html>
