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

/* Get food information */
foreach ($cart as $food_id => $quantity) {

    $food_id = (int)$food_id;
    $quantity = (int)$quantity;

    if ($quantity <= 0) {
        continue;
    }

    $stmt = $conn->prepare(
        "SELECT id, name, price
         FROM foods
         WHERE id = ?"
    );

    $stmt->bind_param("i", $food_id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        continue;
    }

    $food = $result->fetch_assoc();

    $subtotal = (float)$food["price"] * $quantity;
    $total += $subtotal;

    $items[] = [
        "food_id" => (int)$food["id"],
        "name" => $food["name"],
        "quantity" => $quantity,
        "price" => (float)$food["price"]
    ];

    $stmt->close();
}

/* If no valid items */
if (empty($items) || $total <= 0) {
    header("Location: cart.php");
    exit();
}

/* Place Order */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $user_id = (int)$_SESSION["user_id"];

    try {

        /* Start transaction */
        $conn->begin_transaction();

        /* Insert order */
        $stmt = $conn->prepare(
            "INSERT INTO orders
            (user_id, total_amount, status)
            VALUES (?, ?, 'Pending')"
        );

        $stmt->bind_param("id", $user_id, $total);

        if (!$stmt->execute()) {
            throw new Exception("Failed to create order.");
        }

        $order_id = $stmt->insert_id;

        $stmt->close();

        /* Insert order items */
        $item_stmt = $conn->prepare(
            "INSERT INTO order_items
            (order_id, food_id, quantity, price)
            VALUES (?, ?, ?, ?)"
        );

        foreach ($items as $item) {

            $food_id = $item["food_id"];
            $quantity = $item["quantity"];
            $price = $item["price"];

            $item_stmt->bind_param(
                "iiid",
                $order_id,
                $food_id,
                $quantity,
                $price
            );

            if (!$item_stmt->execute()) {
                throw new Exception("Failed to create order item.");
            }
        }

        $item_stmt->close();

        /* Everything successful */
        $conn->commit();

        /* Clear cart */
        $_SESSION["cart"] = [];

        /* Save order ID for dashboard */
        $_SESSION["last_order_id"] = $order_id;

        header("Location: dashboard.php");
        exit();

    } catch (Exception $e) {

        /* Undo database changes if something fails */
        $conn->rollback();

        $error = "Order could not be placed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Checkout - Online Food Delivery</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
        }

        .container {
            width: 450px;
            max-width: 90%;
            margin: 70px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px #ccc;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
        }

        .message {
            background: #ffe5e5;
            color: #c00;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .total {
            font-size: 26px;
            font-weight: bold;
            color: #ff6600;
            margin: 25px 0;
        }

        .items {
            text-align: left;
            margin: 20px 0;
        }

        .item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        button {
            width: 100%;
            padding: 13px;
            background: #ff6600;
            color: white;
            border: none;
            border-radius: 6px;
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

    <p>Review your order before placing it.</p>

    <?php if (isset($error)): ?>

        <div class="message">
            <?php echo htmlspecialchars($error); ?>
        </div>

    <?php endif; ?>

    <div class="items">

        <?php foreach ($items as $item): ?>

            <div class="item">

                <span>
                    <?php echo htmlspecialchars($item["name"]); ?>
                    × <?php echo $item["quantity"]; ?>
                </span>

                <strong>
                    <?php
                    echo number_format(
                        $item["price"] * $item["quantity"],
                        2
                    );
                    ?>
                    Birr
                </strong>

            </div>

        <?php endforeach; ?>

    </div>

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
        ← Back to Cart
    </a>

</div>

</body>

</html>