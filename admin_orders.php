```php
<?php
session_start();
include "db.php";

/* Check login */
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

/* Admin only */
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: dashboard.php");
    exit();
}

/* Get all orders */
$sql = "
    SELECT
        orders.id AS order_id,
        users.name AS customer_name,
        orders.total_amount,
        orders.status,
        orders.created_at
    FROM orders
    JOIN users ON orders.user_id = users.id
    ORDER BY orders.id DESC
";

$result = $conn->query($sql);

/* Count orders */
$total_orders = 0;
$pending_orders = 0;
$preparing_orders = 0;
$delivered_orders = 0;

if ($result && $result->num_rows > 0) {

    $orders = [];

    while ($order = $result->fetch_assoc()) {

        $orders[] = $order;

        $total_orders++;

        if ($order["status"] === "Pending") {
            $pending_orders++;
        }

        if ($order["status"] === "Preparing") {
            $preparing_orders++;
        }

        if ($order["status"] === "Delivered") {
            $delivered_orders++;
        }
    }

} else {
    $orders = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin Orders | Online Food Delivery</title>

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

        /* MAIN */

        .container {
            width: 92%;
            max-width: 1250px;
            margin: 35px auto;
        }

        .page-title {
            margin-bottom: 25px;
        }

        .page-title h1 {
            margin: 0 0 8px;
            font-size: 32px;
        }

        .page-title p {
            margin: 0;
            color: #777;
        }

        /* STAT CARDS */

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .stat-card span {
            color: #777;
            font-size: 14px;
        }

        .stat-card h2 {
            margin: 10px 0 0;
            font-size: 30px;
        }

        .orange {
            border-left: 5px solid #ff6600;
        }

        .yellow {
            border-left: 5px solid #ff9800;
        }

        .blue {
            border-left: 5px solid #2196f3;
        }

        .green {
            border-left: 5px solid #28a745;
        }

        /* TABLE CARD */

        .table-card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .table-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .table-header h2 {
            margin: 0;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th {
            background: #343a40;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 14px;
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
            padding: 6px 12px;
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

        /* BUTTONS */

        .actions {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 5px;
        }

        .btn {
            color: white;
            text-decoration: none;
            padding: 7px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
        }

        .pending-btn {
            background: #ff9800;
        }

        .preparing-btn {
            background: #2196f3;
        }

        .delivered-btn {
            background: #28a745;
        }

        .btn:hover {
            opacity: 0.85;
        }

        /* EMPTY */

        .empty {
            text-align: center;
            padding: 50px;
            color: #777;
        }

        /* MOBILE */

        @media (max-width: 900px) {

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .navbar {
                flex-direction: column;
                gap: 12px;
                text-align: center;
            }

        }

        @media (max-width: 600px) {

            .container {
                width: 94%;
                margin: 25px auto;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .page-title h1 {
                font-size: 26px;
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

        <a href="dashboard.php">
            Dashboard
        </a>

        <a href="menu.php">
            Menu
        </a>

        <a href="logout.php">
            Logout
        </a>

    </div>

</nav>


<!-- MAIN -->

<main class="container">

    <div class="page-title">

        <h1>📦 Manage Orders</h1>

        <p>
            View and manage customer orders.
        </p>

    </div>


    <!-- STATISTICS -->

    <section class="stats">

        <div class="stat-card orange">

            <span>Total Orders</span>

            <h2>
                <?php echo $total_orders; ?>
            </h2>

        </div>


        <div class="stat-card yellow">

            <span>Pending</span>

            <h2>
                <?php echo $pending_orders; ?>
            </h2>

        </div>


        <div class="stat-card blue">

            <span>Preparing</span>

            <h2>
                <?php echo $preparing_orders; ?>
            </h2>

        </div>


        <div class="stat-card green">

            <span>Delivered</span>

            <h2>
                <?php echo $delivered_orders; ?>
            </h2>

        </div>

    </section>


    <!-- ORDERS TABLE -->

    <section class="table-card">

        <div class="table-header">

            <h2>
                Customer Orders
            </h2>

        </div>


        <?php if (!empty($orders)): ?>

            <div class="table-wrapper">

                <table>

                    <thead>

                    <tr>

                        <th>Order ID</th>

                        <th>Customer</th>

                        <th>Total</th>

                        <th>Status</th>

                        <th>Date</th>

                        <th>Update</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php foreach ($orders as $order): ?>

                        <tr>

                            <td>
                                <strong>
                                    #<?php echo $order["order_id"]; ?>
                                </strong>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $order["customer_name"]
                                );
                                ?>
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

                                <?php

                                $status_class = strtolower(
                                    $order["status"]
                                );

                                ?>

                                <span class="status <?php
                                    echo $status_class;
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

                            <td>

                                <div class="actions">

                                    <a
                                        class="btn pending-btn"
                                        href="update_order.php?id=<?php
                                        echo $order["order_id"];
                                        ?>&status=Pending"
                                    >
                                        Pending
                                    </a>

                                    <a
                                        class="btn preparing-btn"
                                        href="update_order.php?id=<?php
                                        echo $order["order_id"];
                                        ?>&status=Preparing"
                                    >
                                        Preparing
                                    </a>

                                    <a
                                        class="btn delivered-btn"
                                        href="update_order.php?id=<?php
                                        echo $order["order_id"];
                                        ?>&status=Delivered"
                                    >
                                        Delivered
                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <div class="empty">

                <h2>📦 No Orders Yet</h2>

                <p>
                    Customer orders will appear here.
                </p>

            </div>

        <?php endif; ?>

    </section>

</main>

</body>
</html>
```
