<?php
session_start();
include "db.php";

/* Check login */
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Orders - Online Food Delivery</title>

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
            margin: 40px auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px #ddd;
        }

        th {
            background: #333;
            color: white;
            padding: 14px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        tr:hover {
            background: #f9f9f9;
        }

        .status {
            font-weight: bold;
        }

        .pending {
            color: #ff9800;
        }

        .preparing {
            color: #2196f3;
        }

        .delivered {
            color: #28a745;
        }

        .btn {
            display: inline-block;
            padding: 7px 10px;
            margin: 2px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
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
    </style>

</head>

<body>

<div class="navbar">

    <h2>Online Food Delivery - Admin</h2>

    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>

</div>

<div class="container">

    <h1>Manage Orders</h1>

    <table>

        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
            <th>Update Status</th>
        </tr>

        <?php while ($order = $result->fetch_assoc()): ?>

            <tr>

                <td>
                    #<?php echo $order["order_id"]; ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($order["customer_name"]); ?>
                </td>

                <td>
                    <?php echo number_format($order["total_amount"], 2); ?> Birr
                </td>

                <td class="status">

                    <?php echo htmlspecialchars($order["status"]); ?>

                </td>

                <td>
                    <?php echo $order["created_at"]; ?>
                </td>

                <td>

                    <a class="btn pending-btn"
                       href="update_order.php?id=<?php echo $order["order_id"]; ?>&status=Pending">
                        Pending
                    </a>

                    <a class="btn preparing-btn"
                       href="update_order.php?id=<?php echo $order["order_id"]; ?>&status=Preparing">
                        Preparing
                    </a>

                    <a class="btn delivered-btn"
                       href="update_order.php?id=<?php echo $order["order_id"]; ?>&status=Delivered">
                        Delivered
                    </a>

                </td>

            </tr>

        <?php endwhile; ?>

    </table>

</div>

</body>
</html>