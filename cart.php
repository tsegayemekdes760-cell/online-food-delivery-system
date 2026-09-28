```php
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

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Shopping Cart | Online Food Delivery</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f5f5;
            color: #333;
        }

        /* NAVBAR */

        .navbar {
            background: #ff6600;
            padding: 15px 40px;

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
            margin-left: 20px;
            font-weight: bold;
        }

        .navbar a:hover {
            text-decoration: underline;
        }


        /* CONTAINER */

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 40px auto;
        }

        .container > h1 {
            text-align: center;
            margin-bottom: 30px;
        }


        /* EMPTY CART */

        .empty-cart {
            background: white;
            padding: 50px 20px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 3px 12px #ccc;
        }

        .empty-cart h2 {
            margin-bottom: 10px;
        }

        .empty-cart p {
            color: #777;
        }


        /* CART ITEM */

        .cart-item {
            background: white;
            margin-bottom: 20px;
            padding: 20px;

            border-radius: 12px;

            display: flex;
            align-items: center;

            gap: 25px;

            box-shadow: 0 3px 12px #ddd;
        }


        /* IMAGE */

        .cart-item img {
            width: 150px;
            height: 110px;

            object-fit: cover;

            border-radius: 10px;
        }


        /* FOOD INFORMATION */

        .cart-info {
            flex: 1;
        }

        .cart-info h2 {
            margin: 0 0 10px;
            color: #222;
        }

        .cart-info p {
            margin: 7px 0;
            color: #555;
        }

        .price {
            color: #ff6600 !important;
            font-weight: bold;
        }


        /* REMOVE BUTTON */

        .remove {
            background: #dc3545;
            color: white;

            padding: 9px 15px;

            text-decoration: none;

            border-radius: 6px;

            font-weight: bold;
        }

        .remove:hover {
            background: #b52a37;
        }


        /* TOTAL */

        .total {
            background: white;

            padding: 25px;

            margin-top: 25px;

            border-radius: 12px;

            text-align: right;

            box-shadow: 0 3px 12px #ddd;
        }

        .total h2 {
            color: #ff6600;
            margin-top: 0;
        }


        /* BUTTONS */

        .cart-buttons {
            margin-top: 20px;

            display: flex;

            justify-content: space-between;

            gap: 15px;
        }

        .btn {
            display: inline-block;

            background: #ff6600;

            color: white;

            padding: 12px 20px;

            text-decoration: none;

            border-radius: 6px;

            font-weight: bold;
        }

        .btn:hover {
            background: #e65c00;
        }


        /* MOBILE */

        @media (max-width: 600px) {

            .navbar {
                flex-direction: column;
                gap: 15px;
                padding: 15px 20px;
            }

            .navbar a {
                margin-left: 8px;
                font-size: 14px;
            }

            .cart-item {
                flex-direction: column;
                text-align: center;
            }

            .cart-item img {
                width: 100%;
                height: 200px;
            }

            .cart-buttons {
                flex-direction: column;
            }

            .btn {
                text-align: center;
            }

        }

    </style>

</head>


<body>


<!-- NAVBAR -->

<div class="navbar">

    <h2>Online Food Delivery</h2>

    <div>

        <a href="menu.php">Menu</a>

        <a href="dashboard.php">Dashboard</a>

        <a href="logout.php">Logout</a>

    </div>

</div>


<!-- CART CONTAINER -->

<div class="container">

    <h1>🛒 Your Shopping Cart</h1>


    <?php if (empty($cart)): ?>


        <!-- EMPTY CART -->

        <div class="empty-cart">

            <h2>Your cart is empty.</h2>

            <p>
                Please choose some delicious food
                from our menu.
            </p>

            <a href="menu.php" class="btn">
                Go to Menu
            </a>

        </div>


    <?php else: ?>


        <!-- CART ITEMS -->

        <?php foreach ($cart as $food_id => $quantity): ?>

            <?php

            $food_id = (int)$food_id;

            $stmt = $conn->prepare(
                "SELECT id, name, price, image
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

            $subtotal =
                $food["price"] * $quantity;

            $total += $subtotal;

            ?>


            <div class="cart-item">


                <!-- FOOD IMAGE -->

                <?php if (!empty($food["image"])): ?>

                    <img
                        src="image/<?php echo htmlspecialchars(
                            $food["image"]
                        ); ?>"
                        alt="<?php echo htmlspecialchars(
                            $food["name"]
                        ); ?>"
                    >

                <?php endif; ?>


                <!-- FOOD INFORMATION -->

                <div class="cart-info">

                    <h2>
                        <?php echo htmlspecialchars(
                            $food["name"]
                        ); ?>
                    </h2>

                    <p>
                        Price:
                        <?php echo number_format(
                            $food["price"],
                            2
                        ); ?>
                        Birr
                    </p>

                    <p>
                        Quantity:
                        <strong>
                            <?php echo $quantity; ?>
                        </strong>
                    </p>

                    <p class="price">

                        Subtotal:
                        <?php echo number_format(
                            $subtotal,
                            2
                        ); ?>

                        Birr

                    </p>

                </div>


                <!-- REMOVE -->

                <a
                    href="remove_from_cart.php?id=<?php echo $food["id"]; ?>"
                    class="remove"
                >
                    Remove
                </a>


            </div>


        <?php endforeach; ?>


        <!-- TOTAL -->

        <div class="total">

            <h2>

                Total:
                <?php echo number_format(
                    $total,
                    2
                ); ?>

                Birr

            </h2>


            <div class="cart-buttons">

                <a
                    href="menu.php"
                    class="btn"
                >
                    ← Continue Shopping
                </a>


                <a
                    href="checkout.php"
                    class="btn"
                >
                    Checkout →
                </a>

            </div>

        </div>


    <?php endif; ?>


</div>


</body>

</html>
```
