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
    <title>Food Menu</title>

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

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .food-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .food-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 8px #ccc;
            text-align: center;
        }

        .food-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
            border-radius: 10px;
        }

        .price {
            color: #ff6600;
            font-size: 20px;
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            background: #ff6600;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        .btn:hover {
            background: #e65c00;
        }
    </style>
</head>

<body>

<div class="navbar">

    <h2>Online Food Delivery</h2>

    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="cart.php">Cart</a>
        <a href="logout.php">Logout</a>
    </div>

</div>

<div class="container">

    <h1>Our Food Menu</h1>

    <div class="food-container">

        <?php if ($result && $result->num_rows > 0): ?>

            <?php while ($food = $result->fetch_assoc()): ?>

                <div class="food-card">

                    <?php if (!empty($food['image'])): ?>

                        <img
                            src="images/<?php echo htmlspecialchars($food['image']); ?>"
                            alt="<?php echo htmlspecialchars($food['name']); ?>"
                        >

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

            <p>No food items available.</p>

        <?php endif; ?>

    </div>

</div>

</body>
</html>
```
