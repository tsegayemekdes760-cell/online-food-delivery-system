<?php
session_start();
include "db.php";

$cart = $_SESSION["cart"] ?? [];

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Shopping Cart</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f5f5;
        }

        .navbar {
            background: #ff6600;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            color: white;
            margin: 0;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
        }

        .container {
            width: 90%;
            margin: 40px auto;
        }

        .cart-item {
            background: white;
            margin-bottom: 15px;
            padding: 20px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .cart-item img {
            width: 120px;
            height: 90px;
            object-fit: cover;
            border-radius: 8px;
        }

        .cart-info {
            flex: 1;
        }

        .price {
            color: #ff6600;
            font-weight: bold;
        }

        .remove {
            background: #dc3545;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
        }

        .total {
            background: white;
            padding: 20px;
            text-align: right;
            border-radius: 10px;
        }

        .checkout {
            display: inline-block;
            background: #ff6600;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="navbar">

    <h2>Online Food Delivery</h2>

    <div>
        <a href="menu.php">Menu</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>

</div>

<div class="container">

    <h1>Shopping Cart</h1>

    <?php if (empty($cart)): ?>

        <h2>Your cart is empty.</h2>

        <a href="menu.php">Go to Menu</a>

    <?php else: ?>

        <?php foreach ($cart as $food_id => $quantity): ?>

            <?php
            $stmt = $conn->prepare(
                "SELECT id, name, price, image FROM foods WHERE id = ?"
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
            ?>

            <div class="cart-item">

                <img
                    src="images/<?php echo htmlspecialchars($food["image"]); ?>"
                    alt="<?php echo htmlspecialchars($food["name"]); ?>"
                >

                <div class="cart-info">

                    <h2>
                        <?php echo htmlspecialchars($food["name"]); ?>
                    </h2>

                    <p>
                        Price:
                        <?php echo number_format($food["price"], 2); ?> Birr
                    </p>

                    <p>
                        Quantity:
                        <?php echo $quantity; ?>
                    </p>

                    <p class="price">
                        Subtotal:
                        <?php echo number_format($subtotal, 2); ?> Birr
                    </p>

                </div>

                <a
                    href="remove_from_cart.php?id=<?php echo $food["id"]; ?>"
                    class="remove"
                >
                    Remove
                </a>

            </div>

        <?php endforeach; ?>

        <div class="total">

            <h2>
                Total:
                <?php echo number_format($total, 2); ?> Birr
            </h2>

            <a href="checkout.php" class="checkout">
                Checkout
            </a>

        </div>

    <?php endif; ?>

</div>

</body>

</html>