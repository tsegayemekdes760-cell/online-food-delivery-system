```php
<?php
session_start();
include "db.php";

$result = $conn->query("SELECT * FROM foods ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Food Menu | Online Food Delivery</title>

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
            font-size: 24px;
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

        /* MAIN CONTAINER */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 35px;
        }

        /* FOOD GRID */
        .food-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 25px;
        }

        /* FOOD CARD */
        .food-card {
            background: white;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.12);
            text-align: center;
            transition: 0.3s;
            overflow: hidden;
        }

        .food-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.18);
        }

        /* FOOD IMAGE */
        .food-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
            border-radius: 10px;
        }

        .food-card h2 {
            margin: 15px 0 8px;
            color: #222;
        }

        .food-card p {
            color: #666;
            line-height: 1.5;
        }

        /* PRICE */
        .price {
            color: #ff6600 !important;
            font-size: 20px;
            font-weight: bold;
            margin: 12px 0;
        }

        /* BUTTON */
        .btn {
            display: inline-block;
            background: #ff6600;
            color: white;
            padding: 11px 18px;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 5px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn:hover {
            background: #e65c00;
        }

        /* EMPTY MESSAGE */
        .empty {
            text-align: center;
            font-size: 18px;
            color: #777;
        }

        /* MOBILE */
        @media (max-width: 600px) {

            .navbar {
                padding: 15px 20px;
                flex-direction: column;
                gap: 15px;
            }

            .navbar a {
                margin-left: 8px;
                font-size: 14px;
            }

            .container {
                width: 92%;
            }

            .food-card img {
                height: 180px;
            }
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">

    <h2>Online Food Delivery</h2>

    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="cart.php">Cart</a>
        <a href="logout.php">Logout</a>
    </div>

</div>


<!-- FOOD MENU -->
<div class="container">

    <h1>🍔 Our Food Menu</h1>

    <div class="food-container">

        <?php if ($result && $result->num_rows > 0): ?>

            <?php while ($food = $result->fetch_assoc()): ?>

                <div class="food-card">

                    <?php if (!empty($food['image'])): ?>

                        <img
                            src="image/<?php echo htmlspecialchars($food['image']); ?>"
                            alt="<?php echo htmlspecialchars($food['name']); ?>"
                        >

                    <?php else: ?>

                        <p>No image available</p>

                    <?php endif; ?>


                    <h2>
                        <?php echo htmlspecialchars($food['name']); ?>
                    </h2>


                    <p>
                        <?php echo htmlspecialchars($food['description']); ?>
                    </p>


                    <p class="price">
                        <?php echo number_format($food['price'], 2); ?> Birr
                    </p>


                    <a
                        href="add_to_cart.php?id=<?php echo (int)$food['id']; ?>"
                        class="btn"
                    >
                        Add to Cart
                    </a>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <p class="empty">
                No food items available.
            </p>

        <?php endif; ?>

    </div>

</div>

</body>
</html>
```
