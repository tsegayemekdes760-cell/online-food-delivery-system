```php
<?php
session_start();
include "db.php";

/* Check login */
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = (int) $_SESSION["user_id"];
$user_name = $_SESSION["user_name"] ?? "Customer";
$user_email = $_SESSION["user_email"] ?? "";

/* Get customer's orders */
$stmt = $conn->prepare(
    "SELECT id, total_amount, status, created_at
     FROM orders
     WHERE user_id = ?
     ORDER BY id DESC"
);

$stmt->bind_param("i", $user_id);
$stmt->execute();

$orders_result = $stmt->get_result();

$total_orders = $orders_result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard | Online Food Delivery</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #333;
        }

        /* NAVBAR */

        .navbar {
            background: linear-gradient(135deg, #ff6600, #ff8c00);
            color: white;
            padding: 18px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 3px 12px rgba(0,0,0,0.12);
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        /* CONTAINER */

        .container {
            width: 92%;
            max-width: 1100px;
            margin: 35px auto;
        }

        /* WELCOME */

        .welcome {
            background: linear-gradient(
                135deg,
                #ff6600,
                #ff8c00
            );

            color: white;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.12);
            margin-bottom: 25px;
        }

        .welcome h1 {
            margin: 0 0 10px;
            font-size: 32px;
        }

        .welcome p {
            margin: 6px 0;
        }

        /* QUICK ACTIONS */

        .actions {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .action-card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            text-align: center;
            text-decoration: none;
            color: #333;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: 0.3s;
        }

        .action-card:hover {
            transform: translateY(-5px);
        }

        .icon {
            font-size: 35px;
            margin-bottom: 10px;
        }

        .action-card h3 {
            margin: 8px 0;
        }

        .action-card p {
            color: #777;
            margin: 0;
        }

        /* ORDERS */

        .orders-card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .orders-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .orders-header h2 {
            margin: 0;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th {
            background: #343a40;
            color: white;
            padding: 15px;
            text-align: center;
        }

        td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #fafafa;
        }

        /* STATUS */

        .status {
            display: inline-block;
            padding: 6px 13px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .pending {
            background: #fff3cd;
            color: #856404;
        }

        .preparing {
            background: #dbeafe;
            color: #075985;
        }

        .delivered {
            background: #d1fae5;
            color: #065f46;
        }

        /* EMPTY */

        .empty {
            padding: 45px;
            text-align: center;
        }

        .empty-icon {
            font-size: 50px;
        }

        .empty h2 {
            margin: 10px 0;
        }

        .empty p {
            color: #777;
        }

        .menu-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 12px 20px;
            background: #ff6600;
            color: white;
            text-decoration: none;
            border-radius: 7px;
            font-weight: bold;
        }

        .menu-btn:hover {
            background: #e65c00;
        }

        /* MOBILE */

        @media (max-width: 800px) {

            .actions {
                grid-template-columns: 1fr;
            }

            .navbar {
                flex-direction: column;
                gap: 12px;
                text-align: center;
            }

            .welcome h1 {
                font-size: 26px;
            }

        }

        @media (max-width: 500px) {

            .container {
                width: 94%;
                margin: 20px auto;
            }

            .welcome {
                padding: 25px;
            }

            .nav-links {
                gap: 12px;
                font-size: 14px;
            }

        }

    </style>

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar">

    <div class="logo">
        🍔 Online Food Delivery
    </div>

    <div class="nav-links">

        <a href="menu.php">
            Menu
        </a>

        <a href="cart.php">
            🛒 Cart
        </a>

        <a href="logout.php">
            Logout
        </a>

    </div>

</nav>


<!-- MAIN -->

<main class="container">


    <!-- WELCOME -->

    <section class="welcome">

        <h1>
            Welcome, <?php
            echo htmlspecialchars($user_name);
            ?>! 👋
        </h1>

        <p>
            You are successfully logged in.
        </p>

        <p>
            <strong>Email:</strong>
            <?php echo htmlspecialchars($user_email); ?>
        </p>

    </section>


    <!-- QUICK ACTIONS -->

    <section class="actions">

        <a href="menu.php" class="action-card">

            <div class="icon">
                🍔
            </div>

            <h3>
                Browse Menu
            </h3>

            <p>
                Choose your favorite food.
            </p>

        </a>


        <a href="cart.php" class="action-card">

            <div class="icon">
                🛒
            </div>

            <h3>
                Shopping Cart
            </h3>

            <p>
                Review your selected food.
            </p>

        </a>


        <a href="logout.php" class="action-card">

            <div class="icon">
                🚪
            </div>

            <h3>
                Logout
            </h3>

            <p>
                Sign out of your account.
            </p>

        </a>

    </section>


    <!-- MY ORDERS -->

    <section class="orders-card">

        <div class="orders-header">

            <h2>
                📦 My Orders
            </h2>

        </div>


        <?php if ($total_orders > 0): ?>

            <div class="table-wrapper">

                <table>

                    <thead>

                    <tr>

                        <th>Order ID</th>

                        <th>Total</th>

                        <th>Status</th>

                        <th>Date</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php while ($order = $orders_result->fetch_assoc()): ?>

                        <tr>

                            <td>
                                <strong>
                                    #<?php echo $order["id"]; ?>
                                </strong>
                            </td>

                            <td>
                                <strong>
                                    <?php
                                    echo number_format(
                                        $order["total_amount"],
                                        2
                                    );
                                    ?>
                                    Birr
                                </strong>
                            </td>

                            <td>

                                <span class="status <?php
                                    echo strtolower(
                                        $order["status"]
                                    );
                                ?>">

                                    <?php
                                    echo htmlspecialchars(
                                        $order["status"]
                                    );
                                    ?>

                                </span>

                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $order["created_at"]
                                );
                                ?>
                            </td>

                        </tr>

                    <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <div class="empty">

                <div class="empty-icon">
                    📦
                </div>

                <h2>
                    No Orders Yet
                </h2>

                <p>
                    Choose some delicious food from our menu!
                </p>

                <a
                    href="menu.php"
                    class="menu-btn"
                >
                    🍔 Go to Menu
                </a>

            </div>

        <?php endif; ?>

    </section>

</main>

</body>
</html>
```
