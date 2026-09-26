```php
<?php
session_start();
include "db.php";

$admin_email = "tsegayemekdes760@gmail.com";

if (!isset($_SESSION["user_id"]) || $_SESSION["email"] !== $admin_email) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $order_id = intval($_POST["order_id"]);
    $status = $_POST["status"];

    $allowed_statuses = [
        "Pending",
        "Preparing",
        "Delivered",
        "Cancelled"
    ];

    if (in_array($status, $allowed_statuses, true)) {

        $stmt = $conn->prepare(
            "UPDATE orders SET status = ? WHERE id = ?"
        );

        $stmt->bind_param("si", $status, $order_id);
        $stmt->execute();
    }

    header("Location: admin_orders.php");
    exit();
}

$sql = "
    SELECT
        orders.id,
        users.name,
        users.email,
        orders.total_amount,
        orders.status,
        orders.created_at
    FROM orders
    INNER JOIN users ON orders.user_id = users.id
    ORDER BY orders.created_at DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin - Order History</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #333;
        }

        .header {
            background: #222;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .logout {
            color: white;
            text-decoration: none;
            background: #e74c3c;
            padding: 10px 16px;
            border-radius: 6px;
        }

        .container {
            width: 95%;
            max-width: 1200px;
            margin: 40px auto;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th,
        td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #f1f1f1;
        }

        tr:hover {
            background: #fafafa;
        }

        .status-form {
            display: flex;
            gap: 8px;
        }

        select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 8px 12px;
            border: none;
            background: #28a745;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.9;
        }

        .empty {
            text-align: center;
            padding: 30px;
        }

        @media (max-width: 700px) {

            .header {
                padding: 15px;
            }

            .container {
                width: 98%;
                margin: 20px auto;
            }

            .card {
                padding: 12px;
            }
        }

    </style>

</head>

<body>

<div class="header">

    <h1>Admin - Order History</h1>

    <a href="logout.php" class="logout">
        Logout
    </a>

</div>

<div class="container">

    <div class="card">

        <?php if ($result && $result->num_rows > 0): ?>

            <table>

                <thead>

                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Update</th>
                    </tr>

                </thead>

                <tbody>

                <?php while ($order = $result->fetch_assoc()): ?>

                    <tr>

                        <td>
                            #<?php echo $order["id"]; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($order["name"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($order["email"]); ?>
                        </td>

                        <td>
                            <?php echo number_format(
                                $order["total_amount"], 2
                            ); ?> Birr
                        </td>

                        <td>
                            <?php echo htmlspecialchars(
                                $order["status"]
                            ); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars(
                                $order["created_at"]
                            ); ?>
                        </td>

                        <td>

                            <form method="POST"
                                  class="status-form">

                                <input
                                    type="hidden"
                                    name="order_id"
                                    value="<?php echo $order["id"]; ?>"
                                >

                                <select name="status">

                                    <option value="Pending"
                                        <?php
                                        echo $order["status"] === "Pending"
                                            ? "selected"
                                            : "";
                                        ?>>
                                        Pending
                                    </option>

                                    <option value="Preparing"
                                        <?php
                                        echo $order["status"] === "Preparing"
                                            ? "selected"
                                            : "";
                                        ?>>
                                        Preparing
                                    </option>

                                    <option value="Delivered"
                                        <?php
                                        echo $order["status"] === "Delivered"
                                            ? "selected"
                                            : "";
                                        ?>>
                                        Delivered
                                    </option>

                                    <option value="Cancelled"
                                        <?php
                                        echo $order["status"] === "Cancelled"
                                            ? "selected"
                                            : "";
                                        ?>>
                                        Cancelled
                                    </option>

                                </select>

                                <button type="submit">
                                    Update
                                </button>

                            </form>

                        </td>

                    </tr>

                <?php endwhile; ?>

                </tbody>

            </table>

        <?php else: ?>

            <div class="empty">

                <h2>No Orders Found</h2>

                <p>
                    There are currently no customer orders.
                </p>

            </div>

        <?php endif; ?>

    </div>

</div>

</body>

</html>
```
